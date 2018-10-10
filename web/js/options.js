$(document).ready(function(){

	// Creates event on the add row button
	$('#button-add').on('click', function () {
		addEmptyRow();
	});

	$('#button-check').on('click', function () {
		checkOut($(this).attr('url'));
	})

	$('#button-form').on('click', function () {
		orderForm($(this).attr('url'));
	})

	$('#options-table').on('change', 'select.product', function () {
		let id = $(this).attr("id").replace(/product-/g, '');
		let value = $(this).val();
		addProductThumb(id, value);
		createFormsSelect(id, value);
	})

	$('#options-table').on('change', 'select.form', function () {
		let id = $(this).attr("id").replace(/form-/g, '');
		let value = $(this).val();
		createQuantitySelect(id, value);
		createBoxSelect(id, value);
	})

	$('#options-table').on('change', 'select.quantity', function () {
		let id = $(this).attr("id").replace(/quantity-/g, '');
		showPrice(id);
	})

	$('#options-table').on('click', 'a.boxbutton', function () {
		let id = $(this).attr("id").replace(/boxbutton-/g, '');
		fillBoxModal(id);
	})

	// Creates event on the delete row button
	$('#options-table').on('click', 'button.btn-danger', function () {
		let id = this.id.replace(/delete-/, '');
		$('#row-'+id).remove();
		showTotal();
	});

	$('.modal-body').on('click', 'a.box-link', function (e) {
		e.preventDefault();
		let id = $(this).attr("id");
		selectBoxModal(id);
	})

	// Gets products from the database
	$.ajax({
		url: 'productsfull',
		type: 'post',
		data: {
			_csrf : yii.getCsrfToken()
		},
		success: function(data) {
			let response = JSON.parse(data);
			PRODUCTS = response.products;
			BOXES = response.boxes;
			FORMS = response.forms;
			QUANTITIES = response.quantities;
			TYPEQUANTITIES = response.typequantities;
		}
	});

});

// Initializes variables
var row = 0;

// Adds an empty row
function addEmptyRow () {
	row = row + 1;

	let productRow =  '<tr id="row-'   + row + '">' +
		'<td id="thumb-' + row + '"></td>' +
		'<td><select id="product-' + row + '" class="product form-control"></select></td>' +
		'<td><select id="form-' + row + '" class="form form-control"></select></td>' +
		'<td><select id="quantity-' + row + '" class="quantity form-control"></select></td>' +
		'<td id="box-' + row + '"></td>' +
		'<td id="boxPrice-' + row + '"></td>' +
		'<td id="boxTotal-' + row + '"></td>' +
		'<td id="price-' + row + '"></td>' +
		'<td id="priceTotal-' + row + '"></td>' +
		'<td><button id="delete-' + row + '" class="btn btn-danger">X</button></td>' +
	'</tr>';

	$('#options-table tbody').append(productRow);

	createProductSelect(row);

	let checkBtn = $('#button-check').hasClass('dn');

	if (checkBtn)
		$('#button-check').removeClass('dn');

}

// Fills the product select
function createProductSelect (id) {
	let dropdown = $('#product-'+id);

	// Appends results
	for (var i = 1; i < PRODUCTS.length; i++) {
		dropdown.append('<option value="'+PRODUCTS[i].id+'">'+PRODUCTS[i].name+'</option>');
	}

	// Shows thumb for first product
	addProductThumb(id, 1);

	let value = dropdown.val();
	addProductThumb(id, value);
	createFormsSelect(id, value);

}

function addProductThumb(id, value) {

	for (let i = 1; i < PRODUCTS.length; i++) {
		if (PRODUCTS[i].id == value) {
			$('#thumb-'+id).html('<img class="img-responsive" src="../images/products/thumbs/'+PRODUCTS[i].product+'.jpg" />');
		}
	}
}

function createFormsSelect (id, value) {
	let dropdown = $('#form-'+id);
	let dropdownBox = $('#box-'+id);

	dropdown.html('');
	dropdownBox.html('');

	let arr = FORMS[value];

	if (arr[0] == 1) {

		dropdown.removeAttr('disabled');

		// Appends results
		for (var i = 1; i <= 6; i++) {
			if (arr[i])
				dropdown.append('<option value="'+i+'">'+arr[i]+'</option>');
		}

		let value = dropdown.val();
		createQuantitySelect(id, value);
		createBoxSelect(id, value);

	} else if (arr[0] == 3) {

		dropdown.append('<option value="0">Unidad</option>');

		dropdown.attr('disabled', 'disabled');
		dropdownBox.attr('disabled', 'disabled');

		createQuantitySelect(id, 0);
		createBoxSelect(id, 0);

	} else if (arr[0] == 5) {

		dropdown.append('<option value="0">Unidad</option>');

		dropdown.attr('disabled', 'disabled');
		dropdownBox.attr('disabled', 'disabled');

		createQuantitySelect(id, 0);
		createBoxSelect(id, 7);
	}

}

function createQuantitySelect (id, value) {
	let dropdown = $('#quantity-'+id);
	let arr = value != 0 ? QUANTITIES[value] : TYPEQUANTITIES[3];

	dropdown.html('');

	// Appends results
	for (var i = 0; i < Object.keys(arr).length; i++) {
		dropdown.append('<option value="'+arr[i]+'">'+arr[i]+'</option>');
	}

	showPrice(id);

}

function createBoxSelect(id, value) {
	let dropdown = $('#box-'+id);

	dropdown.html('<a class="boxbutton" id="boxbutton-'+id+'" data-toggle="modal" data-target="#basicExampleModal">Seleccionar</a>');

}

function fillBoxModal(id) {
	let value = $('#form-'+id).val();
	let boxesList = '<div class="row">';

	for (var i = 0; i < Object.keys(BOXES).length; i++) {
		if (BOXES[i].type_id == value){
			boxesList += '<div class="col-xs-6">'+
			'<a id="'+id+'-'+BOXES[i].id+'" class="box-link"><img class="img-responsive" src="../images/packages/'+BOXES[i].image+'.jpg" /></a>'+
			'</div>';
		}
	}

	boxesList += '</div>';

	$('.modal-body').html(boxesList);
}

function selectBoxModal(id) {
	let arr = id.split('-');
	$('#box-'+arr[0]).html('<a class="boxbutton" data-toggle="modal" data-target="#basicExampleModal"><img id="'+arr[1]+'" class="img-responsive" src="../images/packages/'+BOXES[arr[1]].image+'.jpg" /></a>');
	$('#basicExampleModal').modal('hide');
	showPrice(arr[0]);
}

function showPrice(id) {
	let product = $('#product-'+id).val();
	let form = $('#form-'+id).val();
	let quantity = $('#quantity-'+id).val();
	let box = $('#box-'+id+' img').attr('id');

	let boxPrice = $('#boxPrice-'+id);
	let boxTotal = $('#boxTotal-'+id);

	let cellPrice = $('#price-'+id);
	let cellPriceTotal = $('#priceTotal-'+id);

	// Gets price from the database
	if (form != 0) {
		$.ajax({
			url: 'productprice',
			type: 'post',
			data: {
				product: product,
				form: form,
				quantity: quantity,
				box: box ? box : 0,
				_csrf : yii.getCsrfToken()
			},
			success: function(data) {
				let prices = JSON.parse(data);

				if (box == 0) {
					boxPrice.html('');
					boxTotal.html('');
				} else {
					boxPrice.html(prices.boxPrice);
					boxTotal.html(prices.boxTotal);
				}

				cellPrice.html(prices.price);
				cellPriceTotal.html(prices.priceTotal);
				showTotal();
			}
		});
	} else {
		$.ajax({
			url: 'productpricedeli',
			type: 'post',
			data: {
				product: product,
				quantity: quantity,
				box: box ? box : 0,
				_csrf : yii.getCsrfToken()
			},
			success: function(data) {
				let prices = JSON.parse(data);

				if (box == 0) {
					boxPrice.html('');
					boxTotal.html('');
				} else {
					boxPrice.html(prices.boxPrice);
					boxTotal.html(prices.boxTotal);
				}

				cellPrice.html(prices.price);
				cellPriceTotal.html(prices.priceTotal);
				showTotal();
			}
		});
	}
}

function showTotal () {
	let cell = $('#price-total');
	let list = [];

	for (var i = 1; i <= row; i++) {
		let product = $('#product-'+i).val();
		let form = $('#form-'+i).val();
		let quantity = $('#quantity-'+i).val();
		let box = $('#box-'+i).val();

		if (!product || !quantity)
			continue;

		list.push([product, form, quantity, box]);
	}

	// Gets price from the database
	$.ajax({
		url: 'totalprice',
		type: 'post',
		data: {
			list: list,
			_csrf : yii.getCsrfToken()
		},
		success: function(data) {
			let price = JSON.parse(data);
			cell.html(price);
		}
	});
}

function checkOut (url) {
	swal({
		title: '¿Desea continuar a la revisión del pedido?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Continuar',
		cancelButtonText: 'Cancelar',
	}).then((result) => {
		if (result.value) {
			let list = [];

			for (var i = 1; i <= row; i++) {
				let product = $('#product-'+i).val();
				let form = $('#form-'+i).val();
				let quantity = $('#quantity-'+i).val();
				let box = $('#box-'+i+' img').attr('id');

				if (!product || !quantity)
					continue;

				list.push([product, form, quantity, box ? box : 0]);
			}

			// Gets price from the database
			$.ajax({
				url: 'setcart',
				type: 'post',
				data: {
					list: list,
					_csrf : yii.getCsrfToken()
				},
				success: function(data) {
					window.location.href = url;
				}
			});
		}
	})
}

function orderForm (url) {
	swal({
		title: '¿Desea enviar su pedido?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Continuar',
		cancelButtonText: 'Cancelar',
	}).then((result) => {
			if (result.value) {
					window.location.href = url;
			}
	})
}

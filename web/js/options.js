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

	// Gets products from the database
	$.ajax({
		url: 'productsfull',
		type: 'post',
		data: {
			_csrf : yii.getCsrfToken()
		},
		success: function(data) {
			PRODUCTS = JSON.parse(data);
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
		'<td><select id="product-' + row + '" class="form-control"></select></td>' +
		'<td><select id="form-' + row + '" class="form-control"></select></td>' +
		'<td><select id="quantity-' + row + '" class="form-control"></select></td>' +
		'<td id="price-' + row + '"></td>' +
		'<td id="priceTotal-' + row + '"></td>' +
		'<td><button id="delete-' + row + '" class="btn btn-danger">X</button></td>' +
	'</tr>';

	$('#options-table tbody').append(productRow);

	createProductSelect(row);

	let checkBtn = $('#button-check').hasClass('dn');

	if (checkBtn)
		$('#button-check').removeClass('dn');

	// Creates event on the delete row button
	$('#delete-'+row).on('click', function () {
		deleteRow(this);
	});

}

// Deletes a row
function deleteRow (object) {
	let id = object.id.replace(/delete-/, '');
	$('#row-'+id).remove();
	showTotal();
}

// Fills the product select
function createProductSelect (id) {
	let dropdown = $('#product-'+id);

	// Gets products from the database
	/*$.ajax({
		url: 'products',
		type: 'post',
		data: {
			_csrf : yii.getCsrfToken()
		},
		success: function(data) {
			let arr = JSON.parse(data);

			// Appends results
			for (var i = 1; i <= Object.keys(arr).length; i++) {
				dropdown.append('<option value="'+i+'">'+arr[i]+'</option>');
			}

			// Shows thumb for first product
			addProductThumb(id, 1);

			let value = dropdown.val();
			addProductThumb(id, value);
			createFormsSelect(id, value);

			// Creates the selects on change event
			dropdown.on('change', function () {
				let id = this.id.replace(/product-/, '');
				let value = dropdown.val();
				addProductThumb(id, value);
				createFormsSelect(id, value);
			});
		}
	});*/

	// Appends results
	for (var i = 1; i < PRODUCTS.length; i++) {
		dropdown.append('<option value="'+PRODUCTS[i].id+'">'+PRODUCTS[i].name+'</option>');
	}

	// Shows thumb for first product
	addProductThumb(id, 1);

	let value = dropdown.val();
	addProductThumb(id, value);
	createFormsSelect(id, value);

	// Creates the selects on change event
	dropdown.on('change', function () {
		let id = this.id.replace(/product-/, '');
		let value = dropdown.val();
		addProductThumb(id, value);
		createFormsSelect(id, value);
	});
}

function addProductThumb(id, value) {
	/*$.ajax({
		url: 'productthumb',
		type: 'post',
		data: {
			id: value,
			_csrf : yii.getCsrfToken()
		},
		success: function(data) {
			$('#thumb-'+id).html('<img class="img-responsive" src="../images/products/thumbs/'+data+'" />');
		}
	});*/
	for (let i = 1; i < PRODUCTS.length; i++) {
		if (PRODUCTS[i].id == value) {
			$('#thumb-'+id).html('<img class="img-responsive" src="../images/products/thumbs/'+PRODUCTS[i].product+'" />');
		}
	}
}

function createFormsSelect (id, value) {
	let dropdown = $('#form-'+id);

	// Gets products from the database
	$.ajax({
		url: 'productforms',
		type: 'post',
		data: {
			id: value,
			_csrf : yii.getCsrfToken()
		},
		success: function(data) {
			let arr = JSON.parse(data);
			dropdown.html('');

			if (arr[0] == 1) {

				dropdown.removeAttr('disabled');

				// Appends results
				for (var i = 1; i <= 6; i++) {
					if (arr[i])
						dropdown.append('<option value="'+i+'">'+arr[i]+'</option>');
				}

				let value = dropdown.val();
				createQuantitySelect(id, value);

				// Creates the selects on change event
				dropdown.on('change', function () {
					let id = this.id.replace(/form-/, '');
					let value = dropdown.val();
					createQuantitySelect(id, value);
				});

			} else if (arr[0] == 3) {
				dropdown.attr('disabled', 'disabled');
				createQuantitySelect(id, 0);
			}

		}
	});
}

function createQuantitySelect (id, value) {
	let dropdown = $('#quantity-'+id);

	// Gets quantities from the database
	$.ajax({
		url: 'productquantities',
		type: 'post',
		data: {
			id: value,
			_csrf : yii.getCsrfToken()
		},
		success: function(data) {
			let arr = JSON.parse(data);
			dropdown.html('');

			// Appends results
			for (var i = 0; i < Object.keys(arr).length; i++) {
				dropdown.append('<option value="'+arr[i]+'">'+arr[i]+'</option>');
			}

			showPrice(id);

			// Creates the selects on change event
			dropdown.on('change', function () {
				let id = this.id.replace(/quantity-/, '');
				let value = dropdown.val();
				showPrice(id);
			});
		}
	});
}

function showPrice(id) {
	let product = $('#product-'+id).val();
	let form = $('#form-'+id).val();
	let quantity = $('#quantity-'+id).val();

	let cellPrice = $('#price-'+id);
	let cellPriceTotal = $('#priceTotal-'+id);

	// Gets price from the database
	if (form != null) {
		$.ajax({
			url: 'productprice',
			type: 'post',
			data: {
				product: product,
				form: form,
				quantity: quantity,
				_csrf : yii.getCsrfToken()
			},
			success: function(data) {
				let prices = JSON.parse(data);
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
				_csrf : yii.getCsrfToken()
			},
			success: function(data) {
				let prices = JSON.parse(data);
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

		if (!product || !quantity)
			continue;

		list.push([product, form, quantity]);
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

				if (!product || !quantity)
					continue;

				list.push([product, form, quantity]);
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

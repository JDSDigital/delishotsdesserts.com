$(document).ready(function(){

	// Creates event on the add row button
	$('#button-add').on('click', function () {
		addEmptyRow();
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
		'<td><button id="delete-' + row + '" class="btn btn-danger">X</button></td>' +
	'</tr>';

	$('#options-table tbody').append(productRow);

	createProductSelect(row);

	// Creates event on the delete row button
	$('#delete-'+row).on('click', function () {
		deleteRow(this);
	});
}

// Deletes a row
function deleteRow (object) {
	let id = object.id.replace(/delete-/, '');
	$('#row-'+id).remove();
}

// Fills the product select
function createProductSelect (id) {
	let dropdown = $('#product-'+id);

	// Gets products from the database
	$.ajax({
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
	});
}

function addProductThumb(id, value) {
	$.ajax({
		url: 'productthumb',
		type: 'post',
		data: {
			id: value,
			_csrf : yii.getCsrfToken()
		},
		success: function(data) {
			$('#thumb-'+id).html('<img class="img-responsive" src="../images/products/thumbs/'+data+'" />')
		}
	});
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

			// Appends results
			for (var i = 1; i <= 4; i++) {
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

	let cell = $('#price-'+id);

	// Gets price from the database
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
			let price = JSON.parse(data);
			cell.html(price);
		}
	});
}
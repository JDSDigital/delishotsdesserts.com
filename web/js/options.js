$(document).ready(function(){

	// Creates event on the add row button
	$('#button-add').on('click', function () {
		addEmptyRow();
	});

	$.ajax({
		url: 'products',
		type: 'post',
		data: {
			_csrf : yii.getCsrfToken()
		},
		success: function(data) {
			var products = data;
		}
	});

});

// Initializes variables
var row = 0;

// Adds an empty row
function addEmptyRow () {
	row = row + 1;

	let productRow =  '<tr id="row-'   + row + '">' +
		'<td id="thumb-'    + row + '"></td>' +
		'<td><select id="product-' + row + '"></select></td>' +
		'<td><select id="form-' + row + '"></select></td>' +
		'<td><select id="quantity-' + row + '"></select></td>' +
		'<td id="price-' + row + '"></td>' +
		'<td><button id="delete-' + row + '">Delete</button></td>' +
	'</tr>';

	$('#options-table tbody').append(productRow);

	createProductSelect();
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

function createProductSelect () {

}
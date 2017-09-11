$(document).ready(function(){
	$('#button-add').on('click', function () {
		$.ajax({
			url: "test",
			success: function(data) {
				alert(data)
			}
		})
	})
});
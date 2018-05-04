// $(".index-slider").vegas({
// 	delay: 7000,
// 	shuffle: true,
// 	loop: true,
// 	animation: 'random',
// 	slides: [
// 		{ src: "../images/front/01.jpg" },
// 		{ src: "../images/front/02.jpg" },
// 		{ src: "../images/front/03.jpg" },
// 		{ src: "../images/front/04.jpg" },
// 		{ src: "../images/front/05.jpg" },
// 		{ src: "../images/front/06.jpg" },
// 		{ src: "../images/front/07.jpg" },
// 		{ src: "../images/front/08.jpg" },
// 		{ src: "../images/front/09.jpg" },
// 		{ src: "../images/front/10.jpg" },
// 		{ src: "../images/front/11.jpg" },
// 		{ src: "../images/front/12.jpg" },
// 		{ src: "../images/front/13.jpg" }
// 	]
// });

$(".gallery-products").vegas({
	delay: 7000,
	shuffle: true,
	loop: true,
	animation: 'random',
	slides: [
		{ src: "../images/gallery/thumbs/products/01.jpg" },
		{ src: "../images/gallery/thumbs/products/02.jpg" },
		{ src: "../images/gallery/thumbs/products/03.jpg" },
		{ src: "../images/gallery/thumbs/products/04.jpg" },
		{ src: "../images/gallery/thumbs/products/05.jpg" }
	]
});

$(".gallery-events").vegas({
	delay: 7000,
	shuffle: true,
	loop: true,
	animation: 'random',
	slides: [
		{ src: "../images/gallery/thumbs/events/01.jpg" },
		{ src: "../images/gallery/thumbs/events/02.jpg" },
		{ src: "../images/gallery/thumbs/events/03.jpg" },
		{ src: "../images/gallery/thumbs/events/04.jpg" },
		{ src: "../images/gallery/thumbs/events/05.jpg" }
	]
});

$(".gallery-bakery").vegas({
	delay: 7000,
	shuffle: true,
	loop: true,
	animation: 'random',
	slides: [
		{ src: "../images/gallery/thumbs/products/01.jpg" },
		{ src: "../images/gallery/thumbs/products/02.jpg" },
		{ src: "../images/gallery/thumbs/products/03.jpg" },
		{ src: "../images/gallery/thumbs/products/04.jpg" },
		{ src: "../images/gallery/thumbs/products/05.jpg" }
	]
});

$(".gallery-pastry").vegas({
	delay: 7000,
	shuffle: true,
	loop: true,
	animation: 'random',
	slides: [
		{ src: "../images/products/thumbs/pastry01.jpg" },
		{ src: "../images/products/thumbs/pastry02.jpg" },
		{ src: "../images/products/thumbs/pastry05.jpg" },
		{ src: "../images/products/thumbs/pastry07.jpg" },
		{ src: "../images/products/thumbs/pastry09.jpg" },
		{ src: "../images/products/thumbs/pastry10.jpg" },
		{ src: "../images/products/thumbs/pastry11.jpg" }
	]
});

var frontImages = ['01.jpg', '02.jpg', '03.jpg', '04.jpg', '05.jpg', '06.jpg', '07.jpg', '08.jpg', '09.jpg', '10.jpg', '11.jpg', '12.jpg', '13.jpg'];
var num = Math.floor(Math.random() * frontImages.length);

function listenerChangeStatus(url){

	$(".switchStatus").change(function(){
		$.ajax({
			url: url,
			type: 'post',
			data: {
				id: $(this).attr("id").replace(/status-/g, ''),
				_csrf : yii.getCsrfToken()
			},
			success: function () {
				console.log(true);
			},
			error: function () {
				console.log(false);
			}
		});
	});
}

$(window).on('load', function() {
	$('#preloader').fadeOut('slow', function(){
		$(this).remove();
	});

	$('.header').parallax({imageSrc: '../images/front/' + frontImages[num] });

	$("[data-fancybox]").fancybox({
		image : {
			// Wait for images to load before displaying
			// Requires predefined image dimensions
			// If 'auto' - will zoom in thumbnail if 'width' and 'height' attributes are found
			preload : "auto",
			// Protect an image from downloading by right-click
			protect : true
		},
		thumbs: {
			autoStart: true, // Display thumbnails on opening
			hideOnClosing: true   // Hide thumbnail grid when closing animation starts
		},
		slideShow : {
			autoStart : true,
			speed     : 4000
		}
	});
});

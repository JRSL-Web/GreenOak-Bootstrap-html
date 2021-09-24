$(function () {
	$(window).scroll(function () {
		const wHeight = $(window).height();
		const scrollAmount = $(window).scrollTop();
		$('.scrollanime').each(function () {
			const targetPosition = $(this).offset().top;
			if(scrollAmount > targetPosition - wHeight + 100) {
				$(this).addClass("fadeInDown");
			}
		});
	});
});
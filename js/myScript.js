/* --------------------------------------------------
	ページトップへ戻る
-------------------------------------------------- */
$(function(){


	var $btn = $('#toPageTop a');
	var isHidden = true;
	$btn.hide();
	$(window).scroll(function () {
		if( $(this).scrollTop() > 300 ) {
			if( isHidden ) {
				$btn.stop(true,true).fadeIn();
				isHidden = false;
			}
		} else {
			if( !isHidden ) {
				$btn.stop(true,true).fadeOut();
				isHidden = true;
			}
		}
	});
	$btn.click(function(){
		$('html, body').animate({
			'scrollTop': 0
		}, 900, 'easeInOutExpo');
		return false;
	});
});
/* --------------------------------------------------
	slick
-------------------------------------------------- */
$(function(){
	$('.bnr_slide').slick({
		dots: true,
		infinite: true,
		arrows: true,
		autoplay: true,
		autoplaySpeed: 2000,
	});
});
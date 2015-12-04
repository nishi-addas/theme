/* --------------------------------------------------
	タブからアコーディオンへ
-------------------------------------------------- */
$(function(){
	$('#myTab').tabCollapse();
});
/* --------------------------------------------------
	ページトップへ戻る
-------------------------------------------------- */
$(function() {
    var pageTop = $('#toPageTop');
    pageTop.hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 600) {
            pageTop.fadeIn();
        } else {
            pageTop.fadeOut();
        }
    });
    pageTop.click(function () {
        $('body, html').animate({scrollTop:0}, 500, 'swing');
        return false;
    });
});
/* --------------------------------------------------
	スムーズスクロール
-------------------------------------------------- */
$(function(){
   // data-link="inner"が入っているアンカーをクリックした場合に処理
   $('a[data-link="inner"]').click(function() {
      // スクロールの速度
      var speed = 400; // ミリ秒
      // アンカーの値取得
      var href= $(this).attr("href");
      // 移動先を取得
      var target = $(href == "#" || href == "" ? 'html' : href);
      // 移動先を数値で取得
      var position = target.offset().top;
      // スムーススクロール
      $('body,html').animate({scrollTop:position}, speed, 'swing');
      return false;
   });
});
/* --------------------------------------------------
	郵便番号自動入力
-------------------------------------------------- */
$(function(){
	$('#zip').jpostal({
		postcode : [
			'#zip'
		],
		address : {
			'#pref' : '%3',
			'#city' : '%4%5'
		}
	});
});
<footer>
	<div class="bnr_slide clearfix">
		<div><a href="#"><img src="<?php bloginfo('template_url'); ?>/img/320x100.png"></a></div>
		<div><a href="#"><img src="<?php bloginfo('template_url'); ?>/img/320x100.png"></a></div>
		<div><a href="#"><img src="<?php bloginfo('template_url'); ?>/img/320x100.png"></a></div>
	</div>
	<div class="box-contact">
		<p style="letter-spacing:0;">ホームページ、Webサイトでお困りの方は、ご遠慮なく鹿児島のホームページ、Webサイト制作会社アドダスまでご相談ください。</p>
		<p class="btn-arrow"><a href="#" title="ご相談・お問い合わせ"><i class="fa fa-paper-plane"></i> ご相談・お問い合わせ</a></p>
	</div>
	<div class="company-info">
		<p class="meta">鹿児島のホームページ、Webサイト制作会社</p>
		<p class="name">アドダス</p>
		<p class="phone"><span><i class="fa fa-phone"></i> 099-248-8609</span></p>
		<address>〒892-0816 鹿児島市山下町17-4<br class="visible-xs">第一照国ビル302号</address>
	</div>
	<?php // f_menu
		$args = array(
			'theme_location' => 'f_menu',
			'container' => false,
			'menu_class' => 'clearfix',
		);
		wp_nav_menu($args);
	?>
	<?php // f_sub_menu
		$args = array(
			'theme_location' => 'f_sub_menu',
			'container' => false,
		);
		wp_nav_menu($args);
	?>
	<p class="copy">&copy; ○○○○ all rights reserved.</p>
	<p id="toPageTop"><a href="#wrapper">ページトップへ戻る</a></p>
</footer>
<!-- end of #sb-site --></div>
<?php
    $args = array(
        'theme_location' => 'g_menu1',
        'container' => false,
        'menu_class' => 'menu list-unstyled sb-slidebar sb-right',
        'menu_id' => 'gnav',
    );
    wp_nav_menu($args);
?>
<!-- end of #wrapper --></div>
<?php wp_footer(); ?>
<script src="<?php bloginfo('template_url'); ?>/js/slidebars.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/slick.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/myScript.js"></script>
<script type="text/javascript">
    (function($) {
        $(document).ready(function() {
            $.slidebars();
        });
    }) (jQuery);
</script>
</body>
</html>

<?php get_header(); ?>

<?php
	if(!is_front_page()){
		// ページタイトル
		get_template_part( 'title', 'h2' );
		// コンテンツ
		get_template_part( 'loop', 'post' );
	}
?>

<?php get_footer(); ?>
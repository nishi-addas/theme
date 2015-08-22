<div class="side">

<?php if(!is_front_page() && is_page()): ?>

	<div class="side-box">
	<?php $anc = apt_page_ancestor(); ?>
	<?php
		$children = wp_list_pages('title_li=&child_of='.$anc->ID.'&echo=0');
		if($children):
	?>
	<h4 class="first parent-title"><a href="<?php echo get_page_link($post->post_parent); ?>">
		<?php echo esc_html($anc->post_title); ?>
	</a></h4>
	<ul class="side-list">
		<?php // wp_list_pages(array('include' => $anc->ID, 'title_li' => 0)); ?>
		<?php wp_list_pages(array('child_of' => $anc->ID, 'title_li' => 0, 'depth' => 2)); ?>
	</ul>
	<?php endif; ?>
	</div>
	<?php dynamic_sidebar(sidebar3); ?>

<?php else: ?>

	<div class="side-box">
		<h4 class="first">最近の記事</h4>
		<ul class="news">
			<?php
				$cat_id = apt_category_id();
				query_posts(array('post_type' => 'post', 'posts_per_page' => 5));
				while (have_posts()) : the_post();

						$cat_info = apt_category_info();
			?>
			<li><a href="<?php the_permalink(); ?>"><span class="news_date"><?php the_time('Y.m.d'); ?></span><?php the_title(); ?></a></li>
			<?php endwhile;	wp_reset_query(); ?>
		</ul>
	</div>
	<div class="side-box">
		<h4>カテゴリー</h4>
		<ul class="side-list">
			<?php wp_list_categories(array('title_li' => false, 'hide_empty' => true, 'current_category' => $cat_id, 'show_count' => 1)); ?>
		</ul>
	</div>
	<div class="side-box">
		<h4>過去の記事</h4>
		<ul class="side-list">
			<?php wp_get_archives('type=monthly&limit=12&show_post_count=true'); ?>
		</ul>
	</div>

<?php endif; ?>

</div>

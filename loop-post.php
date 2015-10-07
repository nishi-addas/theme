<?php if(have_posts()): while(have_posts()): the_post(); ?>

<?php // 固定ページ ?>
<?php if(is_page()): ?>

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<div class="NComponents">
			<h1><?php the_title(); ?></h1>
			<?php if(get_the_post_thumbnail()): ?>
				<p class="eyecatch"><?php the_post_thumbnail(); ?></p>
			<?php endif; ?>
			<?php the_content(); ?>
		</div>
	</article>

<?php // 投稿ページ ?>
<?php elseif(is_single()): ?>

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<div class="NComponents">
			<h1><?php the_title(); ?></h1>
			<p class="news_date"><i class="fa fa-calendar"></i> <?php the_time('Y年n月j日'); ?></p>
			<?php if(get_the_post_thumbnail()): ?>
				<p class="eyecatch"><?php the_post_thumbnail(); ?></p>
			<?php endif; ?>
			<?php the_content(); ?>
		</div>
	</article>
	<ul class="pager">
		<li class="previous"><?php previous_post_link('%link', '<i class="fa fa-chevron-left"></i>',true); ?></li>
		<li class="next"><?php next_post_link('%link', '<i class="fa fa-chevron-right"></i>',true); ?></li>
	</ul>

<?php // アーカイブページ ?>
<?php else: ?>

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<div class="row">
			<div class="col-xs-4">
				<?php if(get_the_post_thumbnail()): ?>
					<p><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(300, 225)); ?></a></p>
				<?php else: ?>
					<p><a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/dammy_thumb.gif" alt="<?php the_title(); ?>"></a></p>
				<?php endif; ?>
			</div>
			<div class="col-xs-8">
				<?php $cat_info = apt_category_info(); ?>
				<p class="date"><i class="fa fa-calendar"></i> <?php the_time('Y年n月j日'); ?> <?php echo esc_html($cat_info->name); ?></p>
				<h1>
					<?php
						// 文字数が25文字より多いならば三点リーダーを付ける
						if( mb_strlen( $post->post_title, 'UTF-8' ) > 25) {
							$title = mb_substr( $post->post_title, 0, 25, 'UTF-8' );
							echo $title . '…' ;
						// 文字数が25文字以下ならば三点リーダーは付けない
						} else {
							echo $post->post_title;
						}
					?>
				</h1>
				<p class="more"><a href="<?php the_permalink(); ?>"><i class="fa fa-arrow-right"></i> この記事を読む</a></p>
			</div>
		</div>
	</article>

<?php endif; ?>

<?php endwhile; endif; ?>
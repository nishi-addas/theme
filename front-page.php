<?php get_header(); ?>

<?php // スライドショー ?>
<?php echo do_shortcode("[metaslider id=39]"); ?>
<?php // キャッチコピー ?>
<div class="container">
    <p class="icon text-center"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></p>
    <p class="lead text-center">ここにはキャッチコピーの文章が入ります。</p>
    <p class="text-center">ここには文章が入ります。ここには文章が入ります。ここには文章が入ります。ここには文章が入ります。ここには文章が入ります。ここには文章が入ります。ここには文章が入ります。</p>
    <div class="row catch">
        <div class="col-sm-6 pdlf"><a href="#"><img src="<?php bloginfo('template_url'); ?>/img/480x400.png" alt=""></a></div>
        <div class="col-sm-6 pdlf"><a href="#"><img src="<?php bloginfo('template_url'); ?>/img/480x400.png" alt=""></a></div>
    </div>
</div>
<?php // 最新記事5件表示 ?>
<div class="midasi clearfix">
    <h3><i class="fa fa-newspaper-o"></i> おしらせ</h3>
    <p><a href="<?php echo get_permalink(get_page_by_path('news')); ?>">一覧を見る</a></p>
</div>
<?php
    // $paged = get_query_var('paged');
    $num = 5;
    // query_posts('posts_per_page='.$num.'&paged='.$paged);
    query_posts('posts_per_page='.$num);
    if ( have_posts() ) :
        echo '<ul class="list-unstyled">';
        while ( have_posts() ) : the_post();
            get_template_part( 'loop', 'index' );
        endwhile;
        echo '</ul>';
    else :
        echo '<p>現在、記事はありません。</p>';
    endif;
    wp_reset_query();
?>
<?php get_footer(); ?>
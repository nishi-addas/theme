<?php

// 外部のjQueryを読み込む
function load_cdn() {
    if ( !is_admin() ) {
        wp_deregister_script('jquery');
		wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), '1.11.1');
		wp_deregister_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-core','//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js', array(), '1.11.1');
		wp_deregister_script('bootstrap');
		wp_enqueue_script('bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', array(), '');
		wp_deregister_script('ajaxzip3');
		wp_enqueue_script('wpcf7-ajaxzip3','//ajaxzip3.github.io/ajaxzip3.js', array(), '');
    }
}
add_action('init', 'load_cdn');
// カスタムメニュー
//	register_nav_menu( 'g_menu1', 'グローバルナビ1' );
//	register_nav_menu( 'g_menu2', 'グローバルナビ2' );
//	register_nav_menu( 'g_menu3', 'グローバルナビ3' );
//	register_nav_menu( 'f_menu', 'フッターメニュー' );
//	register_nav_menu( 'f_sub_menu', 'フッターサブメニュー' );
//	register_nav_menu( 'g_menu_sp', 'スマホメニュー' );
//	register_nav_menu( 'list_menu_sp', 'スマホリスト' );
add_theme_support( 'menus' );
if ( !is_nav_menu('header_navi') || !is_nav_menu('footer_navi') ) {
	$menu_id1 = wp_create_nav_menu('header_navi');
	$menu_id2 = wp_create_nav_menu('footer_navi');
	wp_update_nav_menu_item($menu_id1, 1);
	wp_update_nav_menu_item($menu_id2, 1);
}
// 管理画面の記事/固定ページ一覧のテーブルにIDの列を加える
add_filter('manage_posts_columns', 'posts_columns_id', 5);
add_action('manage_posts_custom_column', 'posts_custom_id_columns', 5, 2);
add_filter('manage_pages_columns', 'posts_columns_id', 5);
add_action('manage_pages_custom_column', 'posts_custom_id_columns', 5, 2);
function posts_columns_id($defaults){
	$defaults['wps_post_id'] = __('ID');
	return $defaults;
}
function posts_custom_id_columns($column_name, $id){
	if($column_name === 'wps_post_id'){
		echo $id;
	}
}
// エディタのスタイルシート
add_editor_style('editor-style.css');
// アイキャッチ画像を使えるようにする
add_theme_support( 'post-thumbnails' );
// メディアサイズの追加
add_image_size( photo300225, 300, 225, true );
// 投稿一覧にアイキャッチを表示
function add_thumbnail_column( $columns ) {
	$post_type = isset( $_REQUEST['post_type'] ) ? $_REQUEST['post_type'] : 'post';
		if ( post_type_supports( $post_type, 'thumbnail' ) ) {
			$columns['thumbnail'] = __( 'Featured Images' );
		}
		return $columns;
}
function display_thumbnail_column( $column_name, $post_id ) {
	if ( $column_name == 'thumbnail' ) {
		if ( has_post_thumbnail( $post_id ) ) {
			echo get_the_post_thumbnail( $post_id, array( 50, 50 ) );
		} else {
			_e( 'none' );
		}
	}
}
add_filter( 'manage_posts_columns', 'add_thumbnail_column' );
add_action( 'manage_posts_custom_column', 'display_thumbnail_column', 10, 2 );
//  記事抜粋を表示する
function change_excerpt_mblength($length) {
    return 30;
}
add_filter('excerpt_mblength', 'change_excerpt_mblength');

function new_excerpt_more($more) {
    return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');
// 記事内の最初の画像を取得する
// echo catch_that_image(); でソースを出力する
function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];
	if(empty($first_img)){ //Defines a default image
        $first_img = "./img/dammy-thumb.gif";
    }
    return $first_img;
}
// ウィジェット
if (function_exists('register_sidebar')) {
	register_sidebar( array(
	    'name' => __( '広告エリア' ),
	    'id' => 'ad_widget',
	    'before_widget' => '<li class="widget-container ad_widget">',
	    'after_widget' => '</li>',
	    'before_title' => '<h3 class="ad_widget">',
	    'after_title' => '</h3>',
	));
	register_sidebar( array(
	    'name' => __( '人気の記事' ),
	    'id' => 'ppost_widget',
	    'before_widget' => '<li class="widget-container ppost_widget">',
	    'after_widget' => '</li>',
	    'before_title' => '<h3 class="ppost_widget">',
	    'after_title' => '</h3>',
	));
	register_sidebar( array(
	    'name' => __( '新着記事' ),
	    'id' => 'rentry_widget',
	    'before_widget' => '<li class="widget-container rentry_widget">',
	    'after_widget' => '</li>',
	    'before_title' => '<h3 class="rentry_widget">',
	    'after_title' => '</h3>',
	));
	register_sidebar( array(
	    'name' => __( 'カテゴリー' ),
	    'id' => 'category_widget',
	    'before_widget' => '<li class="widget-container category_widget">',
	    'after_widget' => '</li>',
	    'before_title' => '<h3 class="category_widget">',
	    'after_title' => '</h3>',
	));
	register_sidebar( array(
	    'name' => __( 'キーワード検索' ),
	    'id' => 'search_widget',
	    'before_widget' => '<li class="widget-container search_widget">',
	    'after_widget' => '</li>',
	    'before_title' => '<h3 class="search_widget">',
	    'after_title' => '</h3>',
	));
	register_sidebar( array(
	    'name' => __( 'エディタについて' ),
	    'id' => 'about_widget',
	    'before_widget' => '<li class="widget-container about_widget">',
	    'after_widget' => '</li>',
	    'before_title' => '<h3 class="about_widget">',
	    'after_title' => '</h3>',
	));
	register_sidebar( array(
	    'name' => __( 'Side Widget' ),
	    'id' => 'side-widget',
	    'before_widget' => '<li class="widget-container">',
	    'after_widget' => '</li>',
	    'before_title' => '<h3>',
	    'after_title' => '</h3>',
	));
	// フッターエリアのウィジェット
	register_sidebar( array(
	    'name' => __( 'Footer Widget' ),
	    'id' => 'footer-widget',
	    'before_widget' => '<div class="widget-area"><ul><li class="widget-container">',
	    'after_widget' => '</li></ul></div>',
	    'before_title' => '<h3>',
	    'after_title' => '</h3>',
	));
}
// bodyとpost classにカテゴリー名ポストクラス名をclass名として追加する
function category_id_class($classes) {
	global $post;
	foreach((get_the_category($post->ID)) as $category)
		$classes[] = $category->category_nicename;
	return $classes;
}
add_filter('post_class', 'category_id_class');
add_filter('body_class', 'category_id_class');
// 投稿数をaタグ内に表記
add_filter( 'wp_list_categories', 'my_list_categories', 10, 2 );
function my_list_categories( $output, $args ) {
	$output = preg_replace('/<\/a>\s*\((\d+)\)/',' ($1)</a>',$output);
	return $output;
}
add_filter( 'get_archives_link', 'my_archives_link' );
function my_archives_link( $output ) {
	$output = preg_replace('/<\/a>\s*(&nbsp;)\((\d+)\)/',' ($2)</a>',$output);
	return $output;
}
/*
* PCとスマフォ向けの出し分け
*/
function is_mobile(){
	$useragents = array(
		'iPhone',          // iPhone
		'iPod',            // iPod touch
		'Android',         // 1.5+ Android
		'dream',           // Pre 1.5 Android
		'CUPCAKE',         // 1.5+ Android
		'blackberry9500',  // Storm
		'blackberry9530',  // Storm
		'blackberry9520',  // Storm v2
		'blackberry9550',  // Storm v2
		'blackberry9800',  // Torch
		'webOS',           // Palm Pre Experimental
		'incognito',       // Other iPhone browser
		'webmate'          // Other iPhone browser
	);
	$pattern = '/'.implode('|', $useragents).'/i';
	return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}
/*
	<?php if (is_mobile()) :?>
		スマートフォン向けの内容
	<?php else: ?>
		PC向けの内容
	<?php endif; ?>
*/
/*
* アーカイブページで現在のカテゴリー・タグ・タームを取得する
*/
function get_current_term(){
	$id;
	$tax_slug;
	if(is_category()){
		$tax_slug = "category";
		$id = get_query_var('cat');
	}else if(is_tag()){
		$tax_slug = "post_tag";
		$id = get_query_var('tag_id');
	}else if(is_tax()){
		$tax_slug = get_query_var('taxonomy');
		$term_slug = get_query_var('term');
		$term = get_term_by("slug",$term_slug,$tax_slug);
		$id = $term->term_id;
	}
	return get_term($id,$tax_slug);
}
/*
	<?php $cat_info = get_current_term(); ?>
	<span class="news_category <?php echo esc_attr($cat_info->slug); ?>"><?php echo esc_html($cat_info->name); ?></span>
*/
// 最上位の固定ページ情報を取得する
function apt_page_ancestor() {
	global $post;
	$anc = array_pop(get_post_ancestors($post));
	$obj = new stdClass;
	if ($anc) {
		$obj->ID = $anc;
		$obj->post_title = get_post($anc)->post_title;
	} else {
		$obj->ID = $post->ID;
		$obj->post_title = $post->post_title;
	}
	return $obj;
}
// カテゴリIDを取得する。
function apt_category_id($tax='category') {
	global $post;
	$cat_id = 0;
	if (is_single()) {
		$cat_info = get_the_terms($post->ID, $tax);
		if ($cat_info) {
			$cat_id = array_shift($cat_info)->term_id;
		}
	}
	return $cat_id;
}
// カテゴリ情報を取得する。
function apt_category_info($tax='category') {
	global $post;
	$cat = get_the_terms($post->ID, $tax);
	$obj = new stdClass;
	if ($cat) {
		$cat = array_shift($cat);
		$obj->name = $cat->name;
		$obj->slug = $cat->slug;
	} else {
		$obj->name = '';
		$obj->slug = '';
	}
	return $obj;
}
// wp-bootstrap-navwalker を読み込む
require_once('wp_bootstrap_navwalker.php');
// 投稿画面カスタマイズ
function tinymce_delete_buttons( $array ) {
	$array = array_diff($array, $array);
	return $array;
}
add_filter( 'mce_buttons', 'tinymce_delete_buttons' );
function tinymce_delete_buttons_2( $array ) {
	$array = array_diff($array, $array);
	return $array;
}
add_filter( 'mce_buttons_2', 'tinymce_delete_buttons_2' );
function et_print_styles() {
	echo '<style TYPE="text/css">#qt_content_block,#qt_content_ins,#qt_content_code{display:none !important;}</style>';
}
add_action('admin_print_styles', 'et_print_styles', 21);
class newMceButton {
	function newMceButton() {
		add_action('init', array(&$this, 'addbuttons'));
	}
	function sink_hooks(){
		add_filter('mce_plugins', array(&$this, 'mce_plugins'));
	}
	function addbuttons() {
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
			if ( get_user_option('rich_editing') == 'true') {
				add_filter('mce_external_plugins', array(&$this, 'mce_external_plugins'));
				add_filter('mce_buttons', array(&$this, 'mce_buttons'));
				add_filter('mce_buttons_2', array(&$this, 'mce_buttons2'));
			}
	}
	function mce_external_plugins($plugin_array) {
		$plugin_array['ncs'] = get_bloginfo('template_url') .'/js/editer_plugin.js';
		return $plugin_array;
	}
	function mce_buttons($buttons) {
		array_push($buttons,'bold','italic','strikethrough','underline','link','unlink','bullist','numlist','section','lHeading','mHeading','sHeading','note','labels','imgStyle','quotation','buttons','undo','redo','wp_adv');
		return $buttons;
	}
	function mce_buttons2($buttons) {
		array_push($buttons,'navis','breadcrumbs','paginations','pagers','imgCenter','imgLeft','imgRight','imgLeftSet','imgRightSet','imgExplain','columns','panelBox','alertBox','_listBox','tableSample','table','nforecolor','nbackcolor','bgcolor');
		return $buttons;
	}
}
$mybutton = new newMceButton();
add_action('init',array(&$mybutton, 'newMceButton'));
add_editor_style('css/editor-style.min.css');
function custom_editor_settings( $initArray ){
	$initArray['body_class'] = 'NComponents';
	return $initArray;
}
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );
// ログイン画面のWordPressのロゴを変える
function my_custom_login_logo() {
    echo '<style type="text/css">h1 a { background-image:url(ここにアップロードした画像のパスを入力してください。) !important; }</style>';
}
add_action('login_head', 'my_custom_login_logo');
// wp_list_pagesで取得したリストのクラスにスラッグを追加
function my_page_css_class( $css_class, $page ) {
	$css_class[] = 'list-group-item';
	return $css_class;
}
add_filter( 'page_css_class', 'my_page_css_class', 10, 2 );
// 設定 > カスタムから編集する
add_action( 'customize_register', 'theme_customize_register' );
function theme_customize_register($wp_customize) {
    $wp_customize->add_section( 'addas_section', array(
        'title' =>'会社情報編集',
        'priority' => 100,
    ));
	// セクションの設定を追加
	$wp_customize->add_setting('addas_options[address]', array(
	   'type' => 'option',
	));
	// 管理画面で表示する設定
	$wp_customize->add_control( 'addas_textarea_address', array(
	    'settings' => 'addas_options[address]',
	    'label' =>'フッター住所',
	    'section' => 'addas_section',
	    'type' => 'text',
	));
	// セクションの設定を追加
	$wp_customize->add_setting('addas_options[copy]', array(
	   'type' => 'option',
	));
	// 管理画面で表示する設定
	$wp_customize->add_control( 'addas_textarea_copy', array(
	    'settings' => 'addas_options[copy]',
	    'label' =>'コピーライト',
	    'section' => 'addas_section',
	    'type' => 'text',
	));
}
// 投稿のカテゴリー選択をラジオボタンに変更
function my_print_footer_scripts() {
echo "<script type='text/javascript'>
jQuery(document).ready(function($){
    var checkLists = $('#categorychecklist').find('li');
    var cnt = 0;
    checkLists.each(function(){
        var check = $(this).find('input');
        var input = $('<input>');
        input.attr({
            type: 'radio',
            id: check.attr('id'),
            name: check.attr('name'),
            value: check.val()
        });
        if($(this).hasClass('popular-category') && cnt === 0){
           input.prop('checked', true);
           cnt++
        }
        input.insertBefore(check);
        check.remove();
    });
});
</script>";
}
add_action('admin_print_footer_scripts', 'my_print_footer_scripts', 21);
// WordPressのWP-Pagenaviが返すHTMLをTwitter Bootstrapに合ったものに変更する
	add_filter( 'wp_pagenavi', function($html){
	$html = trim(preg_replace('/<\/?div([^>]*)?>/u', '', $html));
	$html = preg_replace('/(<a[^>]*>[^<]*<\/a>)/u', '<li>$1</li>', $html);
	$html = preg_replace_callback('/<span([^>]*?)>[^<]*<\/span>/u', function($matches){
        if( false !== strpos($matches[1], 'current') ){
        	$class_name = 'active';
        }elseif( false !== strpos($matches[1], 'pages') ){
        	$class_name = 'disabled';
        }elseif( false !== strpos($matches[1], 'extend') ){
        	$class_name = 'disabled';
        }else{
        	$class_name = '';
        }
        return "<li class=\"{$class_name}\">{$matches[0]}</li>";
    }, $html);
    return <<<HTML
<div class="row text-center"><ul class="pagination pagination-centered">{$html}</ul></div>
HTML;
}, 10, 2 );
//パーマリンクカテゴリ削除
add_filter('user_trailingslashit', 'remcat_function');
function remcat_function($link) {
    return str_replace("/category/", "/", $link);
}
add_action('init', 'remcat_flush_rules');
function remcat_flush_rules() {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
add_filter('generate_rewrite_rules', 'remcat_rewrite');
function remcat_rewrite($wp_rewrite) {
    $new_rules = array('(.+)/page/(.+)/?' => 'index.php?category_name='.$wp_rewrite->preg_index(1).'&paged='.$wp_rewrite->preg_index(2));
    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}

?>

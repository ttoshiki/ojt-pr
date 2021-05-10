<?php
function remove_wp_open_sans() {
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', false );
}
add_action('wp_enqueue_scripts', 'remove_wp_open_sans');
add_action('admin_enqueue_scripts', 'remove_wp_open_sans');

//remove_filter (  'the_content' ,  'wpautop'  );
//remove_filter (  'the_excerpt' ,  'wpautop'  );
//remove_filter( 'comment_text', 'wpautop',  30 );
//remove_filter('the_content', 'balanceTags');
//remove_filter('the_content', 'wptexturize');


add_theme_support( 'post-thumbnails' );
//add_image_size('size-news',240,175,true);
//set_post_thumbnail_size( 650, 160, true );

/**
* get page name
**/
function getPageName(){
	if(is_page()){
		$pageId = get_the_ID();
		$curPage = get_page($pageId);
		$curPageParent = $curPage->post_parent;
		if($curPageParent == 0){
			$pname = $curPage->post_name;
		}else{
			$pname = get_page(get_top_parent_page_id())->post_name;
		}
	}
	else if(is_post_type_archive('staff') || is_singular('staff') || is_tax('staffcat') ){
		$pname = 'staff';
	}
	else if(is_category() || is_single() || is_search()){
		$pname = 'news';
	}else{
        $pname ='';
    }
	return $pname;
}

function get_top_parent_page_id() {
    global $post;
    $ancestors = $post->ancestors;
    if ($ancestors) {
        return end($ancestors);
    } else {
        return $post->ID;
    }
}

function get_term_link_by($field,$value,$taxonomy){
	$term=get_term_by($field,$value,$taxonomy);
	$term_id=$term->term_id;

	$link=get_term_link($term_id,$taxonomy);
	echo $link;
}

function get_term_name_by($field,$value,$taxonomy){
	$term=get_term_by($field,$value,$taxonomy);
	echo $term->name;
}

function get_term_link_by_postid($id,$taxonomy){
	$terms = wp_get_object_terms($id,$taxonomy);
	foreach( $terms as $term ) {
		//print_r($term);
		$termid = $term->term_id;
		//print_r( $termid);
	}
	$link=get_term_link($termid,$taxonomy);
	return $link;
}

add_shortcode('termlink', function($attr){
	return get_term_link_by_postid($attr['id'],$attr['taxonomy']);
	//return ob_get_clean();
});

//[termlink id="" taxonomy=""]

function needRemoveP() {
	remove_filter('the_content', 'wpautop');
}

//add_filter('wpcf7_autop_or_not', '__return_false');

//add_action ('loop_start', 'needRemoveP');

function curPageURL() {
	$pageURL = 'http';
	if (isset($_SERVER["HTTPS"]) == "on") {
		$pageURL .= "s";
	}
	$pageURL .= "://";
	/*if ($_SERVER["SERVER_PORT"] != "80"){
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	}else{
		$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}*/
	$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	return $pageURL;
}

/**
 * shortcode
 */
function template_src() {
    return get_bloginfo('template_url');
}

function template_url() {
    return get_bloginfo('url');
}

add_shortcode('src', 'template_src');
add_shortcode('url', 'template_url');
if(function_exists('wpcf7_add_form_tag') ) {
	wpcf7_add_form_tag("src","template_src");
	wpcf7_add_form_tag("url","template_url");
}

add_shortcode('add_part', function($attr){
	ob_start();
	get_template_part($attr['part']);
	return ob_get_clean();
});

//[add_part part=""]

//excerpt
function get_excerpt($count){
	$content = get_the_content();
	$trimmed_content = wp_trim_words( $content, $count, '...' );
	echo $trimmed_content;
}

//★★★archive・category・taxonomyでのterm取得★★★
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

function mytheme_enqueue_login_style() {
    wp_enqueue_style( 'mytheme-options-style', get_template_directory_uri() . '/login.css' );
}
add_action( 'login_enqueue_scripts', 'mytheme_enqueue_login_style' );

/*
   Debug preview with custom fields
*/

function get_preview_id($postId) {
    global $post;
    $previewId = 0;
    if ( isset($_GET['preview'])
            && ($post->ID == $postId)
                && $_GET['preview'] == true
                    &&  ($postId == url_to_postid($_SERVER['REQUEST_URI']))
        ) {
        $preview = wp_get_post_autosave($postId);
        if ($preview != false) { $previewId = $preview->ID; }
    }
    return $previewId;
}

add_filter('get_post_metadata', function($meta_value, $post_id, $meta_key, $single) {
    if ($preview_id = get_preview_id($post_id)) {
        if ($post_id != $preview_id) {
            $meta_value = get_post_meta($preview_id, $meta_key, $single);
        }
    }
    return $meta_value;
}, 10, 4);

add_action('wp_insert_post', function ($postId) {
    global $wpdb;
    if (wp_is_post_revision($postId)) {
        if (isset($_POST['fields']) && count($_POST['fields']) != 0) {
            foreach ($_POST['fields'] as $key => $value) {
                $field = get_field($key);
                if ( !isset($field['name']) || !isset($field['key']) ) continue;
                if (count(get_metadata('post', $postId, $field['name'], $value)) != 0) {
                    update_metadata('post', $postId, $field['name'], $value);
                    update_metadata('post', $postId, "_" . $field['name'], $field['key']);
                } else {
                    add_metadata('post', $postId, $field['name'], $value);
                    add_metadata('post', $postId, "_" . $field['name'], $field['key']);
                }
            }
        }
        do_action('save_preview_postmeta', $postId);
    }
});

function custom_pre_get_posts( $query ) {
    if ( is_admin() )
        return;

    if ( $query->is_category() && $query->is_main_query() ) {
         $query->set( 'posts_per_page', -1 );
         return;
    }
}
add_action('pre_get_posts', 'custom_pre_get_posts');
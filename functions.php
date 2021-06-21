<?php
function remove_wp_open_sans() {
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', false );

    if(is_front_page()) {
        wp_enqueue_style('fullcalendar-style', get_template_directory_uri() . '/css/lib/fullcalendar/main.min.css', array(), '');
        wp_style_add_data('fullcalendar-style', 'rtl', 'replace');
        wp_enqueue_script('fullcalendar-script', get_template_directory_uri() . '/js/lib/fullcalendar/main.min.js', array(), '', true);
        wp_enqueue_script('calendar-script', get_template_directory_uri() . '/js/calendar.js', array(), '1.0.2', true);
        wp_enqueue_script('date-fns-script', 'https://cdnjs.cloudflare.com/ajax/libs/date-fns/1.28.5/date_fns.min.js', array(), '', false);
    }

    if(is_page('login')) {
        wp_enqueue_style( 'mytheme-options-style', get_template_directory_uri() . '/login.css' );
    }
}
add_action('wp_enqueue_scripts', 'remove_wp_open_sans');
add_action('admin_enqueue_scripts', 'remove_wp_open_sans');

/**
 * Enqueue scripts and styles.
 */
function ojt_pr_scripts()
{
    wp_enqueue_style('ojt-pr-style', get_stylesheet_uri(), array(), '1.0.3');
    wp_style_add_data('ojt-pr-style', 'rtl', 'replace');
}
add_action('wp_enqueue_scripts', 'ojt_pr_scripts');

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

/**
 * 会員登録の処理をまとめた関数
 */
function my_user_signup()
{
    $user_name  = isset($_POST['user_name']) ? sanitize_text_field($_POST['user_name']) : '';
    $user_pass  = isset($_POST['user_pass']) ? sanitize_text_field($_POST['user_pass']) : '';
    $user_email = isset($_POST['user_email']) ? sanitize_text_field($_POST['user_email']) : '';

    //空じゃないかチェック
    if (empty($user_name) || empty($user_pass) || empty($user_email)) {
        echo '情報が不足しています。';
        exit;
    }

    //すでにユーザー名が使われていないかチェック
    $user_id = username_exists($user_name);
    if ($user_id !== false) {
        echo 'すでにユーザー名「'. $user_name .'」は登録されています';
        exit;
    }

    //すでにメールアドレスが使われていないかチェック
    $user_id = email_exists($user_email);
    if ($user_id !== false) {
        echo 'すでにメールアドレス「'. $user_email .'」は登録されています';
        exit;
    }

    //問題がなければユーザーを登録する処理を開始
    $userdata = array(
        'user_login' => $user_name,       //  ログイン名
        'user_pass'  => $user_pass,       //  パスワード
        'user_email' => $user_email,      //  メールアドレス
    );
    $user_id = wp_insert_user($userdata);

    // ユーザーの作成に失敗した場合
    if (is_wp_error($user_id)) {
        echo $user_id -> get_error_code(); // WP_Error() の第一引数
        echo $user_id -> get_error_message(); // WP_Error() の第二引数
        exit;
    }

    //登録完了後、そのままログインさせる（ 任意 ）
    wp_set_auth_cookie($user_id, false, is_ssl());

    //登録完了ページへ
    wp_redirect('/complete');
    exit;

    return;
}

/**
 * after_setup_theme に処理をフック
 */
add_action('after_setup_theme', function () {

    //会員登録フォームからの送信があるかどうか
    if (isset($_POST['my_submit']) && $_POST['my_submit'] === 'signup') {

        // nonceチェック
        if (!isset($_POST['my_nonce_name'])) {
            return;
        }
        if (!wp_verify_nonce($_POST['my_nonce_name'], 'my_nonce_action')) {
            return;
        }

        // 登録処理を実行
        my_user_signup();
    }
});

function update_user_authority() {
    function datetime_diff_month(DateTime $d1, DateTime $d2, $absolute = false){
        $diff_month = ($d2->format('Y')*12 + $d2->format('n')) - ($d1->format('Y')*12 + $d1->format('n'));
        return $absolute ? abs($diff_month) : $diff_month;
    }
    $users = get_users();
    $today = new DateTime();
    $membership_period_month = 12;
    foreach ($users as $user) {
        $registered_datetime = new DateTime($user->user_registered);
        $datetime_jp = $registered_datetime->modify('+9 hours');
        $since_registration_month = datetime_diff_month($registered_datetime, $today);
        if ($since_registration_month >= $membership_period_month) {
            $user->remove_role('contributor'); // 寄稿者
            $user->add_role('subscriber'); // 購読者
        }
    }
}
add_action ( 'update_user_authority_cron', 'update_user_authority' );

// cron登録処理
if ( !wp_next_scheduled( 'update_user_authority_cron' ) ) {  // 何度も同じcronが登録されないように
    date_default_timezone_set('Asia/Tokyo');  // タイムゾーンの設定
    wp_schedule_event( time(), 'daily', 'update_user_authority_cron' );
}

// パスワード変更時のメール
function custom_password_change_email( $pass_change_email ) {
    $subject = '【' . get_option( 'blogname' ) . '】 パスワード変更';
    $message = '###USERNAME### さんのパスワードが変更されました。' . "\n";
    $message .= 'これはパスワード変更時に該当ユーザーのメールアドレス宛に送信されます。';

    $pass_change_email['subject'] = $subject;
    $pass_change_email['message'] = $message;
    return $pass_change_email;
}
add_filter( 'password_change_email', 'custom_password_change_email' );


function custom_pre_get_posts( $query ) {
    if ( is_admin() || ! $query -> is_main_query() ) return;

    if ( $query -> is_category() ) {
    $query -> set( 'posts_per_page', '-1' );
    }
}
add_action( 'pre_get_posts', 'custom_pre_get_posts' );
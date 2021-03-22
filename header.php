<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta property="og:image" content="<?php bloginfo('template_url');?>/ogp.jpg">
<link rel="icon" type="image/gif" href="<?php bloginfo('template_url');?>/favicon.ico">
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', '' ), max( $paged, $page ) );

	?></title>
<link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet" type="text/css">
<?php wp_head(); ?>
</head>
<body <?php if(is_home() || is_front_page()) {?>class="top"<?php } elseif(is_page('login')){?> class="login"<?php } else{ ?>class="seminar"<?php } ?>>
<div id="container">
<?php if(is_home() || is_front_page()) {?>
	<header class="headerBox">
		<div class="innerBox">
			<h1><a href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_url');?>/img/common/logo.png" alt="OJT式PR塾" width="265"></a></h1>
			<h2>
				<picture>
				  <source media="(max-width: 896px)" srcset="<?php bloginfo('template_url');?>/img/index/sp_h2_img.png">
				  <img src="<?php bloginfo('template_url');?>/img/index/h2_img.png" alt="あなたのPR力が、未来を変える。" width="926">
				</picture>
			</h2>
			<ul class="comBtnUl">
				<li><a href="<?php bloginfo('url');?>/seminar/pr%E8%A8%AD%E8%A8%88%E7%B7%A8"><img src="<?php bloginfo('template_url');?>/img/common/icon01.png" alt="動画教材一覧" width="45">動画教材一覧</a></li>
				<li><a href="https://ojtpr.slack.com" target="_blank"><img src="<?php bloginfo('template_url');?>/img/common/icon02.png" alt="PR塾専用slack" width="45">PR塾専用slack</a></li>
			</ul>
		</div>
	</header>
<?php }elseif(!is_page('login')){ ?>
	<header id="gHeader">
		<div class="hBox">
			<h1><a href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_url');?>/img/common/logo.png" alt="OJT式PR塾" width="265"></a></h1>
			<ul class="comBtnUl pc">
				<li><a href="<?php bloginfo('url');?>/seminar/pr%E8%A8%AD%E8%A8%88%E7%B7%A8"><img src="<?php bloginfo('template_url');?>/img/common/icon01.png" alt="動画教材一覧" width="45">動画教材一覧</a></li>
				<li><a href="https://ojtpr.slack.com" target="_blank"><img src="<?php bloginfo('template_url');?>/img/common/icon02.png" alt="PR塾専用slack" width="45">PR塾専用slack</a></li>
			</ul>
		</div>
		<div class="menu sp"><img src="<?php bloginfo('template_url');?>/img/common/menu.png" alt="menu" width="64"></div>
	</header>
	<div class="menuBox">
		<div class="close"><img src="<?php bloginfo('template_url');?>/img/common/close.png" alt="close" width="32"></div>
		<div class="innerBox">
			<ul class="naviUl">
				<li><a href="<?php bloginfo('url');?>">トップページ</a></li>
				<?php
					$args = array(
						'hide_empty'=> false,
						'parent'=> 1
					);
					$allterms = get_categories($args);
					$count = count($allterms);
					if($count > 0){
						foreach ($allterms as $allterm) {
							$alltermlink=get_category_link($allterm->term_id);
							$alltermname=$allterm->name;
							if ($alltermname != 'その他'){
							?>
								<li><a href="<?php echo $alltermlink ?>"><?php echo $alltermname; ?></a></li>
							<?php }
						}
					}
				?>
				<li><a href="<?php bloginfo('url');?>/schedule">OJT式PR塾スケジュール</a></li>
				<li><a href="https://ojtpr.slack.com" target="_blank"><img src="<?php bloginfo('template_url');?>/img/common/icon02.png" alt="PR塾専用slack" width="30">PR塾専用slack</a></li>
			</ul>
		</div>
	</div>
<?php } ?>
	<main role="main">
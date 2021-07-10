<?php get_header();
$cat = get_queried_object();
$catID = $cat->term_id;
?>
	  <div id="pagePath" class="pc">
			<ul>
				<li><a href="<?php bloginfo('url');?>">OJT式PR塾の進め方</a>／</li>
				<li><?php echo $cat->cat_name ?></li>
			</ul>
		</div>
		<div class="content">
			<section class="seminarBox">
				<h2 class="headline02"><span><?php echo $cat->cat_name ?></span></h2>
				<div class="wrapper">
					<article id="conts">
					<?php
						$user_data = get_userdata(get_current_user_id());
						$registered = $user_data->user_registered;
						var_dump($registered);
						if (have_posts()):?>
						<ul class="comList">
						<?php while (have_posts()) : the_post(); ?>
							<li>
								<a href="<?php the_permalink();?>">
									<div class="category-title-block">
									<?php
										if (!is_category('news')){
											$today = new DateTime();
											$post_day = new DateTime(get_the_date('Y-m-d'));
											$display_new_mark_days = 7;
											$after_posting_days = $post_day->diff($today)->days;
											if ($display_new_mark_days >= $after_posting_days) {
									?>
										<span class="new_mark">NEW</span>
											<?php }
										}
									?>
										<h2 class="post-headline"><?php the_title(); ?></h2>
									</div>
									<div class="imgBox">
										<div class="photo" style="background-image: url(<?php if (has_post_thumbnail()) {
											echo get_the_post_thumbnail_url($post->ID, 'full');
										} else {
											echo get_bloginfo('template_url').'/img/common/no-img.jpg';
										}?>);">
										<?php foreach (get_the_category() as $category) {
											if ($category->parent != 0) {
												echo '<span class="lable">'.$category->cat_name.'</span>';
											}
										}?>
										</div>
										<div class="textBox">
											<p><?php echo get_excerpt(100);?></p>
										</div>
									</div>
								</a>
							</li>
						<?php endwhile;?>
						</ul>
					<?php endif;?>
					</article>
					<aside id="sideBar">
						<ul class="sideUl">
							<?php
								if (current_user_can('contributor') || current_user_can('administrator')) {
									$args = array(
										'hide_empty'=> false,
										'parent'=> 1
										// 'parent'=> 2 // テスト環境
										// 'parent'=> 3 // ローカル環境
									);
								} elseif (current_user_can('subscriber')) {
									$args = array(
										'hide_empty'=> false,
										'parent'=> 1,
										// 'parent'=> 2, // テスト環境
										// 'parent'=> 3, // ローカル環境

										'exclude' => array( 12, 15 ) // 本番環境 生講義の過去動画・最新追加動画
										// 'exclude' => array( 13, 14 ) // テスト環境 生講義の過去動画・最新追加動画
										// 'exclude' => array( 10, 16 ) // ローカル環境 生講義の過去動画・最新追加動画
									);
								}
								$allterms = get_categories($args);
								$count = count($allterms);
								if($count > 0) {
									foreach ($allterms as $allterm) {
										$alltermlink=get_category_link($allterm->term_id);
										$alltermname=$allterm->name;
										if ($alltermname != 'その他'){
									?>
								<li <?php if($catID == $allterm->term_id){?>class="on"<?php } ?>><a href="<?php echo $alltermlink ?>"><span><?php $text = get_field('ff_text','category_'.$allterm->term_id); if($text){echo $text;}else{echo $alltermname;}; ?></span></a></li>
											<?php }
										}
									}
								?>
						</ul>
					</aside>
				</div>
			</section>
		</div>

<div style="background-color: #fff">
		<?php
	$taxonomy_name = 'category';
	$term_id = get_queried_object_id();
	$children = get_term_children( $term_id, $taxonomy_name );
	$taxonomies = get_terms($taxonomy_name, array(
		'parent' => $term_id
	));
	if(!is_wp_error($taxonomies) && count($taxonomies)):

	foreach($taxonomies as $taxonomy):
	$tax_posts = get_posts(array('post_type' => get_post_type(), 'taxonomy' => $taxonomy_name,
	'term' => $taxonomy->slug ) );
	foreach($tax_posts as $hoge){
		var_dump($hoge->post_date);
		// 投稿日が会員登録から12ヶ月後より前だったらフラグを1にする
	}
	if($tax_posts):
?>

<h2 style="font-size: 24px;"><?php echo esc_html($taxonomy->name); ?></h2>
<ul>

<?php
foreach($tax_posts as $tax_post):
?>
<li>
<a href="<?php echo get_permalink($tax_post->ID); ?>">
<figure>
<?php
//画像 if(has_post_thumbnail($tax_post->ID)) { echo get_the_post_thumbnail($tax_post->ID,'post-thumbnail'); }
?>
</figure>

<h3><?php echo get_the_title($tax_post->ID); ?></h3>
</li>
<?php endforeach; ?>

</ul>
<?php endif; endforeach; endif; ?>
</div>



<?php get_footer(); ?>

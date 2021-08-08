<?php
	get_header();
	$cat = get_queried_object();
	$catID = $cat->term_id;
	?>
	<div class="pageHeader__bottom">
		<div id="pagePath" class="pc">
			<ul>
				<li><a href="<?php echo home_url('/category-index') ?>">OJT式PR塾の進め方</a></li>
				<li> > <?php echo $cat->cat_name ?></li>
		</ul>
	</div>
	<a href="<?php echo home_url('/logout/'); ?>" class="logoutButtonLink">
		<div class="logoutButton">
			<svg aria-hidden="true" focusable="false" class="logout__userIcon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#0151a7" d="M256 288c79.5 0 144-64.5 144-144S335.5 0 256 0 112 64.5 112 144s64.5 144 144 144zm128 32h-55.1c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16H128C57.3 320 0 377.3 0 448v16c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48v-16c0-70.7-57.3-128-128-128z"></path></svg>
			<span>ログアウト</span>
		</div>
	</a>
</div>
<div class="content">
	<?php if(is_category('pr_step') || is_category('latest_added_video')): ?>
		<section class="cat-section">
			<h2 class="headline02"><span><?php echo $cat->cat_name ?></span></h2>
			<?php
				$args = array( 'post_type' => 'post', 'taxonomy' => 'category' );
				$the_query = new WP_Query($args); if($the_query->have_posts()):
				$latest_article_date = 1;
				while ($the_query->have_posts()): $the_query->the_post();
					if(get_the_date('Ymd') > $latest_article_date) {
						$latest_article_date = get_the_date('Ymd');
					}
				endwhile;
				wp_reset_postdata();
				else:
				endif;
				echo '<time class="latest-article-date">' . date('n月j日',strtotime($latest_article_date)) . ' 最新</time>';
			?>
			<?php
				$taxonomy_name = 'category';
				$term_id = get_queried_object_id();
				$children = get_term_children( $term_id, $taxonomy_name );
				$taxonomies = get_terms($taxonomy_name, array(
					'parent' => $term_id,
				));
				if(!is_wp_error($taxonomies) && count($taxonomies)):
					$article_number = 1;

					foreach($taxonomies as $taxonomy):
						$tax_posts = get_posts(
							array(
								'post_type' => get_post_type(),
								'taxonomy' => $taxonomy_name,
								'term' => $taxonomy->slug,
							)
						);
						foreach($tax_posts as $tax_post) {
							var_dump($tax_post->post_date);
							// -- TODO -- 投稿日が会員登録から12ヶ月後より前だったらフラグを1にする
						}
						if($tax_posts):
			?>
			<div class="cat-child-name-wrapper">
				<h2 class="cat-child-name"><?php echo esc_html($taxonomy->name); ?></h2>
			</div>
			<article>
				<ul>
					<?php
						foreach($tax_posts as $tax_post):
					?>
					<li class="cat-article-item">
						<a href="<?php echo get_permalink($tax_post->ID); ?>" class="cat-article-link">
							<div class="cat-article-link-inner">
								<div class="cat-article-headings">
									<?php
										if(is_category('pr_step')) {
											echo '<span class="cat-article-number">' .  $article_number . '</span>';
											$article_number += 1;
										}
									?>
									<?php
										if (!is_category('news')){
											$today = new DateTime();
											$post_day = new DateTime(date('Y-m-d', strtotime($tax_post->post_date)));
											$display_new_mark_days = 7;
											$after_posting_days = $post_day->diff($today)->days;
											if ($display_new_mark_days >= $after_posting_days) {
									?>
										<span class="new_mark">NEW</span>
											<?php }
										}
									?>
									<h3 class="cat-article-heading"><?php echo get_the_title($tax_post->ID); ?></h3>
								</div>
								<span class="cat-article-movie-tag">動画を見る</span>
							</div>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</article>
			<?php endif; endforeach; endif; ?>
		</section>
		<?php else: ?>
			<article id="conts">
				<?php
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
		<?php endif; ?>
</div>

<?php get_footer(); ?>

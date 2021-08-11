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
	<section class="cat-section">
		<div class="cat-section-header">
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
		</div>
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
			<ul class="cat-article-list">
				<?php
					foreach($tax_posts as $tax_post):
				?>
				<li class="cat-article-item">
					<a href="<?php echo get_permalink($tax_post->ID); ?>" class="cat-article-link">
						<div class="cat-article-thumbnails">
							<?php
								if ( has_post_thumbnail( $tax_post->ID ) ) {
										echo get_the_post_thumbnail( $tax_post->ID, 'medium' );
								}
								if(is_category('pr_step')) {
									echo '<span class="cat-article-number">' .  $article_number . '</span>';
									$article_number += 1;
								}
							?>
						</div>
						<h3 class="cat-article-heading"><?php echo get_the_title($tax_post->ID); ?></h3>
						<div class="cat-article-excerpt"><?php echo get_the_excerpt($tax_post->ID); ?></div>
						<div class="cat-article-info">
							<div class="cat-article-movie-info">
								<?php
									$movie_time = get_field( "movie_time", $tax_post );
									if( $movie_time ) {
										echo
											'<div class="article-icon-text">' .
												'<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="video" class="svg-inline--fa fa-video fa-w-18 cat-article-icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M336.2 64H47.8C21.4 64 0 85.4 0 111.8v288.4C0 426.6 21.4 448 47.8 448h288.4c26.4 0 47.8-21.4 47.8-47.8V111.8c0-26.4-21.4-47.8-47.8-47.8zm189.4 37.7L416 177.3v157.4l109.6 75.5c21.2 14.6 50.4-.3 50.4-25.8V127.5c0-25.4-29.1-40.4-50.4-25.8z"></path></svg>' .
												'<span class="cat-movie-time">' . $movie_time . '</span>' .
											'</div>';
									}
								?>
								<?php
									$text_number = get_field( "text_number", $tax_post );
									if( $text_number ) {
										echo
											'<div class="article-icon-text">' .
												'<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="book-open" class="svg-inline--fa fa-book-open fa-w-18 cat-article-icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M542.22 32.05c-54.8 3.11-163.72 14.43-230.96 55.59-4.64 2.84-7.27 7.89-7.27 13.17v363.87c0 11.55 12.63 18.85 23.28 13.49 69.18-34.82 169.23-44.32 218.7-46.92 16.89-.89 30.02-14.43 30.02-30.66V62.75c.01-17.71-15.35-31.74-33.77-30.7zM264.73 87.64C197.5 46.48 88.58 35.17 33.78 32.05 15.36 31.01 0 45.04 0 62.75V400.6c0 16.24 13.13 29.78 30.02 30.66 49.49 2.6 149.59 12.11 218.77 46.95 10.62 5.35 23.21-1.94 23.21-13.46V100.63c0-5.29-2.62-10.14-7.27-12.99z"></path></svg>' .
												'<span class="cat-movie-time">' . $text_number . '</span>' .
											'</div>';
									}
								?>
							</div>
							<div class="cat-article-tags">
								<?php
									if (!is_category('news')){
										$today = new DateTime();
										$post_day = new DateTime(date('Y-m-d', strtotime($tax_post->post_date)));
										$display_new_mark_days = 7;
										$after_posting_days = $post_day->diff($today)->days;
										if ($display_new_mark_days >= $after_posting_days) {
											echo '<span class="cat-article-tag new">NEW</span>';
										}
									}
								?>
								<?php
									$important = get_field( "important", $tax_post );
									if( $important ) {
										echo '<span class="cat-article-tag important">重要</span>';
									}
								?>
								<?php
									$recommend = get_field( "ikuno_sasaki_recommend", $tax_post );
									if( $recommend ) {
										echo '<span class="cat-article-tag recommend">笹木郁乃 おすすめ</span>';
									}
								?>
							</div>
						</div>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
		</article>
		<?php endif; endforeach; endif; ?>
	</section>
</div>

<?php get_footer(); ?>

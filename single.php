<?php get_header();
	$cat = get_queried_object();
	$catID = $cat->term_id;
?>
			<div class="pageHeader__bottom">
				<div id="pagePath" class="pc">
					<ul>
						<li><a href="<?php echo home_url('/category-index') ?>">OJT式PR塾の進め方</a></li>
						<?php foreach(get_the_category() as $category) {
							if($category->parent != 0){?>
								<li> > <a href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo $category->cat_name ?></a></li>
							<?php } }?>
						<li> > <?php the_title(); ?></li>
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
				<section class="seminarBox">
					<?php foreach(get_the_category() as $category) {
						if($category->parent != 0) { ?>
						<h2 class="headline02">
							<span><?php echo $category->cat_name ?></span>
						</h2>
					<?php }}?>
					<div class="wrapper">
						<article id="conts">
							<h2 class="headline03"><?php the_title(); ?></h2>
							<div class="detailBox">
								<?php $url = get_field('ff_link');
									if($url) {
										$url = strstr($url, '?v='); ?>
								<div class="movie">
									<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo substr($url,3,11);?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								</div>
								<?php } ?>
								<?php if(have_posts()): while (have_posts()) : the_post();?>
								<div class="contentBox">
									<?php the_content();?>
								</div>
								<?php
									$related_movie = get_field( "related_movie", false, false );

									if( $related_movie ) { ?>
										<div class="related-movie-wrapper">
											<h2 class="related-movie-heading">関連動画</h2>
												<?php the_field('related_movie') ?>
										</div>
									<?php } ?>
								<?php
									$recommend = get_field( "recommend", false, false );

									if( $recommend ) { ?>
										<div class="recommend-wrapper">
											<h2 class="recommend-heading">視聴推奨</h2>
												<?php the_field('recommend') ?>
										</div>
									<?php } ?>
								<?php endwhile; endif;?>
							</div>
							<div class="returnBtn">
								<?php foreach(get_the_category() as $category) {
									if(!$category->parent) { ?>
										<a href="<?php echo get_category_link( $category->term_id ); ?>">&lt;<span><?php echo $category->cat_name; ?></span>一覧へ</a>
								<?php }}?>
							</div>
						</article>
					</div>
				</section>
			</div>
<?php get_footer(); ?>

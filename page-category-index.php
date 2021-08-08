<?php get_header(); ?>
<?php add_action ('loop_start', 'needRemoveP'); ?>

<div class="pageHeader__bottom">
	<div id="pagePath" class="pc">
		<ul>
			<li>OJT式PR塾の進め方</li>
		</ul>
	</div>
	<a href="<?php echo home_url('/logout/'); ?>" class="logoutButtonLink">
		<div class="logoutButton">
			<svg aria-hidden="true" focusable="false" class="logout__userIcon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#0151a7" d="M256 288c79.5 0 144-64.5 144-144S335.5 0 256 0 112 64.5 112 144s64.5 144 144 144zm128 32h-55.1c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16H128C57.3 320 0 377.3 0 448v16c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48v-16c0-70.7-57.3-128-128-128z"></path></svg>
			<span>ログアウト</span>
		</div>
	</a>
</div>
<section class="category-index">
	<div class="category-index-wrapper">
		<div class="category-index-inner -full">
			<div class="category-index-item">
				<span class="category-index-number">1</span>
				<h2 class="category-index-heading">PRステップ完全攻略動画</h2>
				<span class="category-index-en">PR Step Lesson</span>
				<p class="category-index-paragraph -center">まずこちらで予習・復習をしてみてください（最新の生講義過去動画より切り取り、ステップごとにご紹介しております）</p>
				<ul class="category-index-photo-list">
					<li class="category-index-photo-item">
						<img src="<?php echo get_template_directory_uri(); ?>/img/category-index/pr_step01.jpg" alt="">
					</li>
					<li class="category-index-photo-item">
						<img src="<?php echo get_template_directory_uri(); ?>/img/category-index/pr_step02.jpg" alt="">
					</li>
					<li class="category-index-photo-item">
						<img src="<?php echo get_template_directory_uri(); ?>/img/category-index/pr_step03.jpg" alt="">
					</li>
				</ul>
				<a href="/category/pr_step" class="category-index-btn">ステップごとの動画はこちら</a>
			</div>
		</div>
		<div class="category-index-inner -tripleCol">
			<div class="category-index-item -small">
				<span class="category-index-number">2</span>
				<div class="category-index-item-text">
					<h2 class="category-index-heading">笹木郁乃　最新追加動画</h2>
					<span class="category-index-en">Sasaki Ikuno Lesson</span>
					<p class="category-index-paragraph">講義内では説明しきれなかった情報の追加動画です。視聴をお勧めいたします。</p>
				</div>
				<div class="category-index-item-bottom">
					<ul class="category-index-photo-list">
						<li class="category-index-photo-item">
							<img src="<?php echo get_template_directory_uri(); ?>/img/category-index/sasaki_ikuno_lesson.jpg" alt="">
						</li>
					</ul>
					<a href="/category/latest_added_video" class="category-index-btn">最新追加動画はこちら</a>
				</div>
			</div>
			<div class="category-index-item -small">
				<span class="category-index-number">3</span>
				<div class="category-index-item-text">
					<h2 class="category-index-heading">メディア交流会録画動画</h2>
					<span class="category-index-en">Media Lesson</span>
					<p class="category-index-paragraph">メディアの方がどのようなことを考えて取材しているか ぜひ参考にしてみてください。</p>
				</div>
				<div class="category-index-item-bottom">
					<ul class="category-index-photo-list">
						<li class="category-index-photo-item">
							<img src="<?php echo get_template_directory_uri(); ?>/img/category-index/media_lesson.jpg" alt="">
						</li>
					</ul>
					<a href="/category/media_exchange_meeting" class="category-index-btn">交流会録画動画はこちら</a>
				</div>
			</div>
			<div class="category-index-item -small">
				<span class="category-index-number">4</span>
				<div class="category-index-item-text">
					<h2 class="category-index-heading">生講義の過去動画</h2>
					<span class="category-index-en">Archive Lesson</span>
					<p class="category-index-paragraph">生講義の過去動画になります。「PRステップ完全攻略動画」と同様の内容になります。アーカイブとして保存しておりますので、前月の講義を一通り見たい方はこちらになります。</p>
				</div>
				<div class="category-index-item-bottom">
					<ul class="category-index-photo-list">
						<li class="category-index-photo-item">
							<img src="<?php echo get_template_directory_uri(); ?>/img/category-index/archive_lesson.jpg" alt="">
						</li>
					</ul>
					<a href="" class="category-index-btn">生講義動画はこちら</a>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
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
			<div class="logoutBtnIcon">
			</div>
			<span>ログアウト</span>
		</div>
	</a>
</div>
<section class="category-index">
	<div class="category-index-wrapper">
		<div class="category-index-inner -full">
			<div class="category-index-item">
				<h2 class="category-index-heading">PRステップ完全攻略動画</h2>
				<p class="category-index-paragraph">まずこちらで予習・復習をしてみてください（最新の生講義過去動画より切り取り、ステップごとにご紹介しております）</p>
				<a href="/category/pr_step" class="category-index-btn">PRステップ完全攻略動画</a>
			</div>
		</div>
		<div class="category-index-inner -tripleCol">
			<div class="category-index-item -small">
				<div class="category-index-item-text">
					<h2 class="category-index-heading">笹木郁乃　最新追加動画</h2>
					<p class="category-index-paragraph">講義内では説明しきれなかった情報の追加動画です。視聴をお勧めいたします。</p>
				</div>
				<a href="/category/latest_added_video" class="category-index-btn">笹木郁乃　最新追加動画</a>
			</div>
			<div class="category-index-item -small">
				<div class="category-index-item-text">
					<h2 class="category-index-heading">メディア交流会録画動画</h2>
					<p class="category-index-paragraph">メディアの方がどのようなことを考えて取材しているか ぜひ参考にしてみてください。</p>
				</div>
				<a href="/category/media_exchange_meeting" class="category-index-btn">メディア交流会録画動画</a>
			</div>
			<div class="category-index-item -small">
				<div class="category-index-item-text">
					<h2 class="category-index-heading">生講義の過去動画</h2>
					<p class="category-index-paragraph">生講義の過去動画になります。</p>
					<p class="category-index-paragraph -small">「PRステップ完全攻略動画」と同様の内容になります。アーカイブとして保存しておりますので、前月の講義を一通り見たい方はこちらになります</p>
				</div>
				<a href="" class="category-index-btn">生講義の過去動画</a>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
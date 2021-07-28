		</main>
	</div>
	<?php if(!is_page('entry') && !is_page('login') && !is_page('complete'))  : ?>
	<footer id="gFooter">
		<ul class="fixBtnUl">
			<li><a href="<?php bloginfo('url');?>/seminar/pr%E8%A8%AD%E8%A8%88%E7%B7%A8"><img src="<?php bloginfo('template_url');?>/img/common/icon01.png" alt="動画教材一覧" width="55"></a></li>
			<li><a href="https://ojtpr.slack.com" target="_blank"><img src="<?php bloginfo('template_url');?>/img/common/icon02.png" alt="PR塾専用slack" width="55"></a></li>
		</ul>
		<div class="fLogo"><a href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_url');?>/img/common/logo.png" alt="OJT式PR塾"></a></div>
		<div class="pagetop"><a href="#container"><img src="<?php bloginfo('template_url');?>/img/common/pagetop.png" alt="pagetop" width="53"></a></div>
		<ul class="footer-linksList">
			<li class="footer-linksItem">
				<a href="<?php echo home_url('/terms/') ?>" target="_blank">利用規約</a>
			</li>
			<li class="footer-linksItem">
				<a href="https://lita-pr.com/about-lita/" target="_blank">運営会社</a>
			</li>
			<li class="footer-linksItem">
				<a href="<?php echo home_url('/privacy/') ?>" target="_blank">プライバシーポリシー</a>
			</li>
			<li class="footer-linksItem">
				<a href="https://pr-professional.jp/transaction/" target="_blank">特定商取引法に基づく表記</a>
			</li>
			<li class="footer-linksItem">
				<a href="mailto:jimukyoku@lita-pr.com" target="_blank">お問い合わせ</a>
			</li>
		</ul>
		<address class="copyright">&copy;Copyright<?php echo date('Y'); ?> OJT式PR塾.All Rights Reserved.</address>
	</footer>
	<?php endif; ?>
</div>
<script src="<?php bloginfo('template_url');?>/js/jquery.js"></script>
<script src="<?php bloginfo('template_url');?>/js/common.js"></script>
<?php wp_footer(); ?>
</body>
</html>
<?php get_header();
$catID = $cat->term_id;
?>
<div class="login-wrapper">
  <h1>
    <a href="http://ojt-pr.com/" title="OJT式PR塾 会員サイト">OJT式PR塾 会員サイト</a>
  </h1>
  <?php echo do_shortcode('[ultimatemember form_id="7"]') ?>
</div>

<?php get_footer(); ?>

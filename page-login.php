<?php get_header();
$catID = $cat->term_id;
?>
<div class="login-wrapper">
  <h1>
    <a href="http://ojt-pr.com/" title="OJT式PR塾 会員サイト">OJT式PR塾 会員サイト</a>
  </h1>
  <?php
    if(have_posts()): while(have_posts()): the_post();
      the_content();

    endwhile; endif;
  ?>
</div>

<?php get_footer(); ?>

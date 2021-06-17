<?php get_header(); ?>
<div class="entry-wrapper">
  <h1 class="entry-header">
     OJT式PR塾
     <span class="entry-header-small">事前登録フォーム</span>
  </h1>
  <!-- <p class="entry-lead">リード分が入ります。リード分が入ります。リード分が入ります。リード分が入ります。リード分が入ります。</p> -->
  <div class="entry-form-wrapper">
    <?php
      if(have_posts()): while(have_posts()): the_post();
        the_content();

      endwhile; endif;
    ?>
  </div>
</div>

<?php get_footer(); ?>

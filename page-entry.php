<?php get_header(); ?>
<div class="entry-wrapper">
  <h1 class="entry-header">
     OJT式PR塾
     <span class="entry-header-small">事前登録フォーム</span>
  </h1>
  <p class="entry-lead">
    OJT式PR塾専用動画サイトでございます。ご利用いただくために会員登録をお願いいたします。会員登録の方法は<a href="https://docs.google.com/document/d/16Slr6su-oacjox377ICxygFxnLlit8ZZtSbQry9tDo4/edit" target="_blank" noopener>OJT PR塾 事前登録手順</a>よりご確認くださいませ。ご登録頂き、承認のご連絡が届きましたらご利用可能となっております。今しばらくおまちください。
  </p>
  <div class="entry-form-wrapper">
    <?php
      if(have_posts()): while(have_posts()): the_post();
        the_content();

      endwhile; endif;
    ?>
  </div>
</div>

<?php get_footer(); ?>

<?php get_header(); ?>
<div class="entry-wrapper">
  <h1 class="entry-header">
     OJT式PR塾
     <span class="entry-header-small">事前登録フォーム</span>
  </h1>
  <p class="entry-lead">
    この度、OJT式PR塾の会員サイトの一部リニューアル・バージョンアップをさせて頂きました。それに伴いサイトの情報保護の観点からも、今後は、アドレスやパスワードのログイン設定を行っていただく仕様と変更となりました。皆様にはお手数をおかけしてしまいますが、登録フォームの設定をお願いいたします。
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

<?php get_header(); ?>
<?php add_action ('loop_start', 'needRemoveP'); ?>

<div class="page-inner" id="terms">
	<?php if(have_posts()): while (have_posts()) : the_post();?>
    <h2 class="page-title"><?php the_title();?></h2>
    <div class="page-contents"><?php the_content();?></div>
	<?php endwhile; endif;?>
</div>
<?php get_footer(); ?>
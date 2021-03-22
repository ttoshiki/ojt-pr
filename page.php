<?php get_header(); ?>
<?php add_action ('loop_start', 'needRemoveP'); ?>

<div id="conts">
	<?php if(have_posts()): while (have_posts()) : the_post();?>
	<h2><?php the_title();?></h2>
	<div><?php the_content();?></div>
	<?php endwhile; endif;?>
</div>
<?php get_footer(); ?>
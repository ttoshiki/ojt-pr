<?php
	$taxonomy_name = 'category';
	$taxonomys = get_terms($taxonomy_name);
	if(!is_wp_error($taxonomys) && count($taxonomys)):

	foreach($taxonomys as $taxonomy):
	$tax_posts = get_posts(array('post_type' => get_post_type(), 'taxonomy' => $taxonomy_name,
	'term' => $taxonomy->slug ) );
	if($tax_posts):
?>

<h2><?php echo esc_html($taxonomy->name); ?></h2>
<ul>

<?php
foreach($tax_posts as $tax_post):
?>
<li>
<a href="<?php echo get_permalink($tax_post->ID); ?>">
<figure>
<?php
//画像 if(has_post_thumbnail($tax_post->ID)) { echo get_the_post_thumbnail($tax_post->ID,'post-thumbnail'); }
?>
</figure>

<h3><?php echo get_the_title($tax_post->ID); ?></h3>
</li>
<?php endforeach; ?>

</ul>
<?php endif; endforeach; endif; ?>
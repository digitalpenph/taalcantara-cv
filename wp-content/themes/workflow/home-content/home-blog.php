<div class="thumb-wrap">
	<?php
		$thumb_id = get_post_thumbnail_id();
		$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
		$thumb_url = $thumb_url_array[0]; 
		$image_full = workflow_catch_that_image(); 
		$gallery_full = workflow_catch_gallery_image_full();
	?>
	<?php if(has_post_thumbnail()): ?>
		<div class="image-bg" style="background-image:url(<?php echo esc_url( $thumb_url ); ?>);"></div>
	<?php elseif(!empty($image_full)): ?>
		<div class="image-bg" style="background-image:url(<?php echo esc_url( $image_full ); ?>);"></div>
	<?php elseif(!empty($gallery_full)) : ?>
		<div class="image-bg" style="background-image:url(<?php echo esc_url( $gallery_full ); ?>);"></div>
	<?php endif; ?>
		
	
	<div class="meta-tags"<?php if(has_post_thumbnail() || !empty($image_full) || !empty($gallery_full)){  echo "";}else{echo " style='position:relative;'";} ?>>
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
		<div>
			<h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
			<p><?php printf( __( 'by <span class="author">%3$s</span> on <time class="updated" datetime="%1$s" pubdate>%2$s</time>', 'workflow' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?></p>
			<span class="clear"></span>
		</div>
	</div>
</div>

<div class="the-post-content entry-content">
	<?php the_content( '','' ); ?>
</div>
<div class="meta-tags-bottom">
	<div class="post-link">
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php _e('Continue Reading','workflow'); ?></a>
	</div>
	<div class="cat-tag">
		<p class="cat-links"><?php $category_list = get_the_category_list( __( ', ', 'workflow' ) ); printf( __('%s', 'workflow'),$category_list); ?></p>
		<?php echo get_the_tag_list('<p class="tag-links">',', ','</p>'); ?>
	</div>
	<span class="clear"></spans>
</div>
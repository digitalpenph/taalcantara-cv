<?php get_header(); ?>
	<?php 
	if ( get_theme_mod('workflow_slider',true) ) :
	$slider_display = '';
	else:
	$slider_display = ' ' . 'slider-hide';
	endif;
	?>
	<div class="carousel-area<?php echo $slider_display; ?>" style="background-image:url(<?php echo( get_header_image() ); ?>);">
		<div class="wrap">
			<div class="carousel-area-wrap">
				<?php $args = array(
				'post_status' => 'publish',
				'post__in' => get_option("sticky_posts")
				);
				$fPosts = new WP_Query( $args );?>
				<?php while ( $fPosts -> have_posts() ) : $fPosts -> the_post(); ?>
				<div class="carousel-item">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					<?php 
					if(has_post_thumbnail()){the_post_thumbnail('workflow-thumb-carousel');}else{echo '<span style="display: block; width: 100%; max-width: 400px; height: 242px; background-color: rgba(0, 0, 0, 0.5);" class="no-image"></span>';} ?>

					<div>
						<h1><?php the_title(); ?></h1>
						<p><?php printf( __( 'by <span class="author">%3$s</span> on <time class="updated" datetime="%1$s" pubdate>%2$s</time>', 'workflow' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?></p>
					</div>
				</div>
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
				
			</div>
		</div>
		<span class="pattern-overlay"></span>
	</div>
	<div class="front-wrapper">
		<div id="content">
			<div class="wrap">
				<div class="blog-list m-all t-2of3 d-5of7 cf" id="blog">
						<?php while ( have_posts() ) : the_post(); ?>
		  						<article id="post-<?php the_ID(); ?>" <?php post_class( 'item' ); ?>>
			  						<?php get_template_part( 'home-content/home', 'blog'); ?>
								</article>
		  				<?php endwhile;  ?>
		 				<div class="clear"></div>
						<?php workflow_paging_nav(); ?>
						<?php wp_reset_postdata(); ?>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div> <!-- content -->
	</div><!-- front-wrapper -->

<?php get_footer(); ?>
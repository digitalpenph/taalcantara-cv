<?php get_header(); ?>
	<div id="archive-page">
		<div id="content">
			<div class="wrap">
				<div class="blog-list m-all t-2of3 d-5of7 cf" id="blog">
						<h1 class="archive-title">
							<?php _e( 'Search Results for:', 'workflow' ); ?> <?php echo esc_html(get_search_query()); ?>
						</h1>
						<?php while ( have_posts() ) : the_post(); ?>
		  						<article class="item">
			  						<?php get_template_part( 'home-content/home', 'blog'); ?>
								</article>
		  				<?php endwhile; ?>

		 				<span class="clear"></span>
						<?php workflow_paging_nav(); ?>
						
						<?php wp_reset_postdata(); ?>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div> <!-- content -->
	</div><!-- front-wrapper -->

<?php get_footer(); ?>
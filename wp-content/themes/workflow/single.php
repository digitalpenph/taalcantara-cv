<?php get_header(); ?>

			<div id="content">
				
				<div id="inner-content" class=" cf">
						
						<div id="inner-content" class="wrap cf post-content-single">
						<div class="m-all t-2of3 d-5of7 cf blog-list">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
         					<article id="post-<?php the_ID(); ?>" <?php post_class( 'item' ); ?>>
			  					<?php get_template_part( 'post-content/post', 'blog'); ?>
							</article>

						<?php endwhile; ?> <?php endif; ?>
						<div class="next-prev-post">
							<div class="prev">
								<?php previous_post_link('<span>PREVIOUS POST</span> &larr; %link'); ?>
							</div>
							<div class="next">
								<?php next_post_link('<span>NEXT POST</span> %link &rarr;'); ?>
							</div>
							<div class="clear"></div>
						</div> 

						<?php 
							if ( get_theme_mod('workflow_author_bio',true) ) :
								$author_class = '';
							else:
								$author_class = ' ' . 'author-hide';
							endif;
						?>

		                <footer class="article-footer <?php echo  esc_attr($author_class); ?>">
		                  <div class="avatar">
		                  	<?php echo get_avatar( get_the_author_meta( 'ID' ) , 100 ); ?>
		                  </div>
		                  <div class="info">
			                  <p class="author"><span><?php _e('Written by: ','workflow'); ?></span><?php the_author(); ?></p>
			                  <p class="author-desc"> <?php if (function_exists('workflow_author_excerpt')){echo workflow_author_excerpt();} ?> </p>
		                  </div>
		                  <div class="clear"></div>
		                </footer> <?php // end article footer ?>
		                
		                <?php comments_template(); ?>
						</div>

						<?php get_sidebar(); ?>
						<div class="clear"></div>
					</div>
					
				</div>

			</div>

<?php get_footer(); ?>
<?php 
/*
 * Template Name: Fullwidth
*/

get_header(); ?>

			<div id="content">
				
				<div id="inner-content" class="cf">
						
						<div id="inner-content" class="wrap cf">
						<div class="m-all cf">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
						<div class="page-item">
						<div class="the-post-content entry-content">
							<h1 class="page-title"><?php the_title(); ?></h1>
							<?php the_content(); ?>
						</div>

						</div>

						<?php endwhile; ?> <?php endif; ?>
								
						</div>
						<div class="clear"></div>
					</div>
					
				</div>

			</div>

<?php get_footer(); ?>
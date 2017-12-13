<?php get_header(); ?>
	<div id="archive-page">
		<div id="content">
			<div class="wrap">
				<div class="blog-list m-all t-2of3 d-5of7 cf" id="blog">
						<?php if (is_category()) : ?>
							<h1 class="archive-title">
								<?php single_cat_title(); ?>
							</h1>

							<?php elseif (is_tag()): ?>
							<h1 class="archive-title">
								<?php single_tag_title(); ?>
							</h1>

							<?php elseif (is_author()) :
							global $post;
							$author_id = $post->post_author;
							?>
							<h1 class="archive-title">

								<?php the_author_meta('display_name', $author_id); ?>

							</h1>

							<?php elseif (is_day()): ?>
							<h1 class="archive-title">
								<?php the_time(get_option('date_format')); ?>
							</h1>

							<?php elseif (is_month()): ?>
								<h1 class="archive-title">
									</span> <?php the_time(get_option('date_format')); ?>
								</h1>

							<?php elseif (is_year()): ?>
								<h1 class="archive-title">
									<?php the_time(get_option('date_format')); ?>
								</h1>
						<?php endif; ?>

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
			<footer class="footer" role="contentinfo">
				<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
				<div class="footer-widgets wrap">

						<div class="footer-item"><?php dynamic_sidebar( 'footer-1' ); ?></div>
						<div class="footer-item"><?php dynamic_sidebar( 'footer-2' ); ?></div>
						<div class="footer-item"><?php dynamic_sidebar( 'footer-3' ); ?></div>
						<div class="footer-item"><?php dynamic_sidebar( 'footer-4' ); ?></div>
					
					<div class="clear"></div>
				</div>
				<?php endif; ?>
				<div id="inner-footer" class="wrap cf">

					<p class="source-org copyright">
						 &#169; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?> 
						<span><?php if(is_home()): ?>
							- <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'workflow' ) ); ?>"><?php printf( __( 'Powered by %s', 'workflow' ), 'WordPress' ); ?></a> <?php _e('and','workflow'); ?> <a href="<?php echo esc_url( __( 'http://wpworkflow.org', 'workflow' ) ); ?>"><?php printf( __( '%s', 'workflow' ), 'Workflow' ); ?></a>
						<?php endif; ?>
						</span>
					</p>

				</div>

			</footer>
			<a href="#" class="scrollToTop"><span class="fa fa-chevron-circle-up"></span></a>
		</div>

		<?php wp_footer(); ?>
	</body>

</html> <!-- end of site. what a ride! -->
<?php get_header(); ?>

      <div id="content">
        
        <div id="inner-content" class="cf">
            
            <div id="inner-content" class="wrap cf">
            <div class="m-all cf">

              
              <div class="page-item">
                <div class="the-post-content entry-content">
                  <h1 class="page-title"><?php _e( 'Not Found', 'workflow' ); ?></h1>
                  <p>
                    <?php _e( 'The article you were looking for was not found. You may want to check your link or perhaps that page does not exist anymore. Maybe try a search?', 'workflow' ); ?>
                  </p>
                  <?php get_search_form(); ?>
                </div>
              </div>

                
            </div>
            <div class="clear"></div>
          </div>
          
        </div>

      </div>

<?php get_footer(); ?>
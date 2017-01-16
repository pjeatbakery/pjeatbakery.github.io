<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package SKT Hotel
 */
?>
<div id="footer-wrapper">
    	<div class="container">
             <div class="cols-4 widget-column-1">            	
               <h5><?php echo get_theme_mod('menu_title',__('Main Menu','hotel')); ?></h5>
                <div class="menu">
                  <ul>
                   <?php echo get_theme_mod('footer_menu', __('<li><a href="#">Home</a></li><li><a href="#">About Us</a></li><li><a href="#">Portfolio</a></li><li><a href="#">Contact Us</a></li>','hotel')); ?>
                  </ul>
                </div>
            </div>                  
			         
             
             <div class="cols-4 widget-column-2">            	
               <h5><?php echo get_theme_mod('news_title',__('Latest News','hotel')); ?></h5>            	
				<?php $args = array( 'posts_per_page' => 2, 'post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'desc' );
                    query_posts( $args ); ?>
                    
                  <?php while ( have_posts() ) :  the_post(); ?>
                        <div class="recent-post">
                         <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
                         <a href="<?php the_permalink(); ?>"><h6><?php the_title(); ?></h6></a>                         
                         <?php echo hotel_content(8); ?>                         
                        </div>
                 <?php endwhile; ?>
              </div>     
                      
               <div class="cols-4 widget-column-3">
                   <h5><?php echo get_theme_mod('social_title',__('Follow Us','hotel')); ?></h5>  
                             	
					<div class="clear"></div>                
                  <div class="social-icons">
					<?php if ( get_theme_mod('fb_link') != "") { ?>
                    <a title="facebook" class="fa fa-facebook" target="_blank" href="<?php echo esc_url(get_theme_mod('fb_link','#facebook')); ?>"></a> 
                    <?php } else { ?>
                    <?php echo '<a href="#" target="_blank" class="fa fa-facebook" title="facebook"></a>'; } ?>
                    
                    <?php if ( get_theme_mod('twitt_link') != "") { ?>
                    <a title="twitter" class="fa fa-twitter" target="_blank" href="<?php echo esc_url(get_theme_mod('twitt_link','#twitter')); ?>"></a>
                    <?php } else { ?>
                    <?php echo '<a href="#" target="_blank" class="fa fa-twitter" title="twitter"></a>'; } ?> 
                    
                    <?php if ( get_theme_mod('gplus_link') != "") { ?>
                    <a title="google-plus" class="fa fa-google-plus" target="_blank" href="<?php echo esc_url(get_theme_mod('gplus_link','#gplus')); ?>"></a>
                    <?php } else { ?>
                    <?php echo '<a href="#" target="_blank" class="fa fa-google-plus" title="google-plus"></a>'; } ?>
                    
                    <?php if ( get_theme_mod('linked_link') != "") { ?> 
                    <a title="linkedin" class="fa fa-linkedin" target="_blank" href="<?php echo esc_url(get_theme_mod('linked_link','#linkedin')); ?>"></a>
                    <?php } else { ?>
                    <?php echo '<a href="#" target="_blank" class="fa fa-linkedin" title="linkedin"></a>'; } ?>
                  </div>   
                </div>
                
                <div class="cols-4 widget-column-4">
                   <h5><?php echo get_theme_mod('contact_title',__('Contact Info','hotel')); ?></h5> 
                   <p><?php echo get_theme_mod('contact_add',__('100 King St, Melbourne PIC 4000,<br /> Australia','hotel')); ?></p>
              <div class="phone-no"><?php echo get_theme_mod('contact_no',__('<strong>Phone:</strong> +123 456 7890','hotel')); ?> <br  />
             
           <strong> Email:</strong> <a href="mailto:<?php echo get_theme_mod('contact_mail','contact@company.com'); ?>"><?php echo get_theme_mod('contact_mail','contact@company.com'); ?></a></div>
              
                   
                </div><!--end .widget-column-4-->
                
                
            <div class="clear"></div>
        </div><!--end .container-->
        
        <div class="copyright-wrapper">
        	<div class="container">
            	<div class="copyright-txt"><?php echo hotel_credit(); ?></div>
                <div class="design-by"><?php echo hotel_themebytext(); ?></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
<?php wp_footer(); ?>

</body>
</html>
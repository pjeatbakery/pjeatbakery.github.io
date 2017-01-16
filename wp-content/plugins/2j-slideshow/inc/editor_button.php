<?php 
/*  
 * 2J SlideShow		http://2joomla.net/wordpress
 * Version:           1.3.2 - 98240
 * Author:            2J Team (c)
 * Author URI:        http://2joomla.net/wordpress
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Date:              Fri, 09 Dec 2016 06:54:08 GMT
 */

function add_twoj_slideshow_button(){
	wp_enqueue_style("wp-jquery-ui-dialog");
	wp_enqueue_script('jquery-ui-dialog');
  
  	wp_enqueue_script('twoj-twoj-slideshow-button', TWOJ_SLIDESHOW_URL.'js/admin/editor-button.js', array( 'jquery' ), '1.0.0', true );    
  	
  	$translation_array = array( 
		'twojSlideshowTitle' 	=> __('2J Slideshow','twoj_slideshow'),
		'closeButton'		=> __('Close'),
		'insertButton'		=> __('Insert'),
	);

	wp_localize_script( 'twoj-twoj-slideshow-button', 'twoj_slideshow_trans', $translation_array );
	wp_enqueue_script( 'twoj-twoj-slideshow-button' );

  	echo '<a href="#twoj-slideshow" id="insert-2j-slideshow" class="button"><span class="dashicons dashicons-images-alt" style="margin: 4px 5px 0 0;"></span>'.__( 'Add 2J Slideshow' , 'twoj_slideshow' ).'</a>';
	
	$params = array(
	    'sort_order'   	=> 'ASC',
	    'sort_column'  	=> 'post_title',
	    'echo'			=> 0,
	    'post_type' 	=> TWOJ_SLIDESHOW_TYPE_POST
	); 
  	echo '<div id="twoj-slideshow" style="display: none;">'
  			.__('Select slideshow', 'twoj_slideshow').': '.wp_dropdown_pages( $params )   //
  			.'<p style="margin-bottom:0px;">
  				'.__( 'Manage your ','twoj_slideshow').' 
  				<a href="edit.php?post_type='.TWOJ_SLIDESHOW_TYPE_POST.'" target="_blank">
  					'.__( '2J Slideshows','twoj_slideshow').'
  				</a>
  			</p>'
  		.'</div>';
}
add_action('media_buttons', 'add_twoj_slideshow_button', 15);

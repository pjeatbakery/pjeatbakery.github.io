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

if(!function_exists('twoj_slideshow_topblock')){
	function twoj_slideshow_topblock(){
		wp_enqueue_script( 	'twoj-slideshow-topblock', TWOJ_SLIDESHOW_URL.'js/admin/topblock.js', array( 'jquery' ), TWOJ_SLIDESHOW_VERSION, true );
		wp_enqueue_style ( 	'twoj-toolbox-topblock', TWOJ_SLIDESHOW_URL.'css/admin/topblock.css', array( ), TWOJ_SLIDESHOW_VERSION );
		$editNew = twoj_slideshow_is_edit_page('new') || twoj_slideshow_is_edit_page('edit');
		echo '<div class="twojTopBlock twoj_getproversion_blank">
			<div class="twojTopBig"><span class="dashicons dashicons-awards"></span>'.	__( 'Get Unlimited Functionality in Premium version' , 'twoj_slideshow' ).'</div>
		</div>';
	}
	if(!TWOJ_SLIDESHOW_PRO) add_action( 'in_admin_header', 'twoj_slideshow_topblock' );
}

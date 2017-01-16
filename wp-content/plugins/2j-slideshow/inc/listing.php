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

if( isset($_GET['showproinfo']) && $_GET['showproinfo'] ){
	if(!function_exists('twoj_slideshow_showInformation')){
		function twoj_slideshow_showInformation(){
			wp_enqueue_style("wp-jquery-ui-dialog");
			wp_enqueue_script('jquery-ui-dialog');

			wp_enqueue_script('twoj-slideshow-info', TWOJ_SLIDESHOW_URL.'js/admin/info.js', array( 'jquery' ), TWOJ_SLIDESHOW_VERSION, true ); 
			wp_enqueue_style ('twoj-slideshow-info', TWOJ_SLIDESHOW_URL.'css/admin/info.css', array( ), TWOJ_SLIDESHOW_VERSION );
			
			echo '<div id="twoj_showInformation" '
						.'style="display: none;" '
						.'data-open="1" '
						.'data-title="'.__('Get 2J Slideshow Premium version', 'twoj_slideshow').'" '
						.'data-close="'.__('Close', 'twoj_slideshow').'" '
						.'data-info="'.__('Get Premium version', 'twoj_slideshow').'"'
					.'>'
					.__('You can create only 1 slideshow. Update to Premium to get unlimited slideshows', 'twoj_slideshow')
				.'</div>';
		}
		if(!TWOJ_SLIDESHOW_PRO) add_action( 'in_admin_header', 'twoj_slideshow_showInformation' );
	}
}

if(!function_exists('twoj_custom_columns')){
	function twoj_custom_columns( $column, $post_id ) {
	    switch ( $column ) {
		case 'twoj_slideshow' :
			global $post;
			$slug = '' ;
			$slug = $post->post_name;
	        $shortcode = '<span>[twoj-slideshow id="'.$post->ID.'"]</span>';
		    echo $shortcode; 
		    break;
	    }
	}
	add_action( 'manage_'.TWOJ_SLIDESHOW_TYPE_POST.'_posts_custom_column' , 'twoj_custom_columns', 10, 2 );
}

if(!function_exists('add_twoj_table_columns')){
	function add_twoj_table_columns($columns) { 
		return array_merge($columns, array('twoj_slideshow' => __('Shortcode'),)); 
	}
	add_filter('manage_'.TWOJ_SLIDESHOW_TYPE_POST.'_posts_columns' , 'add_twoj_table_columns');
}

if(!function_exists('twoj_slideshow_list')){
	function twoj_slideshow_list (){
		if(!defined ('TWOJ_SLIDESHOW_VERSION')) return;
		
		wp_enqueue_style ('twoj-slideshow-list', TWOJ_SLIDESHOW_URL.'css/admin/list.css', array( ), TWOJ_SLIDESHOW_VERSION );
	}
	add_action( 'in_admin_header', 'twoj_slideshow_list' );
}
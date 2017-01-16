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

function twoj_slideshow_tag($content){
    global $post;
    if ( post_password_required() ) return $content;
  
    $returnCode = '';
    if( get_post_type() == TWOJ_SLIDESHOW_TYPE_POST && is_main_query() ){
		$returnCode = do_shortcode("[2jslideshow id={$post->ID}]");
	}
	return $content.$returnCode;
}
add_filter( 'the_content', 'twoj_slideshow_tag');

function twoj_slideshow_shortcode( $attr ) {
 	$retHTML = '';
	if( isset($attr) && isset($attr['id']) ){
		$slideshow = new twojSlideshow($attr);
		$retHTML = $slideshow->getSlideshow();
	}
	return  $retHTML;
}
add_shortcode( '2jslideshow', 'twoj_slideshow_shortcode' );
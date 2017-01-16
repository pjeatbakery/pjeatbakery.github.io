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

$infowide_metabox = new_cmb2_box( array(
    'id'            => TWOJ_SLIDESHOW_PREFIX.'infowide_metabox',
    'title'         => __('Get Premium version','twoj_slideshow'),
    'object_types'  => array( TWOJ_SLIDESHOW_TYPE_POST ),
    'context'       => 'normal',
    'closed'        => twoj_slideshow_set_checkbox_default_for_new_post(0),
));

$infowide_metabox->add_field( array(
    'id'            => TWOJ_SLIDESHOW_PREFIX.'infoWide',
    'type'          => 'title',
    'before_row'    => '<div class="twoj_infoblock">'
    						.'<div class="twoj_infoSmall twoj_getproversion_blank">'.__( 'Get Unlimited Functionality in Premium version' , 'twoj_slideshow' ).'</div>'
    					.'</div>'
));
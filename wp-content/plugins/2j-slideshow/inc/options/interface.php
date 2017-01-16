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

$interface_metabox = new_cmb2_box( array(
    'id' 			=> TWOJ_SLIDESHOW_PREFIX . 'interface_metabox',
    'title' 		=> __('Interface', 'twoj_slideshow' ),
    'object_types' 	=> array( TWOJ_SLIDESHOW_TYPE_POST ),
    'cmb_styles' 	=> false,
    'show_names'	=> false,
    'context'		=> 'normal',
    'priority' 		=> 'high',
    'closed'        => twoj_slideshow_set_checkbox_default_for_new_post(0),
));



$interface_metabox->add_field( array(
	'name' 			=> 	__('Show Caption', 'twoj_slideshow' ),
	'id' 			=> 	TWOJ_SLIDESHOW_PREFIX . 'caption',
	'type' 			=> 	'switch',
	//'depends' 		=> 	'.twoj_size_width, .twoj_size_height',
	'default'		=> 	twoj_slideshow_set_checkbox_default_for_new_post(0),
	'bootstrap_style'=> 1,
	'before_row' 	=> ' <br />
<div class="twoj_block">'
));

$interface_metabox->add_field( array(
    'name'    	=> __('Navigation style','twoj_slideshow'),
    'default' 	=> 'dots',
    'options'	=> array( 
    		'false' => 'Hide' , 
    		'thumbs'=> 'Thumbs' , 
    		'dots' 	=> 'Dots' , 
    	),
    'level'		=> !TWOJ_SLIDESHOW_PRO,
    'id'	  	=> TWOJ_SLIDESHOW_PREFIX .'nav',
    'type'    	=> 'twojselectbutton',
));

$interface_metabox->add_field( array(
    'name'    	=> __('Navigation position','twoj_slideshow'),
    'default' 	=> 'dots',
    'options'	=> array( 
    		'1' => 'Top' , 
    		'0'=> 'Bottom',
    	),
    'id'	  	=> TWOJ_SLIDESHOW_PREFIX .'navPos',
    'type'    	=> 'twojselectbutton',
));

$interface_metabox->add_field( array(
	'name' 			=> __('Thumbs Options', 'twoj_slideshow' ),
	'id' 			=> TWOJ_SLIDESHOW_PREFIX . 'thumb-size-options',
	'type' 			=> 'size',
	'level'			=> !TWOJ_SLIDESHOW_PRO,
));


$interface_metabox->add_field( array(
    'name'    	=> __('FullScreen','twoj_slideshow'),
    'default' 	=> 'true',
    'options'	=> array( 
    		'true' 	=> 'Enabled' , 
    		'native'=> 'Enabled Native',
    		'false'	=> 'Disable',

    	),
    'id'	  	=> TWOJ_SLIDESHOW_PREFIX .'fullscreen',
    'type'    	=> 'twojselectbutton',
));

$interface_metabox->add_field( array(
	'name' 			=> 	__(' Show Arrow', 'twoj_slideshow' ),
	'id' 			=> 	TWOJ_SLIDESHOW_PREFIX . 'arrow',
	'type' 			=> 	'switch',
	'bootstrap_style'=> 1,
	'default'		=> 	twoj_slideshow_set_checkbox_default_for_new_post(1),
));

$interface_metabox->add_field( array(
	'name' 			=> 	__('Click', 'twoj_slideshow' ),
	'id' 			=> 	TWOJ_SLIDESHOW_PREFIX . 'click',
	'type' 			=> 	'switch',
	'level'			=> !TWOJ_SLIDESHOW_PRO,
	'bootstrap_style'=> 1,
	'default'		=> 	twoj_slideshow_set_checkbox_default_for_new_post(0),
));

$interface_metabox->add_field( array(
	'name' 			=> 	__('Swipe', 'twoj_slideshow' ),
	'id' 			=> 	TWOJ_SLIDESHOW_PREFIX . 'swipe',
	'type' 			=> 	'switch',
	'level'			=> !TWOJ_SLIDESHOW_PRO,
	'bootstrap_style'=> 1,
	'default'		=> 	twoj_slideshow_set_checkbox_default_for_new_post(0),
));

$interface_metabox->add_field( array(
	'name' 			=> 	__('Keyboard', 'twoj_slideshow' ),
	'id' 			=> 	TWOJ_SLIDESHOW_PREFIX . 'keyboard',
	'type' 			=> 	'switch',
	'bootstrap_style'=> 1,
	'default'		=> 	twoj_slideshow_set_checkbox_default_for_new_post(1),
));


$interface_metabox->add_field( array(
	'name' 			=> __('Thumbs Border', 'twoj_slideshow' ),
	'id' 			=> TWOJ_SLIDESHOW_PREFIX . 'border',
	'type' 			=> 'switch',
	'default'		=> twoj_slideshow_set_checkbox_default_for_new_post(0),
	'depends' 		=> '.twoj_border_tabs',
    'bootstrap_style'=> 1,
));
     
$interface_metabox->add_field( array(
	'name' 			=> __('Border options', 'twoj_slideshow' ),
	'id' 			=> TWOJ_SLIDESHOW_PREFIX . 'border-options',
	'type' 			=> 'border',
	'before_row' 	=> '
	<div class="twoj_border_tabs">',
	'after_row' 	=> '
	</div>'
));


$interface_metabox->add_field( array(
	'name' 			=> __('Bg color', 'twoj_slideshow' ),
	'id' 			=> TWOJ_SLIDESHOW_PREFIX . 'bg',
	'type' 			=> 'switch',
	'default'		=> twoj_slideshow_set_checkbox_default_for_new_post(0),
	'depends' 		=> '.twoj_bg_div',
    'bootstrap_style'=> 1,
    'after_row' 	=> '
	<div class="twoj_bg_div">',
));

$interface_metabox->add_field( array(
    'name'    => __('Bg Color','twoj_slideshow'),
    'id'	  => TWOJ_SLIDESHOW_PREFIX .'bgColor',
    'type'    => 'twojtext',
    'small'			=> 1,
	'default'  		=> '#ffffff',
	'data-default' 	=>  '#ffffff',
    'class'			=> 'form-control twoj_color',
));

$interface_metabox->add_field( array(
    'name'    => __('Bg Nav Color','twoj_slideshow'),
    'id'	  => TWOJ_SLIDESHOW_PREFIX .'bgNavColor',
    'type'    => 'twojtext',
    'small'			=> 1,
	'default'  		=> '#ffffff',
	'data-default' 	=>  '#ffffff',
    'class'			=> 'form-control twoj_color',
    'after_row'		=>'
    		</div>
</div> '
));






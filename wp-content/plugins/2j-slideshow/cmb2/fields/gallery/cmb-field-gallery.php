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

define( 'twoj_slideshow_URL', plugin_dir_url( __FILE__ ) );

function twoj_slideshow_field( $field, $meta ) {
	wp_enqueue_script( 'twoj_slideshow_init', twoj_slideshow_URL . 'js/script.js', array( 'jquery' ), null );
	wp_enqueue_style( 'twoj_slideshow_style', twoj_slideshow_URL . 'css/style.css', array(), '', 'all' );

	if ( ! empty( $meta ) ) {
		$meta = implode( ',', $meta );
	} else $meta = ' ';

	echo '<div class="pw-gallery twoj_block twoj_button_block">';
	echo '	<p class="cmb2-metabox-description">' . __( 'Here you can find all necessary tools to manage your slideshow images and shortcode', 'twoj_slideshow' ) . '</p>';
	echo '	<input type="hidden" class="pw-gallary-value" id="' . $field->args( 'id' ) . '" name="' . $field->args( 'id' ) . '" value="' . $meta . '" />';
	echo '	<button id="twoj_slides" class="btn btn-primary btn-lg "><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> '.__('Manage Slides', 'twoj_slideshow' ).'</button>';
	if( TWOJ_SLIDESHOW_PRO != 1 ){
		if( TWOJ_SLIDESHOW_MESSAGE == 1 ){
			echo '	<button class="btn btn-success btn-lg twoj_getproversionforfree_blank twoj_button_padding"><span class="glyphicon glyphicon-gift"></span> ' . __( 'Get Premium for Free', 'twoj_slideshow') . ' </button>';
		} else {
			echo '	<button class="btn btn-success btn-lg twoj_getproversion_blank twoj_button_padding"><span class="glyphicon glyphicon-gift"></span> ' . __( 'Upgrade to Premium', 'twoj_slideshow') . ' </button>';
		}
	}
	echo '	<button id="twoj_2jslideshow_getshortcode" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-tag"></span> ' . __( 'Get ShortCode', 'twoj_slideshow' ) . ' </button>';
	echo '	<p class="cmb2-metabox-description">' . __( 'Resources manager help you to upload, sort, resize, rotate slideshow images. Also at the same place you can add all additional parameters for every image: description, caption, link, video link, description styling and alignment.', 'twoj_slideshow' ) . '</p>';
	echo '</div>';
	echo '
	<div id="twoj_showShortCodeDialog" style="display: none;" data-open="0" data-title="'.__( '2J Slideshow ShortCode', 'twoj_slideshow' ).'" data-close="'.__('Close', 'twoj_slideshow').'">
		<div id="cmb2-metabox-twojs_shortcode_metabox" class="cmb2-metabox cmb-field-list"><div class="twoj_shortcode">[2jslideshow id="'.(isset($_GET['post'])&&$_GET['post']?$_GET['post']:'-').'"]</div>
			<div class="desc">'.__('use this shortcode to insert this slideshow into page, post or widget', 'twoj_slideshow').'</div>
		</div>
	</div>';
}
add_filter( 'cmb2_render_twoj_slideshow', 'twoj_slideshow_field', 10, 2 );


function twoj_slideshow_field_sanitise( $meta_value, $field ) {
	if ( empty( $meta_value ) ) {
		$meta_value = '';
	} else {
		$meta_value = explode( ',', $meta_value );
	}
	return $meta_value;
}

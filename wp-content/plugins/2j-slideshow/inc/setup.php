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

class TwojSlideshowActivator {
	public static function activate() {
		delete_option("twojs_slideshow_install_action");
		add_option( 'twojs_slideshow_install_action', '1' );
	}
	public static function deactivate() {}
}
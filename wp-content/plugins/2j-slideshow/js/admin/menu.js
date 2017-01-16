/*  
 * 2J SlideShow		http://2joomla.net/wordpress
 * Version:           1.3.2 - 98240
 * Author:            2J Team (c)
 * Author URI:        http://2joomla.net/wordpress
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Date:              Fri, 09 Dec 2016 06:54:08 GMT
 */

jQuery(function(){
	jQuery('a[href="edit.php?post_type=twoj_slideshow_post&page=twoj-slideshow-support"]').click( function(event ){
		event.preventDefault();
		window.open("http://2joomla.net/wordpress/open.php?product=2jslideshow&task=support", "_blank");
	});
	jQuery('a[href="edit.php?post_type=twoj_slideshow_post&page=twoj-slideshow-demo"]').click( function(event ){
		event.preventDefault();
		window.open("http://2joomla.net/wordpress/open.php?product=2jslideshow&task=demo", "_blank");
	});
	jQuery('a[href="edit.php?post_type=twoj_slideshow_post&page=twoj-slideshow-guides"]').click( function(event ){
		event.preventDefault();
		window.open("http://2joomla.net/wordpress/open.php?product=2jslideshow&task=guides", "_blank");
	});

	jQuery(".ui-dialog-titlebar-close").addClass("ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only ui-dialog-titlebar-close");
	
});
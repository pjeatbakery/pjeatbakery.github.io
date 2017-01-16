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
	var twojSlideshowDialog = jQuery("#twoj_showInformation")/*.appendTo("body")*/;
	
	var bodyClass = twojSlideshowDialog.data("body");
	if(bodyClass) jQuery("body").addClass(bodyClass);
	twojSlideshowDialog.dialog({
		'dialogClass' : 'wp-dialog',
		'title': twojSlideshowDialog.data('title'),
		'modal' : true,
		'autoOpen' : twojSlideshowDialog.data('open'),
		'width': '450', 
	    'maxWidth': 450,
	    'height': 'auto',
	    'fluid': true, 
	    'resizable': false,
		'responsive': true,
		'draggable': false,
		'closeOnEscape' : true,
		'buttons' : [{
				'text'  : 	twojSlideshowDialog.data('close'),
				'class' : 	'button button-default twoj_dialog_close',
				'click' : 	function() { jQuery(this).dialog('close'); }
		},
		{
				'text' : 	twojSlideshowDialog.data('info'),
				'class' : 	'button-primary twoj_getproversion_blank twoj_close_dialog',
				'click' : 	function(){}
		}
		],
		open: function( event, ui ) {}
	});
	window['twojSlideshowDialog'] = twojSlideshowDialog;
	
	jQuery('.twoj-block-premium').click( function(event ){
		event.preventDefault();
		twojSlideshowDialog.dialog("open");
	});
});
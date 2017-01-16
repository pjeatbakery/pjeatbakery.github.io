/*  
 * 2J SlideShow		http://2joomla.net/wordpress
 * Version:           1.3.2 - 98240
 * Author:            2J Team (c)
 * Author URI:        http://2joomla.net/wordpress
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Date:              Fri, 09 Dec 2016 06:54:08 GMT
 */

(function ($) {
	$('.pw-gallery').each(function() {
		var instance = this;
		var imgIdInput = $('.pw-gallary-value', instance);
		$('#twoj_slides', instance).click(function(event){
			event.preventDefault();
			var idList = imgIdInput.val();
			var gallerysc = '[gallery ids="' +idList+ '"]';
  			wp.media.gallery.edit(gallerysc).on('update', function(g){
				var id_array = [];
				var marginCountCheck = 99;
				var marginCount = 0;
				$.each( g.models, function(id, img) { ++marginCount; if( TWOJ_SLIDESHOW_PRO==1 || (marginCountCheck >= marginCount) ) id_array.push(img.id); });
				if( TWOJ_SLIDESHOW_PRO==0 && ( marginCount > marginCountCheck ) ) alert(twoj_slideshow_trans.twoj_image_text);
				imgIdInput.val(id_array.join(","));
			});
  			if(idList==' ' || idList=='' ){
  				$('.media-frame-menu .media-menu-item').eq(2).click();
  			}
		});
	});

	var twojShortCodeDialog = jQuery("#twoj_showShortCodeDialog");
	
	twojShortCodeDialog.dialog({
		'dialogClass' : 'wp-dialog',
		'title': twojShortCodeDialog.data('title'),
		'modal' : true,
		'autoOpen' : twojShortCodeDialog.data('open'),
		'width': '350',
	    'maxWidth': 350,
	    'height': 'auto',
	    'fluid': true, 
	    'resizable': false,
		'responsive': true,
		'draggable': false,
		'closeOnEscape' : true,
		'buttons' : [{
				'text'  : 	twojShortCodeDialog.data('close'),
				'class' : 	'button button-default twoj_dialog_close',
				'click' : 	function() { jQuery(this).dialog('close'); }
		}
		],
		open: function( event, ui ) {}
	});
	window['twojShortCodeDialog'] = twojShortCodeDialog;
	$('#twoj_2jslideshow_getshortcode').click(function(event) {
		event.preventDefault();
		twojShortCodeDialog.dialog("open");
	});
}(jQuery));
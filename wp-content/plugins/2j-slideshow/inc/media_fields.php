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

function twoj_hide_attachment_field() {
	echo "<style>"
	.".compat-attachment-fields tr.compat-field-twojs_gallery_line,"
	.".compat-attachment-fields tr.compat-field-twojs_gallery_link_options,"
	.".compat-attachment-fields tr.compat-field-twojs_gallery_type_link,"
	.".compat-attachment-fields tr.compat-field-twojs_style,"
	.".compat-attachment-fields tr.compat-field-twojs_opacity,"
	.".compat-attachment-fields tr.compat-field-twojs_padding,"
	.".compat-attachment-fields tr.compat-field-twojs_position,"
	.".compat-attachment-fields tr.compat-field-twojs_size,"
	.".compat-attachment-fields tr.compat-field-twojs_gallery_link{display:none; }</style>";
}
add_action('admin_head', 'twoj_hide_attachment_field');
 	
 	if( !function_exists('twojGetMediaOptions') ){
	 	function twojGetMediaOptions( $listSelect, $selectOption = ''){
			$optionsHtml = '';
			if(count($listSelect))
				foreach($listSelect as $key => $value) $optionsHtml .= '<option value="'.$key.'" '.selected($selectOption, $key, 0).'>'.$value.'</option>';
			return $optionsHtml;
		}
	}

	function twoj_slideshow_attachment_field_credit( $form_fields, $post ) {
		
		$form_fields[TWOJ_SLIDESHOW_PREFIX.'gallery_line'] = array(
			'label' => '',
			'input' => 'html',
			'html' 	=> '<h4>'.__('2J Slideshow', 'twoj_slideshow').'</h4>'
		);
		
		
		$form_fields[TWOJ_SLIDESHOW_PREFIX.'gallery_link'] = array(
			'label' => __('Link\Video\JS'),
			'input' => 'text',
			'value' => get_post_meta( $post->ID, TWOJ_SLIDESHOW_PREFIX.'gallery_link', true ),
		);

		$value = get_post_meta( $post->ID, TWOJ_SLIDESHOW_PREFIX.'gallery_link_options', true );
		$old_value = get_post_meta( $post->ID, TWOJ_SLIDESHOW_PREFIX.'gallery_type_link', true );
		$selectBox = 
		"<select name='attachments[{$post->ID}][".TWOJ_SLIDESHOW_PREFIX."gallery_link_options]' id='attachments[{$post->ID}][".TWOJ_SLIDESHOW_PREFIX."gallery_link_options]'>
    		<option value='0' ".($value=='0' || !$value 		?'selected':'').">".__( 'Link' )."</option>
			<option value='1' ".($value=='1' ||$old_value=='6'	?'selected':'').">".__( 'Link on new window' )."</option>
    		<option value='2' ".($value=='2'					?'selected':'').">".__( 'Javascript' )."</option>
		</select>"; 

		$form_fields[TWOJ_SLIDESHOW_PREFIX.'gallery_link_options'] = array(
			'label' 	=> __('Type Link'),
			'input' 	=> 'html',
			'default' 	=> '0',
			'value' 	=> $value,
			'html' 		=> $selectBox 
		);

		$value = get_post_meta( $post->ID, TWOJ_SLIDESHOW_PREFIX.'gallery_type_link', true );
		$selectBox = 
		"<select name='attachments[{$post->ID}][".TWOJ_SLIDESHOW_PREFIX."gallery_type_link]' id='attachments[{$post->ID}][".TWOJ_SLIDESHOW_PREFIX."gallery_type_link]'>
    		<option value='0' ".($value=='0' || !$value ?'selected':'').">".__( 'Image' , 'cmb' )."</option>
			
			<option value='1' ".($value=='1'?'selected':'').">".__( 'Video' , 'cmb' )."</option>
    		<option value='2' ".($value=='2'?'selected':'').">".__( 'Video + splash images' , 'cmb' )."</option>
    		
    		<option value='3' ".($value=='3'?'selected':'').">".__( 'Description text' , 'cmb' )."</option>
    		<option value='4' ".($value=='4'?'selected':'').">".__( 'Image + Description text' , 'cmb' )."</option>
    		</select>";	
  

		$form_fields[TWOJ_SLIDESHOW_PREFIX.'gallery_type_link'] = array(
			'label' 	=> __('Type Slide'),
			'input' 	=> 'html',
			'default' 	=> 'link',
			'value' 	=> $value,
			'html' 		=> $selectBox 
		);


		$value = get_post_meta( $post->ID, TWOJ_SLIDESHOW_PREFIX.'style', true );
		$listSelect = array(
			 'light' 	=> __( 'light' , 	'cmb' ),
			 'dark'	 	=> __( 'dark' , 	'cmb' ),
			 'purple' 	=> __( 'purple' , 	'cmb' ),
			 'blue' 	=> __( 'blue' , 	'cmb' ),
			 'darkblue'	=> __( 'dark blue' ,'cmb' ),
			 'red'		=> __( 'red' , 		'cmb' ),
			 'yellow'	=> __( 'yellow' , 	'cmb' ),
			 'green'	=> __( 'green' , 	'cmb' ),
			 'orange'	=> __( 'orange' , 	'cmb' ),
			 'violet'	=> __( 'violet' , 	'cmb' ),
			 'pink'		=> __( 'pink' , 	'cmb' ),
			 'brown'	=> __( 'brown' , 	'cmb' ),
			 'coral'	=> __( 'coral' , 	'cmb' ),
			 'redviolet'=> __( 'redviolet' ,'cmb' ),
			 'salmon'	=> __( 'salmon' , 	'cmb' ),
			 'rosepink'	=> __( 'rosepink' , 	'cmb' ),
			 'redorange'	=> __( 'redorange' , 	'cmb' ),
			 'carmine'	=> __( 'carmine' , 	'cmb' ),
			 'maroon'	=> __( 'maroon' , 	'cmb' ),
			 'fuchia'	=> __( 'fuchia' , 	'cmb' ),
			 'seashell'	=> __( 'seashell' , 	'cmb' ),
			 'yellowgreen'	=> __( 'yellowgreen' , 	'cmb' ),

			 
			 	 
		);
		$selectBox = "<select name='attachments[{$post->ID}][".TWOJ_SLIDESHOW_PREFIX."style]' id='attachments[{$post->ID}][".TWOJ_SLIDESHOW_PREFIX."style]'>";
		$selectBox .= twojGetMediaOptions( $listSelect, $value );
		$selectBox .= '</select>';
		$form_fields[TWOJ_SLIDESHOW_PREFIX.'style'] = array(
			'label' 	=> __('Style'),
			'input' 	=> 'html',
			'default' 	=> 'light',
			'value' 	=> $value,
			'html' 		=> $selectBox 
		);

		/* 10 20 30 40 50 60 70 80 90  */
		$value = get_post_meta( $post->ID, TWOJ_SLIDESHOW_PREFIX.'opacity', true );
		$listSelect = array(
			 '' 	=> __( 'off' , 'cmb' ),
			 '10'	 	=> '10%',
			 '20'	 	=> '20%',
			 '30'	 	=> '30%',
			 '40'	 	=> '40%',
			 '50'	 	=> '50%',
			 '60'	 	=> '60%',
			 '70'	 	=> '70%',
			 '80'	 	=> '80%',
			 '90'	 	=> '90%',		 
		);
		$selectBox = "<select name='attachments[{$post->ID}][".TWOJ_SLIDESHOW_PREFIX."opacity]' id='attachments[{$post->ID}][".TWOJ_SLIDESHOW_PREFIX."opacity]'>";
		$selectBox .= twojGetMediaOptions( $listSelect, $value );
		$selectBox .= '</select>';
		$form_fields[TWOJ_SLIDESHOW_PREFIX.'opacity'] = array(
			'label' 	=> __('Opacity'),
			'input' 	=> 'html',
			'default' 	=> '70%',
			'value' 	=> $value,
			'html' 		=> $selectBox 
		);
		
		/*  padding 10 20 30 40 50 60 70 80 90 1p 2p 3p 5p 7p 10p 20p */
		$value = get_post_meta( $post->ID, TWOJ_SLIDESHOW_PREFIX.'padding', true );
		$listSelect = array(
			'' 			=> __( 'off' , 'cmb' ),
			'10'	 	=> '10',
			'20'	 	=> '20',
			'30'	 	=> '30',
			'40'	 	=> '40',
			'50'	 	=> '50',
			'60'	 	=> '60',
			'70'	 	=> '70',
			'80'	 	=> '80',
			'90'	 	=> '90',		 
			'1p'	 	=> '1%',		 
			'2p'	 	=> '2%',		 
			'3p'	 	=> '3%',		 
			'5p'	 	=> '5%',		 
			'7p'	 	=> '7%',		 
			'10p'	 	=> '10%',		 
			'20p'	 	=> '20%',		 
			
		);
		$selectBox = "<select name='attachments[{$post->ID}][".TWOJ_SLIDESHOW_PREFIX."padding]' id='attachments[{$post->ID}][".TWOJ_SLIDESHOW_PREFIX."padding]'>";
		$selectBox .= twojGetMediaOptions( $listSelect, $value );
		$selectBox .= '</select>';
		$form_fields[TWOJ_SLIDESHOW_PREFIX.'padding'] = array(
			'label' 	=> __('Padding'),
			'input' 	=> 'html',
			'default' 	=> '20',
			'value' 	=> $value,
			'html' 		=> $selectBox 
		);

		 /* left bottom right top | 30 40 50 60 70 100  */
		 $value = get_post_meta( $post->ID, TWOJ_SLIDESHOW_PREFIX.'position', true );
		$listSelect = array(
			'left' 		=> __( 'left' , 	'cmb' ),
			'bottom'	=> __( 'bottom' , 	'cmb' ),
			'right'	 	=> __( 'right' , 	'cmb' ),
			'top'	 	=> __( 'top' , 		'cmb' ),
		);
		$selectBox = "<select name='attachments[{$post->ID}][".TWOJ_SLIDESHOW_PREFIX."position]' id='attachments[{$post->ID}][".TWOJ_SLIDESHOW_PREFIX."position]'>";
		$selectBox .= twojGetMediaOptions( $listSelect, $value );
		$selectBox .= '</select>';
		$form_fields[TWOJ_SLIDESHOW_PREFIX.'position'] = array(
			'label' 	=> __('Position'),
			'input' 	=> 'html',
			'default' 	=> 'bottom',
			'value' 	=> $value,
			'html' 		=> $selectBox 
		);

		/* left bottom right top | 30 40 50 60 70 100  */
		 $value = get_post_meta( $post->ID, TWOJ_SLIDESHOW_PREFIX.'size', true );
		$listSelect = array(
			'5'	 	=> '5%',
			'10'	 	=> '10%',
			'15'	 	=> '15%',
			'20'	 	=> '20%',
			'30'	 	=> '30%',
			'40'	 	=> '40%',
			'50'	 	=> '50%',
			'60'	 	=> '60%',
			'70'	 	=> '70%',
			'100'	 	=> '100%',	
		);
		$selectBox = "<select name='attachments[{$post->ID}][".TWOJ_SLIDESHOW_PREFIX."size]' id='attachments[{$post->ID}][".TWOJ_SLIDESHOW_PREFIX."size]'>";
		$selectBox .= twojGetMediaOptions( $listSelect, $value );
		$selectBox .= '</select>';
		$form_fields[TWOJ_SLIDESHOW_PREFIX.'size'] = array(
			'label' 	=> __('Size'),
			'input' 	=> 'html',
			'default' 	=> '40',
			'value' 	=> $value,
			'html' 		=> $selectBox 
		);

		return $form_fields;
	}
	add_filter( 'attachment_fields_to_edit', 'twoj_slideshow_attachment_field_credit', 10, 2 );

	function twoj_slideshow_attachment_field_credit_save( $post, $attachment ) {
		if( isset( $attachment[TWOJ_SLIDESHOW_PREFIX.'gallery_video_link'] ) )
			update_post_meta( $post['ID'], TWOJ_SLIDESHOW_PREFIX.'gallery_video_link', esc_url( $attachment[TWOJ_SLIDESHOW_PREFIX.'gallery_video_link'] ) );
		
		if( isset( $attachment[TWOJ_SLIDESHOW_PREFIX.'gallery_link'] ) )
			update_post_meta( $post['ID'], TWOJ_SLIDESHOW_PREFIX.'gallery_link',  $attachment[TWOJ_SLIDESHOW_PREFIX.'gallery_link'] );
		
		if( isset( $attachment[TWOJ_SLIDESHOW_PREFIX.'gallery_link_options'] ) )
			update_post_meta( $post['ID'], TWOJ_SLIDESHOW_PREFIX.'gallery_link_options', $attachment[TWOJ_SLIDESHOW_PREFIX.'gallery_link_options'] );
		
		if( isset( $attachment[TWOJ_SLIDESHOW_PREFIX.'gallery_type_link'] ) )
			update_post_meta( $post['ID'], TWOJ_SLIDESHOW_PREFIX.'gallery_type_link',  $attachment[TWOJ_SLIDESHOW_PREFIX.'gallery_type_link'] );
		

		if( isset( $attachment[TWOJ_SLIDESHOW_PREFIX.'style'] ) )
			update_post_meta( $post['ID'], TWOJ_SLIDESHOW_PREFIX.'style', $attachment[TWOJ_SLIDESHOW_PREFIX.'style'] );
		
		if( isset( $attachment[TWOJ_SLIDESHOW_PREFIX.'opacity'] ) )
			update_post_meta( $post['ID'], TWOJ_SLIDESHOW_PREFIX.'opacity', $attachment[TWOJ_SLIDESHOW_PREFIX.'opacity'] );
		
		if( isset( $attachment[TWOJ_SLIDESHOW_PREFIX.'padding'] ) )
			update_post_meta( $post['ID'], TWOJ_SLIDESHOW_PREFIX.'padding', $attachment[TWOJ_SLIDESHOW_PREFIX.'padding'] );
		
		if( isset( $attachment[TWOJ_SLIDESHOW_PREFIX.'position'] ) )
			update_post_meta( $post['ID'], TWOJ_SLIDESHOW_PREFIX.'position', $attachment[TWOJ_SLIDESHOW_PREFIX.'position'] );
		
		if( isset( $attachment[TWOJ_SLIDESHOW_PREFIX.'size'] ) )
			update_post_meta( $post['ID'], TWOJ_SLIDESHOW_PREFIX.'size', $attachment[TWOJ_SLIDESHOW_PREFIX.'size'] );
		
		
		return $post;
	}
	add_filter( 'attachment_fields_to_save', 'twoj_slideshow_attachment_field_credit_save', 10, 2 );
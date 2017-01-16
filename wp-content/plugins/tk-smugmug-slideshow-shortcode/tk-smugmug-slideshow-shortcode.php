<?php
/*
Plugin Name: TK SmugMug Slideshow Shortcode
Plugin URI: https://wordpress.org/plugins/tk-smugmug-slideshow-shortcode/
Description: Adds <strong>[smugmug-slideshow]</strong> shortcode. Uses Shortcake (Shortcode UI) plugin.
Version: 1.4
Author: TourKick (Clifford Paulick)
Author URI: http://tourkick.com/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain: tk-smugmug-slideshow-shortcode
*/



/* IDEAS:
- Height: http://stackoverflow.com/a/19928835/893907, https://github.com/davidjbradshaw/iframe-resizer (like Fitvids but for all iframes), etc.
- Settings page for customizing defaults
- Widget and/or just enable shortcodes in widget (but then no UI)
- frameborder and scrolling not valid in HTML5; use CSS instead
- customizable text if iframes not supported in browser -- possibly also display it if HTTPS page, since SmugMug doesn't display over HTTPS
*/


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ){
	die;
}


if ( ! class_exists( 'TK_SmugMug_Slideshow_Shortcode' ) ) {
  
  class TK_SmugMug_Slideshow_Shortcode {
    
    var $shortcode_tag = 'smugmug-slideshow';
    
    public function __construct() {
    	add_shortcode( $this->shortcode_tag, array( $this, 'shortcode' ) );
      add_action( 'register_shortcode_ui', array( $this, 'register_ui' ) );
    	
      require_once dirname( __FILE__ ) . '/inc/class-tgm-plugin-activation.php';
      add_action( 'tgmpa_register', array( $this, 'tgm_plugins' ) );
    }
    
    /**
     * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
     * @see https://github.com/TGMPA/TGM-Plugin-Activation/blob/develop/example.php
     *
     * @package    TGM-Plugin-Activation
     * @version    2.5.2
     * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
     * @copyright  Copyright (c) 2011, Thomas Griffin
     * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
     * @link       https://github.com/TGMPA/TGM-Plugin-Activation
     */
    
    /**
     * Include the TGM_Plugin_Activation class.
     */
    /**
     * Register the required plugins for this theme.
     *
     * In this example, we register five plugins:
     * - one included with the TGMPA library
     * - two from an external source, one from an arbitrary source, one from a GitHub repository
     * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
     *
     * The variable passed to tgmpa_register_plugins() should be an array of plugin
     * arrays.
     *
     * This function is hooked into tgmpa_init, which is fired within the
     * TGM_Plugin_Activation class constructor.
     */
    public function tgm_plugins() {
    	/*
    	 * Array of plugin arrays. Required keys are name and slug.
    	 * If the source is NOT from the .org repo, then source is also required.
    	 */
    	$plugins = array(
    
    		// This is an example of how to include a plugin from the WordPress Plugin Repository.
    		array(
    			'name'		=> 'Shortcake (Shortcode UI)',
    			'slug'		=> 'shortcode-ui',
    			'required'	=> false,
    		),
    	);
    
    	/*
    	 * Array of configuration settings. Amend each line as needed.
    	 *
    	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
    	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
    	 * sending in a pull-request with .po file(s) with the translations.
    	 *
    	 * Only uncomment the strings in the config array if you want to customize the strings.
    	 */
    	$config = array(
    		'id'           => 'tk_smugmug_slideshow_shortcode_tgmpa',	// Unique ID for hashing notices for multiple instances of TGMPA.
    		'has_notices'  => true,			// Show admin notices or not.
    		'dismissable'  => true,			// If false, a user cannot dismiss the nag message.
    		'is_automatic' => true,			// Automatically activate plugins after installation or not.
    	);
    
    	tgmpa( $plugins, $config );
    }
    
    // sanitize_html_classes() is from https://gist.github.com/justnorris/5387539
     // sanitize_html_class works just fine for a single class
     // Some times the wild <span class="blue hedgehog"> appears, which is when you need this function,
     // to validate both blue and hedgehog,
     // Because sanitize_html_class doesn't allow spaces.
     //
     // @uses   sanitize_html_class
     // @param  (mixed: string/array) $class "blue hedgehog goes shopping" or array("blue", "hedgehog", "goes", "shopping")
     // @param  (mixed) $fallback Anything you want returned in case of a failure
     // @return (mixed: string / $fallback )
    private function val_classes( $class, $fallback = '' ) {
    	if ( empty( $class ) ) {
    		return $fallback;
    	}
    	
    	// Explode it, if it's a string
    	if ( is_string( $class ) ) {
    		$class = explode( ' ', $class );
    	}
    	
    	if ( is_array( $class ) && count( $class ) > 0 ) {
    		$class = array_map( 'sanitize_html_class', $class );
    		return implode( ' ', $class );
    	} else { 
    		return sanitize_html_class( $class, $fallback );
    	}
    }
    
    private function val_domain( $input, $output = '' ) {
      // shouldn't be using full URL anyway, but just because...
      $input = str_ireplace( 'http://', '', $input );
      $input = str_ireplace( 'https://', '', $input ); // SmugMug doesn't support SSL/HTTPS but might as well check
      
      $input = trim( $input );
      
      $input = strtolower( $input );
      
      if( empty( $input ) ) {
        return $output;
      }
      
      // shouldn't because it's the default, but skip out if it is
      if( 'smugmug.com' == $input ) {
        return $output;
      }
      
      // max 50 character custom domain, per http://help.smugmug.com/customer/en/portal/articles/93340-how-do-i-use-my-custom-domain-
      if( 50 < strlen( $input ) ) {
        return $output;
      }
      
      $domain_pattern = '/^([a-z0-9\-]+\.){1,2}[a-z]{2,30}/'; // allows between 2 and 30 length TLD
        // matches:
          // tourkick.smugmug.com
          // 80.90.com
          // test.media.tourkick (not valid domain but right format)
        // non-matches:
          // 20.80.90.com
          // test.media.tourkick.com (.com isn't a match -- it thinks 'tourkick' is the TLD)
      
      if( 1 === preg_match( $domain_pattern, $input ) ) {
        $output = $input;
      }
      
      return $output;
    }
    
    private function val_alphanumeric( $input, $output = '' ) {
      $input = trim( $input );
      
      if( empty( $input ) ) {
        return $output;
      }
      
      if( ctype_alnum( $input ) ) {
        $output = $input;
      }
      
      return $output;
    }
    
    private function val_truefalse( $input, $output = '' ) {
      $input = trim( $input );
      
      $input = strtolower( $input );
      
      if( empty( $input ) ) {
        return $output;
      }
      
      $true = array(
        '1',
        'true',
      );
      
      $false = array(
        '0',
        'false',
      );
      
      if( in_array( $input, $true ) ) {
        $input = '1';
      }
      
      if( in_array( $input, $false ) ) {
        $input = '0';
      }
      
      $truefalse = array(
        '1',
        '0',
      );
      
      if( in_array( $input, $truefalse ) ) {
        $output = $input;
      }
      
      return $output;
    }
    
    private function val_integer( $input, $output = '' ) {
      $input = trim( $input );
      
      if( empty( $input ) ) {
        return $output;
      }
      
      if( is_numeric( $input ) ) {
        $output = intval( $input );
      }
      
      return $output;
    }
    
/*
    private function val_transition( $input, $output = '' ) {
      $input = trim( $input );
      
      $input = strtolower( $input );
      
      if( empty( $input ) ) {
        return $output;
      }
      
      if( 'true' == $transition ) { // 'Disable Fade' checkbox is checked
        $input = 'none';
      }
      
      $transitions = array(
        'none',
        'fade',
      );
      
      if( in_array( $input, $transitions ) ) {
        $output = $input;
      }
      
      return $output;
    }
*/
    
    private function allowed_css_units_array( $prepend_empty = false ) {
      // ref: http://www.w3schools.com/cssref/css_units.asp
      $units = array(
        '%'     => '%',
        'em'    => 'em',
        'ex'    => 'ex',
        'px'    => 'px',
        'cm'    => 'cm',
        'mm'    => 'mm',
        'in'    => 'in',
        'pt'    => 'pt',
        'pc'    => 'pc',
        'ch'    => 'ch',
        'rem'   => 'rem',
        'vh'    => 'vh',
        'vw'    => 'vw',
        'vmin'  => 'vmin',
        //'vm'    => 'vm', // non-standard for IE 9 only so NO
        'vmax'  => 'vmax',
      );
      
      if( true == $prepend_empty ) {
  			$units = array( '' => '' )+$units;
  		}
      
      return $units;
    }
    
    private function val_css_length_units( $input, $output = '' ) {
      $input = trim( $input );
      
      $input = strtolower( $input );
      
      if( empty( $input ) ) {
        return $output;
      }
      
      $units = $this->allowed_css_units_array();
      
      if( in_array( $input, $units ) ) {
        $output = $input;
      }
      
      return $output;
    }
    
    
    public function register_ui() {
    
    	/**
    	 * Register UI for your shortcode
    	 *
    	 * @param string $shortcode_tag
    	 * @param array $ui_args
    	 */
    	shortcode_ui_register_for_shortcode( $this->shortcode_tag,
    		array(
    			/*
    			 * How the shortcode should be labeled in the UI. Required argument.
    			 */
    			'label' => esc_html__( 'SmugMug Slideshow', 'tk-smugmug-slideshow-shortcode' ),
    			/*
    			 * Include an icon with your shortcode. Optional.
    			 * Use a dashicon, or full URL to image.
    			 */
    			'listItemImage' => 'dashicons-images-alt',
    			/*
    			 * Register UI for attributes of the shortcode. Optional.
    			 *
    			 * If no UI is registered for an attribute, then the attribute will 
    			 * not be editable through Shortcake's UI. However, the value of any 
    			 * unregistered attributes will be preserved when editing.
    			 * 
    			 * Each array must include 'attr', 'type', and 'label'.
    			 * 'attr' should be the name of the attribute.
    			 * 'type' options include: text, checkbox, textarea, radio, select, email, 
    			 *     url, number, and date, post_select, attachment, color.
    			 * Use 'meta' to add arbitrary attributes to the HTML of the field.
    			 * Use 'encode' to encode attribute data. Requires customization to callback to decode.
    			 * Depending on 'type', additional arguments may be available.
    			 */
    			'attrs' => array(
    				array(
    					'label'       => esc_html__( 'Custom SmugMug Domain (Optional)', 'tk-smugmug-slideshow-shortcode' ),
    					'description' => sprintf( __('Domain Only (no http://) -- More info at %s', 'tk-smugmug-slideshow-shortcode' ), "<a href='http://help.smugmug.com/customer/en/portal/articles/93340-how-do-i-use-my-custom-domain-' target='_blank'>SmugMug: How do I use my custom domain?</a>" ),
    					'attr'        => 'domain',
    					'type'        => 'text',
    					'meta'        => array(
  			        'placeholder' => sprintf( esc_html__( 'Example: %s', 'tk-smugmug-slideshow-shortcode' ), 'media.tourkick.com' ),
    					),
    				),
    				array(
    					'label'       => esc_html__( 'SmugMug Album Key (Required)', 'tk-smugmug-slideshow-shortcode' ),
    					'description' => __( 'How-to find: <ol><li>Go to your SmugMug gallery/album</li><li>right-click</li><li>click "View Page Source"</li><li>then search for "albumKey"</li></ol>Alternatively, you can click to generate the slideshow and copy it from the generated iframe code.', 'tk-smugmug-slideshow-shortcode' ),
    					'attr'        => 'key',
    					'type'        => 'text',
    					'meta'        => array(
  			        'placeholder' => sprintf( esc_html__( 'Example: %s', 'tk-smugmug-slideshow-shortcode' ), 'TrBCmb' ),
    					),
    				),
    				array(
    					'label'       => esc_html__( 'Disable Auto Start', 'tk-smugmug-slideshow-shortcode' ),
    					'description' => __( 'If you disable Auto Start, the viewer will NOT be able to view the slideshow unless you enable Navigation and/or Play Button.', 'tk-smugmug-slideshow-shortcode' ),
    					'attr'        => 'autostart_off',
    					'type'        => 'checkbox',
    					//'value'     => 'true',
    				),
    				array(
    					'label'       => esc_html__( 'Captions', 'tk-smugmug-slideshow-shortcode' ),
    					'attr'        => 'captions',
    					'type'        => 'checkbox',
    				),
    				array(
    					'label'       => esc_html__( 'Navigation Arrows', 'tk-smugmug-slideshow-shortcode' ),
    					'attr'        => 'navigation',
    					'type'        => 'checkbox',
    				),
    				array(
    					'label'       => esc_html__( 'Play Button', 'tk-smugmug-slideshow-shortcode' ),
    					'attr'        => 'playbutton',
    					'type'        => 'checkbox',
    				),
    				array(
    					'label'       => esc_html__( 'Slideshow Speed (in seconds)', 'tk-smugmug-slideshow-shortcode' ),
    					'description' => esc_html__( 'Default: 3', 'tk-smugmug-slideshow-shortcode' ),
    					'attr'        => 'speed',
    					'type'        => 'number',
    				),
    				array(
    					'label'       => esc_html__( 'Disable Fade Transition', 'tk-smugmug-slideshow-shortcode' ),
    					'attr'        => 'transition_off',
    					'type'        => 'checkbox',
    				),
    				array(
    					'label'       => esc_html__( 'Transition Speed (in seconds)', 'tk-smugmug-slideshow-shortcode' ),
    					'description' => esc_html__( 'Default: 2', 'tk-smugmug-slideshow-shortcode' ),
    					'attr'        => 'transitionspeed',
    					'type'        => 'number',
    				),
    				array(
    					'label'       => esc_html__( 'Width', 'tk-smugmug-slideshow-shortcode' ),
    					'description' => esc_html__( 'Default: 100', 'tk-smugmug-slideshow-shortcode' ),
    					'attr'        => 'width',
    					'type'        => 'number',
    				),
    				array(
    					'label'       => esc_html__( 'Width Units', 'tk-smugmug-slideshow-shortcode' ),
    					'description' => esc_html__( 'Default: %', 'tk-smugmug-slideshow-shortcode' ),
    					'attr'        => 'widthunits',
    					'type'        => 'select',
    					'options'     => $this->allowed_css_units_array( true ),
    				),
    				array(
    					'label'       => esc_html__( 'Height', 'tk-smugmug-slideshow-shortcode' ),
    					'description' => esc_html__( 'Default: 600', 'tk-smugmug-slideshow-shortcode' ),
    					'attr'        => 'height',
    					'type'        => 'number',
    				),
    				array(
    					'label'       => esc_html__( 'Height Units', 'tk-smugmug-slideshow-shortcode' ),
    					'description' => esc_html__( 'Default: px', 'tk-smugmug-slideshow-shortcode' ),
    					'attr'        => 'heightunits',
    					'type'        => 'select',
    					'options'     => $this->allowed_css_units_array( true ),
    				),
    				array(
    					'label'			=> esc_html__( 'Custom CSS Class(es)', 'tk-smugmug-slideshow-shortcode' ),
    					'attr'			=> 'class',
    					'type'			=> 'text',
    					'description'	=> esc_html__( '(Advanced) Add custom CSS class(es) to iframe', 'tk-smugmug-slideshow-shortcode' ),
    					'meta'			=> array(
    						'placeholder' => esc_html__( 'my-class-1 other-custom-class', 'tk-smugmug-slideshow-shortcode' ),
    					),
    				),
    			),
    		)
    	);
    }
    
    
    /**
     * Render the shortcode based on supplied attributes
     */
    public function shortcode( $atts, $content = '' ) {
      
      global $content_width;
      
      if( ! empty( $content_width ) ) {
        $iframe_width = $content_width;
      } else {
        $iframe_width = '800';
      }
      
      
      $shortcode_tag = $this->shortcode_tag;
    
    	$atts = shortcode_atts( array(
      	'domain'            => '', // if something other than smugmug.com -- e.g. media.tourkick.com -- http://help.smugmug.com/customer/en/portal/articles/93340-how-do-i-use-my-custom-domain-
      	'key'               => '',
    		'autostart_off'     => '',
    		'captions'          => '',
    		'navigation'        => '',
    		'playbutton'        => '',
    		'speed'             => '', // number of seconds
    		'transition_off'    => '', // fade on/off
    		'transitionspeed'   => '', // number of seconds
    		'width'             => '', // e.g. '100'
    		'widthunits'        => '', // e.g. '%'
    		'height'            => '',
    		'heightunits'       => '',
      	'class'             => '', // custom CSS class
    	), $atts, $shortcode_tag );
    	
    	$domain = $this->val_domain( $atts['domain'] );
    	  $domain = $domain ? $domain : apply_filters( 'tk_smugmug_slideshow_shortcode_default_domain', 'smugmug.com' );
      
    	$key = $this->val_alphanumeric( $atts['key'] );
    	  if( empty( $key ) ) {
      	  return ''; // $key is required for any iframe
    	  }
      
    	$autostart_off = $this->val_truefalse( $atts['autostart_off'] );
    	  $autostart_off = $autostart_off ? $autostart_off : apply_filters( 'tk_smugmug_slideshow_shortcode_default_autostart_off', false );
      
      if( $autostart_off ) {
        $autostart = 0;
      } else {
        $autostart = 1;
      }
    	  
    	$captions = $this->val_truefalse( $atts['captions'] );
    	  $captions = $captions ? $captions : apply_filters( 'tk_smugmug_slideshow_shortcode_default_captions', 0 );
    	
    	$navigation = $this->val_truefalse( $atts['navigation'] );
    	  $navigation = $navigation ? $navigation : apply_filters( 'tk_smugmug_slideshow_shortcode_default_navigation', 0 );
    	
    	$playbutton = $this->val_truefalse( $atts['playbutton'] );
    	  $playbutton = $playbutton ? $playbutton : apply_filters( 'tk_smugmug_slideshow_shortcode_default_playbutton', 0 );
    	
    	$speed = $this->val_integer( $atts['speed'] );
    	  if( 1 > $speed ) {
      	  $speed = apply_filters( 'tk_smugmug_slideshow_shortcode_default_speed', 3 );
    	  }
    	
    	$transition_off = $this->val_truefalse( $atts['transition_off'] );
    	  $transition_off = $transition_off ? $transition_off : apply_filters( 'tk_smugmug_slideshow_shortcode_default_transition_off', false );
      
      if( $transition_off ) {
        $transition = 'none';
      } else {
        $transition = 'fade';
      }
    	
    	$transitionspeed = $this->val_integer( $atts['transitionspeed'] );
    	  if( 1 > $transitionspeed ) {
      	  $transitionspeed = apply_filters( 'tk_smugmug_slideshow_shortcode_default_transitionspeed', 2 );
    	  }
    	
    	$width = $this->val_integer( $atts['width'] );
    	  if( 1 > $width ) {
      	  $width = apply_filters( 'tk_smugmug_slideshow_shortcode_default_width', 100 );
    	  }
    	
    	$widthunits = $this->val_css_length_units( $atts['widthunits'] );
    	  $widthunits = $widthunits ? $widthunits : apply_filters( 'tk_smugmug_slideshow_shortcode_default_widthunits', '%' );
    	
    	$height = $this->val_integer( $atts['height'] );
    	  if( 1 > $height ) {
      	  $height = apply_filters( 'tk_smugmug_slideshow_shortcode_default_height', 600 );
    	  }
    	
    	$heightunits = $this->val_css_length_units( $atts['heightunits'] );
    	  $heightunits = $heightunits ? $heightunits : apply_filters( 'tk_smugmug_slideshow_shortcode_default_heightunits', 'px' );
      
    	$class = $this->val_classes( $atts['class'] );
    	
    	$no_iframe_text = sprintf( '<p>%s</p>', __( 'Your browser does not support iframes. Therefore, you cannot view this slideshow content.', 'tk-smugmug-slideshow-shortcode' ) );
    	  $no_iframe_text = apply_filters( 'tk_smugmug_slideshow_shortcode_default_noiframetext', $no_iframe_text );
    	
    	$iframe_src = sprintf( 'http://%s/frame/slideshow?key=%s&autoStart=%d&captions=%d&navigation=%d&playButton=%d&speed=%d&transition=%s&transitionSpeed=%d',
        $domain,
        $key,
        $autostart,
        $captions,
        $navigation,
        $playbutton,
        $speed,
        $transition,
        $transitionspeed
      );
      
      $iframe_src = esc_url( $iframe_src );
      
      // iframe width and height must be positive integers (without 'px'), which is why the correct way to get responsive width is by adding CSS
      $output = sprintf( '<iframe style="width: %d%s; height: %d%s" class="tk-smugmug-slideshow-shortcode %s"
          src="%s"
          width="%d"
          height="600"
          >
          %s
        </iframe>',
        $width,
        $widthunits,
        $height,
        $heightunits,
        $class,
        $iframe_src,
        $iframe_width,
        $no_iframe_text
      );
      
      return $output;
    
    }
    
  } // class
  
} // if class exists

$tk_smugmug_slideshow_shortcode = new TK_SmugMug_Slideshow_Shortcode;
add_action( 'init', array( $tk_smugmug_slideshow_shortcode, 'shortcode' ) );
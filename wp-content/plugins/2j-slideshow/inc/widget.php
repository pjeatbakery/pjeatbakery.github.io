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

class twoj_widget extends WP_Widget {

  function __construct(){
    parent::__construct(
      'twoj_widget', 
      __( '2J Slideshow Widget' , 'twoj_slideshow' ),
      array( 'description' => __( "Publish slideshow on your website.", 'twoj_slideshow' ), ) 
    );
  }

  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );
    $slideshowId = $instance['slideshowId'];

    echo $args['before_widget'];
    if( ! empty( $title ) )     echo $args['before_title'] . $title . $args['after_title'];
    
    if( TWOJ_SLIDESHOW_PRO ){
    	twojSlideshowWidget($slideshowId);
    }
    
    if(!TWOJ_SLIDESHOW_PRO) echo _e( 'This widget available in Premium version','twoj_slideshow');
    echo $args['after_widget'];
  }


  public function form( $instance ) {
    if ( isset( $instance[ 'title' ] ) ) {
      $title = $instance[ 'title' ];
    } else {
      $title = __( 'New Slideshow', 'twoj_slideshow' );
    }
    
    if ( isset( $instance[ 'slideshowId' ] ) ) {
        $slideshowId = (int) $instance[ 'slideshowId' ];
    }
    else {
        $slideshowId = 0;
    }
    $args = array(
      'child_of'     => 0,
      'sort_order'   => 'ASC',
      'sort_column'  => 'post_title',
      'hierarchical' => 1,
      'selected'     => $slideshowId,
      'name'         => $this->get_field_name( 'slideshowId' ),
      'id'           => $this->get_field_id( 'slideshowId' ),
      'echo'    => 1,
      'post_type' => 'twoj_slideshow_post'
    );
    ?>
	<?php 
	if(!TWOJ_SLIDESHOW_PRO){ ?>
    	<p><a href="http://2joomla.net/wordpress/open.php?product=2jslideshow&task=gopro" target="_blank"> <?php _e( 'This widget available in Premium version','twoj_slideshow');?> </a></p>     
	<?php } ?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">
	 		<?php _e( 'Title' ); ?>:
		</label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'slideshowId' ); ?>"><?php _e( 'Slideshow:' ); ?></label> 
		<?php wp_dropdown_pages( $args ); ?>
	</p>
	<p><?php _e( 'Configure it in','twoj_slideshow');?> 
		<a href="edit.php?post_type=twoj_slideshow_post">
			<?php _e( '2J Slideshow plugin','twoj_slideshow');?>
		</a>
	</p>
	<script type="text/javascript">jQuery(function(){ jQuery('#<?php echo $this->get_field_id( 'slideshowId' ); ?>').addClass('widefat'); });</script>
    <?php 
  }

  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['slideshowId'] = ( ! empty( $new_instance['slideshowId'] ) ) ? (int) $new_instance['slideshowId'] : 0;
    return $instance;
  }
}


function twoj_load_widget() {
  register_widget( 'twoj_widget' );
}

add_action( 'widgets_init', 'twoj_load_widget' );
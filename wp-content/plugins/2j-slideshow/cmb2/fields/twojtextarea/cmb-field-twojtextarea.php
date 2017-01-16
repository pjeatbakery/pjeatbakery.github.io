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

function jt_cmb2_twojtextarea_field( $metakey, $post_id = 0 ) {
	echo jt_cmb2_get_twojtextarea_field( $metakey, $post_id );
}

function jt_cmb2_render_twojtextarea_field_callback( $field, $value, $object_id, $object_type, $field_type_object ) {

	$value =  $value ? $value : $field->args('default') ;

?>
<div class="form-horizontal">
	<div class="form-group">
		<div class="col-sm-2">
	    	<label class=" control-label" for="<?php echo $field_type_object->_id(); ?>"><?php echo esc_html(  $field->args('name') ); ?></label>
	   		<?php echo $field_type_object->_desc( true );  ?>
	    </div>
	    <div class="<?php echo $field->args('small')?'col-sm-4':'col-sm-10'; ?>">
	    	<?php
	    		echo '<textarea '
	    				.'id="'.$field_type_object->_id().'" '
	    				.'name="'.$field_type_object->_name().'" '
	    				.'class="form-control '.$field_type_object->args('class').'" '
	    				.'rows="6"> '
	    				.$value
	    		.'</textarea>';
			?> 
	    </div>
	</div>
</div>
<?php
}
add_filter( 'cmb2_render_twojtextarea', 'jt_cmb2_render_twojtextarea_field_callback', 10, 5 );
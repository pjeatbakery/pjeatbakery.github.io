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

?>
<div class="wrap">
	<h1><?php _e('2J Slideshow Detailed Report', 'rbs_gallery'); ?></h1>
<?php 
$today = date("Y_j_n"); 

$countPosts = wp_count_posts(TWOJ_SLIDESHOW_TYPE_POST);
//print_r($countPosts);
$args = array(
	'post_type'  => TWOJ_SLIDESHOW_TYPE_POST,
	'meta_key'   => 'views',
	'posts_per_page' =>-1,
);
$views = 0;
$loop = new WP_Query($args);

if ( $loop->have_posts() ){
	for ($i=0; $i <count($loop->posts) ; $i++) { 
		$views += (int) get_post_meta( $loop->posts[$i]->ID, 'views', true);
	}
}
	?>
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row"><label ><?php _e('Slideshow Views', 'twoj_slideshow'); ?></label></th>
				<td><p><?php echo $views ; ?></p></td>
			</tr>
			<tr>
				<th scope="row"><label ><?php _e('Slideshows Amount', 'twoj_slideshow'); ?></label></th>
				<td>
	
						<?php $total =  
							$countPosts->publish + 
							$countPosts->future + 
							$countPosts->draft + 
							$countPosts->pending + 
							$countPosts->private + 
							$countPosts->trash + 
							$countPosts->inherit;
						?> 

					<p>
						<?php echo 
							$countPosts->publish.' '.__('Published', 'twoj_slideshow').' + '.
							$countPosts->future.' '.__('Future', 'twoj_slideshow') .' + '.
							$countPosts->pending.' '.__('Pending', 'twoj_slideshow') .' + '.
							$countPosts->private.' '.__('Private', 'twoj_slideshow') .' + '.
							$countPosts->draft.' '.__('Draft', 'twoj_slideshow') .' + '.
							$countPosts->trash.' '.__('Trash', 'twoj_slideshow') .' = '.
							'<strong> '.$total.' '.__('In Total', 'twoj_slideshow').'</strong>'
							;
						?>
					</p>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<?php 
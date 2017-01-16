<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function delicious_theme_setup() {
	
	/* Load the primary menu. */
	remove_action( 'omega_before_header', 'omega_get_primary_menu' );	
	add_action( 'omega_header', 'omega_get_primary_menu' );
	add_filter( 'omega_site_description', 'delicious_site_description' );

	add_action( 'omega_after_header', 'delicious_banner' );

	add_theme_support( 'omega-footer-widgets', 3 );

	/* Add support for a custom header image. */
	add_theme_support(
		'custom-header',
		array( 'header-text' => false,
			'flex-width'    => true,
			'uploads'       => true,
			'default-image' => get_stylesheet_directory_uri() . '/images/header.jpg'
			));

	add_action( 'wp_enqueue_scripts', 'delicious_scripts_styles' );

	remove_action( 'omega_before_entry', 'omega_entry_header' );
	add_action( 'omega_before_entry', 'delicious_entry_header' );
	remove_action( 'omega_before_loop', 'omega_archive_title'); 

}

add_action( 'after_setup_theme', 'delicious_theme_setup', 11 );


function delicious_site_description($desc) {
	$desc = "";
	return $desc;
}

/**
 * Display the default entry header.
 */
function delicious_entry_header() {

	echo '<header class="entry-header">';
	if ( is_home() || is_archive() || is_search() ) {
	?>
		<h2 class="entry-title" itemprop="headline"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	<?php
		get_template_part( 'partials/entry', 'byline' ); 		
	}
	echo '</header><!-- .entry-header -->';
	
}

function delicious_get_header_image() {
	if ( has_post_thumbnail(get_queried_object_id()) ) {
		$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_queried_object_id() ), 'full' );
		echo esc_url( $image_url[0] );
	} elseif (get_header_image()) {
		echo esc_url( get_header_image() );		
	} 
}

function delicious_banner() {
	?>
	<div class="banner" style="background-image:url(<?php delicious_get_header_image()?>)">
		<div class="filter">
			<div class="wrap">
				<?php
				$id = get_option('page_for_posts');
				// get title		
				if (is_front_page() || (is_home() && ($id=='0'))) {
					$the_title = "<h1 class='banner-title site-description'>" . get_bloginfo ( 'description' ) . "</h1>";
				} elseif ( is_day() || is_month() || is_year() || is_tag() || is_category() || is_home() ) {
					$id = get_option('page_for_posts');
					if ($id=='0') {
						$the_title = get_bloginfo ( 'description' );
					} else {
						$the_title = get_the_title($id);
					}
					$the_title = "<h2 class='banner-title'>$the_title</h2>";
				} else {
					$the_title = "<h1 class='banner-title'>" . get_the_title() . "</h1>"; 
				}
				echo $the_title;
				if (is_singular('post' )) {
					get_template_part( 'partials/entry', 'byline' ); 		
				} elseif(is_archive() || is_search() ) {
					delicious_archive_title();
				}
				?>
			</div><!-- .wrap -->
		</div>
  	</div><!-- .banner -->
  	<?php 
}

function delicious_archive_title() {
	if(is_archive() || is_search() ) {
	?>
			<h3 class="archive-title">
				<?php
					if ( is_category() ) :
						single_cat_title();

					elseif ( is_search() ) :
						printf( __( 'Search Results for: %s', 'delicious' ), '<span>' . get_search_query() . '</span>' );

					elseif ( is_tag() ) :
						single_tag_title();

					elseif ( is_author() ) :
						/* Queue the first post, that way we know
						 * what author we're dealing with (if that is the case).
						*/
						the_post();
						printf( __( 'Author: %s', 'delicious' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
						/* Since we called the_post() above, we need to
						 * rewind the loop back to the beginning that way
						 * we can run the loop properly, in full.
						 */
						rewind_posts();

					elseif ( is_day() ) :
						printf( __( 'Day: %s', 'delicious' ), '<span>' . get_the_date() . '</span>' );

					elseif ( is_month() ) :
						printf( __( 'Month: %s', 'delicious' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

					elseif ( is_year() ) :
						printf( __( 'Year: %s', 'delicious' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

					else :
						_e( 'Archives', 'delicious' );

					endif;
				?>
			</h3>
			<?php
				// Show an optional term description.
				$term_description = term_description();
				if ( ! empty( $term_description ) ) :
					printf( '<div class="taxonomy-description">%s</div>', $term_description );
				endif;
			?>

	<?php 
	}
}

function delicious_scripts_styles() {
	$query_args = array(
	 'family' => 'Pacifico:400|Merriweather:400'
	);
 	wp_enqueue_style('google-fonts', esc_url( add_query_arg( $query_args, "//fonts.googleapis.com/css" ) ), array(), null  );
 	wp_enqueue_script('delicious-parallax', get_stylesheet_directory_uri() . '/js/parallax.js', array('jquery'));
 	wp_enqueue_script('delicious-menu', get_stylesheet_directory_uri() . '/js/menu.js', array('jquery'), '1.0.0', true );
 	wp_enqueue_script('delicious-init', get_stylesheet_directory_uri() . '/js/init.js', array('jquery'));
}

function delicious_load_theme_textdomain() {
  	load_child_theme_textdomain( 'delicious', get_stylesheet_directory() . '/languages' );
}

add_action( 'after_setup_theme', 'delicious_load_theme_textdomain' );
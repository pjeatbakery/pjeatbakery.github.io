<?php

/*
  Plugin Name: WooCommerce Pop-Up
  Author: Infoway LLC
  Author URI: http://www.infoway.us
 */
?>
<?php

define('WOOCOMMERCE_EXTENSION_PLUGIN_PATH', dirname(__FILE__));
define('WOOCOMMERCE_EXTENSION_PLUGIN_URL', plugin_dir_url(__FILE__));

add_action('wp_enqueue_scripts', 'extension_plugin');

function extension_plugin() {
    wp_register_script('extension-plugin-js', WOOCOMMERCE_EXTENSION_PLUGIN_URL . '/js/extension-plugin-js.js', array('jquery'), 1.0);
    wp_enqueue_script('extension-plugin-js');
    wp_localize_script('extension-plugin-js', 'WooPopUp', array('ajaxurl' => admin_url('admin-ajax.php'), 'siteurl' => site_url()));

    wp_register_style('extension-plugin-css', WOOCOMMERCE_EXTENSION_PLUGIN_URL . '/css/extension-plugin.css');
    wp_enqueue_style('extension-plugin-css');
    add_thickbox();
}

//add_action('wp_ajax_woocommerce_add_to_cart', 'ajaxNewPopUpValue');
add_action('wp_ajax_new_pop_up', 'ajaxNewPopUpValue');
add_action('wp_ajax_nopriv_new_pop_up', 'ajaxNewPopUpValue');

function ajaxNewPopUpValue() {
    $resp_array = ['flag' => FALSE, 'msg' => '', 'title' => '', 'image_src' => '', 'product_ID' => ''];
    $product_id = $_POST['product_id'];
    $get_product_image_id = get_post_thumbnail_id($product_id);
    $get_post_thumbnail = wp_get_attachment_image_src($get_product_image_id, 'thumbnail');
    $resp_array['title'] = get_the_title($product_id);
    $resp_array['image_src'] = $get_post_thumbnail[0];
    $html_elem = '<a href="#TB_inline?width=350&height=400&inlineId=hidden_cart_' . $product_id . '" id="show_hidden_cart_' . $product_id . '" title="<h2>Cart</h2>" class="thickbox"></a>';
    $resp_array['flag'] = TRUE;
    $resp_array['product_ID'] = $product_id;
    $resp_array['msg'] = $html_elem;
    echo json_encode($resp_array);
    die();
}
?>


<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://arslanaslam.me
 * @since             1.0.0
 * @package           Bravo_Screens_Custom_Pricing
 *
 * @wordpress-plugin
 * Plugin Name:       BravoScreens Custom Pricing
 * Plugin URI:        bravo-screens-custom-pricing
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           2.0.0
 * Author:            Muhammad Arslan Aslam
 * Author URI:        https://arslanaslam.me
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       https://arslanaslam.me
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('BRAVO_SCREENS_CUSTOM_PRICING_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bravo-screens-custom-pricing-activator.php
 */
function activate_bravo_screens_custom_pricing()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-bravo-screens-custom-pricing-activator.php';
	Bravo_Screens_Custom_Pricing_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bravo-screens-custom-pricing-deactivator.php
 */
function deactivate_bravo_screens_custom_pricing()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-bravo-screens-custom-pricing-deactivator.php';
	Bravo_Screens_Custom_Pricing_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_bravo_screens_custom_pricing');
register_deactivation_hook(__FILE__, 'deactivate_bravo_screens_custom_pricing');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-bravo-screens-custom-pricing.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_bravo_screens_custom_pricing()
{

	$plugin = new Bravo_Screens_Custom_Pricing();
	$plugin->run();

}


function cfwc_create_custom_field_price_starting_from() {
	$args = array(
		'id' => 'price_starting_from_field',
		'label' => __( 'Price Starting From', 'cfwc' ),
		'class' => 'cfwc-custom-field',
		'desc_tip' => true,
		'description' => __( 'Price Starting From', 'ctwc' ),
	);
	woocommerce_wp_text_input( $args );
}

function cfwc_create_custom_field_free_shipping() {
	$args = array(
		'id' => 'custom_free_shipping_text',
		'label' => __( 'Free Shipping', 'cfwc' ),
		'class' => 'cfwc-custom-field',
		'desc_tip' => true,
		'description' => __( 'Free Shipping', 'ctwc' ),
	);
	woocommerce_wp_text_input( $args );
}

function cfwc_save_custom_field_price_starting_from( $post_id ) {
	$product = wc_get_product( $post_id );
	$title = isset( $_POST['custom_free_shipping_text'] ) ? $_POST['custom_free_shipping_text'] : '';
	$product->update_meta_data( 'custom_free_shipping_text', sanitize_text_field( $title ) );
	$product->save();
}

function cfwc_save_custom_field_free_shipping( $post_id ) {
	$product = wc_get_product( $post_id );
	$title = isset( $_POST['price_starting_from_field'] ) ? $_POST['price_starting_from_field'] : '';
	$product->update_meta_data( 'price_starting_from_field', sanitize_text_field( $title ) );
	$product->save();
}

function bscp_plugin_path() {
	// gets the absolute path to this plugin directory
	return untrailingslashit( plugin_dir_path( __FILE__ ) );
}

function bscp_woocommerce_locate_template( $template, $template_name, $template_path ) {
	global $woocommerce;

	$_template = $template;

	if ( ! $template_path ) $template_path = $woocommerce->template_url;

	$plugin_path  = bscp_plugin_path() . '/woocommerce/';

	// Look within passed path within the theme - this is priority
	$template = locate_template(

		array(
			$template_path . $template_name,
			$template_name
		)
	);

	// Modification: Get the template from this plugin, if it exists
	if ( ! $template && file_exists( $plugin_path . $template_name ) )
		$template = $plugin_path . $template_name;

	// Use default template
	if ( ! $template )
		$template = $_template;

	// Return what we found
	return $template;
}

// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text', -1 );
function woocommerce_custom_single_add_to_cart_text() {
	global $product;

	$product_type = $product->product_type;

	return __( 'Buy Now', 'woocommerce' );
}

// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text', -1 );
add_filter( 'pewc_filter_view_product_text', 'woocommerce_custom_product_add_to_cart_text', -1 );
function woocommerce_custom_product_add_to_cart_text() {
	global $product;

	$product_type = $product->product_type;

	return __( 'Buy Now', 'woocommerce' );
}

include_once ( plugin_dir_path( __FILE__ ) . 'includes/bs-custom-reviews.php' );

// CUSTOM SECOND DESCRIPTION FIELD FOR PRODUCT CATEGORIES

add_action( 'product_cat_add_form_fields', 'bscp_wp_editor_add', 10, 2 );

function bscp_wp_editor_add() {
    ?>
    <div class="form-field">
        <label for="seconddesc"><?php echo __( 'Second Description', 'woocommerce' ); ?></label>

      <?php
      $settings = array(
         'textarea_name' => 'seconddesc',
         'quicktags' => array( 'buttons' => 'em,strong,link' ),
         'tinymce' => array(
            'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
            'theme_advanced_buttons2' => '',
         ),
         'editor_css' => '<style>#wp-excerpt-editor-container .wp-editor-area{height:175px; width:100%;}</style>',
      );

      wp_editor( '', 'seconddesc', $settings );
      ?>

        <p class="description"><?php echo __( 'This is the description that goes BELOW products on the category page', 'woocommerce' ); ?></p>
    </div>
    <?php
}

// ---------------
// 2. Display field on "Edit product category" admin page

add_action( 'product_cat_edit_form_fields', 'bscp_wp_editor_edit', 10, 2 );

function bscp_wp_editor_edit( $term ) {
    $second_desc = htmlspecialchars_decode( get_woocommerce_term_meta( $term->term_id, 'seconddesc', true ) );
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="second-desc"><?php echo __( 'Second Description', 'woocommerce' ); ?></label></th>
        <td>
            <?php

         $settings = array(
            'textarea_name' => 'seconddesc',
            'quicktags' => array( 'buttons' => 'em,strong,link' ),
            'tinymce' => array(
               'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
               'theme_advanced_buttons2' => '',
            ),
            'editor_css' => '<style>#wp-excerpt-editor-container .wp-editor-area{height:175px; width:100%;}</style>',
         );

         wp_editor( $second_desc, 'seconddesc', $settings );
         ?>

            <p class="description"><?php echo __( 'This is the description that goes BELOW products on the category page', 'woocommerce' ); ?></p>
        </td>
    </tr>
    <?php
}

// ---------------
// 3. Save field @ admin page

add_action( 'edit_term', 'bscp_save_wp_editor', 10, 3 );
add_action( 'created_term', 'bscp_save_wp_editor', 10, 3 );

function bscp_save_wp_editor( $term_id, $tt_id = '', $taxonomy = '' ) {
   if ( isset( $_POST['seconddesc'] ) && 'product_cat' === $taxonomy ) {
      update_woocommerce_term_meta( $term_id, 'seconddesc', esc_attr( $_POST['seconddesc'] ) );
   }
}

// ---------------
// 4. Display field under products @ Product Category pages

add_action( 'woocommerce_after_shop_loop', 'bscp_display_wp_editor_content', 5 );

function bscp_display_wp_editor_content() {
   if ( is_product_taxonomy() ) {
      $term = get_queried_object();
      if ( $term && ! empty( get_woocommerce_term_meta( $term->term_id, 'seconddesc', true ) ) ) {
         echo '<p class="term-description">' . wc_format_content( htmlspecialchars_decode( get_woocommerce_term_meta( $term->term_id, 'seconddesc', true ) ) ) . '</p>';
      }
   }
}

run_bravo_screens_custom_pricing();

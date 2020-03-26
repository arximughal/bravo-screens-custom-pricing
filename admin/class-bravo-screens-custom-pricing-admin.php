<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://arslanaslam.me
 * @since      1.0.0
 *
 * @package    Bravo_Screens_Custom_Pricing
 * @subpackage Bravo_Screens_Custom_Pricing/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Bravo_Screens_Custom_Pricing
 * @subpackage Bravo_Screens_Custom_Pricing/admin
 * @author     Muhammad Arslan Aslam <hello@arslanaslam.me>
 */
class Bravo_Screens_Custom_Pricing_Admin
{
	
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;
	
	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 * @since    1.0.0
	 */
	public function __construct($plugin_name, $version)
	{
		
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		// add hook to show a custom field in the product page
		add_action( 'woocommerce_product_options_general_product_data', 'cfwc_create_custom_field_price_starting_from' );
		add_action( 'woocommerce_product_options_general_product_data', 'cfwc_create_custom_field_free_shipping' );

		// add hook to save the custom field along with product meta
		add_action( 'woocommerce_process_product_meta', 'cfwc_save_custom_field_price_starting_from' );
		add_action( 'woocommerce_process_product_meta', 'cfwc_save_custom_field_free_shipping' );
		
		// WooCommerce template overriding
		add_filter( 'woocommerce_locate_template', 'bscp_woocommerce_locate_template', 10, 3 );
		
	}
	
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{
		
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Bravo_Screens_Custom_Pricing_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bravo_Screens_Custom_Pricing_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/bravo-screens-custom-pricing-admin.css', array(), $this->version, 'all');
		
	}
	
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{
		
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Bravo_Screens_Custom_Pricing_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bravo_Screens_Custom_Pricing_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/bravo-screens-custom-pricing-admin.js', array('jquery'), $this->version, false);
		
	}
	
}

<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://arslanaslam.me
 * @since      1.0.0
 *
 * @package    Bravo_Screens_Custom_Pricing
 * @subpackage Bravo_Screens_Custom_Pricing/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Bravo_Screens_Custom_Pricing
 * @subpackage Bravo_Screens_Custom_Pricing/includes
 * @author     Muhammad Arslan Aslam <hello@arslanaslam.me>
 */
class Bravo_Screens_Custom_Pricing_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'bravo-screens-custom-pricing',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

<?php

/*
 * Plugin Name: MoneyPress
 * Plugin URI: http://www.charlestonsw.com/product/moneypress/
 * Description: Bring the power of the WordPress.com cloud to your self-hosted WordPress. Jetpack enables you to connect your blog to a WordPress.com account to use the powerful features normally only available to WordPress.com users.
 * Author: Charleston Software Associates
 * Version: 0.0.1
 * Author URI: http://www.charlestonsw.com
 * License: GPL2+
 * Text Domain: moneypress
 * Domain Path: /languages/
 */

define( 'MONEYPRESS__VERSION', '0.0.1' );
define( 'MONEYPRESS__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

class MoneyPress {
	/**
	 * Message to display in admin_notice
	 * @var string
	 */
	var $message = '';

	/**
	 * Error to display in admin_notice
	 * @var string
	 */
	var $error = '';

	/**
	 * Singleton
	 * @static
	 */
	public static function init() {
		static $instance = false;

		if ( !$instance ) {
			load_plugin_textdomain( 'moneypress', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
			$instance = new MoneyPress;
		}

		return $instance;
	}

	/**
	 * Constructor.  Initializes WordPress hooks
	 */
	function MoneyPress() {
	}
}

class MoneyPress_Error extends WP_Error {}

add_action( 'init', array( 'MoneyPress', 'init' ) );

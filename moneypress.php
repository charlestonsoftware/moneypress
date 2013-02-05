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
         * We use this prefix for options, CSS, etc.
         *
         * Helps us differentiate from other CSA plugins.
         *
         * @var string
         */
        var $prefix = 'moneypress';

        /**
         * Get the path to this file.
         *
         * We use this often for other includes, so let's excercise the CPU less.
         */
        var $plugin_path = '';

	/**
	 * Singleton
	 * @static
	 */
	public static function init() {
		static $instance = false;
		if ( !$instance ) {
                    load_plugin_textdomain( 'moneypress', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
                    $instance = new MoneyPress;
                    
                    // Property inits (one time only please)
                    //
                    $instance->plugin_path = dirname( __FILE__ );
		}
		return $instance;
	}

	/**
	 * Constructor.  Initializes WordPress hooks
	 */
	function MoneyPress() {
            add_action( 'admin_menu', array( $this, 'admin_menu' ) );
            add_action( 'admin_init', array( $this, 'admin_init' ) );
	}

        //----------------------
        // Admin Interface
        //----------------------

        /**
         * Process admin_init() hook for WordPress
         *
         * Called after admin_menu().
         */
        function admin_init() {
        }

        /**
         * Process the admin menu hook for WordPress.
         *
         * Called before admin_init()
         */
        function admin_menu() {
            require_once($this->plugin_path . '/include/class.admin-ui.php');
        }
}

class MoneyPress_Error extends WP_Error {}

add_action( 'init', array( 'MoneyPress', 'init' ) );

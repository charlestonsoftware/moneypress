<?php

/*
 * Plugin Name: MoneyPress
 * Plugin URI: http://www.charlestonsw.com/product/moneypress/
 * Description: List products from your affiliate accounts with ease.  Enter your affiliate relationship settings, put a shortcode on a page and start selling.
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
	 * Error to display in admin_notice
	 * @var string
	 */
	var $error = '';

	/**
	 * Message to display in admin_notice
	 * @var string
	 */
	var $message = '';

        /**
         * What we call ourselves
         * @var string
         */
        public $name = 'MoneyPress';

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

        //------------
        // Our Objects
        //------------

        /**
         * The MoneyPress Admin UI object
         *
         * @var MP_AdminUI - an Admin UI object
         */
        var $AdminUI = null;

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
	}

        //----------------------
        // Admin Interface
        //----------------------

        /**
         * Process the admin menu hook for WordPress.
         *
         * Called before admin_init()
         */
        function admin_menu() {
            require_once($this->plugin_path.'/class.moneypress-adminui.php');
            $this->AdminUI = new MoneyPress_AdminUI(array('plugin'=>$this));
            $this->AdminUI->create_AdminMenu();
        }

}

class MoneyPress_Error extends WP_Error {}

add_action( 'init', array( 'MoneyPress', 'init' ) );

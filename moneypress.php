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

/**
 * MoneyPress Class
 *
 * @property-read string $name the name of the plugin
 * @property wpCSL_plugin__mp $WPCSL a WPCSL object
 */
class MoneyPress {

        //------------------------------------------------------
        // Properties
        //------------------------------------------------------

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
         * The absolute path to this plugin directory (no ending slash)
         *
         * @var string
         */
        var $plugin_path = '';

        /**
         * The fully qualified URL to this plugin.
         *
         * @var string
         */
        var $plugin_url = '';

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
         * The WPCSL helpers.
         *
         * @var wpCSL_plugin__mp WPCSL - a WPCSL object
         */
        public $WPCSL = null;

        //------------------------------------------------------
        // METHODS
        //------------------------------------------------------

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
                    $instance->plugin_url  = plugins_url('',__FILE__);
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

            // Modules we need
            require_once($this->plugin_path.'/class.moneypress-adminui.php');
            require_once($this->plugin_path.'/WPCSL-generic/classes/CSL-plugin.php');
            
            // WPCSL = common plugin helper methods
            //
            $WPCSL_options = array(
                    'cache_path'    => $this->plugin_path.'/cache/',
                    'css_prefix'    => $this->prefix,
                    'name'          => $this->name,
                    'no_license'    => true,
                    'plugin_path'   => $this->plugin_path.'/',
                    'plugin_url'    => $this->plugin_url,
                    'prefix'        => $this->prefix,
                );
            $this->WPCSL   = new wpCSL_plugin__mp($WPCSL_options);

            // The Admin UI = admin menus and pages
            //
            $AdminUI_options = array(
                    'plugin'        => $this,
                );
            $this->AdminUI = new MoneyPress_AdminUI($AdminUI_options);
            $this->AdminUI->create_AdminMenu();
        }

}

class MoneyPress_Error extends WP_Error {}

add_action( 'init', array( 'MoneyPress', 'init' ) );

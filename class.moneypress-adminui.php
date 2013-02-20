<?php

/**
 * This class contains all the admin interface elements we need.
 *
 * Only invoked during an admin session.
 */
class MoneyPress_AdminUI {

    //------------------------------------------------------
    // Properties
    //------------------------------------------------------

    /**
     * The WordPress hook for the admin menu.
     * 
     * @var object
     */
    private $MenuHook = null;

    /**
     * The plugin parent object.
     * 
     * @var object
     */
    private $plugin   = null;

    //-----------------
    // WPCSL shortcuts
    //-----------------

    /**
     * The WPCSL settings object, shortcut to parent instantiated object.
     *
     * @var wpCSL_settings__mp
     */
    private $wpcSettings = null;


    //------------------------------------------------------
    // METHODS
    //------------------------------------------------------

    /**
     * Initialize the AdminUI class.
     *
     * Requires 'plugin' => WPCSL instantiated object.
     *
     * @param array $params an associated array of properties and init values
     */
    function __construct($params) {
        if (is_array($params)) {
            foreach ($params as $key=>$val) {
                $this->$key = $val;
            }
        }

        // We must have a plugin parameters as a minimum.
        //
        if (!isset($this->plugin)) { return false; }

        // Shortcuts
        //
        $this->wpcSettings = $this->plugin->WPCSL->settings;
    }

    /**
     * Create the admin menu on the sidebar.
     */
    function create_AdminMenu() {
        $this->MenuHook = add_menu_page( $this->plugin->name, $this->plugin->name, 'activate_plugins', 'moneypress', array( $this, 'admin_page' ), 'div' );
    }

    /**
     * Render the admin page.
     */
    function admin_page() {
        $this->wpcSettings->add_section(array('name'=>'header'));
        $this->wpcSettings->render_settings_page();
    }
}
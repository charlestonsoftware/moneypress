<?php

/**
 * This class contains all the admin interface elements we need.
 *
 * Only invoked during an admin session.
 */
class MoneyPress_AdminUI {

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


    /**
     * Initialize the AdminUI class.
     *
     * @param array $params an associated array of properties and init values
     */
    function __construct($params=null) {
        if ($params !== null) {
            if (is_array($params)) {
                foreach ($params as $key=>$val) {
                    $this->$key = $val;
                }
            }
        }

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
        print 'hello';
    }
}
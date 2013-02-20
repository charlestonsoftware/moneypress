<?php
/*
 * Class: MP_AdminUI
 * Description: The MoneyPress admin UI class.
 *
 * License: GPL2+
 * Text Domain: moneypress
 * Domain Path: /languages/
 *
 */

if (! class_exists('MP_AdminUI')) {
    class MP_AdminUI {

        /******************************
         * PUBLIC PROPERTIES & METHODS
         ******************************/
        public $parent = null;

        /**
         * The WP derived hook name for the top-level MP menu.
         * @var string - assigned when menu created.
         */
        var $MenuHook = '';

        /*************************************
         * The Constructor
         */
        function __construct($params=null) {
            if (is_array($params)) {
                foreach ($params as $key=>$val) {
                    $this->$key = $val;
                }
            }
        }

        /**
         * Connect the MoneyPress menu to the admin sidebar.
         */
        function connectAdminMenu() {
                // Main Menu
                //
                $this->MenuHook = add_menu_page(
                    $this->parent->name,
                    $this->parent->name,
                    'manage_mp',
                    $this->parent->prefix,
                    array($this,'render_GeneralSettings'),
                    'div',
                    110
                    );

                // Default menu items
                //
                $menuItems = array(
                    array(
                        'label'             => __('General Settings','moneypress'),
                        'slug'              => 'mp_general_settings',
                        'class'             => $this,
                        'function'          => 'render_GeneralSettings'
                    )
                );

                // Third party plugin add-ons
                //
                $menuItems = apply_filters('mp_menu_items', $menuItems);

                // Attach Menu Items To Sidebar and Top Nav
                //
                foreach ($menuItems as $menuItem) {

                    // Sidebar connect...
                    //

                    // Using class names (or objects)
                    //
                    if (isset($menuItem['class'])) {
                        add_submenu_page(
                            $this->parent->prefix,
                            $menuItem['label'],
                            $menuItem['label'],
                            'manage_mp',
                            $menuItem['slug'],
                            array($menuItem['class'],$menuItem['function'])
                            );
                    }
                }
        }


        /**
         * Render the General Settings page for MoneyPress
         */
        function render_GeneralSettings() {
            print "<h1>Hello</h1>";
        }


    } // MP_AdminUI Class
} // Class Exists Check

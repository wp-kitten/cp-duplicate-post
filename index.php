<?php

/**
 * Stores the name of the plugin's directory
 * @var string
 */
define( 'CPDP_PLUGIN_DIR_NAME', basename( dirname( __FILE__ ) ) );
/**
 * Stores the system path to the plugin's directory
 * @var string
 */
define( 'CPDP_PLUGIN_DIR_PATH', trailingslashit( wp_normalize_path( dirname( __FILE__ ) ) ) );

if ( cp_is_admin() ) {
    require_once( CPDP_PLUGIN_DIR_PATH . '/hooks.php' );
    require_once( path_combine( CPDP_PLUGIN_DIR_PATH, 'routes', 'web.php' ) );
}


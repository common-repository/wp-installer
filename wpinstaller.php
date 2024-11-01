<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/*
Plugin Name: WP Installer Lite
Plugin URI: http://WordpressInstaller.ga
Description: This plugin is used to launch your new site
Version: 1.0
Author: Wordpress Installer
Author URI: http://WordpressInstaller.ga
*/

//
//Define constant
define( 'IPLAUN_TITLE', ' Wordpress Installer - Lite' );
define( 'IPLAUN_DESC', 'This plugin is used to launch your new site fast' );

define( 'IPLAUN_FILE', __FILE__ );
define( 'IPLAUN_PATH', plugin_dir_path( __FILE__ ) );
define( 'IPLAUN_BASE_URL', plugin_dir_url( __FILE__ ) );
define( 'IPLAUN_APP',  IPLAUN_PATH . 'app/'  );
define( 'IPLAUN_CTRL', IPLAUN_APP . 'controllers/'  );
define( 'IPLAUN_LIB',  IPLAUN_APP . 'libraries/'  );
define( 'IPLAUN_VIEW', IPLAUN_APP . 'views/'  );
define( 'IPLAUN_PAGENAME', 'wpinstaller'  );
define( 'IPLAUN_SLUG', 'wpinstaller'  );

//
//Include application file and run all function
require_once( IPLAUN_APP . 'app.php' );
IPLAUN_App::run();

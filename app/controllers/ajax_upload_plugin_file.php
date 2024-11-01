<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Controller to upload plugin file
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga
 */

//
//Include class
include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );

if ( ! class_exists( 'IPLaun_Ajax_Upload_plugin_file' ))
{
  class IPLaun_Ajax_Upload_plugin_file
  {
    /**
     * Execution upload theme file
     *
     * @return void
     */
    public function exec()
    {
      $fileUpload = new File_Upload_Upgrader('pluginzip', 'package');
      $upgrader   = new Plugin_Upgrader();
      $result     = $upgrader->install( $fileUpload->package, array( 'is_multi' => true ) );

      if ( $result || is_wp_error($result) ) {
        $fileUpload->cleanup();
      }
      exit();
    }
  }
}

<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Controller to upload plugin from a plugin url
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga
 */

//
//Include class
include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );

if ( ! class_exists( 'IPLaun_Ajax_Upload_plugin_url' ))
{
  class IPLaun_Ajax_Upload_plugin_url
  {
    /**
     * Execution upload plugin file
     *
     * @return void
     */
    public function exec()
    {
      if ( ! empty( $_POST['url'] ))
      {
        $pluginurl = apply_filters( 'pre_link_url', $_POST['url'] );
        $upgrader  = new Plugin_Upgrader();
        $result    = $upgrader->install( $pluginurl, array( 'is_multi' => true ) );

        if ( $result || is_wp_error($result) ) {
          $fileUpload->cleanup();
        }
      }
      exit();
    }
  }
}

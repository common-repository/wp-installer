<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Controller to upload theme from a theme url
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga
 */

//
//Include class
include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );

if ( ! class_exists( 'IPLaun_Ajax_Upload_theme_url' ))
{
  class IPLaun_Ajax_Upload_theme_url
  {
    /**
     * Execution upload theme file
     *
     * @return void
     */
    public function exec()
    {
      if ( ! empty( $_POST['url'] ))
      {
        $themeurl = apply_filters( 'pre_link_url', $_POST['url'] );
        $upgrader = new Theme_Upgrader();
        $result   = $upgrader->install( $themeurl, array( 'is_multi' => true ) );

        if ( $result || is_wp_error($result) ) {
          $fileUpload->cleanup();
        }
      }
      exit();
    }
  }
}

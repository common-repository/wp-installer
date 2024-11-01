<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Controller to install wp
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga
 */

if ( ! class_exists( 'IPLaun_Ajax_Install' ))
{
  class IPLaun_Ajax_Install
  {
    /**
     * Execution save options process
     *
     * @return void
     */
    public function exec()
    {
      $reqData = file_get_contents("php://input");
      $data    = json_decode( $reqData, true );

      $installer = new IPLaun_Installer( $data );
      $installer->install();

      update_option( 'iplaun_was_launch', 1 );

      echo json_encode( array(
        'status'    => 1,
        'message'   => __( 'Success running launcher.', IPLAUN_SLUG ),
        'redirect'  => admin_url() . 'admin.php?page=' . IPLAUN_PAGENAME . '&launch=1'
      ) );
      die();
    }
  }
}

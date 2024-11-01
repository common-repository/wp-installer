<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Controller to save draft
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga
 */

if ( ! class_exists( 'IPLaun_Ajax_Savedraft' ))
{
  class IPLaun_Ajax_Savedraft
  {
    /**
     * Execution save options
     *
     * @return void
     */
    public function exec()
    {
      $reqData = file_get_contents("php://input");
      $data    = base64_encode( $reqData );
      $message = '';

      update_option( '__iplaun_temp_data', $data );

      echo json_encode( array(
        'status'    => 1,
        'message'   => $message,
        'redirect'  => admin_url() . 'admin.php?iplaun=1&action=save-option'
      ) );
      die();
    }
  }
}

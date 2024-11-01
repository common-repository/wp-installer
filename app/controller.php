<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'IPLaun_Controller' ))
{
  /**
   * Controller class
   *
   * @package WordpressInstaller
   * @author Wordpress Installer
   * @link http://WordpressInstaller.ga
   */

  class IPLaun_Controller
  {
    //{{ ajax

    /**
     * Ajax handler
     *
     * @return void
     */
    public function ajax()
    {
      $data = array_merge( $_GET, $_POST );
      if ( empty( $data['doajax'] ) || empty( $data['iplaun'] ) || empty( $data['action'] ) ) {
          return true;
      }
      $action = sanitize_title( $data['action'] );
      $file   = IPLAUN_CTRL . 'ajax_' . $action . '.php';
      if ( file_exists( $file ))
      {
        require_once( $file );
        $class = 'IPLaun_Ajax_' . ucfirst( $action );
        if ( class_exists( $class ) ) {
          $ctrl = new $class();
          if ( method_exists( $ctrl, 'exec' )) {
            $ctrl->exec();
          }
        }
      }
      return true;
    }

    //}}
    //{{ saveOption

    /**
     * Save option
     *
     * @return void
     */
    public function saveOption()
    {
      if ( ! empty( $_GET['iplaun'] ) && 
           ! empty( $_GET['action'] ) && $_GET['action'] == 'save-option' 
      ) {
        $option = get_option( '__iplaun_temp_data' );
        if ( ! empty( $option ))
        {
          $uploadDir = wp_upload_dir();
          $filename  = 'wp-ez-launcher-option-' . time() . '.txt';
          $filepath  = $uploadDir['path'] . '/' . $filename;
          $handler   = fopen( $filepath, 'w');
          fwrite( $handler, $option );

          $size = filesize( $filepath );

          header('Content-Type: application/zip');
          header('Content-Length: '.$size);
          header('Content-Disposition: attachment; filename='.$filename);
          header('Content-Transfer-Encoding: binary');
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');

          ob_clean();
          flush();
          readfile($filepath);

          die();
        }
        else {
          wp_redirect( admin_url() . 'admin.php?page=' . IPLAUN_PAGENAME . '&error=1' );
        }
      }
      return true;
    }

    //}}
  }
}

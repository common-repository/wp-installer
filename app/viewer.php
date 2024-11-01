<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'IPLaun_Viewer' ))
{
  /**
   * Viewer class
   *
   * @package WordpressInstaller
   * @author Wordpress Installer
   * @link http://WordpressInstaller.ga
   */

  class IPLaun_Viewer
  {
    //{{ main

    /**
     * Dashboard viewer
     *
     * @return void
     */
    public function main()
    {
      $this->pageId      = IPLAUN_PAGENAME;
      $this->formAction  = admin_url( 'admin-ajax.php' ) . '?doajax=1&iplaun=1&action=install';

      $this->view( 'admin/main' );
    }

    //}}
    //{{ export

    /**
     * Export viewer
     *
     * @return void
     */
    public function export()
    {
      $this->pageId      = IPLAUN_PAGENAME . '-export';
      $this->formAction  = admin_url( 'admin-ajax.php' ) . '?doajax=1&iplaun=1&action=export';

      $this->view( 'admin/export' );
    }

    //}}
    //{{ view

    /**
     * Get admin view file
     *
     * @param string $filename
     * @return void
     */
    public function view( $filename )
    {
      $path  = IPLAUN_VIEW;
      $path .= strtolower( $filename ) . '.php';
      if ( file_exists( $path )) {
        include( $path );
      }
    }

    //}}
  }
}

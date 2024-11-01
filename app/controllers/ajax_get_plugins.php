<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Controller to get plugins
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga
 */

if ( ! class_exists( 'IPLaun_Ajax_Get_plugins' ))
{
  class IPLaun_Ajax_Get_plugins
  {
    /**
     * Execution save options process
     *
     * @return void
     */
    public function exec()
    {
      $plugins = get_plugins();
      $count  = count( $plugins );

      echo json_encode( array(
        'plugins'         => $plugins,
        'errorMessage'   => __( 'Failed to add plugin.', IPLAUN_SLUG ),
        'successMessage' => __( 'Success to add plugin.', IPLAUN_SLUG ),
        'content'        => $this->_getContent( $plugins ),
        'count'          => $count
      ) );
      die();
    }

    //}}
    //{{ _saveVote

    /**
     * Get page permalink
     *
     * @param  array $plugins
     * @return string
     */
    protected function _getContent( $plugins )
    {
      $content = '';
      if ( ! empty( $plugins ))
      {
        foreach( $plugins as $id => $plugin )
        {
          $chk = '';
          $content .= '<div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">' .
                        '<div class="iplaun-field">' .
                          '<label>' .
                            '<input type="checkbox" name="plugins_active[]" value="'.$id.'"' . $chk . '>' .
                            $plugin['Name'] .
                          '</label>' .
                        '</div>' .
                      '</div>';
        }
      }
      return $content;
    }
  }
}

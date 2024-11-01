<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Controller to get themes
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga
 */

if ( ! class_exists( 'IPLaun_Ajax_Get_themes' ))
{
  class IPLaun_Ajax_Get_themes
  {
    /**
     * Execution save options process
     *
     * @return void
     */
    public function exec()
    {
      $themes = wp_prepare_themes_for_js();
      $count  = count( $themes );

      echo json_encode( array(
        'themes'         => $themes,
        'errorMessage'   => __( 'Failed to add theme.', IPLAUN_SLUG ),
        'successMessage' => __( 'Success to add theme.', IPLAUN_SLUG ),
        'content'        => $this->_getContent( $themes ),
        'count'          => $count
      ) );
      die();
    }

    //}}
    //{{ _saveVote

    /**
     * Get page permalink
     *
     * @param  array $themes
     * @return string
     */
    protected function _getContent( $themes )
    {
      $content = '';
      if ( ! empty( $themes ))
      {
        foreach( $themes as $theme )
        {
          $chk = '';
          if ( $theme['active'] ) {
            $chk = ' checked="checked"';
          }
          $content .= '<div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">' .
                        '<div class="iplaun-field">' .
                          '<label>' .
                            '<input type="radio" name="theme_active" value="'.$theme['id'].'"' . $chk . '>' .
                            $theme['name'] .
                          '</label>' .
                        '</div>' .
                      '</div>';
        }
      }
      return $content;
    }
  }
}

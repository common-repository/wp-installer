<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Admin header view
 *
 * @package WordpressInstaller
 * @author Wordpress Installer
 * @link http://WordpressInstaller.ga
 */

$page = $this->pageId;
?>
<!-- start: .iplaun-top -->
<div class="iplaun-top">
  <!-- start: .iplaun-header -->
  <div class="iplaun-header">
    <!-- start: .iplaun-page-title -->
    <div class="iplaun-page-title">
      <h3>
        <i class="iplaun-icon-rocket dashicons-before"></i>
        <span>
          <?php
          $title = IPLAUN_TITLE;
          $words = explode( ' ', $title );
          $first = array_shift( $words );
          $title = implode( ' ', $words );
          ?>
          <strong class="mb5"><span><?php echo $first; ?></span> <?php echo $title; ?></strong>
          <em> <?php echo IPLAUN_DESC; ?></em>
        </span>
      </h3>
    </div>
    <!-- end: .iplaun-page-title -->
  </div>
  <!-- end: .iplaun-header -->

  <!-- start: .iplaun-nav -->
  <div class="iplaun-nav">
  </div>
  <!-- end: .iplaun-nav -->

  <!-- start: .iplaun-page-info -->
  <div class="iplaun-page-info">
    <i class="iplaun-fa iplaun-fa-upload"></i>
    <div class="iplaun-info">
      <h3 class="mb5"><?php _e( 'Export', IPLAUN_SLUG ); ?></h3>
      <h4><?php _e( 'Launching website with exporting settings file', IPLAUN_SLUG ); ?></h4>
    </div>
  </div>
  <!-- end: .iplaun-page-info -->

</div>
<!-- end: .iplaun-top -->
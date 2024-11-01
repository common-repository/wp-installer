<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Admin header view
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga
 */

$pageDash    = IPLAUN_PAGENAME;
$pageCreate  = IPLAUN_PAGENAME . '-create';
$pagePage    = IPLAUN_PAGENAME . '-page';
$pageSetting = IPLAUN_PAGENAME . '-setting';
$page        = $this->pageId;
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
		
        <span class="banner">
          <strong class="mb5"><span><?php echo $first; ?></span> <a href="http://wordpressinstaller.ga/themes.php" target="_blank" style="color: rgb(234, 49, 80); text-decoration: none;">+Themes</a></strong>
          <em>Professional Themes</em>
        </span>

        <span class="banner">
          <strong class="mb5"><span><?php echo $first; ?></span> <a href="http://wordpressinstaller.ga/plugins.php" target="_blank" style="color: rgb(234, 49, 80); text-decoration: none;">+Plugins</a></strong>
          <em>Professional Plugins</em>
        </span>

		<span class="banner">
          <strong class="mb5"><span><?php echo $first; ?></span> <a href="http://wordpressinstaller.ga/pro.php" target="_blank" style="color: rgb(166,216,54); text-decoration: none;">+ Pro Version</a></strong>
          <em>WP Installer Pro is Available</em>
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
    <?php
    $title = isset( $this->title ) ? $this->title : __( 'Delete Unwanted Content', IPLAUN_SLUG );
    $info  = isset( $this->info ) ? $this->info : __( 'Step 1', IPLAUN_SLUG );
    $icon  = isset( $this->icon ) ? $this->icon : 'trash';
    ?>
    <i class="iplaun-fa iplaun-fa-<?php echo $icon; ?>"></i>
    <div class="iplaun-info">
      <h4><?php echo $info; ?></h4>
      <h3><?php echo $title; ?></h3>
    </div>
  </div>
  <!-- end: .iplaun-page-info -->

</div>
<!-- end: .iplaun-top -->
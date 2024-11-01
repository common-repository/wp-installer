<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Page navigation view
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga/
 */
?>
<div class="iplaun-sidebar">
  <div class="iplaun-sidebar-inner">

    <ul class="iplaun-page-menu iplaun-tab-menu">
      <li>
        <a href="#iplaun-section-delete" data-step="1" class="current">
          <i class="iplaun-fa iplaun-fa-trash"></i>
          <span class="iplaun-tab-menu-label">
            <em><?php _e( 'Step 1', IPLAUN_SLUG ); ?></em>
            <strong><?php _e( 'Delete Unwanted Content', IPLAUN_SLUG ); ?></strong>
          </span>
        </a>
      </li>
      <?php
      if ( current_user_can( 'switch_themes' ) && current_user_can( 'edit_theme_options' ) ) :
      ?>
      <li>
        <a href="#iplaun-section-theme" data-step="2" class="disabled">
          <i class="iplaun-fa iplaun-fa-paint-brush"></i>
          <span class="iplaun-tab-menu-label">
            <em><?php _e( 'Step 2', IPLAUN_SLUG ); ?></em>
            <strong><?php _e( 'Install Theme', IPLAUN_SLUG ); ?></strong>
          </span>
        </a>
      </li>
      <?php
      endif;
      ?>

      <?php
      if ( current_user_can('activate_plugins') ) :
      ?>
      <li>
        <a href="#iplaun-section-plugin" data-step="3" class="disabled">
          <i class="iplaun-fa iplaun-fa-plug"></i>
          <span class="iplaun-tab-menu-label">
            <em><?php _e( 'Step 3', IPLAUN_SLUG ); ?></em>
            <strong><?php _e( 'Install Plugin', IPLAUN_SLUG ); ?></strong>
          </span>
        </a>
      </li>
      <?php
      endif;
      ?>
      
      <li>
        <a href="#iplaun-section-page" data-step="4" class="disabled">
          <i class="iplaun-fa iplaun-fa-file-o"></i>
          <span class="iplaun-tab-menu-label">
            <em><?php _e( 'Step 4', IPLAUN_SLUG ); ?></em>
            <strong><?php _e( 'Add Pages', IPLAUN_SLUG ); ?></strong>
          </span>
        </a>
      </li>
      <li>
        <a href="#iplaun-section-setting" data-step="5" class="disabled">
          <i class="iplaun-fa iplaun-fa-cogs"></i>
          <span class="iplaun-tab-menu-label">
            <em><?php _e( 'Step 5', IPLAUN_SLUG ); ?></em>
            <strong><?php _e( 'General Settings', IPLAUN_SLUG ); ?></strong>
          </span>
        </a>
      </li>
      <li>
        <a href="#iplaun-section-finish" data-step="6" class="disabled">
          <i class="iplaun-fa iplaun-fa-flag"></i>
          <span class="iplaun-tab-menu-label">
            <em><?php _e( 'Step 6', IPLAUN_SLUG ); ?></em>
            <strong><?php _e( 'Finish', IPLAUN_SLUG ); ?></strong>
          </span>
        </a>
      </li>
    </ul>

  </div>
</div>

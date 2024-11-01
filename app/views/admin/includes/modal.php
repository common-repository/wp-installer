<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Modal edit content
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga
 */
?>
<!-- start: .iplaun-ui-modal -->
<div id="iplaun-edit-content-popup" class="iplaun-ui-modal" style="display: none;">
  <!-- start: .iplaun-ui-modal-main -->
  <div class="iplaun-ui-modal-main">
    <!-- start: .iplaun-ui-modal-inner -->
    <div class="iplaun-ui-modal-inner">
      <!-- start: .iplaun-ui-modal-title -->
      <div class="iplaun-ui-modal-title">
        <h3><?php _e( 'Edit Content', IPLAUN_SLUG ); ?></h3>
        <div class="iplaun-ui-close">
          <a class="iplaun-ui-close-link" href="#">
            <i class="iplaun-fa iplaun-fa-times-circle"></i>
          </a>
        </div>
      </div>
      <!-- end: .iplaun-ui-modal-title -->

      <!-- start: .iplaun-ui-modal-content -->
      <div class="iplaun-ui-modal-content">
        <!-- start: .iplaun-form -->
        <form id="iplaun-edit-content-form" class="iplaun-form" action="" method="post">
          <input type="hidden" class="iplaun-data-id" name="id" value="">
          <input type="hidden" class="iplaun-data-type" name="type" value="">

          <div class="iplaun-fields container container-fluid">

            <?php
            /*
             * Title
             */
            ?>
            <!-- start: .iplaun-field-row -->
            <div class="iplaun-field-row iplaun-field-x">
              <div class="iplaun-form-label col-lg-3 col-md-3 col-sm-12">
                <label><?php _e( 'Title', IPLAUN_SLUG ); ?></label>
              </div>

              <!-- start: .iplaun-field -->
              <div class="iplaun-field col-lg-9 col-md-9 col-sm-12">
                <input type="text" class="iplaun-input iplaun-input-full iplaun-data-title" name="top_title" value="">
              </div>
              <!-- end: .iplaun-field -->
            </div>
            <!-- end: .iplaun-field-row -->

            <?php
            /*
             * Content
             */
            ?>
            <!-- start: .iplaun-field-row -->
            <div class="iplaun-field-row iplaun-field-y iplaun-help-abs">
              <div class="iplaun-form-label">
                <label><?php _e( 'Content', IPLAUN_SLUG ); ?></label>
              </div>

              <!-- start: .iplaun-field -->
              <div class="iplaun-field">
                <?php
                $tinymceInit = array(
                'editor_height' => 60
                );
                $content = '';
                wp_editor( $content, 'postcontent', array( 
                    'editor_height' => 60,
                    'tinymce'       => $tinymceInit
                )); 
                ?>
              </div>
              <!-- end: .iplaun-field -->
            </div>
            <!-- end: .iplaun-field-row -->

            <?php
            /*
             * Category
             */
            ?>
            <!-- start: .iplaun-field-row -->
            <div class="iplaun-field-row iplaun-field-x iplaun-field-category">
              <div class="iplaun-form-label col-lg-3 col-md-3 col-sm-12">
                <label><?php _e( 'Category', IPLAUN_SLUG ); ?></label>
              </div>

              <!-- start: .iplaun-field -->
              <div class="iplaun-field col-lg-9 col-md-9 col-sm-12">
                <select class="iplaun-data-category" name="category">
                  <?php
                  $categories = get_terms( 'category', array(
                    'hide_empty' => false
                  ));
                  foreach( $categories as $category ) {
                    echo '<option value="s:' . $category->term_taxonomy_id . '">' . $category->name . '</option>';
                  }
                  ?>
                </select>
              </div>
              <!-- end: .iplaun-field -->
            </div>
            <!-- end: .iplaun-field-row -->

          </div>

          <div class="iplaun-manage-footer">
            <div class="iplaun-bottom-submit">
              <button type="submit" class="iplaun-btn iplaun-btn-secondary iplaun-btn-md" id="iplaun-save-content-button" name="update_bottom">
                <i class="iplaun-fa iplaun-fa-save"></i>
                <strong><?php _e( 'Save Change', IPLAUN_SLUG ); ?></strong>
              </button>
            </div>
          </div>

        </form>
        <!-- end: .iplaun-form -->
      </div>
      <!-- end: .iplaun-ui-modal-content -->
    </div>
    <!-- end: .iplaun-ui-modal-inner -->
  </div>
  <!-- end: .iplaun-ui-modal-main -->
</div>
<!-- end: .iplaun-ui-modal -->

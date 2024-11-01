<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Admin main view
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga
 */
?>

<!-- start: .iplaun-wrap -->
<div id="iplaun-export" class="wrap iplaun-wrap iplaun-admin">
  <div class="iplaun-inner">

    <?php
    $this->view( 'admin/export/header' );
    ?>

    <!-- start: .iplaun-main -->
    <div class="iplaun-main">

      <!-- start: .iplaun-primary -->
      <div class="iplaun-primary">

        <div class="iplaun-manage-wrap">
          <form 
            id="iplaun-form-export" 
            class="iplaun-form-container iplaun-form" 
            method="post" 
            action="" 
            enctype="multipart/form-data">

            <div class="container-fluid container">

              <div class="iplaun-clear">
                <div class="iplaun-manage-content">

                  <!-- start: .iplaun-contents -->
                  <div class="iplaun-contents">
<?php 
if ( ! empty( $this->error )) :
  if ( $this->error == 1 ) :
?>
  <div class="iplaun-alert iplaun-alert-danger">
    <?php _e( 'Sorry launcher can not be executed because you do not specify the settings file.', IPLAUN_SLUG ); ?>
  </div>
<?php
elseif ( $this->error > 1 ) :
?>
  <div class="iplaun-alert iplaun-alert-danger">
    <?php _e( 'Sorry launcher can not be executed because your settings file is invalid.', IPLAUN_SLUG ); ?>
  </div>
<?php
  endif;
endif;
?>

<?php 
if ( ! empty( $this->success )) :
?>
  <div class="iplaun-alert iplaun-alert-success">
    <?php _e( 'Launcher has been successfully set up and manage options and content of your website.', IPLAUN_SLUG ); ?>
  </div>
<?php
endif;
?>

                    <!-- start: .iplaun-fields -->
                    <div class="iplaun-fields">

                      <!-- start: .iplaun-field-row -->
                      <div class="iplaun-field-row iplaun-field-x">

                        <div class="iplaun-form-label col-lg-2 col-md-3 col-sm-12">
                          <label for="input-setting-file"><?php _e( 'Setting File', IPLAUN_SLUG ); ?></label>
                        </div>
                        <!-- start: .iplaun-field -->
                        <div class="iplaun-field col-lg-8 col-md-9 col-sm-12">

                          <input type="file" id="input-setting-file" name="setting_file">

                        </div>
                        <!-- end: .iplaun-field -->
                      </div>
                      <!-- end: .iplaun-field-row -->

                    </div>
                    <!-- end: .iplaun-fields -->

                  </div>
                  <!-- end: .iplaun-contents -->

                  <div class="iplaun-manage-footer mt20">
                    <div class="row">
                      <div class="col-md-6">
                        
                        <span class="iplaun-button-export">
                          <button 
                            type="submit" 
                            class="iplaun-btn iplaun-btn-success iplaun-btn-lg" 
                            id="iplaun-submit-export" 
                            name="submit_export">
                              <i class="iplaun-fa iplaun-fa-upload"></i>
                              <strong><?php _e( 'Export', IPLAUN_SLUG ); ?></strong>
                          </button>
                        </span>

                      </div>
                      <div class="col-md-6">

                      </div>
                    </div>

                  </div>

                  
                </div>
              </div>

            </div>

          </form>
        </div>

      </div>
      <!-- end: .iplaun-primary -->

    </div>
    <!-- end: .iplaun-main -->

  </div>
  
  <?php
  $this->view( 'admin/includes/modal' );
  ?>

</div>
<!-- end: .iplaun-wrap -->
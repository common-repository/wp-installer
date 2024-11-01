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

<?php
if ( isset( $_GET['launch'] )) :
?>

  <div class="updated notice notice-success is-dismissible" style="margin:25px 20px 0 2px;">
    <p><?php _e( 'Launcher has been successfully set up and manage options and content of your website.', IPLAUN_SLUG ); ?></p>
  </div>

<?php
elseif ( get_option( 'iplaun_was_launch' )) :
?>

  <div class="update-nag settings-error notice is-dismissible">
    <?php _e( 'You have previously run the launcher function, if you want to run back be sure to clean the content in advance to prevent duplicate content.', IPLAUN_SLUG ); ?>
  </div>

<?php
endif;
?>

<!-- start: .iplaun-wrap -->
<div id="iplaun-main" class="wrap iplaun-wrap iplaun-admin">
  <div class="iplaun-inner">

    <?php
    $this->view( 'admin/includes/header' );
    ?>

    <!-- start: .iplaun-main -->
    <div class="iplaun-main">
      <!-- start: .iplaun-main-info -->
      <div class="iplaun-main-info">
        <?php
        if ( isset( $_GET['create'] )) :
        ?>
        <div class="iplaun-alert iplaun-alert-success" style="display: block;">
          <?php _e( 'Successfully launched new site.', IPLAUN_SLUG ); ?>
        </div>
        <?php
        endif;
        ?>
      </div>
      <!-- end: .iplaun-main-info -->

      <!-- start: .iplaun-primary -->
      <div class="iplaun-primary">

        <div class="iplaun-manage-wrap iplaun-manage-sidebar">
          <form 
            id="iplaun-form-main" 
            class="iplaun-form-container iplaun-form" 
            method="post" 
            action="<?php echo $this->formAction; ?>" 
            enctype="multipart/form-data">

            <div class="container-fluid container">

              <div class="iplaun-clear iplaun-tab">
                <?php
                $this->view( 'admin/includes/nav' );
                ?>

                <div class="iplaun-manage-content">

                  <?php
                  $this->view( 'admin/includes/content' );
                  ?>

                  <div class="iplaun-manage-footer">
                    <div class="row">
                      <div class="col-md-6">

                        <span class="iplaun-button-draft" style="display: none;">
                          <button 
                            type="submit" 
                            class="iplaun-btn iplaun-btn-success iplaun-btn-lg" 
                            id="iplaun-submit-save-draft" 
                            name="save_draft">
                              <i class="iplaun-fa iplaun-fa-save"></i>
                              <strong><?php _e( 'Export Configuration File', IPLAUN_SLUG ); ?></strong>
                          </button>
                        </span>

                      </div>
                      <div class="col-md-6 text-right">
                        
                        <span class="iplaun-bottom-submit">
                          <button 
                            type="submit" 
                            class="iplaun-btn iplaun-btn-secondary iplaun-btn-lg" 
                            id="iplaun-form-main-submit" 
                            data-step="2"
                            name="update_bottom">
                              <span class="iplaun-submit-text-next">
                                <strong><?php _e( 'Next Step', IPLAUN_SLUG ); ?></strong>
                                <i class="iplaun-fa iplaun-fa-angle-double-right ml5"></i>
                              </span>
                              <span class="iplaun-submit-text-finish" style="display: none;">
                                <strong><?php _e( 'Finish', IPLAUN_SLUG ); ?></strong>
                                <i class="iplaun-fa iplaun-fa-angle-double-right ml5"></i>
                              </span>
                          </button>
                        </span>

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

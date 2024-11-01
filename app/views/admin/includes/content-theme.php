<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Content theme view
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga
 */
?>
<!-- start: .iplaun-section -->
<div id="iplaun-section-theme" data-step="2" class="iplaun-section pt30 pb30" style="display:none;">
	<!-- start: .iplaun-section-inner -->
	<div class="iplaun-section-inner">

		<div class="row">
		
	    <div class="col-md-6">

				<!-- start: .iplaun-fields -->
		    <div class="iplaun-fields">

		    	<!-- start: .iplaun-upload-file -->
			    <div class="iplaun-upload-file _theme">

			    	<h4 class="iplaun-field-title mb0 py10">
							<?php _e( 'Upload Theme File', IPLAUN_SLUG ); ?>
						</h4>

			      <!-- start: .iplaun-field-theme-file -->
			      <div class="iplaun-field-theme-file">
			      	<div class="iplaun-error iplaun-alert iplaun-alert-danger mt15" style="display:none;">
			      		<?php _e( 'Invalid theme file (must be .zip extension)', IPLAUN_SLUG ); ?>
			      	</div>
			        <div class="iplaun-upload-box">
			        	<label><?php _e( 'Select theme file (.zip)' ); ?></label>
			        	<input type="file" id="iplaun-theme-file" name="theme_file">
			        	<em class="iplaun-file-info"></em>
			        </div>
			      </div>
			      <!-- end: .iplaun-field-theme-file -->

			      <div class="iplaun-upload-submit">
			      	<button type="button" class="iplaun-btn iplaun-btn-sm iplaun-btn-success" disabled>
			      		<?php _e( 'Upload Theme', IPLAUN_SLUG ); ?>
			      	</button>
			      </div>

		      </div>
		      <!-- end: .iplaun-theme-upload-file -->

		      <!-- start: .iplaun-upload-url -->
			    <div class="iplaun-upload-url _theme mt30">

			    	<h4 class="iplaun-field-title mb0 py10">
							<?php _e( 'Upload Theme From Link', IPLAUN_SLUG ); ?>
						</h4>

						<div class="iplaun-error iplaun-alert iplaun-alert-danger mt15" style="display:none;">
		      		<?php _e( 'Invalid theme url.', IPLAUN_SLUG ); ?>
		      	</div>
						
			      <!-- start: .iplaun-field-row -->
			      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">

			      	<div class="iplaun-form-label">
			          <label for="input-theme-url"><?php _e( 'Theme URL', IPLAUN_SLUG ); ?></label>
			        </div>
			        <!-- start: .iplaun-field -->
			        <div class="iplaun-field">
			        	<input type="text" id="input-theme-url" class="iplaun-input iplaun-input-full" name="upload_theme_url" value="">
			        </div>
			        <!-- end: .iplaun-field -->
			      </div>
			      <!-- end: .iplaun-field-row -->

			      <div class="iplaun-upload-submit">
			      	<button type="button" class="iplaun-btn iplaun-btn-sm iplaun-btn-success" disabled>
			      		<?php _e( 'Upload Theme', IPLAUN_SLUG ); ?>
			      	</button>
			      </div>

		      </div>
		      <!-- end: .iplaun-theme-upload-url -->

		    </div>
		    <!-- end: .iplaun-fields -->

		  </div>

	    <div class="col-md-6">

				<!-- start: .iplaun-fields -->
		    <div class="iplaun-fields">

		    	<h4 class="iplaun-field-title mb0 py10">
						<?php _e( 'Select Active Theme', IPLAUN_SLUG ); ?>
					</h4>

					<div class="iplaun-themes-list">

			      <?php
			      $themes = wp_prepare_themes_for_js();
			      foreach( $themes as $theme ) :
			      	$chk = '';
			      	if ( $theme['active'] ) {
			      		$chk = ' checked="checked"';
			      	}
			      ?>
			      <!-- start: .iplaun-field-row -->
			      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
			        <!-- start: .iplaun-field -->
			        <div class="iplaun-field">
			        	<label>
			        		<input type="radio" name="theme_active" value="<?php echo $theme['id']; ?>"<?php echo $chk; ?>>
			        		<?php echo $theme['name']; ?>
			        	</label>
			        </div>
			        <!-- end: .iplaun-field -->
			      </div>
			      <!-- end: .iplaun-field-row -->
			      <?php
			      endforeach;
			      ?>

		      </div>

		    </div>
		    <!-- end: .iplaun-fields -->

		  </div>
		</div>

	</div>
	<!-- end: .iplaun-section-inner -->
</div>
<!-- end: .iplaun-section -->
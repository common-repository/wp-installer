<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Content plugin view
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga
 */
?>
<!-- start: .iplaun-section -->
<div id="iplaun-section-plugin" data-step="3" class="iplaun-section pt30 pb30" style="display:none;">
	<!-- start: .iplaun-section-inner -->
	<div class="iplaun-section-inner">

		<div class="row">
		
	    <div class="col-md-6">

				<!-- start: .iplaun-fields -->
		    <div class="iplaun-fields">

		    	<!-- start: .iplaun-upload-file -->
			    <div class="iplaun-upload-file _plugin">

			    	<h4 class="iplaun-field-title mb0 py10">
							<?php _e( 'Upload Plugin File', IPLAUN_SLUG ); ?>
						</h4>

			      <!-- start: .iplaun-field-plugin-file -->
			      <div class="iplaun-field-plugin-file">
			      	<div class="iplaun-error iplaun-alert iplaun-alert-danger mt15" style="display:none;">
			      		<?php _e( 'Invalid plugin file (must be .zip extension)', IPLAUN_SLUG ); ?>
			      	</div>
			        <div class="iplaun-upload-box">
			        	<label><?php _e( 'Select plugin file (.zip)' ); ?></label>
			        	<input type="file" id="iplaun-plugin-file" name="plugin_file">
			        	<em class="iplaun-file-info"></em>
			        </div>
			      </div>
			      <!-- end: .iplaun-field-plugin-file -->

			      <div class="iplaun-upload-submit">
			      	<button type="button" class="iplaun-btn iplaun-btn-sm iplaun-btn-success" disabled>
			      		<?php _e( 'Upload Plugin', IPLAUN_SLUG ); ?>
			      	</button>
			      </div>

		      </div>
		      <!-- end: .iplaun-plugin-upload-file -->

		      <!-- start: .iplaun-upload-url -->
			    <div class="iplaun-upload-url _plugin mt30">

			    	<h4 class="iplaun-field-title mb0 py10">
							<?php _e( 'Upload Plugin From Link', IPLAUN_SLUG ); ?>
						</h4>

						<div class="iplaun-error iplaun-alert iplaun-alert-danger mt15" style="display:none;">
		      		<?php _e( 'Invalid plugin url.', IPLAUN_SLUG ); ?>
		      	</div>
						
			      <!-- start: .iplaun-field-row -->
			      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">

			      	<div class="iplaun-form-label">
			          <label for="input-plugin-url"><?php _e( 'Plugin URL', IPLAUN_SLUG ); ?></label>
			        </div>
			        <!-- start: .iplaun-field -->
			        <div class="iplaun-field">
			        	<input type="text" id="input-plugin-url" class="iplaun-input iplaun-input-full" name="upload_plugin_url" value="">
			        </div>
			        <!-- end: .iplaun-field -->
			      </div>
			      <!-- end: .iplaun-field-row -->

			      <div class="iplaun-upload-submit">
			      	<button type="button" class="iplaun-btn iplaun-btn-sm iplaun-btn-success" disabled>
			      		<?php _e( 'Upload Plugin', IPLAUN_SLUG ); ?>
			      	</button>
			      </div>

		      </div>
		      <!-- end: .iplaun-plugin-upload-url -->

		    </div>
		    <!-- end: .iplaun-fields -->

		  </div>

	    <div class="col-md-6">

				<!-- start: .iplaun-fields -->
		    <div class="iplaun-fields">

		    	<h4 class="iplaun-field-title mb0 py10">
						<?php _e( 'Select Active Plugin', IPLAUN_SLUG ); ?>
					</h4>

					<div class="iplaun-plugins-list">

			      <?php
			      $plugins = get_plugins();
			      foreach( $plugins as $id => $plugin ) :

			      	if ( $id == 'wp-ez-launcher/wp-ez-launcher.php' ) {
			      		continue;
			      	}
			      	$chk = '';
			      ?>
			      <!-- start: .iplaun-field-row -->
			      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
			        <!-- start: .iplaun-field -->
			        <div class="iplaun-field">
			        	<label>
			        		<input type="checkbox" name="plugins_active[]" value="<?php echo $id; ?>"<?php echo $chk; ?>>
			        		<?php echo $plugin['Name']; ?>
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
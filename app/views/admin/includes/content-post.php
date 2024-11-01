<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Content post view
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga
 */
?>
<!-- start: .iplaun-section -->
<div id="iplaun-section-post" data-step="6" class="iplaun-section pt30 pb30" style="display:none;">
	<!-- start: .iplaun-section-inner -->
	<div class="iplaun-section-inner">

		<div class="row">
		
	    <div class="col-md-6">

				<!-- start: .iplaun-fields -->
		    <div class="iplaun-fields">

		    	<h4 class="iplaun-field-title mb0 py10">
						<?php _e( 'Add Posts', IPLAUN_SLUG ); ?>
					</h4>

					<div>
			      <!-- start: .iplaun-field-row -->
			      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">

			      	<div class="iplaun-form-label">
			          <label for="input-posts-title"><?php _e( 'Posts Title', IPLAUN_SLUG ); ?></label>
			        </div>
			        <!-- start: .iplaun-field -->
			        <div class="iplaun-field">
			        	<textarea id="input-posts-title" class="iplaun-input iplaun-input-full iplaun-input-names" name="posts_title"></textarea>
			        	<p class="mt5"><em><?php _e( 'A post title of each line', IPLAUN_SLUG ); ?></em></p>
			        </div>
			        <!-- end: .iplaun-field -->
			      </div>
			      <!-- end: .iplaun-field-row -->
		      </div>

		      <div class="iplaun-add-submit">
		      	<button type="button" class="iplaun-btn iplaun-btn-sm iplaun-btn-success" disabled>
		      		<?php _e( 'Add Posts', IPLAUN_SLUG ); ?>
		      	</button>
		      </div>

		    </div>
		    <!-- end: .iplaun-fields -->

		  </div>

	    <div class="col-md-6">

				<!-- start: .iplaun-fields -->
		    <div class="iplaun-fields">

		    	<h4 class="iplaun-field-title mb0 py10">
						<?php _e( 'Posts List', IPLAUN_SLUG ); ?>
					</h4>

					<div class="iplaun-posts-list">

		      </div>

		    </div>
		    <!-- end: .iplaun-fields -->

		  </div>
		</div>

	</div>
	<!-- end: .iplaun-section-inner -->
</div>
<!-- end: .iplaun-section -->
<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Content page view
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga
 */
?>
<!-- start: .iplaun-section -->
<div id="iplaun-section-page" data-step="4" class="iplaun-section pt30 pb30" style="display:none;">
	<!-- start: .iplaun-section-inner -->
	<div class="iplaun-section-inner">

		<div class="row">
		
	    <div class="col-md-6">

				<!-- start: .iplaun-fields -->
		    <div class="iplaun-fields">

		    	<h4 class="iplaun-field-title mb0 py10">
						<?php _e( 'Add Pages', IPLAUN_SLUG ); ?>
					</h4>

					<div>
			      <!-- start: .iplaun-field-row -->
			      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">

			      	<div class="iplaun-form-label">
			          <label for="input-pages-title"><?php _e( 'Pages Title', IPLAUN_SLUG ); ?></label>
			        </div>
			        <!-- start: .iplaun-field -->
			        <div class="iplaun-field">
			        	<textarea id="input-pages-title" class="iplaun-input iplaun-input-full iplaun-input-names" name="pages_title"></textarea>
			        	<p class="mt5"><em><?php _e( 'A page title of each line', IPLAUN_SLUG ); ?></em></p>
			        </div>
			        <!-- end: .iplaun-field -->
			      </div>
			      <!-- end: .iplaun-field-row -->
		      </div>

		      <div class="iplaun-add-submit">
		      	<button type="button" class="iplaun-btn iplaun-btn-sm iplaun-btn-success" disabled>
		      		<?php _e( 'Add Pages', IPLAUN_SLUG ); ?>
		      	</button>
		      </div>

		    </div>
		    <!-- end: .iplaun-fields -->

		  </div>

	    <div class="col-md-6">

				<!-- start: .iplaun-fields -->
		    <div class="iplaun-fields">

		    	<h4 class="iplaun-field-title mb0 py10">
						<?php _e( 'Pages List', IPLAUN_SLUG ); ?>
					</h4>

					<div class="iplaun-pages-list">
						<?php
						$titles = array(
							__( 'About Us', IPLAUN_SLUG ),
							__( 'Contact Us', IPLAUN_SLUG ),
							__( 'Privacy Policy', IPLAUN_SLUG ),
							__( 'Terms of Use', IPLAUN_SLUG ),
							__( 'Earning Disclaimer', IPLAUN_SLUG )
						);
						$index = 1;
						foreach( $titles as $title ) :
						?>
						<div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
              <div class="iplaun-field">
                <label>
                  <input type="checkbox" name="pages_name[]" value="s:<?php echo $index; ?>" checked>
                  <span><?php echo $title; ?></span>
                </label>
                <a class="iplaun-edit-link" data-type="page" href="#<?php echo $index; ?>">
                	<i class="iplaun-fa iplaun-fa-pencil"></i>
                </a>
              </div>
            </div>
            <?php
            	$index++;
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
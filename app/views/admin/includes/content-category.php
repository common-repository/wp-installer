<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Content category view
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga
 */
?>
<!-- start: .iplaun-section -->
<div id="iplaun-section-category" data-step="5" class="iplaun-section pt30 pb30" style="display:none;">
	<!-- start: .iplaun-section-inner -->
	<div class="iplaun-section-inner">

		<div class="row">
		
	    <div class="col-md-6">

				<!-- start: .iplaun-fields -->
		    <div class="iplaun-fields">

		    	<h4 class="iplaun-field-title mb0 py10">
						<?php _e( 'Add Categories', IPLAUN_SLUG ); ?>
					</h4>

					<div>
			      <!-- start: .iplaun-field-row -->
			      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">

			      	<div class="iplaun-form-label">
			          <label for="input-categories-name"><?php _e( 'Categories Name', IPLAUN_SLUG ); ?></label>
			        </div>
			        <!-- start: .iplaun-field -->
			        <div class="iplaun-field">
			        	<textarea id="input-categories-name" class="iplaun-input iplaun-input-full iplaun-input-names" name="categories_name"></textarea>
			        	<p class="mt5"><em><?php _e( 'A category name of each line', IPLAUN_SLUG ); ?></em></p>
			        </div>
			        <!-- end: .iplaun-field -->
			      </div>
			      <!-- end: .iplaun-field-row -->
		      </div>

		      <div class="iplaun-add-submit">
		      	<button type="button" class="iplaun-btn iplaun-btn-sm iplaun-btn-success" disabled>
		      		<?php _e( 'Add Categories', IPLAUN_SLUG ); ?>
		      	</button>
		      </div>

		    </div>
		    <!-- end: .iplaun-fields -->

		  </div>

	    <div class="col-md-6">

				<!-- start: .iplaun-fields -->
		    <div class="iplaun-fields">

		    	<h4 class="iplaun-field-title mb0 py10">
						<?php _e( 'Select Active Categories', IPLAUN_SLUG ); ?>
					</h4>

					<div class="iplaun-categories-list">

			      <?php
			      $uncat = 'Uncategorized';
			      $categories = get_terms( 'category', array(
			    		'hide_empty' => false
						));
			      foreach( $categories as $category ) :
			      	$dismis = '';
			        if ( $category->term_id == 1 ) 
			        {
			        	$dismis = ' disabled="disabled"';
			        	$uncat  = $category->name;
			        }
			      ?>
			      <!-- start: .iplaun-field-row -->
			      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
			        <!-- start: .iplaun-field -->
			        <div class="iplaun-field">
			        	<label>
			        		<input type="checkbox" name="categories_active[]" value="<?php echo $category->term_taxonomy_id; ?>" checked<?php echo $dismis; ?>>
			        		<span class="iplaun-default-category-value"><?php echo $category->name; ?></span>
			        	</label>
			        </div>
			        <!-- end: .iplaun-field -->
			      </div>
			      <!-- end: .iplaun-field-row -->
			      <?php
			      endforeach;
			      ?>

		      </div>

		    	<h4 class="iplaun-field-title mb0 mt30 py10">
						<?php _e( 'Rename Default Category', IPLAUN_SLUG ); ?>
					</h4>

					<!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">

		      	<div class="iplaun-form-label">
		          <label for="input-default-category-name"><?php _e( 'Name', IPLAUN_SLUG ); ?></label>
		        </div>
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<input type="text" id="input-default-category-name" class="iplaun-input iplaun-input-full" name="default_category_name" value="<?php echo $uncat; ?>">
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

		    </div>
		    <!-- end: .iplaun-fields -->

		  </div>
		</div>

	</div>
	<!-- end: .iplaun-section-inner -->
</div>
<!-- end: .iplaun-section -->
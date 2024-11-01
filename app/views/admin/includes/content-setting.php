<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Content setting view
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga
 */
?>
<!-- start: .iplaun-section -->
<div id="iplaun-section-setting" data-step="5" class="iplaun-section pt30 pb30" style="display:none;">
	<!-- start: .iplaun-section-inner -->
	<div class="iplaun-section-inner">

		<div class="row">
		
	    <div class="col-md-6">

				<!-- start: .iplaun-fields -->
		    <div class="iplaun-fields">

		    	<h4 class="iplaun-field-title mb0 py10">
						<?php _e( 'Blog Info', IPLAUN_SLUG ); ?>
					</h4>

					<!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">

		      	<div class="iplaun-form-label">
		          <label for="input-blog-title"><?php _e( 'Blog Title', IPLAUN_SLUG ); ?></label>
		        </div>
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<input type="text" id="input-blog-title" class="iplaun-input iplaun-input-full" name="blog_title" value="">
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

					<!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">

		      	<div class="iplaun-form-label">
		          <label for="input-blog-description">
		          	<?php _e( 'Blog Description', IPLAUN_SLUG ); ?>
		          </label>
		        </div>
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<textarea id="input-blog-description" class="iplaun-input iplaun-input-full" name="blog_description"></textarea>
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

		    	<h4 class="iplaun-field-title mb0 mt30 py10">
						<?php _e( 'Permalink', IPLAUN_SLUG ); ?>
					</h4>

					<!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<label>
		        		<input type="checkbox" name="active_permalink" value="1" checked>
		        		<?php _e( 'Active Permalink', IPLAUN_SLUG ); ?>
		        	</label>
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

					<!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">

		      	<div class="iplaun-form-label">
		          <label for="input-permalink">
		          	<?php _e( 'Permalink Structure', IPLAUN_SLUG ); ?>
		          </label>
		        </div>
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<input type="text" id="input-permalink" class="iplaun-input iplaun-input-full" name="permalink_structure" value="/%postname%/">
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

		    	<h4 class="iplaun-field-title mb0 mt30 py10">
						<?php _e( 'Notification', IPLAUN_SLUG ); ?>
					</h4>

					<!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<label>
		        		<input type="checkbox" name="disabled_post_comment" value="1" checked>
		        		<?php _e( 'Turn off &quot;email me when a anyone posts a comment&quot;', IPLAUN_SLUG ); ?>
		        	</label>
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

					<!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<label>
		        		<input type="checkbox" name="disabled_comment_moderation" value="1" checked>
		        		<?php _e( 'Turn off &quot;email me when a comment is held in moderation&quot;', IPLAUN_SLUG ); ?>
		        	</label>
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

		    	

		    </div>
		    <!-- end: .iplaun-fields -->

		  </div>

	    <div class="col-md-6">

				<!-- start: .iplaun-fields -->
		    <div class="iplaun-fields">

		    	<h4 class="iplaun-field-title mb0 py10">
						<?php _e( 'Front Page Displays', IPLAUN_SLUG ); ?>
					</h4>

					<div class="ipluad-field-front-page">

						<!-- start: .iplaun-field-row -->
			      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
			        <!-- start: .iplaun-field -->
			        <div class="iplaun-field">
			        	<label>
			        		<input type="radio" name="front_page" value="posts" checked>
			        		<?php _e( 'Your latest posts', IPLAUN_SLUG ); ?>
			        	</label>
			        </div>
			        <!-- end: .iplaun-field -->
			      </div>
			      <!-- end: .iplaun-field-row -->

			      <!-- start: .iplaun-field-row -->
			      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
			        <!-- start: .iplaun-field -->
			        <div class="iplaun-field">
			        	<label>
			        		<input type="radio" name="front_page" value="page">
			        		<?php _e( 'A static page', IPLAUN_SLUG ); ?>
			        	</label>
			        </div>
			        <!-- end: .iplaun-field -->
			      </div>
			      <!-- end: .iplaun-field-row -->

			      <!-- start: .iplaun-field-row -->
			      <div id="iplaun-input-static-name" class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
			        
		        	<div class="iplaun-form-label">
			          <label for="input-static-name">
			          	<?php _e( 'Static Page Name', IPLAUN_SLUG ); ?>
			          </label>
			        </div>
			        <!-- start: .iplaun-field -->
			        <div class="iplaun-field">
			        	<input type="text" id="input-static-name" class="iplaun-input iplaun-input-full" name="static_page_name" value="">
			        </div>
			        <!-- end: .iplaun-field -->
			      </div>
			      <!-- end: .iplaun-field-row -->

		      </div>


		    	<h4 class="iplaun-field-title mb0 mt30 py10">
						<?php _e( 'Posts List', IPLAUN_SLUG ); ?>
					</h4>

					<!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
		        
	        	<div class="iplaun-form-label">
		          <label for="input-static-name">
		          	<?php _e( 'Number of posts to show', IPLAUN_SLUG ); ?>
		          </label>
		        </div>
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<input type="text" id="input-static-name" class="iplaun-input iplaun-input-full" name="number_posts" value="10">
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

					<!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
		        
	        	<div class="iplaun-form-label">
		          <label for="input-static-name">
		          	<?php _e( 'For each post in a feed, show:', IPLAUN_SLUG ); ?>
		          </label>
		        </div>
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<label>
		        		<input type="radio" name="post_content_format" value="full">
		        		<?php _e( 'Full Text', IPLAUN_SLUG ); ?>
		        	</label>
		        	<label class="ml10">
		        		<input type="radio" name="post_content_format" value="summary" checked>
		        		<?php _e( 'Summary', IPLAUN_SLUG ); ?>
		        	</label>
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
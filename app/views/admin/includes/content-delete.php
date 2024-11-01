<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Content delete view
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga
 */
?>
<!-- start: .iplaun-section -->
<div id="iplaun-section-delete" data-step="1" class="iplaun-section pt30 pb30">
	<!-- start: .iplaun-section-inner -->
	<div class="iplaun-section-inner">

		<div class="row">
		
	    <div class="col-md-6">

				<!-- start: .iplaun-fields -->
		    <div class="iplaun-fields">

		    	<h4 class="iplaun-field-title mb0 py10">
						<?php _e( 'Delete Unwated Content', IPLAUN_SLUG ); ?>
					</h4>

		      <?php
		      /*
		       * Delete hello world post
		       */
		      ?>
		      <!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<label>
		        		<input type="checkbox" name="delete_post_default" value="1" checked>
		        		<?php _e( 'Delete &quot;Hello Worlds!&quot; post', IPLAUN_SLUG ); ?>
		        	</label>
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

		      <?php
		      /*
		       * Delete hello world comment
		       */
		      ?>
		      <!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<label>
		        		<input type="checkbox" name="delete_comment_default" value="1" checked>
		        		<?php _e( 'Delete &quot;Hello Worlds!&quot; comment', IPLAUN_SLUG ); ?>
		        	</label>
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

		      <?php
		      /*
		       * Delete sample page
		       */
		      ?>
		      <!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<label>
		        		<input type="checkbox" name="delete_page_default" value="1" checked>
		        		<?php _e( 'Delete &quot;Sample Page!&quot; page', IPLAUN_SLUG ); ?>
		        	</label>
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

		      <?php
		      /*
		       * Delete all posts
		       */
		      ?>
		      <!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<label>
		        		<input type="checkbox" name="delete_post_all" value="1">
		        		<?php _e( 'Delete all posts', IPLAUN_SLUG ); ?>
		        	</label>
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

		      <?php
		      /*
		       * Delete all page
		       */
		      ?>
		      <!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<label>
		        		<input type="checkbox" name="delete_page_all" value="1">
		        		<?php _e( 'Delete all pages', IPLAUN_SLUG ); ?>
		        	</label>
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

		      <?php
		      /*
		       * Delete all comments
		       */
		      ?>
		      <!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<label>
		        		<input type="checkbox" name="delete_comment_all" value="1">
		        		<?php _e( 'Delete all comments', IPLAUN_SLUG ); ?>
		        	</label>
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

		      <?php
		      /*
		       * Delete all taxos
		       */
		      ?>
		      <!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<label>
		        		<input type="checkbox" name="delete_taxonomy_all" value="1">
		        		<?php _e( 'Delete all categories &amp; tags', IPLAUN_SLUG ); ?>
		        	</label>
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

		      <?php
		      /*
		       * Delete all medias
		       */
		      ?>
		      <!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<label>
		        		<input type="checkbox" name="delete_media_all" value="1">
		        		<?php _e( 'Delete all medias', IPLAUN_SLUG ); ?>
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
						<?php _e( 'Delete Unwated Sidebar Widgets', IPLAUN_SLUG ); ?>
					</h4>

		      <?php
		      /*
		       * Delete recent posts widget
		       */
		      ?>
		      <!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<label>
		        		<input type="checkbox" name="delete_widget_posts" value="1" checked>
		        		<?php _e( 'Delete Recent Posts widget', IPLAUN_SLUG ); ?>
		        	</label>
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

		      <?php
		      /*
		       * Delete recent comments widget
		       */
		      ?>
		      <!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<label>
		        		<input type="checkbox" name="delete_widget_comments" value="1" checked>
		        		<?php _e( 'Delete Recent Comments widget', IPLAUN_SLUG ); ?>
		        	</label>
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

		      <?php
		      /*
		       * Delete archives widget
		       */
		      ?>
		      <!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<label>
		        		<input type="checkbox" name="delete_widget_archives" value="1" checked>
		        		<?php _e( 'Delete Archives widget', IPLAUN_SLUG ); ?>
		        	</label>
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

		      <?php
		      /*
		       * Delete categories widget
		       */
		      ?>
		      <!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<label>
		        		<input type="checkbox" name="delete_widget_category" value="1" checked>
		        		<?php _e( 'Delete Categories widget', IPLAUN_SLUG ); ?>
		        	</label>
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

		      <?php
		      /*
		       * Delete search widget
		       */
		      ?>
		      <!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<label>
		        		<input type="checkbox" name="delete_widget_search" value="1" checked>
		        		<?php _e( 'Delete Search widget', IPLAUN_SLUG ); ?>
		        	</label>
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

		      <?php
		      /*
		       * Delete meta widget
		       */
		      ?>
		      <!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<label>
		        		<input type="checkbox" name="delete_widget_meta" value="1" checked>
		        		<?php _e( 'Delete Meta widget', IPLAUN_SLUG ); ?>
		        	</label>
		        </div>
		        <!-- end: .iplaun-field -->
		      </div>
		      <!-- end: .iplaun-field-row -->

		      <?php
		      /*
		       * Delete all widgets
		       */
		      ?>
		      <!-- start: .iplaun-field-row -->
		      <div class="iplaun-field-row iplaun-field-sm iplaun-field-y pl0">
		        <!-- start: .iplaun-field -->
		        <div class="iplaun-field">
		        	<label>
		        		<input type="checkbox" name="delete_widget_all" value="1">
		        		<?php _e( 'Delete all sidebar widgets', IPLAUN_SLUG ); ?>
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
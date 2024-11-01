<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Contents view
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga
 */
?>
<!-- start: .iplaun-contents -->
<div class="iplaun-contents">

	<?php
	
	$this->view( 'admin/includes/content-delete' );
	$this->view( 'admin/includes/content-theme' );
	$this->view( 'admin/includes/content-plugin' );
	$this->view( 'admin/includes/content-page' );
	$this->view( 'admin/includes/content-setting' );
	?>

</div>
<!-- end: .iplaun-contents -->
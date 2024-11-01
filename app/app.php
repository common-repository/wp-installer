<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Main application class
 *
 * @package WordpressInstaller
 * @author WordpressInstaller
 * @link http://WordpressInstaller.ga/
 */

//
//Include all function files

require_once( IPLAUN_LIB . '/config.php' );
require_once( IPLAUN_LIB . '/setting.php' );
require_once( IPLAUN_LIB . '/installer.php' );
require_once( IPLAUN_APP . '/controller.php' );
require_once( IPLAUN_APP . '/viewer.php' );

if ( ! class_exists( 'IPLaun_App' ))
{
	class IPLaun_App
	{
		//{{ run

		/**
		 * Run all functions
		 *
		 * @return void
		 */
		public static function run()
		{
			$hook = sanitize_title( IPLAUN_TITLE );

			//
			//Admin init
			add_action( 'admin_init', array( __CLASS__, 'adminInit' ) );

			//
			//Register admin menu
			add_action( 'admin_menu', array( __CLASS__, 'addAdminMenu' ) );

			//
			//Add css
			add_action(
				'admin_print_styles-toplevel_page_' . IPLAUN_PAGENAME,
				array( __CLASS__, 'adminStyle' ),
				1100
			);
			add_action(
				'admin_print_styles-'.$hook.'_page_' . IPLAUN_PAGENAME . '-export',
				array( __CLASS__, 'adminStyle' ),
				1100
			);
			add_action(
				'admin_print_styles',
				array( __CLASS__, 'adminGlobalStyle' ),
				1000
			);

			//
			//Add javascript
			add_action(
				'admin_print_scripts-toplevel_page_' . IPLAUN_PAGENAME,
				array( __CLASS__, 'adminScript' ),
				1100
			);
			add_action(
				'admin_print_scripts-'.$hook.'_page_' . IPLAUN_PAGENAME . '-export',
				array( __CLASS__, 'adminScript' ),
				1100
			);
		}

		//}}
		//{{ adminInit

		/**
		 * Admin init
		 *
		 * @return void
		 */
		public static function adminInit()
		{
			/**
			 * Ajax handler
			 **/
			$controller = new IPLaun_Controller();
			$controller->ajax();

			//
			//Save option controller
			$controller->saveOption();
		}

		//}}
		//{{ addAdminMenu

		/**
		 * Add admin menu
		 *
		 * @return void
		 */
		public static function addAdminMenu()
		{
			add_menu_page(
				IPLAUN_TITLE,
				IPLAUN_TITLE,
				'edit_posts',
				IPLAUN_PAGENAME,
				array( __CLASS__, 'main' ),
				'none'
			);
		}

		//}}
		//{{ main

		/**
		 * Main page control
		 *
		 * @return void
		 */
		public static function main()
		{
			$viewer = new IPLaun_Viewer();
			$viewer->main();
		}

		//}}
		//{{ export

		/**
		 * Export page control
		 *
		 * @return void
		 */
		public static function export()
		{
			$viewer = new IPLaun_Viewer();
			//
			//If submitted
			if ( isset( $_POST['submit_export'] ))
			{
				$error   = 0;
				$success = 0;

				if ( empty( $_FILES['setting_file']['tmp_name'] )) {
					$error = 1;
				}
				else 
				{
					$filedata = file_get_contents( $_FILES['setting_file']['tmp_name'] );
					if ( ! $jsondata = base64_decode( $filedata )) {
						$error = 2;
					}
					else
					{
						$data = json_decode( $jsondata, true );
						if ( ! is_array( $data ) || ! isset( $data['wp_ez_launcher'] )) {
							$error = 3;
						}
						else
						{
							$installer = new IPLaun_Installer( $data );
				      $installer->install();

				      update_option( 'iplaun_was_launch', 1 );

				      $success = 1;
						}
					}
				}

				$viewer->error   = $error;
				$viewer->success = $success;
			}
			$viewer->export();
		}

		//}}
		//{{ adminStyle

		/**
		 * Add Css file
		 *
		 * @return void
		 */
		public static function adminStyle()
		{
			wp_deregister_style( 'iplaun-admin-style' );
			wp_register_style(
				'iplaun-admin-style',
				IPLAUN_BASE_URL . 'assets/css/admin.min.css',
				false,
				null
			);
			wp_enqueue_style('iplaun-admin-style');
		}

		//}}
		//{{ adminGlobalStyle

		/**
		 * Add Css file to all pages
		 *
		 * @return void
		 */
		public static function adminGlobalStyle()
		{
			wp_deregister_style( 'iplaun-admin-global-style' );
			wp_register_style(
				'iplaun-admin-global-style',
				IPLAUN_BASE_URL . 'assets/css/admin-global.css',
				false,
				null
			);
			wp_enqueue_style('iplaun-admin-global-style');
		?>

			<style>
				.menu-top.toplevel_page_<?php echo IPLAUN_PAGENAME; ?> .wp-menu-image {
					font-family: IPlaunIcon;
					font-size: 20px;
					font-style: normal;
				}
				.menu-top.toplevel_page_<?php echo IPLAUN_PAGENAME; ?> .wp-menu-image:before {
					content: "\f100";
					font-family: IPlaunIcon;
					font-size: 20px;
					font-style: normal;
				}
			</style>

		<?php 
		}

		//}}
		//{{ adminScript

		/**
		 * Add javascript file
		 *
		 * @return void
		 */
		public static function adminScript()
		{
		?>
			<script type="text/javascript">
				var iplaun_img_url = '<?php echo IPLAUN_BASE_URL . 'assets/img/'; ?>',
					ui_base_image	= '<?php echo IPLAUN_BASE_URL . 'assets/img/'; ?>',
					ui_message		 =
					{
						delete_confirm_title: '<?php _e( 'Delete Confirmation', IPLAUN_SLUG ); ?>',
						delete_confirm_info: '<?php _e( 'Are you sure doing this action?', IPLAUN_SLUG ); ?>'
					}
			</script>

			<?php


    wp_enqueue_script( 'jquery-ui-core' );
    wp_enqueue_script( 'jquery-ui-widget' );
    wp_enqueue_script( 'jquery-ui-mouse' );
    wp_enqueue_script( 'jquery-ui-accordion' );
    wp_enqueue_script( 'jquery-ui-autocomplete' );
    wp_enqueue_script( 'jquery-ui-slider' );
    wp_enqueue_script( 'jquery-ui-tabs' );
    wp_enqueue_script( 'jquery-ui-sortable' );
    wp_enqueue_script( 'jquery-ui-draggable' );
    wp_enqueue_script( 'jquery-ui-droppable' );
    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_script( 'jquery-ui-resize' );
    wp_enqueue_script( 'jquery-ui-dialog' );
    wp_enqueue_script( 'jquery-ui-button' );

		

			wp_deregister_script('iplaun-admin-script');
			wp_enqueue_script(
				'iplaun-admin-script',
				IPLAUN_BASE_URL . 'assets/js/admin.js',
				array( 'jquery' ),
				1,
				true
			);
		}
		//}}
	}
}

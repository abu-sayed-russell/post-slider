<?php
/**
 * @package  PostSlider
 * @developer  name : Abu Sayed Russell
 */

namespace MMWPS\Common;


if (!class_exists('MMWPS_Post_Slider_Enqueue')) {

	class MMWPS_Post_Slider_Enqueue {

		public function mmwps_register() {
			if ( ( is_admin() && isset($_GET['page'])  && ( $_GET["page"] == "mmwps-slider" || $_GET['page'] == 'mmwps-slider' || $_GET['page'] == 'mmwps-new-slider' || $_GET['page'] == 'mmwps-edit-slider'  ))) {
				add_action( 'admin_enqueue_scripts', array( $this, 'mmwps_enqueue' ) );
			}
			add_action( 'admin_enqueue_scripts', array( $this, 'mmwps_global_enqueue' ) );
			add_action('admin_enqueue_scripts', array( $this, 'mmwps_message_admin_style' ) );
			//add_action( 'wp_enqueue_scripts', array( $this, 'mmwps_front_enqueue' ) );
		}
        /**
		 * admin_enqueue_scripts
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
		 * Date       : 15.04.2020
		*/
		public function mmwps_enqueue ($hook) {
			$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
			if ( ( isset($_GET['page']) && ( $_GET['page'] == 'mmwps-slider' || $_GET['page'] == 'mmwps-slider' || $_GET['page'] == 'mmwps-new-slider' || $_GET['page'] == 'mmwps-edit-slider'  ))) {
				wp_enqueue_script('jquery');
				wp_enqueue_style("mmwps-font",  mmwps_plugin_url('/assets/plugins/font-awesome/css/font-awesome.min.css'), null , MMWPS_VERSION);
				wp_enqueue_style("mmwps-reset", mmwps_plugin_url('/assets/css/reset.css'), null , MMWPS_VERSION);
				wp_enqueue_style("mmwps-robot", mmwps_plugin_url('/assets/plugins/roboto/roboto.css'), null , MMWPS_VERSION);
				wp_enqueue_style("mmwps-vendor", mmwps_plugin_url('/assets/plugins/app-build/vendor.css'), null , MMWPS_VERSION);
				wp_enqueue_style("mmwps-select", mmwps_plugin_url('/assets/plugins/bootstrap-select/css/bootstrap-select.min.css'), null , MMWPS_VERSION);
				wp_enqueue_style("mmwps-animate", mmwps_plugin_url('/assets/plugins/notify/animate.css'), null , MMWPS_VERSION);
				wp_enqueue_style("mmwps-confirm", mmwps_plugin_url('/assets/plugins/notify/jquery-confirm.min.css'), null , MMWPS_VERSION);
				wp_enqueue_style("mmwps-color-picker", mmwps_plugin_url('/assets/plugins/color-picker/alpha/alpha-color-picker.css'), array('wp-color-picker') , MMWPS_VERSION);
				wp_enqueue_style("mmwps-jquery-ui", mmwps_plugin_url('/assets/plugins/jquery-ui/jquery-ui-custom.css'), null , MMWPS_VERSION);
				wp_enqueue_style("mmwps-main", mmwps_plugin_url('/assets/css/main.css'), null , MMWPS_VERSION);

				wp_enqueue_script("mmwps-popper", mmwps_plugin_url('/assets/plugins/bootstrap/js/popper.min.js'),array( 'jquery' ), MMWPS_VERSION, true);
				wp_enqueue_script("mmwps-boots", mmwps_plugin_url('/assets/plugins/bootstrap/js/bootstrap.min.js'),array( 'jquery' ), MMWPS_VERSION, true);
				wp_enqueue_script("mmwps-tooltip", mmwps_plugin_url('/assets/plugins/bootstrap/js/tooltip.js'),array( 'jquery' ), MMWPS_VERSION, true);
				wp_enqueue_script("mmwps-select", mmwps_plugin_url('/assets/plugins/bootstrap-select/js/bootstrap-select.min.js'),array( 'jquery' ), MMWPS_VERSION, true);
				wp_enqueue_script("mmwps-datatable", mmwps_plugin_url('/assets/plugins/datatables/datatables.min.js'), array( 'jquery' ), MMWPS_VERSION, true);	
				wp_enqueue_script("mmwps-notify", mmwps_plugin_url('/assets/plugins/notify/notify.min.js'), array( 'jquery' ), MMWPS_VERSION, true);		
				wp_enqueue_script("mmwps-confirm", mmwps_plugin_url('/assets/plugins/notify/jquery-confirm.min.js'), array( 'jquery' ), MMWPS_VERSION, true);		
				wp_enqueue_script("mmwps-color-picker", mmwps_plugin_url('/assets/plugins/color-picker/alpha/alpha-color-picker.js'), array( 'jquery', 'wp-color-picker','jquery-ui-slider' ), MMWPS_VERSION, true);		
				wp_enqueue_script("mmwps-main", mmwps_plugin_url('/assets/plugins/app-build/main.js'), array( 'jquery' ), MMWPS_VERSION, true);
				wp_enqueue_script("mmwps-ajax", mmwps_plugin_url('/assets/plugins/app-build/ajax.js'), array( 'jquery' ), MMWPS_VERSION, true);
			}
		}
		/**
		 * admin_enqueue_scripts global
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
		 * Date       : 15.04.2020
		*/
		public function mmwps_global_enqueue(){
			wp_enqueue_style("mmwps-global", mmwps_plugin_url('/assets/plugins/app-build/global.css'), null , MMWPS_VERSION);
			wp_enqueue_script("mmwps-global", mmwps_plugin_url('/assets/plugins/app-build/global.js'), array( 'jquery' ), MMWPS_VERSION, true);
		}
		/**
		 * wp_enqueue_scripts front-end
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
		 * Date       : 15.04.2020
		*/
		public function mmwps_front_enqueue(){
			wp_enqueue_style("mmwps-front", mmwps_plugin_url('/assets/dynamic/mmwps_css.php'), null , MMWPS_VERSION);
			wp_enqueue_script("mmwps-front-js", mmwps_plugin_url('/assets/dynamic/mmwps_js.php'), null, MMWPS_VERSION, true);
		}
		/**
		 * Admin Menu
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
		 * Date       : 15.04.2020
		*/
		public function mmwps_message_admin_style() {
		?>
		<style>
			#toplevel_page_mmwps-slider > ul > li.current{border-radius: 0;background:#e9ebef;}
			#toplevel_page_mmwps-slider > ul > li.current > a.current{font-weight: 400 !important; color:#000000}
			#toplevel_page_mmwps-slider > ul > li.current > a:hover{font-weight: 400 !important; color:#000000!important;}
			#toplevel_page_mmwps-slider li:nth-child(4),
			#toplevel_page_mmwps-slider li:last-child {display: none!important;}
		</style>
	<?php }
	}
}
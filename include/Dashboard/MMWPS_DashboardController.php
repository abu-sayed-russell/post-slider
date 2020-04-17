<?php 
/**
 * @package  PostSlider
 * @developer  name : Abu Sayed Russell
 */
namespace MMWPS\Dashboard;

use MMWPS\Apis\MMWPS_SettingsApi;
use MMWPS\Apis\Callbacks\PostSliderCallbacks;
use MMWPS\Common\MMWPS_BaseController;

if (!class_exists('MMWPS_DashboardController')) {
	
	class MMWPS_DashboardController extends MMWPS_BaseController
	{
		public $mmwps_settings;

		public $mmwpsCallbacks;

		public $mmwps_pages = array();

		public function mmwps_register()
		{
			if ( version_compare( PHP_VERSION, '5.6.0', '>=' ) ) {
			    if ( ! $this->mmwps_last_code() ) return;
				if ( ! $this->mmwps_wp_version_check() ) return;
				$this->mmwps_settings = new MMWPS_SettingsApi();
				$this->mmwpsCallbacks = new PostSliderCallbacks();
				$this->mmwps_admin_menu_page();
				$this->mmwps_settings->mmwps_admin_pages( $this->mmwps_pages )->mmwps_with_sub_pages( 'Manage Slider' )->mmwps_register();
			}
		}

		public function mmwps_admin_menu_page() 
		{
			$this->mmwps_pages = array(
				array(
					'page_title' => 'Manage Slider',
					'menu_title' => 'Manage Slider',
					'capability' => 'manage_options', 
					'menu_slug' => 'mmwps-slider',
					'callback' => array( $this->mmwpsCallbacks, 'mmwps_manage_post_slider' ), 
					'icon_url' => 'dashicons-align-center',
					'position' => 110
				)
			);
		}
	}
}
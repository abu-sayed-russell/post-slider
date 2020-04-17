<?php
/**
 * @package  PostSlider
 * @developer  name : Abu Sayed Russell
 */

namespace MMWPS\Common;

use MMWPS\Apis\MMWPS_SettingsApi;
use MMWPS\Apis\Callbacks\PostSliderCallbacks;
use MMWPS\Common\MMWPS_BaseController;

if (!class_exists('MMWPS_Post_Slider_Manage')) {
	
	class MMWPS_Post_Slider_Manage extends MMWPS_BaseController {
		
		public $MMWPS_settings;

		public $mmwpsCallbacks;

		public $mmwps_subpages = array();

		public function mmwps_register() {
			if ( version_compare( PHP_VERSION, '5.6.0', '>=' ) ) {
			   if ( ! $this->mmwps_last_code() ) return;
			   if ( ! $this->mmwps_wp_version_check() ) return;
				$this->MMWPS_settings = new MMWPS_SettingsApi();
				$this->mmwpsCallbacks = new PostSliderCallbacks();
				$this->mmwps_setSubpages();
				$this->MMWPS_settings->mmwps_admin_subpages( $this->mmwps_subpages )->mmwps_register();
			}else{
			    add_action( 'admin_notices',  'wp_version_error_warning');
			}
			
		}

		public function mmwps_setSubpages() {
			$this->mmwps_subpages = array(
				array(
					'parent_slug' => 'mmwps-slider',
					'page_title'  => 'New Slider',
					'menu_title'  => 'New Slider',
					'capability'  => 'manage_options',
					'menu_slug'   => 'mmwps-new-slider',
					'callback'    => array( $this->mmwpsCallbacks, 'mmwps_new_slider' )
				),
				array(
					'parent_slug' => 'mmwps-slider',
					'page_title'  => 'Edit Field',
					'menu_title'  => '',
					'capability'  => 'manage_options',
					'menu_slug'   => 'mmwps-edit-slider',
					'callback'    => array( $this->mmwpsCallbacks, 'mmwps_edit_slider' )
				),
			);
		}
	}
}
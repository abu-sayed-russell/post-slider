<?php 
/**
 * @package  PostSlider
 */
namespace MMWPS\Apis\Callbacks;

if (!class_exists('PostSliderCallbacks')) {
	
	class PostSliderCallbacks
	{
		public function mmwps_manage_post_slider()
		{
			return require_once( MMWPS_POST_SLIDER_PLUGIN_DIR_PATH . "views/slider_view.php");
		}
		public function mmwps_new_slider()
		{
			return require_once( MMWPS_POST_SLIDER_PLUGIN_DIR_PATH . "views/slider_new_view.php" );
		}
		public function mmwps_edit_slider()
		{
			return require_once( MMWPS_POST_SLIDER_PLUGIN_DIR_PATH . "views/slider_edit_view.php" );
		}
	}
}
<?php
/**
 * @package  PostSlider
 * @developer  name : Abu Sayed Russell
 */
namespace MMWPS\Common;

if (!class_exists('MMWPS_DeactivatePostSlider')) {
	
	class MMWPS_DeactivatePostSlider
	{
		public static function MMWPS_DeactivatePostSliderFlash() {
			flush_rewrite_rules();
		}
	}
}
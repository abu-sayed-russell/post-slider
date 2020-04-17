<?php
/**
 * @package  PostSlider
 * @developer  name : Abu Sayed Russell
 */
namespace MMWPS;

final class MMWPS
{
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 	 * Date       : 06.04.2020
	 */
	public static function mmwps_getServices()
	{
		return [
			Dashboard\MMWPS_DashboardController::class,
			Common\MMWPS_Post_Slider_Enqueue::class,
			Common\MMWPS_CommonController::class,
			Common\MMWPS_Post_Slider_Manage::class,
			Common\MMWPS_AjaxController::class,
		];
	}

	/**
	 * Loop through the classes, initialize them,
	 * and call the mmwps_registerServices() method if it exists
	 * @return
	 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 	 * Date       : 06.04.2020
	 */
	public static function mmwps_registerServices()
	{
		foreach (self::mmwps_getServices() as $class) {
			$mmwps_service = self::mmwps_instantiate($class);
			if (method_exists($mmwps_service, 'mmwps_register')) {
				$mmwps_service->mmwps_register();
			}
		}
	}

	/**
	 * Initialize the class
	 * @param  class $class    class from the services array
	 * @return class mmwps_instantiate  new instance of the class
	 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 	 * Date       : 06.04.2020
	 */
	private static function mmwps_instantiate($class)
	{
		$mmwps_service = new $class();

		return $mmwps_service;
	}
}
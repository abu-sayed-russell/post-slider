 <?php 
/**
 * @package  Helper
 * @developer  name : Abu Sayed Russell
 */

/**
 * plugin url
 * @param  string  $path  file path
 * @return string
 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 * Date       : 06.04.2020
*/
if ( ! function_exists( 'mmwps_plugin_url' ) ) {
	
	function mmwps_plugin_url( $path = '' ) {
	  $url = plugins_url( $path, MMWPS_POST_SLIDER_PLUGIN );

	  if ( is_ssl()
	  and 'http:' == substr( $url, 0, 5 ) ) {
	    $url = 'https:' . substr( $url, 5 );
	  }
	  return $url;
	}
}
 <?php 
/**
 * @package  Function Helper
 * @developer  name : Abu Sayed Russell
 */

use MMWPS\Library\MMWPSGetFunction;

/**
* Post Table
* Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
* Date       : 06.04.2020
*/
function mmwps_post_table(){
	return MMWPSGetFunction::last_code_post_table();
}

/**
 * Post Meta Table
 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 * Date       : 06.04.2020
*/

function mmwps_post_meta_table(){
	return MMWPSGetFunction::last_code_post_meta_table();
}
/**
* Text Shorten
* @param  string  $text  content
* @param  integer  $limit number
* @return string
* Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
* Date       : 06.04.2020
*/
function mmwps_textShorten($text, $limit = 400){
	return MMWPSGetFunction::last_code_textShorten($text, $limit = 400);
}
/**
* Username
* @param  integer  $id  author id
* @param  string  $limit number
* @return string
* Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
* Date       : 06.04.2020
*/
function mmwps_get_username($id){
	return MMWPSGetFunction::last_code_get_username($id);
}
/**
* User Email
* @param  integer  $id  author id
* @return string
* Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
* Date       : 06.04.2020
*/
function mmwps_auth_email($id){
	return MMWPSGetFunction::last_code_auth_email($id);
}
/**
* User Role
* @param  integer $id  author id
* @return string
* Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
* Date       : 06.04.2020
*/
function mmwps_userrole($id){
	return MMWPSGetFunction::last_code_userrole($id);
}
/**
* Check Duplicate Data
* @param  string  $tableName  table name
* @param  string  $columnName column name
* @param  string  $checkVal value
* @return string
* Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
* Date       : 06.04.2020
*/
function mmwps_check_duplicate($tableName,$columnName, $checkVal){
	return MMWPSGetFunction::last_code_check_duplicate($tableName,$columnName, $checkVal);
}
/**
 * Time Ago Function
 * @param  string  $time_ago  time
 * @return string
 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 * Date       : 06.04.2020
*/
function mmwps_create_before($time_ago){
	return MMWPSGetFunction::last_code_create_before($time_ago);
}

/**
* Get Slider
* @param  string  $post_type  post type <default mmwps >
* @return array data
* Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
* Date       : 11.04.2020
*/
function mmwps_get_sliders($post_type = 'mmwps'){
	return MMWPSGetFunction::last_code_get_sliders($post_type = 'mmwps');
}
/**
* Update  Silder Data
* @param  string  $post_type  post type <default mmwps>
* @return array data
* Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
* Date       : 11.04.2020
*/
function mmwps_update_slider_data( $id ){
	return MMWPSGetFunction::last_code_update_slider_data($id);
}

/**
* Get Meta Data
* @param  string  $post_id  post ID
* @param  string  $key  Meta Key
* @return array data
* Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
* Date       : 11.04.2020
*/
function mmwps_get_serialize_meta( $post_id, $key ){
	return MMWPSGetFunction::last_code_get_serialize_meta($post_id, $key);
}
/**
* set_value
* @param  string  $field field
* @param  string  $default default value
* @param  boolean  $html_escape true/false
* @return array data
* Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
* Date       : 14.04.2020
*/
function mmwps_set_value( $field, $default = '', $html_escape = TRUE ){
	return MMWPSGetFunction::last_code_set_value($field, $default = '', $html_escape = TRUE);
}
/**
* html_escape
* @param  string  $var variable
* @param  boolean  $double_encode true/false
* @return array data
* Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
* Date       : 14.04.2020
*/
function mmwps_html_escape( $var, $double_encode = TRUE ){
	return MMWPSGetFunction::last_code_html_escape($var, $double_encode = TRUE);
}
/**
* clear_textarea_breaks
* @param  string  $text text
* @return array data
* Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
* Date       : 14.04.2020
*/
function clear_textarea_breaks( $text ){
	return MMWPSGetFunction::last_code_clear_textarea_breaks($text);
}
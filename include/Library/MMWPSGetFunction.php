<?php
/**
 * @package  PostSlider
 * @developer  name : Abu Sayed Russell
 */
namespace MMWPS\Library;

if (!class_exists('MMWPSGetFunction')) {
	
	class MMWPSGetFunction {
		/**
		* Post Table
		* Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
		* Date       : 06.04.2020
		*/
		public static function last_code_post_table(){
			global $wpdb;
			return $wpdb->prefix . "posts";
		}
		
		/**
		 * Post Meta Table
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
		 * Date       : 06.04.2020
		*/
		
		public static function last_code_post_meta_table(){
			global $wpdb;
			return $wpdb->prefix . "postmeta";
		}
		/**
		 * Time Ago Function
		 * @param  string  $time_ago  time
		 * @return string
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
		 * Date       : 06.04.2020
		*/
		public static function last_code_create_before( $time_ago ) {
			$time_ago     = strtotime( $time_ago );
			$cur_time     = time();
			$time_elapsed = $cur_time - $time_ago;
			$seconds      = $time_elapsed;
			$minutes      = round( $time_elapsed / 60 );
			$hours        = round( $time_elapsed / 3600 );
			$days         = round( $time_elapsed / 86400 );
			$weeks        = round( $time_elapsed / 604800 );
			$months       = round( $time_elapsed / 2600640 );
			$years        = round( $time_elapsed / 31207680 );
			// Seconds
			if ( $seconds <= 60 ) {
				return "just now";
			} //Minutes
			elseif ( $minutes <= 60 ) {
				if ( $minutes == 1 ) {
					return "one minute ago";
				} else {
					return "$minutes minutes ago";
				}
			} //Hours
			elseif ( $hours <= 24 ) {
				if ( $hours == 1 ) {
					return "an hour ago";
				} else {
					return "$hours hours ago";
				}
			} //Days
			elseif ( $days <= 7 ) {
				if ( $days == 1 ) {
					return "yesterday";
				} else {
					return "$days days ago";
				}
			} //Weeks
			elseif ( $weeks <= 4.3 ) {
				if ( $weeks == 1 ) {
					return "a week ago";
				} else {
					return "$weeks weeks ago";
				}
			} //Months
			elseif ( $months <= 12 ) {
				if ( $months == 1 ) {
					return "a month ago";
				} else {
					return "$months months ago";
				}
			} //Years
			else {
				if ( $years == 1 ) {
					return "one year ago";
				} else {
					return "$years years ago";
				}
			}
		}
		/**
		 * Text Shorten
		 * @param  string  $text  content
		 * @param  integer  $limit number
		 * @return string
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
		 * Date       : 06.04.2020
		*/
		public static function last_code_textShorten($text, $limit = 400){
		    $text = $text . " ";
		    $text = substr($text, 0, $limit);
		    $text = substr($text, 0, strrpos($text, ' '));
		    $text = $text . "...";
		    return $text;
		}
		/**
		 * Username
		 * @param  integer  $id  author id
		 * @param  string  $limit number
		 * @return string
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
		 * Date       : 06.04.2020
		*/
		public static function last_code_get_username($id){
			$author_id = get_user_by('id', $id);
			return $author_id->display_name;
		}
		/**
		 * User Email
		 * @param  integer  $id  author id
		 * @return string
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
		 * Date       : 06.04.2020
		*/
		public static function last_code_auth_email($id){
			$author_id = get_user_by('id', $id);
			return $author_id->user_email;
		}
		/**
		 * User Role
		 * @param  integer $id  author id
		 * @return string
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
		 * Date       : 06.04.2020
		*/
		public static function last_code_userrole($id){
			$author_id = get_user_by('id', $id);
			return $author_id->roles[0];
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
		public static function last_code_check_duplicate($tableName,$columnName, $checkVal)
		{
			global $wpdb;
		    $checkQuery = $wpdb->get_results( "SELECT * FROM " . $tableName . " WHERE $columnName = '$checkVal'" );
		    return $checkQuery;
		}
		/**
		 * Get Meta Data
		 * @param  string  $post_id  post ID
		 * @param  string  $key  Meta Key
		 * @return array data
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
		 * Date       : 11.04.2020
		*/
		public static function last_code_get_serialize_meta( $post_id, $key ) {
		    global $post;
	        $meta = get_post_meta( $post_id, $key, true );

	        if ( is_string( $meta ) && ! empty( $meta ) ) {
	            $meta = unserialize( $meta );
	        }

	        if ( empty( $meta ) ) {
	            $meta = [];
	        }

	        return $meta;
		}
		/**
		 * Get Slider
		 * @param  string  $post_type  post type <default mmwps >
		 * @return array data
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
		 * Date       : 11.04.2020
		*/
		public static function last_code_get_sliders($post_type = 'mmwps'){
		  global $wpdb;
		  $data = array();
		   $sliders = $wpdb->get_results( "SELECT ID, post_type, post_title, post_date, post_name, post_status, post_author FROM ".mmwps_post_table()." WHERE post_type = '{$post_type}' ORDER BY post_date DESC" );
		   if ( isset( $sliders ) && count( $sliders ) > 0 ){
		      foreach ($sliders as $row) {
		        $slider_meta = $wpdb->get_results(
		            $wpdb->prepare( "SELECT * FROM ".mmwps_post_meta_table()." WHERE post_id = %d", $row->ID )
		          );

		        $row->_id       		= $row->ID; 
		        $row->_post_type    	= $row->post_type;
		        $row->_title  			= $row->post_title;
		        $row->_created_at   	= $row->post_date;
		        $row->_slug   			= $row->post_name;
		        $row->_slider_status	= $row->post_status;
		        $row->_auth_id     		= $row->post_author;
		      
		        if ( isset( $slider_meta ) && count( $slider_meta ) > 0 ){  
		         foreach ($slider_meta as $meta_row) {
		       		if (!empty($meta_row) && $meta_row->meta_key == 'mmwps_data') {
		       			if (!empty($meta_row->meta_value)) {
			       			$mmwps_data_unserialize = mmwps_get_serialize_meta($row->ID, 'mmwps_data');
							$mmwps_query = $mmwps_data_unserialize['_mmwps_query'];
			       			
		                   	if (!empty($mmwps_query['_type'])) {
		                       $row->_type = $mmwps_query['_type'];
		                    } else {
		                        $row->_type = '';
		                    }
		                   	if (!empty($mmwps_query['_by_date'])) {
		                       $row->_by_date = $mmwps_query['_by_date'];
		                    } else {
		                        $row->_by_date = '';
		                    }
		                   	if (!empty($mmwps_query['_orderby'])) {
		                       $row->_orderby = $mmwps_query['_orderby'];
		                    } else {
		                        $row->_orderby = '';
		                    }
		                   	if (!empty($mmwps_query['_order'])) {
		                       $row->_order = $mmwps_query['_order'];
		                    } else {
		                        $row->_order = '';
		                    }
		                   	if (!empty($mmwps_query['_sticky'])) {
		                       $row->_sticky = $mmwps_query['_sticky'];
		                    } else {
		                        $row->_sticky = '';
		                    }
		                   	if (!empty($mmwps_query['_limit'])) {
		                       $row->_limit = $mmwps_query['_limit'];
		                    } else {
		                        $row->_limit = '';
		                    }
		                   	if (!empty($mmwps_query['_status'])) {
		                       $row->_status = $mmwps_query['_status'];
		                    } else {
		                        $row->_status = '';
		                    }
		                   	if (!empty($mmwps_query['_by_manual'])) {
		                       $row->_by_manual = $mmwps_query['_by_manual'];
		                    } else {
		                        $row->_by_manual = '';
		                    }
	                	}
	                }
		       		if (!empty($meta_row) && $meta_row->meta_key == 'mmwps_data') {
		       			if (!empty($meta_row->meta_value)) {
			       			$mmwps_data_unserialize = mmwps_get_serialize_meta($row->ID, 'mmwps_data');
							$mmwps_layout = $mmwps_data_unserialize['_mmwps_layout'];
		                   	if (!empty($mmwps_layout['_skin'])) {
		                       $row->_skin = $mmwps_layout['_skin'];
		                    } else {
		                        $row->_skin = '';
		                    }
		                   	if (!empty($mmwps_layout['_column'])) {
		                       $row->_column = $mmwps_layout['_column'];
		                    } else {
		                        $row->_column = '';
		                    }
		                   	if (!empty($mmwps_layout['_thumb_position'])) {
		                       $row->_thumb_position = $mmwps_layout['_thumb_position'];
		                    } else {
		                        $row->_thumb_position = '';
		                    }
		                   	if (!empty($mmwps_layout['_thumb_size'])) {
		                       $row->_thumb_size = $mmwps_layout['_thumb_size'];
		                    } else {
		                        $row->_thumb_size = '';
		                    }
		                   	if (!empty($mmwps_layout['_show_thumb'])) {
		                       $row->_show_thumb = $mmwps_layout['_show_thumb'];
		                    } else {
		                        $row->_show_thumb = '';
		                    }
		                   	if (!empty($mmwps_layout['_thumb_width'])) {
		                       $row->_thumb_width = $mmwps_layout['_thumb_width'];
		                    } else {
		                        $row->_thumb_width = '';
		                    }
		                   	if (!empty($mmwps_layout['_show_title'])) {
		                       $row->_show_title = $mmwps_layout['_show_title'];
		                    } else {
		                        $row->_show_title = '';
		                    }
		                   	if (!empty($mmwps_layout['_title_tag'])) {
		                       $row->_title_tag = $mmwps_layout['_title_tag'];
		                    } else {
		                        $row->_title_tag = '';
		                    }
		                   	if (!empty($mmwps_layout['_show_excerpt'])) {
		                       $row->_show_excerpt = $mmwps_layout['_show_excerpt'];
		                    } else {
		                        $row->_show_excerpt = '';
		                    }
		                   	if (!empty($mmwps_layout['_excerpt_length'])) {
		                       $row->_excerpt_length = $mmwps_layout['_excerpt_length'];
		                    } else {
		                        $row->_excerpt_length = '';
		                    }
		                   	if (!empty($mmwps_layout['_show_read_more'])) {
		                       $row->_show_read_more = $mmwps_layout['_show_read_more'];
		                    } else {
		                        $row->_show_read_more = '';
		                    }
		                   	if (!empty($mmwps_layout['_read_more_text'])) {
		                       $row->_read_more_text = $mmwps_layout['_read_more_text'];
		                    } else {
		                        $row->_read_more_text = '';
		                    }
		                   	if (!empty($mmwps_layout['_navigation'])) {
		                       $row->_navigation = $mmwps_layout['_navigation'];
		                    } else {
		                        $row->_navigation = '';
		                    }
		                   	if (!empty($mmwps_layout['_autoplay'])) {
		                       $row->_autoplay = $mmwps_layout['_autoplay'];
		                    } else {
		                        $row->_autoplay = '';
		                    }
		                   	if (!empty($mmwps_layout['_autoplay_speed'])) {
		                       $row->_autoplay_speed = $mmwps_layout['_autoplay_speed'];
		                    } else {
		                        $row->_autoplay_speed = '';
		                    }
	                	}
	                }
		       		if (!empty($meta_row) && $meta_row->meta_key == 'mmwps_data') {
		       			if (!empty($meta_row->meta_value)) {
			       			$mmwps_data_unserialize = mmwps_get_serialize_meta($row->ID, 'mmwps_data');
							$mmwps_css = $mmwps_data_unserialize['_mmwps_css'];
		                   	if (!empty($mmwps_css['_title_color'])) {
		                       $row->_title_color = $mmwps_css['_title_color'];
		                    } else {
		                        $row->_title_color = '';
		                    }
		                   	if (!empty($mmwps_css['_title_font_size'])) {
		                       $row->_title_size  = $mmwps_css['_title_font_size'];
		                    } else {
		                        $row->_title_size = '';
		                    }
		                   	if (!empty($mmwps_css['_title_unit'])) {
		                       $row->_title_unit  = $mmwps_css['_title_unit'];
		                    } else {
		                        $row->_title_unit = '';
		                    }
		                   	if (!empty($mmwps_css['_excerpt_color'])) {
		                       $row->_excerpt_color  = $mmwps_css['_excerpt_color'];
		                    } else {
		                        $row->_excerpt_color = '';
		                    }
		                   	if (!empty($mmwps_css['_excerpt_font_size'])) {
		                       $row->_excerpt_size = $mmwps_css['_excerpt_font_size'];
		                    } else {
		                        $row->_excerpt_size = '';
		                    }
		                   	if (!empty($mmwps_css['_excerpt_unit'])) {
		                       $row->_excerpt_unit = $mmwps_css['_excerpt_unit'];
		                    } else {
		                        $row->_excerpt_unit = '';
		                    }
		                   	if (!empty($mmwps_css['_item_bg'])) {
		                       $row->_item_bg = $mmwps_css['_item_bg'];
		                    } else {
		                        $row->_item_bg = '';
		                    }
		                   	if (!empty($mmwps_css['_item_margin'])) {
		                       $_item_margin = $mmwps_css['_item_margin'];
		                       $row->_margin_top 	= $_item_margin['_top'];
		                       $row->_margin_right 	= $_item_margin['_right'];
		                       $row->_margin_bottom = $_item_margin['_bottom'];
		                       $row->_margin_left 	= $_item_margin['_left'];
		                    } else {
		                       $row->_margin_top 	= '';
		                       $row->_margin_right 	= '';
		                       $row->_margin_bottom = '';
		                       $row->_margin_left 	= '';
		                    }
		                    if (!empty($mmwps_css['_margin_unit'])) {
		                       $row->_margin_unit = $mmwps_css['_margin_unit'];
		                    } else {
		                        $row->_margin_unit = '';
		                    }
		                   	if (!empty($mmwps_css['_item_padding'])) {
		                       $_item_padding 		 = $mmwps_css['_item_padding'];
		                       $row->_padding_top 	 = $_item_padding['_top'];
		                       $row->_padding_right  = $_item_padding['_right'];
		                       $row->_padding_bottom = $_item_padding['_bottom'];
		                       $row->_padding_left 	 = $_item_padding['_left'];
		                    } else {
		                       $row->_padding_top 	 = '';
		                       $row->_padding_right  = '';
		                       $row->_padding_bottom = '';
		                       $row->_padding_left 	 = '';
		                    }
		                    if (!empty($mmwps_css['_padding_unit'])) {
		                       $row->_padding_unit = $mmwps_css['_padding_unit'];
		                    } else {
		                        $row->_padding_unit = '';
		                    }
	                	}
	                }
		         }
		        }
		        array_push($data, $row);
		      }
		    } 
			return $data;
		}
		/**
		 * Update  Silder Data
		 * @param  string  $post_type  post type <default mmwps>
		 * @return array data
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
		 * Date       : 11.04.2020
		*/
		public static function last_code_update_slider_data($id){
			global $wpdb;
			$data = array();
			$slider_row = $wpdb->get_row(
				$wpdb->prepare(
					"SELECT ID, post_type, post_title, post_date, post_name, post_status, post_author FROM " . mmwps_post_table() . " WHERE post_name = %s ",$id
				),ARRAY_A
			);
			$data['_id']       		= $slider_row['ID']; 
			$data['_post_type']    	= $slider_row['post_type'];
	        $data['_post_type']    	= $slider_row['post_type'];
	        $data['_title']  		= $slider_row['post_title'];
	        $data['_created_at']   	= $slider_row['post_date'];
	       	$data['_slug']   		= $slider_row['post_name'];
	        $data['_slider_status']	= $slider_row['post_status'];
	        $data['_auth_id']     	= $slider_row['post_author'];
	    	$slider_meta = $wpdb->get_results(
	            $wpdb->prepare( "SELECT * FROM ".mmwps_post_meta_table()." WHERE post_id = %d", $slider_row['ID'] )
	          );
	    	if ( isset( $slider_meta ) && count( $slider_meta ) > 0 ){
	    		foreach ($slider_meta as $meta_row) {
	    			if (!empty($meta_row) && $meta_row->meta_key == 'mmwps_data') {
	    				if(!empty($meta_row->meta_value)){
		    				$mmwps_data_unserialize = mmwps_get_serialize_meta($slider_row['ID'], 'mmwps_data');
		    				$mmwps_query = $mmwps_data_unserialize['_mmwps_query'];
		    				if (!empty($mmwps_query['_type'])) {
		                   		$data['_type'] = $mmwps_query['_type'];
		                    } else {
		                       $data['_type'] = '';
		                    }
		                    if (!empty($mmwps_query['_by_date'])) {
		                      $data['_by_date'] = $mmwps_query['_by_date'];
		                    } else {
		                       $data['_by_date'] = '';
		                    }
		                   	if (!empty($mmwps_query['_orderby'])) {
		                      $data['_orderby'] = $mmwps_query['_orderby'];
		                    } else {
		                       $data['_orderby'] = '';
		                    }
		                   	if (!empty($mmwps_query['_order'])) {
		                      $data['_order'] = $mmwps_query['_order'];
		                    } else {
		                       $data['_order'] = '';
		                    }
		                   	if (!empty($mmwps_query['_sticky'])) {
		                      $data['_sticky'] = $mmwps_query['_sticky'];
		                    } else {
		                       $data['_sticky'] = '';
		                    }
		                   	if (!empty($mmwps_query['_limit'])) {
		                      $data['_limit'] = $mmwps_query['_limit'];
		                    } else {
		                       $data['_limit'] = '';
		                    }
		                   	if (!empty($mmwps_query['_status'])) {
		                      $data['_status'] = $mmwps_query['_status'];
		                    } else {
		                       $data['_status'] = '';
		                    }
		                   	if (!empty($mmwps_query['_by_manual'])) {
		                      $data['_by_manual'] = $mmwps_query['_by_manual'];
		                    } else {
		                       $data['_by_manual'] = '';
		                    }
	                	}
	    			}
	    			if (!empty($meta_row) && $meta_row->meta_key == 'mmwps_data') {
	    				if(!empty($meta_row->meta_value)){
			       			$mmwps_data_unserialize = mmwps_get_serialize_meta($slider_row['ID'], 'mmwps_data');
		    				$mmwps_layout = $mmwps_data_unserialize['_mmwps_layout'];
		                   	if (!empty($mmwps_layout['_skin'])) {
		                       $data['_skin'] = $mmwps_layout['_skin'];
		                    } else {
		                        $data['_skin'] = '';
		                    }
		                   	if (!empty($mmwps_layout['_column'])) {
		                       $data['_column'] = $mmwps_layout['_column'];
		                    } else {
		                        $data['_column'] = '';
		                    }
		                   	if (!empty($mmwps_layout['_thumb_position'])) {
		                       $data['_thumb_position'] = $mmwps_layout['_thumb_position'];
		                    } else {
		                        $data['_thumb_position'] = '';
		                    }
		                   	if (!empty($mmwps_layout['_thumb_size'])) {
		                       $data['_thumb_size'] = $mmwps_layout['_thumb_size'];
		                    } else {
		                        $data['_thumb_size'] = '';
		                    }
		                   	if (!empty($mmwps_layout['_show_thumb'])) {
		                       $data['_show_thumb'] = $mmwps_layout['_show_thumb'];
		                    } else {
		                        $data['_show_thumb'] = '';
		                    }
		                   	if (!empty($mmwps_layout['_thumb_width'])) {
		                       $data['_thumb_width'] = $mmwps_layout['_thumb_width'];
		                    } else {
		                        $data['_thumb_width'] = '';
		                    }
		                   	if (!empty($mmwps_layout['_show_title'])) {
		                       $data['_show_title'] = $mmwps_layout['_show_title'];
		                    } else {
		                        $data['_show_title'] = '';
		                    }
		                   	if (!empty($mmwps_layout['_title_tag'])) {
		                       $data['_title_tag'] = $mmwps_layout['_title_tag'];
		                    } else {
		                        $data['_title_tag'] = '';
		                    }
		                   	if (!empty($mmwps_layout['_show_excerpt'])) {
		                       $data['_show_excerpt'] = $mmwps_layout['_show_excerpt'];
		                    } else {
		                        $data['_show_excerpt'] = '';
		                    }
		                   	if (!empty($mmwps_layout['_excerpt_length'])) {
		                       $data['_excerpt_length'] = $mmwps_layout['_excerpt_length'];
		                    } else {
		                        $data['_excerpt_length'] = '';
		                    }
		                   	if (!empty($mmwps_layout['_show_read_more'])) {
		                       $data['_show_read_more'] = $mmwps_layout['_show_read_more'];
		                    } else {
		                        $data['_show_read_more'] = '';
		                    }
		                   	if (!empty($mmwps_layout['_read_more_text'])) {
		                       $data['_read_more_text'] = $mmwps_layout['_read_more_text'];
		                    } else {
		                        $data['_read_more_text'] = '';
		                    }         
		                   	if (!empty($mmwps_layout['_navigation'])) {
		                       $data['_navigation'] = $mmwps_layout['_navigation'];
		                    } else {
		                        $data['_navigation'] = '';
		                    }             
		                   	if (!empty($mmwps_layout['_autoplay'])) {
		                       $data['_autoplay'] = $mmwps_layout['_autoplay'];
		                    } else {
		                        $data['_autoplay'] = '';
		                    }
		                   	if (!empty($mmwps_layout['_autoplay_speed'])) {
		                       $data['_autoplay_speed'] = $mmwps_layout['_autoplay_speed'];
		                    } else {
		                        $data['_autoplay_speed'] = '';
		                    }
	                	}
	            	}
		       		if (!empty($meta_row) && $meta_row->meta_key == 'mmwps_data') {
		       			if(!empty($meta_row->meta_value)){
			       			$mmwps_data_unserialize = mmwps_get_serialize_meta($slider_row['ID'], 'mmwps_data');
		    				$mmwps_css = $mmwps_data_unserialize['_mmwps_css'];
		                   	if (!empty($mmwps_css['_title_color'])) {
		                       $data['_title_color'] = $mmwps_css['_title_color'];
		                    } else {
		                        $data['_title_color'] = '';
		                    }
		                   	if (!empty($mmwps_css['_title_font_size'])) {
		                       $data['_title_size']  = $mmwps_css['_title_font_size'];
		                    } else {
		                        $data['_title_size'] = '';
		                    }
		                   	if (!empty($mmwps_css['_title_unit'])) {
		                       $data['_title_unit']  = $mmwps_css['_title_unit'];
		                    } else {
		                        $data['_title_unit'] = '';
		                    }
		                   	if (!empty($mmwps_css['_excerpt_color'])) {
		                       $data['_excerpt_color']  = $mmwps_css['_excerpt_color'];
		                    } else {
		                        $data['_excerpt_color'] = '';
		                    }
		                   	if (!empty($mmwps_css['_excerpt_font_size'])) {
		                       $data['_excerpt_size'] = $mmwps_css['_excerpt_font_size'];
		                    } else {
		                        $data['_excerpt_size'] = '';
		                    }
		                   	if (!empty($mmwps_css['_excerpt_unit'])) {
		                       $data['_excerpt_unit'] = $mmwps_css['_excerpt_unit'];
		                    } else {
		                        $data['_excerpt_unit'] = '';
		                    }
		                   	if (!empty($mmwps_css['_item_bg'])) {
		                       $data['_item_bg'] = $mmwps_css['_item_bg'];
		                    } else {
		                        $data['_item_bg'] = '';
		                    }
		                   	if (!empty($mmwps_css['_item_margin'])) {
		                       $_item_margin = $mmwps_css['_item_margin'];
		                       $data['_margin_top'] 	= $_item_margin['_top'];
		                       $data['_margin_right'] 	= $_item_margin['_right'];
		                       $data['_margin_bottom'] = $_item_margin['_bottom'];
		                       $data['_margin_left'] 	= $_item_margin['_left'];
		                    } else {
		                       $data['_margin_top'] 	= '';
		                       $data['_margin_right'] 	= '';
		                       $data['_margin_bottom'] = '';
		                       $data['_margin_left'] 	= '';
		                    }
		                    if (!empty($mmwps_css['_margin_unit'])) {
		                       $data['_margin_unit'] = $mmwps_css['_margin_unit'];
		                    } else {
		                        $data['_margin_unit'] = '';
		                    }
		                   	if (!empty($mmwps_css['_item_padding'])) {
		                       $_item_padding 		 = $mmwps_css['_item_padding'];
		                       $data['_padding_top'] 	 = $_item_padding['_top'];
		                       $data['_padding_right']  = $_item_padding['_right'];
		                       $data['_padding_bottom'] = $_item_padding['_bottom'];
		                       $data['_padding_left'] 	 = $_item_padding['_left'];
		                    } else {
		                       $data['_padding_top'] 	 = '';
		                       $data['_padding_right']  = '';
		                       $data['_padding_bottom'] = '';
		                       $data['_padding_left'] 	 = '';
		                    }
		                    if (!empty($mmwps_css['_padding_unit'])) {
		                       $data['_padding_unit'] = $mmwps_css['_padding_unit'];
		                    } else {
		                        $data['_padding_unit'] = '';
		                    }
	                	}
	                }
	    		}
	    	}
			return $data;
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
		public static function last_code_set_value($field, $default = '', $html_escape = TRUE){
			isset($value) OR $value = $default;
			return ($html_escape) ? self::last_code_html_escape($value) : $value;
		}
		/**
		 * html_escape
		 * @param  string  $var variable
		 * @param  boolean  $double_encode true/false
		 * @return array data
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
		 * Date       : 14.04.2020
		*/
		public static function last_code_html_escape($var, $double_encode = TRUE){
			if (empty($var))
			{
				return $var;
			}
			if (is_array($var))
			{
				foreach (array_keys($var) as $key)
				{
					$var[$key] = self::html_escape($var[$key], $double_encode);
				}

				return $var;
			}
			return htmlspecialchars($var, ENT_QUOTES, get_bloginfo( 'charset' ), $double_encode);
		}
		/**
		 * clear_textarea_breaks
		 * @param  string  $text text
		 * @return array data
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
		 * Date       : 14.04.2020
		*/
		public static function last_code_clear_textarea_breaks($text){
		    $_text  = '';
		    $_text  = $text;

		    $breaks = array(
		        "<br />",
		        "<br>",
		        "<br/>",
		    );
		    $_text  = str_ireplace($breaks, "", $_text);
		    $_text  = trim($_text);
		    return $_text;
		}
	}
}
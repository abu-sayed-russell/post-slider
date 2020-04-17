<?php
/**
 * @package  PostSlider
 * @developer  name : Abu Sayed Russell
 */
namespace MMWPS\Common;

if (!class_exists('MMWPS_Form_Fields')) {
	
	class MMWPS_Form_Fields{
		
		/**
		 * Render <select> Post Type
		 * @param  string  $label            select label
		 * @param  string  $name             select name
		 * @param  array   $options          option to include array data
		 * @param  string  $selected         default selected value
		 * @param  string  $select_class     additional <select> class
		 * @param  boolean $include_blank    do you want to include the first <option> to be empty
		 * @param  boolean $include_select_picker   bootstrap selectpicker
		 * @return string
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 	     * Date       : 06.04.2020
		*/
		public static function render_post_type($label = 'Label', $name, $selected, $select_class = '', $include_blank = false, $include_select_picker = true){

			$args = array(
                'public'   => true, 
                '_builtin' => false,
                  );
            $custom_post_types = get_post_types( $args );
            $options = array_merge( $custom_post_types, array( 'post' => 'post', 'page' => 'page' , 'by_id' => 'Manual Selection' ) );
			$post = '';
			$select_picker_class = '';
			if (!empty($select_class)) {
		        $select_class = ' ' . $select_class;
		    }
		    if ($include_select_picker == true) {
		        $select_picker_class = ' ' . 'selectpicker';
		    } 
			$post .= '<div class="form-group" app-field-wrapper="'.esc_attr(MMWPS_PREFIX.$name).'">';
	        $post .= '<label for="'.esc_attr(MMWPS_PREFIX.$name).'" class="control-label" data-toggle="tooltip" title="Please choose at least one option">'. esc_html__( $label, 'post-sllider' ) .'</label>';
	        $post .= '<select name="'.esc_attr(MMWPS_PREFIX.$name).'" id="'.esc_attr(MMWPS_PREFIX.$name).'" data-settings="'.esc_attr(MMWPS_PREFIX.$name).'" class="form-control show_posts'. $select_picker_class . $select_class . '">';
	        if ($include_blank == true) {
			        $post .= '<option value=""></option>';
			    }
	        foreach ($options as $_key => $option ):
	        	$_selected = '';
	        	if (!is_array($selected)) {
		            if ($selected != '') {
		                if ($selected == $_key) {
		                    $_selected = ' selected';
		                }
		            }
		        } else {
		            foreach ($selected as $id) {
		                if ($_key == $id) {
		                    $_selected = ' selected';
		                }
		            }
		        }
	        	$post .= '<option id="'.esc_attr($_key).'" value="'.sanitize_text_field($_key).'" '.$_selected.'>' . esc_attr( ucfirst($option) ) . '</option>';
	    	endforeach;  
	        $post .= '</select>';
	        $post .= '</div>';
	        return $post;
		}
		/**
		 * Render <select> Post
		 * @param  string  $label            select label
		 * @param  string  $name             select name
		 * @param  array   $options          option to include array data
		 * @param  string  $selected         default selected value
		 * @param  string  $select_class     additional <select> class
		 * @param  boolean $include_blank    do you want to include the first <option> to be empty
		 * @param  boolean $include_select_picker bootstrap selectpicker
		 * @return string
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 	     * Date       : 06.04.2020
		*/
		public static function render_post($label = 'Label', $name, $selected, $select_class = '', $include_blank = false, $include_select_picker = true){

			$args = array(
                'public'   => true, 
                '_builtin' => false,
                  );
            $custom_post_types = get_post_types( $args );

            $options = array_merge( $custom_post_types, array( 'post' => 'post') );
			global $post;
			$post_list = get_posts( array(
				'post_type'  => $options,
        		'posts_per_page' => -1,
			    'orderby'    => 'menu_order',
			    'sort_order' => 'asc'
			) );
			$post = '';
			$select_picker_class = '';
			if (!empty($select_class)) {
		        $select_class = ' ' . $select_class;
		    }
		    if ($include_select_picker == true) {
		        $select_picker_class = ' ' . 'selectpicker';
		    }
			$post .= '<div class="form-group select_posts" app-field-wrapper="'.esc_attr(MMWPS_PREFIX.$name).'">';
	        $post .= '<label for="'.esc_attr(MMWPS_PREFIX.$name).'" class="control-label" data-toggle="tooltip" title="Please choose at least one option">'. esc_html__( $label, 'post-sllider' ) .'</label>';
	        $post .= '<select name="'.esc_attr($name).'[]" id="'.esc_attr(MMWPS_PREFIX.$name).'" data-settings="'.esc_attr(MMWPS_PREFIX.$name).'" class="form-control'. $select_picker_class . $select_class . '" multiple data-actions-box="true">';
	        if ($include_blank == true) {
			        $post .= '<option value=""></option>';
			    }
	        foreach ($post_list as $_key => $post_item ):
	        	$_selected = '';
	        	if (!is_array($selected)) {
		            if ($selected != '') {
		                if ($selected == $post_item->ID) {
		                    $_selected = ' selected';
		                }
		            }
		        } else {
		            foreach ($selected as $id) {
		                if ($post_item->ID == $id) {
		                    $_selected = ' selected';
		                }
		            }
		        }
	        	$post .= '<option id="'.esc_attr($post_item->ID).'" value="'.sanitize_text_field($post_item->ID).'" '.$_selected.'>' . esc_attr( ucfirst($post_item->post_title) ) . '</option>';
	    	endforeach;  
	        $post .= '</select>';
	        $post .= '</div>';
	        return $post;
		}
		/**
		 * Render Image Size
		 * @param  string  $label            select label
		 * @param  string  $name             select name
		 * @param  array   $options          option to include array data
		 * @param  string  $selected         default selected value
		 * @param  string  $select_class     additional <select> class
		 * @param  boolean $include_blank    do you want to include the first <option> to be empty
		 * @param  boolean $include_select_picker bootstrap selectpicker
		 * @return string
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 	     * Date       : 06.04.2020
		*/
		public static function render_image_size($label = 'Label', $name, $selected, $select_class = '', $include_blank = true, $include_select_picker = false){

			$args = array(
                'public'   => true, 
                '_builtin' => false,
                );
            $options = get_intermediate_image_sizes();
			$post = '';
			$select_picker_class = '';
			if (!empty($select_class)) {
		        $select_class = ' ' . $select_class;
		    }
		    if ($include_select_picker == true) {
		        $select_picker_class = ' ' . 'selectpicker';
		    }
			$post .= '<div class="form-group" app-field-wrapper="'.esc_attr(MMWPS_PREFIX.$name).'">';
	        $post .= '<label for="'. esc_attr(MMWPS_PREFIX.$name) .'" class="control-label" data-toggle="tooltip" title="Please choose at least one option">'. esc_html__( $label, 'post-sllider' ) .'</label>';
	        $post .= '<select name="'. esc_attr(MMWPS_PREFIX.$name) .'" id="'. esc_attr(MMWPS_PREFIX.$name) .'" data-settings="'.esc_attr(MMWPS_PREFIX.$name).'" class="form-control '. $select_picker_class . $select_class . '">';
	        if ($include_blank == true) {
			        $post .= '<option value=""></option>';
			    }
	        foreach ($options as $_key => $option ):
	        	$_selected = '';
	        	if (!is_array($selected)) {
		            if ($selected != '') {
		                if ($selected == $option) {
		                    $_selected = ' selected';
		                }
		            }
		        } else {
		            foreach ($selected as $id) {
		                if ($option == $id) {
		                    $_selected = ' selected';
		                }
		            }
		        }
	        	$post .= '<option id="'.esc_attr($option).'" value="'.sanitize_text_field($option).'" '.$_selected.'>' . esc_attr( ucfirst($option) ) . '</option>';
	    	endforeach;
	        $post .= '</select>';
	        $post .= '</div>';
	        return $post;
		}
		/**
		 * Render <select> field optimized for admin area
		 * @param  string  $label            select label
		 * @param  string  $name             select name
		 * @param  array   $options          option to include array data
		 * @param  string  $selected         default selected value
		 * @param  array   $form_group_attr  <div class="form-group"> div wrapper html attributes
		 * @param  string  $form_group_class <div class="form-group"> additional class
		 * @param  string  $select_class     additional <select> class
		 * @param  boolean $include_blank    do you want to include the first <option> to be empty
		 * @param  boolean $include_select_picker bootstrap select picker
		 * @return string
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 	     * Date       : 06.04.2020
		*/
		public static function render_select($label = 'Label', $name, $options, $selected = '', $form_group_attr = array(), $form_group_class = '', $select_class = '', $include_blank = false, $include_select_picker = true){
			$select = ''; 
			$_form_group_attr = '';
			$select_picker_class = '';

			 $form_group_attr['app-field-wrapper'] = $name;
			    foreach ($form_group_attr as $key => $val) {
			        // tooltips
			        if ($key == 'title') {
			            $val = $val;
			        }
			        $_form_group_attr .= $key . '=' . '"' . $val . '" ';
			    }
			$_form_group_attr = rtrim($_form_group_attr);
			if (!empty($select_class)) {
		        $select_class = ' ' . $select_class;
		    }
		    if ($include_select_picker == true) {
		        $select_picker_class = ' ' . 'selectpicker';
		    }

			if (!empty($form_group_class)) {
		        $form_group_class = ' ' . $form_group_class;
		    }

			$select .= '<div class="select-placeholder form-group' . $form_group_class . '" app-field-wrapper="'.esc_attr(MMWPS_PREFIX.$name).'" ' . $_form_group_attr . '>';
			if ($label != '') {
	        $select .= '<label for="'.esc_attr(MMWPS_PREFIX.$name).'" class="control-label" data-toggle="tooltip" title="Please choose at least one '.$label.'">'. esc_html__( $label, 'post-sllider' ) .'</label>';
	        }
	        $select .= '<select name="'.esc_attr(MMWPS_PREFIX.$name).'" id="'.esc_attr(MMWPS_PREFIX.$name).'" data-settings="'.esc_attr(MMWPS_PREFIX.$name).'" class="form-control '. $select_picker_class . $select_class . '">';
	        	if ($include_blank == true) {
			        $select .= '<option value=""></option>';
			    }
	        foreach ($options as $_key => $option ):
                
                $val       = '';
		        $_selected = '';
		        $key       = '';
		        
		        if (!is_array($selected)) {
		            if ($selected != '') {
		                if ($selected == $_key) {
		                    $_selected = ' selected';
		                }
		            }
		        } else {
		            foreach ($selected as $id) {
		                if ($key == $id) {
		                    $_selected = ' selected';
		                }
		            }
		        }
	        	
	        	$select .= '<option id="'.esc_attr($_key).'" value="'.sanitize_text_field($_key).'" '. $_selected .'>' . esc_attr( $option ) . '</option>';
	    	endforeach;
	        $select .= '</select>';
	        $select .= '</div>';
	        return $select;
		}
		/**
		 * Render <select> field optimized for admin area
		 * @param  string  $label            select label
		 * @param  string  $name             select name
		 * @param  array   $options          option to include array data
		 * @param  string  $selected         default selected value
		 * @return string
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 	     * Date       : 06.04.2020
		*/
		public static function render_checkbox($label = 'Label', $name = 'name', $selected = 1){
			$checked = isset($selected) ? ($selected ? true : false) : false;
			$checkbox = '';
			$checkbox .= '<div class="form-group" app-field-wrapper="'.esc_attr(MMWPS_PREFIX.$name).'">';
			$checkbox .= '<label for="'.esc_attr(MMWPS_PREFIX.$name).'" class="control-label" data-toggle="tooltip" title="Check this option to turn on the '.$label.'">'. esc_html__( $label, 'post-sllider' ) .'</label>';
			$checkbox .= '<div class="onoffswitch">';
			$checkbox .= '<input type="checkbox" id="'.esc_attr(MMWPS_PREFIX.$name).'" class="onoffswitch-checkbox" value="'.sanitize_text_field($selected).'" name="'.esc_attr(MMWPS_PREFIX.$name).'" style="display:none;" ' . esc_attr(( $checked ? 'checked' : '')) . '>';
	        $checkbox .= '<label class="onoffswitch-label" for="'.esc_attr(MMWPS_PREFIX.$name).'" data-toggle="tooltip" title="Check this option to turn on the '.$label.'"></label>';
	        $checkbox .= '</div>';
	        $checkbox .= '</div>';
	        return $checkbox;
		}
		/**
		 * Render <select> field optimized for admin area
		 * @param  string  $label            select label
		 * @param  string  $name             select name
		 * @param  array   $options          option to include array data
		 * @param  string  $value           default selected value
		 * @return string
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 	     * Date       : 06.04.2020
		*/
		public static function render_dimension($label = 'Dimension', $name = 'dimension', $value_top, $value_right, $value_bottom, $value_left, $unit, $placeholder = 0){
			$checked_px = '';
			$checked_per = '';
			$checked_px = $unit == 'px' ? 'checked' : '';
			$checked_per = $unit == '%' ? 'checked' : '';
			$dimension = '';
			$dimension .= '<div class="form-group" app-field-wrapper="'.esc_attr(MMWPS_PREFIX.$name).'">';
			$dimension .= '<label for="'.esc_attr(MMWPS_PREFIX.$name).'" class="control-label">'. esc_html__( $label, 'post-sllider' ) .'</label>';
			$dimension .= '<div class="units-choices">';
			$dimension .= '<input id="'.esc_attr(MMWPS_PREFIX.$name).'_px" type="radio" name="'.esc_attr(MMWPS_PREFIX.$name).'_unit" value="'.sanitize_text_field('px').'" '.$checked_px.'>';
			$dimension .= '<label for="'.esc_attr(MMWPS_PREFIX.$name).'_px">'. esc_html__( 'px', 'post-sllider' ) .'</label>';
			$dimension .= '<input id="'.esc_attr(MMWPS_PREFIX.$name).'_%" type="radio" name="'.esc_attr(MMWPS_PREFIX.$name).'_unit" value="'.sanitize_text_field('%').'" '.$checked_per.'>';
			$dimension .= '<label for="'.esc_attr(MMWPS_PREFIX.$name).'_%">'. esc_html__( '%', 'post-sllider' ) .'</label>';
			$dimension .= '</div>';
			$dimension .= '<div class="dimension-input-wrapper">';
			$dimension .= '<ul>';
			$dimension .= '<li>';
			$dimension .= '<input id="'.esc_attr(MMWPS_PREFIX.$name).'_top" name="'.esc_attr(MMWPS_PREFIX.$name).'_top" value="'.sanitize_text_field($value_top).'" type="number" data-toggle="tooltip" title="Top"class="dimension-control" placeholder="'.esc_attr($placeholder).'">';
			$dimension .= '<label for="'.esc_attr(MMWPS_PREFIX.$name).'_top" class="dimension-label">Top</label>';
			$dimension .= '</li>';
			$dimension .= '<li>';
			$dimension .= '<input id="'.esc_attr(MMWPS_PREFIX.$name).'_right" name="'.esc_attr(MMWPS_PREFIX.$name).'_right" value="'.sanitize_text_field($value_right).'" type="number" data-toggle="tooltip" title="Right"class="dimension-control" placeholder="'.esc_attr($placeholder).'">';
			$dimension .= '<label for="'.esc_attr(MMWPS_PREFIX.$name).'_right" class="dimension-label">Right</label>';
			$dimension .= '</li>';
			$dimension .= '<li>';
			$dimension .= '<input id="'.esc_attr(MMWPS_PREFIX.$name).'_bottom" name="'.esc_attr(MMWPS_PREFIX.$name).'_bottom" value="'.sanitize_text_field($value_bottom).'" type="number" data-toggle="tooltip" title="Bottom"class="dimension-control" placeholder="'.esc_attr($placeholder).'">';
			$dimension .= '<label for="'.esc_attr(MMWPS_PREFIX.$name).'_bottom" class="dimension-label">Bottom</label>';
			$dimension .= '</li>';
			$dimension .= '<li>';
			$dimension .= '<input id="'.esc_attr(MMWPS_PREFIX.$name).'_left" name="'.esc_attr(MMWPS_PREFIX.$name).'_left" value="'.sanitize_text_field($value_left).'" type="number" data-toggle="tooltip" title="Left"class="dimension-control" placeholder="'.esc_attr($placeholder).'">';
			$dimension .= '<label for="'.esc_attr(MMWPS_PREFIX.$name).'_left" class="dimension-label">Left</label>';
			$dimension .= '</li>';
			$dimension .= '</ul>';
	        $dimension .= '</div>';
	        $dimension .= '</div>';
	        return $dimension;
		 }
		 /**
		 * Render <select> field optimized for admin area
		 * @param  string  $label            select label
		 * @param  string  $name             select name
		 * @param  array   $options          option to include array data
		 * @param  string  $value           default selected value
		 * @return string
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 	     * Date       : 06.04.2020
		*/
		public static function render_font_size($label = 'Font Size', $name = 'font_size', $value, $unit, $placeholder = 'Enter Font Size'){
			$checked_px = '';
			$checked_per = '';
			$checked_px = $unit == 'px' ? 'checked' : '';
			$checked_per = $unit == '%' ? 'checked' : '';
			$font_size = '';
			$font_size .= '<div class="form-group" app-field-wrapper="'.esc_attr(MMWPS_PREFIX.$name).'">';
			$font_size .= '<label for="'.esc_attr(MMWPS_PREFIX.$name).'" class="control-label">'. esc_html__( $label, 'post-sllider' ) .'</label>';
			$font_size .= '<div class="units-choices font-units-choices">';
			$font_size .= '<input id="'.esc_attr(MMWPS_PREFIX.$name).'_px" type="radio" name="'.esc_attr(MMWPS_PREFIX.$name).'_unit" value="'.sanitize_text_field('px').'" '.$checked_px.'>';
			$font_size .= '<label for="'.esc_attr(MMWPS_PREFIX.$name).'_px">px</label>';
			$font_size .= '<input id="'.esc_attr(MMWPS_PREFIX.$name).'_%" type="radio" name="'.esc_attr(MMWPS_PREFIX.$name).'_unit" value="'.sanitize_text_field('%').'" '.$checked_per.'>';
			$font_size .= '<label for="'.esc_attr(MMWPS_PREFIX.$name).'_%">%</label>';
			$font_size .= '</div>';
			$font_size .= '<div class="font-size-input-wrapper">';
			$font_size .= '<input id="'.esc_attr(MMWPS_PREFIX.$name).'" name="'.esc_attr(MMWPS_PREFIX.$name).'" value="'.sanitize_text_field($value).'" type="number" data-toggle="tooltip" title="Font Size" class="small-control" placeholder="'.esc_attr($placeholder).'">';
	        $font_size .= '</div>';
	        $font_size .= '</div>';
	        return $font_size;
		 }
		/**
		 * Function that renders input for admin area based on passed arguments
		 * @param  string $name             input name
		 * @param  string $label            label name
		 * @param  string $value            default value
		 * @param  string $type             input type eq text,number
		 * @param  array  $input_attrs      attributes on <input
		 * @param  array  $form_group_attr  <div class="form-group"> html attributes
		 * @param  string $form_group_class additional form group class
		 * @param  string $input_class      additional class on input
		 * @return string
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 	     * Date       : 06.04.2020
		*/
		public static function render_input($label = 'Label', $name, $value = '', $type = 'text', $required = false, $placeholder = 'Enter Text', $input_attrs = array(), $form_group_attr = array(), $form_group_class = '', $input_class = ''){
		    $input            = '';
		    $_form_group_attr = '';
		    $_input_attrs     = '';
		    $_req     = '';
		    $_req_class     = '';
		    $_req_icon     = '';
		    foreach ($input_attrs as $key => $val) {
		        // tooltips
		        if ($key == 'title') {
		            $val = $val;
		        }
		        $_input_attrs .= $key . '=' . '"' . $val . '" ';
		    }

		    $_input_attrs = rtrim($_input_attrs);

		    $form_group_attr['app-field-wrapper'] = $name;

		    foreach ($form_group_attr as $key => $val) {
		        // tooltips
		        if ($key == 'title') {
		            $val = $val;
		        }
		        $_form_group_attr .= $key . '=' . '"' . $val . '" ';
		    }

		    $_form_group_attr = rtrim($_form_group_attr);

		    if (!empty($form_group_class)) {
		        $form_group_class = ' ' . $form_group_class;
		    }
		    if (!empty($input_class)) {
		        $input_class = ' ' . $input_class;
		    }
		    if( $required == true ){
		    	$_req = 'data-required = "true"';
		    	$_req_class = ' ' . 'required';
		    	$_req_icon = '<small>* </small>';
		    }
		
		    $input .= '<div class="form-group' . $form_group_class . '" ' . $_form_group_attr . '>';
		    if ($label != '') {
		        $input .= '<label for="' . MMWPS_PREFIX.$name . '" class="control-label">' . $_req_icon . esc_html__( $label, 'post-sllider' ) . '</label>';
		    }
		    $input .= '<input '.esc_attr($_req).' type="' . esc_attr($type) . '" id="' . esc_attr(MMWPS_PREFIX.$name) . '" name="' . esc_attr( MMWPS_PREFIX.$name ) . '" class="form-control' . $input_class . $_req_class .'" ' . $_input_attrs . ' value="' . sanitize_text_field( $value ) . '" placeholder="'. esc_attr( $placeholder ) .'">';
		    $input .= '</div>';

		    echo $input;
		}
		/**
		 * Render textarea for admin area
		 * @param  [type] $name             textarea name
		 * @param  string $label            textarea label
		 * @param  string $value            default value
		 * @param  array  $textarea_attrs      textarea attributes
		 * @param  array  $form_group_attr  <div class="form-group"> div wrapper html attributes
		 * @param  string $form_group_class form group div wrapper additional class
		 * @param  string $textarea_class      <textarea> additional class
		 * @return string
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 	     * Date       : 06.04.2020
		 */
		public static function render_textarea($label = 'Textarea', $name, $value = '', $textarea_attrs = array(), $form_group_attr = array(), $form_group_class = '', $textarea_class = '')
		{
		    $textarea         = '';
		    $_form_group_attr = '';
		    $_textarea_attrs  = '';
		    if (!isset($textarea_attrs['rows'])) {
		        $textarea_attrs['rows'] = 4;
		    }

		    if (isset($textarea_attrs['class'])) {
		        $textarea_class .= ' '. $textarea_attrs['class'];
		        unset($textarea_attrs['class']);
		    }

		    foreach ($textarea_attrs as $key => $val) {
		        // tooltips
		        if ($key == 'title') {
		            $val = $val;
		        }
		        $_textarea_attrs .= $key . '=' . '"' . $val . '" ';
		    }

		    $_textarea_attrs = rtrim($_textarea_attrs);

		    $form_group_attr['app-field-wrapper'] = $name;

		    foreach ($form_group_attr as $key => $val) {
		        if ($key == 'title') {
		            $val = $val;
		        }
		        $_form_group_attr .= $key . '=' . '"' . $val . '" ';
		    }

		    $_form_group_attr = rtrim($_form_group_attr);

		    if (!empty($textarea_class)) {
		        $textarea_class = trim($textarea_class);
		        $textarea_class = ' ' . $textarea_class;
		    }
		    if (!empty($form_group_class)) {
		        $form_group_class = ' ' . $form_group_class;
		    }
		    $textarea .= '<div class="form-group' . $form_group_class . '" ' . $_form_group_attr . '>';
		    if ($label != '') {
		        $textarea .= '<label for="' . esc_attr( MMWPS_PREFIX.$name ) . '" class="control-label">' . esc_html__( $label, 'post-sllider' ) . '</label>';
		    }

		    $v = mmwps_clear_textarea_breaks($value);
		    if (strpos($textarea_class, 'tinymce') !== false) {
		        $v = $value;
		    }
		    $textarea .= '<textarea id="' . esc_attr( MMWPS_PREFIX.$name ) . '" name="' . esc_attr( MMWPS_PREFIX.$name ) . '" class="form-control' . $textarea_class . '" ' . $_textarea_attrs . '>' . esc_textarea( mmwps_set_value(MMWPS_PREFIX.$name, $v) ) . '</textarea>';
		    $textarea .= '</div>';

		    return $textarea;
		}

		/**
		 * For more readable code created this function to render only yes or not values for settings
		 * @param  string $option_value option from database to compare
		 * @param  string $label        input label
		 * @param  string $tooltip      tooltip
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 	     * Date       : 06.04.2020
		 */
		public static function render_yes_no_option($label = "Enable Option", $option_value, $value = 1, $tooltip = '', $replace_yes_text = '', $replace_no_text = '', $replace_1 = '', $replace_0 = ''){
		    ob_start(); ?>
		    <div class="form-group yes_no_radio">
		        <label for="<?php echo $option_value; ?>" class="control-label clearfix">
		            <?php echo($tooltip != '' ? '<i class="fa fa-question-circle" data-toggle="tooltip" data-title="'. $tooltip .'"></i> ': '') . esc_html__( $label, 'post-sllider' ); ?>
		        </label>
		        <div class="radio radio-primary radio-inline">
		            <input type="radio" id="y_opt_1_<?php echo strtolower(str_replace(' ', '_', $label)); ?>" name="<?php echo MMWPS_PREFIX.$option_value; ?>" value="<?php echo $replace_1 == '' ? 1 : $replace_1; ?>" <?php if ( $value == ($replace_1 == '' ? '1' : $replace_1)) {
			        echo 'checked';
			    } ?>>
		            <label for="y_opt_1_<?php echo strtolower(str_replace(' ', '_', $label)); ?>">
		                <?php echo $replace_yes_text == '' ? 'yes' : $replace_yes_text; ?>
		            </label>
		        </div>
		        <div class="radio radio-primary radio-inline">
		                <input type="radio" id="y_opt_2_<?php echo strtolower(str_replace(' ', '_', $label)); ?>" name="<?php echo MMWPS_PREFIX.$option_value; ?>" value="<?php echo $replace_0 == '' ? 0 : $replace_0; ?>" <?php if ($value == ($replace_0 == '' ? '0' : $replace_0)) {
				        echo 'checked';
				    } ?>>
		                <label for="y_opt_2_<?php echo strtolower(str_replace(' ', '_', $label)); ?>">
		                    <?php echo $replace_no_text == '' ? 'no' : $replace_no_text; ?>
		                </label>
		        </div>
		    </div>
		    <?php
		    $settings = ob_get_contents();
		    ob_end_clean();
		    echo $settings;
		}

		/**
		 * Helper function for outputting an Alpha Color Picker field.
		 *
		 * @param  string  $class         The class attribute value.
		 * @param  string  $name          The name attribute value.
		 * @param  string  $value         The initial color value.
		 * @param  string  $palette       The palette of colors to include. Supports 'true' for
		 *                                default palette, 'false' for no palette, or a | separated
		 *                                list of colors.
		 * @param  string  $default       The default color value.
		 * @param  string  $show_opacity  Whether to show the opacity number on the slider. Supports
		 *                                'true' or 'false'.
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 	     * Date       : 06.04.2020
		 */

		public static function render_color_picker($label = '', $name, $value, $palette = true, $default, $show_opacity = true){
		    $picker = '';
		    $picker .= '<div class="form-group mmwps-color " app-field-wrapper="'. esc_attr(MMWPS_PREFIX.$name).'">';
		    $picker .= '<label for="' .  esc_attr(MMWPS_PREFIX.$name) . '" class="control-label">' . esc_html__( $label, 'post-sllider' ) . '</label>';
		    $picker .= '<div class="input-group mbot15 colorpicker-input">
		    <input type="text" class="form-control mmwps-color-picker" name="'. esc_attr(MMWPS_PREFIX.$name).'" value="'. sanitize_text_field($value) .'" data-palette="'.esc_attr($palette).'" data-default-color="'.esc_attr($default).'" data-show-opacity="'.esc_attr($show_opacity).'" />
			</div>';
		    $picker .= '</div>';
		    return $picker;
		}

		/**
		 * Helper function for outputting an Alpha Color Picker field.
		 *
		 * @param  string  $class         The class attribute value.
		 * @param  string  $name          The name attribute value.
		 * @param  string  $value         The initial color value.
		 * @param  string  $palette       The palette of colors to include. Supports 'true' for
		 *                                default palette, 'false' for no palette, or a | separated
		 *                                list of colors.
		 * @param  string  $default       The default color value.
		 * @param  string  $show_opacity  Whether to show the opacity number on the slider. Supports
		 *                                'true' or 'false'.
		 * Feature added by : Abu Sayed Russell abusayedrussell@gmail.com
 	     * Date       : 06.04.2020
		 */

		public static function render_silderui($label = '', $name, $value, $min = '', $max = '', $step = '1' ){
		    $silderui = '';
		    $silderui .= '<div class="form-group mmwps-sliderui" app-field-wrapper="'. esc_attr(MMWPS_PREFIX.$name).'">';
		    $silderui .= '<label for="' .  esc_attr(MMWPS_PREFIX.$name) . '" class="control-label">' . esc_html__( $label, 'post-sllider' ) . '</label>';
			$data = 'data-id="'.MMWPS_PREFIX.$name.'" data-val="'.$value.'" data-min="'.$min.'" data-max="'.$max.'" data-step="'.$step.'"';
			$silderui .= '<div id="'.MMWPS_PREFIX.$name.'-slider" class="mmwps_sliderui" '. $data .'></div>';
		    $silderui .= '<input type="text" name="'.MMWPS_PREFIX.$name.'" id="'.MMWPS_PREFIX.$name.'" value="'. sanitize_text_field($value) .'" class="mini" />';

		    $silderui .= '</div>';

		    return $silderui;
		}
	}
}
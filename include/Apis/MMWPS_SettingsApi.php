<?php 
/**
 * @package  PostSlider
 */
namespace MMWPS\Apis;

if (!class_exists('MMWPS_SettingsApi')) {

	class MMWPS_SettingsApi
	{
		public $mmwps_admin_pages = array();

		public $mmwps_admin_subpages = array();

		public $mmwps_settings = array();

		public $mmwps_sections = array();

		public $mmwps_fields = array();

	   	public function mmwps_register()
	    {
	        if ( ! empty($this->mmwps_admin_pages) || ! empty($this->mmwps_admin_subpages) ) {
				add_action( 'admin_menu', array( $this, 'mmwps_admin_menu' ) );
			}

			if ( !empty($this->mmwps_settings) ) {
				add_action( 'admin_init', array( $this, 'mmwps_register_custom_filed' ) );
			}
	    }

	    public function mmwps_admin_pages(array $pages)
	    {
	    	$this->mmwps_admin_pages = $pages;

	    	return $this;
	    }
         
	    public function mmwps_with_sub_pages( string $title = null )
	    {
	    	if ( empty( $this->mmwps_admin_pages ) ) {
	    		return $this;
	    	}
	    	$mmwps_admin_page = $this->mmwps_admin_pages[0];

	    	$mmmwps_subpage = array(
	    		array(
	    			'parent_slug' => $mmwps_admin_page['menu_slug'],
	    			'page_title' => $mmwps_admin_page['page_title'],
	    			'menu_title' => ($title) ? $title : $mmwps_admin_page['menu_title'],
	    			'capability' => $mmwps_admin_page['capability'],
	    			'menu_slug' => $mmwps_admin_page['menu_slug'],
	    			'callback' => $mmwps_admin_page['callback']
	    		)
	    	);
	    	$this->mmwps_admin_subpages = $mmmwps_subpage;
	    	return $this;
	    }
	    public function mmwps_admin_subpages( array $pages )
	    {
	    	$this->mmwps_admin_subpages = $pages;
	    	return $this;    
	    }
	    public function mmwps_admin_menu()
	    {
	    	//Parent Menu
	    	foreach ($this->mmwps_admin_pages as $page) {
	    		add_menu_page( $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position'] );
	    	}
	    	//Child Menu
	    	foreach ( $this->mmwps_admin_subpages as $page ) {
				add_submenu_page( $page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'] );
			}    
	    }

	    public function mmwps_set_settings( array $settings )
	    {
	    	 $this->mmwps_settings = $settings;
	    	 return $this;    
	    }

	    public function mmwps_set_sections( array $sections )
	    {
	    	$this->mmwps_sections = $sections;
	    	return $this;
	    }
	    
	    public function mmwps_set_fields( array $fields )
	    {
	    	$this->mmwps_fields = $fields;
	    	return $this;
	    }

	    public function mmwps_register_custom_filed()
	    {
	    	// register setting
	    	foreach ( $this->mmwps_settings as $setting ) {
			register_setting( $setting["option_group"], $setting["option_name"], ( isset( $setting["callback"] ) ? $setting["callback"] : '' ) );
		}

		// add MMWPS_settings section
		foreach ( $this->mmwps_sections as $section ) {
			add_settings_section( $section["id"], $section["title"], ( isset( $section["callback"] ) ? $section["callback"] : '' ), $section["page"] );
		}

		// add MMWPS_settings field
		foreach ( $this->mmwps_fields as $field ) {
			add_settings_field( $field["id"], $field["title"], ( isset( $field["callback"] ) ? $field["callback"] : '' ), $field["page"], $field["section"], ( isset( $field["args"] ) ? $field["args"] : '' ) );
			}
	    }
	    
	}
}
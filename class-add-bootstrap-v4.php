<?php
/*
 * Plugin Name: Add Bootstrap v4
 * Plugin URI: http://antoniomadera.com
 * Version: 1.0
 * Description: This plugin adds bootstrap version 4 to your Wordpress installation
 * Author: Antonio Madera
 * Author URI: http://antoniomadera.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

class Add_Bootstrap_4 {
	
	private static $css_option_value = 'external_css_file';
	private static $plugin_options_group_value = 'add-bootstrap-css-library';
	private static $submenu_name = 'CSS Bootstrap Library';
	
	private $hook_add_new_file = 'wp_enqueue_scripts';
	private $hook_head_html = 'wp_head';
	private $hook_add_admin_menu_to_dashboard = 'admin_menu';
	private $hook_init = 'init';
	private $css_folder = 'css/';
	private $js_folder = 'js/';
	private $templates_folder = 'templates/';
	private $css_file_name = 'bootstrap.min.css';
	private $js_jquery_file_ame = 'jquery-3.1.1.slim.min.js';
	private $js_tether_file_name = 'tether.min.js';
	private $js_bootstrap_file_name = 'bootstrap.min.js';
	private $menu_page_file = 'options-general.php';
	private $menu_capability = 'manage_options';
	private $menu_slug = 'css-bootstrap-library';
	private $admin_template_file = 'admin-index-template.php';

	public function __construct() {
		$this->run();
	}

	private function run() {
		$this->register_values();
		
		if (is_admin()) {
			$this->add_admin_menu();
		} else {
			$this->add_css_file();
			$this->add_js_files();
		}
	}

	private function add_css_file() {
		if ( get_option( self::$css_option_value ) ) {
			add_action( $this->hook_add_new_file, [ $this, 'get_enqueue_css_file_url' ] );
		} else {
			add_action( $this->hook_head_html, [ $this, 'print_css_content' ] );
		}
	}

	private function add_js_files() {
		add_action( $this->hook_add_new_file, [ $this, 'get_enqueue_js_files_url' ] );
	}

	private function add_admin_menu() {
		add_action( $this->hook_add_admin_menu_to_dashboard, [ $this, 'add_admin_menu_to_dashboard' ] );
	}

	private function register_values() {
		add_action( $this->hook_init, [ $this, 'register_CSS_values' ] );
	}

	public function get_enqueue_css_file_url() {
		$css_url = plugins_url( $this->css_folder . $this->css_file_name, __FILE__ );
		
		wp_enqueue_style( 'bootstrap-css', $css_url );
	}

	public function print_css_content() {
		$file_pathname = plugin_dir_path( __FILE__ ) . $this->css_folder . $this->css_file_name;
		
		echo '<style type="text/css">' . file_get_contents( $file_pathname ) . '</style>';
	}

	public function get_enqueue_js_files_url() {
		$js_jquery_url = plugins_url( $this->js_folder . $this->js_jquery_file_ame, __FILE__ );
		$js_tether_url = plugins_url( $this->js_folder . $this->js_tether_file_name, __FILE__ );
		$js_bootstrap_url = plugins_url( $this->js_folder . $this->js_bootstrap_file_name, __FILE__ );

		wp_enqueue_script( 'jquery-js', $js_jquery_url, [], '', true );
		wp_enqueue_script( 'tether-js', $js_tether_url, [], '', true );
		wp_enqueue_script( 'bootstrap-js', $js_bootstrap_url, [], '', true );
	}

	public function add_admin_menu_to_dashboard() {
		add_submenu_page( $this->menu_page_file, self::$submenu_name, self::$submenu_name, $this->menu_capability, $this->menu_slug, [ $this, 'page_in_menu' ] );
	}

	public function page_in_menu() {
		$file_pathname = plugin_dir_path( __FILE__ ) . $this->templates_folder . $this->admin_template_file;
		
		load_template( $file_pathname );
	}

	public function register_CSS_values() {
		register_setting( self::$plugin_options_group_value, self::$css_option_value );
	}

	public static function get_external_option_name() {
		return self::$css_option_value;
	}

	public static function get_options_group_value() {
		return self::$plugin_options_group_value;
	}

	public static function get_h2_title() {
		return self::$submenu_name . ' Settings';
	}

	public static function get_plugin_name() {
		return 'Add ' . self::$submenu_name . ' plugin';
	}
}

new Add_Bootstrap_4();

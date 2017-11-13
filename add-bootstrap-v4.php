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

class AddBootstrap4 {
    
    private static $cssOptionValue = 'external_css_file';
    private static $pluginOptionsGroupValue = 'add-bootstrap-css-library';
    private static $submenuName = 'CSS Bootstrap Library';
    
    private $hookAddNewFile = 'wp_enqueue_scripts';
    private $hookHeadHtml = 'wp_head';
    private $hookAddAdminMenuToDashboard = 'admin_menu';
    private $hookInit = 'init';
    private $cssFolder = 'css/';
    private $jsFolder = 'js/';
    private $templatesFolder = 'templates/';
    private $cssFileName = 'bootstrap.min.css';
    private $jsJqueryFileName = 'jquery-3.1.1.slim.min.js';
    private $jsTetherFileName = 'tether.min.js';
    private $jsBootstrapFileName = 'bootstrap.min.js';
    private $menuPageFile = 'options-general.php';
    private $menuCapability = 'manage_options';
    private $menuSlug = 'css-bootstrap-library';
    private $adminTemplateFile = 'admin-index.php';

    public function __construct() {
        $this->run();
    }

    private function run() {
        $this->registerValues();
        
        if (is_admin()) {
            $this->addAdminMenu();
        } else {
            $this->addCssFile();
            $this->addJsFiles();
        }
    }

    private function addCssFile() {
        if (get_option(self::$cssOptionValue)) {
            add_action($this->hookAddNewFile, [$this, 'getEnqueueCssFileUrl']);
        } else {
            add_action($this->hookHeadHtml, [$this, 'printCssContent']);
        }
    }

    private function addJsFiles() {
        add_action($this->hookAddNewFile, [$this, 'getEnqueueJsFilesUrl']);
    }

    private function addAdminMenu() {
        add_action($this->hookAddAdminMenuToDashboard, [$this, 'addAdminMenuToDashboard']);
    }

    private function registerValues() {
        add_action($this->hookInit, [$this, 'registerCSSValues']);
    }

    public function getEnqueueCssFileUrl() {
        $cssUrl = plugins_url($this->cssFolder . $this->cssFileName, __FILE__);
        
        wp_enqueue_style('bootstrap-css', $cssUrl);
    }

    public function printCssContent() {
        $filePathname = plugin_dir_path(__FILE__) . $this->cssFolder . $this->cssFileName;
        
        echo '<style type="text/css">' . file_get_contents($filePathname) . '</style>';
    }

    public function getEnqueueJsFilesUrl() {
        $jsJqueryUrl = plugins_url($this->jsFolder . $this->jsJqueryFileName, __FILE__);
        $jsTetherUrl = plugins_url($this->jsFolder . $this->jsTetherFileName, __FILE__);
        $jsBootstrapUrl = plugins_url($this->jsFolder . $this->jsBootstrapFileName, __FILE__);

        wp_enqueue_script('jquery-js', $jsJqueryUrl, [], '', true);
        wp_enqueue_script('tether-js', $jsTetherUrl, [], '', true);
        wp_enqueue_script('bootstrap-js', $jsBootstrapUrl, [], '', true);
    }

    public function addAdminMenuToDashboard() {
        add_submenu_page($this->menuPageFile, self::$submenuName, self::$submenuName, $this->menuCapability, $this->menuSlug, [$this, 'pageInMenu']);
    }

    public function pageInMenu() {
        $filePathname = plugin_dir_path(__FILE__) . $this->templatesFolder . $this->adminTemplateFile;
        
        load_template($filePathname);
    }

    public function registerCSSValues() {
        register_setting(self::$pluginOptionsGroupValue, self::$cssOptionValue);
    }

    public static function getExternalOptionName() {
        return self::$cssOptionValue;
    }

    public static function getOptionsGroupValue() {
        return self::$pluginOptionsGroupValue;
    }

    public static function getH2Title() {
        return self::$submenuName . ' Settings';
    }

    public static function getPluginName() {
        return 'Add ' . self::$submenuName . ' plugin';
    }
}

new AddBootstrap4();

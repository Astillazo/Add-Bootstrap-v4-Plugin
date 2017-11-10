<?php
/*
 * Plugin Name: Add Bootstrap v4
 * Plugin URI: http://antoniomadera.com
 * Version: 0.0.1
 * Description: This plugin adds bootstrap version 4 to your Wordpress installation
 * Author: Antonio Madera
 * Author URI: http://antoniomadera.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

class AddBootstrap4 {
    
    private $hookAddNewFile = 'wp_enqueue_scripts';
    private $cssFolder = 'css/';
    private $jsFolder = 'js/';
    private $cssFileName = 'bootstrap.min.css';
    private $jsJqueryFileName = 'jquery-3.1.1.slim.min.js';
    private $jsTetherFileName = 'tether.min.js';
    private $jsBootstrapFileName = 'bootstrap.min.js';

    public function __construct() {
        $this->run();
    }

    private function run() {
        $this->addCssFile();
        $this->addJsFiles();
    }

    private function addCssFile() {
        add_action($this->hookAddNewFile, [$this, 'getEnqueueCssFileUrl']);
    }

    public function getEnqueueCssFileUrl() {
        $cssUrl = plugins_url($this->cssFolder . $this->cssFileName, __FILE__);
        
        wp_enqueue_style('bootstrap-css', $cssUrl);
    }

    private function addJsFiles() {
        add_action($this->hookAddNewFile, [$this, 'getEnqueueJsFilesUrl']);
    }

    public function getEnqueueJsFilesUrl() {
        $jsJqueryUrl = plugins_url($this->jsFolder . $this->jsJqueryFileName, __FILE__);
        $jsTetherUrl = plugins_url($this->jsFolder . $this->jsTetherFileName, __FILE__);
        $jsBootstrapUrl = plugins_url($this->jsFolder . $this->jsBootstrapFileName, __FILE__);

        wp_enqueue_script('jquery-js', $jsJqueryUrl, [], '', true);
        wp_enqueue_script('tether-js', $jsTetherUrl, [], '', true);
        wp_enqueue_script('bootstrap-js', $jsBootstrapUrl, [], '', true);
    }
}

new AddBootstrap4();

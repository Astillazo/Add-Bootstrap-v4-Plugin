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
    private $cssFileName = 'bootstrap.min.css';

    public function __construct() {
        $this->run();
    }

    private function run() {
        $this->addCssFile();
    }

    private function addCssFile() {
        add_action($this->hookAddNewFile, [$this, 'getEnqueueCssFileUrl']);
    }

    public function getEnqueueCssFileUrl() {
        $cssUrl = plugins_url($this->cssFolder . $this->cssFileName, __FILE__);
        wp_enqueue_style('bootstrap-css', $cssUrl);
    }
}

new AddBootstrap4();

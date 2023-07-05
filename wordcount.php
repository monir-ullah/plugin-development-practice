<?php

/*
Plugin Name: Wordcount
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: Monir Ullah
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
Text Domain: woord-count
Domain Path: /languages
*/

//Load translation

function wordcount_load_plugin_textdomain(){
    load_plugin_textdomain('word-count-plugin-text-domain', FALSE, basename(__FILE__)) . '/languages/';
}
add_action('plugins_loaded', 'wordcount_load_plugin_textdomain');
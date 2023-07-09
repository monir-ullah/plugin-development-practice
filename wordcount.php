<?php

/*
Plugin Name: Post Word Count
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: Monir Ullah
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
Text Domain: word-count
Domain Path: /languages
*/

//Load translation

function wordcount_load_plugin_textdomain(){
    load_plugin_textdomain('word-count', FALSE, basename(__FILE__)) . '/languages/';
}
add_action('plugins_loaded', 'wordcount_load_plugin_textdomain');


function wordcount_cound_word($content){
    $striptags = strip_tags($content);
    $word_count = str_word_count($striptags);
    $label = __('Total Number of Words', 'word-count');
    $label = apply_filters( 'wordcount_heading', $label );
    $tags = apply_filters('wordcount_change_tags', 'h2');
    $content .= sprintf("<%s>%s: %s</%s>",$tags, $label, $word_count, $tags);
    return $content;
}
add_filter( 'the_content', 'wordcount_cound_word' );

function wordcount_heading_change($heading){
    $heading = "Updated Text , Total Word";
    return $heading;
}
add_filter('wordcount_heading', 'wordcount_heading_change');

function wordcount_change_tags_method($tags){
    $tags = wordcount_change_tags_method_normal('h4');
    return $tags;
}
add_filter('wordcount_change_tags', 'wordcount_change_tags_method');

function wordcount_change_tags_method_normal($tags){
    return $tags;
};


function wordcount_reading_time($content){
    $striptags = strip_tags($content);
    $word_count = str_word_count($striptags);

    $label = __('Reading Time', 'word-count');
    $tags = 'h4';
    $reading_minutes = floor($word_count/200);
    $reading_seconds = floor($word_count%200/(200/60));
    $is_visibile = apply_filters( 'wordcount_display_readingtime', 1 );
    if($is_visibile){
        $label = apply_filters( 'wordcount_reading_label_change', $label );
        $tag = apply_filters( 'wordcount_reading_tag_change', 'h4' );
        $content .= sprintf('<%s> %s %s minutes %s seconds </%s>',$tags,$label,$reading_minutes,$reading_seconds,$tags);
    }
   
    return $content;
}

add_filter( 'the_content', 'wordcount_reading_time' );

function plugin_reaidngtime_label($label){
    $label = "From plugin custom Hooks, Reading Time: ";
    return $label;
}
add_filter( 'wordcount_reading_label_change', 'plugin_reaidngtime_label' );
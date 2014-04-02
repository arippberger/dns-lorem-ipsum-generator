<?php
/*
Plugin Name: DNS Ipsum - Due North Studios Lorem Ipsum Generator
Plugin URI: https://github.com/arippberger/dns-lorem-ipsum-generator
Description: Adds lorem ipsum text via the [dns-ipsum] shortcode and a TinyMCE button 
Version: 1.1
Author: arippberger, duenorthstudios
Author URI: http://DueNorthStudios.com
License: GPL2
*/
/*  Copyright 2014  Due North Studios, LLC  (email : alec@duenorthstudios.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if ( !class_exists( 'dns_ipsum_generator' ) ) {
	class dns_ipsum_generator {
		public function __construct() {
			add_action( 'init', array( &$this, 'init' ) );
		} // End __construct()
		public function init() {
			add_filter( 'mce_external_plugins', array( &$this, 'dns_ipsum_add_buttons') );
    		add_filter( 'mce_buttons', array( &$this, 'dns_ipsum_register_buttons') );
			//[dns-ipsum]
			add_shortcode( 'dns-ipsum', array( &$this,'dns_ipsum_func') );
			//* enabel shortcodes in text widgets
			add_filter('widget_text', 'do_shortcode');
		} // End init()
		public function dns_ipsum_add_buttons( $plugin_array ) {
    		$plugin_array['DNSIpsum'] = plugin_dir_url(__FILE__) . 'DNSIpsumTinyMCE.js';
    		return $plugin_array;
		}
		public function dns_ipsum_register_buttons( $buttons ) {
    		array_push( $buttons, 'DNSIpsum' );
    		return $buttons;
		}		
		public function dns_ipsum_func( $atts ){
			extract( shortcode_atts( array(
				'amount' => 5,
				'what' => 'paras',
				'start' => 1
			), $atts ) );
			$lorem_ipsum = '';
			$generated_text = explode("\n", simplexml_load_file("http://www.lipsum.com/feed/xml?amount=$amount&what=$what&start=$start")->lipsum);
			foreach ($generated_text as $paragraph) {
				$lorem_ipsum .= "<p>" . $paragraph . "</p>";
			}
			return $lorem_ipsum;
		}
	} // End Class
}
global $dns_ipsum_generator;
$dns_ipsum_generator = new dns_ipsum_generator();

?>

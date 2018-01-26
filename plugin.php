<?php
/**
 * Hide Unused Shortcodes
 *
 * Keep unused (unregistered) shortcodes from being displayed
 *
 * @package   evermore_hide_ununused_plugins
 * @author    Cliff Seal <cliff@logoscreative.co>
 * @link      https://logoscreative.co
 * @copyright 2018 Logos Creative
 *
 * @wordpress-plugin
 * Plugin Name: Hide Unused Shortcodes
 * Plugin URI:  https://logoscreative.co
 * Description: Keep unused (unregistered) shortcodes from being displayed
 * Version:     1.0.0
 * Author:      Cliff Seal <cliff@logoscreative.co>
 * Author URI:  https://logoscreative.co
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Plugin class.
 *
 * @package evermore_custom_ga
 * @author  Cliff Seal <cliff@evermo.re>
 */
class evermore_hide_ununused_plugins {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @const   string
	 */
	const VERSION = '1.0.0';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Priority 12+ is used because shortcodes are executed at priority 11
		add_filter( 'the_content', array( $this, 'evermore_hide_ununused_plugins_content' ), 12 );

	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Look for unprocessed shortcodes and remove them from post content
	 *
	 * @since     1.0.0
	 *
	 * @return    string    Translated text
	 */
	public function evermore_hide_ununused_plugins_content($content) {

		// From get_shortcode_regex()
		$search_pattern =

			'\\['                              // Opening bracket
			. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
			. "(.*)"                     // 2: Shortcode name
			. '(?![\\w-])'                       // Not followed by word character or hyphen
			. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
			.     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
			.     '(?:'
			.         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
			.         '[^\\]\\/]*'               // Not a closing bracket or forward slash
			.     ')*?'
			. ')'
			. '(?:'
			.     '(\\/)'                        // 4: Self closing tag ...
			.     '\\]'                          // ... and closing bracket
			. '|'
			.     '\\]'                          // Closing bracket
			.     '(?:'
			.         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
			.             '[^\\[]*+'             // Not an opening bracket
			.             '(?:'
			.                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
			.                 '[^\\[]*+'         // Not an opening bracket
			.             ')*+'
			.         ')'
			.         '\\[\\/\\2\\]'             // Closing shortcode tag
			.     ')?'
			. ')'
			. '(\\]?)';                          // 6: Optional second closing bracket for escaping shortcodes: [[tag]]


		return preg_replace( '#' . $search_pattern . '#', '', $content );

	}

}

evermore_hide_ununused_plugins::get_instance();

<?php
/*
	Plugin Name: Set Permalinks
	Author: Andrés Mata Suárez
	Version: 1.0
	Author URI: mailto:amatasuarez@gmail.com
	Description: Set custom posts & pages permalinks.

	Based on:
	 - http://www.introsites.co.uk/33~html-wordpress-permalink-on-pages-plugin.html
	 - http://wordpress.pressible.org/eric/permalink-settings
*/

	 define('DEFAULT_POST_PERMALINKS_STRUCTURE', '');
	 define('DEFAULT_PAGE_PERMALINKS_STRUCTURE', '%pagename%');

	 define('POST_PERMALINKS_STRUCTURE', '/post/%year%/%monthnum%/%day%/%postname%/');
	 define('PAGE_PERMALINKS_STRUCTURE', 'page/%pagename%');

	add_action('init', 'rewrite_page_structure', -1);
	register_activation_hook(__FILE__, 'active');
	register_deactivation_hook(__FILE__, 'deactive');

	function active() {
		// Modify permalinks
		global $wp_rewrite;
    modify_permalinks(POST_PERMALINKS_STRUCTURE, PAGE_PERMALINKS_STRUCTURE);
	}

	function deactive() {
		remove_action('init', 'rewrite_page_structure');
		modify_permalinks(DEFAULT_POST_PERMALINKS_STRUCTURE, DEFAULT_PAGE_PERMALINKS_STRUCTURE);
	}

	function rewrite_page_structure() {
		global $wp_rewrite;
		$wp_rewrite->page_structure = PAGE_PERMALINKS_STRUCTURE;
	}

	function modify_permalinks($permalink_structure, $page_structure){
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		require_once(ABSPATH . 'wp-admin/includes/misc.php');

		global $wp_rewrite;

		# set the structure
		$wp_rewrite->set_permalink_structure($permalink_structure);
		$wp_rewrite->page_structure = $page_structure;

		# get paths
		$home_path = get_home_path();
		$iis7_permalinks = iis7_supports_permalinks();

		# check if there is a file to rewrite
		if ( $iis7_permalinks ) {
			$writable = (!file_exists($home_path . 'web.config') && win_is_writable($home_path));
			$writable = $writable || win_is_writable($home_path . 'web.config');
		} else {
			$writable = (!file_exists($home_path . '.htaccess') && is_writable($home_path));
			$writable = $writable || is_writable($home_path . '.htaccess');
		}

		# flush the rules
		update_option('rewrite_rules', FALSE);
		$wp_rewrite->flush_rules($writable);
	}

?>
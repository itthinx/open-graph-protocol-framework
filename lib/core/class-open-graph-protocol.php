<?php
/**
 * class-open-graph-protocol.php
 *
 * Copyright (c) "kento" Karim Rahimpur www.itthinx.com
 *
 * This code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This header and all notices must be kept intact.
 *
 * @author Karim Rahimpur
 * @package open-graph-protocol
 * @since open-graph-protocol 1.0.0
 */

/**
 * Plugin core class.
 */
class Open_Graph_Protocol {

	/**
	 * Register action hooks.
	 */
	public static function init() {
		register_activation_hook( OPEN_GRAPH_PROTOCOL_FILE,	array( __CLASS__, 'activate' ) );
		register_deactivation_hook( OPEN_GRAPH_PROTOCOL_FILE, array( __CLASS__, 'deactivate' ) );
	}

	/**
	 * Plugin setup on activation.
	 */
	public static function activate( $network_wide = false ) {
		if ( is_multisite() && $network_wide ) {
			$blog_ids = self::get_blogs();
			foreach ( $blog_ids as $blog_id ) {
				switch_to_blog( $blog_id );
				wp_cache_reset();
				self::setup();
				restore_current_blog();
			}
		} else {
			self::setup();
		}
	}

	/**
	 * Triggers clean-up routines.
	 */
	public static function deactivate( $network_wide = false ) {
		if ( is_multisite() && $network_wide ) {
			if ( Open_Graph_Protocol_Options::get_option( 'open_graph_protocol_network_delete_data', false ) ) {
				$blog_ids = self::get_blogs();
				foreach ( $blog_ids as $blog_id ) {
					switch_to_blog( $blog_id );
					wp_cache_reset();
					self::cleanup( true );
					restore_current_blog();
				}
			}
		} else {
			self::cleanup();
		}
	}

	/**
	 * Setup for a new blog.
	 * @param int $blog_id
	 */
	public static function wpmu_new_blog( $blog_id, $user_id ) {
		if ( is_multisite() ) {
			if (self::is_sitewide_plugin() ) {
				switch_to_blog( $blog_id );
				wp_cache_reset();
				self::setup();
				restore_current_blog();
			}
		}
	}

	/**
	 * Clean up for a given blog.
	 *
	 * @param int $blog_id
	 * @param boolean $drop
	 */
	public static function delete_blog( $blog_id, $drop = false ) {
		if ( is_multisite() ) {
			if ( self::is_sitewide_plugin() ) {
				switch_to_blog( $blog_id );
				wp_cache_reset();
				self::cleanup( $drop );
				restore_current_blog();
			}
		}
	}

	/**
	 * Retrieve current blogs' ids.
	 * @return array blog ids
	 */
	public static function get_blogs() {
		global $wpdb;
		$result = array();
		if ( is_multisite() ) {
			$blogs = $wpdb->get_results( $wpdb->prepare(
				"SELECT blog_id FROM $wpdb->blogs WHERE site_id = %d AND archived = '0' AND spam = '0' AND deleted = '0'",
				$wpdb->siteid
			) );
			if ( is_array( $blogs ) ) {
				foreach( $blogs as $blog ) {
					$result[] = $blog->blog_id;
				}
			}
		} else {
			$result[] = get_current_blog_id();
		}
		return $result;
	}

	/**
	 * Determines if the plugin is site-wide.
	 * @return boolean true if site-wide plugin
	 */
	public static function is_sitewide_plugin() {
		$result = false;
		if ( is_multisite() ) {
			$active_sitewide_plugins = get_site_option( 'active_sitewide_plugins', array() );
			$active_sitewide_plugins = array_keys( $active_sitewide_plugins );
			$components = explode( DIRECTORY_SEPARATOR, OPEN_GRAPH_PROTOCOL_FILE );
			$plugin = '';
			$n = count( $components );
			if ( isset( $components[$n - 2] ) ) {
				$plugin .= $components[$n - 2] . DIRECTORY_SEPARATOR;
			}
			$plugin .= $components[$n - 1];
			$result = in_array( $plugin, $active_sitewide_plugins );
		}
		return $result;
	}

	/**
	 * Plugin setup.
	 */
	public static function setup() {
	}

	/**
	 * Cleans up tables & data.
	 *
	 * @param boolean $delete force deletion
	 */
	public static function cleanup( $delete = false ) {
		$delete_data = Open_Graph_Protocol_Options::get_option( 'open_graph_protocol_delete_data', false ) || $delete;
		if ( $delete_data ) {
			Open_Graph_Protocol_Options::flush_options();
		}
	}
}
Open_Graph_Protocol::init();

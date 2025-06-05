<?php
/**
 * class-open-graph-protocol-wpml.php
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
 * @since open-graph-protocol 2.0.0
 */

/**
 * WPML support, metadata.
 */
class Open_Graph_Protocol_WPML {

	/**
	 * Register action hooks.
	 */
	public static function init() {
		add_filter( 'open_graph_protocol_metas', array( __CLASS__, 'open_graph_protocol_metas') );
	}

	/**
	 * Add metadata.
	 */
	public static function open_graph_protocol_metas( $metas ) {

		global $post, $sitepress;
		// $current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		if ( !isset( $post ) ) {
			return $metas;
		}

		$locale = get_locale();

		$languages = array();
		$element_translations = apply_filters( 'wpml_get_element_translations', null, $post->ID );
		if ( is_array( $element_translations ) ) {
			$languages = array_keys( $element_translations );
		}

		//
		// og:locale:alternate - An array of other locales this page is available in.
		//
		if ( isset( $sitepress ) && method_exists( $sitepress, 'get_locale_file_names') ) {
			$locales = $sitepress->get_locale_file_names();
			foreach( $locales as $code => $wpml_locale ) {
				if ( in_array( $code, $languages ) ) {
					if ( is_string( $wpml_locale ) && strlen( $wpml_locale ) > 0 && $wpml_locale !== $locale ) {
						$metas['og:locale:alternate'][] = $wpml_locale;
					}
				}
			}
		}

		return $metas;
	}

}
Open_Graph_Protocol_WPML::init();

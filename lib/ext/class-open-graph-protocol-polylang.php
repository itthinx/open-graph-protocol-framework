<?php
/**
 * class-open-graph-protocol-polylang.php
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
 * Polylang support, metadata.
 */
class Open_Graph_Protocol_Polylang {

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

		global $post;
		$current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		$locale = get_locale();

		//
		// og:locale:alternate - An array of other locales this page is available in.
		//
		if ( function_exists( 'pll_languages_list' ) ) {
			$languages = pll_languages_list();
			if ( is_array( $languages ) && count( $languages ) > 0 ) {
				foreach ( $languages as $language ) {
					if ( is_string( $language ) && strlen( $language ) > 0 && $language !== $locale ) {
						$metas['og:locale:alternate'][] = $language;
					}
				}
			}
		}

		return $metas;
	}

}
Open_Graph_Protocol_Polylang::init();

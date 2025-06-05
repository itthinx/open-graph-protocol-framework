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
		// $current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		$locale = get_locale();

		//
		// og:locale:alternate - An array of other locales this page is available in.
		//
		if ( function_exists( 'pll_languages_list' ) ) {
			$translations = pll_get_post_translations( $post->ID );
			// https://polylang.pro/doc/function-reference/
			$locales = pll_languages_list( array( 'fields' => 'locale' ) );
			if ( is_array( $locales ) && count( $locales ) > 0 ) {
				foreach ( $locales as $_locale ) {
					if ( is_string( $_locale ) && strlen( $_locale ) > 0 && $_locale !== $locale ) {
						$language = array_shift( explode( '_', $_locale ) );
						if ( array_key_exists( $language, $translations ) ) {
							$metas['og:locale:alternate'][] = $_locale;
						}
					}
				}
			}
		}

		return $metas;
	}

}
Open_Graph_Protocol_Polylang::init();

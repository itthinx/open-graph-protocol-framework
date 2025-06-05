<?php
/**
 * class-open-graph-protocol-ext.php
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
 * Extensions support.
 */
class Open_Graph_Protocol_Ext {

	/**
	 * Load supported extensions resources.
	 */
	public static function init() {
		// WPML
		if ( function_exists( 'wpml_get_active_languages' ) ) {
			if ( apply_filters( 'open_graph_protocol_framework_ext', true, 'wpml' ) ) {
				require_once 'class-open-graph-protocol-wpml.php';
			}
		}
		// Polylang
		if ( function_exists( 'pll_current_language' ) ) {
			if ( apply_filters( 'open_graph_protocol_framework_ext', true, 'polylang' ) ) {
				require_once 'class-open-graph-protocol-polylang.php';
			}
		}
		// WooCommerce
		if ( function_exists( 'WC' ) ) {
			if ( apply_filters( 'open_graph_protocol_framework_ext', true, 'woocommerce' ) ) {
				require_once 'class-open-graph-protocol-woocommerce.php';
			}
		}
	}

}
Open_Graph_Protocol_Ext::init();

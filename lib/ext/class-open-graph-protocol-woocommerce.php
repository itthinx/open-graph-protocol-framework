<?php
/**
 * class-open-graph-protocol-woocommerce.php
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
 * WooCommerce support, metadata.
 */
class Open_Graph_Protocol_WooCommerce {

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

		if ( is_singular() ) {
			if ( $post->post_type === 'product' ) {
				if ( class_exists( 'WC_Product' ) ) {
					$product = wc_get_product( $post );
					if ( $product instanceof WC_Product ) {
						$price = wc_get_price_to_display( $product );
						$currency = get_woocommerce_currency();
						$stock_status = $product->get_stock_status();
						$metas['product:price:amount'] = $price;
						$metas['product:price:currency'] = $currency;
						$metas['product:availability'] = $stock_status;
						$stock_status_options = wc_get_product_stock_status_options();
						if ( array_key_exists( $stock_status, $stock_status_options ) ) {
							$metas['product:availability'] = $stock_status_options[$stock_status];
						}
					}
				}
			}
		}

		return $metas;
	}

}
Open_Graph_Protocol_WooCommerce::init();

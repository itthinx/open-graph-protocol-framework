<?php
/**
 * class-open-graph-protocol-helper.php
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
class Open_Graph_Protocol_Helper {

	/**
	 * Returns the current page's title.
	 * @return string page title
	 */
	public static function get_title() {
		// Some themes (e.g. Genesis) mess with that adding a <title> tag
		// where that is not desired.
		global $wp_filter, $merged_filters;
		$wp_title_f0 = isset( $wp_filter['wp_title'] ) ? $wp_filter['wp_title'] : null;
		$wp_title_f1 = isset( $merged_filters['wp_title'] ) ? $merged_filters['wp_title'] : null;
		if ( $wp_title_f0 !== null ) {
			unset( $wp_filter['wp_title'] );
		}
		if ( $wp_title_f1 !== null ) {
			unset( $merged_filters['wp_title'] );
		}
		$title = wp_title( ' ', false, 'right' );
		if ( $wp_title_f0 !== null ) {
			$wp_filter['wp_title'] = $wp_title_f0;
		}
		if ( $wp_title_f1 !== null ) {
			$merged_filters['wp_title'] = $wp_title_f1;
		}
		// whitespace cleanup
		$title = trim( preg_replace('/\s+/', ' ', $title ) );
		return $title;
	}
}

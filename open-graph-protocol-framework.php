<?php
/**
 * Plugin Name: Open Graph Protocol Framework
 * Plugin URI: https://www.itthinx.com/plugins/open-graph-protocol/
 * Description: The Open Graph Protocol enables any web page to become a rich object in a social graph. If you would like to support our work, please visit our <a href="https://www.itthinx.com/shop/">Shop</a>.
 * Version: 1.9.0
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Author: itthinx
 * Author URI: https://www.itthinx.com
 * Donate-Link: https://www.itthinx.com/shop/
 * License: GPLv3
 *
 * Copyright (c) 2012 - 2024 "kento" Karim Rahimpur www.itthinx.com
 *
 * This code is released under the GNU General Public License Version 3.
 * The following additional terms apply to all files as per section
 * "7. Additional Terms." See COPYRIGHT.txt and LICENSE.txt.
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * All legal, copyright and license notices and all author attributions
 * must be preserved in all files and user interfaces.
 *
 * Where modified versions of this material are allowed under the applicable
 * license, modified version must be marked as such and the origin of the
 * modified material must be clearly indicated, including the copyright
 * holder, the author and the date of modification and the origin of the
 * modified material.
 *
 * This material may not be used for publicity purposes and the use of
 * names of licensors and authors of this material for publicity purposes
 * is prohibited.
 *
 * The use of trade names, trademarks or service marks, licensor or author
 * names is prohibited unless granted in writing by their respective owners.
 *
 * Where modified versions of this material are allowed under the applicable
 * license, anyone who conveys this material (or modified versions of it) with
 * contractual assumptions of liability to the recipient, for any liability
 * that these contractual assumptions directly impose on those licensors and
 * authors, is required to fully indemnify the licensors and authors of this
 * material.
 *
 * This header and all notices must be kept intact.
 *
 * @author Karim Rahimpur
 * @package open-graph-protocol
 * @since 1.0.0
 *
 */

/**
 * Plugin version.
 *
 * @var string
 */
define( 'OPEN_GRAPH_PROTOCOL_VERSION', '1.9.0' );

/**
 * Plugin main file.
 *
 * @var string
 */
define( 'OPEN_GRAPH_PROTOCOL_FILE', __FILE__ );

if ( !defined( 'OPEN_GRAPH_PROTOCOL_DEBUG' ) ) {
	/**
	 * Plugin debug mode.
	 *
	 * @var boolean
	 */
	define( 'OPEN_GRAPH_PROTOCOL_DEBUG', false );
}

if ( !defined( 'OPEN_GRAPH_PROTOCOL_CORE_DIR' ) ) {
	/**
	 * Plugin directory.
	 *
	 * @var string
	 */
	define( 'OPEN_GRAPH_PROTOCOL_CORE_DIR', WP_PLUGIN_DIR . '/open-graph-protocol-framework' );
}
if ( !defined( 'OPEN_GRAPH_PROTOCOL_CORE_LIB' ) ) {
	/**
	 * Plugin core directory.
	 *
	 * @var string
	 */
	define( 'OPEN_GRAPH_PROTOCOL_CORE_LIB', OPEN_GRAPH_PROTOCOL_CORE_DIR . '/lib/core' );
}
if ( !defined( 'OPEN_GRAPH_PROTOCOL_ADMIN_LIB' ) ) {
	/**
	 * Plugin admin directory.
	 *
	 * @var string
	 */
	define( 'OPEN_GRAPH_PROTOCOL_ADMIN_LIB', OPEN_GRAPH_PROTOCOL_CORE_DIR . '/lib/admin' );
}
if ( !defined( 'OPEN_GRAPH_PROTOCOL_UTY_LIB' ) ) {
	/**
	 * Plugin utility directory.
	 *
	 * @var string
	 */
	define( 'OPEN_GRAPH_PROTOCOL_UTY_LIB', OPEN_GRAPH_PROTOCOL_CORE_DIR . '/lib/uty' );
}
if ( !defined( 'OPEN_GRAPH_PROTOCOL_CORE_URL' ) ) {
	/**
	 * Plugin core URL.
	 *
	 * @var string
	 */
	define( 'OPEN_GRAPH_PROTOCOL_CORE_URL', WP_PLUGIN_URL . '/open-graph-protocol-framework' );
}
if ( !defined( 'OPEN_GRAPH_PROTOCOL_PLUGIN_URL' ) ) {
	/**
	 * Plugin URL.
	 *
	 * @var string
	 */
	define( 'OPEN_GRAPH_PROTOCOL_PLUGIN_URL', WP_PLUGIN_URL . '/open-graph-protocol-framework' );
}
if ( !defined( 'OPEN_GRAPH_PROTOCOL_PLUGIN_DOMAIN' ) ) {
	/**
	 * Plugin domain.
	 *
	 * @var string
	 */
	define( 'OPEN_GRAPH_PROTOCOL_PLUGIN_DOMAIN', 'open-graph-protocol-framework' );
}
require_once OPEN_GRAPH_PROTOCOL_CORE_LIB . '/boot.php';

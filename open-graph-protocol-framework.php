<?php
/**
 * open-graph-protocol-framework.php
 *
 * Copyright (c) 2012-2016 "kento" Karim Rahimpur www.itthinx.com
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
 *
 * Plugin Name: Open Graph Protocol
 * Plugin URI: http://www.itthinx.com/plugins/open-graph-protocol
 * Description: The Open Graph Protocol enables any web page to become a rich object in a social graph.
 * Version: 1.1.0
 * Author: itthinx
 * Author URI: http://www.itthinx.com
 * Donate-Link: http://www.itthinx.com
 * License: GPLv3
 */
define( 'OPEN_GRAPH_PROTOCOL_VERSION', '1.1.0' );
define( 'OPEN_GRAPH_PROTOCOL_FILE', __FILE__ );

if ( !defined( 'OPEN_GRAPH_PROTOCOL_CORE_DIR' ) ) {
	define( 'OPEN_GRAPH_PROTOCOL_CORE_DIR', WP_PLUGIN_DIR . '/open-graph-protocol-framework' );
}
if ( !defined( 'OPEN_GRAPH_PROTOCOL_CORE_LIB' ) ) {
	define( 'OPEN_GRAPH_PROTOCOL_CORE_LIB', OPEN_GRAPH_PROTOCOL_CORE_DIR . '/lib/core' );
}
if ( !defined( 'OPEN_GRAPH_PROTOCOL_ADMIN_LIB' ) ) {
	define( 'OPEN_GRAPH_PROTOCOL_ADMIN_LIB', OPEN_GRAPH_PROTOCOL_CORE_DIR . '/lib/admin' );
}
if ( !defined( 'OPEN_GRAPH_PROTOCOL_UTY_LIB' ) ) {
	define( 'OPEN_GRAPH_PROTOCOL_UTY_LIB', OPEN_GRAPH_PROTOCOL_CORE_DIR . '/lib/uty' );
}
if ( !defined( 'OPEN_GRAPH_PROTOCOL_CORE_URL' ) ) {
	define( 'OPEN_GRAPH_PROTOCOL_CORE_URL', WP_PLUGIN_URL . '/open-graph-protocol-framework' );
}
if ( !defined( 'OPEN_GRAPH_PROTOCOL_PLUGIN_URL' ) ) {
	define( 'OPEN_GRAPH_PROTOCOL_PLUGIN_URL', WP_PLUGIN_URL . '/open-graph-protocol-framework' );
}
if ( !defined( 'OPEN_GRAPH_PROTOCOL_PLUGIN_DOMAIN' ) ) {
	define( 'OPEN_GRAPH_PROTOCOL_PLUGIN_DOMAIN', 'open-graph-protocol-framework' );
}
require_once( OPEN_GRAPH_PROTOCOL_CORE_LIB . '/boot.php' );

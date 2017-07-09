<?php
/**
 * boot.php
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
include_once( OPEN_GRAPH_PROTOCOL_CORE_LIB . '/class-open-graph-protocol-options.php' );
include_once( OPEN_GRAPH_PROTOCOL_CORE_LIB . '/class-open-graph-protocol.php' );
if ( !is_admin() ) {
	include_once( OPEN_GRAPH_PROTOCOL_CORE_LIB . '/class-open-graph-protocol-meta.php' );
}

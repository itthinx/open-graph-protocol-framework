<?php
/**
 * class-open-graph-protocol-meta.php
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
 * Metadata renderer.
 */
class Open_Graph_Protocol_Meta {

	/**
	 * Register action hooks.
	 */
	public static function init() {
		add_action( 'wp_head', array( __CLASS__, 'wp_head') );
	}

	/**
	 * Hooked on wp_head to render meta tags in head.
	 */
	public static function wp_head() {

		global $post, $sitepress;
		$current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		$metas = array();

		//
		// Basic Metadata
		//

		// title
		include_once( OPEN_GRAPH_PROTOCOL_UTY_LIB . '/class-open-graph-protocol-helper.php' );
		$title = Open_Graph_Protocol_Helper::get_title();
		if ( empty( $title ) ) {
			$title = get_bloginfo( 'name' );
		}
		$metas['og:title'] = $title;

		// locale
		$locale = get_locale();
		if ( !empty( $locale ) ) {
			$metas['og:locale'] = $locale;
		}
		// WPML
		if ( isset( $sitepress ) && method_exists( $sitepress, 'get_locale_file_names') ) {
			$locales = $sitepress->get_locale_file_names();
			foreach( $locales as $code => $wpml_locale ) {
				if ( $wpml_locale != $locale ) {
					$metas['og:locale:alternate'][] = $wpml_locale;
				}
			}
		}

		// type
		if ( is_front_page() ) {
			$type = 'website';
		} else if ( is_home() ) {
			$type = 'blog';
		} else {
			$type = 'article';
		}
		$metas['og:type'] = $type;

		// image
		if ( isset( $post->post_type ) && post_type_supports( $post->post_type, 'thumbnail' ) && has_post_thumbnail() ) {
			$attachment_id = get_post_thumbnail_id( $post->ID );
			if ( $attachment_id ) {
				list( $src, $width, $height ) = wp_get_attachment_image_src( $attachment_id, 'full' );
				if ( ! empty( $src ) ) {
					$metas['og:image'] = $src;
					$metas['og:image:url'] = $src;
					$metas['og:image:secure_url'] = str_replace( 'http://', 'https://', $src );
					if ( ! empty( $width ) ) {
						$metas['og:image:width'] = intval( $width );
					}
					if ( ! empty( $height ) ) {
						$metas['og:image:height'] = intval( $height );
					}
					// og:image:alt
					$alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
					if ( !empty( $alt ) ) {
						$metas['og:image:alt'] = $alt;
					} else {
						$caption = wp_get_attachment_caption( $attachment_id );
						if ( !empty( $caption ) ) {
							$metas['og:image:alt'] = $caption;
						} else {
							$attachment_post = get_post( $attachment_id );
							if ( $attachment_post instanceof WP_Post ) {
								$attachment_post_content = $attachment_post->post_content;
								if ( !empty( $attachment_post_content ) ) {
									$metas['og:image:alt'] = $attachment_post_content;
								}
							}
						}
					}
				}
			}
		}

		// url
		$metas['og:url'] = $current_url; // using get_permalink() is wrong here for cases like archive or front page

		//
		// More Metadata
		//

		// site_name
		$metas['og:site_name'] = get_bloginfo( 'name' );

		// description
		$description = '';
		if ( is_singular() ) {
			if ( isset( $post->post_type ) && post_type_supports( $post->post_type, 'excerpt' ) ) {
				if ( !empty( $post->post_excerpt ) ) {
					$description = self::flatten( apply_filters( 'get_the_excerpt', $post->post_excerpt ) );
				}
			}
			if ( empty( $description ) ) {
				$excerpt_length = apply_filters( 'excerpt_length', 55 );
				// This wouldn't be so smart ... for example the default Twenty X
				// themes add a link saying "Continue reading" here which doesn't
				// make sense in the description. Leaving for reference and reminder
				// not to use it.
				// $excerpt_more = apply_filters( 'excerpt_more', ' ' . '[...]' );
				// wp_trim_words() already applies wp_strip_all_tags() but it doesn't
				// compact whitespace.

				// Get the content and apply filters so that shortcodes etc
				// are rendered instead of being displayed as such.
				$content = $post->post_content;
				$content = apply_filters( 'the_content', $content );
				$content = str_replace( ']]>', ']]&gt;', $content );
				$content = self::flatten( $content );
				$description = wp_trim_words( $content, $excerpt_length, ' &hellip;' );
			}
		} else if ( is_home() ) {
			$description = get_bloginfo( 'description' );
			if ( empty( $description ) ) {
				$description = get_bloginfo( 'name' );
			}
		} else {
			$what = '';
			if ( is_author() ) {
				$what = esc_html__( 'Author', OPEN_GRAPH_PROTOCOL_PLUGIN_DOMAIN );
			} else if ( is_archive() ) {
				$what = esc_html__( 'Archive', OPEN_GRAPH_PROTOCOL_PLUGIN_DOMAIN );
			}
			if ( !empty( $what ) ) {
				$description = sprintf( '%s : %s', $what, $title );
			} else {
				$description = $title;
			}
		}
		$metas['og:description'] = $description;

		$metas = apply_filters( 'open_graph_protocol_metas', $metas );

		$m = '';
		foreach( $metas as $property => $content ) {
			$m .= self::render_meta( $property, $content );
		}

		echo apply_filters( 'open_graph_protocol_echo_metas', $m );
	}

	/**
	 * Reduces content to flat text only.
	 *
	 * @param string $content
	 *
	 * @return string
	 */
	private static function flatten( $content ) {
		// Add space between potential adjacent tags so the content
		// isn't glued together after applying wp_strip_all_tags().
		$content = str_replace( '><', '> <', $content );
		$content = wp_strip_all_tags( $content, true );
		$content = preg_replace('/\n+|\t+|\s+/', ' ', $content );
		$content = trim( $content );
		return $content;
	}

	/**
	 * Produces and returns the meta tag.
	 *
	 * @param string $property
	 * @param string $content
	 *
	 * @return string|mixed
	 */
	public static function render_meta( $property, $content ) {
		if ( is_array( $content ) ) {
			$contents = $content;
		} else {
			$contents = array( $content );
		}
		$output = '';
		foreach( $contents as $content ) {
			$output .= apply_filters(
				'open_graph_protocol_meta_tag',
				sprintf(
					'<meta property="%s" content="%s" />%s%s',
					esc_attr( $property ),
					esc_attr(
						apply_filters(
							'open_graph_protocol_meta',
							$content,
							$property
						)
					),
					OPEN_GRAPH_PROTOCOL_DEBUG ? sprintf( '<!-- OGPF %s -->', esc_html( OPEN_GRAPH_PROTOCOL_VERSION ) ) : '',
					apply_filters( 'open_graph_protocol_meta_tag_suffix', "\n" )
				),
				$property,
				$content
			);
		}
		return $output;
	}

}
Open_Graph_Protocol_Meta::init();

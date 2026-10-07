<?php
/**
 * settings.php
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
 * @package open-graph-protocol-framework
 * @since 3.0.0
 */

namespace com\itthinx\ogpf;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin settings.
 */
class Settings {

	/**
	 * Register action handlers.
	 */
	public static function boot() {
		add_action( 'admin_init', array( __CLASS__, 'admin_init' ) );
		add_action( 'admin_menu', array( __CLASS__, 'admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Register settings.
	 */
	public static function admin_init() {
		register_setting(
			'open-graph-protocol-framework',
			'open-graph-protocol-framework-fallback-image-url',
			// 'open-graph-protocol-framework-fallback-image-id',
			array(
				'type' => 'string',
				'description' => 'URL of the fallback image',
				'sanitize_callback' => 'esc_url_raw'
			)
		);
		add_settings_section(
			'open-graph-protocol-framework-settings',
			__( 'Settings', 'open-graph-protocol-framework' ),
			array( __CLASS__, 'settings_section' ),
			'open-graph-protocol-framework'
		);
		add_settings_field(
			'open-graph-protocol-framework-fallback-image-url',
			// 'open-graph-protocol-framework-fallback-image-id',
			__( 'Fallback Image', 'open-graph-protocol-framework' ),
			array( __CLASS__, 'fallback_image' ),
			'open-graph-protocol-framework',
			'open-graph-protocol-framework-settings'
		);
	}

	/**
	 * Register the custom menu.
	 */
	public static function admin_menu() {
		add_menu_page(
			'Open Graph Protocol Framework',
			'OGP',
			'manage_options',
			'open-graph-protocol-framework',
			array( __CLASS__, 'settings_page' ),
			'dashicons-share',
			100
		);
	}

	/**
	 * Add required scripts.
	 *
	 * @param string $hook
	 */
	public static function admin_enqueue_scripts( $hook ) {
		if ( 'toplevel_page_open-graph-protocol-framework' === $hook ) {
			wp_enqueue_media();
		}
	}

	/**
	 * Render the settings section.
	 */
	public static function settings_section() {
		echo '<h2>';
		echo esc_html__( 'Fallback Image', 'open-graph-protocol-framework' );
		echo '</h2>';
		echo '<p class="description" style="font-size:110%;">';
		echo esc_html( 'Here you can choose an image that is used on social networks if no featured image is set for a shared page.', 'open-graph-protocol-framework' );
		echo '</p>';
		echo '<p class="description">';
		echo esc_html( 'This image serves as your site-wide fallback for og:image Open Graph Protocol tags.', 'open-graph-protocol-framework' );
		echo ' ' ;
		echo esc_html( 'It can help to maintain a visually consistent experience on social feeds, even if an author forgets to assign a featured image to a post, page, etc.', 'open-graph-protocol-framework' );
		echo '</p>';
	}

	/**
	 * Render the fallback image field.
	 */
	public static function fallback_image() {

		$fallback_image_url = get_option( 'open-graph-protocol-framework-fallback-image-url' ) ?? '';

// 		$fallback_image_id = get_option( 'open-graph-protocol-framework-fallback-image-id' ) ?? 0;
// 		$fallback_image_url = '';
// 		if ( $fallback_image_id ) {
// 			$fallback_image_url = wp_get_attachment_url( $fallback_image_id );
// 		}

		printf(
			'<input type="url" name="open-graph-protocol-framework-fallback-image-url" id="open-graph-protocol-framework-fallback-image-url" value="%s" class />',
			esc_url( $fallback_image_url )
		);
		printf(
			'<input type="hidden" name="open-graph-protocol-framework-fallback-image-id" id="open-graph-protocol-framework-fallback-image-id" value="%s" />',
			esc_attr( $fallback_image_id )
		);
		printf( '<button type="button" class="button button-secondary" id="open-graph-protocol-framework-fallback-image-url-button">%s</button>',
			esc_html( 'Choose', 'open-graph-protocol-framework' )
		);

		printf(
			'<a href="#" class="submitdelete deletion" id="open-graph-protocol-framework-fallback-image-url-remove" style="margin-left: 10px; vertical-align: middle; text-decoration: none; %1$s">%2$s</a>',
			empty( $fallback_image_url ) ? 'display:none;' : '',
			esc_html( 'Remove', 'open-graph-protocol-framework' )
		);

		printf( '<div id="open-graph-protocol-framework-fallback-image-url-preview-container" style="margin-top: 15px; %s">',
			empty( $fallback_image_url ) ? 'display:none;' : ''
		);
		printf(
			'<img id="open-graph-protocol-framework-fallback-image-url-preview-image" src="%s" style="max-width: 300px; height: auto; border: 1px solid #ccd0d4; padding: 4px; background: #fff;" />',
			esc_url( $fallback_image_url )
		);
		echo '</div>'; // .open-graph-protocol-framework-fallback-image-url-preview-container

		echo '<p class="description">';
		echo esc_html( 'Paste the URL of an image or click to upload or select one from the Media Library.', 'open-graph-protocol-framework' );
		echo '</p>';
	}

	/**
	 * Render the settings page.
	 */
	public static function settings_page() {

		if ( !current_user_can( 'manage_options' ) ) {
			return;
		}

		echo '<div class="wrap">';
		echo '<h1>';
		echo esc_html( get_admin_page_title() );
		echo '</h1>';

		echo '<form method="post" action="options.php">';

		settings_fields( 'open-graph-protocol-framework' );
		do_settings_sections( 'open-graph-protocol-framework' );
		submit_button();

		echo '</form>';

		?>
		<script>
			jQuery(document).ready(function($){
				var custom_uploader;
				$('#open-graph-protocol-framework-fallback-image-url-button').click(function(e) {
				e.preventDefault();
				if (custom_uploader) {
					custom_uploader.open(); return;
				}
				custom_uploader = wp.media({
					title: '<?php echo esc_html__( 'Choose a Fallback Image', 'open-graph-protocol-framework' ) ?>',
					button: { text: '<?php echo esc_html__( 'Choose Image', 'open-graph-protocol-framework' ); ?>' },
					multiple: false
				}).on('select', function() {
					var attachment = custom_uploader.state().get('selection').first().toJSON();
					$('#open-graph-protocol-framework-fallback-image-url').val(attachment.url);
					$('#open-graph-protocol-framework-fallback-image-url-preview-image').attr('src', attachment.url);
					$('#open-graph-protocol-framework-fallback-image-url-preview-container').show();
					$('#open-graph-protocol-framework-fallback-image-url-remove').show();
				});
				custom_uploader.open();
			});

			$('#open-graph-protocol-framework-fallback-image-url-remove').click(function(e) {
				e.preventDefault();
				$('#open-graph-protocol-framework-fallback-image-url').val('');
				$('#open-graph-protocol-framework-fallback-image-url-preview-container').hide();
				$(this).hide();
			});

			$('#open-graph-protocol-framework-fallback-image-url').on('input', function() {
				if ($(this).val() === '') {
					$('#open-graph-protocol-framework-fallback-image-url-preview-container').hide();
					$('#open-graph-protocol-framework-fallback-image-url-remove').hide();
				} else {
					$('#open-graph-protocol-framework-fallback-image-url-remove').show();
				}
			});
		});
	</script>
		<?php
		echo '</div>'; // .wrap
	}

}

Settings::boot();

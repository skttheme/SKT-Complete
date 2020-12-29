<?php
/**
 * SKT Complete Plugin Install Class
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SKT_Complete_Plugin_Install' ) ) :
	/**
	 * SKT Complete plugin install class
	 */
	class SKT_Complete_Plugin_Install {

		/**
		 * Output a button that will install or activate a plugin if it doesn't exist, or display a disabled button if the
		 * plugin is already activated.
		 *
		 * @param string $plugin_slug The plugin slug.
		 * @param string $plugin_file The plugin file.
		 */
		public static function install_plugin_button( $plugin_slug, $plugin_file, $plugin_name, $classes = array(), $activated = '', $activate = '', $install = '' ) {
			if ( current_user_can( 'install_plugins' ) && current_user_can( 'activate_plugins' ) ) {
				if ( is_plugin_active( $plugin_slug . '/' . $plugin_file ) ) {
					// The plugin is already active
					$button = array(
						'message' => esc_attr__( 'Activated', 'skt-complete' ),
						'url'     => '#',
						'classes' => array( 'skt-complete-button', 'disabled' ),
					);

					if ( '' !== $activated ) {
						$button['message'] = esc_attr( $activated );
					}
				} elseif ( $url = self::_is_plugin_installed( $plugin_slug ) ) {					
					// The plugin exists but isn't activated yet.
					$button = array(
						'message' => esc_attr__( 'Activate', 'skt-complete' ),
						'url'     => $url,
						'classes' => array( 'skt-complete-button', 'activate-now' ),
					);

					if ( '' !== $activate ) {
						$button['message'] = esc_attr( $activate );
					}
				} else {
					// The plugin doesn't exist.
					$url = wp_nonce_url( add_query_arg( array(
						'action' => 'install-plugin',
						'plugin' => $plugin_slug,
					), self_admin_url( 'update.php' ) ), 'install-plugin_' . $plugin_slug );
					$button = array(
						'message' => esc_attr__( 'Install now', 'skt-complete' ),
						'url'     => $url,
						'classes' => array( 'skt-complete-button', 'sf-install-now', 'install-now', 'install-' . $plugin_slug ),
					);

					if ( '' !== $install ) {
						$button['message'] = esc_attr( $install );
					}
				}

				if ( ! empty( $classes ) ) {
					$button['classes'] = array_merge( $button['classes'], $classes );
				}

				$button['classes'] = implode( ' ', $button['classes'] );
				?>
				<span class="sf-plugin-card plugin-card-<?php echo esc_html( $plugin_slug ); ?>">
					<a href="<?php echo esc_url( $button['url'] ); ?>" class="<?php echo esc_html( $button['classes'] ); ?>" data-originaltext="<?php echo esc_html( $button['message'] ); ?>" data-name="<?php echo esc_html( $plugin_name ); ?>" data-slug="<?php echo esc_html( $plugin_slug ); ?>" aria-label="<?php echo esc_html( $button['message'] ); ?>"><?php echo esc_html( $button['message'] ); ?></a>
				</span>
				<a href="<?php echo esc_url('https://wordpress.org/plugins/'); echo esc_attr( $plugin_slug ); ?>"><?php esc_html_e( 'Learn more', 'skt-complete' ); ?></a>
				<?php 
			}
		}
		/**
		 * Check if a plugin is installed and return the url to activate it if so.
		 *
		 * @param string $plugin_slug The plugin slug.
		 */
		private static function _is_plugin_installed( $plugin_slug ) {
			if ( file_exists( WP_PLUGIN_DIR . '/' . $plugin_slug ) ) {
				$plugins = get_plugins( '/' . $plugin_slug );
				if ( ! empty( $plugins ) ) {
					$keys        = array_keys( $plugins );
					$plugin_file = $plugin_slug . '/' . $keys[0];
					$url         = wp_nonce_url( add_query_arg( array(
						'action' => 'activate',
						'plugin' => $plugin_file,
					), admin_url( 'plugins.php' ) ), 'activate-plugin_' . $plugin_file );
					return $url;
				}
			}
			return false;
		}
	}

endif;

return new SKT_Complete_Plugin_Install();

<?php
/**
 * SKT Complete admin notify
 *
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

if ( !class_exists( 'SKT_Complete_Notify_Admin' ) ) :

	/**
	 * SKT Complete admin notify
	 */
	class SKT_Complete_Notify_Admin {

		/**
		 * Setup class.
		 *
		 */
		public function __construct() {

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'admin_notices', array( $this, 'admin_notices' ), 99 );
			add_action( 'wp_ajax_skt_complete_dismiss_notice', array( $this, 'dismiss_nux' ) );
			add_action( 'admin_menu', array( $this, 'add_menu' ), 5 );
		}
		/**
		 * Enqueue scripts.
		 *
		 */
		public function enqueue_scripts() {
			global $wp_customize;

			if ( isset( $wp_customize ) || skt_complete_is_extra_activated() ) {
				return;
			}

			wp_enqueue_style( 'skt-complete-admin', get_template_directory_uri() . '/css/admin/admin.css', '', '1' );

			wp_enqueue_script( 'skt-complete-admin', get_template_directory_uri() . '/js/admin/admin.js', array( 'jquery', 'updates' ), '1', 'all' );

			$skt_complete_notify = array(
				'nonce' => wp_create_nonce( 'skt_complete_notice_dismiss' )
			);

			wp_localize_script( 'skt-complete-admin', 'sktcompleteNUX', $skt_complete_notify );
		}

		/**
		 * Output admin notices.
		 *
		 */
		public function admin_notices() {
			global $pagenow;

			if ( ( 'themes.php' === $pagenow ) && isset( $_GET[ 'page' ] ) && ( 'skt-complete' === $_GET[ 'page' ] ) || true === (bool) get_option( 'skt_complete_notify_dismissed' ) || skt_complete_is_extra_activated() ) {
				return;
			}

			if (!is_plugin_active('skt-builder/sktbuilder.php')) {
				echo '<div class="error"><p>'.esc_html('SKT Page Builder plugin is a must required plugin for this theme').'</p></div>';
				}
				
				if (!is_plugin_active('theme-demo-import/theme-demo-import.php')) {
					echo '<div class="error"><p>'.esc_html('Theme Demo Import plugin is a must required plugin for this theme').'</p></div>';
				}	
				
				if (!is_plugin_active('theme-demo-import/theme-demo-import.php') && !is_plugin_active('theme-demo-import/theme-demo-import.php')) {
				echo '<div class="notice mynotice"><p>'.esc_html('Kindly click on Get Started button below to get them installed.').'</p></div>';
				}
				
			?>

<div class="notice notice-info sf-notice-nux is-dismissible"> <span class="sf-icon"> <?php echo '<img src="' . esc_url( get_template_directory_uri() ) . '/images/logo.png" width="250" />'; ?> </span>
  <div class="notice-content">
    <?php if (!is_plugin_active('theme-demo-import/theme-demo-import.php') && !is_plugin_active('theme-demo-import/theme-demo-import.php') && current_user_can( 'install_plugins' ) && current_user_can( 'activate_plugins' ) ) : ?>
    <h2>
      <?php
							/* translators: %s: Theme name */
							printf( esc_html__( 'Thank you for installing %s.', 'skt-complete' ), '<strong>SKT Complete</strong>' );
							?>
    </h2>
    <p> <a href="<?php echo esc_url( admin_url( 'themes.php?page=skt-complete' ) ); ?>" class="button button-primary">
      <?php
								/* translators: %s: Theme name */
								printf( esc_html__( 'Get started with %s', 'skt-complete' ), 'SKT Complete' );
								?>
      </a> </p>
    <?php else : ?>
    <h2><?php echo esc_html('Installation almost done....'); ?></h2>
    <p> <a href="<?php echo esc_url( admin_url( 'themes.php?page=skt-complete' ) ); ?>" class="button button-primary"> <?php echo esc_html('Kindly proceed to next step');?> </a> </p>
    <div class="noticetext"><?php echo esc_html('Note: Kindly close this box if you have already completed above step.');?></div>
    <?php endif; ?>
  </div>
</div>
<?php
		}

		public function add_menu() {
			if ( isset( $wp_customize ) || skt_complete_is_extra_activated() ) {
				return;
			}
			add_theme_page(
			'SKT Complete', 'SKT Complete', 'edit_theme_options', 'skt-complete', array( $this, 'admin_page' )
			);
		}

		public function admin_page() {


			if ( skt_complete_is_extra_activated() ) {
				return;
			}
			?>
<div class="notice notice-info sf-notice-nux"> <span class="sf-icon"> <?php echo '<img src="' . esc_url( get_template_directory_uri() ) . '/images/logo.png" width="250" />'; ?> </span>
  <div class="notice-content">
    <?php if ( !skt_complete_is_extra_activated() && current_user_can( 'install_plugins' ) && current_user_can( 'activate_plugins' ) ) : ?>
    <?php if (!is_plugin_active('theme-demo-import/theme-demo-import.php') && !is_plugin_active('theme-demo-import/theme-demo-import.php')) {?>
    <h2>
      <?php
							/* translators: %s: Theme name */
							printf( esc_html__( 'Thank you for installing %s.', 'skt-complete' ), '<strong>SKT Complete</strong>' );
							?>
    </h2>
    <p>
      <?php
							/* translators: %s: Plugin name string */
							printf( esc_html__( 'To take full advantage of all the features this theme has to offer, please install and activate FIRST the %s plugin.', 'skt-complete' ), '<strong>SKT Page Builder</strong> and then followed by <strong>Theme Demo Import</strong>' );
							?>
    </p>
    <?php } ?>
    <?php if (!is_plugin_active('theme-demo-import/theme-demo-import.php') && !is_plugin_active('theme-demo-import/theme-demo-import.php')) {?>
    <p>
      <?php 
						
						$sktbuilder = array('skt-builder','theme-demo-import');
						$sktbuilder_php = array('sktbuilder.php','theme-demo-import.php');
						$sktbuilder_title = array('SKT Page Builder','Theme Demo Import');
						
						$pluginactivation = array( 
							array (
							   "slug" => 'skt-builder',
							   "url" => 'sktbuilder.php',
							   "title" => 'SKT Page Builder'
							)
						 );
						 
						$pluginactivation1 = array( 
							array (
							   "slug" => 'theme-demo-import',
							   "url" => 'theme-demo-import.php',
							   "title" => 'Theme Demo Import'
							)
						 );		
						 
						$match = array_merge($pluginactivation,$pluginactivation1);		
						 $countloop = count($match);
						$i=0;
												
						while($match){
							
							 if($i==$countloop) break;
							 $slug = $match[$i]['slug'];
							
							$url = $match[$i]['url'];
							$title = $match[$i]['title'];
							
						
						$plugin_title = 'Install '.$title;
						
						SKT_Complete_Plugin_Install::install_plugin_button( $slug, $url, $title, array( 'sf-nux-button' ), __( 'Activated', 'skt-complete' ), __( 'Activate', 'skt-complete' ), $plugin_title, 'skt-complete' ); ?>
    </p>
    <?php $i++; }
					}
					 endif; ?>
    <?php 
					 	if ( is_plugin_active( 'theme-demo-import/theme-demo-import.php' ) ) {
						$main_menu = get_term_by( 'name', 'Header', 'nav_menu' );
						if($main_menu ==""){
							$header_name="";
							}else{
						$header_name = $main_menu->name;}
						if($header_name !="Header"){
					 ?>
    <p><strong><?php echo esc_html('Kindly click on this import demo content button to complete the process.');?></strong></p>
    <a href="<?php echo esc_url( admin_url( 'themes.php?page=theme-demo-import' ) ); ?>" class="goimport"><?php echo esc_html('Import Demo Content');?></a>
    <?php  }else{
					 	?>
						<div class="skt-complete-customizebox">
                        	<h2><?php echo esc_html_e('Links to Customizer Settings','skt-complete');?></h2>
                            <div class="clear"></div>
                            <div class="cust-linkbox">
                            	<ul>
                                	<li><i class="dashicons dashicons-format-image"></i><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=custom_logo' ) ); ?>"><?php echo esc_html_e('Upload Logo','skt-complete');?></a></li>
                                    <li><i class="dashicons dashicons-admin-customizer"></i><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=background_color' ) ); ?>"><?php echo esc_html_e('Color Option','skt-complete');?></a></li>
                                    <li><i class="dashicons dashicons-image-flip-horizontal"></i><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=slider_section' ) ); ?>"><?php echo esc_html_e('Set Slider','skt-complete');?></a></li>
                                    <li><i class="dashicons dashicons-minus"></i><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=header_image' ) ); ?>"><?php echo esc_html_e('Header Image','skt-complete');?></a></li>
                                    <li><i class="dashicons dashicons-archive"></i><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=widgets' ) ); ?>"><?php echo esc_html_e('Manage Footer','skt-complete');?></a></li>
                                    <li><i class="dashicons 
dashicons-menu-alt"></i><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=nav_menus' ) ); ?>"><?php echo esc_html_e('Manage Menus','skt-complete');?></a></li>
                                </ul>
                            </div>
                        </div>
                        <?php
					 	}
					 } ?>
  </div>
</div>
<?php
		}

		/**
		 * AJAX dismiss notice.
		 *
		 * @since 2.2.0
		 */
		public function dismiss_nux() {
			$nonce = !empty( $_POST[ 'nonce' ] ) ? sanitize_text_field( wp_unslash( $_POST[ 'nonce' ] ) ) : false;

			if ( !$nonce || !wp_verify_nonce( $nonce, 'skt_complete_notice_dismiss' ) || !current_user_can( 'manage_options' ) ) {
				die();
			}

			update_option( 'skt_complete_notify_dismissed', true );
		}

	}

	endif;

return new SKT_Complete_Notify_Admin();
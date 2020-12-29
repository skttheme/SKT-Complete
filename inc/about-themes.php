<?php
//about theme info
add_action( 'admin_menu', 'skt_complete_abouttheme' );
function skt_complete_abouttheme() {    	
	add_theme_page( esc_html__('About Theme', 'skt-complete'), esc_html__('About Theme', 'skt-complete'), 'edit_theme_options', 'skt_complete_guide', 'skt_complete_mostrar_guide');   
} 
//guidline for about theme
function skt_complete_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>
<div class="wrapper-info">
	<div class="col-left">
   		   <div class="col-left-area">
			  <?php esc_attr_e('Theme Information', 'skt-complete'); ?>
		   </div>
          <p><?php esc_html_e('SKT Complete is a modern UI UX design SKT Page Builder based template with easy to manage home sections, multilingual, WooCommerce compatible. Industries like services, agencies, companies, business consulting, legal, accounts, finance, interior, architect, portfolio, photographer, web designer, programmer, developer, builder, repair, renovation, creative artists, digital store, shop, it solutions, computer, mobile phones, software, online support. It comes with 1 click demo import. Lightweight, fastest, SEO optimized and RTL compatible. It is multipurpose template and comes with a ready to import Elementor template plugin as add on which allows to import 63+ design templates for making use in home and other inner pages.','skt-complete'); ?></p>
		  <a href="<?php echo esc_url(SKT_COMPLETE_SKTTHEMES_PRO_THEME_URL); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	<div class="col-right">			
			<div class="centerbold">
				<hr />
				<a href="<?php echo esc_url(SKT_COMPLETE_SKTTHEMES_LIVE_DEMO); ?>" target="_blank"><?php esc_html_e('Live Demo', 'skt-complete'); ?></a> | 
				<a href="<?php echo esc_url(SKT_COMPLETE_SKTTHEMES_PRO_THEME_URL); ?>"><?php esc_html_e('Buy Pro', 'skt-complete'); ?></a> | 
				<a href="<?php echo esc_url(SKT_COMPLETE_SKTTHEMES_THEME_DOC); ?>" target="_blank"><?php esc_html_e('Documentation', 'skt-complete'); ?></a>
                <div class="space5"></div>
				<hr />                
                <a href="<?php echo esc_url(SKT_COMPLETE_SKTTHEMES_THEMES); ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>
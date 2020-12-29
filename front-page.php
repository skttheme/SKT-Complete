<?php
/**
 * The template for displaying home page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package SKT Complete
 */
get_header(); 

$hideslide = get_theme_mod('hide_slides', 1);
if (!is_home() && is_front_page()) { 
if( $hideslide == '') { ?>
<!-- Slider Section -->
<?php 
$slidepages = array();
for($sld=7; $sld<10; $sld++) { 
	$mod = absint( get_theme_mod('page-setting'.$sld));
    if ( 'page-none-selected' != $mod ) {
      $slidepages[] = $mod;
    }	
} 
if( !empty($slidepages) ) :
$args = array(
      'posts_per_page' => 3,
      'post_type' => 'page',
      'post__in' => $slidepages,
      'orderby' => 'post__in'
    );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) :	
	$sld = 7;
?>
<section id="home_slider">
  <div class="slider-wrapper theme-default">
    <div id="slider" class="nivoSlider">
		<?php
        $i = 0;
        while ( $query->have_posts() ) : $query->the_post();
          $i++;
          $skt_complete_slideno[] = $i;
          $skt_complete_slidetitle[] = get_the_title();
		  $skt_complete_slidedesc[] = get_the_excerpt();
          $skt_complete_slidelink[] = esc_url(get_permalink());
          ?>
          <img src="<?php the_post_thumbnail_url('full'); ?>" title="#slidecaption<?php echo esc_attr( $i ); ?>" />
          <?php
        $sld++;
        endwhile;
          ?>
    </div>
        <?php
        $k = 0;
        foreach( $skt_complete_slideno as $skt_complete_sln ){ ?>
    <div id="slidecaption<?php echo esc_attr( $skt_complete_sln ); ?>" class="nivo-html-caption">
      <div class="slide_info">
        <h2><?php echo esc_html($skt_complete_slidetitle[$k] ); ?></h2>
        <p><?php echo esc_html($skt_complete_slidedesc[$k] ); ?></p>
        <div class="clear"></div>
        <a class="slide_more" href="<?php echo esc_url($skt_complete_slidelink[$k] ); ?>">
          <?php esc_html_e('Read More', 'skt-complete');?>
          </a>
      </div>
    </div>
 	<?php $k++;
       wp_reset_postdata();
      } ?>
<?php endif; endif; ?>
  </div>
  <div class="clear"></div>
</section>
<?php } } ?>
<div class="clear"></div>
<?php 
	if ( 'posts' == get_option( 'show_on_front' ) ) {
    ?>
    <div class="container">
    <div class="page_content">
    <section class="site-main">
      <div class="blog-post">
        <?php
                    if ( have_posts() ) :
                        // Start the Loop.
                        while ( have_posts() ) : the_post();
                            /*
                             * Include the post format-specific template for the content. If you want to
                             * use this in a child theme, then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */
                            get_template_part( 'content', get_post_format() );
                    
                        endwhile;
                        // Previous/next post navigation.
						the_posts_pagination( array(
							'mid_size' => 2,
							'prev_text' => esc_html__( 'Back', 'skt-complete' ),
							'next_text' => esc_html__( 'Next', 'skt-complete' ),
						) );
                    
                    else :
                        // If no content, include the "No posts found" template.
                         get_template_part( 'no-results', 'index' );
                    
                    endif;
                    ?>
      </div>
      <!-- blog-post --> 
    </section>
    <?php get_sidebar();?>
    </div>
    </div>
    <?php
} else {
    ?>
	<section id="sitefull">
      <div class="blog-post front-page-content">
        <?php
                    if ( have_posts() ) :
                        // Start the Loop.
                        while ( have_posts() ) : the_post();
                            /*
                             * Include the post format-specific template for the content. If you want to
                             * use this in a child theme, then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */
							 ?> 
                            <?php the_content();  
							wp_link_pages( array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'skt-complete' ) . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
							'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'skt-complete' ) . ' </span>%',
							'separator'   => '<span class="screen-reader-text">, </span>',
						) );
							?>
                            <div class="clear"></div>
                            <?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
							comments_template();
							endif;
					
                        	endwhile;
                        // Previous/next post navigation.
						the_posts_pagination( array(
							'mid_size' => 2,
							'prev_text' => esc_html__( 'Back', 'skt-complete' ),
							'next_text' => esc_html__( 'Next', 'skt-complete' ),
						) );
                    
                    else :
                        // If no content, include the "No posts found" template.
                         get_template_part( 'no-results', 'index' );
                    
                    endif;
                    ?>
      </div>
      <!-- blog-post --> 
    </section>
	<?php
}
	?>    
<div class="clear"></div>
<?php get_footer(); ?>
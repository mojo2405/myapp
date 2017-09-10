<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 

// Include framework options
$hgr_options = get_option( 'redux_options' );

get_header();

// Get metaboxes values from database
$hgr_page_bgcolor			=	get_post_meta( get_option( 'woocommerce_shop_page_id' ), '_hgr_page_bgcolor', true );
$hgr_page_top_padding		=	get_post_meta( get_option( 'woocommerce_shop_page_id' ), '_hgr_page_top_padding', true );
$hgr_page_btm_padding		=	get_post_meta( get_option( 'woocommerce_shop_page_id' ), '_hgr_page_btm_padding', true );
$hgr_page_color_scheme		=	get_post_meta( get_option( 'woocommerce_shop_page_id' ), '_hgr_page_color_scheme', true );
$hgr_page_height			=	get_post_meta( get_option( 'woocommerce_shop_page_id' ), '_hgr_page_height', true );
$hgr_page_title				=	get_post_meta( get_option( 'woocommerce_shop_page_id' ), '_hgr_page_title', true );
$hgr_page_title_color		=	get_post_meta( get_option( 'woocommerce_shop_page_id' ), '_hgr_page_title_color', true );
	
$page_title_color			=	( !empty($hgr_page_title_color) ? ' style="color: '.$hgr_page_title_color.'; "' : ( isset($hgr_options['page_title_h1']['color']) && !empty($hgr_options['page_title_h1']['color']) ? '' : ' style="color: #000; "' ) );
	
// Does this page have a featured image to be used as row background with paralax?!
$src = wp_get_attachment_image_src( get_post_thumbnail_id( get_option( 'woocommerce_shop_page_id' ) ), array( 5600,1000 ), false, '' );

if( !empty($src[0]) ) {
	$parallaxImageUrl 	=	" background-image:url('".$src[0]."'); background-size: cover;";
	$backgroundColor	=	'';
} elseif( !empty($hgr_page_bgcolor) ) {
	$parallaxImageUrl 	=	'';
	$backgroundColor	=	' background-color:'.$hgr_page_bgcolor.'!important; ';
} else {
	$parallaxImageUrl 	=	" background-image:url('".trailingslashit( get_template_directory_uri() ) . 'highgrade/images/about-us-page-title.jpg'."'); background-size: cover;";
	$backgroundColor	=	' ';
}

$page_title_top_padding = ( isset($hgr_options['page_title_padding']['padding-top']) ? $hgr_options['page_title_padding']['padding-top'] : '0');
$page_title_btm_padding = ( isset($hgr_options['page_title_padding']['padding-bottom']) ? $hgr_options['page_title_padding']['padding-bottom'] : '0');
$page_title_lft_padding = ( isset($hgr_options['page_title_padding']['padding-left']) ? $hgr_options['page_title_padding']['padding-left'] : '0');
$page_title_rgt_padding = ( isset($hgr_options['page_title_padding']['padding-right']) ? $hgr_options['page_title_padding']['padding-right'] : '0');
$page_offset			= ( isset($hgr_options['page_top_offset']['height']) ? $hgr_options['page_top_offset']['height'] : '0');
	
?>
 

<?php if( class_exists("WooCommerce") && is_cart() && WC()->cart->get_cart_contents_count() == 0 ) : ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; endif; ?>
<?php else : ?>
 

 <div id="shop_page_<?php echo get_option( 'woocommerce_shop_page_id' );?>" class="row standAlonePage <?php echo esc_attr($hgr_page_color_scheme);?>" style=" <?php echo esc_attr($backgroundColor);?> ">
  <div class="vc_col-md-12" <?php echo ( isset($page_offset) && $page_offset	!= 0 ? 'style="margin-top:'.$page_offset	.';"' : '');?> >
 
 
 <?php if( isset($hgr_options['enable_page_title']) && $hgr_options['enable_page_title'] == 1) : ?>
	  <?php if( isset($hgr_page_title) && empty($hgr_page_title) ): ?>
        <div class="page_title_container" style=" <?php echo esc_attr($parallaxImageUrl);?> padding: <?php echo esc_attr($page_title_top_padding);?> <?php echo esc_attr($page_title_rgt_padding);?> <?php echo esc_attr($page_title_btm_padding);?> <?php echo esc_attr($page_title_lft_padding);?>; ">
            <div class="container">
                <h1 class="" <?php echo esc_attr($page_title_color);?> ><?php woocommerce_page_title(); ?></h1>
            </div>
        </div>
      <?php endif;?>
  <?php endif;?>
  
  <div class="container" style=" <?php echo ( !empty($hgr_page_top_padding) ? ' padding-top:'.esc_attr($hgr_page_top_padding).'px!important;' : '' ); echo ( !empty($hgr_page_btm_padding) ? ' padding-bottom:'.esc_attr($hgr_page_btm_padding).'px!important;' : '' );?> ">
    
    
    <!-- products -->
    <?php
	if ( is_active_sidebar( 'shop-widgets' ) ) :
	?>
    <div class="slideContent vc_col-md-9 vc_col-sm-12 vc_col-xs-12" style="float:right;">
    <?php
	else : ?>
    <div class="slideContent vc_col-sm-12">
    <?php endif;?>
    
    	<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>
        
    </div>
    <!-- / products -->
    
    <?php
	if ( is_active_sidebar( 'shop-widgets' ) ) :
	?>
      
    <!-- sidebar -->
    <div class="vc_col-md-3 vc_col-sm-12 vc_col-xs-12" style="float:left;padding-right:20px;">
      <?php 
		dynamic_sidebar('shop-widgets');
	 ?>
    </div>
    <!-- / sidebar -->
    <?php
	endif;
	?>
 </div>
 </div>
 </div>
 
<?php endif; ?>
	
<?php get_footer(); ?>
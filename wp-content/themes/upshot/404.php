 <?php
/**
 * Upshot Theme: 404 error page
 * @package WordPress
 * @subpackage Upshot Theme
 * @since 1.0
 */
 ?>
 
<?php 
	get_header();

 	$hgr_options		=	get_option( 'redux_options' );
 	$custom_error_page	=	(isset($hgr_options['custom_error_page']) ? esc_attr($hgr_options['custom_error_page']) : '');
 ?>
 
 
 <?php
	// Get metaboxes values from database
	$hgr_page_bgcolor			=	get_post_meta( $custom_error_page, '_hgr_page_bgcolor', true );
	$hgr_page_top_padding		=	get_post_meta( $custom_error_page, '_hgr_page_top_padding', true );
	$hgr_page_btm_padding		=	get_post_meta( $custom_error_page, '_hgr_page_btm_padding', true );
	$hgr_page_color_scheme		=	get_post_meta( $custom_error_page, '_hgr_page_color_scheme', true );
	$hgr_page_height			=	get_post_meta( $custom_error_page, '_hgr_page_height', true );
	$hgr_page_title				=	get_post_meta( $custom_error_page, '_hgr_page_title', true );
	$hgr_page_title_color		=	get_post_meta( $custom_error_page, '_hgr_page_title_color', true );
	
	$page_title_color			=	( !empty($hgr_page_title_color) ? ' style="color: '.esc_attr( $hgr_page_title_color ).'; "' : ( isset($hgr_options['page_title_h1']['color']) && !empty($hgr_options['page_title_h1']['color']) ? '' : ' style="color: #000; "' ) );
	
	// Does this page have a featured image to be used as row background with paralax?!
 	$src = wp_get_attachment_image_src( get_post_thumbnail_id($custom_error_page), array( 5600,1000 ), false, '' );

 	if( !empty($src[0]) ) {
		$parallaxImageUrl 	=	" background-image:url('".esc_url($src[0])."'); background-size: cover;";
		$backgroundColor	=	'';
	} elseif( !empty($hgr_page_bgcolor) ) {
		$parallaxImageUrl 	=	'';
		$backgroundColor	=	' background-color:'.esc_attr($hgr_page_bgcolor).'!important; ';
	} else {
		$parallaxImageUrl 	=	" background-image:url('".trailingslashit( get_template_directory_uri() ) . 'highgrade/images/about-us-page-title.jpg'."'); background-size: cover;";
		$backgroundColor	=	' ';
	}
	
	
	$page_title_top_padding = ( isset($hgr_options['page_title_padding']['padding-top']) ? esc_attr( $hgr_options['page_title_padding']['padding-top'] ) : '0');
	$page_title_btm_padding = ( isset($hgr_options['page_title_padding']['padding-bottom']) ? esc_attr( $hgr_options['page_title_padding']['padding-bottom'] ) : '0');
	$page_title_lft_padding = ( isset($hgr_options['page_title_padding']['padding-left']) ? esc_attr( $hgr_options['page_title_padding']['padding-left'] ) : '0');
	$page_title_rgt_padding = ( isset($hgr_options['page_title_padding']['padding-right']) ? esc_attr( $hgr_options['page_title_padding']['padding-right'] ) : '0');
	$page_offset			= ( isset($hgr_options['page_top_offset']['height']) ? esc_attr( $hgr_options['page_top_offset']['height'] ) : '0');
 ?> 
 
<div class="row standAlonePage <?php echo esc_attr($hgr_page_color_scheme);?>" style=" <?php echo esc_attr($backgroundColor);?> ">
  <div class="vc_col-md-12" <?php echo ( isset($page_offset) && $page_offset	!= 0 ? 'style="margin-top:' . $page_offset . ';"' : '');?> >
  
  <?php if( isset($hgr_options['enable_page_title']) && $hgr_options['enable_page_title'] == 1) : ?>
	  <?php if( isset($hgr_page_title) && empty($hgr_page_title) ): ?>
        <div class="page_title_container" style=" <?php echo esc_attr($parallaxImageUrl);?> padding: <?php echo esc_attr($page_title_top_padding);?> <?php echo esc_attr($page_title_rgt_padding);?> <?php echo esc_attr($page_title_btm_padding);?> <?php echo esc_attr($page_title_lft_padding);?>; ">
            <div class="container">
                <h1 class="" <?php echo esc_attr($page_title_color);?> ><?php esc_html_e('404 Error! That page can\'t be found.', 'upshot'); ?></h1>
            </div>
        </div>
      <?php endif;?>
  <?php endif;?>
  
  
    <div class="container" style=" <?php echo ( !empty($hgr_page_top_padding) ? ' padding-top:' . esc_attr( $hgr_page_top_padding ) . 'px!important;' : '' ); echo ( !empty($hgr_page_btm_padding) ? ' padding-bottom:' . esc_attr( $hgr_page_btm_padding ) . 'px!important;' : ' padding-bottom: 150px;' );?> ">
      <div class="slideContent gu12">
        <?php
      	if($custom_error_page){	
			$post = get_post($custom_error_page); 
			$content = apply_filters('the_content', $post->post_content); 
			echo ($content);  
		} else {
      ?>
      
      <h1 class="titleSep" style="text-align: center;"><?php esc_html_e( '404 Error! That page can\'t be found.', 'upshot' );?></h1>
       <p style="text-align: center;margin-top: 35px;margin-bottom: 35px;"><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search? Type and hit Enter to search.', 'upshot'); ?></p>
       <?php get_search_form(); ?>
      <?php
		}
	  ?>
      
      </div>
    </div>
  </div>
</div>

<?php 
 	get_footer();
 ?>
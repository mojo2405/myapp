
<!-- Left Logo -->

<?php
 $hgr_options = get_option( 'redux_options' );
?>

<div id="hgr_top_navbar_container" class="hgr_navbar <?php echo ( !is_front_page() ? '' : ( $hgr_options['header_floating'] == 2 ? 'hidden' : '') ); ?>">
	<?php echo ( isset($hgr_options['menu_bar_width']) && $hgr_options['menu_bar_width'] == 'menu_contained' ? ' <div class="container"> ' : '');?>
    <div class="hgr_identity">
    	<a href="<?php echo esc_url( home_url( '/' ) );?>" title="<?php echo get_bloginfo('name');?>"><?php echo ( !empty($hgr_options['logo']['url']) 
		? '<img src="'.$hgr_options['logo']['url'].'"  alt="'.get_bloginfo('name').'" class="logo responsiveLogo" />' 
		: '<img src="'.esc_url( get_template_directory_uri() ).'/highgrade/images/logo.png"  alt="'.get_bloginfo('name').'" class="logo" />' 
		);?></a>
    </div>
    
    <div id="hgr_top_navbar_extras" class="">
    
    	<?php if( isset($hgr_options['enable_full_screen_search']) && $hgr_options['enable_full_screen_search'] == '1') : ?>
    	<a class="fssearch mobileFsSearch" href="#"><i class="icon fa fa-search"></i></a>
        <?php endif;?>
        <a class="cd-primary-nav-trigger" href="#0"> <span class="cd-menu-icon"></span></a>
        
    	<?php 
			/*
			* Display OR Hide the minicart, depending on woocommerce support enabled or not in Theme Options
			*/
				if( class_exists( 'WooCommerce' ) && !empty($hgr_options['woo_support']) && $hgr_options['woo_support'] == 1 ) :
			?>
		  <!-- woocommerce minicart -->
		  <div class="hgr_woo_minicart sage-cart-icon <?php echo esc_attr($hideonmobile);?>"><span class="helper"></span>
			<div class="woo_bubble"><a class="hgr_woo_minicart_content" href="<?php global $woocommerce; echo esc_url($woocommerce->cart->get_cart_url()); ?>" title="<?php esc_html_e('View your shopping cart', 'weddingz'); ?>">
			<?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'weddingz'), $woocommerce->cart->cart_contents_count);?></a><?php echo ( class_exists('HGR_QCV') ? do_shortcode( '[hgr_quick_cart]' ) : '' );?></div>
		  </div>
		  <!-- end woocommerce minicart -->
		  <?php
			   endif;
		  ?>
    </div>
    
	<?php
        $defaults = array(
            'theme_location'  => 'header-menu',
            'menu'            => 'header-menu',
            'container'       => 'div',
            'container_class' => 'main_navbar_container',
            'container_id'    => 'main_navbar_container',
            'menu_class'      => 'main_navbar',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => '', //weddingz_menu_fallback OR 'hgr_navwalker::fallback'
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul id="main_navbar" class="%2$s">%3$s</ul>',
            'depth'           => 4,
            'walker'          => new hgr_navwalker()
        );
        wp_nav_menu( $defaults );
    ?>
    
    <?php
       	$mobile = array(
            'theme_location'  => 'header-menu',
            'menu'            => 'header-menu',
            'container'       => 'nav',
            'container_class' => '',
            'container_id'    => '',
            'menu_class'      => 'cd-primary-nav',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => '',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul id="mainNavUl" class="%2$s"> %3$s</ul>',
            'depth'           => 4,
            'walker'          => new hgr_mobile_navwalker()
        );
		wp_nav_menu( $mobile );
    ?>
    
    <?php echo ( isset($hgr_options['menu_bar_width']) && $hgr_options['menu_bar_width'] == 'menu_contained' ? ' </div> <!--.container--> ' : '');?>
</div> <!-- #hgr_top_navbar_container -->
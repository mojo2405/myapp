
<!-- TRANSPARENT BEFORE SCROLL - CENTRAL LOGO -->

<?php
 $hgr_options = get_option( 'redux_options' );
?>

<div id="hgr_top_navbar_container" class="central_logo hgr_transparent_before_scroll hgr_navbar <?php echo ( !is_front_page() ? '' : ( $hgr_options['header_floating'] == 2 ? 'hidden' : '') ); ?>">
	<?php echo ( isset($hgr_options['menu_bar_width']) && $hgr_options['menu_bar_width'] == 'menu_contained' ? ' <div class="container"> ' : '');?>
    <?php
		// LEFT MENU
        $left_menu = array(
            'theme_location'  => 'left-menu',
            'menu'            => 'header-menu',
            'container'       => 'div',
            'container_class' => 'left_menu_container',
            'container_id'    => 'main_navbar_container_left',
            'menu_class'      => 'main_navbar left_menu',
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
        wp_nav_menu( $left_menu );
    ?>
    
    <div id="hgr_top_navbar_extras" class="">
    	<?php if( isset($hgr_options['enable_full_screen_search']) && $hgr_options['enable_full_screen_search'] == '1') : ?>
    	<a class="fssearch mobileFsSearch" href="#"><i class="icon fa fa-search"></i></a>
        <?php endif;?>
        <?php 
			/*
			* Display OR Hide the minicart, depending on woocommerce support enabled or not in Theme Options
			*/
			if( class_exists( 'WooCommerce' ) && !empty($hgr_options['woo_support']) && $hgr_options['woo_support'] == 1 ) : 
			global $woocommerce; 
		?>
        <a class="hgr_minicart" href="<?php global $woocommerce; echo esc_url($woocommerce->cart->get_cart_url()); ?>"><i class="icon sage-cart-icon"></i></a>
        <?php
			   endif;
		  ?> 
        <a class="cd-primary-nav-trigger" href="#0"><i class="icon fa fa-bars"></i></a>  
    </div>
    
    
    <?php
		// RIGHT MENU
        $right_menu = array(
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
        wp_nav_menu( $right_menu );
    ?>
    
    
    <?php if( !empty( $hgr_options['logo']['url']) ) : ?>
    <div class="hgr_identity" style="max-width:<?php echo esc_attr($hgr_options['logo']['width']);?>px">
    	<a href="<?php echo esc_url( home_url( '/' ) );?>" title="<?php echo get_bloginfo('name');?>"><?php echo ( !empty($hgr_options['logo']['url']) 
		? '<img src="'.$hgr_options['logo']['url'].'" width="'.$hgr_options['logo']['width'].'" height="'.$hgr_options['logo']['height'].'" alt="'.get_bloginfo('name').'" class="logo" />' 
		: '<img src="'.esc_url( get_template_directory_uri() ).'/highgrade/images/logo.png" width="'.$hgr_options['logo']['width'].'" height="'.$hgr_options['logo']['height'].'" alt="'.get_bloginfo('name').'" class="logo" />' 
		);?></a>
    </div>
    <?php endif;?>
    
    
    <ul id="mainNavUl" class="cd-primary-nav">
    <?php
       	$mobile_left = array(
            'theme_location'  => 'header-menu',
            'menu'            => 'left-menu',
            'container'       => 'nav',
            'container_class' => '',
            'container_id'    => '',
            'menu_class'      => '',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => '',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '%3$s',
            'depth'           => 4,
            'walker'          => new hgr_mobile_navwalker()
        );
		$mobile_right = array(
            'theme_location'  => 'header-menu',
            'menu'            => 'header-menu',
            'container'       => 'nav',
            'container_class' => '',
            'container_id'    => '',
            'menu_class'      => '',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => '',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '%3$s',
            'depth'           => 4,
            'walker'          => new hgr_mobile_navwalker()
        );
		wp_nav_menu( $mobile_left );
		wp_nav_menu( $mobile_right );
    ?>
    </ul>
    
    <?php echo ( isset($hgr_options['menu_bar_width']) && $hgr_options['menu_bar_width'] == 'menu_contained' ? ' </div> <!--.container--> ' : '');?>
</div> <!-- #hgr_top_navbar_container -->
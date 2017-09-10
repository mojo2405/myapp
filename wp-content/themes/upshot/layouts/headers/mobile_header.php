
<!-- Mobile Header --> 

   <?php
 $hgr_options = get_option( 'redux_options' );
?>
   <div id="hgr_top_navbar_container" class="hgr_navbar hgr_mobile_header">
    
    <div class="hgr_identity">
    	<a href="<?php echo esc_url( home_url( '/' ) );?>" title="<?php echo get_bloginfo('name');?>"><?php echo ( !empty($hgr_options['logo']['url']) 
		? '<img src="'.$hgr_options['logo']['url'].'" width="'.$hgr_options['logo']['width'].'" height="'.$hgr_options['logo']['height'].'" alt="'.get_bloginfo('name').'" class="logo" />' 
		: '<img src="'.esc_url( get_template_directory_uri() ).'/highgrade/images/logo.png"  alt="'.get_bloginfo('name').'" class="logo" />' 
		);?></a>
    </div>
    
    <div id="hgr_top_navbar_extras" class="">
        <a class="cd-primary-nav-trigger" href="#"><i class="icon fa fa-bars"></i></a>
        <?php if( isset($hgr_options['enable_full_screen_search']) && $hgr_options['enable_full_screen_search'] == '1') : ?>
    	<a class="fssearch mobileFsSearch" href="#"><i class="icon fa fa-search"></i></a>
        <?php endif;?>
    </div>
    
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
    
</div> <!-- #hgr_top_navbar_container -->
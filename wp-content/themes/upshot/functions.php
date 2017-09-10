<?php
/*
 * @package Upshot WordPress Theme by HighGrade
 * @since version 1.0
 */
 
 // Add multilanguage support
load_theme_textdomain( 'upshot', get_template_directory() . '/highgrade/languages' );
 
 // Enqueue CSS and JS script to frontend header and footer
 if( !function_exists('upshot_enqueue') ) {
	function upshot_enqueue() {
		$hgr_options = get_option( 'redux_options' );
		
		// CSS
		wp_enqueue_style( 'upshot_icons', 					
			trailingslashit( get_template_directory_uri() ) . 'highgrade/css/icons.css', 
			'', 
			''
		);
		
		wp_enqueue_style( 'font-awesome', 			
			trailingslashit( get_template_directory_uri() ) . 'highgrade/css/font-awesome.min.css', 
			'', 
			''
		);
		wp_enqueue_style( 'upshot_css_component', 				
			trailingslashit( get_template_directory_uri() ) . 'highgrade/css/component.css', 
			'', 
			''
		);
		
		wp_enqueue_style( 'venobox', 				
			trailingslashit( get_template_directory_uri() ) . 'highgrade/css/venobox.css', 
			'', 
			''
		);		
		
		wp_enqueue_style( 'upshot_style', get_stylesheet_uri() );
		
				
		// JS		
		wp_enqueue_script( 'imagesloaded',			
			trailingslashit( get_template_directory_uri() ) . 'highgrade/js/imagesloaded.js', 
			array(), 
			'',
			true 
		);
		
		wp_enqueue_script( 'isotope' ); 					// registered and included from VC
		wp_enqueue_script( 'waypoints' ); 				// registered and included from VC
		
		wp_enqueue_script( 'upshot_modernizr_custom',		
			trailingslashit( get_template_directory_uri() ) . 'highgrade/js/modernizr.custom.js', 
			array(), 
			'',
			false 
		);
		
		wp_enqueue_script( 'html5shiv',		
			trailingslashit( get_template_directory_uri() ) . 'highgrade/js/html5shiv.js', 
			array(), 
			'',
			false 
		);
		
		wp_enqueue_script( 'respond',		
			trailingslashit( get_template_directory_uri() ) . 'highgrade/js/respond.min.js', 
			array(), 
			'',
			false 
		);
		
		wp_enqueue_script( 'venobox',				
			trailingslashit( get_template_directory_uri() ) . 'highgrade/js/venobox.min.js', 
			array(), 
			'',
			true 
		);
		
		wp_enqueue_script( 'upshot_colors',					
			trailingslashit( get_template_directory_uri() ) . 'highgrade/js/jquery.animate-colors-min.js', 
			array(), 
			'', 
			true 
		);
		
		wp_enqueue_script( 'upshot_velocity', 
			trailingslashit( get_template_directory_uri() ) . 'highgrade/js/velocity.min.js', 
			array(), 
			'', 
			true 
		); 
		
		wp_enqueue_script(	'jquery-cookie', 
			trailingslashit( get_template_directory_uri() ) . 'highgrade/js/jcookie.js', 
			array(), 
			'', 
			true 
		);
		
		if( is_array($hgr_options) && isset( $hgr_options['enable_smooth_scroll'] ) && esc_attr( $hgr_options['enable_smooth_scroll'] ) == 1 ) {
			wp_enqueue_script(	'upshot_smoothscroll', 
				trailingslashit( get_template_directory_uri() ) . 'highgrade/js/smoothscroll.js', 
				array(), 
				'', 
				true 
			);
		}
		
		wp_register_script(	'upshot_js', 
			trailingslashit( get_template_directory_uri() ) . 'highgrade/js/app.js', 
			array(), 
			'', 
			true 
		);
		
		
		// PHP variables to javascript
		$php_variables_array = array(
			'home_url' 					=> esc_url( home_url("/") ),
			'template_directory_uri'	=> esc_url( get_template_directory_uri() ),
			'retina_logo_url'			=> ( !empty( $hgr_options['retina_logo']['url'] ) ? esc_url( $hgr_options['retina_logo']['url'] ) : '' ),
			'menu_style'					=> ( !empty( $hgr_options['header_floating']) ? esc_attr( $hgr_options['header_floating'] ) : '' ),
			'is_front_page'				=> ( is_front_page() ? 'true' : 'false' ),
			'custom_js'					=> ( isset( $hgr_options['enable_js-code'] ) && $hgr_options['enable_js-code'] == 'custom_js_on' ? json_encode( $hgr_options['js-code'] ) : "''" )
		);
		
		wp_localize_script( 'upshot_js', 'php_variables', $php_variables_array );
		
		wp_enqueue_script( 'upshot_js' );
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		
		// Visual composer - move styles to head
		wp_enqueue_style( 'js_composer_front' );
		wp_enqueue_style( 'js_composer_custom_css' );

	}
 }
 add_action( 'wp_enqueue_scripts', 'upshot_enqueue' );
 
 
add_action( 'admin_enqueue_scripts', 'upshot_admin_enqueue' );
function upshot_admin_enqueue() {
 
    if( is_admin() ) { 
     
        // Add the color picker css file       
        wp_enqueue_style( 'wp-color-picker' ); 
         
        // Include our custom jQuery file with WordPress Color Picker dependency
        wp_enqueue_script( 'custom-script-handle', trailingslashit( get_template_directory_uri() ) . 'highgrade/js/backend.js', array( 'wp-color-picker' ), false, true ); 
    }
}
 
/*
* Add necessary body classes
*/
add_filter( 'body_class', 'upshot_add_bodyClass' );
function upshot_add_bodyClass( $classes ) {
	$detect = new Mobile_Detect;
    $classes[] = ( $detect->isMobile() ? ' isMobile ' : ' notMobile ' );
	$classes[] = ( $detect->isTablet() ? ' isTablet ' : ' isDesktop ');
    return $classes;
}
 

 // REQUIRED
 // Setup $content_width
 if ( ! isset( $content_width ) ) {$content_width = 1180;}
 
 
	
 // Custom pagination for posts
 if( !function_exists('upshot_pagination') ) {
	function upshot_pagination( $args = '' ) {
		$defaults = array(
			'before' => '<p id="post-pagination">' . esc_html__( 'Pages:', 'upshot' ), 
			'after' => '</p>',
			'text_before' => '',
			'text_after' => '',
			'next_or_number' => 'number', 
			'nextpagelink' => esc_html__( 'Next page', 'upshot' ),
			'previouspagelink' => esc_html__( 'Previous page', 'upshot' ),
			'pagelink' => '%',
			'echo' => 0
		);
	
		$r = wp_parse_args( $args, $defaults );
		$r = apply_filters( 'wp_link_pages_args', $r );
		extract( $r, EXTR_SKIP );
	
		global $page, $numpages, $multipage, $more, $pagenow;
	
		$output = '';
		if ( $multipage ) {
			if ( 'number' == $next_or_number ) {
				$output .= $before;
				for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
					$j = str_replace( '%', $i, $pagelink );
					$output .= ' ';
					if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) ) {
						$output .= '<li>';
						$output .= _wp_link_page( $i );
					}
					else {
						$output .= '<li class="active">';
						$output .= _wp_link_page( $i );
					}
	
					$output .= $j;
					if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) ) {
						$output .= '</a>';
						$output .= '</li>';
					}
					else {
						$output .= '</a>';
						$output .= '</li>';
					}
				}
				$output .= $after;
			} else {
				if ( $more ) {
					$output .= $before;
					$i = $page - 1;
					if ( $i && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $text_before . $previouspagelink . $text_after . '</a>';
					}
					$i = $page + 1;
					if ( $i <= $numpages && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $text_before . $nextpagelink . $text_after . '</a>';
					}
					$output .= $after;
				}
			}
		}
		if ( $echo )
			echo esc_html($output);
		return $output;
	}
 }
 
 
 // Include Mobile detect class
 require_once( trailingslashit( get_template_directory() ) . 'highgrade/Mobile_Detect.php' );
 
 
/*
*	Custom hooks
*/
function upshot_after_body_open(){ do_action( 'upshot_after_body_open' ); }
function upshot_before_footer_open(){ do_action( 'upshot_before_footer_open' ); }
 
// Include the TGM_Plugin_Activation class
require_once( trailingslashit( get_template_directory() ) . 'highgrade/plugins/class-tgm-plugin-activation.php' );
add_action( 'tgmpa_register', 'upshot_register_required_plugins' );


// Register the required / recommended plugins for theme
if( !function_exists('upshot_register_required_plugins') ) {
	 
	 function upshot_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// Visual Composer
 		array(
			'name'     				=> esc_html__( 'WPBakery Visual Composer', 'upshot' ), // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> trailingslashit( get_template_directory() ) . 'highgrade/plugins/js_composer.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			'is_callable'       		=> '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		// Revolution Slider
		array(
			'name'     				=> esc_html__( 'Revolution Slider', 'upshot'),
			'slug'     				=> 'revslider',
			'source'   				=> trailingslashit( get_template_directory() ) . 'highgrade/plugins/revslider.zip',
			'required' 				=> false,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
			'external_url' 			=> '',
			'is_callable'       		=> '',
		),
		// Essential Grid
		array(
			'name'     				=> esc_html__( 'Essential Grid', 'upshot'),
			'slug'     				=> 'essential-grid',
			'source'   				=> trailingslashit( get_template_directory() ) . 'highgrade/plugins/essential-grid.zip',
			'required' 				=> false,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
			'external_url' 			=> '',
			'is_callable'       		=> '',
		),
		// HighGrade Extender for Visual Composer
		array(
			'name'     				=> esc_html__( 'HGR Extender for Visual Composer', 'upshot'),
			'slug'     				=> 'hgr_vc_extender',
			'source'   				=> trailingslashit( get_template_directory() ) . 'highgrade/plugins/hgr_vc_extender.zip',
			'required' 				=> false,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
			'external_url' 			=> '',
			'is_callable'       		=> '',
		),
		// HGR Custom Post Types
		array(
			'name'     				=> esc_html__( 'HGR Essentials', 'upshot'),
			'slug'     				=> 'hgr_essentials',
			'source'   				=> trailingslashit( get_template_directory() ) . 'highgrade/plugins/hgr_essentials.zip',
			'required' 				=> false,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
			'external_url' 			=> '',
			'is_callable'       		=> '',
		),
		// HGR MegaMenu
		array(
			'name'     				=> esc_html__( 'HGR MegaMenu', 'upshot'),
			'slug'     				=> 'hgr_megamenu',
			'source'   				=> trailingslashit( get_template_directory() ) . 'highgrade/plugins/hgr_megamenu.zip',
			'required' 				=> false,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
			'external_url' 			=> '',
			'is_callable'       		=> '',
		),
		// HGR MegaFooter
		array(
			'name'     				=> esc_html__( 'HGR MegaFooter', 'upshot'),
			'slug'     				=> 'hgr_megafooter',
			'source'   				=> trailingslashit( get_template_directory() ) . 'highgrade/plugins/hgr_megafooter.zip',
			'required' 				=> false,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
			'external_url' 			=> '',
			'is_callable'       		=> '',
		),
		array(
			'name'     				=> esc_html__( 'WooCommerce', 'upshot'),
			'slug'     				=> 'woocommerce',
			'required' 				=> false,
		),
		array(
			'name'     				=> esc_html__( 'WooCommerce jQuery Cookie Fix', 'upshot'),
			'slug'     				=> 'woocommerce-jquery-cookie-fix',
			'source'   				=> trailingslashit( get_template_directory() ) . 'highgrade/plugins/woocommerce-jquery-cookie-fix.zip',
			'required' 				=> false,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> true,
			'external_url' 			=> '',
			'is_callable'       		=> '',
		),
		
		// Contact Form 7
		array(
			'name' 		=> esc_html__( 'Contact Form 7', 'upshot'),
			'slug' 		=> 'contact-form-7',
			'required'	=> false,
		),
		
		// Widget Importer & Exporter
		array(
			'name' 		=> esc_html__( 'Widget Importer & Exporter', 'upshot'),
			'slug' 		=> 'widget-importer-exporter',
			'required'	=> false,
		),

		

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'upshot',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
	}
}
 


function upshot_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'upshot_add_editor_styles' );
 
 
 // Some basic setup after theme setup
 add_action( 'after_setup_theme', 'upshot_theme_setup' );
 function upshot_theme_setup(){
	// Add theme support for featured image, menus, etc
	if ( function_exists( 'add_theme_support' ) ) { 
			$hgr_defaults = array(
				'default-image'          => '',
				'random-default'         => false,
				'width'                  => 2560,
				'height'                 => 1440,
				'flex-height'            => true,
				'flex-width'             => true,
				'default-text-color'     => '#fff',
				'header-text'            => false,
				'uploads'                => true,
				'wp-head-callback'       => '',
				'admin-head-callback'    => '',
				'admin-preview-callback' => '',
			);
		add_theme_support( 'custom-header', $hgr_defaults );
		
		$args = array(
			'default-color'          => '',
			'default-image'          => '',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
		);
		
		add_theme_support( "custom-background", $args );
		
		// Add theme support for featured image
		add_theme_support( 'post-thumbnails', array( 'post','hgr_portfolio','hgr_testimonials' ) );
		
		// Add theme support for feed links
		add_theme_support( 'automatic-feed-links' );
		
		add_theme_support( 'title-tag' );
		
		// Add theme support for woocommerce
		add_theme_support( 'woocommerce' );
		
		// Add theme support for menus
		if ( function_exists( 'register_nav_menus' ) ) {
			register_nav_menus(
				array(
				  'header-menu'	=> esc_html__( 'Main Menu (Also used for Right Menu)', 'upshot' ),
				  'left-menu'	=> esc_html__( 'Top Left Menu', 'upshot' ),
				  //'right-menu'	=> esc_html__( 'Top Right Menu', 'upshot' ),
				  'sidebar-menu'	=> esc_html__( 'SideBar Menu', 'upshot' ),
				)
			);
		}

	 }
	 
	// Disable Visual Composer front end editor
	if( function_exists('vc_disable_frontend') ) {
		vc_disable_frontend();
	}
	
	
	 function upshot_widgets_init() {
		if ( function_exists('register_sidebar') ) {
			register_sidebar(array(	'name'			=>	esc_html__( 'Blog', 'upshot'),
									'id'			=>	'blog-widgets',
									'description'	=>	esc_html__( 'Widgets in this area will be shown into the blog sidebar.', 'upshot'),
									'before_widget' =>	'<div class="col-md-12 blog_widget">',
									'after_widget'	=>	'</div>',
									'before_title'	=>	'<h4>',
									'after_title'	=>	'</h4>',
								)
						);
			register_sidebar(array(	'name'			=>	esc_html__( 'Pages Sidebar', 'upshot'),
									'id'			=>	'page-widgets',
									'description'	=>	esc_html__( 'Widgets in this area will be shown into the pages left or right sidebar.', 'upshot'),
									'before_widget' =>	'<div class="col-md-12 page_widget">',
									'after_widget'	=>	'</div>',
									'before_title'	=>	'<h4>',
									'after_title'	=>	'</h4>',
								)
						);
			register_sidebar(array(	'name'			=>	esc_html__( 'Shop Sidebar', 'upshot'),
									'id'			=>	'shop-widgets',
									'description'	=>	esc_html__( 'Widgets in this area will be shown into the shop left or right sidebar.', 'upshot'),
									'before_widget' =>	'<div class="col-md-12 shop_widget">',
									'after_widget'	=>	'</div>',
									'before_title'	=>	'<h4>',
									'after_title'	=>	'</h4>',
								)
						);
		}
	 }
	 add_action( 'widgets_init', 'upshot_widgets_init' );
	 
	 
	$hgr_options = get_option( 'redux_options' );
	if( $hgr_options && !is_array($hgr_options) ){
		delete_option('redux_options');
	}
	
	// Hide Visual Composer message to activate with a purchase code.
	// Our buyers do not have a purchase code as we bundle the plugin with the theme.
	//setcookie('vchideactivationmsg', '1', strtotime('+3 years'), '/');
	//setcookie('vchideactivationmsg_vc11', (defined('WPB_VC_VERSION') ? WPB_VC_VERSION : '1'), strtotime('+3 years'), '/');
 }
 
 
 // Some basic setup after theme change
add_action('after_switch_theme', 'upshot_theme_change');
function upshot_theme_change () {
	
	$hgr_options = get_option( 'redux_options' );
	if( $hgr_options && !is_array($hgr_options) ){
		delete_option('redux_options');
	}
	
	
	if ( class_exists( 'Redux' ) ) {
        
		$json_content = '{"last_tab":"","website_model":"website_full_width","enable_smooth_scroll":"0","enable_boxed_shadow":"0","website-background":{"background-color":"","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"enable_full_screen_search":"0","enable_top_info_bar":"0","top_info_btn_font":{"font-family":"Open Sans","font-options":"","google":"1","font-backup":"","font-weight":"700","font-style":"","subsets":"","text-align":"center","text-transform":"uppercase","font-size":"11px","line-height":"14px","word-spacing":"","letter-spacing":"2px"},"top_info_content_font":{"font-family":"Open Sans","font-options":"","google":"1","font-backup":"","font-weight":"400","font-style":"","subsets":"","text-align":"left","font-size":"14px","line-height":"24px","word-spacing":"","letter-spacing":"","color":"#000"},"top_info_bar_padding":{"padding-top":"","padding-right":"","padding-bottom":"","padding-left":"","units":"px"},"body_border":"body_border_off","body_border_dimensions":{"width":"15px","units":"px"},"body_border_color":{"color":"#dd9933","alpha":"1.0","rgba":"rgba(221,153,51,1)"},"custom_error_page":"","back_to_top_button":"0","back_to_top_button_bg_color":{"color":"#dd9933","alpha":"1.0","rgba":"rgba(221,153,51,1)"},"back_to_top_button_dimensions":{"width":"30px","units":"px"},"mediaquery_screen_xs":"480","mediaquery_screen_s":"640","mediaquery_screen_m":"768","mediaquery_screen_l":"980","mediaquery_screen_xl":"1280","mediaquery_screen_xxl":"1280","container_xs":{"width":"300px","units":"px"},"container_s":{"width":"440px","units":"px"},"container_m":{"width":"600px","units":"px"},"container_l":{"width":"720px","units":"px"},"container_xl":{"width":"920px","units":"px"},"container_xxl":{"width":"1200px","units":"px"},"logo":{"url":"http://highgradelab.com/upshot/shop-demo/wp-content/uploads/sites/2/2016/12/logo-dark.png","id":"904","height":"60","width":"174","thumbnail":"http://highgradelab.com/upshot/shop-demo/wp-content/uploads/sites/2/2016/12/logo-dark-150x60.png"},"retina_logo":{"url":"http://highgradelab.com/upshot/shop-demo/wp-content/uploads/sites/2/2016/12/logo-dark@2x.png","id":"903","height":"120","width":"348","thumbnail":"http://highgradelab.com/upshot/shop-demo/wp-content/uploads/sites/2/2016/12/logo-dark@2x-150x120.png"},"favicon":{"url":"http://highgradelab.com/upshot/shop-demo/wp-content/uploads/sites/2/2016/12/favicon.png","id":"896","height":"16","width":"16","thumbnail":"http://highgradelab.com/upshot/shop-demo/wp-content/uploads/sites/2/2016/12/favicon.png"},"retina_favicon":{"url":"http://highgradelab.com/upshot/shop-demo/wp-content/uploads/sites/2/2016/12/favicon@2x.png","id":"897","height":"32","width":"32","thumbnail":"http://highgradelab.com/upshot/shop-demo/wp-content/uploads/sites/2/2016/12/favicon@2x.png"},"iphone_icon":{"url":"http://highgradelab.com/upshot/shop-demo/wp-content/uploads/sites/2/2016/12/iphone.png","id":"898","height":"60","width":"60","thumbnail":"http://highgradelab.com/upshot/shop-demo/wp-content/uploads/sites/2/2016/12/iphone.png"},"retina_iphone_icon":{"url":"http://highgradelab.com/upshot/shop-demo/wp-content/uploads/sites/2/2016/12/iphone@2x.png","id":"900","height":"120","width":"120","thumbnail":"http://highgradelab.com/upshot/shop-demo/wp-content/uploads/sites/2/2016/12/iphone@2x.png"},"ipad_icon":{"url":"http://highgradelab.com/upshot/shop-demo/wp-content/uploads/sites/2/2016/12/ipad.png","id":"899","height":"76","width":"76","thumbnail":"http://highgradelab.com/upshot/shop-demo/wp-content/uploads/sites/2/2016/12/ipad.png"},"ipad_retina_icon":{"url":"http://highgradelab.com/upshot/shop-demo/wp-content/uploads/sites/2/2016/12/ipad@2x.png","id":"901","height":"152","width":"152","thumbnail":"http://highgradelab.com/upshot/shop-demo/wp-content/uploads/sites/2/2016/12/ipad@2x-150x150.png"},"bg_color":"#ffffff","theme_dominant_color":"#21af91","ds_text_color":"#666666","h1_color":"#ffffff","h2_color":"#ffffff","h3_color":"#e0e0e0","h4_color":"#ffffff","h5_color":"#ffffff","h6_color":"#ffffff","ahref_color":{"regular":"#a3a3a3","hover":"#21af91"},"ls_text_color":"#7c7c7c","light_h1_color":"#2a2a2a","light_h2_color":"#2a2a2a","light_h3_color":"#adadad","light_h4_color":"#2a2a2a","light_h5_color":"#21af91","light_h6_color":"#848484","light_ahref_color":{"regular":"#2a2a2a","hover":"#ffffff"},"body-font":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"300","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"14px","line-height":"24px","letter-spacing":""},"h1-font":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"300","font-style":"","subsets":"latin","text-align":"","text-transform":"","font-size":"48px","line-height":"56px","letter-spacing":"-1px"},"h2-font":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"latin","text-align":"","text-transform":"","font-size":"30px","line-height":"40px","letter-spacing":"-1px"},"h3-font":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"latin","text-align":"","text-transform":"","font-size":"21px","line-height":"30px","letter-spacing":""},"h4-font":{"font-family":"Montserrat","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"latin","text-align":"","text-transform":"","font-size":"16px","line-height":"24px","letter-spacing":""},"h5-font":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"700","font-style":"","subsets":"","text-align":"","text-transform":"uppercase","font-size":"12px","line-height":"14px","letter-spacing":"2px"},"h6-font":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"600","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"12px","line-height":"18px","letter-spacing":""},"enable_page_title":"1","page_title_h1":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"300","font-style":"","subsets":"","text-align":"center","text-transform":"","font-size":"60px","line-height":"72px","letter-spacing":"-2px","color":"#ffffff"},"page_title_padding":{"padding-top":"200px","padding-right":"0","padding-bottom":"140px","padding-left":"0","units":"px"},"menu_bar_width":"menu_full_width","menu-font":{"font-family":"Montserrat","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"latin","text-align":"","text-transform":"uppercase","font-size":"11px","line-height":"60px","letter-spacing":""},"menu-font-hover-color":{"regular":"#2a2a2a","hover":"#21af91"},"identity_padding":{"padding-top":"5px","padding-right":"0","padding-bottom":"5px","padding-left":"30px","units":"px"},"top_menu_padding":{"padding-top":"5px","padding-right":"0","padding-bottom":"5px","padding-left":"0","units":"px"},"top_middle_bar_right_side_padding":{"padding-top":"","padding-right":"","padding-bottom":"","padding-left":"","units":"px"},"header_floating":"1","header_floating_display_after":{"height":"180px","units":"px"},"header_floating_hide_after":{"height":"200px","units":"px"},"header_shrink_after_scroll":{"height":"200px","units":"px"},"menu_bar_initial_height":{"height":"150px","units":"px"},"menu_bar_final_height":{"height":"100px","units":"px"},"header_transparent_display_after":{"height":"400px","units":"px"},"header_transp_bg_opacity_after_scroll":"1.0","header_background_type":"1","header_background_rgba":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"header_transparent_bg_rgba":{"color":"#ffffff","alpha":"1.0","rgba":"rgba(255,255,255,1)"},"header_background_image":{"background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"header_opacity_change_after_scroll":"1","header_background_opacity_change_after_amount":{"height":"200px","units":"px"},"header_background_opacity_after_scroll":"1.0","header_border":{"border-top":"","border-right":"","border-bottom":"","border-left":"","border-style":"solid","border-color":"#cecece"},"header_margins":{"margin-top":"0","margin-right":"0","margin-bottom":"0","margin-left":"0","units":"px"},"menu_bar_padding":{"padding-top":"0","padding-right":"30px","padding-bottom":"0","padding-left":"0","units":"px"},"page_top_offset":{"height":"0px","units":"px"},"fixed_menu-font_top_bar":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"12px","line-height":"36px","letter-spacing":"","color":"#ffffff"},"fixed_menu-font-hover-color_top_bar":{"regular":"#ffc31d","hover":"#ffffff"},"top_bar_background_rgba":{"color":"#2a2a2a","alpha":"1","rgba":"rgba(42,42,42,1)"},"top_bar_left_column":"<li class=\"fa fa-map-marker\" style=\"font-size:14px\"></li> 51 Brandywine Drive, Ridgecrest, CA 93555. Locate us on the <a href=\"http://highgradelab.com/cast/contact/\">map</a>.","top_bar_padding":{"padding-top":"","padding-right":"","padding-bottom":"","padding-left":"","units":"px"},"fixed_menu-font_middle_bar":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"14px","line-height":"18px","letter-spacing":"","color":"#2a2a2a"},"fixed_menu-font-hover-color_middle_bar":{"regular":"#000000","hover":"#dd9933"},"middle_bar_background_rgba":{"color":"#ffffff","alpha":"1.0","rgba":"rgba(255,255,255,1)"},"middle_bar_first_column":"<p>+1-202-555-0170</br>\r\n<strong><li class=\"fa fa-phone\" style=\"font-size:14px\"></li> Toll Free Call</strong></p>","middle_bar_second_column":"<p>office@cast.com<br>\r\n<strong><li class=\"fa fa-envelope\" style=\"font-size:14px\"></li> Office Email</strong></p>","middle_bar_third_column":"<p>M - F: 10:00 - 18:00<br>\r\n<strong><li class=\"fa fa-clock-o\" style=\"font-size:14px\"></li> Office Hours</strong></p>","middle_bar_padding":{"padding-top":"15px","padding-right":"0","padding-bottom":"15px","padding-left":"0","units":"px"},"fixed_menu-font":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"500","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"14px","line-height":"60px","letter-spacing":""},"fixed_menu-font-hover-color":{"regular":"#2a2a2a","hover":"#ffffff"},"bottom_bar_background_rgba":{"color":"#ffc31d","alpha":"1","rgba":"rgba(255,195,29,1)"},"bottom_bar_padding":{"padding-top":"0","padding-right":"0","padding-bottom":"0","padding-left":"0","units":"px"},"mobile-menu-font":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"45px","line-height":"50px","letter-spacing":""},"mobile-menu-font-hover-color":{"regular":"#000000","hover":"#21af91"},"mobile_menu_background_rgba":{"color":"#ffffff","alpha":"0.9","rgba":"rgba(255,255,255,0.9)"},"footer-bgcolor":"#21af91","footer_color_scheme":"dark_scheme","footer-copyright":"Set your Copyright Text into Appearance -&gt; Theme Options -&gt; Footer","cf_label_font":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"700","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"12px","line-height":"30px","color":"#666666"},"cf_input_font":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"12px","line-height":"12px","color":"#8b8b8b"},"cf_input_field_bg":{"alpha":"1","rgba":"0,0,0"},"cf_input_field_roundness":{"padding-top":"50px","padding-right":"50px","padding-bottom":"50px","padding-left":"50px","units":"px"},"cf_input_padding":{"padding-top":"15px","padding-right":"15px","padding-bottom":"15px","padding-left":"15px","units":"px"},"cf_input_margin":{"margin-top":"0","margin-right":"0","margin-bottom":"10px","margin-left":"0","units":"px"},"cf_input_border":{"border-top":"2px","border-right":"2px","border-bottom":"2px","border-left":"2px","border-style":"solid","border-color":"#e0e0e0"},"cf_input_submit_height":{"height":"50px","units":"px"},"cf_input_submit_bg":{"color":"#21af91","alpha":"1","rgba":"rgba(33,175,145,1)"},"cf_input_submit_hover_bg":{"color":"#105748","alpha":"1","rgba":"rgba(16,87,72,1)"},"cf_input_submit_clr":{"regular":"#ffffff","hover":"#ffffff"},"woo_support":"1","products_per_row":"3","shop_body_font":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"300","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"14px","line-height":"24px","color":"#5e5e5e"},"shop_h3_font":{"font-family":"Montserrat","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"latin","text-align":"left","text-transform":"","font-size":"16px","line-height":"24px","color":"#2a2a2a"},"shop_price_font":{"font-family":"Montserrat","font-options":"","google":"1","font-weight":"700","font-style":"","subsets":"latin","text-align":"left","text-transform":"","font-size":"16px","line-height":"24px","color":"#21af91"},"shop_h1_font":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"latin","text-align":"","text-transform":"","font-size":"30px","line-height":"40px","color":"#2a2a2a"},"shop_single_price_font":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"latin","text-align":"","text-transform":"","font-size":"30px","line-height":"40px","color":"#21af91"},"shop_h4_font":{"font-family":"Montserrat","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"latin","text-align":"","text-transform":"","font-size":"16px","line-height":"24px","color":"#2a2a2a"},"shop_ahref_color":{"regular":"#2a2a2a","hover":"#21af91"},"shop_bg_color":"#ffffff","shop_minicart_icon_color":"#2a2a2a","woo_bubble_color":{"regular":"#21af91","hover":"#15968b"},"shop_minicart_bubble_color":"#ffffff","qcv_bg_color":{"color":"#f9f8f6","alpha":"1.0","rgba":"rgba(249,248,246,1)"},"qcv_border":{"border-top":"2px","border-right":"2px","border-bottom":"2px","border-left":"2px","border-style":"solid","border-color":"#cecece"},"qcv_itemTitle":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"700","font-style":"","subsets":"latin","text-align":"","text-transform":"","font-size":"14px","line-height":"30px","color":"#000000"},"qcv_itemSubTotal":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"14px","line-height":"14px","color":"#000000"},"qcv_allSubTotal":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"700","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"14px","line-height":"30px","color":"#000000"},"qcv_gtc_btn_bg_color":{"regular":"#d8d8d8","hover":"#c4c4c4"},"qcv_chk_btn_bg_color":{"regular":"#21af91","hover":"#21af91"},"qcv_btns":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"700","font-style":"","subsets":"","text-align":"center","text-transform":"","font-size":"14px","line-height":"30px","color":"#ffffff"},"custom_empty_cart":"","blog_body_font":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"13px","line-height":"24px","color":"#000000"},"blog_h1_font":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"36px","line-height":"48px","color":"#2a2a2a"},"blog_h2_font":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"30px","line-height":"40px","color":"#2a2a2a"},"blog_h3_font":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"21px","line-height":"30px","color":"#2a2a2a"},"blog_h4_font":{"font-family":"Montserrat","font-options":"","google":"1","font-weight":"400","font-style":"","subsets":"latin","text-align":"","text-transform":"","font-size":"16px","line-height":"24px","color":"#2a2a2a"},"blog_h5_font":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"700","font-style":"","subsets":"","text-align":"","text-transform":"uppercase","font-size":"12px","line-height":"14px","color":"#2a2a2a"},"blog_h6_font":{"font-family":"Open Sans","font-options":"","google":"1","font-weight":"600","font-style":"","subsets":"","text-align":"","text-transform":"","font-size":"12px","line-height":"18px","color":"#2a2a2a"},"blog_ahref_color":{"regular":"#2a2a2a","hover":"#21af91"},"blog_bg_color":"#ffffff","enable_css-code":"custom_css_on","css-code":".hoveredDemoImage{\r\n   -webkit-transition: all 0.3s ease-in-out;\r\n   -moz-transition: all 0.3s ease-in-out;\r\n   -o-transition: all 0.3s ease-in-out;\r\n   -ms-transition: all 0.3s ease-out;\r\n   transition: all 0.3s ease-in-out;\r\n   opacity:0.8;\r\n}\r\n.hoveredDemoImage:hover{\r\n    -ms-transform: translate(0px,-10px); /* IE 9 */\r\n   \t-webkit-transform: translate(00px,-10px); /* Safari */\r\n    transform: translate(0px,-10px);\r\n    opacity:1;\r\n}\r\n.splash-shadow{\r\n    -webkit-transition: all 0.3s ease-in-out;\r\n    -moz-transition: all 0.3s ease-in-out;\r\n    -o-transition: all 0.3s ease-in-out;\r\n    -ms-transition: all 0.3s ease-out;\r\n    transition: all 0.3s ease-in-out;\r\n    -webkit-box-shadow: 0px 10px 50px 0px rgba(0,0,0,0.3);\r\n    -moz-box-shadow: 0px 10px 50px 0px rgba(0,0,0,0.3);\r\n    box-shadow: 0px 10px 50px 0px rgba(0,0,0,0.3);\r\n    opacity: 1;\r\n}\r\n.splash-shadow:hover{\r\n    opacity: 0.8;\r\n}\r\n\r\n.product_meta a {\r\n    color:#21af91!important;\r\n}\r\n\r\n.product_meta a:hover {\r\n    color:#0e7f6a!important;\r\n}\r\n.cd-primary-nav {\r\n    text-align: center !important;\r\n}","enable_js-code":"custom_js_off","js-code":"jQuery(document).ready(function(){\r\n\r\n});","redux-backup":1}';
				
		update_option( 'redux_options', json_decode($json_content, true), '', 'yes' );
    }
}


add_action('switch_theme', 'upshot_theme_deactivated');
function upshot_theme_deactivated () {
  delete_option('redux_options');
}

	
 // Portfolio Metaboxes	
	function upshot_portfoliometaboxes() {
    	$screens = array( 'hgr_testimonials' );
    	foreach ( $screens as $screen ) {
       		add_meta_box(
           	'hgr_testimetaboxid',
            	esc_html__( 'Testimonial details', 'upshot' ),
            	'upshot_testi_custom_box',
            	$screen
        	);
    	}
	}
	add_action( 'add_meta_boxes', 'upshot_portfoliometaboxes' );
	function upshot_testi_custom_box($post) {
		// Add an nonce field so we can check for it later
		wp_nonce_field( 'upshot_testi_custom_box', 'upshot_testi_custom_box_nonce' );

		// Get metaboxes values from database
		$hgr_testi_author			=	esc_attr( get_post_meta( $post->ID, '_hgr_testi_author', true ) );
		$hgr_testi_role				=	esc_attr( get_post_meta( $post->ID, '_hgr_testi_role', true ) );
		
		// Construct the metaboxes and print out
		
		// Testimonial author name
		echo '<div class="settBlock"><label for="testi_author">';
		   esc_html_e( "Testimonial author", 'upshot' );
		echo '</label> ';
		echo '<input type="text" id="testi_author" name="testi_author" value="' . esc_attr( $hgr_testi_author ) . '" size="25" placeholder="' . esc_html__( "Jon Doe", "upshot" ) . '" /></div>';
	  
	  	// Testimonial author company and job
	  	echo '<div class="settBlock"><label for="testi_role">';
		   esc_html_e( "Company and Position", 'upshot' );
		echo '</label> ';
	  	echo '<input type="text" id="testi_role" name="testi_role" value="' . esc_attr( $hgr_testi_role ) . '" size="25" /></div>';
	}
	function upshot_save_testidata( $post_id ) {
		
		// Check the user's permissions.
		if ( isset($_POST['post_type']) && $_POST['post_type'] == 'hgr_testimonials' ) {
		
			if ( ! current_user_can( 'edit_post', $post_id ) || ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
			
			// Verify that the nonce is set and valid
			if ( !isset( $_POST['upshot_testi_custom_box_nonce'] ) && ! wp_verify_nonce( $_POST['upshot_testi_custom_box_nonce'] ) ) {
				return;
			}
	
			// If this is an autosave, our form has not been submitted, so we don't want to do anything
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}
			
			
			// OK to save data
			// Update the meta field in the database		
			if ( empty( $_POST['testi_author'] ) ) {
				if ( get_post_meta( $post_id, '_hgr_testi_author', true ) ) {
					delete_post_meta( $post_id, '_hgr_testi_author' );
				}
			} else {
				update_post_meta( $post_id, '_hgr_testi_author', sanitize_text_field( $_POST['testi_author'] ) );
			}
			
			if ( empty( $_POST['testi_role'] ) ) {
				if ( get_post_meta( $post_id, '_hgr_testi_role', true ) ) {
					delete_post_meta( $post_id, '_hgr_testi_role' );
				}
			} else {
				update_post_meta( $post_id, '_hgr_testi_role', sanitize_text_field( $_POST['testi_role'] ) );
			}
		}
	}
	add_action( 'save_post', 'upshot_save_testidata' );
	
	

 
 // Pages Metaboxes
	// Generate the metabox
	function upshot_metaboxes() {
    	$screens = array( 'page', 'hgr_portfolio', 'hgr_megafooter' );
    	foreach ( $screens as $screen ) {
       		add_meta_box(
           	'hgr_metaboxid',
            	esc_html__( 'Page settings', 'upshot' ),
            	'upshot_inner_custom_box',
            	$screen
        	);
    	}
	}
	add_action( 'add_meta_boxes', 'upshot_metaboxes' );
	// Print the box content
	function upshot_inner_custom_box($post) {
		// Add an nonce field so we can check for it later
		wp_nonce_field( 'upshot_inner_custom_box', 'upshot_inner_custom_box_nonce' );

		// Get metaboxes values from database
		$hgr_page_bgcolor			=	esc_attr( get_post_meta( $post->ID, '_hgr_page_bgcolor', true ) );
		$hgr_page_top_padding		=	esc_attr( get_post_meta( $post->ID, '_hgr_page_top_padding', true ) );
		$hgr_page_btm_padding		=	esc_attr( get_post_meta( $post->ID, '_hgr_page_btm_padding', true ) );
		$hgr_page_color_scheme		=	esc_attr( get_post_meta( $post->ID, '_hgr_page_color_scheme', true ) );
		$hgr_page_height			=	esc_attr( get_post_meta( $post->ID, '_hgr_page_height', true ) );
		$hgr_page_title				=	esc_attr( get_post_meta( $post->ID, '_hgr_page_title', true ) );
		$hgr_page_title_color		=	esc_attr( get_post_meta( $post->ID, '_hgr_page_title_color', true ) );
		
		// Construct the metaboxes and print out
		// Page color scheme
		echo '<div class="settBlock"><label for="page_color_scheme">';
		   esc_html_e( "Page color scheme", 'upshot' );
		echo '</label> ';
		if($hgr_page_color_scheme == 'dark_scheme'){
			echo '<select name="page_color_scheme" id="page_color_scheme"><option value="dark_scheme" name="dark_scheme" selected="selected">'.esc_html__('Dark scheme', 'upshot').'</option><option value="light_scheme" name="light_scheme">'.esc_html__('Light scheme', 'upshot').'</option></select></div>';
		}
		elseif($hgr_page_color_scheme == 'light_scheme'){
			echo '<select name="page_color_scheme" id="page_color_scheme"><option value="dark_scheme" name="dark_scheme">'.esc_html__('Dark scheme', 'upshot').'</option><option value="light_scheme" name="light_scheme" selected="selected">'.esc_html__('Light scheme', 'upshot').'</option></select></div>';
		}
		else{
			echo '<select name="page_color_scheme" id="page_color_scheme"><option value="light_scheme" name="light_scheme" selected="selected">'.esc_html__('Light scheme', 'upshot').'</option><option value="dark_scheme" name="dark_scheme">'.esc_html__('Dark scheme', 'upshot').'</option></select></div>';
		}
		
		// Page background color
		echo '<div class="settBlock"><label for="page_bgcolor">';
		   esc_html_e( "Page background color", 'upshot' );
		echo '</label> ';
		echo '<input type="text" id="page_bgcolor" name="page_bgcolor" class="color-field" value="' . $hgr_page_bgcolor . '" /></div>';
	  
	  	// Page top padding
	  	echo '<div class="settBlock"><label for="page_top_padding">';
		   esc_html_e( "Page top padding", 'upshot' );
		echo '</label> ';
	  	echo '<input type="text" id="page_top_padding" name="page_top_padding" value="' . $hgr_page_top_padding . '" size="25" /> <em>pixels</em></div>';
	  
	  	// Page bottom padding
	  	echo '<div class="settBlock"><label for="page_btm_padding">';
		   esc_html_e( "Page bottom padding", 'upshot' );
	  	echo '</label> ';
	  	echo '<input type="text" id="page_btm_padding" name="page_btm_padding" value="' . $hgr_page_btm_padding . '" size="25" /> <em>pixels</em></div>';
		
		// Page height
	  	echo '<div class="settBlock"><label for="page_height">';
		   esc_html_e( "Page height", 'upshot' );
	  	echo '</label> ';
	  	echo '<input type="text" id="page_height" name="page_height" value="' . $hgr_page_height . '" size="25" /> <em>'.esc_html__('pixels. If not set, auto-height is set.', 'upshot').'</em></div>';
		
		// Page title
	  	echo '<div class="settBlock"><label for="page_title">';
		   esc_html_e( "Disable page title", 'upshot' );
	  	echo '</label> ';
	  	echo '<input type="checkbox" id="page_title" name="page_title" value="1" '.checked( $hgr_page_title, 1, false ).' /></div>';
		
		// Page title override color
		echo '<div class="settBlock"><label for="page_title_color">';
		   esc_html_e( "Page title color", 'upshot' );
		echo '</label> ';
		echo '<input type="text" id="page_title_color" name="page_title_color" class="color-field" value="' . $hgr_page_title_color . '" /> <em>'.esc_html__('Overrides the one set in Theme Options', 'upshot').'</em></div>';
	}
	// Save the metabox data to database
	function upshot_save_postdata( $post_id ) {
		
		if( isset($_POST['post_type']) /*&& $_POST['post_type'] == 'page'*/ ) {
		
			// If this is an autosave, our form has not been submitted, so we don't want to do anything
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}
			
			
			
	
			// Check the user's permissions.
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			} else {
				if ( ! current_user_can( 'edit_post', $post_id ) )
				return;
			}
			
			// OK to save data
			if ( empty( $_POST['page_bgcolor'] ) ) {
				if ( get_post_meta( $post_id, '_hgr_page_bgcolor', true ) ) {
					delete_post_meta( $post_id, '_hgr_page_bgcolor' );
				}
			} else {
				update_post_meta( $post_id, '_hgr_page_bgcolor', sanitize_text_field( $_POST['page_bgcolor'] ) );
			}
			
			if ( empty( $_POST['page_top_padding'] ) ) {
				if ( get_post_meta( $post_id, '_hgr_page_top_padding', true ) ) {
					delete_post_meta( $post_id, '_hgr_page_top_padding' );
				}
			} else {
				update_post_meta( $post_id, '_hgr_page_top_padding', sanitize_text_field( $_POST['page_top_padding'] ) );
			}
			
			if ( empty( $_POST['page_btm_padding'] ) ) {
				if ( get_post_meta( $post_id, '_hgr_page_btm_padding', true ) ) {
					delete_post_meta( $post_id, '_hgr_page_btm_padding' );
				}
			} else {
				update_post_meta( $post_id, '_hgr_page_btm_padding', sanitize_text_field( $_POST['page_btm_padding'] ) );
			}
			
			if ( empty( $_POST['page_color_scheme'] ) ) {
				if ( get_post_meta( $post_id, '_hgr_page_color_scheme', true ) ) {
					delete_post_meta( $post_id, '_hgr_page_color_scheme' );
				}
			} else {
				update_post_meta( $post_id, '_hgr_page_color_scheme', sanitize_text_field( $_POST['page_color_scheme'] ) );
			}
			
			if ( empty( $_POST['page_height'] ) ) {
				if ( get_post_meta( $post_id, '_hgr_page_height', true ) ) {
					delete_post_meta( $post_id, '_hgr_page_height' );
				}
			} else {
				update_post_meta( $post_id, '_hgr_page_height', sanitize_text_field( $_POST['page_height'] ) );
			}
			
			if ( empty( $_POST['page_title'] ) ) {
				if ( get_post_meta( $post_id, '_hgr_page_title', true ) ) {
					delete_post_meta( $post_id, '_hgr_page_title' );
				}
			} else {
				update_post_meta( $post_id, '_hgr_page_title', sanitize_text_field( $_POST['page_title'] ) );
			}
			
			if ( empty( $_POST['page_title_color'] ) ) {
				if ( get_post_meta( $post_id, '_hgr_page_title_color', true ) ) {
					delete_post_meta( $post_id, '_hgr_page_title_color' );
				}
			} else {
				update_post_meta( $post_id, '_hgr_page_title_color', sanitize_text_field( $_POST['page_title_color'] ) );
			}
		}
	}
	add_action( 'save_post', 'upshot_save_postdata' );
 // END Pages Metaboxes



/**
 * LESS PHP
 *
 * @link http://leafo.net/lessphp/
 */
 
 function upshot_do_less($debug = false){
	 
	 wp_enqueue_style(
		'upshot_custom-styles',
		get_template_directory_uri() . '/custom-styles.css'
	);
	
	require_once( trailingslashit( get_template_directory() ) . 'highgrade/lessc.inc.php' );
	$hgr_options = get_option( 'redux_options' );
	$less		=	new lessc;
	if($debug == false ) { $less->setFormatter("compressed"); };
	if($debug == true ) { $less->setPreserveComments(true); };
	$options		=	'';
	
	switch( esc_attr( $hgr_options['header_floating'] ) ){
		
		case '2': $bkaTopmenuPosition = "fixed";
		break;
		
		case '3': $bkaTopmenuPosition = "fixed";
		break;
		
		case '4': $bkaTopmenuPosition = "fixed";
		break;
		
		case '5': 
			$bkaTopmenuPosition =	"absolute";
		break;
		
		case '6': 
			$bkaTopmenuPosition =	"fixed";
		break;
		
		default: $bkaTopmenuPosition = "fixed";
		break;
	}
	
	// Theme dominant color
	$theme_dominant_color = ( isset($hgr_options['theme_dominant_color']) && !empty($hgr_options['theme_dominant_color']) ? esc_attr( $hgr_options['theme_dominant_color'] ) : '#999');
	
	// Fixed menu hover color
	$fixed_menu_hover_color = ( isset($hgr_options['fixed_menu-font-hover-color']['hover']) && !empty($hgr_options['fixed_menu-font-hover-color']['hover']) ? esc_attr( $hgr_options['fixed_menu-font-hover-color']['hover'] ) : '#999');
		
	
	//var_dump($hgr_options);
	$less->setVariables(array(
	  "mediaquery_screen_xs"	=>	esc_attr( $hgr_options['mediaquery_screen_xs'] ).'px',	// Default: 480
	  "mediaquery_screen_s"		=>	esc_attr( $hgr_options['mediaquery_screen_s'] ).'px', 	// Default: 640
	  "mediaquery_screen_m"		=>	esc_attr( $hgr_options['mediaquery_screen_m'] ).'px',	// Default: 768
	  "mediaquery_screen_l"		=>	esc_attr( $hgr_options['mediaquery_screen_l'] ).'px',	// Default: 980
	  "mediaquery_screen_xl"	=>	esc_attr( $hgr_options['mediaquery_screen_xl'] ).'px',	// Default: 1280
	  "mediaquery_screen_xxl"	=>	esc_attr( $hgr_options['mediaquery_screen_xxl'] ).'px',	// Default: 1280
	  
	  "container_xs"			=>	esc_attr( $hgr_options['container_xs']['width'] ),		// Default: 300
	  "container_s"				=>	esc_attr( $hgr_options['container_s']['width'] ),		// Default: 440
	  "container_m"				=>	esc_attr( $hgr_options['container_m']['width'] ), 		// Default: 600
	  "container_l"				=>	esc_attr( $hgr_options['container_l']['width'] ),		// Default: 720
	  "container_xl"			=>	esc_attr( $hgr_options['container_xl']['width'] ),		// Default: 920
	  "container_xxl"			=>	esc_attr( $hgr_options['container_xxl']['width'] ),		// Default: 1200
	  
	  "header_height"			=>	( isset($hgr_options['header_height']['height']) && !empty($hgr_options['header_height']['height']) ? esc_attr( $hgr_options['header_height']['height'] ) : '0'),
	  "header_top_padding"		=>	( isset($hgr_options['header_padding']['padding-top']) && !empty($hgr_options['header_padding']['padding-top']) ? esc_attr( $hgr_options['header_padding']['padding-top'] ) : '0'),
	  
	  // Only available for 4th case of header type: shrink after scroll
	  "menu_bar_initial_height"	=>	( isset($hgr_options['menu_bar_initial_height']['height']) && !empty($hgr_options['menu_bar_initial_height']['height']) ? esc_attr( $hgr_options['menu_bar_initial_height']['height'] ) : '80'),
	  "menu_bar_final_height"	=>	( isset($hgr_options['menu_bar_final_height']['height']) && !empty($hgr_options['menu_bar_final_height']['height']) ? esc_attr( $hgr_options['menu_bar_final_height']['height'] ) : '60'),
	  
	  // Contact Form 7
	  "cf_input_field_roundness"=>	( isset($hgr_options['cf_input_field_roundness']['padding-top']) && !empty($hgr_options['cf_input_field_roundness']['padding-top']) ? esc_attr( $hgr_options['cf_input_field_roundness']['padding-top'] ) : '0'),
	  
	  "bkaTopmenuPosition"		=>	$bkaTopmenuPosition,
	  
	  // QCV BTNS
	  "qcv_button_cart_regular_color"		=>	esc_attr( $hgr_options['qcv_gtc_btn_bg_color']['regular'] ),
	  "qcv_button_cart_hover_color"			=>	esc_attr( $hgr_options['qcv_gtc_btn_bg_color']['hover'] ),
	  "qcv_button_checkout_regular_color"	=>	esc_attr( $hgr_options['qcv_chk_btn_bg_color']['regular'] ),
	  "qcv_button_checkout_hover_color"		=>	esc_attr( $hgr_options['qcv_chk_btn_bg_color']['hover'] ),
	  
	  "blog_ahref_color_regular"			=>	esc_attr( $hgr_options['blog_ahref_color']['regular'] ),
	  "blog_ahref_color_hover"				=>	esc_attr( $hgr_options['blog_ahref_color']['hover'] ),
	  
	  // Body border
	  "body_border_width"					=>	( isset($hgr_options['body_border_dimensions']['width']) && !empty($hgr_options['body_border_dimensions']['width']) ? esc_attr( $hgr_options['body_border_dimensions']['width'] ) : '0'),
	  
	  // back to top button
	  "back_to_top_button_width"			=>	( isset($hgr_options['back_to_top_button_dimensions']['width']) && !empty($hgr_options['back_to_top_button_dimensions']['width']) ? esc_attr( $hgr_options['back_to_top_button_dimensions']['width'] ) : '30px'),
	  
	));
	
	$products_per_row	=	( isset($hgr_options['products_per_row']) && !empty($hgr_options['products_per_row']) ? esc_attr( $hgr_options['products_per_row'] ) : '3' );
	
	
	
	$options .="
	.clearfix() {
	  &:before,
	  &:after {
		content: \" \";
		display: table;
	  }
	  &:after {
		clear: both;
	  }
	}
	
	#website_boxed{
		margin: auto;
		overflow: hidden;
		width:100vw;
		max-width:100%;
	}
	
	#hgr_top_navbar_container {
		position: @bkaTopmenuPosition;
	}
	
	/*#main_navbar_container ul.dropdown-menu,
	#main_navbar_container_left ul.dropdown-menu {
		top:60px!important;
	}*/
	
	.noPaddingTopBottom{
		padding-top:0!important;
		padding-bottom:0!important;
	}
	
	#hgr_top_navbar_container .container{
		-webkit-transition: all .5s;
		-moz-transition: all .5s;
		-ms-transition: all .5s;
		-o-transition: all .5s;
		transition: all .5s;
	}
	
	img.responsiveLogo{
		max-width:100%;
		max-height:100%;
		vertical-align:unset!important;
	}
	.hgr_identity a{
		max-width:100%;
		max-height:100%;
	}
	
	
	a.underline.after.first:after {
	  border-bottom: 2px solid ".$theme_dominant_color.";
	}
	
	.loader {
	  font-size: 5px;
	  margin: auto;
	  text-indent: -9999em;
	  width: 11em;
	  height: 11em;
	  border-radius: 50%;
	  background: ".$theme_dominant_color.";
	  background: -moz-linear-gradient(left, ".$theme_dominant_color." 10%, rgba(255, 255, 255, 0) 42%);
	  background: -webkit-linear-gradient(left, ".$theme_dominant_color." 10%, rgba(255, 255, 255, 0) 42%);
	  background: -o-linear-gradient(left, ".$theme_dominant_color." 10%, rgba(255, 255, 255, 0) 42%);
	  background: -ms-linear-gradient(left, ".$theme_dominant_color." 10%, rgba(255, 255, 255, 0) 42%);
	  background: linear-gradient(to right, ".$theme_dominant_color." 10%, rgba(255, 255, 255, 0) 42%);
	  position: relative;
	  -webkit-animation: load3 1.4s infinite linear;
	  animation: load3 1.4s infinite linear;
	  -webkit-transform: translateZ(0);
	  -ms-transform: translateZ(0);
	  transform: translateZ(0);
	}
	.loader:before {
	  width: 50%;
	  height: 50%;
	  background: ".$theme_dominant_color.";
	  border-radius: 100% 0 0 0;
	  position: absolute;
	  top: 0;
	  left: 0;
	  content: '';
	}
	
	
	
	
	a.link-curtain::before {
		border-top: 2px solid rgba(".Redux_Helpers::hex2rgba($theme_dominant_color)." , 0.3);
	}
	a.link-curtain::after {
		background: rgba(".Redux_Helpers::hex2rgba($theme_dominant_color)." , 0.1);
	}
	
	#hgr_top_navbar_container .dropdown-menu li a:hover{
		background-color: rgba(".Redux_Helpers::hex2rgba($theme_dominant_color)." , 0.10);
	}
	
	#fixed_navbar .dropdown-menu li a:hover{
		background-color: rgba(".Redux_Helpers::hex2rgba($fixed_menu_hover_color)." , 0.15);
	}
	
	#hgr_top_navbar_container .dropdown-menu {
		border-top: 2px solid ".$theme_dominant_color." !important;
	}
	
	#fixed_navbar .dropdown-menu {
		border-top: 2px solid ".$fixed_menu_hover_color." !important;
	}
	
	/* Left and Right Page Sidebar */
	.page-template-page-leftsidebar .vc_col-sm-3 ul li,
	.page-template-page-rightsidebar .vc_col-sm-3 ul li,
	.page-template-page-leftsidebar .vc_col-sm-3 ul.children li,
	.page-template-page-rightsidebar .vc_col-sm-3 ul.children li,
	.shop_widget ul li {
		border-left: solid 6px rgba(".Redux_Helpers::hex2rgba($theme_dominant_color)." , 0.3);
		
	}
	
	.page-template-page-leftsidebar .vc_col-sm-3  ul li:hover,
	.page-template-page-rightsidebar .vc_col-sm-3 ul li:hover,
	.shop_widget ul li:hover {
		border-left: solid 6px ".$theme_dominant_color.";
		background-color: rgba(".Redux_Helpers::hex2rgba($theme_dominant_color)." , 0.05);
	}
	
	.page-template-page-leftsidebar #wp-calendar caption,
	.page-template-page-rightsidebar #wp-calendar caption {
		color: ".$theme_dominant_color.";
	}
	
	.page-template-page-leftsidebar #wp-calendar thead, 
	.page-template-page-rightsidebar #wp-calendar thead {
		background: rgba(".Redux_Helpers::hex2rgba($theme_dominant_color)." , 0.05);
	}
	.page-template-page-leftsidebar #wp-calendar tbody td:hover,
	.page-template-page-rightsidebar #wp-calendar tbody td:hover {
		background: rgba(".Redux_Helpers::hex2rgba($theme_dominant_color)." , 0.08);
	}
	
	
	.price_slider_wrapper .ui-slider-horizontal {
		background-color: rgba(".Redux_Helpers::hex2rgba($theme_dominant_color)." , 0.2);
	}
	.price_slider_wrapper .ui-slider .ui-slider-range,
	.price_slider_wrapper .ui-slider .ui-slider-handle {
		background: rgba(".Redux_Helpers::hex2rgba($theme_dominant_color)." , 1);
	}
	.woocommerce #respond input#submit, 
	.woocommerce a.button, 
	.woocommerce button.button, 
	.woocommerce input.button{
		background-color: rgba(".Redux_Helpers::hex2rgba($theme_dominant_color)." , 1)!important;
	}
	.woocommerce #respond input#submit:hover, 
	.woocommerce a.button:hover, 
	.woocommerce button.button:hover, 
	.woocommerce input.button:hover{
		background-color: rgba(".Redux_Helpers::hex2rgba($theme_dominant_color)." , 0.5)!important;
	}
	
	".( $products_per_row == '2' ? "
	.woocommerce ul.products li.product, .woocommerce-page ul.products li.product {
		width: 48%!important;
	}
	" : '')."
	
	".( $products_per_row == '3' ? "
	.woocommerce ul.products li.product, .woocommerce-page ul.products li.product {
		width: 31.05%!important;
	}
	" : '')."
	
	".( $products_per_row == '4' ? "
	.woocommerce ul.products li.product, .woocommerce-page ul.products li.product {
		width: 22.5%!important;
	}
	" : '')."
	
	".( $products_per_row == '5' ? "
	.woocommerce ul.products li.product, .woocommerce-page ul.products li.product {
		width: 17.45%!important;
	}
	" : '')."
	
	".( $products_per_row == '6' ? "
	.woocommerce ul.products li.product, .woocommerce-page ul.products li.product {
		width: 14.14%!important;
	}
	" : '')."
	
	
	
	.wpcf7 input[type=text], 
	.wpcf7 input[type=email], 
	.wpcf7 textarea, 
	.wpcf7 input[type=submit] {
		border-radius: @cf_input_field_roundness;
	}
	
	/* QCV BTNS */
	.qcv_button_cart{background-color: @qcv_button_cart_regular_color;}
	.qcv_button_cart:hover{background-color: @qcv_button_cart_hover_color;}
	.qcv_button_checkout{background-color: @qcv_button_checkout_regular_color;}
	.qcv_button_checkout:hover{background-color: @qcv_button_checkout_hover_color;}
	
	/* BLOG COMMENTS BTN */
	#comments-form input[type=submit], #commentform input[type=submit] {
		background-color: @blog_ahref_color_regular;
	}
	#comments-form input[type=submit]:hover, #commentform input[type=submit]:hover {
		background-color: @blog_ahref_color_hover;
	}
	
	".( isset($hgr_options['body_border']) && $hgr_options['body_border'] == 'body_border_on' ? 
	"
	#hgr_left, #hgr_right {width: @body_border_width;} 
	#hgr_top, #hgr_bottom {height: @body_border_width;}
	body {margin-top: @body_border_width !important;}
	.bka_footer{margin-bottom: @body_border_width !important;}
	"
	: '')."
	
	
	".( isset($hgr_options['back_to_top_button']) && $hgr_options['back_to_top_button'] == '1' ? 
	"
	.back-to-top {
		width:@back_to_top_button_width;
		height:@back_to_top_button_width;
		line-height:@back_to_top_button_width;
	}
	"
	: '')."
	
	.woocommerce .product span.onsale{
		padding:8px 10px;
		border-radius:4px;
	}
	

	
	/*==========  START MEDIA QUERIES  ==========*/
	
	/* 
		Extra Small Screen
		Over:		0
		Under:		mediaquery_screen_xs
		Default:	480px
		Container:	container_xs
		Media:		(max-width: 480px)
	*/
	@media (max-width: @mediaquery_screen_xs - 1) {
		
		.fixed_menu,
		.main_navbar_container{
			display:none;
		}
		.container, #container{
			max-width: @container_xs;
			.clearfix;
			.horizontal_padding;
		}
		.megamenu {width:@container_xs;}
		
		.standAlonePage .page_title_container .container {
			margin-top: 60px;
		}
		
		
		// Desktop nav hidden on small screens
		#main_navbar_container,
		#main_navbar_container_left,
		.hgr_woo_minicart {
			display:none;
		}
		
		// Identity float left for small screns
		.central_logo .hgr_identity{
			float:left;
			margin:0;
			text-align:left;
		}
		
		
		#website_boxed{
			.clearfix;
		}
		".( isset($hgr_options['website_model']) && $hgr_options['website_model'] === 'website_boxed' ? 
		' #masthead, #website_boxed, #hgr_top_navbar_container {width: @container_xs!important;} ' : ' #website_boxed{width: 100vw;max-width:100%;} ')."
		".( isset($hgr_options['enable_boxed_shadow']) && $hgr_options['enable_boxed_shadow'] == '1' ? 
		' #website_boxed  {-webkit-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);-moz-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);} ' : '')."
		
		
		#qcv_handle {
			position: absolute;
			top: 22px;
			right: 70px;
		}
		
		#fssearch_container #searchform input[type=text] {
			font-size: 50px!important;
			height: 100px !important;
		}
		
		/* MAILCHIP COLLECTOR */
		#hgr_mc_name, #hgr_mc_lastname, #hgr_mc_email, .hgr_mc_btn{
			width: 100%!important;
			margin-bottom:10px!important;
		}
		
		#comments .depth-2, #comments .depth-3, #comments .depth-4, #comments .depth-5, #comments .depth-6, #comments .depth-7, #comments .depth-8, #comments .depth-9, #comments .depth-10 {
			margin-left: 0;
		}
		
		
		/* WOOCOMMERCE */
		.woocommerce .product span.onsale {
			top: 25px!important;
			left: 25px!important;
		}
		.hgr_main_image{
			float:none;
			width:100%;
			margin-bottom:20px;
		}
		.hgr_product_thumbnails{
			width:300px;
			max-height:240px;
			float:none;
			overflow:hidden;
		}
		.hgr_product_thumbnails a{
			margin-right:10px;
		}
		.hgr_product_thumbnails a:last-child{
			margin-right:0;
		}
		.hgr_product_thumbnails img{
			max-width:90px!important;
			height:auto;
		}
		.woocommerce-page div.product div.summary{
			width:300px;
			height:auto;
			margin-right:auto;
			margin-left:auto;
		}
		.woocommerce-page div.product div.summary p{
			text-align:justify;
		}
		.woocommerce-page div.product .product_title{
			text-align:center;
		}
		.woocommerce div.product .woocommerce-product-rating{
			float:right;
		}
		.woocommerce div.product form.cart .button{
			margin-top:0!important;
		}
		
		.woocommerce div.product .product_meta .posted_in{
			padding:0!important;
		}
		#tab-description{
			text-align:justify;
		}
		.woocommerce #respond input#submit{
			width:100%;
		}
		.woocommerce p.stars{
			font-size:0.9em;
		}
		.woocommerce p.stars span{
			display: block;
			text-align: center;
		}
		.woocommerce .related ul.products li.product, .woocommerce .related ul li.product{
			width:48%!important;
		}
		/* buy btn related products */
		.woocommerce .related ul.products li.product a, .woocommerce-page .related ul.products li.product a {
			left: 35%;
			bottom: 125px;
		}
		/* buy btn */
		.woocommerce a.button, 
		.woocommerce-page a.button{
			margin-top:0px!important;
			left: 10px!important;
			top:  10px!important;
		}
		/*WOOCOMMERCE END*/
		
	}
	
	
	
	/* 
		Small Screen
		Over:		mediaquery_screen_xs
		Under:		mediaquery_screen_s
		Default:	640px
		Container:	container_s
		Media:		(min-width: 481px) and (max-width: 640px)
	*/
	@media (min-width: @mediaquery_screen_xs ) and (max-width: @mediaquery_screen_s - 1) {
		
		.fixed_menu,
		.main_navbar_container{
			display:none;
		}
		
		.container, #container{
			max-width: @container_s;
			.clearfix;
			.horizontal_padding;
		}
		.megamenu {width:@container_s;}
	
		#website_boxed{
			.clearfix;
		}
		
		
		// Desktop nav hidden on small screens
		#main_navbar_container,
		#main_navbar_container_left,
		.hgr_woo_minicart {
			display:none;
		}
		
		// Identity float left for small screns
		.central_logo .hgr_identity{
			float:left;
			margin:0;
			text-align:left;
		}
		
		".( isset($hgr_options['website_model']) && $hgr_options['website_model'] === 'website_boxed' ? 
		' #masthead, #website_boxed, #hgr_top_navbar_container {width: @container_s!important;} ' : ' #website_boxed{width: 100vw;max-width:100%;} ')."
		
		".( isset($hgr_options['enable_boxed_shadow']) && $hgr_options['enable_boxed_shadow'] == '1' ? 
		' #website_boxed  {-webkit-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);-moz-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);} ' : '')."
		
		#qcv_handle {
			position: absolute;
			top: 22px;
			right: 70px;
		}
		
		#fssearch_container #searchform input[type=text] {
			font-size: 50px!important;
			height: 100px !important;
		}
		
		/* MAILCHIP COLLECTOR */
		#hgr_mc_name, #hgr_mc_lastname, #hgr_mc_email, .hgr_mc_btn{
			width: 100%!important;
			margin-bottom:10px!important;
		}
		
		#comments .depth-2, #comments .depth-3, #comments .depth-4, #comments .depth-5, #comments .depth-6, #comments .depth-7, #comments .depth-8, #comments .depth-9, #comments .depth-10 {
			margin-left: 0;
		}
		
		/* WOOCOMMERCE */
		.woocommerce .product span.onsale {
			top: 25px!important;
			left: 25px!important;
		}
		.hgr_main_image{
			float: none;
			width: 100%;
			margin-bottom: 20px;
		}
		.hgr_product_thumbnails{
			width:70px;
			max-height:240px;
			float:left;
			overflow:hidden;
		}
		.hgr_product_thumbnails a{
			margin-right:10px;
		}
		.hgr_product_thumbnails a:last-child{
			margin-right:0;
		}
		.hgr_product_thumbnails img{
			max-width:70px!important;
			height:auto;
		}
		.woocommerce-page div.product div.summary{
			width:440px!important;
			height:auto;
			float:left!important;
		}
		.woocommerce-page div.product div.summary p{
			text-align:justify;
		}
		.woocommerce-page div.product .product_title{
			text-align:center;
		}
		.woocommerce div.product .woocommerce-product-rating{
			float:right;
		}
		.woocommerce div.product form.cart .button{
			margin-top:0!important;
		}
		
		.woocommerce div.product .product_meta .posted_in{
			padding:0!important;
		}
		#tab-description{
			text-align:justify;
		}
		.woocommerce #respond input#submit{
			width:100%;
		}
		.woocommerce p.stars{
			font-size:0.9em;
		}
		.woocommerce p.stars span{
			display: block;
			text-align: center;
		}
		.woocommerce .related ul.products li.product, 
		.woocommerce .related ul li.product, 
		.woocommerce .related li.product:nth-child(2n) {
			width:32%!important;
			clear:none!important;
			margin-left: 2px;
			margin-right: 2px;
			text-align:center;
			float:left!important;
		}
		/* buy btn related products */
		.woocommerce .related ul.products li.product a, 
		.woocommerce-page .related ul.products li.product a {
			left: 37%;
			top: -12px;
		}
	
		/* buy btn */
		.woocommerce a.button, 
		.woocommerce-page a.button{
			margin-top:0px!important;
			left: 10px!important;
			top:  10px!important;
		}
		/*WOOCOMMERCE END*/
	}
	
	
		
	/* 
		Medium Screen
		Over:		mediaquery_screen_s
		Under:		mediaquery_screen_m
		Default:	768px
		Container:	container_m
		Media:		(min-width: 641px) and (max-width: 768px)
	*/
	@media (min-width: @mediaquery_screen_s) and (max-width: @mediaquery_screen_m - 1) {
		.fixed_menu,
		.main_navbar_container{
			display:none;
		}
		
		.container, #container{
			max-width: @container_m;
			.clearfix;
			.horizontal_padding;
		}
		.megamenu {width:@container_m;}
		#website_boxed{
			.clearfix;
		}
		
		
		// Desktop nav hidden on small screens
		#main_navbar_container,
		#main_navbar_container_left,
		.hgr_woo_minicart,
		.fixed_menu {
			display:none;
		}
		
		// Identity float left for small screns
		.central_logo .hgr_identity{
			float:left;
			margin:0;
			text-align:left;
		}
	
		".( isset($hgr_options['website_model']) && $hgr_options['website_model'] === 'website_boxed' ? 
		' #masthead, #website_boxed, #hgr_top_navbar_container {width: @container_m!important;} ' : ' #website_boxed{width: 100vw;max-width:100%;} ')."
		
		".( isset($hgr_options['enable_boxed_shadow']) && $hgr_options['enable_boxed_shadow'] == '1' ? 
		' #website_boxed  {-webkit-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);-moz-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);} ' : '')."
		
		.initialHeaderSize{
			height: @menu_bar_initial_height;
		}
		.finalHeaderSize{
			height: @menu_bar_final_height!important;
		}
		
		#fssearch_container #searchform input[type=text] {
			font-size: 50px!important;
			height: 100px !important;
		}
		
		#comments .depth-2, #comments .depth-3, #comments .depth-4, #comments .depth-5, #comments .depth-6, #comments .depth-7, #comments .depth-8, #comments .depth-9, #comments .depth-10 {
			margin-left: 0;
		}
		
		
		/* WOOCOMMERCE */
		.woocommerce .product span.onsale {
			top: 25px!important;
			left: 25px!important;
		}
		.hgr_main_image{
			float: none;
			width: 100%;
			margin-bottom: 20px;
		}
		.hgr_product_thumbnails{
			width:120px;
			max-height:460px;
			float:left;
			overflow:hidden;
		}
		.hgr_product_thumbnails a{
			margin-right:10px;
		}
		.hgr_product_thumbnails a:last-child{
			margin-right:0;
		}
		.hgr_product_thumbnails img{
			max-width:120px!important;
			height:auto;
		}
		.woocommerce-page div.product div.summary{
			width:600px!important;
			height:auto;
			float:left!important;
		}
		.woocommerce-page div.product div.summary p{
			text-align:justify;
		}
		.woocommerce-page div.product .product_title{
			text-align:left;
		}
		.woocommerce div.product .woocommerce-product-rating{
			float:right;
		}
		div.quantity_select{
			width:70px!important;
			background-position:50px!important;
		}
		.woocommerce select.qty{
			width:280px!important;
		}
		.woocommerce form.cart select.qty{
			width:85px!important;
		}
		.woocommerce div.product form.cart .button{
			margin-top:0!important;
			width:50%!important;
		}
		
		.woocommerce div.product .product_meta .posted_in{
			padding:0!important;
		}
		#tab-description{
			text-align:justify;
		}
		.woocommerce #respond input#submit{
			width:100%;
		}
		.woocommerce p.stars{
			font-size:0.9em;
		}
		.woocommerce p.stars span{
			display: block;
			text-align: center;
		}
		.woocommerce .related ul.products li.product, .woocommerce .related ul li.product{
			width:32%!important;
			clear:none!important;
			margin-left: 2px;
			margin-right: 2px;
			text-align:center;
			float:left!important;
		}
		/* buy btn related products */
		.woocommerce .related ul.products li.product a, .woocommerce-page .related ul.products li.product a {
			left: 37%;
			top: -12px;
		}
	
		/* buy btn */
		.woocommerce a.button, .woocommerce-page a.button{
			margin-top:0px!important;
			left: 10px!important;
			top:  10px!important;
		}
		/*WOOCOMMERCE END*/
			
	}
	
	
	
	/* 
		Large Screen
		Over:		mediaquery_screen_m
		Under:		mediaquery_screen_l
		Default:	980px
		Container:	container_l
		Media:		(min-width: 769px) and (max-width: 980px)
	*/
	@media (min-width: @mediaquery_screen_m) and (max-width: @mediaquery_screen_l - 1) {
		
		.fixed_menu,
		.main_navbar_container{
			/*display:none;*/
		}
		
		.standAlonePage .page_title_container .container {
			margin-top: 60px;
		}
		
		.container, #container{
			max-width: @container_l;
		}
		.megamenu {
			width:@container_l;
		}
		ul.primary_menu{
			margin-top:@header_height;
		}
		
		
		// Desktop nav hidden on small screens
		#main_navbar_container,
		#main_navbar_container_left,
		.hgr_woo_minicart,
		.fixed_menu {
			display:none;
		}
		
		// Identity float left for small screns
		.central_logo .hgr_identity{
			float:left;
			margin:0;
			text-align:left;
		}
		
		
		".( isset($hgr_options['website_model']) && $hgr_options['website_model'] === 'website_boxed' ? 
		' #masthead, #website_boxed, #hgr_top_navbar_container {width: @container_l!important;} ' : ' #website_boxed{width: 100vw;max-width:100%;} ')."
		".( isset($hgr_options['enable_boxed_shadow']) && $hgr_options['enable_boxed_shadow'] == '1' ? 
		' #website_boxed  {-webkit-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);-moz-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);} ' : '')."
		
		.initialHeaderSize{
			height: @menu_bar_initial_height;
		}
		.finalHeaderSize{
			height: @menu_bar_final_height!important;
		}
		
		".( isset($hgr_options['header_floating']) && $hgr_options['header_floating'] === '6' ? ' 
		
		/*#hgr_top_navbar_container {
			-moz-transform: translateY(-100%);
			-o-transform: translateY(-100%);
			-ms-transform: translateY(-100%);
			-webkit-transform: translateY(-100%);
			transform: translateY(-100%);
		} */
		
		' : '' ) . "
		
		/*#hgr_top_navbar_container.headerappear{
			-moz-transform: translateY(0);
			-o-transform: translateY(0);
			-ms-transform: translateY(0);
			-webkit-transform: translateY(0);
			transform: translateY(0);
			-webkit-transition: transform .33s ease-in-out;
			-moz-transition: transform .33s ease-in-out;
			transition: transform .33s ease-in-out;	
		}
		#hgr_top_navbar_container.headerhidden{
			-moz-transform: translateY(-100%);
			-o-transform: translateY(-100%);
			-ms-transform: translateY(-100%);
			-webkit-transform: translateY(-100%);
			transform: translateY(-100%);
			-webkit-transition: transform .33s ease-in-out;
			-moz-transition: transform .33s ease-in-out;
			transition: transform .33s ease-in-out;	
		}*/
		
		
		/* WOOCOMMERCE */
		.woocommerce .product span.onsale {
			top: 25px!important;
			left: 25px!important;
		}
		.hgr_main_image{
			float: none;
			width: 100%;
			margin-bottom: 20px;
		}
		.hgr_product_thumbnails{
			width:200px;
			max-height:500px;
			float:left;
			overflow:hidden;
		}
		.hgr_product_thumbnails a{
			margin-right:10px;
		}
		.hgr_product_thumbnails a:last-child{
			margin-right:0;
		}
		.hgr_product_thumbnails img{
			max-width:200px!important;
			height:auto;
		}
		.woocommerce-page div.product div.summary{
			width:700px!important;
			height:auto;
			float:left!important;
		}
		.woocommerce-page div.product div.summary p{
			text-align:justify;
		}
		.woocommerce-page div.product .product_title{
			text-align:left;
		}
		.woocommerce div.product .woocommerce-product-rating{
			float:right;
		}
		div.quantity_select{
			width:70px!important;
			background-position:50px!important;
		}
		.woocommerce select.qty{
			width:280px!important;
		}
		.woocommerce form.cart select.qty{
			width:85px!important;
		}
		.woocommerce div.product form.cart .button{
			margin-top:0!important;
			width:50%!important;
		}
		
		.woocommerce div.product .product_meta .posted_in{
			padding:0!important;
		}
		#tab-description{
			text-align:justify;
		}
		.woocommerce #respond input#submit{
			width:100%;
		}
		.woocommerce p.stars{
			font-size:0.9em;
		}
		.woocommerce p.stars span{
			display: block;
			text-align: center;
		}
		.woocommerce .related ul.products li.product, .woocommerce .related ul li.product{
			width:32%!important;
			clear:none!important;
			margin-left: 2px;
			margin-right: 2px;
			text-align:center;
			float:left!important;
		}
		/* buy btn related products */
		.woocommerce .related ul.products li.product a, .woocommerce-page .related ul.products li.product a {
			left: 37%;
			top: -12px;
		}
	
		/* buy btn */
		.woocommerce a.button, .woocommerce-page a.button{
			margin-top:0px!important;
			left: 10px!important;
			top:  10px!important;
		}
		/*WOOCOMMERCE END*/
	}	
	
	
	
	/* 
		Extra Large Screen
		Over:		mediaquery_screen_l
		Under:		mediaquery_screen_xl
		Default:	1280px
		Container:	container_xl
		Media:		(min-width: 981px) and (max-width: 1280px)
	*/
	@media (min-width: @mediaquery_screen_l) and (max-width: @mediaquery_screen_xl - 1)  {
		
		.container, #container{
			max-width: @container_xl;
		}
		.megamenu {width:@container_xl;}
		ul.primary_menu{
			line-height:@header_height;
		}
		ul.sub-menu{
			line-height:24px;
			top:@header_height - @header_top_padding - 1;
		}
		
		
		// Desktop nav hidden on small screens
		#main_navbar_container,
		#main_navbar_container_left,
		.hgr_woo_minicart,
		.fixed_menu {
			display:none;
		}
		
		// Identity float left for small screns
		.central_logo .hgr_identity{
			float:left;
			margin:0;
			text-align:left;
		}
		
		
		".( isset($hgr_options['website_model']) && $hgr_options['website_model'] === 'website_boxed' ? 
		' #masthead, #website_boxed, #hgr_top_navbar_container {width: @container_xl!important;} ' : ' #website_boxed{width: 100vw;max-width:100%;} ')."
		".( isset($hgr_options['enable_boxed_shadow']) && $hgr_options['enable_boxed_shadow'] == '1' ? 
		' #website_boxed  {-webkit-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);-moz-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);} ' : '')."
		
		.initialHeaderSize{
			height: @menu_bar_initial_height;
		}
		.finalHeaderSize{
			height: @menu_bar_final_height!important;
		}
		
		".( isset($hgr_options['header_floating']) && $hgr_options['header_floating'] === '6' ? ' 
		
		
		
		' : '' ) . "
		
		/*.isDesktop.notMobile #hgr_top_navbar_container.headerappear{
			-moz-transform: translateY(0);
			-o-transform: translateY(0);
			-ms-transform: translateY(0);
			-webkit-transform: translateY(0);
			transform: translateY(0);
			-webkit-transition: transform .33s ease-in-out;
			-moz-transition: transform .33s ease-in-out;
			transition: transform .33s ease-in-out;	
		}
		.isDesktop.notMobile #hgr_top_navbar_container.headerhidden{
			-moz-transform: translateY(-100%);
			-o-transform: translateY(-100%);
			-ms-transform: translateY(-100%);
			-webkit-transform: translateY(-100%);
			transform: translateY(-100%);
			-webkit-transition: transform .33s ease-in-out;
			-moz-transition: transform .33s ease-in-out;
			transition: transform .33s ease-in-out;	
		}*/
		
		
		/* WOOCOMMERCE */
		.woocommerce .product span.onsale {
			top: 25px!important;
			left: 25px!important;
		}
		.hgr_main_image{
			float: none;
			width: 100%;
			margin-bottom: 20px;
		}
		.hgr_product_thumbnails{
			width:200px;
			float:left;
			overflow:hidden;
		}
		.hgr_product_thumbnails a{
			margin-right:10px;
		}
		.hgr_product_thumbnails a:last-child{
			margin-right:0;
		}
		.hgr_product_thumbnails img{
			max-width:200px!important;
			height:auto;
		}
		.woocommerce-page div.product div.summary{
			width:920px!important;
			height:auto;
			float:left!important;
		}
		.woocommerce-page div.product div.summary p{
			text-align:justify;
		}
		.woocommerce-page div.product .product_title{
			text-align:left;
		}
		.woocommerce div.product .woocommerce-product-rating{
			float:right;
		}
		div.quantity_select{
			width:70px!important;
			background-position:50px!important;
		}
		.woocommerce select.qty{
			width:280px!important;
		}
		.woocommerce form.cart select.qty{
			width:70px!important;
		}
		.woocommerce div.product form.cart .button{
			margin-top:0!important;
			width:150px!important;
			float:none;
		}
		
		.woocommerce div.product .product_meta .posted_in{
			padding:0!important;
		}
		#tab-description{
			text-align:justify;
		}
		.woocommerce #respond input#submit{
			width:50%;
			float:right;
		}
		.woocommerce p.stars{
			font-size:0.9em;
		}
		.woocommerce p.stars span{
			display: block;
		}
		.woocommerce .related ul.products li.product, .woocommerce .related ul li.product{
			width:24%!important;
			clear:none!important;
			margin-left: 2px;
			margin-right: 2px;
			text-align:center;
			float:left!important;
		}
		/* buy btn related products */
		.woocommerce .related ul.products li.product a, .woocommerce-page .related ul.products li.product a {
			left: 39%;
			bottom: 125px;
		}
	
		/* buy btn */
		.woocommerce a.button, .woocommerce-page a.button{
			margin-top:0px!important;
			left: 10px!important;
			top:  10px!important;
		}
		/*WOOCOMMERCE END*/
	}
	
	
	
	/* 
		XXL Screen
		Over:		mediaquery_screen_xl
		Under:		none
		Default:	over 1280px
		Container:	container_xxl
		Media:		min-width: 1281px
	*/
	@media (min-width: @mediaquery_screen_xl) {
		.container, #container{
			max-width: @container_xxl;
		}
		
		// Mobile parts hidden on large screens
		.cd-primary-nav-trigger,
		#mainNavUl {
			display:none;
		}
		
		.megamenu {width:@container_xxl;}
	
		ul.primary_menu{
			line-height:@header_height;
		}
		ul.sub-menu{
			line-height:24px;
			top:@header_height - @header_top_padding - 1;
		}
	
		".( isset($hgr_options['website_model']) && $hgr_options['website_model'] === 'website_boxed' ? 
		' #masthead, #website_boxed, #hgr_top_navbar_container {width: @container_xxl!important;} ' : ' #website_boxed{width: 100vw;max-width:100%;} ')."
		".( isset($hgr_options['enable_boxed_shadow']) && $hgr_options['enable_boxed_shadow'] == '1' ? 
		' #website_boxed  {-webkit-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);-moz-box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);box-shadow: 0px 0px 60px 0px rgba(0,0,0,0.2);} ' : '')."
		
		
		.initialHeaderSize{
			height: @menu_bar_initial_height;
		}
		.finalHeaderSize{
			height: @menu_bar_final_height!important;
		}
		
		".( isset($hgr_options['header_floating']) && $hgr_options['header_floating'] === '6' ? ' 
		
		.isDesktop.notMobile #hgr_top_navbar_container {
			-moz-transform: translateY(-100%);
			-o-transform: translateY(-100%);
			-ms-transform: translateY(-100%);
			-webkit-transform: translateY(-100%);
			transform: translateY(-100%);
		} 
		
		' : '' ) . "
		
		.isDesktop.notMobile #hgr_top_navbar_container.headerappear{
			-moz-transform: translateY(0);
			-o-transform: translateY(0);
			-ms-transform: translateY(0);
			-webkit-transform: translateY(0);
			transform: translateY(0);
			-webkit-transition: transform .33s ease-in-out;
			-moz-transition: transform .33s ease-in-out;
			transition: transform .33s ease-in-out;	
		}
		.isDesktop.notMobile #hgr_top_navbar_container.headerhidden{
			-moz-transform: translateY(-100%);
			-o-transform: translateY(-100%);
			-ms-transform: translateY(-100%);
			-webkit-transform: translateY(-100%);
			transform: translateY(-100%);
			-webkit-transition: transform .33s ease-in-out;
			-moz-transition: transform .33s ease-in-out;
			transition: transform .33s ease-in-out;	
		}
		
		
		/* WOOCOMMERCE */
		.hgr_product_images{
			width:960px;
			height:800px;
			float:left;
		}
		.hgr_product_summary{
			width:700px;
			height:800px;
			float:right;
		}
		.hgr_main_image{
			float:left;
			width:600px;
		}
		.hgr_main_image.has_thumbnails{
			width:480px;
		}
		.hgr_product_thumbnails{
			width:100px;
			margin-right:20px;
			max-height:800px;
			float:left;
			overflow:hidden;
		}
		.woocommerce .product span.onsale {
			top: 25px!important;
			left: 25px!important;
		}
		div.quantity_select{
			width:70px!important;
			background-position:50px!important;
		}
		.woocommerce select.qty{
			width:280px!important;
		}
		.woocommerce form.cart select.qty{
			width:85px!important;
		}
		.woocommerce div.product form.cart .button{
			margin-top:0!important;
			width:150px!important;
			float:none;
		}
		.woocommerce .related ul.products li.product, .woocommerce .related ul li.product{
			width:24%!important;
			clear:none!important;
			margin-left: 2px;
			margin-right: 2px;
			text-align:center;
			float:left!important;
		}
		/* buy btn related products */
		.woocommerce .related ul.products li.product a, .woocommerce-page .related ul.products li.product a {
			left: 39%;
			bottom: 125px;
		}
	
		/* buy btn */
		.woocommerce a.button, .woocommerce-page a.button{
			margin-top:0px!important;
			left: 10px!important;
			top:  10px!important;
		}
	}
	
	";
	
	wp_add_inline_style( 'upshot_custom-styles', esc_html($less->compile($options)) );
 }
 add_action( 'wp_enqueue_scripts', 'upshot_do_less' );
 


// WooCommerce
// Change number or products per row to a custom number
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		$hgr_options = get_option( 'redux_options' );
		return ( isset($hgr_options['products_per_row']) ? $hgr_options['products_per_row'] : 3 ); // defaults to 3 products per row
	}
}


/*
*	Force Visual Composer to initialize as "built into the theme". 
*	This will hide certain tabs under the Settings->Visual Composer page
*/
	if(function_exists('vc_set_as_theme')){
	add_action( 'vc_before_init', 'hgr_vcSetAsTheme' );
	function hgr_vcSetAsTheme() {
    	vc_set_as_theme();
	}
 }



/*
*	WooCommerce: Display product atributes
*/
function upshot_woo_show_product_atributes(){
 
    global $product;
    $attributes = $product->get_attributes();
 
    if ( ! $attributes ) {
        return;
    }
 	
	
    $out = '<ul class="custom-attributes">';
 
    foreach ( $attributes as $attribute ) {
 
 
        // skip variations
        if ( $attribute['is_variation'] ) {
        continue;
        }
 
 
        if ( $attribute['is_taxonomy'] ) {
 
            $terms = wp_get_post_terms( $product->id, $attribute['name'], 'all' );
 
            // get the taxonomy
            $tax = $terms[0]->taxonomy;
 
            // get the tax object
            $tax_object = get_taxonomy($tax);
 
            // get tax label
            if ( isset ($tax_object->labels->name) ) {
                $tax_label = $tax_object->labels->name;
            } elseif ( isset( $tax_object->label ) ) {
                $tax_label = $tax_object->label;
            }
 
            foreach ( $terms as $term ) {
 
                $out .= '<li class="' . esc_attr( $attribute['name'] ) . ' ' . esc_attr( $term->slug ) . '">';
                $out .= '<span class="attribute-label">' . $tax_label . '</span> ';
                $out .= '<span class="attribute-value">' . $term->name . '</span></li>';
 
            }
 
        } else {
 
            $out .= '<li class="' . sanitize_title($attribute['name']) . ' ' . sanitize_title($attribute['value']) . '">';
            $out .= '<span class="attribute-label">' . esc_attr( $attribute['name'] ) . '</span> ';
            $out .= '<span class="attribute-value">' . esc_attr( $attribute['value'] ) . '</span></li>';
        }
    }
 
    $out .= '</ul>';
 
    echo esc_html($out);}
	


/*
* Do the custom page layout
*/
function upshot_get_layout( $page_type = 'page' ){
	$hgr_options = get_option( 'redux_options' );
	
	// Blog Specific
	if( isset($hgr_options['blog_layout']) && $page_type == 'blog') {
		require_once( trailingslashit( get_template_directory() ) . 'layouts/' . $page_type . '/' . esc_attr( $hgr_options['blog_layout'] ) . '.php' );
	}
	elseif( isset($hgr_options['content_layout']) ) {
		require_once( trailingslashit( get_template_directory() ) . 'layouts/' . $page_type . '/' . esc_attr( $hgr_options['content_layout'] ) . '.php' );
	} else {
		require_once( trailingslashit( get_template_directory() ) . 'layouts/' . $page_type . '/nosidebar.php' );
	}
}



/**
*	Header function  
*/
function upshot_do_header() {
	$hgr_options = get_option( 'redux_options' );
	
	$header_type = esc_attr( $hgr_options['header_floating'] );
	/*
		$header_type values:
		1 - Fixed - DEFAULT
		2 - Apear after scrolling down
		3 - Dissapear after scrolling down
		4 - Shrink after scrolling down
		5 - Transparent, scrolls with page and then falls down after scrolling
		6 - Complex. Fixed menu and another appear after scroll menu
	*/
	$output = '';
	
	$original_header_type = $header_type;
	
	$specialHeader = false;
	if( is_single() ) {
		$specialHeader = true;
	}
	elseif( is_category() ) {
		$specialHeader = true;
	}
	elseif( is_author() ) {
		$specialHeader = true;
	}
	elseif( is_archive() ) {
		$specialHeader = true;
	}
	elseif( is_home() ){
		$specialHeader = true;
	}
	
	if( class_exists( 'WooCommerce' ) ) {
		if( is_shop() ) {
			$specialHeader = false;
		}
		if( is_product() ) {
			$specialHeader = true;
		}
		elseif( is_product_category() ) {
			$specialHeader = false;
		}
		elseif( is_cart() ) {
			$specialHeader = true;
		}
	}
	
	
	
	// If on mobile, header is always fixed.
	// If other page than home, header is always fixed
	$detect = new Mobile_Detect;
	
	
	/*if( $detect->isMobile() || !is_front_page() ){
		$header_type = '1';
	}*/
	
	if( $detect->isMobile() ){
		$header_type = '1';
	}
	
	if( !$detect->isMobile() && $original_header_type == 6 ) {
		$header_type = $original_header_type;
	}
	
	
	
	switch($header_type){
		case '2': // Apear after scrolling down
			$scroll_amount = esc_attr( ( isset($hgr_options['header_floating_display_after']['height']) && 
									$hgr_options['header_floating_display_after']['height'] != 'px' ? 
									$hgr_options['header_floating_display_after']['height']*1 : '$(window).height()') );
			
			$output = 'jQuery(document).ready(function($) {
					"use strict";
					
					$("#hgr_top_navbar_extras .hgr_woo_minicart, #hgr_top_navbar_extras, #hgr_top_navbar_extras a").height($( "#hgr_top_navbar_container").outerHeight(true) );
					$(".fixed_menu_bottom_bar .hgr_woo_minicart").height($( ".fixed_menu_bottom_bar").outerHeight(true) );
					$("#hgr_top_navbar_extras a").css( "line-height", $("#hgr_top_navbar_container").outerHeight() + "px" );
					
					if($(window).height() < $("body").prop("scrollHeight")) {
					
						$("#hgr_top_navbar_container").removeClass("displayed").addClass("hidden");
						$(window).bind("scroll", function() {
								if ($(window).scrollTop() > '.$scroll_amount.') {
									$("#hgr_top_navbar_container").slideDown(200);
									$("#hgr_top_navbar_container").removeClass("hidden").addClass("displayed");
									
									$("#hgr_top_navbar_extras .hgr_woo_minicart, #hgr_top_navbar_extras, #hgr_top_navbar_extras a").height($( "#hgr_top_navbar_container").outerHeight(true) );
									$("#hgr_top_navbar_extras a").css( "line-height", $("#hgr_top_navbar_container").outerHeight() + "px" );
								}
								if ($(window).scrollTop() < '.$scroll_amount.') {
									$("#hgr_top_navbar_container").slideUp(200, function() {
										$("#hgr_top_navbar_container").removeClass("displayed").addClass("hidden");
									});
								}
							});
					}
				});';
		break;
		
		case '3': // DISAPPEAR AFTER SCROLL - LEFT LOGO
			$scroll_amount = esc_attr( ( isset($hgr_options['header_floating_hide_after']['height']) && 
									$hgr_options['header_floating_hide_after']['height'] != 'px' ? 
									$hgr_options['header_floating_hide_after']['height']*1 : '$(window).height()') );
			
			if( isset(	$hgr_options['header_opacity_change_after_scroll']) && 
									$hgr_options['header_opacity_change_after_scroll'] == 1) {
							$scroll_amount_change_color = ( isset (
								$hgr_options['header_background_opacity_change_after_amount']['height']) && 
								$hgr_options['header_background_opacity_change_after_amount']['height'] != 'px' ? 
								esc_attr( $hgr_options['header_background_opacity_change_after_amount']['height'] * 1 ) : '$(window).height()');
													
							$initialOpacity		=	$hgr_options['header_background_rgba']['alpha'];
							$afterScrollOpacity =	$hgr_options['header_background_opacity_after_scroll'];
			}
			
			$output = 'jQuery(document).ready(function($) {
						"use strict";
						var header_height = $("#hgr_top_navbar_container").outerHeight(true);
						var lastScrollTop = 0;						
						$("#hgr_top_navbar_extras .hgr_woo_minicart, #hgr_top_navbar_extras, #hgr_top_navbar_extras a").height($( "#hgr_top_navbar_container").outerHeight(true) );
						$(".fixed_menu_bottom_bar .hgr_woo_minicart").height($( ".fixed_menu_bottom_bar").outerHeight(true) );
						$("#hgr_top_navbar_extras a").css( "line-height", $("#hgr_top_navbar_container").outerHeight() + "px" );';
						
						// If header opacity is 1 we scroll down page with the height of header
							if( $initialOpacity == 1 ) {
								$output .='$(".header_spacer").height( $("#hgr_top_navbar_container").outerHeight() );';
							}
						
				$output .= '$(window).scroll(function(event){
						   var st = $(this).scrollTop();
						   if (st > lastScrollTop){
							   // downscroll code
							   if ($(window).scrollTop() > '.$scroll_amount.') {
									$("#hgr_top_navbar_container").slideUp(200, function() {
										$("#hgr_top_navbar_container").removeClass("displayed").addClass("hidden");
									});
								}
						   } else {
							  // upscroll code
							  $("#hgr_top_navbar_container").slideDown(200);
							  $("#hgr_top_navbar_container").removeClass("hidden").addClass("displayed");
						   }
						   lastScrollTop = st;
						});
					});';
		break;
		
		case '4': // SHRINK AFTER SCROLL - LEFT LOGO
			$scroll_amount = ( isset($hgr_options['header_shrink_after_scroll']['height']) && 
									$hgr_options['header_shrink_after_scroll']['height'] != 'px' ? 
									$hgr_options['header_shrink_after_scroll']['height']*1 : '$(window).height()');
			
			$menu_bar_initial_height	=	( isset($hgr_options['menu_bar_initial_height']['height']) && !empty($hgr_options['menu_bar_initial_height']['height']) ? $hgr_options['menu_bar_initial_height']['height'] : '80');
	  		$menu_bar_final_height		=	( isset($hgr_options['menu_bar_final_height']['height']) && !empty($hgr_options['menu_bar_final_height']['height']) ? $hgr_options['menu_bar_final_height']['height'] : '60');
			
			$initialHeaderHalfHeight	=	str_replace("px","",$menu_bar_initial_height) / 2;
			$finalHeaderHalfHeight		=	str_replace("px","",$menu_bar_final_height) / 2;
			
			$responsiveLogoMaxHeight	=	$menu_bar_initial_height - ($initialHeaderHalfHeight / 2);
			
			// Header Opacity Settings
			if( isset(	$hgr_options['header_opacity_change_after_scroll']) && 
									$hgr_options['header_opacity_change_after_scroll'] == 1) {
							$scroll_amount_change_color = ( isset (
								$hgr_options['header_background_opacity_change_after_amount']['height']) && 
								$hgr_options['header_background_opacity_change_after_amount']['height'] != 'px' ? 
								$hgr_options['header_background_opacity_change_after_amount']['height']*1 : '$(window).height()');
													
							$initialOpacity		=	$hgr_options['header_background_rgba']['alpha'];
							$afterScrollOpacity =	$hgr_options['header_background_opacity_after_scroll'];
			}
			
			$output = 'jQuery(document).ready(function($) {
						"use strict";
						var header_height = $("#hgr_top_navbar_container").outerHeight(true);
						var lastScrollTop = 0;
						
						var calculatedInitialHeight = ('.str_replace("px","",$menu_bar_initial_height).' * 0.8 );
						var calculatedFinalHeight = ('.str_replace("px","",$menu_bar_final_height).' * 0.8 );
						
						var calculatedInitialMargins = ('.str_replace("px","",$menu_bar_initial_height).' * 0.1 );
						var calculatedFinalMargins = ('.str_replace("px","",$menu_bar_final_height).' * 0.1 );
						
						var initialNavBarMargin		=	( calculatedInitialHeight - $("#main_navbar").outerHeight() ) / 2 ;
						var finalNavBarMargin		=	( calculatedFinalHeight - $("#main_navbar").outerHeight() ) / 2 ;
						
						// Set the initial and maxim header bar height
						$("#hgr_top_navbar_container").height("'.$menu_bar_initial_height.'").css("max-height", "'.$menu_bar_initial_height.'");
						
						// Set initial header bar container  and logo height
						$("#hgr_top_navbar_container .container, .hgr_identity a").height( calculatedInitialHeight );
						
						// Minicart height setting
						$("#hgr_top_navbar_extras .hgr_woo_minicart").height( calculatedInitialHeight ).css("line-height", calculatedInitialHeight + "px");
						//$(".fixed_menu_bottom_bar .hgr_woo_minicart").height( "'.$menu_bar_initial_height.'" );
						
						// Apply initial margins on container
						$("#hgr_top_navbar_container .container").css("margin-top", calculatedInitialMargins ).css("margin-bottom", calculatedInitialMargins );
						
						// Remove top-bottom paddings foe logo and navbar
						$("#hgr_top_navbar_container .hgr_identity, #hgr_top_navbar_container #main_navbar_container").addClass("noPaddingTopBottom");
						
						// Add initial navbar paddings
						$("#main_navbar").css("margin-top", initialNavBarMargin ).css("margin-bottom", initialNavBarMargin );
						
						$("#hgr_top_navbar_extras, #hgr_top_navbar_extras a").height( calculatedInitialHeight );
						$("#hgr_top_navbar_extras a").css( "line-height", calculatedInitialHeight + "px" );';
						
						// If header opacity is 1 we scroll down page with the height of header
						if( $initialOpacity == 1 ) {
							$output .='$(".header_spacer").height( $("#hgr_top_navbar_container").outerHeight() );';
						}
						
						
						
						$output .= '$(window).scroll(function(event){
						   var st = $(this).scrollTop();
						   if (st > lastScrollTop){
							   // downscroll code
							   if ($(window).scrollTop() > '.$scroll_amount.') {									
									// Set the final header bar height
									$("#hgr_top_navbar_container").height("'.$menu_bar_final_height.'").css("max-height", "'.$menu_bar_final_height.'");
									
									// Set initial header bar container  and logo height
									$("#hgr_top_navbar_container .container, .hgr_identity a").height( calculatedFinalHeight );
									
									// Apply final margins on container
									$("#hgr_top_navbar_container .container").css("margin-top", calculatedFinalMargins ).css("margin-bottom", calculatedFinalMargins );
									
									// Add final navbar paddings
									$("#main_navbar").css("margin-top", finalNavBarMargin ).css("margin-bottom", finalNavBarMargin );
									
									// Minicart height setting
									$("#hgr_top_navbar_extras .hgr_woo_minicart").height( calculatedFinalHeight ).css("line-height", calculatedFinalHeight + "px");
									
									// Extras div settings
									$("#hgr_top_navbar_extras, #hgr_top_navbar_extras a").height( calculatedFinalHeight );
									$("#hgr_top_navbar_extras a").css( "line-height", calculatedFinalHeight + "px" );
								}
						   } else if ($(window).scrollTop() < '.$scroll_amount.') {
							  // upscroll code
							  	// Set the initial and maxim header bar height
								$("#hgr_top_navbar_container").height("'.$menu_bar_initial_height.'").css("max-height", "'.$menu_bar_initial_height.'");
								
								// Set initial header bar container  and logo height
								$("#hgr_top_navbar_container .container, .hgr_identity a").height( calculatedInitialHeight );
								
								// Apply initial margins on container
								$("#hgr_top_navbar_container .container").css("margin-top", calculatedInitialMargins ).css("margin-bottom", calculatedInitialMargins );
								
								// Add initial navbar paddings
								$("#main_navbar").css("margin-top", initialNavBarMargin ).css("margin-bottom", initialNavBarMargin );
								
								// Minicart height setting
								$("#hgr_top_navbar_extras .hgr_woo_minicart").height( calculatedInitialHeight ).css("line-height", calculatedInitialHeight + "px");
								
								// Extras div settings
								$("#hgr_top_navbar_extras, #hgr_top_navbar_extras a").height( calculatedInitialHeight );
								$("#hgr_top_navbar_extras a").css( "line-height", calculatedInitialHeight + "px" );
						   }
						   lastScrollTop = st;
						});
					});';
		break;
		
		case '5': // Transparent, scrolls with page and then falls down after scrolling
		
			$scroll_amount = ( isset($hgr_options['header_transparent_display_after']['height']) && 
									$hgr_options['header_transparent_display_after']['height'] != 'px' ? 
									$hgr_options['header_transparent_display_after']['height']*1 : '$(window).height()');
			
			$afterScrollOpacity =	$hgr_options['header_transp_bg_opacity_after_scroll'];
			
			//$header_size_before_scroll = $hgr_options['header_size_before_scroll']['height'];
			$header_top_padding_after_scroll = ( isset($hgr_options['menu_bar_padding_end']['margin-top']) ? $hgr_options['menu_bar_padding_end']['margin-top'] : '0');
			
			$output = 'jQuery(document).ready(function($) {
					"use strict";
					var header_height = $("#hgr_top_navbar_container").outerHeight(true);
					var hasBeenTrigged = false;
					
					$("#hgr_top_navbar_extras .hgr_woo_minicart, #hgr_top_navbar_extras, #hgr_top_navbar_extras a").height($( "#hgr_top_navbar_container").outerHeight(true) );
					$(".fixed_menu_bottom_bar .hgr_woo_minicart").height($( ".fixed_menu_bottom_bar").outerHeight(true) );
					$("#hgr_top_navbar_extras a").css( "line-height", $("#hgr_top_navbar_container").outerHeight() + "px" );';
					
					if( !$specialHeader ) {
						$output .= '$("#hgr_top_navbar_container").css("background-color","rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , 0)");';
					}
					
			$output .= '
					function doTheStickyHeader() {
						// Do we have the admin bar on?
							var adminBarHeight = ( $("body").hasClass("admin-bar") ) ? "32px" : 0;
						
						// Window scroll position Y
							var winYval = $(window).scrollTop();
						
						// Do the tricks
						if ( winYval > '.$scroll_amount.'  && !hasBeenTrigged ) {
							$("#hgr_top_navbar_container").css("top",-header_height);
							$("#hgr_top_navbar_container").addClass("stickyHeader").css("background-color","rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')").animate({
								"top": adminBarHeight
							},300);
							hasBeenTrigged = true;
							
						}
						if( winYval < '.$scroll_amount.' && $("#hgr_top_navbar_container").hasClass("stickyHeader")  && hasBeenTrigged ){
							$("#hgr_top_navbar_container").animate({"top": -header_height}, 300, function() {
								$("#hgr_top_navbar_container").css("top",adminBarHeight).removeClass("stickyHeader").css("display","block").css("background-color","rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , 0)");
							  });
							hasBeenTrigged = false;
						}
						
					}';
					if( !$specialHeader ) {
						$output .='$(window).scroll(function(){
										// Do the sticky header
										doTheStickyHeader();
									});';
					}
					
				$output .='});';
		break;
		
		
		case '6': // Complex: Fixed one + another one apear after scrolling down
			$scroll_amount = ( isset($hgr_options['header_floating_display_after']['height']) && 
									$hgr_options['header_floating_display_after']['height'] != 'px' ? 
									$hgr_options['header_floating_display_after']['height']*1 : '$(window).height()');
			
			$output = 'jQuery(document).ready(function($) {
					"use strict";
					$("#hgr_top_navbar_extras .hgr_woo_minicart, #hgr_top_navbar_extras, #hgr_top_navbar_extras a").height($( "#hgr_top_navbar_container").height() );
					$(".fixed_menu_bottom_bar .hgr_woo_minicart").height($( ".fixed_menu_bottom_bar").outerHeight(true) );
					$(".fixed_menu_bottom_bar .woo_bubble").css("top", -$( ".fixed_menu_bottom_bar").outerHeight(true) / 2);
					
					$("#hgr_top_navbar_extras a").css( "line-height", $("#hgr_top_navbar_container").outerHeight() + "px" );

					if($(window).height() < $("body").prop("scrollHeight")) {
						//$("#hgr_top_navbar_container").css("display","block").css("transform", "translateY(-100%)");
					}
							
					$(window).bind("scroll", function() {
							if ($(window).scrollTop() > '.$scroll_amount.') {
								$("#hgr_top_navbar_container").removeClass("headerhidden").addClass("headerappear");
							}
							if ($(window).scrollTop() < '.$scroll_amount.') {
								$("#hgr_top_navbar_container").removeClass("headerappear").addClass("headerhidden");
							}
						});
					
				});';
		break;
		
		case '7': // FIXED HEADER CENTRAL LOGO
			$output = ' jQuery(document).ready(function($) {
						"use strict";
						var hasBeenTrigged = false;
						var header_height = $("#hgr_top_navbar_container").outerHeight(true);
						$("#hgr_top_navbar_extras .hgr_woo_minicart, #hgr_top_navbar_extras, #hgr_top_navbar_extras a").height( $("#hgr_top_navbar_container").outerHeight() );
						$("#hgr_top_navbar_extras a").css( "line-height", $("#hgr_top_navbar_container").outerHeight() + "px" );
						//$(".fixed_menu_bottom_bar .hgr_woo_minicart").height($( ".fixed_menu_bottom_bar").outerHeight(true) );
						';
						
						
						if( $original_header_type != 1 && $header_type == 1 ) {
							$output .= '$("#hgr_top_navbar_container").addClass("finalHeaderSize").css("position", "fixed").css("display", "block");';
						}
						
	
						if( isset(	$hgr_options['header_opacity_change_after_scroll']) && 
									$hgr_options['header_opacity_change_after_scroll'] == 1) {
							$scroll_amount_change_color = ( isset (
								$hgr_options['header_background_opacity_change_after_amount']['height']) && 
								$hgr_options['header_background_opacity_change_after_amount']['height'] != 'px' ? 
								$hgr_options['header_background_opacity_change_after_amount']['height']*1 : '$(window).height()');
													
							$initialOpacity		=	$hgr_options['header_background_rgba']['alpha'];
							$afterScrollOpacity =	$hgr_options['header_background_opacity_after_scroll'];
							
												
							$output .= '$("#hgr_top_navbar_container .dropdown-menu").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);
										if ($(window).scrollTop() > '.$scroll_amount_change_color.' ) {
										$("#hgr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);
										
										}';
							
							// If header opacity is 1 we scroll down page with the height of header
							if( $initialOpacity == 1 ) {
								$output .='$(".header_spacer").height( $("#hgr_top_navbar_container").outerHeight() );';
							} else {
								// daca opacitatea este alta decat 1
								// modificam alpha initial al headerului
								$output .='$("#hgr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , '.$initialOpacity.')"}, 1);';
							}
							
							
							if( $original_header_type != 1 && $header_type == 1 || !is_front_page() ) {
								
								if( $detect->isMobile() ) {
									// If not FIXED by settings, and mobile, fixed and with background
									$output .= '$("#hgr_top_navbar_container").removeClass("finalHeaderSize").css("position", "fixed").css("padding-top", "0px").css("padding-bottom", "0px").css("padding-left", "20px").css("padding-right", "20px");';
									$output .= '$("#hgr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);';
								} else {
									$output .= '$("#hgr_top_navbar_container").addClass("finalHeaderSize").css("position", "fixed");';
									$output .= '$("#hgr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);';
								}
							} 
							// If mobile, fixed and with background
							else if( $detect->isMobile() ) {
								
								//$output .= '$("#hgr_top_navbar_container").addClass("finalHeaderSize").css("position", "fixed");';
								$output .= '$("#hgr_top_navbar_container").removeClass("finalHeaderSize").css("position", "fixed").css("padding-top", "0px").css("padding-bottom", "0px").css("padding-top", "0px").css("padding-bottom", "0px").css("padding-left", "20px").css("padding-right", "20px");';
								$output .= '$("#hgr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);';
							}
							else {
								$output .= '$(window).bind("scroll", function() {
									
									if ($(window).scrollTop() > '.$scroll_amount_change_color.' && !hasBeenTrigged ) {
										$("#hgr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);
										hasBeenTrigged = true;
										
									}
									if ($(window).scrollTop() < '.$scroll_amount_change_color.' && hasBeenTrigged ) {
										$("#hgr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , '.$initialOpacity.')"}, 500);
										hasBeenTrigged = false;
										
									}
								});';
							}
								
					
						}
			
			$output .=' });';
		break;
		
		
		case '8': // APPEAR AFTER SCROLL - CENTRAL LOGO
			$scroll_amount = ( isset($hgr_options['header_floating_display_after']['height']) && 
									$hgr_options['header_floating_display_after']['height'] != 'px' ? 
									$hgr_options['header_floating_display_after']['height']*1 : '$(window).height()');
			
			$output = 'jQuery(document).ready(function($) {
					"use strict";
					
					$("#hgr_top_navbar_extras .hgr_woo_minicart, #hgr_top_navbar_extras, #hgr_top_navbar_extras a").height($( "#hgr_top_navbar_container").outerHeight(true) );
					$(".fixed_menu_bottom_bar .hgr_woo_minicart").height($( ".fixed_menu_bottom_bar").outerHeight(true) );
					$("#hgr_top_navbar_extras a").css( "line-height", $("#hgr_top_navbar_container").outerHeight() + "px" );
					
					if($(window).height() < $("body").prop("scrollHeight")) {
					
						$("#hgr_top_navbar_container").removeClass("displayed").addClass("hidden");
						$(window).bind("scroll", function() {
								if ($(window).scrollTop() > '.$scroll_amount.') {
									$("#hgr_top_navbar_container").slideDown(200);
									$("#hgr_top_navbar_container").removeClass("hidden").addClass("displayed");
									
									$("#hgr_top_navbar_extras .hgr_woo_minicart, #hgr_top_navbar_extras, #hgr_top_navbar_extras a").height($( "#hgr_top_navbar_container").outerHeight(true) );
									$("#hgr_top_navbar_extras a").css( "line-height", $("#hgr_top_navbar_container").outerHeight() + "px" );
								}
								if ($(window).scrollTop() < '.$scroll_amount.') {
									$("#hgr_top_navbar_container").slideUp(200, function() {
										$("#hgr_top_navbar_container").removeClass("displayed").addClass("hidden");
									});
								}
							});
					}
				});';
		break;
		
		case '9': // DISAPPEAR AFTER SCROLL - CENTRAL LOGO
			$scroll_amount = ( isset($hgr_options['header_floating_hide_after']['height']) && 
									$hgr_options['header_floating_hide_after']['height'] != 'px' ? 
									$hgr_options['header_floating_hide_after']['height']*1 : '$(window).height()');
									
			if( isset(	$hgr_options['header_opacity_change_after_scroll']) && 
									$hgr_options['header_opacity_change_after_scroll'] == 1) {
							$scroll_amount_change_color = ( isset (
								$hgr_options['header_background_opacity_change_after_amount']['height']) && 
								$hgr_options['header_background_opacity_change_after_amount']['height'] != 'px' ? 
								$hgr_options['header_background_opacity_change_after_amount']['height']*1 : '$(window).height()');
													
							$initialOpacity		=	$hgr_options['header_background_rgba']['alpha'];
							$afterScrollOpacity =	$hgr_options['header_background_opacity_after_scroll'];
			}
			
			$output = 'jQuery(document).ready(function($) {
						"use strict";
						var header_height = $("#hgr_top_navbar_container").outerHeight(true);
						var lastScrollTop = 0;						
						$("#hgr_top_navbar_extras .hgr_woo_minicart, #hgr_top_navbar_extras, #hgr_top_navbar_extras a").height($( "#hgr_top_navbar_container").outerHeight(true) );
						$(".fixed_menu_bottom_bar .hgr_woo_minicart").height($( ".fixed_menu_bottom_bar").outerHeight(true) );
						$("#hgr_top_navbar_extras a").css( "line-height", $("#hgr_top_navbar_container").outerHeight() + "px" );';
						
						// If header opacity is 1 we scroll down page with the height of header
						if( $initialOpacity == 1 ) {
							$output .='$(".header_spacer").height( $("#hgr_top_navbar_container").outerHeight() );';
						}
						
				$output .= '$(window).scroll(function(event){
						   var st = $(this).scrollTop();
						   if (st > lastScrollTop){
							   // downscroll code
							   if ($(window).scrollTop() > '.$scroll_amount.') {
									$("#hgr_top_navbar_container").slideUp(200, function() {
										$("#hgr_top_navbar_container").removeClass("displayed").addClass("hidden");
									});
								}
						   } else {
							  // upscroll code
							  $("#hgr_top_navbar_container").slideDown(200);
							  $("#hgr_top_navbar_container").removeClass("hidden").addClass("displayed");
						   }
						   lastScrollTop = st;
						});
					});';
		break;
		
		case '10': // SHRINK AFTER SCROLL - CENTRAL LOGO
			$scroll_amount = ( isset($hgr_options['header_shrink_after_scroll']['height']) && 
									$hgr_options['header_shrink_after_scroll']['height'] != 'px' ? 
									$hgr_options['header_shrink_after_scroll']['height']*1 : '$(window).height()');
			
			$menu_bar_initial_height	=	( isset($hgr_options['menu_bar_initial_height']['height']) && !empty($hgr_options['menu_bar_initial_height']['height']) ? $hgr_options['menu_bar_initial_height']['height'] : '80');
	  		$menu_bar_final_height		=	( isset($hgr_options['menu_bar_final_height']['height']) && !empty($hgr_options['menu_bar_final_height']['height']) ? $hgr_options['menu_bar_final_height']['height'] : '60');
			
			$initialHeaderHalfHeight	=	str_replace("px","",$menu_bar_initial_height) / 2;
			$finalHeaderHalfHeight		=	str_replace("px","",$menu_bar_final_height) / 2;
			
			$responsiveLogoMaxHeight	=	$menu_bar_initial_height - ($initialHeaderHalfHeight / 2);
			
			if( isset(	$hgr_options['header_opacity_change_after_scroll']) && 
									$hgr_options['header_opacity_change_after_scroll'] == 1) {
							$scroll_amount_change_color = ( isset (
								$hgr_options['header_background_opacity_change_after_amount']['height']) && 
								$hgr_options['header_background_opacity_change_after_amount']['height'] != 'px' ? 
								$hgr_options['header_background_opacity_change_after_amount']['height']*1 : '$(window).height()');
													
							$initialOpacity		=	$hgr_options['header_background_rgba']['alpha'];
							$afterScrollOpacity =	$hgr_options['header_background_opacity_after_scroll'];
			}
			
			$output = 'jQuery(document).ready(function($) {
						"use strict";
						var header_height = $("#hgr_top_navbar_container").outerHeight(true);
						var lastScrollTop = 0;
						
						var calculatedInitialHeight = ('.str_replace("px","",$menu_bar_initial_height).' * 0.8 );
						var calculatedFinalHeight = ('.str_replace("px","",$menu_bar_final_height).' * 0.8 );
						
						var calculatedInitialMargins = ('.str_replace("px","",$menu_bar_initial_height).' * 0.1 );
						var calculatedFinalMargins = ('.str_replace("px","",$menu_bar_final_height).' * 0.1 );
						
						var initialNavBarMargin		=	( calculatedInitialHeight - $("#main_navbar").outerHeight() ) / 2 ;
						var finalNavBarMargin		=	( calculatedFinalHeight - $("#main_navbar").outerHeight() ) / 2 ;
						
						// Set the initial and maxim header bar height
						$("#hgr_top_navbar_container").height("'.$menu_bar_initial_height.'").css("max-height", "'.$menu_bar_initial_height.'");
						
						// Set initial header bar container  and logo height
						$("#hgr_top_navbar_container .container, .hgr_identity a").height( calculatedInitialHeight );
						
						// Minicart height setting
						//$("#hgr_top_navbar_extras .hgr_woo_minicart").height( calculatedInitialHeight ).css("line-height", calculatedInitialHeight + "px");
						//$(".fixed_menu_bottom_bar .hgr_woo_minicart").height( "'.$menu_bar_initial_height.'" );
						
						// Apply initial margins on container
						$("#hgr_top_navbar_container .container").css("margin-top", calculatedInitialMargins ).css("margin-bottom", calculatedInitialMargins );
						
						// Remove top-bottom paddings for logo and navbar
						$("#hgr_top_navbar_container .hgr_identity, #hgr_top_navbar_container #main_navbar_container, #hgr_top_navbar_container #main_navbar_container_left").addClass("noPaddingTopBottom");
						
						// Add initial navbar paddings
						$("#main_navbar, #main_navbar_left").css("margin-top", initialNavBarMargin ).css("margin-bottom", initialNavBarMargin );
						
						$("#hgr_top_navbar_extras, #hgr_top_navbar_extras a").height( calculatedInitialHeight );
						$("#hgr_top_navbar_extras a").css( "line-height", calculatedInitialHeight + "px" );';
					
					// If header opacity is 1 we scroll down page with the height of header
					if( $initialOpacity == 1 ) {
						$output .='$(".header_spacer").height( $("#hgr_top_navbar_container").outerHeight() );';
					}
					
						
						
					$output .= '$(window).scroll(function(event){
						   var st = $(this).scrollTop();
						   if (st > lastScrollTop){
							   // downscroll code
							   if ($(window).scrollTop() > '.$scroll_amount.') {									
									// Set the final header bar height
									$("#hgr_top_navbar_container").height("'.$menu_bar_final_height.'").css("max-height", "'.$menu_bar_final_height.'");
									
									// Set initial header bar container  and logo height
									$("#hgr_top_navbar_container .container, .hgr_identity a").height( calculatedFinalHeight );
									
									// Apply final margins on container
									$("#hgr_top_navbar_container .container").css("margin-top", calculatedFinalMargins ).css("margin-bottom", calculatedFinalMargins );
									
									// Add final navbar paddings
									$("#main_navbar, #main_navbar_left").css("margin-top", finalNavBarMargin ).css("margin-bottom", finalNavBarMargin );
									
									// Minicart height setting
									$("#hgr_top_navbar_extras .hgr_woo_minicart").height( calculatedFinalHeight ).css("line-height", calculatedFinalHeight + "px");
									
									// Extras div settings
									$("#hgr_top_navbar_extras, #hgr_top_navbar_extras a").height( calculatedFinalHeight );
									$("#hgr_top_navbar_extras a").css( "line-height", calculatedFinalHeight + "px" );
								}
						   } else if ($(window).scrollTop() < '.$scroll_amount.') {
							  // upscroll code
							  	// Set the initial and maxim header bar height
								$("#hgr_top_navbar_container").height("'.$menu_bar_initial_height.'").css("max-height", "'.$menu_bar_initial_height.'");
								
								// Set initial header bar container  and logo height
								$("#hgr_top_navbar_container .container, .hgr_identity a").height( calculatedInitialHeight );
								
								// Apply initial margins on container
								$("#hgr_top_navbar_container .container").css("margin-top", calculatedInitialMargins ).css("margin-bottom", calculatedInitialMargins );
								
								// Add initial navbar paddings
								$("#main_navbar, #main_navbar_left").css("margin-top", initialNavBarMargin ).css("margin-bottom", initialNavBarMargin );
								
								// Minicart height setting
								$("#hgr_top_navbar_extras .hgr_woo_minicart").height( calculatedInitialHeight ).css("line-height", calculatedInitialHeight + "px");
								
								// Extras div settings
								$("#hgr_top_navbar_extras, #hgr_top_navbar_extras a").height( calculatedInitialHeight );
								$("#hgr_top_navbar_extras a").css( "line-height", calculatedInitialHeight + "px" );
						   }
						   lastScrollTop = st;
						});
					});';
		break;
		
		case '11':	// TRANSPARENT BEFORE SCROLL - CENTRAL LOGO 
					// Scrolls with page and then falls down after scrolling
		
			$scroll_amount = ( isset($hgr_options['header_transparent_display_after']['height']) && 
									$hgr_options['header_transparent_display_after']['height'] != 'px' ? 
									$hgr_options['header_transparent_display_after']['height']*1 : '$(window).height()');
			
			$afterScrollOpacity =	$hgr_options['header_transp_bg_opacity_after_scroll'];
			
			//$header_size_before_scroll = $hgr_options['header_size_before_scroll']['height'];
			$header_top_padding_after_scroll = ( isset($hgr_options['menu_bar_padding_end']['margin-top']) ? $hgr_options['menu_bar_padding_end']['margin-top'] : '0');
			
			$output = 'jQuery(document).ready(function($) {
					"use strict";
					var header_height = $("#hgr_top_navbar_container").outerHeight(true);
					var hasBeenTrigged = false;
					
					$("#hgr_top_navbar_extras .hgr_woo_minicart, #hgr_top_navbar_extras, #hgr_top_navbar_extras a").height($( "#hgr_top_navbar_container").outerHeight(true) );
					$(".fixed_menu_bottom_bar .hgr_woo_minicart").height($( ".fixed_menu_bottom_bar").outerHeight(true) );
					$("#hgr_top_navbar_extras a").css( "line-height", $("#hgr_top_navbar_container").outerHeight() + "px" );
					  
					
					// Set transparency and position for header
						$("#hgr_top_navbar_container").css("background-color","rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , 0)");
					
					function doTheStickyHeader() {
						// Do we have the admin bar on?
							var adminBarHeight = ( $("body").hasClass("admin-bar") ) ? "32px" : 0;
						
						// Window scroll position Y
							var winYval = $(window).scrollTop();
						
						// Do the tricks
						if ( winYval > '.$scroll_amount.'  && !hasBeenTrigged ) {
							$("#hgr_top_navbar_container").css("top",-header_height);
							$("#hgr_top_navbar_container").addClass("stickyHeader").css("background-color","rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')").animate({
								"top": adminBarHeight
							},300);
							hasBeenTrigged = true;
							
						}
						if( winYval < '.$scroll_amount.' && $("#hgr_top_navbar_container").hasClass("stickyHeader")  && hasBeenTrigged ){
							$("#hgr_top_navbar_container").animate({"top": -header_height}, 300, function() {
								$("#hgr_top_navbar_container").css("top",0).removeClass("stickyHeader").css("display","block").css("background-color","rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , 0)");
							  });
							hasBeenTrigged = false;
						}
						
					}
					$(window).scroll(function(){
						// Do the sticky header
						doTheStickyHeader();
					});
				});';
		break;
		
		default: // Fixed - DEFAULT
		
			$output = ' jQuery(document).ready(function($) {
						"use strict";
						var hasBeenTrigged = false;
						var header_height = $("#hgr_top_navbar_container").outerHeight(true);
						
						$("#hgr_top_navbar_extras .hgr_woo_minicart, #hgr_top_navbar_extras, #hgr_top_navbar_extras a").height( $("#hgr_top_navbar_container").outerHeight() );
						$(".fixed_menu_bottom_bar .hgr_woo_minicart").height($( ".fixed_menu_bottom_bar").outerHeight(true) );				
						$("#hgr_top_navbar_extras a").css( "line-height", $("#hgr_top_navbar_container").outerHeight() + "px" );
						';
						
						
						if( $original_header_type != 1 && $header_type == 1 ) {
							$output .= '$("#hgr_top_navbar_container").addClass("finalHeaderSize").css("position", "fixed").css("display", "block");';
						}
						
	
						if( isset(	$hgr_options['header_opacity_change_after_scroll']) && 
									$hgr_options['header_opacity_change_after_scroll'] == 1) {
							$scroll_amount_change_color = ( isset (
								$hgr_options['header_background_opacity_change_after_amount']['height']) && 
								$hgr_options['header_background_opacity_change_after_amount']['height'] != 'px' ? 
								$hgr_options['header_background_opacity_change_after_amount']['height']*1 : '$(window).height()');
													
							$initialOpacity		=	$hgr_options['header_background_rgba']['alpha'];
							$afterScrollOpacity =	$hgr_options['header_background_opacity_after_scroll'];
							
												
							$output .= '$("#hgr_top_navbar_container .dropdown-menu").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);
										if ($(window).scrollTop() > '.$scroll_amount_change_color.' ) {
										$("#hgr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);
										
										}';
							
							// If header opacity is 1 we scroll down page with the height of header
							if( $initialOpacity == 1 ) {
								$output .='$(".header_spacer").height( $("#hgr_top_navbar_container").outerHeight() );';
							}
							
							/*if( $original_header_type != 1 && $header_type == 1 || !is_front_page() ) {
								
								if( $detect->isMobile() ) {
									// If not FIXED by settings, and mobile, fixed and with background
									$output .= '$("#hgr_top_navbar_container").removeClass("finalHeaderSize").css("position", "fixed").css("padding-top", "0px").css("padding-bottom", "0px").css("padding-left", "20px").css("padding-right", "20px");';
									$output .= '$("#hgr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);';
								} else {
									$output .= '$("#hgr_top_navbar_container").addClass("finalHeaderSize").css("position", "fixed");';
									$output .= '$("#hgr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);';
								}
							} 
							// If mobile, fixed and with background
							else */
							
							if( $detect->isMobile() ) {
								
								//$output .= '$("#hgr_top_navbar_container").addClass("finalHeaderSize").css("position", "fixed");';
								$output .= '$("#hgr_top_navbar_container").removeClass("finalHeaderSize").css("position", "fixed").css("padding-top", "0px").css("padding-bottom", "0px").css("padding-top", "0px").css("padding-bottom", "0px").css("padding-left", "20px").css("padding-right", "20px");';
								$output .= '$("#hgr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);';
							}
							else {
								$output .= '$(window).bind("scroll", function() {
									
									if ($(window).scrollTop() > '.$scroll_amount_change_color.' && !hasBeenTrigged ) {
										$("#hgr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , '.$afterScrollOpacity.')"}, 500);
										hasBeenTrigged = true;
										
									}
									if ($(window).scrollTop() < '.$scroll_amount_change_color.' && hasBeenTrigged ) {
										$("#hgr_top_navbar_container").animate({backgroundColor: "rgba('.Redux_Helpers::hex2rgba($hgr_options['header_background_rgba']['color']).' , '.$initialOpacity.')"}, 500);
										hasBeenTrigged = false;
										
									}
								});';
							}
								
					
						}
			
			$output .=' });';
		break;
	}
	wp_add_inline_script( 'upshot_js', $output, 'after' );
	
	}
	add_action( 'wp_enqueue_scripts', 'upshot_do_header' );


 // Custom search form
 function upshot_search_form( $form ) {
    $form = '<form method="get" id="searchform" class="searchform" action="' . esc_url( home_url( '/' ) ) . '" >
    <div>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'. esc_html__( 'Search','upshot' ) .'" />
    <input type="submit" id="searchsubmit" value="'. esc_html__( 'Search','upshot' ) .'" />
    </div>
    </form>';

    return $form;
 }
 add_filter( 'get_search_form', 'upshot_search_form' );

 
 
  
 
 // Include the Redux Framework
	if ( !class_exists( 'ReduxFramework' ) && file_exists( trailingslashit( get_template_directory() ) . 'highgrade/framework/framework.php' ) ) {
		require_once( trailingslashit( get_template_directory() ) . 'highgrade/framework/framework.php' );
	}
	if ( file_exists( trailingslashit( get_template_directory() ) . 'highgrade/config.php' ) ) {
		require_once( trailingslashit( get_template_directory() ) . 'highgrade/config.php' );
	}

// Custom CSS for Highgrade Framework admin panel
	function upshot_addAndOverridePanelCSS() {
	  wp_dequeue_style( 'redux-css' );
	  wp_register_style(
		'highgrade-css',
		get_template_directory_uri().'/highgrade/css/framework.css',
		array(),
		time(),
		'all'
	  );    
	  wp_enqueue_style('highgrade-css');
	}
	add_action( 'redux/page/hgr_options/enqueue', 'upshot_addAndOverridePanelCSS' );
	
	add_action('admin_head', 'upshot_custom_meta_css');
	function upshot_custom_meta_css() {
	  $custom_meta_css =  '
		#hgr_metaboxid label {
		  display: inline-block;
		  min-width:170px;
		} 
		#hgr_metaboxid .settBlock {
		  display: block;
		  margin-bottom:5px;
		} 
		#hgr_metaboxid input[type="text"], #hgr_metaboxid select {
		  width: 120px;
		}
		.wp-picker-container{
			vertical-align:middle;
		}
	  ';
		wp_add_inline_style( 'upshot_custom-styles', esc_attr($custom_meta_css) );
	}
	
	function upshot_get_post_meta_by_key() {
		global $wpdb;
		$vc_styles = '';
		$key = '_wpb_shortcodes_custom_css';
		
		$sql		=	$wpdb->prepare( "SELECT DISTINCT `meta_value` FROM $wpdb->postmeta WHERE `meta_key` = %s", $key );
		$meta		=	$wpdb->get_results( $sql );

		if ( !empty($meta) ) {
			foreach($meta as $custom_style){
				$vc_styles .= $custom_style->meta_value;
			}
			wp_add_inline_style( 'upshot_custom-styles', esc_attr($vc_styles) );
		}
		return false;
	}
	add_action( 'wp_enqueue_scripts', 'upshot_get_post_meta_by_key' );
	
	
	function upshot_get_custom_css() {
		$hgr_options = get_option( 'redux_options' );
		if ( isset($hgr_options['enable_css-code']) && $hgr_options['enable_css-code'] == 'custom_css_on') {
			if( !empty($hgr_options['css-code']) ){
				wp_add_inline_style( 'upshot_custom-styles', esc_attr($hgr_options['css-code']) );			 
			}
		}
		return false;
	}
	add_action( 'wp_enqueue_scripts', 'upshot_get_custom_css' );
	

	

/*
* HGR Menu Fallback
*/
function upshot_menu_fallback(){
	echo '<ul id="mainNavUl" class="nav navbar-nav navbar-right"><li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-480 current_page_item"><a href="' . esc_url( home_url( '/' ) ) . '">'. esc_html__( 'Home','upshot' ) .'</a></li></ul>';
}



/*
*	OneClick Install DEMO
*/
require_once( trailingslashit( get_template_directory() ) . 'highgrade/hgr_oci/hgr_oci.php' );




/*
*	Remove Redux demo links
*/
function upshot_removeDemoModeLink() {
    if ( class_exists('ReduxFramework') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFramework::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFramework') ) {
        remove_action('admin_notices', array( ReduxFramework::get_instance(), 'admin_notices' ) );    
    }
}
add_action('init', 'upshot_removeDemoModeLink');



/** remove redux menu under the tools **/
add_action( 'admin_menu', 'upshot_remove_redux_menu',12 );
function upshot_remove_redux_menu() {
    remove_submenu_page('tools.php','redux-about');
}

add_action( 'admin_bar_menu', 'upshot_remove_element_from_adminbar', 999 );
function upshot_remove_element_from_adminbar( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'theme_options' );
}


/*
*	Full Screen Search
*	Hooked into wp_footer (see constructor function above)
*	@since 1.0.0
*/
// Hook FS Search into footer
add_action('wp_footer', 'do_fssearch' );
function do_fssearch(){
	
	$hgr_options = get_option( 'redux_options' );
	
	$only_products = ( is_array($hgr_options) && isset( $hgr_options['enable_fssearch_onlu_for_products'] ) && $hgr_options['enable_fssearch_onlu_for_products'] == 1 ? '<input type="hidden" value="product" name="post_type"></input>' : '' );
	
		
	$output = '<div id="fssearch_container" class="hidden">';
		$output .= '<a class="close-btn" href="#0">Close</a><span class="fssearch_tip">'.esc_attr( "Type and hit enter", 'hgressentials' ).'</span>';
		$output .= '<form role="search" method="get" id="searchform" class="searchform" action="'.esc_url( home_url( '/' ) ).'">
					<div>
						<input type="text" value="'.get_search_query().'" name="s" id="s" class="fssearch_input" autocomplete="off" spellcheck="false" />
						'.$only_products.'
						<input type="submit" id="searchsubmit" value="Search" class="fssearch_submit" />
					</div>
				</form>';
	$output .= '</div><!-- fssearch_container END -->';
	echo ($output);
}
		

/*
*	Dinamic Styles based on Theme options
*/
 function upshot_styles(){
 	$hgr_options = get_option( 'redux_options' );
	$output = '';
	$output .= '
		.wpb_btn-success, #itemcontainer-controller {
			background-color: '.$hgr_options['theme_dominant_color'].'!important;
		}
		.hoveredIcon {
			color:'.$hgr_options['theme_dominant_color'].'>!important;
		}
		
		.topborder h3 a {
			border-top: 1px solid '.$hgr_options['theme_dominant_color'].';
		}
		ul.nav a.active {
			color: '.$hgr_options['theme_dominant_color'].' !important;
		}
		.testimonial_text{
			margin-bottom:60px;
		}';
	 
		if( class_exists( 'WooCommerce' ) && !empty($hgr_options['woo_support']) && $hgr_options['woo_support'] == 1 ) :

	$output .= '/* woocommerce */
		body.woocommerce{
			background-color: '.$hgr_options['shop_bg_color'].';
		}
		.woocommerce span.onsale, .woocommerce-page span.onsale {
			background-color: '.$hgr_options['theme_dominant_color'].'!important;
		}
		.woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li span.current {
			background: none repeat scroll 0% 0% '.$hgr_options['theme_dominant_color'].'!important;
			border: 2px solid '.$hgr_options['theme_dominant_color'].' !important;
		}
		.woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li a:hover {
			background-color: '.$hgr_options['theme_dominant_color'].' !important;
			border: 2px solid '.$hgr_options['theme_dominant_color'].' !important;
		}
		.woocommerce #content div.product form.cart .button, .woocommerce div.product form.cart .button, .woocommerce-page #content div.product form.cart .button, .woocommerce-page div.product form.cart .button {
			background: none repeat scroll 0% 0% '.$hgr_options['theme_dominant_color'].' !important;
		}
		.woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active {
			border-bottom-color: '.$hgr_options['theme_dominant_color'].' !important;
		}
		.woocommerce #reviews #comments ol.commentlist li .comment-text, .woocommerce-page #reviews #comments ol.commentlist li .comment-text {
			background-color: '.$hgr_options['theme_dominant_color'].' !important;
		}
		.woocommerce p.stars a, .woocommerce-page p.stars a{
			color:'.$hgr_options['theme_dominant_color'].'!important;
		}
		.woocommerce #content .quantity .minus:hover, .woocommerce #content .quantity .plus:hover, .woocommerce .quantity .minus:hover, .woocommerce .quantity .plus:hover, .woocommerce-page #content .quantity .minus:hover, .woocommerce-page #content .quantity .plus:hover, .woocommerce-page .quantity .minus:hover, .woocommerce-page .quantity .plus:hover {
			background-color: '.$hgr_options['theme_dominant_color'].' !important;
		}
		
		.woocommerce ul.products li.product h3, .woocommerce-page ul.products li.product h3 {
			font-size: '.$hgr_options['shop_h3_font']['font-size'].'!important;
			line-height: '.$hgr_options['shop_h3_font']['line-height'].'!important;
			color: '.$hgr_options['shop_h3_font']['color'].'!important;
		}
		.woocommerce #respond input#submit, .woocommerce-page #respond input#submit, .woocommerce #respond input#submit:hover, .woocommerce-page #respond input#submit:hover {
			background-color: '.$hgr_options['theme_dominant_color'].' !important;
		}
		.woocommerce .woocommerce-message, .woocommerce-page .woocommerce-message, .woocommerce .woocommerce-info, .woocommerce-page .woocommerce-info {	
			background-color: '.$hgr_options['theme_dominant_color'].' !important;
		}
		.woocommerce table.shop_table thead span, .woocommerce-page table.shop_table thead span {
			border-bottom: 1px solid '.$hgr_options['theme_dominant_color'].';
		}
		.proceed_button{
			border: 2px solid '.$hgr_options['theme_dominant_color'].'!important;
			background-color:'.$hgr_options['theme_dominant_color'].'!important;
		}
		.woocommerce .cart-collaterals .shipping-calculator-button{
			color:'.$hgr_options['theme_dominant_color'].';
		}
		.checkout_apply_coupon{
			border: 2px solid '.$hgr_options['theme_dominant_color'].';
			background-color: '.$hgr_options['theme_dominant_color'].';
		}
		#place_order {
			border: 2px solid '.$hgr_options['theme_dominant_color'].' !important;
			background-color: '.$hgr_options['theme_dominant_color'].' !important;
		}
		.login_btn_hgr, .hgr_woobutton{
			border: 2px solid '.$hgr_options['theme_dominant_color'].';
			background-color: '.$hgr_options['theme_dominant_color'].';
		}
		.thankyoutext{color:'.$hgr_options['theme_dominant_color'].';}
		#my-account h4.inline{
			border-bottom: 1px solid '.$hgr_options['theme_dominant_color'].';
		}
		#my-account a{
		color:'.$hgr_options['theme_dominant_color'].';
		}
		.hgr_woo_minicart .woo_bubble{
			background-color: '.$hgr_options['woo_bubble_color']['regular'].';
		}
		.hgr_woo_minicart .woo_bubble:hover{
			background-color: '.$hgr_options['woo_bubble_color']['hover'].';
		}
		.woocommerce a.added_to_cart {
			margin-left: auto;
			margin-right: auto;
			width: 100%;
			text-align: center;
			color:#000;
			background-color: '.$hgr_options['theme_dominant_color'].';
		}
		.woocommerce a.added_to_cart:hover {
			color:#fff;
		}
		.woocommerce .woocommerce-message a:hover, .woocommerce-page .woocommerce-message a:hover {
			color: #FFF;
		}
		.woocommerce .bka_footer.dark_scheme a{
			color:'.$hgr_options['ahref_color']['regular'].';
		}
		.woocommerce .bka_footer.light_scheme a{
			color:'.$hgr_options['light_ahref_color']['regular'].';
		}
		.woocommerce .bka_footer.dark_scheme a:hover{
			color:'.$hgr_options['ahref_color']['hover'].';
		}
		.woocommerce .bka_footer.light_scheme a:hover{
			color:'.$hgr_options['light_ahref_color']['hover'].';
		}
		/* woocommerce end */';
		
	endif; // end if woo_support enabled
	wp_add_inline_style( 'upshot_custom-styles', esc_attr($output) );
 }
 add_action( 'wp_enqueue_scripts', 'upshot_styles' );

 // Register Custom Navigation Walker
 require_once( trailingslashit( get_template_directory() ) . 'highgrade/hgr_navwalker.php');
	
	
	
 // WOOCOMMERCE
 add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );
 
 // Remove breadcrumb
 remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
 
 
 // Remove page title 
 add_filter('woocommerce_show_page_title', '__return_false');
 
 /**
 * Custom Add To Cart Messages
 * Add this to your theme functions.php file
 **/
 add_filter( 'wc_add_to_cart_message', 'upshot_custom_add_to_cart_message' );
 function upshot_custom_add_to_cart_message() {
	global $woocommerce;
 
	// Output success messages
	if ( get_option('woocommerce_cart_redirect_after_add') == 'yes' ) :
	 
	$return_to = get_permalink( woocommerce_get_page_id('shop') );
	 
	$message = sprintf('<a href="%s" class="button">%s</a> %s', $return_to, esc_html__('Continue Shopping &rarr;', 'upshot'), esc_html__('Product successfully added to your cart.', 'upshot') );
	 
	else :
	
	$message = '<i class="fa fa-icon fa-check" style="font-size:17px;margin-right:10px;"></i>';
	
	$message .= sprintf('<a href="%s" class="hgr_view_cart_link">%s <i class="fa fa-icon fa-angle-right" style="font-size:17px;margin-left:10px;"></i></a> %s', get_permalink( woocommerce_get_page_id('cart') ), esc_html__('View Cart', 'upshot'), esc_html__('Product successfully added to your cart.', 'upshot') );
	 
	endif;
	 
	return $message;
}
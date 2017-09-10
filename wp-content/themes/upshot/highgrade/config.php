<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "redux_options";

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'upshot' ),
        'page_title'           => esc_html__( 'Theme Options', 'upshot' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => 'theme_options',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => false,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '0',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => 'theme_options',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => false,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => true,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
		
		'network_sites'        => true,
        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = '';
    } else {
        $args['intro_text'] = '';
    }

    // Add content after the form.
    $args['footer_text'] = '';

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'upshot' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'upshot' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'upshot' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'upshot' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'upshot' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    // ACTUAL DECLARATION OF SECTIONS ****************************************** //
	// GENERAL SETTINGS SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'hgr_general',
		'icon'		=>	'el-icon-eye-open',
		'title'		=>	esc_html__('General Settings', 'upshot'),
		'desc'		=>	esc_html__('General settings for your website', 'upshot'),
        'fields'     => array(
					array(
                        'id'        => 'website_model',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Full-Width or Boxed?', 'upshot'),
                        'subtitle'  => esc_html__('Is your website Full-Width or Boxed?', 'upshot'),
                        'options'   => array(
                            'website_full_width'=> esc_html__('Full Width', 'upshot'), 
                            'website_boxed'		=> esc_html__('Boxed', 'upshot'), 
                        ), 
                        'default'   => 'website_full_width'
                    ),
					array(
                        'id'        => 'enable_smooth_scroll',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Smooth Scroll?', 'upshot'),
                        'subtitle'  => esc_html__('Enable / Disable smooth scrolling feature.', 'upshot'),
                        'default'   => 0,
                        'on'        => esc_html__('Enabled', 'upshot'),
                        'off'       => esc_html__('Disabled', 'upshot'),
                    ),
					array(
                        'id'        => 'enable_boxed_shadow',
                        'type'      => 'switch',
						'required'	=> array('website_model', '=', 'website_boxed'),
                        'title'     => esc_html__('Enable lateral shadow?', 'upshot'),
                        'subtitle'  => esc_html__('Enable or Disable website lateral shadow.', 'upshot'),
                        'default'   => 0,
                        'on'        => esc_html__('Enabled', 'upshot'),
                        'off'       => esc_html__('Disabled', 'upshot'),
                    ),
					array(
						'id'				=>	'website-background',
						'type'				=>	'background',
						'required'			=>	array('website_model', '=', 'website_boxed'),
						'compiler'			=>	array('body'),
						'output'			=>	array('body'),
						'title'				=>	esc_html__('Body Background', 'upshot'),
						'subtitle'			=>	esc_html__('Body background image (optional).', 'upshot'),
						'preview_height'	=>	'60px',
						'background-color'	=>	true,
					),
					array(
                        'id'        => 'enable_full_screen_search',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Full Screen Search into Menu Bar?', 'upshot'),
                        'subtitle'  => esc_html__('Enable or Disable Full Screen Search button into Menu Bar.', 'upshot'),
                        'default'   => 0,
                        'on'        => esc_html__('Enabled', 'upshot'),
                        'off'       => esc_html__('Disabled', 'upshot'),
                    ),
					class_exists( 'WooCommerce' ) ? 
					array(
                        'id'        => 'enable_fssearch_onlu_for_products',
                        'type'      => 'switch',
                        'title'     => esc_html__('Search only for products?', 'upshot'),
                        'subtitle'  => esc_html__('If enabled, search will be made only for products.', 'upshot'),
                        'default'   => 1,
                        'on'        => esc_html__('Enabled', 'upshot'),
                        'off'       => esc_html__('Disabled', 'upshot'),
						'required'	=> array('enable_full_screen_search', '=', '1'),
                    ) : NULL,
					array(
                        'id'        => 'enable_top_info_bar',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Info Bar?', 'upshot'),
                        'subtitle'  => esc_html__('Show / Hide Info Bar', 'upshot'),
                        'default'   => 0,
                        'on'        => esc_html__('Enabled', 'upshot'),
                        'off'       => esc_html__('Disabled', 'upshot'),
                    ),
					!class_exists( 'HGR_INFOBARS' ) ?
					array(
						'id'    => 'top_info_bar',
						'type'  => 'info',
						'style' => 'critical',
						'title' => esc_html__( 'Info Bar Error', 'upshot' ),
						'desc'  => sprintf( esc_html__( '<b>Highgrade Info Bars Add-On</b> is not active. Please activate <a href="%s">here</a>', 'upshot' ), plugins_url() ),
						'required'	=> array('enable_top_info_bar', '=', '1'),
					) : NULL,
					array(
						'id'		=> 'top_info_bar_select',
						'type'		=> 'select',
						'required'	=> array('enable_top_info_bar', '=', '1'),
						'data'		=> 'posts',
						'args'		=> array('post_type' => 'hgr_info_bars'),
						'title'		=> esc_html__( 'Displayed Info Bar', 'upshot' ),
						'subtitle'	=> esc_html__( 'Select the info bar to be displayed.', 'upshot' ),
						'desc'		=> esc_html__( 'Info Bars are a special custom post type that allows you to display some info into your website.', 'upshot' ),
					),
					array(
                        'id'            => 'top_info_btn_font',
                        'type'          => 'typography',
						'required'		=> array('enable_top_info_bar', '=', '1'),
                        'title'         => esc_html__('Info Bar Button Font', 'upshot'),
                        'google'        => true,
                        'font-backup'   => true,
                        'font-style'    => true,	
                        'subsets'       => true,	
                        'font-size'     => true,
                        'line-height'   => true,
                        'word-spacing'  => true,
                        'letter-spacing'=> true,
                        'color'         => false,
						'text-transform'=> true,
                        'preview'       => true,	
                        'all_styles'    => true,	
                        'output'        => array('div.top_info_bar_btn'),
                        'units'         => array('px','em'),
                        'default'       => array(
                            //'color'         => '#000',
                            'font-style'    => '400',
                            'font-family'   => 'Roboto',
                            'google'        => true,
                            'font-size'     => '14px',
                            'line-height'   => '14px',
							'text-align'	=> 'center',
						),
                        'preview' => array('text' => 'ooga booga'),
                    ),
					array(
                        'id'            => 'top_info_content_font',
                        'type'          => 'typography',
						'required'		=> array('enable_top_info_bar', '=', '1'),
                        'title'         => esc_html__('Info Bar Content Font', 'upshot'),
                        'google'        => true,
                        'font-backup'   => true,
                        'font-style'    => true,	
                        'subsets'       => true,	
                        'font-size'     => true,
                        'line-height'   => true,
                        'word-spacing'  => true,
                        'letter-spacing'=> true,
                        'color'         => true,
                        'preview'       => true,	
                        'all_styles'    => true,	
                        'output'        => array('div.top_info_bar_content'),
                        'units'         => array('px','em'),
                        'default'       => array(
                            'color'         => '#000',
                            'font-style'    => '400',
                            'font-family'   => 'Roboto',
                            'google'        => true,
                            'font-size'     => '14px',
                            'line-height'   => '24px',
							'text-align'	=>	'left',
						),
                        'preview' => array('text' => 'ooga booga'),
                    ),
					array(
                        'id'            => 'top_info_bar_padding',
                        'type'          => 'spacing',
						'required'		=> array('enable_top_info_bar', '=', '1'),
                        'output'        => array('.top_info_bar'),
                        'mode'          => 'padding',
                        'all'           => false, 
                        'units'         => array('px','em'),
                        'units_extended'=> 'true',
                        'display_units' => 'true',
                        'title'         => esc_html__('Top Info Bar Padding', 'upshot'),
                        'subtitle'      => esc_html__('Choose the padding you want for your info bar.', 'upshot'),
                        'default'       => array(
                            'margin-top'    => '10', 
                            'margin-right'  => '30', 
                            'margin-bottom' => '10', 
                            'margin-left'   => '30'
                        )
                    ),
					array(
                        'id'        => 'body_border',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Enable body border?', 'upshot'),
                        'subtitle'  => esc_html__('Do you want do display a body border?', 'upshot'),
                        'options'   => array(
                            'body_border_on'	=> esc_html__('Enabled', 'upshot'), 
                            'body_border_off'	=> esc_html__('Disabled', 'upshot'), 
                        ), 
                        'default'   => 'body_border_off'
                    ),
					array(
						'id'		=> 'body_border_dimensions',
						'type'		=> 'dimensions',
						'title'		=> esc_html__('Body border width', 'upshot'),
						'subtitle'	=> esc_html__('This must be numeric only.', 'upshot'),
						'desc'		=> esc_html__('Enter value in pixels, NUMBERS ONLY', 'upshot'),
						'width'		=> true,
						'height'	=> false,
						'output'	=> false,
						'units'		=> array('px'),
						'default'	=> array(
							'width'	=> 15, 
						),
						'required'  => array('body_border', '=', 'body_border_on'),
					),
					array(
                        'id'        => 'body_border_color',
                        'type'      => 'color_rgba',
                        'title'     => esc_html__('Body border color', 'upshot'),
                        'subtitle'  => esc_html__('Style your body border color', 'upshot'),
                        'default'   => array('color' => '#dd9933', 'alpha' => '1.0'),
                        'output'    => array('#hgr_top, #hgr_bottom, #hgr_left, #hgr_right'),
						'compiler'  => array('#hgr_top, #hgr_bottom, #hgr_left, #hgr_right'),
                        'mode'      => 'background',
                        'validate'  => 'colorrgba',
						'required'  => array('body_border', '=', 'body_border_on'),
                    ),
					array(
						'id'		=> 'custom_error_page',
						'type'		=> 'select',
						'data'		=> 'posts',
						'args'		=> array('post_type' => 'page', 'nopaging' => true),
						'title'		=> esc_html__( 'Custom 404 page', 'upshot' ),
						'subtitle'	=> esc_html__( 'Select your custom 404 page.', 'upshot' ),
						'desc'		=> esc_html__( 'Go to pages and create your custom 404 page. After this, you can select it from here.', 'upshot' ),
					),
					array(
                        'id'        => 'section_bk_to_top_btn',
                        'type'      => 'section',
                        'title'     => esc_html__('Back to top button', 'upshot'),
                        'subtitle'  => esc_html__('Style your "Back To Top" button.', 'upshot'),
                        'indent'    => true // Indent all options below until the next 'section' option is set.
                    ),
					array(
                        'id'        => 'back_to_top_button',
                        'type'      => 'switch',
                        'title'     => esc_html__('Back To Top Button', 'upshot'),
                        'subtitle'  => esc_html__('Show / Hide "Back to top" button', 'upshot'),
                        'default'   => 1,
                        'on'        => esc_html__('Enabled', 'upshot'),
                        'off'       => esc_html__('Disabled', 'upshot'),
                    ),
					array(
                        'id'        => 'back_to_top_button_bg_color',
                        'type'      => 'color_rgba',
                        'title'     => esc_html__('Back to top button background color', 'upshot'),
                        'subtitle'  => esc_html__('Style your back to top button just the way you want.', 'upshot'),
                        'default'   => array('color' => '#dd9933', 'alpha' => '1.0'),
                        'output'    => array('.back-to-top'),
						'compiler'  => array('.back-to-top'),
                        'mode'      => 'background',
                        'validate'  => 'colorrgba',
						'required'  => array('back_to_top_button', '=', '1'),
                    ),
					array(
						'id'		=> 'back_to_top_button_dimensions',
						'type'		=> 'dimensions',
						'title'		=> esc_html__('Back to top button dimensions', 'upshot'),
						'subtitle'	=> esc_html__('This must be numeric only.', 'upshot'),
						'desc'		=> esc_html__('Enter value in pixels, NUMBERS ONLY', 'upshot'),
						'width'		=> true,
						'height'	=> false,
						'output'    => false,
						'units'		=> array('px'),
						'default'	=> array(
							'width'	=> '30px', 
						),
						'required'  => array('back_to_top_button', '=', '1'),
					),
		)
    ) );
	
	
	// DEVICE SETTINGS
	Redux::setSection( $opt_name, array(
        'id'			=> 'hgr_device',
		'icon'		=>	'el-icon-screen',
		'title'		=>	esc_html__('Device Specs', 'upshot'),
		'desc'		=>	esc_html__('Responsiveness and mobile specific settings are below. Use them so your website gets the perfect look, feel and functionality on any device.', 'upshot'),
        'fields'     => array(
			array(
				'id'        => 'section_media_queries',
				'type'      => 'section',
				'title'     => esc_html__('Media queries breakpoints', 'upshot'),
				'subtitle'  => esc_html__('Define the breakpoints at which your layout will change, adapting to different screen sizes.', 'upshot'),
				'indent'    => true,
			),
			array(
				'id'        => 'mediaquery_screen_xs',
				'type'      => 'text',
				'title'     => esc_html__('Extra Small Screen', 'upshot'),
				'subtitle'  => esc_html__('Extra small devices, like phones (<480px)', 'upshot'),
				'desc'      => esc_html__('Enter value in pixels, NUMBERS ONLY', 'upshot'),
				'validate'  => 'numeric',
				'default'   => '480',
			),
			array(
				'id'        => 'mediaquery_screen_s',
				'type'      => 'text',
				'title'     => esc_html__('Small Screen', 'upshot'),
				'subtitle'  => esc_html__('Small devices, like tablets (>=480px)', 'upshot'),
				'desc'      => esc_html__('Enter value in pixels, NUMBERS ONLY', 'upshot'),
				'validate'  => 'numeric',
				'default'   => '640',
			),
			array(
				'id'        => 'mediaquery_screen_m',
				'type'      => 'text',
				'title'     => esc_html__('Medium Screen', 'upshot'),
				'subtitle'  => esc_html__('Medium devices Desktops (<=768px)', 'upshot'),
				'desc'      => esc_html__('Enter value in pixels, NUMBERS ONLY', 'upshot'),
				'validate'  => 'numeric',
				'default'   => '768',
			),
			array(
				'id'        => 'mediaquery_screen_l',
				'type'      => 'text',
				'title'     => esc_html__('Large Screen', 'upshot'),
				'subtitle'  => esc_html__('Large devices Desktops (<=980px)', 'upshot'),
				'desc'      => esc_html__('Enter value in pixels, NUMBERS ONLY', 'upshot'),
				'validate'  => 'numeric',
				'default'   => '980',
			),
			array(
				'id'        => 'mediaquery_screen_xl',
				'type'      => 'text',
				'title'     => esc_html__('Extra Large Screen', 'upshot'),
				'subtitle'  => esc_html__('Extra Large devices Desktops (<=1280px)', 'upshot'),
				'desc'      => esc_html__('Enter value in pixels, NUMBERS ONLY', 'upshot'),
				'validate'  => 'numeric',
				'default'   => '1280',
			),
			array(
				'id'        => 'mediaquery_screen_xxl',
				'type'      => 'text',
				'title'     => esc_html__('XXL Screen', 'upshot'),
				'subtitle'  => esc_html__('XXL devices Desktops (>1280px)', 'upshot'),
				'desc'      => esc_html__('Enter value in pixels, NUMBERS ONLY', 'upshot'),
				'validate'  => 'numeric',
				'default'   => '1280',
			),
			array(
				'id'        => 'section_containers',
				'type'      => 'section',
				'title'     => esc_html__('Container sizes', 'upshot'),
				'subtitle'  => esc_html__('Define the maximum width of .container for different screen sizes.', 'upshot'),
				'indent'    => true,
			),
			array(
				'id'			=> 'container_xs',
				'type'		=> 'dimensions',
				'title'     => esc_html__('Extra Small Screen Container', 'upshot'),
				'subtitle'  => esc_html__('This must be numeric only.', 'upshot'),
				'desc'      => esc_html__('Enter value in pixels, NUMBERS ONLY', 'upshot'),
				'width'		=> true,
				'height'		=> false,
				'output'		=> array('.container_xs'),
				'units'		=> array('px'),
				'default'	=> array(
					'width'	=> '300px', 
				),
			),
			array(
				'id'			=> 'container_s',
				'type'		=> 'dimensions',
				'title'     => esc_html__('Small Screen Container', 'upshot'),
				'subtitle'  => esc_html__('This must be numeric only.', 'upshot'),
				'desc'      => esc_html__('Enter value in pixels, NUMBERS ONLY', 'upshot'),
				'width'		=> true,
				'height'		=> false,
				'output'		=> array('.container_s'),
				'units'		=> array('px'),
				'default'	=> array(
					'width'	=> '440px', 
				),
			),
			array(
				'id'			=> 'container_m',
				'type'		=> 'dimensions',
				'title'     => esc_html__('Medium Screen Container', 'upshot'),
				'subtitle'  => esc_html__('This must be numeric only.', 'upshot'),
				'desc'      => esc_html__('Enter value in pixels, NUMBERS ONLY', 'upshot'),
				'width'		=> true,
				'height'		=> false,
				'output'		=> array('.container_m'),
				'units'		=> array('px'),
				'default'	=> array(
					'width'	=> '600px', 
				),
			),
			array(
				'id'			=> 'container_l',
				'type'		=> 'dimensions',
				'title'		=> esc_html__('Large Screen Container', 'upshot'),
				'subtitle'	=> esc_html__('This must be numeric only.', 'upshot'),
				'desc'		=> esc_html__('Enter value in pixels, NUMBERS ONLY', 'upshot'),
				'width'		=> true,
				'height'		=> false,
				'output'		=> array('.container_l'),
				'units'		=> array('px'),
				'default'	=> array(
					'width'	=> '720px', 
				),
			),
			array(
				'id'			=> 'container_xl',
				'type'		=> 'dimensions',
				'title'		=> esc_html__('Extra Large Screen Container', 'upshot'),
				'subtitle'	=> esc_html__('This must be numeric only.', 'upshot'),
				'desc'		=> esc_html__('Enter value in pixels, NUMBERS ONLY', 'upshot'),
				'width'		=> true,
				'height'		=> false,
				'output'		=> array('.container_xl'),
				'units'		=> array('px'),
				'default'	=> array(
					'width'	=> '920px', 
				),
			),
			array(
				'id'			=> 'container_xxl',
				'type'		=> 'dimensions',
				'title'		=> esc_html__('XXL Screen Container', 'upshot'),
				'subtitle'	=> esc_html__('This must be numeric only.', 'upshot'),
				'desc'		=> esc_html__('Enter value in pixels, NUMBERS ONLY', 'upshot'),
				'width'		=> true,
				'height'		=> false,
				'output'		=> array('.container_xxl'),
				'units'		=> array('px'),
				'default'	=> array(
					'width'	=> '1200px', 
				),
			),
			
		)
	) );
	// BRANDING SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'hgr_branding',
		'icon'		=> 'el-icon-globe',
		'title'		=>	esc_html__('Branding', 'upshot'),
        'fields'		=> array(
			array(
				'id'				=>	'logo',
				'type'			=>	'media',
				'title'			=>	esc_html__('Regular logo', 'upshot'),
				'subtitle'		=>	esc_html__('Upload your logo. <br>Recomended: 174px x 60px transparent .png', 'upshot'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array( 'url'=>get_template_directory_uri().'/highgrade/images/logo.png', 'width'=>'174', 'height'=>'60' ),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'				=>	'retina_logo',
				'type'			=>	'media',
				'title'			=>	esc_html__('Retina Logo @2x', 'upshot'),
				'subtitle'		=>	esc_html__('Upload your retina logo. <br>Recomended: 348px x 120px transparent .png', 'upshot'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array( 'url'=>get_template_directory_uri().'/highgrade/images/logo@2x.png','width'=>'174', 'height'=>'60' ),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'				=>	'favicon',
				'type'			=>	'media',
				'title'			=>	esc_html__('Regular Favicon', 'upshot'),
				'subtitle'		=>	esc_html__('Upload your favicon. <br>Recomended: 16px x 16px transparent .png file', 'upshot'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array('url'=>get_template_directory_uri().'/highgrade/images/favicon.png'),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'				=>	'retina_favicon',
				'type'			=>	'media',
				'title'			=>	esc_html__('Retina Favicon @2x', 'upshot'),
				'subtitle'		=>	esc_html__('Upload your retina favicon. <br>Recomended: 32px x 32px transparent .png file', 'upshot'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array('url'=>get_template_directory_uri().'/highgrade/images/favicon@2x.png'),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'				=>	'iphone_icon',
				'type'			=>	'media',
				'title'			=>	esc_html__('Apple iPhone Icon', 'upshot'),
				'subtitle'		=>	esc_html__('Upload your Apple iPhone icon. <br>Recomended: 60px x 60px transparent .png file', 'upshot'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array('url'=>get_template_directory_uri().'/highgrade/images/iphone-favicon.png'),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'				=>	'retina_iphone_icon',
				'type'			=>	'media',
				'title'			=>	esc_html__('Apple iPhone Retina Icon @2x', 'upshot'),
				'subtitle'		=>	esc_html__('Upload your Apple iPhone Retina icon. <br>Recomended: 120px x 120px transparent .png file', 'upshot'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array('url'=>get_template_directory_uri().'/highgrade/images/iphone-favicon@2x.png'),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'				=>	'ipad_icon',
				'type'			=>	'media',
				'title'			=>	esc_html__('Apple iPad Icon', 'upshot'),
				'subtitle'		=>	esc_html__('Upload your Apple iPad icon. <br>Recomended: 76px x 76px transparent .png file', 'upshot'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array('url'=>get_template_directory_uri().'/highgrade/images/ipad-favicon.png'),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'				=>	'ipad_retina_icon',
				'type'			=>	'media',
				'title'			=>	esc_html__('Apple iPad Retina Icon @2x', 'upshot'),
				'subtitle'		=>	esc_html__('Upload your Apple iPad Retina icon. <br>Recomended: 152px x 152px transparent .png file', 'upshot'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array('url'=>get_template_directory_uri().'/highgrade/images/ipad-favicon@2x.png'),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
		)
    ) );
	
	// COLORS SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'hgr_colors',
		'icon'		=>	'el-icon-eye-open',
		'title'		=>	esc_html__('Colors', 'upshot'),
		'desc'		=>	esc_html__('You can setup two color schemes: dark and light', 'upshot'),
        'fields'     => array(
			array(
				'id'				=>	'bg_color',
				'type'			=>	'color',
				'validate'		=>	'color',
				'compiler'		=>	array('body'),
				'output'			=>	array('body'),
				'title'			=>	esc_html__('Body Background Color', 'upshot'), 
				'subtitle'		=>	esc_html__('Pick a background color for the theme.', 'upshot'),
				'default'		=>	'#666666',
			),
			array(
				'id'				=>	'theme_dominant_color',
				'type'			=>	'color',
				'validate'		=>	'color',
				'compiler'		=>	array('.theme_dominant_color'),
				'output'			=>	array('.theme_dominant_color'),
				'title'			=>	esc_html__('Theme dominant color', 'upshot'), 
				'subtitle'		=>	esc_html__('Pick a dominant color for the theme.', 'upshot'),
				'hint'			=>	array(
					'content'	=>	'Theme dominant color its used on certain elements, for witch you do not have a specific option to define a color.',
				),
				'default'		=>	'#dd9933',
			),
		)
    ) );
	
	// COLORS SECTION - Dark Color Scheme
    Redux::setSection( $opt_name, array(
        'title'		=>	esc_html__('Dark Color Scheme', 'upshot'),
        'id'         => 'hgr_dark_colors',
		'subsection' => true,
        'fields'     => array(
			array(
				'id'			=>	'dark-scheme-info',
				'type'		=>	'info',
				'desc'		=>	esc_html__('Color options settings for "dark" color scheme (website sections that feature a dark image or background color; a light text color is recommended for these sections).', 'upshot'),
			),
			array(
				'id'			=>	'ds_text_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.dark_scheme, .dark_scheme.hgr_megafooter'),
				'output'		=>	array('.dark_scheme, .dark_scheme.hgr_megafooter'),
				'title'		=>	esc_html__('Text color', 'upshot'), 
				'subtitle'	=>	esc_html__('Pick a color for text.', 'upshot'),
				'default'	=>	'#e0e0e0',
			),
			array(
				'id'			=>	'h1_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.dark_scheme h1, .dark_scheme.hgr_megafooter h1'),
				'output'		=>	array('.dark_scheme h1, .dark_scheme.hgr_megafooter h1'),
				'title'		=>	esc_html__('H1 Color', 'upshot'), 
				'subtitle'	=>	esc_html__('Pick a color for H1 tags.', 'upshot'),
				'default'	=>	'#ffffff',
			),
			array(
				'id'			=>	'h2_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.dark_scheme h2, .dark_scheme.hgr_megafooter h2'),
				'output'		=>	array('.dark_scheme h2, .dark_scheme.hgr_megafooter h2'),
				'title'		=>	esc_html__('H2 Color', 'upshot'), 
				'subtitle'	=>	esc_html__('Pick a color for H2 tags.', 'upshot'),
				'default'	=>	'#ffffff',
			),
			array(
				'id'			=>	'h3_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.dark_scheme h3, .dark_scheme.hgr_megafooter h3'),
				'output'		=>	array('.dark_scheme h3, .dark_scheme.hgr_megafooter h3'),
				'title'		=>	esc_html__('H3 Color', 'upshot'), 
				'subtitle'	=>	esc_html__('Pick a color for H3 tags.', 'upshot'),
				'default'	=>	'#e0e0e0',
			),
			array(
				'id'			=>	'h4_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.dark_scheme h4, .dark_scheme.hgr_megafooter h4'),
				'output'		=>	array('.dark_scheme h4, .dark_scheme.hgr_megafooter h4'),
				'title'		=>	esc_html__('H4 Color', 'upshot'), 
				'subtitle'	=>	esc_html__('Pick a color for H4 tags.', 'upshot'),
				'default'	=>	'#ffffff',
			),
			array(
				'id'			=>	'h5_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.dark_scheme h5, .dark_scheme.hgr_megafooter h5'),
				'output'		=>	array('.dark_scheme h5, .dark_scheme.hgr_megafooter h5'),
				'title'		=>	esc_html__('H5 Color', 'upshot'), 
				'subtitle'	=>	esc_html__('Pick a color for H5 tags.', 'upshot'),
				'default'	=>	'#ffffff',
			),
			array(
				'id'			=>	'h6_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.dark_scheme h6, .dark_scheme.hgr_megafooter h6'),
				'output'		=>	array('.dark_scheme h6, .dark_scheme.hgr_megafooter h6'),
				'title'		=>	esc_html__('H6 Color', 'upshot'), 
				'subtitle'	=>	esc_html__('Pick a color for H6 tags.', 'upshot'),
				'default'	=>	'#ffffff',
			),
			array(
				'id'        	=>	'ahref_color',
				'type'      	=>	'link_color',
				'compiler'	=>	array('.dark_scheme a, .dark_scheme.hgr_megafooter a'),
				'output'		=>	array('.dark_scheme a, .dark_scheme.hgr_megafooter a'),
				'title'		=>	esc_html__('Links Color', 'upshot'), 
				'subtitle'	=>	esc_html__('Pick a color for links.', 'upshot'),
				'desc'      	=>	esc_html__('Setup links color on regular and hovered state.', 'upshot'),
				'regular'   	=>	true,	// Enable / Disable Regular Color
				'hover'     	=>	true,	// Enable / Disable Hover Color
				'active'    	=>	false,	// Enable / Disable Active Color
				'visited'   	=>	false,	// Enable / Disable Visited Color
				'default'   	=>	array(
					'regular'	=>	'#e0e0e0',
					'hover'		=>	'#dd9933',
				)
			),
		)
    ) );
	
	// COLORS SECTION - Light Color Scheme
    Redux::setSection( $opt_name, array(
        'title'		=>	esc_html__('Light Color Scheme', 'upshot'),
        'id'         => 'hgr_light_colors',
		'subsection' => true,
        'fields'     => array(
			array(
				'id'			=>	'light-scheme-info',
				'type'		=>	'info',
				'desc'		=>	esc_html__('Color options settings for "light" color scheme (website sections that feature a light image or background color; a dark text color is recommended for these sections).', 'upshot'),
			),
			array(
				'id'			=>	'ls_text_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.light_scheme'),
				'output'		=>	array('.light_scheme'),
				'title'		=>	esc_html__('Text color', 'upshot'), 
				'subtitle'	=>	esc_html__('Pick a color for text.', 'upshot'),
				'default'	=>	'#848484',
			),
			array(
				'id'			=>	'light_h1_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.light_scheme h1'),
				'output'		=>	array('.light_scheme h1'),
				'title'		=>	esc_html__('H1 Color', 'upshot'), 
				'subtitle'	=>	esc_html__('Pick a color for H1 tags.', 'upshot'),
				'default'	=>	'#222222',
			),
			array(
				'id'			=>	'light_h2_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.light_scheme h2'),
				'output'		=>	array('.light_scheme h2'),
				'title'		=>	esc_html__('H2 Color', 'upshot'), 
				'subtitle'	=>	esc_html__('Pick a color for H2 tags.', 'upshot'),
				'default'	=>	'#222222',
			),
			array(
				'id'			=>	'light_h3_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.light_scheme h3'),
				'output'		=>	array('.light_scheme h3'),
				'title'		=>	esc_html__('H3 Color', 'upshot'), 
				'subtitle'	=>	esc_html__('Pick a color for H3 tags.', 'upshot'),
				'default'	=>	'#666666',
			),
			array(
				'id'			=>	'light_h4_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.light_scheme h4'),
				'output'		=>	array('.light_scheme h4'),
				'title'		=>	esc_html__('H4 Color', 'upshot'), 
				'subtitle'	=>	esc_html__('Pick a color for H4 tags.', 'upshot'),
				'default'	=>	'#222222',
			),
			array(
				'id'			=>	'light_h5_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.light_scheme h5'),
				'output'		=>	array('.light_scheme h5'),
				'title'		=>	esc_html__('H5 Color', 'upshot'), 
				'subtitle'	=>	esc_html__('Pick a color for H5 tags.', 'upshot'),
				'default'	=>	'#222222',
			),
			array(
				'id'			=>	'light_h6_color',
				'type'		=>	'color',
				'validate'	=>	'color',
				'compiler'	=>	array('.light_scheme h6'),
				'output'		=>	array('.light_scheme h6'),
				'title'		=>	esc_html__('H6 Color', 'upshot'), 
				'subtitle'	=>	esc_html__('Pick a color for H6 tags.', 'upshot'),
				'default'	=>	'#848484',
			),
			array(
				'id'        	=>	'light_ahref_color',
				'type'      	=>	'link_color',
				'compiler'	=>	array('.light_scheme a'),
				'output'		=>	array('.light_scheme a'),
				'title'		=>	esc_html__('Links Color', 'upshot'), 
				'subtitle'	=>	esc_html__('Pick a color for links.', 'upshot'),
				'desc'      	=>	esc_html__('Setup links color on regular and hovered state.', 'upshot'),
				'regular'   	=>	true,	// Enable / Disable Regular Color
				'hover'     	=>	true,	// Enable / Disable Hover Color
				'active'    	=>	false,	// Enable / Disable Active Color
				'visited'   	=>	false,	// Enable / Disable Visited Color
				'default'   	=>	array(
					'regular'	=>	'#848484',
					'hover'		=>	'#dd9933',
				)
			),
		)
    ) );
	
	// TYPOGRAPHY SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'hgr_typography',
		'icon'      => 'el-icon-fontsize',
		'title'		=>	esc_html__('Typography', 'upshot'),
		'desc'		=>	esc_html__('Setup the fonts that will be used in your theme. You can choose from Standard Fonts and Google Web Fonts.', 'upshot'),
        'fields'     => array(
			array(
				'id'					=>	'body-font',
				'type'				=>	'typography',
				'title'				=>	esc_html__('Body Font', 'upshot'),
				'subtitle' 			=>	esc_html__('Specify the body font properties.', 'upshot'),
				'compiler'			=>	array('body, .megamenu'),
				'output'				=>	array('body, .megamenu'),
				'google'				=>	true,
				'color'				=>	false,
				'text-transform'	=>	true,
				'letter-spacing'	=>	true,
				'default'			=>	array(
					'font-size'			=>	'14px',
					'line-height'		=>	'28px',
					'font-family'		=>	'Roboto',
					'font-weight'		=>	'400',
				),
			),
			array(
				'id'					=>	'h1-font',
				'type'				=>	'typography',
				'title'				=>	esc_html__('H1 Font', 'upshot'),
				'subtitle'			=>	esc_html__('Specify the H1 font properties.', 'upshot'),
				'compiler'			=>	array('h1, .megamenu h1'),
				'output'				=>	array('h1, .megamenu h1'),
				'google'				=>	true,
				'color'				=>	false,
				'text-transform'	=>	true,
				'letter-spacing'	=>	true,
				'default'			=>	array(
					'font-size'			=>	'60px',
					'line-height'		=>	'72px',
					'font-family'		=>	'Roboto Slab',
					'font-weight'		=>	'300',
				),
			),
			array(
				'id'					=>	'h2-font',
				'type'				=>	'typography',
				'title'				=>	esc_html__('H2 Font', 'upshot'),
				'subtitle'			=>	esc_html__('Specify the H2 font properties.', 'upshot'),
				'compiler'			=>	array('h2, .megamenu h2'),
				'output'				=>	array('h2, .megamenu h2'),
				'google'				=>	true,
				'color'				=>	false,
				'text-transform'	=>	true,
				'letter-spacing'	=>	true,
				'default'			=>	array(
					'font-size'			=>	'36px',
					'line-height'		=>	'40px',
					'font-family'		=>	'Roboto Slab',
					'font-weight'		=>	'300',
				),
			),
			array(
				'id'					=>	'h3-font',
				'type'				=>	'typography',
				'title'				=>	esc_html__('H3 Font', 'upshot'),
				'subtitle'			=>	esc_html__('Specify the H3 font properties.', 'upshot'),
				'compiler'			=>	array('h3, .megamenu h3'),
				'output'				=>	array('h3, .megamenu h3'),
				'google'				=>	true,
				'color'				=>	false,
				'text-transform'	=>	true,
				'letter-spacing'	=>	true,
				'default'			=>	array(
					'font-size'			=>	'48px',
					'line-height'		=>	'56px',
					'font-family'		=>	'Dancing Script',
					'font-weight'		=>	'',
				),
			),
			array(
				'id'					=>	'h4-font',
				'type'				=>	'typography',
				'title'				=>	esc_html__('H4 Font', 'upshot'),
				'subtitle'			=>	esc_html__('Specify the H4 font properties.', 'upshot'),
				'compiler'			=>	array('h4, .megamenu h4'),
				'output'				=>	array('h4, .megamenu h4'),
				'google'				=>	true,
				'color'				=>	false,
				'text-transform'	=>	true,
				'letter-spacing'	=>	true,
				'default'			=>	array(
					'font-size'			=>	'18px',
					'line-height'		=>	'30px',
					'font-family'		=>	'Roboto Slab',
					'font-weight'		=>	'400',
				),
			),
			array(
				'id'					=>	'h5-font',
				'type'				=>	'typography',
				'title'				=>	esc_html__('H5 Font', 'upshot'),
				'subtitle'			=>	esc_html__('Specify the H5 font properties.', 'upshot'),
				'compiler'			=>	array('h5, .megamenu h5'),
				'output'				=>	array('h5, .megamenu h5'),
				'google'				=>	true,
				'color'				=>	false,
				'text-transform'	=>	true,
				'letter-spacing'	=>	true,
				'default'			=> array(
					'font-size'			=>	'14px',
					'line-height'		=>	'24px',
					'font-family'		=>	'Roboto Condensed',
					'font-weight'		=>	'700',
				),
			),
			array(
				'id'					=>	'h6-font',
				'type'				=>	'typography',
				'title'				=> 	esc_html__('H6 Font', 'upshot'),
				'subtitle'			=> 	esc_html__('Specify the H6 font properties.', 'upshot'),
				'compiler'			=> 	array('h6, .megamenu h6'),
				'output'				=> 	array('h6, .megamenu h6'),
				'google'				=>	true,
				'color'				=>	false,
				'text-transform'	=>	true,
				'letter-spacing'	=>	true,
				'default'			=>	array(
					'font-size'			=>	'12px',
					'line-height'		=>	'18px',
					'font-family'		=>	'Source Sans Pro',
					'font-weight'		=>	'300',
				),
			),
			// PAGE TITLES
			array(
				'id'        => 'section_page_title',
				'type'      => 'section',
				'title'     => esc_html__('Page Title', 'upshot'),
				'subtitle'  => esc_html__('Customize your page title.', 'upshot'),
				'indent'    => true, // Indent all options below until the next 'section' option is set.
			),
			array(
				'id'        => 'enable_page_title',
				'type'      => 'switch',
				'title'     => esc_html__('Enable Page Title?', 'upshot'),
				'subtitle'  => esc_html__('Enable / Disable page title feature.', 'upshot'),
				'default'   => 0,
				'on'        => esc_html__('Enabled', 'upshot'),
				'off'       => esc_html__('Disabled', 'upshot'),
			),
			array(
				'id'					=>	'page_title_h1',
				'type'				=>	'typography',
				'title'				=>	esc_html__('Page Title', 'upshot'),
				'subtitle'			=>	esc_html__('Specify the font properties for pages title.', 'upshot'),
				'compiler'			=>	array('.page_title_container h1'),
				'output'				=>	array('.page_title_container h1'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'letter-spacing'	=>	true,
				'default'			=>	array(
					'color'				=>	'#666666',
					'font-size'			=>	'60px',
					'line-height'		=>	'72px',
					'font-family'		=>	'Roboto Slab',
					'font-weight'		=>	'300',
				),
				'required'  			=> array('enable_page_title', '=', '1'),
			),
			array(
				'id'            => 'page_title_padding',
				'type'          => 'spacing',
				'mode'          => 'padding',
				'all'           => false, 
				'units'         => array('px','em'),
				'units_extended'=> 'true',
				'display_units' => 'true',
				'title'         => esc_html__('Page title padding', 'upshot'),
				'default'       => array(
					'margin-top'    => '80px', 
					'margin-right'  => '0px', 
					'margin-bottom' => '80px', 
					'margin-left'   => '0px'
				),
				'required'  		=> array('enable_page_title', '=', '1'),
			),
			
		)
    ) );
	
	// HEADER & MENU SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'hgr_menu',
		'icon'		=> 'el-icon-website',
		'title'		=>	esc_html__('Header & Menu', 'upshot'),
        'fields'		=> array(
			/* HEADER STYLE */
			array(
				'id'        => 'section_menu_style',
				'type'      => 'section',
				'title'     => esc_html__('Menu Styling', 'upshot'),
				'subtitle'  => esc_html__('Customize your menu.', 'upshot'),
				'indent'    => true, // Indent all options below until the next 'section' option is set.
			),
			array(
				'id'        => 'menu_bar_width',
				'type'      => 'button_set',
				'title'     => esc_html__('Full-Width or Boxed?', 'upshot'),
				'subtitle'  => esc_html__('Do you want your menu bar to expand full width or to be contained?', 'upshot'),
				'options'   => array(
					'menu_full_width'	=> esc_html__('Full Width', 'upshot'), 
					'menu_contained'	=> esc_html__('Contained', 'upshot'), 
				), 
				'default'   => 'menu_contained'
			),
			
			array(
				'id'				=>	'menu-font',
				'type'			=>	'typography',
				'title'			=>	esc_html__('Menu Font', 'upshot'),
				'subtitle'		=>	esc_html__('Specify the menu font properties.', 'upshot'),
				'compiler'		=>	array('#hgr_top_navbar_container, #hgr_top_navbar_container #main_navbar>li>a, #hgr_top_navbar_container #main_navbar_left>li>a, .dropdown-menu > li > a'),
				'output'			=>	array('#hgr_top_navbar_container, #hgr_top_navbar_container #main_navbar>li>a, #hgr_top_navbar_container #main_navbar_left>li>a, .dropdown-menu > li > a'),
				'google'			=>	true,
				'letter-spacing'=>	true,
				'text-transform'=>	true,
				'color'			=>	false,
				'default'		=>	array(
					'font-size'			=>	'14px',
					'line-height'		=>	'60px',
					'font-family'		=>	'Roboto',
					'font-weight'		=>	'400',
					'letter-spacing'	=>	'',
				),
			),
			array(
				'id'        	=>	'menu-font-hover-color',
				'type'      	=>	'link_color',
				'compiler'	=>	array('#hgr_top_navbar_container #main_navbar>li>a, #hgr_top_navbar_container #main_navbar_left>li>a, .dropdown-menu>li>a, a.mobileFsSearch, .blog a.mobileFsSearch, a.cd-primary-nav-trigger, .blog a.cd-primary-nav-trigger, a.hgr_minicart, a.hgr_minicart .icon'),
				'output'		=>	array('#hgr_top_navbar_container #main_navbar>li>a, #hgr_top_navbar_container #main_navbar_left>li>a, .dropdown-menu>li>a, a.mobileFsSearch, .blog a.mobileFsSearch, a.cd-primary-nav-trigger, .blog a.cd-primary-nav-trigger, a.hgr_minicart, a.hgr_minicart .icon'),
				'title'		=>	esc_html__('Menu Font Color', 'upshot'),
				'subtitle'	=>	esc_html__('Specify the menu font color.', 'upshot'),
				'regular'   	=>	true,	// Enable / Disable Regular Color
				'hover'     	=>	true,	// Enable / Disable Hover Color
				'active'    	=>	false,	// Enable / Disable Active Color
				'visited'   	=>	false,	// Enable / Disable Visited Color
				'default'   	=>	array(
					'regular'	=>	'#000000',
					'hover'		=>	'#dd9933',
				)
			),
			
			/* Header Margins and paddings */
			array(
				'id'        => 'section_header_margins_paddings',
				'type'      => 'section',
				'title'     => esc_html__('Header Margins and paddings', 'upshot'),
				'indent'    => true, // Indent all options below until the next 'section' option is set.
			),
			array(
				'id'            => 'identity_padding',
				'type'          => 'spacing',
				'output'        => array('.hgr_identity'),
				'mode'          => 'padding',
				'all'           => false, 
				'units'         => array('px','em'),
				'units_extended'=> 'true',
				'display_units' => 'true',
				'title'         => esc_html__('Logo paddings', 'upshot'),
				'subtitle'      => esc_html__('Choose the padding you want for your logo.', 'upshot'),
				'default'       => array(
					'margin-top'    => '0', 
					'margin-right'  => '0', 
					'margin-bottom' => '0', 
					'margin-left'   => '0'
				)
			),
			array(
				'id'            => 'top_menu_padding',
				'type'          => 'spacing',
				'output'        => array('.main_navbar_container, .left_menu_container'),
				'mode'          => 'padding',
				'all'           => false, 
				'units'         => array('px','em'),
				'units_extended'=> 'true',
				'display_units' => 'true',
				'title'         => esc_html__('Top menu paddings', 'upshot'),
				'subtitle'      => esc_html__('Choose the padding you want for your top menu.', 'upshot'),
				'default'       => array(
					'margin-top'    => '0', 
					'margin-right'  => '0', 
					'margin-bottom' => '0', 
					'margin-left'   => '0'
				)
			),
			array(
				'id'            => 'top_middle_bar_right_side_padding',
				'type'          => 'spacing',
				'output'        => array('.fixed_menu_middle_bar_right_side, .fixed_menu_middle_bar_middle_side, .fixed_menu_middle_bar_left_side'),
				'mode'          => 'padding',
				'all'           => false, 
				'units'         => array('px','em'),
				'units_extended'=> 'true',
				'display_units' => 'true',
				'title'         => esc_html__('Top-Middle Bar right side paddings', 'upshot'),
				'default'       => array(
					'margin-top'    => '0', 
					'margin-right'  => '0', 
					'margin-bottom' => '0', 
					'margin-left'   => '0'
				),
				'required'  			=> array('header_floating', '=', '6'),
			),
			
			/* HEADER STYLE */
			array(
				'id'        => 'section_header_style_one',
				'type'      => 'section',
				'title'     => esc_html__('Header Styling', 'upshot'),
				'subtitle'  => esc_html__('Customize your header.', 'upshot'),
				'indent'    => true, // Indent all options below until the next 'section' option is set.
			),
			array(
				'id'			=>	'header_floating',
				'type'		=>	'select',
				'title'     => esc_html__('Header bar display', 'upshot'),
				//'subtitle'  => esc_html__('Do you want to display "Header" as fixed or to float as scrolling?', 'upshot'),
				'options'   => array(
					'1' => esc_html__('Fixed Header (Left Logo)', 'upshot'), 
					'2' => esc_html__('Appears after scrolling (Left Logo)', 'upshot'),
					'3' => esc_html__('Dissapears after scrolling (Left Logo)', 'upshot'), 
					'4' => esc_html__('Shrinks after scrolling (Left Logo)', 'upshot'),
					'5' => esc_html__('Transparent before scrolling (Left Logo)', 'upshot'), 
					'6' => esc_html__('Complex header (Left Logo)', 'upshot'),
					'7' => esc_html__('Fixed Header (Central Logo)', 'upshot'),
					'8' => esc_html__('Appears after scrolling (Central Logo)', 'upshot'),
					'9' => esc_html__('Dissapears after scrolling (Central Logo)', 'upshot'), 
					'10' => esc_html__('Shrinks after scrolling (Central Logo)', 'upshot'),
					'11' => esc_html__('Transparent before scrolling (Central Logo)', 'upshot'), 
				),
				'default'	=>	'1',
				'hint'		=>	array(
					'content'	=>	'<strong>Fixed Header:</strong> header is fixed, and stays there no matter if you scroll.<br><br>
									<strong>Appears after scrolling:</strong> This is hidden when page loads, and after a certain amount of scrolling (settings below) it appears.<br><br>
									<strong>Disappears after scrolling:</strong> This is displayed when page loads, and after a certain amount of scrolling (settings below) it disappears. As you start to scroll back to top it appears.<br><br>
									<strong>Shrinks after scrolling:</strong> Initially displayed as a large header. The initial height is set by adding padding (settings below). After a certain amount of scrolling (settings below) it shrinks. Shrinked dimensions are set below by modifying the paddings to a lower value.<br><br>
									<strong>Transparent before scrolling:</strong> Initially displayed as a transparent header. It scrolls with the page, and, after a certain amount of scrolling (settings below) it appears as transparent or with a background color (settings below).<br><br>
									<strong>Complex header:</strong> It displays a fixed menu that scrolls with the page and a fall down menu after scrolling a certain amount of pixels.<br><br>
									<strong>NOTE</strong> Some specific settings (ex: necessary pixels to scroll) are displayed only if specific header type selected.
								',
				)
			),
			
			// Hidden, display after scroll
			array(
				'id'                => 'header_floating_display_after',
				'type'              => 'dimensions',
				'width'          	=> false,
				'units'             => array('px'),   // You can specify a unit value. Possible: px, em, %
				'units_extended'    => 'false',  // Allow users to select any type of unit
				'title'             => esc_html__('Display header after scrolling:', 'upshot'),
				'output'    			=> false,
				'default'           => array('height' => '200'),
				'required'  			=> array('header_floating', '=', array('2','6','8')),
				'hint'				=>	array(
					'content'	=>	'<p>Define the scroll amount necesarry for header bar to be displayed. <br><strong>Leave blank for window screen height</strong>.</p>',
				)
			),
			
			
			// Displayed, hidden after scroll
			array(
				'id'                => 'header_floating_hide_after',
				'type'              => 'dimensions',
				'width'          	=> false,
				'units'             => array('px'),
				'units_extended'    => 'false',
				'title'             => esc_html__('Hide header after scrolling:', 'upshot'),
				'output'    			=> false,
				'default'           => array('height' => '200'),
				'required'  			=> array('header_floating', '=', array('3','9') ),
				'hint'				=>	array(
					'content'	=>	'<p>Define the scroll amount necesarry for header bar to be hidden. <br><strong>Leave blank for window screen height</strong>.</p>',
				)
			),
			
			// SHRINKING SETTINGS
			array(
				'id'                => 'header_shrink_after_scroll',
				'type'              => 'dimensions',
				'width'          	=> false,
				'units'             => array('px'),
				'units_extended'    => 'false',
				'title'             => esc_html__('Shrink header after scrolling:', 'upshot'),
				'output'    			=> false,
				'default'           => array('height' => '200'),
				'required'  			=> array('header_floating', '=', array('4','10')),
				'hint'				=>	array(
					'content'	=>	'<p>Define the scroll amount necesarry for header bar to shrink. <br><strong>Leave blank for window screen height</strong>.<br> Use padding settings below to setup height of the header bar, before and after scroll.</p>',
				)
			),
			array(
				'id'            => 'menu_bar_initial_height',
				'type'          => 'dimensions',
				'width'         => false,
				'units'         => array('px','em'),
				'units_extended'=> 'true',
				'display_units' => 'true',
				'title'         => esc_html__('Initial Header Height', 'upshot'),
				'default'       => array('height' => '150'),
				'required'  		=> array('header_floating', '=', array('4','10')),
				'hint'			=>	array(
					'content'	=>	'<p>The initial height of the header. Here you can setup the initial value (large header).</p>',
				)
			),
			array(
				'id'            => 'menu_bar_final_height',
				'type'          => 'dimensions',
				'width'         => false,
				'units'         => array('px','em'),
				'units_extended'=> 'false',
				'title'         => esc_html__('Final Header Height', 'upshot'),
				'default'       => array('height' => '100'),
				'required'  		=> array('header_floating', '=', array('4','10')),
				'hint'			=>	array(
					'content'	=>	'<p>For the shriking effect, here we setup smaller value for header bar. Give it a smaller value that above.</p>',
				)
			),
			
			// TRANSPARENT SETTINGS
			array(
				'id'                => 'header_transparent_display_after',
				'type'              => 'dimensions',
				'width'          	=> false,
				'units'             => array('px'),   // You can specify a unit value. Possible: px, em, %
				'units_extended'    => 'false',  // Allow users to select any type of unit
				'title'             => esc_html__('Slide down after:', 'upshot'),
				'subtitle'          => esc_html__('Header bar is scrolling up with the page. After this amount of scrolling it floats down and remains fixed to page top.', 'upshot'),
				'output'    			=> false,
				'default'           => array('height' => '200'),
				'required'  			=> array('header_floating', '=', array('5','11') ),
				'hint'				=>	array(
					'content'	=>	esc_html__('Define the scroll amount necesarry for header bar to be displayed. Leave blank for window screen height.', 'upshot'),
				)
			),
			array(
				'id'            => 'header_transp_bg_opacity_after_scroll',
				'type'          => 'slider',
				'title'     => esc_html__('Header Background Opacity After Scroll', 'upshot'),
				'subtitle'  => esc_html__('0 = Transparent, 1 - Opaque', 'upshot'),
				'default'       => 1,
				'min'           => 0,
				'step'          => .1,
				'max'           => 1,
				'resolution'    => 0.1,
				'display_value' => 'text',
				'required'  => array('header_floating', '=', array('5','11') ),
			),
			
			
			array(
				'id'        => 'header_background_type',
				'type'      => 'button_set',
				'title'     => esc_html__('Header background type:', 'upshot'),
				'options'   => array(
					'1' => esc_html__('Color', 'upshot'), 
					'2' => esc_html__('Image', 'upshot'), 
				),
				'default'   => '1',
				'hint'			=>	array(
					'content'	=>	esc_html__('What kind of background you wanna use for your header? You can have solid color, semi-transparent color, full transparent header, OR, you can use a image or a pattern.', 'upshot'),
				)
			),
			
			
			// FIXED SETTINGS
			array(
				'id'        => 'header_background_rgba',
				'type'      => 'color_rgba',
				'title'     => esc_html__('Header Background color', 'upshot'),
				'default'   => array('color' => '#ffffff', 'alpha' => '1.0'),
				'output'    => array('#hgr_top_navbar_container, #main_navbar .dropdown-menu, #main_navbar_left .dropdown-menu, #mainNavUlLeft .dropdown-menu, #mainNavUlRight .dropdown-menu'),
				'mode'      => 'background',
				'validate'  => 'colorrgba',
				'required'  => array('header_background_type', '=', array('1','7') ),
				'hint'			=>	array(
					'content'	=>	esc_html__('Gives you the RGBA color for header background. Also, this is where you set up the transparency grade.', 'upshot'),
				)
				
			),
			
			
			// Header BG color for TRANSPARENT
			array(
				'id'        => 'header_transparent_bg_rgba',
				'type'      => 'color_rgba',
				'title'     => esc_html__('Header Background color', 'upshot'),
				'subtitle'  => esc_html__('Gives you the RGBA color for background.', 'upshot'),
				'default'   => array('color' => '#ffffff', 'alpha' => '1.0'),
				'mode'      => 'background',
				'validate'  => 'colorrgba',
				'required'  => array('header_background_type', '=', array('5','11') ),
			),
			array(
				'id'        			=> 'header_background_image',
				'type'      			=> 'background',
				'output'   			=> array('#hgr_top_navbar_container, #main_navbar .dropdown-menu,, #main_navbar_left .dropdown-menu'),
				'title'    			=> esc_html__('Header Background Image or Pattern', 'upshot'),
				'subtitle'  			=> esc_html__('Pick a background image or pattern for the header.', 'upshot'),
				'default'   			=> '',
				'background-color'	=> false,
				'required' 			=> array('header_background_type', '=', array('2','8') ),
			),
			
			
			
			
			// GERERAL SETTINGS
			array(
				'id'        => 'header_opacity_change_after_scroll',
				'type'      => 'button_set',
				'title'     => esc_html__('Do you want header to change opacity after scroll?', 'upshot'),
				'options'   => array(
					'1' => esc_html__('Yes', 'upshot'), 
					'2' => esc_html__('No', 'upshot'), 
				),
				'default'   => '1',
				'required'  => array('header_floating', '=', array('1','7') ),
			),
			array(
				'id'                => 'header_background_opacity_change_after_amount',
				'type'              => 'dimensions',
				'width'          	=> false,
				'units'             => array('px'),   // You can specify a unit value. Possible: px, em, %
				'units_extended'    => 'false',  // Allow users to select any type of unit
				'title'             => esc_html__('Change opacity after scrolling X pixels', 'upshot'),
				'subtitle'          => esc_html__('Define the scroll amount necesarry for menu to change opacity.  Insert -1 for window screen height.', 'upshot'),
				'output'    		=> false,
				'default'           => array('height' => '200'),
				'required'  => array('header_opacity_change_after_scroll', '=', array('1','7') ),
			),
			array(
				'id'            => 'header_background_opacity_after_scroll',
				'type'          => 'slider',
				'title'     => esc_html__('Header Background Opacity After Scroll', 'upshot'),
				'subtitle'  => esc_html__('0 = Transparent, 1 - Opaque', 'upshot'),
				'default'       => 1,
				'min'           => 0,
				'step'          => .1,
				'max'           => 1,
				'resolution'    => 0.1,
				'display_value' => 'text',
				'required'  => array('header_opacity_change_after_scroll', '=', array('1','7') ),
			),
			array(
				'id'        => 'header_border',
				'type'      => 'border',
				'title'     => esc_html__('Header Border', 'upshot'),
				'compiler'	=> array('#hgr_top_navbar_container'),
				'output'    => array('#hgr_top_navbar_container'),
				'desc'      => esc_html__('Setup header border, in pixels (top, right, bottom, left).', 'upshot'),
				'all'       => false,
				'default'   => array(
					'border-color'  => '#cecece', 
					'border-style'  => 'solid', 
					'border-top'    => '0px', 
					'border-right'  => '0px', 
					'border-bottom' => '0px', 
					'border-left'   => '0px',
				)
			),
	
			array(
				'id'            => 'header_margins',
				'type'          => 'spacing',
				'output'        => array('#hgr_top_navbar_container'), // An array of CSS selectors to apply this font style to
				'mode'          => 'margin',    // absolute, padding, margin, defaults to padding
				'all'           => false,        // Have one field that applies to all
				'units'         => array('px','em'), // You can specify a unit value. Possible: px, em, %
				'units_extended'=> 'true',    // Allow users to select any type of unit
				'display_units' => 'true',   // Set to false to hide the units if the units are specified
				'title'         => esc_html__('Header Margins', 'upshot'),
				'subtitle'      => esc_html__('Choose the margin you want for your header.', 'upshot'),
				'default'       => array(
					'margin-top'    => '0', 
					'margin-right'  => '0', 
					'margin-bottom' => '0', 
					'margin-left'   => '0'
				)
			),
			array(
				'id'            => 'menu_bar_padding',
				'type'          => 'spacing',
				'output'        => array('#hgr_top_navbar_container'),
				'mode'          => 'padding',
				'all'           => false, 
				'units'         => array('px','em'),
				'units_extended'=> 'true',
				'display_units' => 'true',
				'title'         => esc_html__('Header Padding', 'upshot'),
				'subtitle'      => esc_html__('Choose the padding you want for your header.', 'upshot'),
				'default'       => array(
					'margin-top'    => '0', 
					'margin-right'  => '0', 
					'margin-bottom' => '0', 
					'margin-left'   => '0'
				),
				'required'  		=> array('header_floating', '!=', array('4','10') ),
			),
			array(
				'id'                => 'page_top_offset',
				'type'              => 'dimensions',
				'width'          	=> false,
				'units'             => array('px'),   // You can specify a unit value. Possible: px, em, %
				'units_extended'    => 'false',  // Allow users to select any type of unit
				'title'             => esc_html__('Page top offset', 'upshot'),
				'output'    			=> false,
				'default'           => array('height' => '-30'),
				'required'  			=> array('header_floating', '=', '6'),
				'hint'				=>	array(
					'content'	=>	'<p>Use this setting to offset the top of the page.</p>',
				)
			),
			
			/* Complex Header Styling */
			array(
				'id'        => 'section_complex_header_style',
				'type'      => 'section',
				'title'     => esc_html__('Complex Header Styling', 'upshot'),
				'subtitle'  => esc_html__('The sections below are available only for "Header bar display: Complex Header" chosen above. Complex header consists in 3 bars (rows) each containing different information and formating. Please style each row with the settings below.', 'upshot'),
				'indent'    => true, // Indent all options below until the next 'section' option is set.
				'required'  	=> array('header_floating', '=', '6'),
			),
			
			// TOP BAR
			array(
				'id'        => 'section_complex_header_style_top_bar',
				'type'      => 'section',
				'title'     => esc_html__('Top Bar', 'upshot'),
				'indent'    => true, // Indent all options below until the next 'section' option is set.
				'required'  	=> array('header_floating', '=', '6'),
			),
				array(
						'id'			=>	'fixed_menu-font_top_bar',
						'type'			=>	'typography',
						'title'			=>	esc_html__('Font', 'upshot'),
						'subtitle'		=>	esc_html__('Specify the menu font properties for top bar.', 'upshot'),
						'compiler'		=>	array('#hgr_fixed_menu .fixed_menu_top_bar'),
						'output'		=>	array('#hgr_fixed_menu .fixed_menu_top_bar'),
						'google'		=>	true,
						'letter-spacing'=>	true,
						'text-transform'=>	true,
						'color'			=>	true,
						'default'		=>	array(
							'font-size'			=>	'14px',
							'line-height'		=>	'60px',
							'font-family'		=>	'Roboto',
							'font-weight'		=>	'400',
							'letter-spacing'	=>	'',
							'color'				=>	'#ffffff'
						),
					),
					array(
						'id'        	=>	'fixed_menu-font-hover-color_top_bar',
						'type'      	=>	'link_color',
						'compiler'		=>	array('#hgr_fixed_menu .fixed_menu_top_bar a'),
						'output'		=>	array('#hgr_fixed_menu .fixed_menu_top_bar a'),
						'title'			=>	esc_html__('Links Color', 'upshot'),
						'subtitle'		=>	esc_html__('Specify the links color for top bar.', 'upshot'),
						'regular'   	=>	true,	// Enable / Disable Regular Color
						'hover'     	=>	true,	// Enable / Disable Hover Color
						'active'    	=>	false,	// Enable / Disable Active Color
						'visited'   	=>	false,	// Enable / Disable Visited Color
						'default'   	=>	array(
							'regular'	=>	'#000000',
							'hover'		=>	'#dd9933',
						)
					),
					array(
						'id'        => 'top_bar_background_rgba',
						'type'      => 'color_rgba',
						'title'     => esc_html__('Top Bar Background color', 'upshot'),
						'default'   => array('color' => '#ffffff', 'alpha' => '1.0'),
						'output'    => array('#hgr_fixed_menu .fixed_menu_top_bar'),
						'mode'      => 'background',
						'validate'  => 'colorrgba',
						'hint'			=>	array(
							'content'	=>	esc_html__('Gives you the RGBA color for top bar background. Also, this is where you set up the transparency grade.', 'upshot'),
						)
					),
					array(
						'id'		=>	'top_bar_left_column',
						'type'		=>	'textarea',
						'validate'	=>	'html',
						'title'		=>	esc_html__('Top bar, left side content', 'upshot'), 
						'subtitle'	=>	esc_html__('If empty, this section will be hidden.', 'upshot'),
						'desc'		=>	esc_html__('HTML is permited', 'upshot'),
						'default'	=>	'HOT Offers Get a quote <a href="#">NOW!</a>'
					),
					array(
						'id'            => 'top_bar_padding',
						'type'          => 'spacing',
						'mode'          => 'padding',
						'all'           => false, 
						'units'         => array('px','em'),
						'units_extended'=> 'true',
						'compiler'		=>	array('#hgr_fixed_menu .fixed_menu_top_bar'),
						'output'		=>	array('#hgr_fixed_menu .fixed_menu_top_bar'),
						'display_units' => 'true',
						'title'         => esc_html__('Top Bar Padding', 'upshot'),
						'default'       => array(
							'margin-top'    => '5px', 
							'margin-right'  => '5px', 
							'margin-bottom' => '5px', 
							'margin-left'   => '5px'
						),
					),
			
			// MIDDLE BAR
			array(
				'id'        => 'section_complex_header_style_middle_bar',
				'type'      => 'section',
				'title'     => esc_html__('Middle Bar', 'upshot'),
				'indent'    => true, // Indent all options below until the next 'section' option is set.
				'required'  	=> array('header_floating', '=', '6'),
			),
					array(
						'id'			=>	'fixed_menu-font_middle_bar',
						'type'			=>	'typography',
						'title'			=>	esc_html__('Font', 'upshot'),
						'subtitle'		=>	esc_html__('Specify the menu font properties for middle bar.', 'upshot'),
						'compiler'		=>	array('#hgr_fixed_menu .fixed_menu_middle_bar_left_side, #hgr_fixed_menu .fixed_menu_middle_bar_middle_side, #hgr_fixed_menu .fixed_menu_middle_bar_right_side'),
						'output'		=>	array('#hgr_fixed_menu .fixed_menu_middle_bar_left_side, #hgr_fixed_menu .fixed_menu_middle_bar_middle_side, #hgr_fixed_menu .fixed_menu_middle_bar_right_side'),
						'google'		=>	true,
						'letter-spacing'=>	true,
						'text-transform'=>	true,
						'color'			=>	true,
						'default'		=>	array(
							'font-size'			=>	'14px',
							'line-height'		=>	'60px',
							'font-family'		=>	'Roboto',
							'font-weight'		=>	'400',
							'letter-spacing'	=>	'',
							'color'				=>	'#ffffff'
						),
					),
					array(
						'id'        	=>	'fixed_menu-font-hover-color_middle_bar',
						'type'      	=>	'link_color',
						'compiler'		=>	array('#hgr_fixed_menu .fixed_menu_middle_bar_left_side a, #hgr_fixed_menu .fixed_menu_middle_bar_middle_side a, #hgr_fixed_menu .fixed_menu_middle_bar_right_side a'),
						'output'		=>	array('#hgr_fixed_menu .fixed_menu_middle_bar_left_side a, #hgr_fixed_menu .fixed_menu_middle_bar_middle_side a, #hgr_fixed_menu .fixed_menu_middle_bar_right_side a'),
						'title'			=>	esc_html__('Links Color', 'upshot'),
						'subtitle'		=>	esc_html__('Specify the links color for middle bar.', 'upshot'),
						'regular'   	=>	true,	// Enable / Disable Regular Color
						'hover'     	=>	true,	// Enable / Disable Hover Color
						'active'    	=>	false,	// Enable / Disable Active Color
						'visited'   	=>	false,	// Enable / Disable Visited Color
						'default'   	=>	array(
							'regular'	=>	'#000000',
							'hover'		=>	'#dd9933',
						)
					),
					array(
						'id'        => 'middle_bar_background_rgba',
						'type'      => 'color_rgba',
						'title'     => esc_html__('Middle Bar Background color', 'upshot'),
						'default'   => array('color' => '#ffffff', 'alpha' => '1.0'),
						'output'    => array('#hgr_fixed_menu .fixed_menu_middle_bar'),
						'mode'      => 'background',
						'validate'  => 'colorrgba',
						'hint'			=>	array(
							'content'	=>	esc_html__('Gives you the RGBA color for middle bar background. Also, this is where you set up the transparency grade.', 'upshot'),
						)
					),
					array(
						'id'		=>	'middle_bar_first_column',
						'type'		=>	'textarea',
						'validate'	=>	'html',
						'title'		=>	esc_html__('First column content', 'upshot'), 
						'subtitle'	=>	esc_html__('If empty, this section will be hidden.', 'upshot'),
						'desc'		=>	esc_html__('HTML is permited', 'upshot'),
						'default'	=>	'HOT Offers<br>Get a quote NOW!'
					),
					array(
						'id'		=>	'middle_bar_second_column',
						'type'		=>	'textarea',
						'validate'	=>	'html',
						'title'		=>	esc_html__('Second column content', 'upshot'), 
						'subtitle'	=>	esc_html__('If empty, this section will be hidden.', 'upshot'),
						'desc'		=>	esc_html__('HTML is permited', 'upshot'),
						'default'	=>	'HOT Offers<br>Get a quote NOW!'
					),
					array(
						'id'		=>	'middle_bar_third_column',
						'type'		=>	'textarea',
						'validate'	=>	'html',
						'title'		=>	esc_html__('Third column content', 'upshot'), 
						'subtitle'	=>	esc_html__('If empty, this section will be hidden.', 'upshot'),
						'desc'		=>	esc_html__('HTML is permited', 'upshot'),
						'default'	=>	'HOT Offers<br>Get a quote NOW!'
					),
					array(
						'id'            => 'middle_bar_padding',
						'type'          => 'spacing',
						'mode'          => 'padding',
						'all'           => false, 
						'units'         => array('px','em'),
						'units_extended'=> 'true',
						'compiler'		=>	array('#hgr_fixed_menu .fixed_menu_middle_bar'),
						'output'		=>	array('#hgr_fixed_menu .fixed_menu_middle_bar'),
						'display_units' => 'true',
						'title'         => esc_html__('Middle Bar Padding', 'upshot'),
						'default'       => array(
							'margin-top'    => '20px', 
							'margin-right'  => '0px', 
							'margin-bottom' => '20px', 
							'margin-left'   => '0px'
						),
					),
			
			// BOTTOM BAR
			array(
				'id'        => 'section_complex_header_style_bottom_bar',
				'type'      => 'section',
				'title'     => esc_html__('Bottom Bar', 'upshot'),
				'indent'    => true, // Indent all options below until the next 'section' option is set.
				'required'  	=> array('header_floating', '=', '6'),
			),
					array(
						'id'			=>	'fixed_menu-font',
						'type'			=>	'typography',
						'title'			=>	esc_html__('Menu Font', 'upshot'),
						'subtitle'		=>	esc_html__('Specify the menu font properties.', 'upshot'),
						'compiler'		=>	array('#hgr_fixed_menu .fixed_menu_bottom_bar, #hgr_fixed_menu .fixed_menu_bottom_bar .fixed_navbar_container .fixed_navbar>li>a, #hgr_fixed_menu .fixed_menu_bottom_bar .dropdown-menu > li > a'),
						'output'		=>	array('#hgr_fixed_menu .fixed_menu_bottom_bar, #hgr_fixed_menu .fixed_menu_bottom_bar .fixed_navbar_container .fixed_navbar>li>a, #hgr_fixed_menu .fixed_menu_bottom_bar .dropdown-menu > li > a'),
						'google'		=>	true,
						'letter-spacing'=>	true,
						'text-transform'=>	true,
						'color'			=>	false,
						'default'		=>	array(
							'font-size'			=>	'14px',
							'line-height'		=>	'60px',
							'font-family'		=>	'Roboto',
							'font-weight'		=>	'400',
							'letter-spacing'	=>	'',
						),
					),
					array(
						'id'        	=>	'fixed_menu-font-hover-color',
						'type'      	=>	'link_color',
						'compiler'		=>	array('#hgr_fixed_menu .fixed_menu_bottom_bar .fixed_navbar_container .fixed_navbar>li>a, #hgr_fixed_menu .fixed_menu_bottom_bar .dropdown-menu>li>a'),
						'output'		=>	array('#hgr_fixed_menu .fixed_menu_bottom_bar .fixed_navbar_container .fixed_navbar>li>a, #hgr_fixed_menu .fixed_menu_bottom_bar .dropdown-menu>li>a'),
						'title'			=>	esc_html__('Menu Font Color', 'upshot'),
						'subtitle'		=>	esc_html__('Specify the menu font color.', 'upshot'),
						'regular'   	=>	true,	// Enable / Disable Regular Color
						'hover'     	=>	true,	// Enable / Disable Hover Color
						'active'    	=>	false,	// Enable / Disable Active Color
						'visited'   	=>	false,	// Enable / Disable Visited Color
						'default'   	=>	array(
							'regular'	=>	'#000000',
							'hover'		=>	'#dd9933',
						)
					),
					array(
						'id'        => 'bottom_bar_background_rgba',
						'type'      => 'color_rgba',
						'title'     => esc_html__('Bottom Bar Background color', 'upshot'),
						'default'   => array('color' => '#ffffff', 'alpha' => '1.0'),
						'output'    => array('#hgr_fixed_menu .fixed_menu_bottom_bar, #fixed_navbar .dropdown-menu'),
						'mode'      => 'background',
						'validate'  => 'colorrgba',
						'hint'			=>	array(
							'content'	=>	esc_html__('Gives you the RGBA color for bottom bar background. Also, this is where you set up the transparency grade.', 'upshot'),
						)
					),
					array(
						'id'            => 'bottom_bar_padding',
						'type'          => 'spacing',
						'mode'          => 'padding',
						'all'           => false, 
						'units'         => array('px','em'),
						'units_extended'=> 'true',
						'compiler'		=>	array('#hgr_fixed_menu .fixed_menu_bottom_bar'),
						'output'		=>	array('#hgr_fixed_menu .fixed_menu_bottom_bar'),
						'display_units' => 'true',
						'title'         => esc_html__('Bottom Bar Padding', 'upshot'),
						'default'       => array(
							'margin-top'    => '5px', 
							'margin-right'  => '5px', 
							'margin-bottom' => '5px', 
							'margin-left'   => '5px'
						),
					),
					
		)
    ) );
	// Mobile Menu
	Redux::setSection( $opt_name, array(
        'id'			=> 'hgr_mobilemenu',
		'icon'		=> '',
		'title'		=>	esc_html__('Mobile Menu', 'upshot'),
		'subsection'=> true,
        'fields'		=> array(
			array(
				'id'				=>	'mobile-menu-font',
				'type'			=>	'typography',
				'title'			=>	esc_html__('Mobile Menu Font', 'upshot'),
				'subtitle'		=>	esc_html__('Specify the mobile menu font properties.', 'upshot'),
				'compiler'		=>	array('.cd-primary-nav a,  #mainNavUl .dropdown-menu.multi-level li a'),
				'output'			=>	array('.cd-primary-nav a,  #mainNavUl .dropdown-menu.multi-level li a'),
				'google'			=>	true,
				'letter-spacing'=>	true,
				'text-transform'=>	true,
				'color'			=>	false,
				'default'		=>	array(
					'font-size'			=>	'14px',
					'line-height'		=>	'60px',
					'font-family'		=>	'Roboto',
					'font-weight'		=>	'400',
					'letter-spacing'	=>	'',
				),
			),
			array(
				'id'        	=>	'mobile-menu-font-hover-color',
				'type'      	=>	'link_color',
				'compiler'	=>	array('.cd-primary-nav a, #mainNavUl .dropdown-menu.multi-level li a, a.mobilemenuopen'),
				'output'		=>	array('.cd-primary-nav a, #mainNavUl .dropdown-menu.multi-level li a, a.mobilemenuopen'),
				'title'		=>	esc_html__('Mobile Menu Font Color', 'upshot'),
				'subtitle'	=>	esc_html__('Specify the mobile menu font color.', 'upshot'),
				'regular'   	=>	true,	// Enable / Disable Regular Color
				'hover'     	=>	true,	// Enable / Disable Hover Color
				'active'    	=>	false,	// Enable / Disable Active Color
				'visited'   	=>	false,	// Enable / Disable Visited Color
				'default'   	=>	array(
					'regular'	=>	'#000000',
					'hover'		=>	'#dd9933',
				)
			),
			array(
				'id'        => 'mobile_menu_background_rgba',
				'type'      => 'color_rgba',
				'title'     => esc_html__('Mobile Menu Background color', 'upshot'),
				'default'   => array('color' => '#000000', 'alpha' => '0.9'),
				'output'    => array('.cd-primary-nav'),
				'mode'      => 'background',
				'validate'  => 'colorrgba',
				'hint'			=>	array(
					'content'	=>	esc_html__('Gives you the RGBA color for mobile menu background. Also, this is where you set up the transparency grade.', 'upshot'),
				)
				
			),
		)
    ) );
		
	
	// FOOTER SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'hgr_footer',
		'icon'		=> 'el-icon-hand-down',
		'title'		=>	esc_html__('Footer', 'upshot'),
        'fields'		=> array(
			array(
				'id'        => 'footer_fallback',
				'type'      => 'section',
				'title'     => esc_html__('Footer Fallback', 'upshot'),
				'indent'    => true, // Indent all options below until the next 'section' option is set.
			),
			array(
				'id'		=> 'footer-bgcolor',
				'type'		=> 'color',
				'title'		=>	esc_html__('Footer background color', 'upshot'), 
				'subtitle'	=>	esc_html__('Set the background color for footer', 'upshot'),
				'default'	=> '#222222',
				'validate'	=> 'color',
			),
			array(
				'id'		=>	'footer_color_scheme',
				'type'		=>	'select',
				'title'		=>	esc_html__('Color scheme to use on footer', 'upshot'), 
				'options'	=>	array('dark_scheme' => 'Dark scheme','light_scheme' => 'Light scheme'),
				'default'	=>	'dark_scheme'
			),
			array(
				'id'		=>	'footer-copyright',
				'type'		=>	'textarea',
				'validate'	=>	'html',
				'title'		=>	esc_html__('Footer copyright text', 'upshot'), 
				'subtitle'	=>	esc_html__('If empty, this section will be hidden.', 'upshot'),
				'desc'		=>	esc_html__('HTML is permited', 'upshot'),
				'default'	=>	sprintf( '%s <a href="%s">%s</a> %s', esc_html__('Copyright 2017', 'upshot'), esc_url( home_url() ), esc_attr( get_bloginfo('name') ), esc_html__('All rights reserved.', 'upshot') ),
			),
		)
    ) );
	// MEGA FOOTER SECTION
    Redux::setSection( $opt_name, array(
        'id'		=> 'hgr_megafooter',
		'icon'		=> 'el-icon-hand-down',
		'title'		=>	esc_html__('HGR MegaFooter', 'upshot'),
		'subsection'=> true,
        'fields'	=> array(
			
			!class_exists('HGR_MEGAFOOTER') ?  
			array(
						'id'    => 'hgr_megafooter_support_info',
						'type'  => 'info',
						'style' => 'warning',
						'title' => esc_html__( 'HGR MegaFooter Warning', 'upshot' ),
						'desc'  => sprintf( '%s <a href="%s">HGR MegaFooter</a> %s', esc_html__('Please first install and activate', 'upshot'), admin_url('plugins.php'), esc_html__('otherwise the "Footer Fallback" settings will be used.', 'upshot') ),
			)
			: NULL,
			array(
				'id'		=> 'hgr_megafooter_select',
				'type'		=> 'select',
				'data'		=> 'posts',
				'args'		=> array('post_type' => 'hgr_megafooter'),
				'title'		=> esc_html__( 'Default MegaFooter', 'upshot' ),
				'subtitle'	=> esc_html__( 'Select the default MegaFooter to be displayed on all pages.', 'upshot' ),
				'desc'		=> esc_html__( 'You can opt for a specific MegaFooter on a specific page when you edit that page. Otherwise, the default MegaFooter will be used on all pages across entire website', 'upshot' ),
			),
		)
    ) );
		
	
	// CONTACT FORM SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'hgr_contactform',
		'icon'		=>	'el el-brush',
		'title'		=>	esc_html__('Contact Form', 'upshot'),
		'desc'		=>	esc_html__('Style your Contact Form', 'upshot'),
        'fields'     => array(
			
			!class_exists('WPCF7') ?  
			array(
						'id'    => 'cf_support_info',
						'type'  => 'info',
						'style' => 'critical',
						'title' => esc_html__( 'Contact Form 7 Error', 'upshot' ),
						'desc'  => sprintf( '%s <a href="%s">here</a> %s', esc_html__('Please first activate Contact Form 7', 'upshot'), admin_url('plugins.php'), esc_html__(', otherwise the settings below will be ignored.', 'upshot') ),
			)
			: NULL,
			array(
				'id'					=> 'cf_label_font',
				'type'				=> 'typography',
				'compiler'			=>	array('.wpcf7 p'),
				'output'				=>	array('.wpcf7 p'),
				'title'				=>	esc_html__('Label Font', 'upshot'),
				'subtitle'			=>	esc_html__('Specify the labels font properties.', 'upshot'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#666666',
					'font-size'		=>	'12px',
					'line-height'	=>	'30px',
					'font-family'	=>	'Roboto',
					'font-weight'	=>	'700',
				),
			),
			array(
				'id'					=> 'cf_input_font',
				'type'				=> 'typography',
				'compiler'			=>	array('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea'),
				'output'				=>	array('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea'),
				'title'				=>	esc_html__('Input Font', 'upshot'),
				'subtitle'			=>	esc_html__('Specify the input font properties.', 'upshot'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#8e8e8e',
					'font-size'		=>	'12px',
					'line-height'	=>	'12px',
					'font-family'	=>	'Roboto',
					'font-weight'	=>	'400',
				),
			),
			array(
				'id'        =>	'cf_input_field_bg',
				'type'      =>	'color_rgba',
				'title'		=>	esc_html__('Input fields Background Color', 'upshot'),
				'default'   =>	array('color' => '', 'alpha' => ''),
				'compiler'	=>	array('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea'),
				'output'		=>	array('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea'),
				'mode'      =>	'background',
				'validate'  =>	'colorrgba',
			),
			array(
				'id'            => 'cf_input_field_roundness',
				'type'          => 'spacing',
				'mode'          => 'padding',
				'all'           => true, 
				'units'         => array('px'),
				'units_extended'=> 'true',
				'display_units' => 'true',
				'title'    		=> esc_html__('Input fields and button roundness', 'upshot'),
				'desc'      		=> esc_html__('Enter value in pixels, NUMBERS ONLY', 'upshot'),
				'default'       => array(
					'margin-top'    => '0', 
					'margin-right'  => '0', 
					'margin-bottom' => '0', 
					'margin-left'   => '0'
				)
			),
			array(
				'id'            => 'cf_input_padding',
				'type'          => 'spacing',
				'compiler'		=>	array('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea'),
				'output'			=>	array('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea'),
				'mode'          => 'padding',
				'all'           => false, 
				'units'         => array('px','em'),
				'units_extended'=> 'true',
				'display_units' => 'true',
				'title'         => esc_html__('Input fields Padding', 'upshot'),
				'subtitle'      => esc_html__('Choose the padding you want for your input fields.', 'upshot'),
				'default'       => array(
					'margin-top'    => '15', 
					'margin-right'  => '15', 
					'margin-bottom' => '15', 
					'margin-left'   => '15'
				)
			),
			array(
				'id'            => 'cf_input_margin',
				'type'          => 'spacing',
				'compiler'		=>	array('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea, .wpcf7 input[type=submit]'),
				'output'			=>	array('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea, .wpcf7 input[type=submit]'),
				'mode'          => 'margin',
				'all'           => false, 
				'units'         => array('px','em'),
				'units_extended'=> 'true',
				'display_units' => 'true',
				'title'         => esc_html__('Input fields Margin', 'upshot'),
				'subtitle'      => esc_html__('Choose the margin you want for your input fields.', 'upshot'),
				'default'       => array(
					'margin-top'    => '0', 
					'margin-right'  => '0', 
					'margin-bottom' => '12', 
					'margin-left'   => '0'
				)
			),
			array(
				'id'        => 'cf_input_border',
				'type'      => 'border',
				'title'     => esc_html__('Inputs Border', 'upshot'),
				'compiler'	=> array('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea'),
				'output'    => array('.wpcf7 input[type=text], .wpcf7 input[type=email], .wpcf7 textarea'),
				'desc'      => esc_html__('Setup input fields border, in pixels (top, right, bottom, left).', 'upshot'),
				'all'       => false,
				'default'   => array(
					'border-color'  => '#cecece', 
					'border-style'  => 'dotted', 
					'border-top'    => '1px', 
					'border-right'  => '1px', 
					'border-bottom' => '1px', 
					'border-left'   => '1px',
				)
			),
			array(
				'id'			=> 'cf_input_submit_height',
				'type'		=> 'dimensions',
				'title'     => esc_html__('Submit Button Height', 'upshot'),
				'subtitle'  => esc_html__('This must be numeric only.', 'upshot'),
				'desc'      => esc_html__('Enter value in pixels, NUMBERS ONLY', 'upshot'),
				'width'		=> false,
				'height'		=> true,
				'compiler'	=>	array('.wpcf7 input[type=submit]'),
				'output'		=>	array('.wpcf7 input[type=submit]'),
				'units'		=> array('px'),
				'default'	=> array(
					'height'=> 50, 
				),
			),
			array(
				'id'        => 'cf_input_submit_bg',
				'type'      => 'color_rgba',
				'title'		=>	esc_html__('Submit Button Background Color', 'upshot'),
				'subtitle'	=>	esc_html__('Regular state color.', 'upshot'),
				'default'   => array('color' => '#dd9933', 'alpha' => '1.0'),
				'compiler'	=>	array('.wpcf7 input[type=submit]'),
				'output'		=>	array('.wpcf7 input[type=submit]'),
				'mode'      => 'background',
				'validate'  => 'colorrgba',
			),
			array(
				'id'        => 'cf_input_submit_hover_bg',
				'type'      => 'color_rgba',
				'title'		=>	esc_html__('Submit Button Background Color', 'upshot'),
				'subtitle'	=>	esc_html__('Hover state color.', 'upshot'),
				'default'   => array('color' => '#be8124', 'alpha' => '1.0'),
				'compiler'	=>	array('.wpcf7 input[type=submit]:hover'),
				'output'		=>	array('.wpcf7 input[type=submit]:hover'),
				'mode'      => 'background',
				'validate'  => 'colorrgba',
			),
			array(
				'id'        	=>	'cf_input_submit_clr',
				'type'      	=>	'link_color',
				'compiler'	=>	array('.wpcf7 input[type=submit]'),
				'output'		=>	array('.wpcf7 input[type=submit]'),
				'title'		=>	esc_html__('Submit Button Text Color', 'upshot'), 
				'desc'      	=>	esc_html__('Setup button text color on regular and hovered state.', 'upshot'),
				'regular'   	=>	true,	// Enable / Disable Regular Color
				'hover'     	=>	true,	// Enable / Disable Hover Color
				'active'    	=>	false,	// Enable / Disable Active Color
				'visited'   	=>	false,	// Enable / Disable Visited Color
				'default'   	=>	array(
					'regular'	=>	'#ffffff',
					'hover'		=>	'#ffffff',
				)
			),
	
		)
    ) );
	
	
	// WOOCOMMERCE SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'hgr_woocommerce',
		'icon'		=> 'el el-picture',
		'title'		=>	esc_html__('WooCommerce', 'upshot'),
        'fields'		=> array(
			!class_exists( 'WooCommerce' ) ? 
			array(
				'id'    => 'top_info_bar',
				'type'  => 'info',
				'style' => 'critical',
				'title' => esc_html__( 'WooCommerce Error', 'upshot' ),
				'desc'  => sprintf( __( '<b>WooCommerce</b> is not active. Please install/activate <a href="%s">here</a>', 'upshot' ), admin_url('plugins.php') ),
				'required'	=> array('woo_support', '=', '1'),
			) : NULL,
			array(
				'id'			=>	'woo_support',
				'type'		=>	'switch',
				'title'		=>	esc_html__('Enable WooCommerce Support?', 'upshot'),
				'subtitle'	=>	esc_html__('If "Yes", the theme offers support for WooCommerce. Please install and activate WooCommerce before activating this option.', 'upshot'),
				'default'	=>	'0',
				'on'			=>	'Yes',
				'off'		=>	'No',
			),
			array(
				'id'			=>	'products_per_row',
				'type'		=>	'select',
				'title'     => esc_html__('Products per row', 'upshot'),
				'subtitle'  => esc_html__('How many products do you want to display on a row?', 'upshot'),
				'options'   => array(
					'2' => '2',
					'3' => '3', 
					'4' => '4',
					'5' => '5', 
					'6' => '6', 
				),
				'default'	=>	'3',
			),
			array(
				'id'					=> 'shop_body_font',
				'required' 			=>	array('woo_support', "=", 1),
				'type'				=> 'typography',
				'compiler'			=>	array('body.woocommerce'),
				'output'				=>	array('body.woocommerce'),
				'title'				=>	esc_html__('Body Font for shop content', 'upshot'),
				'subtitle'			=>	esc_html__('Specify the body font properties.', 'upshot'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#666666',
					'font-size'		=>	'14px',
					'line-height'	=>	'30px',
					'font-family'	=>	'Roboto',
					'font-weight'	=>	'400',
				),
			),
			array(
				'id'					=> 'shop_h3_font',
				'required' 			=>	array('woo_support', "=", 1),
				'type'				=> 'typography',
				'compiler'			=>	array('.woocommerce .product h3'),
				'output'				=>	array('.woocommerce .product h3'),
				'title'				=>	esc_html__('Listing Product Title', 'upshot'),
				'subtitle'			=>	esc_html__('Specify font properties for product title on the listing page.', 'upshot'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#000000',
					'font-size'		=>	'18px',
					'line-height'	=>	'24px',
					'font-family'	=>	'Roboto Slab',
					'font-weight'	=>	'400',
					'text-align'	=>	'left',
				),
			),
			array(
				'id'					=> 'shop_price_font',
				'required' 			=>	array('woo_support', "=", 1),
				'type'				=> 'typography',
				'compiler'			=>	array('.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, .woocommerce .related ul.products li.product .price, .woocommerce #content div.product span.price, .woocommerce div.product span.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product span.price'),
				'output'				=>	array('.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price, .woocommerce .related ul.products li.product .price, .woocommerce #content div.product span.price, .woocommerce div.product span.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product span.price'),
				'title'				=>	esc_html__('Listing Price', 'upshot'),
				'subtitle'			=>	esc_html__('Specify font properties for product price on the listing page.', 'upshot'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#666666',
					'font-size'		=>	'14px',
					'line-height'	=>	'30px',
					'font-family'	=>	'Roboto',
					'font-weight'	=>	'400',
					'text-align'	=>	'left',
				),
			),
			array(
				'id'					=> 'shop_h1_font',
				'required' 			=>	array('woo_support', "=", 1),
				'type'				=> 'typography',
				'compiler'			=>	array('.woocommerce #content div.product .product_title, .woocommerce div.product .product_title, .woocommerce-page #content div.product .product_title, .woocommerce-page div.product .product_title'),
				'output'				=>	array('.woocommerce #content div.product .product_title, .woocommerce div.product .product_title, .woocommerce-page #content div.product .product_title, .woocommerce-page div.product .product_title'),
				'title'				=>	esc_html__('Single Product Title', 'upshot'),
				'subtitle'			=>	esc_html__('Specify font properties for product title on the single product page.', 'upshot'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#000000',
					'font-size'		=>	'36px',
					'line-height'	=>	'40px',
					'font-family'	=>	'Roboto Slab',
					'font-weight'	=>	'300',
				),
			),
			array(
				'id'					=> 'shop_single_price_font',
				'required' 			=>	array('woo_support', "=", 1),
				'type'				=> 'typography',
				'compiler'			=>	array('.woocommerce div.product .summary span.price, .woocommerce div.product .summary p.price, .woocommerce #content div.product .summary span.price, .woocommerce #content div.product .summary p.price, .woocommerce-page div.product .summary span.price, .woocommerce-page div.product .summary p.price, .woocommerce-page #content div.product .summary span.price, .woocommerce-page #content div.product .summary p.price'),
				'output'				=>	array('.woocommerce div.product .summary span.price, .woocommerce div.product .summary p.price, .woocommerce #content div.product .summary span.price, .woocommerce #content div.product .summary p.price, .woocommerce-page div.product .summary span.price, .woocommerce-page div.product .summary p.price, .woocommerce-page #content div.product .summary span.price, .woocommerce-page #content div.product .summary p.price'),
				'title'				=>	esc_html__('Single Product Price', 'upshot'),
				'subtitle'			=>	esc_html__('Specify font properties for product price on the single product page.', 'upshot'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#666666',
					'font-size'		=>	'14px',
					'line-height'	=>	'30px',
					'font-family'	=>	'Roboto',
					'font-weight'	=>	'400',
				),
			),
			array(
				'id'					=> 'shop_h4_font',
				'required' 			=>	array('woo_support', "=", 1),
				'type'				=> 'typography',
				'compiler'			=>	array('.woocommerce h4'),
				'output'				=>	array('.woocommerce h4'),
				'title'				=>	esc_html__('Form titles', 'upshot'),
				'subtitle'			=>	esc_html__('Specify font properties for form titles (Ex: Billing address on Checkout Page).', 'upshot'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#000000',
					'font-size'		=>	'24px',
					'line-height'	=>	'30px',
					'font-family'	=>	'Roboto Condensed',
					'font-weight'	=>	'400',
				),
			),
			array(
				'id'        	=>	'shop_ahref_color',
				'required' 	=>	array('woo_support', "=", 1),
				'type'      	=>	'link_color',
				'compiler'	=>	array('.woocommerce .standAlonePage a, .woocommerce a' ),
				'output'		=>	array('.woocommerce .standAlonePage a, .woocommerce a'),
				'title'		=>	esc_html__('Links Color', 'upshot'), 
				'subtitle'	=>	esc_html__('Pick a color for links.', 'upshot'),
				'desc'      	=>	esc_html__('Setup links color on regular and hovered state.', 'upshot'),
				'regular'   	=>	true,
				'hover'     	=>	true,
				'active'    	=>	false,
				'visited'   	=>	false,
				'default'   	=>	array(
					'regular'	=>	'#000000',
					'hover'		=>	'#dd9933',
				)
			),
			array(
				'id'				=> 'shop_bg_color',
				'required' 		=>	array('woo_support', "=", 1),
				'type'			=> 'color',
				'title'			=>	esc_html__('Body Background Color', 'upshot'), 
				'subtitle'		=>	esc_html__('Pick a background color for blog.', 'upshot'),
				'default'		=> '#ffffff',
				'validate'		=> 'color',
			),
			array(
				'id'        => 'section_minicart',
				'type'      => 'section',
				'title'     => esc_html__('Minicart', 'upshot'),
				'indent'    => true, // Indent all options below until the next 'section' option is set.
				'required' 	=>	array('woo_support', "=", 1),
			),
			array(
				'id'				=> 'shop_minicart_icon_color',
				'required' 		=>	array('woo_support', "=", 1),
				'type'			=> 'color',
				'title'			=>	esc_html__('Minicart Icon Color', 'upshot'), 
				'subtitle'		=>	esc_html__('Pick a color for cart icon on the header.', 'upshot'),
				'default'		=> '#000000',
				'validate'		=> 'color',
				'transparent'	=>	false,	
				'compiler'		=>	array('.sage-cart-icon'),
				'output'			=>	array('.sage-cart-icon'),
			),
			array(
				'id'        	=>	'woo_bubble_color',
				'type'      	=>	'link_color',
				'title'		=>	esc_html__('Minicart bubble color', 'upshot'), 
				'subtitle'	=>	esc_html__('Pick a color for the mini-cart bubble.', 'upshot'),
				'desc'      	=>	esc_html__('Setup links color on regular and hovered state.', 'upshot'),
				'regular'   	=>	true,
				'hover'     	=>	true,
				'active'    	=>	false,
				'visited'   	=>	false,
				'default'   	=>	array(
					'regular'	=>	'#dd9933',
					'hover'		=>	'#dd9933',
				),
				'required' 	=>	array('woo_support', "=", 1),
			),
			array(
				'id'				=> 'shop_minicart_bubble_color',
				'required' 		=>	array('woo_support', "=", 1),
				'type'			=> 'color',
				'title'			=>	esc_html__('Minicart Bubble text color ', 'upshot'), 
				'subtitle'		=>	esc_html__('Color of the text into the minicart bubble (qty).', 'upshot'),
				'default'		=> '#ffffff',
				'validate'		=> 'color',
				'transparent'	=>	false,	
				'compiler'		=>	array('a.hgr_woo_minicart_content, .blog a.hgr_woo_minicart_content, div.woo_bubble a.hgr_woo_minicart_content'),
				'output'			=>	array('a.hgr_woo_minicart_content, .blog a.hgr_woo_minicart_content, div.woo_bubble a.hgr_woo_minicart_content'),
			),
			array(
				'id'        => 'section_qcv',
				'type'      => 'section',
				'title'     => esc_html__('Quick Cart View', 'upshot'),
				'indent'    => true, // Indent all options below until the next 'section' option is set.
				'required' 	=>	array('woo_support', "=", 1),
			),
			array(
				'id'        => 'qcv_bg_color',
				'type'      => 'color_rgba',
				'title'		=>	esc_html__('Quick Cart View Background Color', 'upshot'),
				'default'   => array('color' => '#f9f8f6', 'alpha' => '1.0'),
				'compiler'	=>	array('.qcv_container'),
				'output'		=>	array('.qcv_container'),
				'mode'      => 'background',
				'validate'  => 'colorrgba',
			),
			array(
				'id'        => 'qcv_border',
				'type'      => 'border',
				'title'     => esc_html__('Quick Cart View Border', 'upshot'),
				'compiler'	=> array('.qcv_container'),
				'output'    => array('.qcv_container'),
				'desc'      => esc_html__('Setup Quick Cart View border, in pixels (top, right, bottom, left).', 'upshot'),
				'all'       => false,
				'default'   => array(
					'border-color'  => '#cecece', 
					'border-style'  => 'solid', 
					'border-top'    => '2px', 
					'border-right'  => '2px', 
					'border-bottom' => '2px', 
					'border-left'   => '2px',
				)
			),
			array(
				'id'					=> 'qcv_itemTitle',
				'required' 			=>	array('woo_support', "=", 1),
				'type'				=> 'typography',
				'compiler'			=>	array('.qcv_item_title a, .qcv_item_title a:hover'),
				'output'				=>	array('.qcv_item_title a, .qcv_item_title a:hover'),
				'title'				=>	esc_html__('QuickCart View Item Title', 'upshot'),
				'subtitle'			=>	esc_html__('Specify font properties for QCV Items title', 'upshot'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#000000',
					'font-size'		=>	'14px',
					'line-height'	=>	'30px',
					'font-family'	=>	'Roboto',
					'font-weight'	=>	'400',
				),
			),
			array(
				'id'					=> 'qcv_itemSubTotal',
				'required' 			=>	array('woo_support', "=", 1),
				'type'				=> 'typography',
				'compiler'			=>	array('.qcv_item_subtotal'),
				'output'				=>	array('.qcv_item_subtotal'),
				'title'				=>	esc_html__('QuickCart View Item SubTotal', 'upshot'),
				'subtitle'			=>	esc_html__('Specify font properties for QCV Items Subtitle', 'upshot'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#000000',
					'font-size'		=>	'14px',
					'line-height'	=>	'14px',
					'font-family'	=>	'Roboto',
					'font-weight'	=>	'700',
				),
			),
			array(
				'id'					=> 'qcv_allSubTotal',
				'required' 			=>	array('woo_support', "=", 1),
				'type'				=> 'typography',
				'compiler'			=>	array('div.qcv_items_subtotal, div.qcv_items_subtotal span'),
				'output'				=>	array('div.qcv_items_subtotal, div.qcv_items_subtotal span'),
				'title'				=>	esc_html__('QuickCart All Items SubTotal', 'upshot'),
				'subtitle'			=>	esc_html__('Specify font properties for QCV Items Subtotal', 'upshot'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#000000',
					'font-size'		=>	'14px',
					'line-height'	=>	'30px',
					'font-family'	=>	'Roboto',
					'font-weight'	=>	'700',
				),
			),
			array(
				'id'        	=>	'qcv_gtc_btn_bg_color',
				'type'      	=>	'link_color',
				'title'		=>	esc_html__('Go To Cart Button Background Color', 'upshot'), 
				'regular'   	=>	true,
				'hover'     	=>	true,
				'active'    	=>	false,
				'visited'   	=>	false,
				'default'   	=>	array(
					'regular'	=>	'#dd9933',
					'hover'		=>	'#dd9933',
				),
				'required' 	=>	array('woo_support', "=", 1),
			),
			array(
				'id'        	=>	'qcv_chk_btn_bg_color',
				'type'      	=>	'link_color',
				'title'		=>	esc_html__('Checkout Button Background Color', 'upshot'), 
				'regular'   	=>	true,
				'hover'     	=>	true,
				'active'    	=>	false,
				'visited'   	=>	false,
				'default'   	=>	array(
					'regular'	=>	'#dd9933',
					'hover'		=>	'#dd9933',
				),
				'required' 	=>	array('woo_support', "=", 1),
			),
			array(
				'id'					=> 'qcv_btns',
				'required' 			=>	array('woo_support', "=", 1),
				'type'				=> 'typography',
				'compiler'			=>	array('a.qcv_button_cart, a.qcv_button_checkout, a.qcv_button_cart:hover, a.qcv_button_checkout:hover'),
				'output'				=>	array('a.qcv_button_cart, a.qcv_button_checkout, a.qcv_button_cart:hover, a.qcv_button_checkout:hover'),
				'title'				=>	esc_html__('Quick Cart View Buttons Font', 'upshot'),
				'subtitle'			=>	esc_html__('Specify font properties for QCV buttons', 'upshot'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#ffffff',
					'font-size'		=>	'14px',
					'line-height'	=>	'30px',
					'font-family'	=>	'Roboto',
					'font-weight'	=>	'700',
				),
			),
			array(
				'id'			=> 'custom_empty_cart',
				'type'		=> 'select',
				'data'		=> 'posts',
				'args'		=> array('post_type' => 'page', 'nopaging' => true),
				'title'		=> esc_html__( 'Custom "Empty Cart" page', 'upshot' ),
				'subtitle'	=> esc_html__( 'Select your custom empty cart page.', 'upshot' ),
				'desc'		=> esc_html__( 'Go to pages and create your custom empty cart page. After this, you can select it from here.', 'upshot' ),
			),
		)
    ) );
	
	// BLOG SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'hgr_blog',
		'icon'		=> 'el-icon-screen',
		'title'		=>	esc_html__('Blog', 'upshot'),
        'fields'		=> array(
			array(
				'id'					=> 'blog_body_font',
				'type'				=> 'typography',
				'compiler'			=>	array('body.blog, body.single-post, body.search, body.archive'),
				'output'				=>	array('body.blog, body.single-post, body.search, body.archive'),
				'title'				=>	esc_html__('Body Font for blog', 'upshot'),
				'subtitle'			=>	esc_html__('Specify the body font properties.', 'upshot'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#666666',
					'font-size'		=>	'12px',
					'line-height'	=>	'28px',
					'font-family'	=>	'Roboto',
					'font-weight'	=>	'400',
				),
			),
			array(
				'id'					=> 'blog_h1_font',
				'type'				=> 'typography',
				'compiler'			=>	array('.blog h1, body.single-post h1, .archive h1'),
				'output'				=>	array('.blog h1, body.single-post h1'),
				'title'				=>	esc_html__('H1 Font', 'upshot'),
				'subtitle'			=>	esc_html__('Specify the H1 font properties.', 'upshot'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#000000',
					'font-size'		=>	'36px',
					'line-height'	=>	'50px',
					'font-family'	=>	'Roboto Slab',
					'font-weight'	=>	'400',
				),
			),
			array(
				'id'					=> 'blog_h2_font',
				'type'				=> 'typography',
				'compiler'			=>	array('.blog h2, body.single-post h2'),
				'output'				=>	array('.blog h2, body.single-post h2'),
				'title'				=>	esc_html__('H2 Font', 'upshot'),
				'subtitle'			=>	esc_html__('Specify the H2 font properties.', 'upshot'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#000000',
					'font-size'		=>	'14px',
					'line-height'	=>	'24px',
					'font-family'	=>	'Roboto Condensed',
					'font-weight'	=>	'400',
				),
			),
			array(
				'id'					=> 'blog_h3_font',
				'type'				=> 'typography',
				'compiler'			=>	array('.blog h3, body.single-post h3'),
				'output'				=>	array('.blog h3, body.single-post h3'),
				'title'				=>	esc_html__('H3 Font', 'upshot'),
				'subtitle'			=>	esc_html__('Specify the H3 font properties.', 'upshot'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#646464',
					'font-size'		=>	'22px',
					'line-height'	=>	'38px',
					'font-family'	=>	'Georgia, serif',
					'font-weight'	=>	'400',
				),
			),
			array(
				'id'					=> 'blog_h4_font',
				'type'				=> 'typography',
				'compiler'			=>	array('.blog h4, body.single-post h4'),
				'output'				=>	array('.blog h4, body.single-post h4'),
				'title'				=>	esc_html__('H4 Font', 'upshot'),
				'subtitle'			=>	esc_html__('Specify the H4 font properties.', 'upshot'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#000000',
					'font-size'		=>	'18px',
					'line-height'	=>	'30px',
					'font-family'	=>	'Roboto Slab',
					'font-weight'	=>	'400',
				),
			),
			array(
				'id'					=> 'blog_h5_font',
				'type'				=> 'typography',
				'compiler'			=>	array('.blog h5, body.single-post h5'),
				'output'				=>	array('.blog h5, body.single-post h5'),
				'title'				=>	esc_html__('H5 Font', 'upshot'),
				'subtitle'			=>	esc_html__('Specify the H5 font properties.', 'upshot'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#646464',
					'font-size'		=>	'46px',
					'line-height'	=>	'50px',
					'font-family'	=>	'Open Sans',
					'font-weight'	=>	'600',
				),
			),
			array(
				'id'					=> 'blog_h6_font',
				'type'				=> 'typography',
				'compiler'			=>	array('.blog h6, body.single-post h6'),
				'output'				=>	array('.blog h6, body.single-post h6'),
				'title'				=>	esc_html__('H6 Font', 'upshot'),
				'subtitle'			=>	esc_html__('Specify the H6 font properties.', 'upshot'),
				'google'				=>	true,
				'color'				=>	true,
				'text-transform'	=>	true,
				'default'			=>	array(
					'color'			=>	'#646464',
					'font-size'		=>	'16px',
					'line-height'	=>	'24px',
					'font-family'	=>	'Source Sans Pro',
					'font-weight'	=>	'300',
				),
			),
			array(
				'id'        	=>	'blog_ahref_color',
				'type'      	=>	'link_color',
				'compiler'	=>	array('.blog a, .megamenu a'),
				'output'		=>	array('.blog a, .megamenu a'),
				'title'		=>	esc_html__('Links Color', 'upshot'), 
				'subtitle'	=>	esc_html__('Pick a color for links.', 'upshot'),
				'desc'      	=>	esc_html__('Setup links color on regular and hovered state.', 'upshot'),
				'regular'   	=>	true,	// Enable / Disable Regular Color
				'hover'     	=>	true,	// Enable / Disable Hover Color
				'active'    	=>	false,	// Enable / Disable Active Color
				'visited'   	=>	false,	// Enable / Disable Visited Color
				'default'   	=>	array(
					'regular'	=>	'#000000',
					'hover'		=>	'#dd9933',
				)
			),
			array(
				'id'			=> 'blog_bg_color',
				'type'		=> 'color',
				'title'		=>	esc_html__('Body Background Color', 'upshot'), 
				'subtitle'	=>	esc_html__('Pick a background color for blog.', 'upshot'),
				'default'	=> '#ffffff',
				'validate'	=> 'color',
			),
		)
    ) );
	
	// CUSTOM CODE SECTION
    Redux::setSection( $opt_name, array(
        'title'		=>	esc_html__('Custom Code', 'upshot'),
        'id'         => 'hgr_custom_code',
        'fields'     => array(
			array(
				'id'        => 'enable_css-code',
				'type'      => 'button_set',
				'title'     => esc_html__('Enable Custom CSS?', 'upshot'),
				'subtitle'  => esc_html__('Do you want to enable custom css?', 'upshot'),
				'options'   => array(
					'custom_css_on'		=> esc_html__('Enabled', 'upshot'), 
					'custom_css_off'	=> esc_html__('Disabled', 'upshot'), 
				), 
				'default'   => 'custom_css_off'
			),
			array(
				'id'        => 'css-code',
				'type'      => 'ace_editor',
				'title'     => esc_html__('CSS Code', 'upshot'),
				'subtitle'  => esc_html__('Paste your CSS code here.', 'upshot'),
				'mode'      => 'css',
				'theme'     => 'monokai',
				'default'   => "",
				'required'  => array('enable_css-code', '=', 'custom_css_on'),
			),
			array(
				'id'        => 'enable_js-code',
				'type'      => 'button_set',
				'title'     => esc_html__('Enable Custom JS?', 'upshot'),
				'subtitle'  => esc_html__('Do you want to enable custom js?', 'upshot'),
				'options'   => array(
					'custom_js_on'		=> esc_html__('Enabled', 'upshot'), 
					'custom_js_off'	=> esc_html__('Disabled', 'upshot'), 
				), 
				'default'   => 'custom_js_off'
			),
			array(
				'id'        => 'js-code',
				'type'      => 'ace_editor',
				'title'     => esc_html__('JS Code', 'upshot'),
				'subtitle'  => esc_html__('Paste your JS code here.', 'upshot'),
				'mode'      => 'javascript',
				'theme'     => 'chrome',
				'default'   => "jQuery(document).ready(function(){\n\n});",
				'required'  => array('enable_js-code', '=', 'custom_js_on'),
			),
		)
    ) );
	
	
	/*
     * <--- END SECTIONS
     */




    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'upshot' ),
                'desc'   => '<p class="description">'.esc_html__('This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.','upshot').'</p>',
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }


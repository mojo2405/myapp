<?php
/*
* Add-on Name: HGR Progress Bar
* Add-on URI: http://highgradelab.com/plugins/highgrade-extender/
* Based on Bootstrap
* Since: 1.0
* Author: Eugen Petcu
*/
if(!class_exists('HGR_VC_PROGRESSBAR')) {
	class HGR_VC_PROGRESSBAR extends WPBakeryShortCode {

		function __construct() {
			add_action('admin_init', array($this, 'hgr_progressbar_init'));
			
			add_shortcode( 'hgr_progressbar', array($this, 'hgr_progressbar') );
			
			
			/*
				Param type "number"
			*/ 
			if ( function_exists('vc_add_shortcode_param')){
				vc_add_shortcode_param('number' , array('HGR_XTND', 'make_number_input' ) );
			}
		}
		
		/*
			Visual Composer mapping function
			Public API
			Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
			Example:		http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*/	
		function hgr_progressbar_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"				=>	__("HGR Progress Bar", "hgrextender"),
					   "holder"			=>	"div",
					   "base"				=>	"hgr_progressbar",
					   "class"				=>	"",
					   "icon"				=>	"hgr_progressbar",
					   "description"		=>	__("Progress bar with advanced parameters", "hgrextender"),
					   "category"			=>	__("HighGrade Extender", "hgrextender"),
					   "content_element"	=>	true,
					   "params"				=>	array(
						   array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon Type:", "hgrextender"),
								"param_name"	=>	"hgr_progressbar_icontype",
								"value"			=>	array(
										__( 'Font Icon Browser', 'hgrextender' )	=> 'selector',
										__( 'Custom Image Icon', 'hgrextender' )	=> 'custom',
									),
								"save_always" 	=> true,
								"description"	=>	__("Use an existing font icon or upload a custom image.", "hgrextender"),
							),
							array(
								"type"			=>	 "icon_browser",
								"class"			=>	"",
								"heading"		=>	__("Select Icon:", "hgrextender"),
								"param_name"	=>	"hgr_progressbar_icon",
								"value"			=>	"icon",
								"description"	=>	__("Click on an icon to select it.", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"hgr_progressbar_icontype",
										"value"			=>	array( "selector" ),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Icon Size:", "hgrextender"),
								"param_name"	=>	"hgr_progressbar_icnsize",
								"value"			=>	25,
								"min"			=>	12,
								"max"			=>	72,
								"suffix"		=>	"px",
								"description"	=>	__("Select icon size.", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"hgr_progressbar_icontype",
										"value"			=>	array( "selector" ),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon Color:", "hgrextender"),
								"param_name"	=>	"hgr_progressbar_icncolor",
								"value"			=>	"#222222",
								"description"	=>	__("Select prefered color for your icon.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"hgr_progressbar_icontype",
										"value"		=>	array( "selector" ),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"attach_image",
								"class"			=>	"",
								"heading"		=>	__("Upload Image Icon:", "hgrextender"),
								"param_name"	=>	"hgr_progressbar_img",
								"admin_label"	=>	true,
								"value"			=>	"",
								"description"	=>	__("Upload the custom image icon.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"hgr_progressbar_icontype",
										"value"		=>	array( "custom" ),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Image Icon Width:", "hgrextender"),
								"param_name"	=>	"hgr_progressbar_imgwidth",
								"value"			=>	48,
								"min"			=>	16,
								"max"			=>	512,
								"suffix"		=>	"px",
								"description"	=>	__("Provide image width.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"hgr_progressbar_icontype",
										"value"		=>	array( "custom" ),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Progress Bar Title:", "hgrextender"),
								"param_name"	=>	"hgr_progressbar_title",
								"value"			=>	"Awesome Progress Bar",
								"description"	=>	__("Title for progress bar.", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Title HTML Format", "hgrextender"),
								"param_name"	=>	"hgr_progressbar_title_format",
								"value"			=>	array(
									__( 'H1', 'hgrextender' ) => 'h1',
									__( 'H2', 'hgrextender' ) => 'h2',
									__( 'H3', 'hgrextender' ) => 'h3',
									__( 'H4', 'hgrextender' ) => 'h4',
									__( 'H5', 'hgrextender' ) => 'h5',
									__( 'H6', 'hgrextender' ) => 'h6',
								),
								"std"			=>	"h2",
								"save_always"	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Progress Bar Title Color:", "hgrextender"),
								"param_name"	=>	"hgr_progressbar_title_color",
								"value"			=>	"#808080",
								"description"	=>	__("Select color for progress bar title.", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Progress Bar Base Color:", "hgrextender"),
								"param_name"	=>	"hgr_progressbar_basecolor",
								"value"			=>	"#808080",
								"description"	=>	__("Bar background color.", "hgrextender"),	
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Progress Bar Fill Color:", "hgrextender"),
								"param_name"	=>	"hgr_progressbar_color",
								"value"			=>	"#F9464A",
								"description"	=>	__("Bar fill color.", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Progress Bar Value:", "hgrextender"),
								"param_name"	=>	"hgr_progressbar_value",
								"value"			=>	50,
								"min"			=>	0,
								"max"			=>	100,
								"suffix"		=>	"%",
								"description"	=>	__("Progress bar filling value %.", "hgrextender"),	
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Progress Bar Filling Time:", "hgrextender"),
								"param_name"	=>	"hgr_progressbar_filltime",
								"value"			=>	1,
								"min"			=>	1,
								"max"			=>	15,
								"suffix" 		=>	"seconds",							
								"description"	=>	__("Filling duration measured in seconds.", "hgrextender"),	
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Progress Bar Weight:", "hgrextender"),
								"param_name"	=>	"hgr_progressbar_weight",
								"value"			=>	3,
								"min"			=>	1,
								"max"			=>	30,
								"suffix"		=>	"px",
								"description"	=>	__("The bar weight in pixels.", "hgrextender"),	
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Progress Bar Style:", "hgrextender"),
								"param_name"	=>	"hgr_progressbar_type",
								"value"			=>	array(
										__( 'Simple', 'hgrextender' )					=> '',
										__( 'With Stripes', 'hgrextender' )				=> 'hgr_striped',
										__( 'With Animated Stripes', 'hgrextender' )	=> 'hgr_striped hgr_animated_striped',
									),
								"save_always" 	=> true,
								"description"	=>	__("Select progress bar style from the dropdown.", "hgrextender"),
							),
							array(
								"type"			=>	"checkbox",
								"heading"		=>	__("Hide progress bar value marker:", "hgrextender"),
								"param_name"	=>	"hgr_progressbar_marker",
								"description"	=>	__("If checked this will hide value marker.", "hgrextender"),
								"value"			=>	array( esc_html__("Yes, please", "hgrextender") => "yes" ),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Extra Class:", "hgrextender"),
								"param_name"	=>	"hgr_progressbar_extraclass",
								"value"			=>	"",
								"description"	=>	__("Add extra class name. You can use this class for your customizations.", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								'type' => 'css_editor',
								'heading' => __( 'Css', 'hgrextender' ),
								'param_name' => 'css',
								'group' => __( 'Design options', 'hgrextender' ),
							),
					   )
					) 
				);
			}
		}
		
		function hgr_progressbar ($atts) {
			
		/*
			Include required scripts
		*/
		wp_enqueue_script('hgr-vc-jquery-appear');
		wp_enqueue_script('hgr-vc-progressbar');
		
		
		/*
			Empty vars declaration
		*/
		$output = $do_icon = $hgr_progressbar_title = $hgr_progressbar_title_format = $hgr_progressbar_title_color = $hgr_progressbar_basecolor = $hgr_progressbar_color = 
		$hgr_progressbar_value = $hgr_progressbar_filltime = $hgr_progressbar_weight = $hgr_progressbar_type = $hgr_progressbar_icontype = 
		$hgr_progressbar_icon = $hgr_progressbar_img = $hgr_progressbar_imgwidth = $hgr_progressbar_icnsize = $hgr_progressbar_icncolor = 
		$hgr_progressbar_marker = $hgr_progressbar_extraclass = $css = '';
		
		
		/*
			WordPress function to extract shortcodes attributes
			Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
		*/
		extract(shortcode_atts(array(
			'hgr_progressbar_title'		=> '',
			'hgr_progressbar_title_format'=> '',
			'hgr_progressbar_title_color'=> '',
			'hgr_progressbar_basecolor'	=> '',
			'hgr_progressbar_color'		=> '',
			'hgr_progressbar_value'		=> '',
			'hgr_progressbar_filltime'	=> '',
			'hgr_progressbar_weight'	=> '',
			'hgr_progressbar_type'		=> '',
			'hgr_progressbar_icontype'	=> '',
			'hgr_progressbar_icon'		=> '',
			'hgr_progressbar_img'		=> '',
			'hgr_progressbar_imgwidth'	=> '',
			'hgr_progressbar_icnsize'	=> '',
			'hgr_progressbar_icncolor'	=> '',
			'hgr_progressbar_marker'	=> '',
			'hgr_progressbar_extraclass'=> '',
			'css'						=>	''
		), $atts));
		
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
		
		$bar_id = 'hgr_progressbar_'.uniqid();
		
		/*
			Do the icon
			Font icon or image icon...
		*/
		if( $hgr_progressbar_icontype == 'selector' && !empty($hgr_progressbar_icon) ) {
			$do_icon = '<div class="hgr-progb-icon" style="padding-right:'.$hgr_progressbar_icnsize / 2 .'px; width:'.$hgr_progressbar_icnsize.'px; height:'.$hgr_progressbar_icnsize.'px;">'.do_shortcode('[icon name="'.$hgr_progressbar_icon.'" size="'.$hgr_progressbar_icnsize.'px" height="'.$hgr_progressbar_icnsize.'px" color="'.$hgr_progressbar_icncolor.'"]').'</div>';
		}
		/* Image icon */
		elseif($hgr_progressbar_icontype == 'custom' && !empty($hgr_progressbar_img)){
			$hgr_progressbar_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $hgr_progressbar_img, 'thumb_size' => 'full', 'class' => "hgr_progressbar_imgicon" ) );
			$do_icon = '<div class="hgr-progb-icon" style="padding-right:'.$hgr_progressbar_imgwidth / 2 .'px; width:'.$hgr_progressbar_imgwidth.'px;"><div style="width:'.$hgr_progressbar_imgwidth.'px;">'.$hgr_progressbar_img_array['thumbnail'].'</div></div>';
		}
		
		$output .='<div id="#'.$bar_id.'" class="hgr_progressbar '.$hgr_progressbar_extraclass.' ' . esc_attr( $css_class ) . '">';
			$output .= '<div class="hgr-progb-icontext">';
				$output .= $do_icon;
				$output .= '<div class="hgr-progb-text"><'.$hgr_progressbar_title_format.' style="color:'.$hgr_progressbar_title_color.';">'.$hgr_progressbar_title.'</'.$hgr_progressbar_title_format.'></div>';
			$output .= '</div>';
			$output .= '<div class="hgr_progressbarfull" style="height:'.$hgr_progressbar_weight.'px; background-color: '.$hgr_progressbar_basecolor.';">';
				$output .= '<div class="hgr_progressbarfill '.$hgr_progressbar_type.'" style="height: '.$hgr_progressbar_weight.'px; background-color: '.$hgr_progressbar_color.';" data-value="'.$hgr_progressbar_value.'" data-time="'.($hgr_progressbar_filltime*1000).'">';
					if($hgr_progressbar_marker !== 'yes') {
						$output .= '<span class="hgr_progressbarmarker">'.$hgr_progressbar_value.'%</span>';
					}
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';
		
		/*
			Return the output
		*/
		return $output;
	}
	}
	new HGR_VC_PROGRESSBAR;
}

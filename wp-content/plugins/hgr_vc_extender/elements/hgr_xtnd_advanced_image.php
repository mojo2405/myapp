<?php
/*
* Add-on Name: Advanced Image
* Add-on URI: http://highgradelab.com/plugins/highgrade-extender/
* Since: 1.0
* Author: Eugen Petcu
*/
if(!class_exists('HGR_VC_ADVIMAGE')) {
	class HGR_VC_ADVIMAGE extends WPBakeryShortCode {

		function __construct() {
			add_action('admin_init', array($this, 'hgr_advimage_init'));
			add_shortcode( 'hgr_advimage', array($this, 'hgr_advimage') );
		}
		
		/*
			Visual Composer mapping function
			Public API
			Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
			Example:	http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*/
		function hgr_advimage_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"				=>	__("HGR Advanced Image", "hgrextender"),
					   "holder"				=>	"div",
					   "base"				=>	"hgr_advimage",
					   "class"				=>	"",
					   "icon"				=>	"hgr_advimage",
					   "description"		=>	__("Image with advanced parameters", "hgrextender"),
					   "category"			=>	__("HighGrade Extender", "hgrextender"),
					   "content_element"	=>	true,
					   "params"				=>	array(
					   		array(
								"type"			=>	"attach_image",
								"class"			=>	"",
								"heading"		=>	__("Image Upload", "hgrextender"),
								"param_name"	=>	"hgr_advimage_image",
								"admin_label"	=>	true,
								"value"			=>	"",
								"description"	=>	__("Upload or select image to use", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Element height:", "hgrextender"),
								"description"	=>	__("Element height. Numeric values only, in pixels. Width will be 100% of column.", "hgrextender"),
								"param_name"	=>	"hgr_advimage_height",
								"value"			=>	"250",
								"save_always" 	=>	true,
							),
							array(
								 "type"			=>	"textarea",
								 "class"		=>	"",
								 "heading"		=>	__("Title:","hgrextender"),
								 "param_name"	=>	"hgr_advimage_title",
								 "value"		=>	"",
								 "description"	=>	__("Element title is always displayed over the image.","hgrextender"),
								 "save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Title bottom padding:", "hgrextender"),
								"description"	=>	__("Use it to lift title into element.", "hgrextender"),
								"param_name"	=>	"hgr_advimage_title_padding",
								"value"			=>	"250",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("HTML tag tor title:", "hgrextender"),
								"param_name"	=>	"hgr_advimage_title_h",
								"value"			=>	array(
										"H1"	=>	"h1",
										"H2"	=>	"h2",
										"H3"	=>	"h3",
										"H4"	=>	"h4",
										"H5"	=>	"h5",
										"H6"	=>	"h6",
									),
								"std"			=>	"h2",
								"save_always" 	=>	true,
							),
							array(
								 "type"			=>	"textarea_html",
								 "class"		=>	"",
								 "heading"		=>	__("Description:","hgrextender"),
								 "param_name"	=>	"content",
								 "value"		=>	__( "<p>I am test text block. Click edit button to change this text.</p>", "hgrextender" ),
								 "description"	=>	__("Insert the content to be displayed on image hover.","hgrextender"),
								 "save_always" 	=>	true,
							),
							
							// Normal state
						   array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Title color (normal state):", "hgrextender"),
								"param_name"	=>	"hgr_advimage_title_color",
								"value"			=>	"",
								"description"	=>	__("Select title color for normal state.", "hgrextender"),
								"save_always" 	=>	true,					
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Description color:", "hgrextender"),
								"param_name"	=>	"hgr_advimage_description_color",
								"value"			=>	"",
								"description"	=>	__("Select description color.", "hgrextender"),
								"save_always" 	=>	true,					
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Overlay color (normal state):", "hgrextender"),
								"param_name"	=>	"hgr_advimage_overlay_color",
								"value"			=>	"",
								"description"	=>	__("Select overlay color (normal state)", "hgrextender"),
								"save_always" 	=>	true,					
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Border width (normal state):", "hgrextender"),
								"description"	=>	__("Numeric values only, in pixels.", "hgrextender"),
								"param_name"	=>	"hgr_advimage_border_width",
								"value"			=>	"10",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Border color (normal state):", "hgrextender"),
								"param_name"	=>	"hgr_advimage_border_color",
								"value"			=>	"",
								"description"	=>	__("Select border color (normal state)", "hgrextender"),
								"save_always" 	=>	true,					
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Border radius (normal state):", "hgrextender"),
								"description"	=>	__("Numeric values only, in pixels.", "hgrextender"),
								"param_name"	=>	"hgr_advimage_border_radius",
								"value"			=>	"0",
								"save_always" 	=>	true,
							),
							// Hover state
						   array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Title color (hover state):", "hgrextender"),
								"param_name"	=>	"hgr_advimage_title_color_hover",
								"value"			=>	"",
								"description"	=>	__("Select title color for hover state.", "hgrextender"),
								"save_always" 	=>	true,					
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Overlay color (hover state):", "hgrextender"),
								"param_name"	=>	"hgr_advimage_overlay_color_hover",
								"value"			=>	"",
								"description"	=>	__("Select overlay color (hover state)", "hgrextender"),
								"save_always" 	=>	true,					
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Border width (hover state):", "hgrextender"),
								"description"	=>	__("Numeric values only, in pixels.", "hgrextender"),
								"param_name"	=>	"hgr_advimage_border_width_hover",
								"value"			=>	"10",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Border color (hover state):", "hgrextender"),
								"param_name"	=>	"hgr_advimage_border_color_hover",
								"value"			=>	"",
								"description"	=>	__("Select border color (hover state)", "hgrextender"),
								"save_always" 	=>	true,					
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Border radius (hover state):", "hgrextender"),
								"description"	=>	__("Numeric values only, in pixels.", "hgrextender"),
								"param_name"	=>	"hgr_advimage_border_radius_hover",
								"value"			=>	"0",
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
		
		function hgr_advimage ($atts, $content = null) {
			/*
				Include required JS and CSS files
			*/
			//wp_enqueue_script('hgr-vc-hoverdir');
			wp_enqueue_script('hgr-advimage');
			
			/*
				 Empty vars declaration
			*/
			$output = $hgr_advimage_image = $hgr_advimage_height = $hgr_advimage_title = $hgr_advimage_title_padding = $hgr_advimage_title_h = $hgr_advimage_title_color = $hgr_advimage_overlay_color = $hgr_advimage_border_width = $hgr_advimage_border_color = $hgr_advimage_border_radius = $hgr_advimage_title_color_hover = $hgr_advimage_description_color = $hgr_advimage_overlay_color_hover = $hgr_advimage_border_width_hover = $hgr_advimage_border_color_hover = $hgr_advimage_border_radius_hover = $css = '';
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'hgr_advimage_image'					=>	'',
				'hgr_advimage_height'					=>	'250',
				'hgr_advimage_title'					=>	'#999',
				'hgr_advimage_title_padding'			=>	'20',
				'hgr_advimage_title_h'					=>	'h2',
				'hgr_advimage_title_color'				=>	'#999',
				'hgr_advimage_overlay_color'			=>	'#fff',
				'hgr_advimage_border_width'				=>	'10',
				'hgr_advimage_border_color'				=>	'#fff',
				'hgr_advimage_border_radius'			=>	'0',
				'hgr_advimage_title_color_hover'		=>	'#fff',
				'hgr_advimage_description_color'		=>	'#fff',
				'hgr_advimage_overlay_color_hover'		=>	'#fff',
				'hgr_advimage_border_width_hover'		=>	'10',
				'hgr_advimage_border_color_hover'		=>	'#fff',
				'hgr_advimage_border_radius_hover'		=>	'0',
				'css'									=>	''
			), $atts));
			
			$src = wp_get_attachment_image_src( $hgr_advimage_image, array( 5600,1000 ), false, '' );
			// Use: $src[0]
			
			/*
			* CSS - Design tab
			*/
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			$uniqueID = "hgr_advImage_".mt_rand(999, 9999999);
			
			$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
			
			$output .='
				<style>
				#'.$uniqueID.'.hgr_advimage{
					border: '.$hgr_advimage_border_width.'px solid '.$hgr_advimage_border_color.';
					border-radius: '.$hgr_advimage_border_radius.'px;
					width:100%;
					height:'.$hgr_advimage_height.'px;
					overflow:hidden;
					-webkit-background-size: cover;
					-moz-background-size: cover;
					-o-background-size: cover;
					background-size: cover;
					box-sizing: border-box;
				}
				#'.$uniqueID.'.hgr_advimage:hover{
					border: '.$hgr_advimage_border_width_hover.'px solid '.$hgr_advimage_border_color_hover.';
					border-radius: '.$hgr_advimage_border_radius_hover.'px;
				}
				
				#'.$uniqueID.'.hgr_advimage div.hgr_advimage_overlay{
					background-color: '.$hgr_advimage_overlay_color.';
					transition: background-color 0.5s ease;
					box-sizing: border-box;
					width:100%;
					height:'.$hgr_advimage_height.'px;
				}
				#'.$uniqueID.'.hgr_advimage:hover > div.hgr_advimage_overlay{
					background-color: '.$hgr_advimage_overlay_color_hover.';
				}
				
				#'.$uniqueID.'.hgr_advimage div.hgr_advimage_overlay .hgr_advimage_elements_container{
					transform:translateY( calc('.$hgr_advimage_height.'px) );
					box-sizing: border-box;
					transition: transform 0.2s ease;
					width:100%;
					height:auto;
				}
				
				
				
				#'.$uniqueID.'.hgr_advimage .hgr-advimage-title{
					box-sizing: border-box;
					padding-bottom:'.$hgr_advimage_title_padding.'px;
					color: '.$hgr_advimage_title_color.'!important;
					transition: color 0.2s ease;
					margin:0;
					line-height:1;
				}
				#'.$uniqueID.' .hgr_advimage_overlay:hover .hgr_advimage_elements_container > .hgr-advimage-title{
					color: '.$hgr_advimage_title_color_hover.'!important;
				}
				
				#'.$uniqueID.' .hgr-advimage-description{
					color: '.$hgr_advimage_description_color.'!important;
				}
				#'.$uniqueID.' .hgr_advimage_overlay:hover .hgr_advimage_elements_container > .hgr-advimage-description{
					color: '.$hgr_advimage_description_color.'!important;
				}
				
				
				
				
				</style>
			';
			
			$output	.=	'<div id="'.$uniqueID.'" class="hgr_advimage" style="background:url('.$src[0].') no-repeat center center;">';
			$output .=	'<div class="hgr_advimage_overlay">';
				$output .=	'<div class="hgr_advimage_elements_container ' . esc_attr( $css_class ) . '">';
					$output .=	'<'.$hgr_advimage_title_h.' class="hgr-advimage-title">'.$hgr_advimage_title.'</'.$hgr_advimage_title_h.'>';
					$output .=	'<span class="hgr-advimage-description">'.$content.'</span>';
				$output .=	'</div>';
			$output .=	'</div>';
			$output	.=	'</div>';
						
			return $output;
		}
	}
	new HGR_VC_ADVIMAGE;
}
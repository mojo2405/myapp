<?php
/*
* Add-on Name: Icon Text
* Add-on URI: http://highgradelab.com/plugins/highgrade-extender/
* Since: 1.0
* Add-on Author: Eugen Petcu
* Update & Bug fixes: Bogdan Costescu
*/
if(!class_exists('HGR_VC_ICONTEXT')) {
	class HGR_VC_ICONTEXT extends WPBakeryShortCode {

		function __construct() {
			add_action('admin_init', array($this, 'add_icontext'));
			
			add_shortcode('hgr_icontext', array($this, 'hgr_icontext') );
			
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
		function add_icontext() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"			=>	__("HGR Icon Text", "hgrextender"),
					   "base"			=>	"hgr_icontext",
					   "class"			=>	"",
					   "icon"			=>	"hgr_icon_text",
					   "category"		=>	__("HighGrade Extender", "hgrextender"),
					   "description"	=>	__("Title and paragraph with icon.", "hgrextender"),
					   "params" => array(
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Display icon:", "hgrextender"),
								"param_name"	=>	"icon_type",
								"value"			=>	array(
										__( 'Font Icon Browser', 'hgrextender' )	=> 'selector',
										__( 'Custom Image Icon', 'hgrextender' )	=> 'custom',
										//__( 'No icon', 'hgrextender' ) 				=> 'no-icon',
									),
								"save_always" => true,
								"description"	=>	__("Select icon source.", "hgrextender")
							),
							array(
								"type"			=>	"icon_browser",
								"class"			=>	"",
								"heading"		=>	__("Select Icon:", "hgrextender"),
								"param_name"	=>	"icon",
								"value"			=>	"",
								"description"	=>	__("Click on an icon to select it.", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"icon_type",
										"value"			=>	array( "selector" ),
									),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Icon Size:", "hgrextender"),
								"param_name"	=>	"icon_size",
								"value"			=>	32,
								"min"			=>	12,
								"max"			=>	72,
								"suffix"		=>	"px",
								"description"	=>	__("Set the icon size.", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"icon_type",
										"value"			=>	array("selector"),
									),
							),
							array(
								"type"			=>	"attach_image",
								"class"			=>	"",
								"heading"		=>	__("Upload Image Icon:", "hgrextender"),
								"param_name"	=>	"icon_img",
								"admin_label"	=>	true,
								"value"			=>	"",
								"description"	=>	__("Upload the custom image icon.", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"icon_type",
										"value"			=>	array( "custom" ),
									),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Image Width", "hgrextender"),
								"param_name"	=>	"img_width",
								"value"			=>	48,
								"min"			=>	16,
								"max"			=>	512,
								"suffix"		=>	"px",
								"description"	=>	__("Provide image width", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"icon_type",
										"value"			=>	array("custom"),
									),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon Color:", "hgrextender"),
								"param_name"	=>	"icon_color",
								"value"			=>	"#222222",
								"description"	=>	__("Select prefered icon color.", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"icon_type",
										"value"			=>	array( "selector" ),
									),						
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon Background Settings:", "hgrextender"),
								"param_name"	=>	"icon_background_type",
								"value"			=>	array(
										__( 'None', 'hgrextender' ) 					=> 'none',
										__( 'Select background color', 'hgrextender' )	=> 'icon-background-select',
									),
								"save_always" 		=> true,
								"description"	=>	__("Select background settings for your icon.", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"icon_type",
										"value"			=>	array( "selector" ),
									),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon Background Color:", "hgrextender"),
								"param_name"	=>	"icon_background_color",
								"value"			=>	"#333333",
								"description"	=>	__("Pick a background color for your icon.", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"icon_background_type",
										"value"			=>	array("icon-background-select"),
									),						
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Icon Background Size:", "hgrextender"),
								"param_name"	=>	"icon_background_size",
								"value"			=>	60,
								"min"			=>	20,
								"max"			=>	100,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"icon_background_type",
										"value"			=>	array( "icon-background-select" ),
									),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Icon Background Roundness:", "hgrextender"),
								"param_name"	=>	"icon_background_roundness",
								"value"			=>	0,
								"min"			=>	0,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels, example: 0 for square, or 5 for rounded corners.", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"icon_background_type",
										"value"			=>	array( "icon-background-select" ),
									),
							),
							/* Since 1.0.3.4 */
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Icon Background border width:", "hgrextender"),
								"param_name"	=>	"icon_background_border_width",
								"value"			=>	0,
								"min"			=>	1,
								"max"			=>	6,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"icon_background_type",
										"value"			=>	array( "icon-background-select" ),
									),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon Border Color:", "hgrextender"),
								"param_name"	=>	"icon_border_color",
								"value"			=>	"#333333",
								"description"	=>	__("Pick a border color for your icon background.", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"icon_background_border_width",
										"value"			=>	array("1", "2", "3", "4", "5", "6"),
									),						
							),
							/* END Since 1.0.3.4 */
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon position:", "hgrextender"),
								"param_name"	=>	"contb_icon_position",
								"value"			=>	array(
										__( 'Top', 'hgrextender' ) 		=> 'contb-icon-top',
										__( 'Bottom', 'hgrextender' )	=> 'contb-icon-bottom',
										__( 'Left', 'hgrextender' )		=> 'contb-icon-left',
										__( 'Right', 'hgrextender' )	=> 'contb-icon-right',
									),
								"save_always" 	=> true,
								"description"	=>	__("Select icon position.", "hgrextender"),
								"dependency"	=> 	array(
										"element"		=>	"icon_type",
										"value"			=>	array( "selector","custom" ),
									),
							),
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Element Title text:", "hgrextender"),
								 "param_name"	=>	"content_title",
								 "value"		=>	"Optimized for speed",
								 "description"	=>	__("Insert title text here.", "hgrextender")
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Title color:", "hgrextender"),
								"param_name"	=>	"content_title_color",
								"value"			=>	"#222222",
								"description"	=>	__("Color of title text.", "hgrextender"),
							),
							array(
								 "type"			=>	"textarea",
								 "class"		=>	"",
								 "heading"		=>	__("Element Description text:", "hgrextender"),
								 "param_name"	=>	"content_description",
								 "value"		=>	"Careful attention to detail and clean, well structured code ensures a smooth user experience for all your visitors.",
								 "description"	=>	__("Insert description text here.", "hgrextender")
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Description color:", "hgrextender"),
								"param_name"	=>	"content_desc_color",
								"value"			=>	"#222222",
								"description"	=>	__("Color of description text.", "hgrextender"),
							),
							array(
								 "type"			=>	"dropdown",
								 "class"		=>	"",
								 "heading"		=>	__("Link text settings:","hgrextender"),
								 "param_name"	=>	"custom_link",
								 "value"		=>	array(
										__( 'No Link', 'hgrextender' ) 				=> '',
										__( 'Add custom link text', 'hgrextender' )	=> 'custom-link-on',
									),
								 "save_always" 	=> true,
								 "description"	=>	__("You can add / remove custom link.", "hgrextender"),
								 "dependency"	=>	array(
								 		"element"		=>	"contb_icon_position",
										"value"			=>	array( "contb-icon-top","contb-icon-left","contb-icon-right" ),
									),
							),
							array(
								 "type"			=>	"vc_link",
								 "class"		=>	"",
								 "heading"		=>	__("Link to:", "hgrextender"),
								 "param_name"	=>	"address_link",
								 "value"		=>	"",
								 "description"	=>	__("Set the address to link to.", "hgrextender"),
								 "dependency"	=>	array(
								 		"element"		=>	"custom_link", 
										"not_empty"	=>	true, 
										"value"			=>	array( "custom-link-on" ),
									),
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Link Text:","hgrextender"),
								"param_name"	=>	"link_text",
								"value"			=>	"Read more",
								"description"	=>	__("Make sure the text clearly calls for a specific action.","hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"custom_link",
										"not_empty"	=>	true,
										"value"			=>	array( "custom-link-on" ),
									),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Link Text Color:", "hgrextender"),
								"param_name"	=>	"link_color",
								"value"			=>	"#222222",
								"description"	=>	__("Select the color for button text.", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"custom_link",
										"not_empty"	=>	true,
										"value"			=>	array( "custom-link-on" ),
									),
							),
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Extra class:", "hgrextender"),
								 "param_name"	=>	"contb_extra_class",
								 "value"		=>	"",
								 "description"	=>	__("Add extra class name. You can use this class for your customizations.", "hgrextender")
							),
							array(
								'type' => 'css_editor',
								'heading' => __( 'Css', 'hgrextender' ),
								'param_name' => 'css',
								'group' => __( 'Design options', 'hgrextender' ),
							),
						),
					)
				);
			}
		}		
		
		function hgr_icontext($atts ) {
		
			/*
				 Empty vars declaration
			*/
			$output = $link_style = $link_prefix = $link_sufix = $content_icon = $content_customimg = $icon_type = $icon = $icon_size = $icon_img = 
			$img_width = $icon_color = $icon_background_type = $icon_background_color = $icon_background_size = $icon_background_roundness = 
			$icon_background_border_width = $icon_border_color = $contb_icon_position = $content_title = $content_title_color = $content_description = $content_desc_color = $custom_link = 
			$address_link = $link_text = $link_color = $contb_extra_class = $css = '';
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts( array(
				'icon_type'						=>	'',
				'icon'							=>	'',
				'icon_size'						=>	'',
				'icon_img'						=>	'',
				'img_width'						=>	'',
				'icon_color'						=>	'',
				'icon_background_type'			=>	'',
				'icon_background_color'			=>	'',
				'icon_background_size'			=>	'',
				'icon_background_roundness'		=>	'',
				'icon_background_border_width'	=>	'',
				'icon_border_color'				=>	'',
				'contb_icon_position'			=>	'',
				'content_title'					=>	'',
				'content_title_color'			=>	'',
				'content_description'			=>	'',
				'content_desc_color'			=>	'',
				'custom_link'					=>	'',
				'address_link'					=>	'',
				'link_text'						=>	'',
				'link_color'						=>	'',
				'contb_extra_class'				=>	'',
				'css'							=>	'',
			),$atts));
			
			/*
			* CSS - Design tab
			*/
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			

			/*
				Do the icon, font or image...
			*/
			if( $icon_type == 'selector' && !empty($icon) ) {
				$content_icon .= do_shortcode('[icon name="icon '.$icon.' normal-icon-cb" size="'.$icon_size.'px"]');
			}
			/* Image icon... */
			elseif($icon_type == 'custom' && !empty($icon_img)){
				$hgr_icontext_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $icon_img, 'thumb_size' => 'full', 'class' => "" ) );
				$content_customimg .= $hgr_icontext_img_array['thumbnail'];
			}
			
			/* Icon background border */
			if( $icon_background_border_width >= 1 && !empty($icon_border_color) ) {
				$icon_border_width_style = ' border: '.$icon_background_border_width.'px solid '.$icon_border_color.'; ';
			} else { $icon_border_width_style = ''; }
				
			switch($contb_icon_position){
				/* 
					Icon position top
				*/
				case 'contb-icon-top':
					$output .= '<div class="hgr-content-block-tb '.$contb_extra_class.' ' . esc_attr( $css_class ) . '" style="margin-bottom:2em;text-align:center;">';
						if($icon_type == 'selector' && $icon_background_type == 'none') {
							$output .= '<div class="hgr-contblock-icon-tb" style="color:'.$icon_color.';margin-bottom:1em; '.$icon_border_width_style.' ">'.$content_icon.'</div>';
						}
						if($icon_type == 'selector' && $icon_background_type == 'icon-background-select') {
							$output .= '<div class="hgr-contblock-icon-tb" style="color:'.$icon_color.';background:'.$icon_background_color.';width:'.$icon_background_size.'px;height:'.$icon_background_size.'px;line-height:'.$icon_background_size.'px;border-radius:'.$icon_background_roundness.'px;-moz-border-radius:'.$icon_background_roundness.'px;-webkit-border-radius:'.$icon_background_roundness.'px;-o-border-radius:'.$icon_background_roundness.'px;margin-bottom:1em; '.$icon_border_width_style.' ">'.$content_icon.'</div>';
						}
						if($icon_type == 'custom' && $icon_img !== '') {
							$output .= '<div class="hgr-icontext-customimg" style="width:'.$img_width.'px; margin-bottom: 10px;">'.$content_customimg.'</div>';
						}
						$output .= '<div class="hgr-content-tb">';
							if(!empty($content_title)) {
								$output .='<h4 style="color:'.$content_title_color.'">'.$content_title.'</h4>';
							}
							
							if(!empty($content_description)) {
								$output .='<p style="color:'.$content_desc_color.'">'.$content_description.'</p>';
							}
							
							if($custom_link == 'custom-link-on'){
								if($link_text !== '')
									$link_style = 'style="color:'.$link_color.';"';
										if($address_link !== ''){								
											$href = vc_build_link($address_link);
											if($href['url'] !== "") {
												$link_target = (isset($href['target'])) ? 'target="'.$href['target'].'"' : '';
												$link_title = (isset($href['title'])) ? 'title="'.$href['title'].'"' : '';
											}
											$link_prefix .= '<a class="hgr-contb-link morelink-white" href="'.$href['url'].'" '.$link_target.' '.$link_title.'>';
											$link_sufix .= '</a>';
										}
								$output .=$link_prefix.$link_text.$link_sufix;
							}
						$output .= '</div>';
					$output .= '</div>';
				break;
				
				/*
					Icon position bottom
				*/
				case 'contb-icon-bottom':
					$output .= '<div class="hgr-content-block-tb '.$contb_extra_class.' ' . esc_attr( $css_class ) . '" style="margin-bottom:2em;text-align:center;">';
						$output .= '<div class="hgr-content-tb">';
							if(!empty($content_title)) {
								$output .='<h4 style="color:'.$content_title_color.'">'.$content_title.'</h4>';
							}
							if(!empty($content_description)) {
								$output .='<p style="color:'.$content_desc_color.'">'.$content_description.'</p>';
							}
						$output .= '</div>';
						if($icon_type == 'selector' && $icon_background_type == 'none') {
							$output .= '<div class="hgr-contblock-icon-tb" style="color:'.$icon_color.'; margin-top: 1em; '.$icon_border_width_style.' ">'.$content_icon.'</div>';
						}
						if($icon_type == 'selector' && $icon_background_type == 'icon-background-select') {
							$output .= '<div class="hgr-contblock-icon-tb" style="color:'.$icon_color.';background:'.$icon_background_color.';width:'.$icon_background_size.'px;height:'.$icon_background_size.'px;line-height:'.$icon_background_size.'px;border-radius:'.$icon_background_roundness.'px;-moz-border-radius:'.$icon_background_roundness.'px;-webkit-border-radius:'.$icon_background_roundness.'px;-o-border-radius:'.$icon_background_roundness.'px;margin-top:1em; '.$icon_border_width_style.' ">'.$content_icon.'</div>';
						}
						if($icon_type == 'custom' && $icon_img !== '') {
							$output .= '<div class="hgr-icontext-customimg" style="width:'.$img_width.'px; margin-top: 10px;">'.$content_customimg.'</div>';
						}
					$output .= '</div>';
				break;
				
				/*
					Icon position left
				*/
				case 'contb-icon-left':
					$output .= '<div class="hgr-content-block '.$contb_extra_class.' ' . esc_attr( $css_class ) . '">';
						$output .= '<div class="hgr-contb-row">';
							if($icon_type == 'selector' && $icon_background_type == 'none') {
								$output .= '<div class="hgr-contblock-icon" style="color:'.$icon_color.'; '.$icon_border_width_style.' ">'.$content_icon.'</div>';
							}
							if($icon_type == 'selector' && $icon_background_type == 'icon-background-select') {
								$output .= '<div class="hgr-contblock-icon" style="color:'.$icon_color.';">';
									$output .= '<div class="hgr-contblock-icon-bg" style="margin-top:8px;background:'.$icon_background_color.';width:'.$icon_background_size.'px;height:'.$icon_background_size.'px;line-height:'.$icon_background_size.'px;border-radius:'.$icon_background_roundness.'px;-moz-border-radius:'.$icon_background_roundness.'px;-webkit-border-radius:'.$icon_background_roundness.'px;-o-border-radius:'.$icon_background_roundness.'px;margin-bottom:1em; '.$icon_border_width_style.' ">'.$content_icon.'</div>';
								$output .= '</div>';
							}
							if($icon_type == 'custom' && $icon_img !== '') {
								$output .= '<div class="hgr-icontext-customimg" style="width:'.$img_width.'px;">'.$content_customimg.'</div>';
							}
							$output .= '<div class="hgr-content" style="padding-left:1em;">';
								if(!empty($content_title)) {
									$output .='<h4 style="color:'.$content_title_color.'">'.$content_title.'</h4>';
								}
								
								if(!empty($content_description)) {
									$output .='<p style="color:'.$content_desc_color.'">'.$content_description.'</p>';
								}
								
								if($custom_link == 'custom-link-on'){
									if($link_text !== '')
										$link_style = 'style="color:'.$link_color.';"';
											if($address_link !== ''){								
												$href = vc_build_link($address_link);
												if($href['url'] !== "") {
													$link_target = (isset($href['target'])) ? 'target="'.$href['target'].'"' : '';
													$link_title = (isset($href['title'])) ? 'title="'.$href['title'].'"' : '';
												}
												$link_prefix .= '<a class="hgr-contb-link morelink-white" href="'.$href['url'].'" '.$link_target.' '.$link_title.'>';
												$link_sufix .= '</a>';
											}
									$output .=$link_prefix.$link_text.$link_sufix;
								}
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</div>';
				break;
				
				/* 
					Icon position right
				*/
				case 'contb-icon-right':
					$output .= '<div class="hgr-content-block '.$contb_extra_class.' ' . esc_attr( $css_class ) . '">';
						$output .= '<div class="hgr-contb-row">';
							$output .= '<div class="hgr-content" style="padding-right:1em;text-align:right;">';
								if(!empty($content_title)) {
									$output .='<h4 style="color:'.$content_title_color.'">'.$content_title.'</h4>';
								}
								
								if(!empty($content_description)) {
									$output .='<p style="color:'.$content_desc_color.'">'.$content_description.'</p>';
								}
								
								if($custom_link == 'custom-link-on'){
									if($link_text !== '')
										$link_style = 'style="color:'.$link_color.';"';
											if($address_link !== ''){								
												$href = vc_build_link($address_link);				
												if($href['url'] !== "") {
													$link_target = (isset($href['target'])) ? 'target="'.$href['target'].'"' : '';
													$link_title = (isset($href['title'])) ? 'title="'.$href['title'].'"' : '';
												}
												$link_prefix .= '<a class="hgr-contb-link morelink-white" href="'.$href['url'].'" '.$link_target.' '.$link_title.'>';
												$link_sufix .= '</a>';
											}
									$output .=$link_prefix.$link_text.$link_sufix;
								}
							$output .= '</div>';
							if($icon_type == 'selector' && $icon_background_type == 'none') {
								$output .= '<div class="hgr-contblock-icon" style="color:'.$icon_color.'; float:right; '.$icon_border_width_style.' ">'.$content_icon.'</div>';
							}
							if($icon_type == 'selector' && $icon_background_type == 'icon-background-select') {
								$output .= '<div class="hgr-contblock-icon" style="color:'.$icon_color.';float:right;">';
									$output .= '<div class="hgr-contblock-icon-bg" style="margin-top:8px;background:'.$icon_background_color.';width:'.$icon_background_size.'px;height:'.$icon_background_size.'px;line-height:'.$icon_background_size.'px;border-radius:'.$icon_background_roundness.'px;-moz-border-radius:'.$icon_background_roundness.'px;-webkit-border-radius:'.$icon_background_roundness.'px;-o-border-radius:'.$icon_background_roundness.'px;margin-bottom:1em; '.$icon_border_width_style.' ">'.$content_icon.'</div>';
								$output .= '</div>';
							}
							if($icon_type == 'custom' && $icon_img !== '') {
								$output .= '<div class="hgr-icontext-customimg" style="width:'.$img_width.'px;">'.$content_customimg.'</div>';
							}
						$output .= '</div>';
					$output .= '</div>';
				break;
			}
			/*
				Return the output
			*/
			return $output;		
		}
	}
	new HGR_VC_ICONTEXT;
}
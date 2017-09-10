<?php
/*
* Add-on Name: Counter
* Add-on URI: http://highgradelab.com/plugins/highgrade-extender/
* Since: 1.0
* Author: Eugen Petcu
* Update & Bug fixes: Bogdan Costescu
*/
if(!class_exists('HGR_VC_COUNTER')) {
	class HGR_VC_COUNTER extends WPBakeryShortCode {
		
		function __construct() {
			add_action('admin_init', array($this, 'hgr_counter_init'));
			
			add_shortcode( 'hgr_counter', array($this, 'hgr_counter') );
			
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
		function hgr_counter_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"				=>	__("HGR Counter", "hgrextender"),
					   "holder"				=>	"div",
					   "base"				=>	"hgr_counter",
					   "class"				=>	"",
					   "icon"				=>	"hgr_counter",
					   "description"		=>	__("Animated counters", "hgrextender"),
					   "category"			=>	__("HighGrade Extender", "hgrextender"),
					   "content_element"	=>	true,
					   "params"				=>	array(
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon to display:", "hgrextender"),
								"description"	=>	__("Use an existing font icon or upload a custom image.", "hgrextender"),
								"param_name"	=>	"icon_type",
								"value"			=>	array(
										__( 'Font Icon Browser', 'hgrextender' ) => 'selector',
										__( 'Custom Image Icon', 'hgrextender' ) => 'custom',
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"icon_browser",
								"class"			=>	"",
								"heading"		=>	__("Select Icon ","hgrextender"),
								"param_name"	=>	"icon",
								"value"			=>	"",
								"dependency"	=>	array(
										"element"	=>	"icon_type",
										"value"		=>	array( "selector" )
									),
								"save_always" 	=>	true,
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
										"element"	=>	"icon_type",
										"value"		=>	array( "custom" ),
									),
								"save_always" 	=>	true,
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
								"description"	=>	__("Provide image width.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_type",
										"value"		=>	array( "custom" ),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Icon Size:","hgrextender"),
								"param_name"	=>	"counter_icon_size",
								"value"			=>	32,
								"min"			=>	12,
								"max"			=>	72,
								"suffix"		=>	"px",
								"description"	=>	__("Set the icon size.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_type",
										"value"		=>	array( "selector" ),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon Color:", "hgrextender"),
								"param_name"	=>	"counter_icon_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a color for your icon.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_type",
										"value"		=>	array( "selector" ),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon position:", "hgrextender"),
								"description"	=>	__("Select icon position.","hgrextender"),
								"param_name"	=>	"counter_icon_position",
								"value"			=>	array(
										"Left"			=>	"icon-left",
										"Top"			=>	"icon-top",
										"Right"			=>	"icon-right",
										"Bottom"		=>	"icon-bottom",
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Counter Number:","hgrextender"),
								"description"	=>	__("Count from 1 to this number.", "hgrextender"),
								"param_name"	=>	"counter_number",
								"value"			=>	100,
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Counter Number HTML Format", "hgrextender"),
								"param_name"	=>	"counter_number_format",
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
								"heading"		=>	__("Counter Number Color:", "hgrextender"),
								"param_name"	=>	"counter_number_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a color.", "hgrextender"),	
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Counter Units:","hgrextender"),
								"param_name"	=>	"counter_units",
								"value"			=>	"",
								"description"	=>	__("Ex: cups, lines of code, projects.", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Counter Units Color:", "hgrextender"),
								"param_name"	=>	"counter_units_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a color.", "hgrextender"),	
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Counter Text:","hgrextender"),
								"param_name"	=>	"counter_text",
								"value"			=>	"",
								"description"	=>	__("Ex: of coffee (cups), written (lines of code), delivered (projects).", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Counter text HTML Format", "hgrextender"),
								"param_name"	=>	"counter_text_format",
								"value"			=>	array(
									__( 'H1', 'hgrextender' ) => 'h1',
									__( 'H2', 'hgrextender' ) => 'h2',
									__( 'H3', 'hgrextender' ) => 'h3',
									__( 'H4', 'hgrextender' ) => 'h4',
									__( 'H5', 'hgrextender' ) => 'h5',
									__( 'H6', 'hgrextender' ) => 'h6',
								),
								"std"			=>	"h3",
								"save_always"	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Counter Text Color:", "hgrextender"),
								"param_name"	=>	"counter_text_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a color.", "hgrextender"),	
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Counter Speed:","hgrextender"),
								"param_name"	=>	"counter_speed",
								"value"			=>	5,
								"min"			=>	1,
								"max"			=>	10,
								"suffix"		=>	__("seconds", "hgrextender"),
								"description"	=>	__("Set counter speed. Default is 5 seconds.", "hgrextender"),
								"save_always" 	=>	true,
							),						
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Background Settings:", "hgrextender"),
								"param_name"	=>	"counter_background_settings",
								"value"			=>	array(
										"None"			=>	"none",
										"Select color"	=>	"custom-counter-background",
									),
								"description"	=>	__("Select background type.","hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Background Color:", "hgrextender"),
								"param_name"	=>	"counter_background_color",
								"value"			=>	"#0484c9",
								"description"	=>	__("Pick a background color.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"counter_background_settings",
										"value"		=>	array( "custom-counter-background" ),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Border Settings:", "hgrextender"),
								"param_name"	=>	"counter_border_settings",
								"value"			=>	array(
									"None"			=>	"none",
									"Custom border"	=>	"custom-counter-border",
								),
								"description"	=>	__("Select border type.","hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Border Width:", "hgrextender"),
								"param_name"	=>	"counter_border_width",
								"value"			=>	1,
								"min"			=>	1,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"counter_border_settings",
									"value"		=>	array( "custom-counter-border" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Border Color:", "hgrextender"),
								"param_name"	=>	"counter_border_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a border color.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"counter_border_settings",
									"value"		=>	array("custom-counter-border"),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Box Border Roundness:", "hgrextender"),
								"param_name"	=>	"counter_border_corner",
								"value"			=>	0,
								"min"			=>	0,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels, example: 0 for square, or 5 for rounded corners.", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Extra class name","hgrextender"),
								"param_name"	=>	"extra_class",
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
		
		function hgr_counter ($atts, $content = null) {
			/*
				Include required JS and CSS files
			*/
			wp_enqueue_script('hgr-vc-jquery-appear');
			wp_enqueue_script('hgr-vc-countto');
			
			/*
				 Empty vars declaration
			*/
			$output = $counter_id = $counter_bg = $counter_bd = $counter_number_format = $counter_text_format = $border_roundness = $hgr_counter_img_array = $icon_type = $icon = $icon_img = 
			$img_width = $counter_icon_size = $counter_icon_color = $counter_number = $counter_number_color = $counter_units = $counter_units_color = 
			$counter_speed = $counter_text = $counter_text_color = $counter_background_settings = $counter_background_color = $counter_border_settings = 
			$counter_border_width = $counter_border_color = $counter_border_corner = $extra_class = $do_icon = $css = '';
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'icon_type'							=>	'',
				'icon'								=>	'',
				'icon_img'							=>	'',
				'img_width'							=>	'',
				'counter_icon_size'					=>	'',
				'counter_icon_color'				=>	'',
				'counter_icon_position'				=>	'',
				'counter_number'					=>	'',
				'counter_number_format'				=>	'',
				'counter_text_format'				=>	'',
				'counter_number_color'				=>	'',
				'counter_units'						=>	'',
				'counter_units_color'				=>	'',
				'counter_speed'						=>	'',
				'counter_text'						=>	'',
				'counter_text_color'				=>	'',
				'counter_background_settings'		=>	'',
				'counter_background_color'			=>	'',
				'counter_border_settings'			=>	'',
				'counter_border_width'				=>	'',
				'counter_border_color'				=>	'',
				'counter_border_corner'				=>	'',
				'extra_class'						=>	'',
				'css'								=>	'',
			), $atts));
			
			
			
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			
			
			/*
				Font icon or Image icon?
			*/
			if( $icon_type == 'selector' && !empty($icon) ) {
				
				$do_icon = do_shortcode('[icon name="icon '.$icon.'" color="'.$counter_icon_color.'" size="'.$counter_icon_size.'px"]');
			}
			/*
				Image icon
			*/
			elseif($icon_type == 'custom' && !empty($icon_img)){
				$hgr_counter_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $icon_img, 'thumb_size' => 'full', 'class' => "" ) );
				$do_icon = '<div style="width:'.$img_width.'px;margin:auto;">'.$hgr_counter_img_array['thumbnail'].'</div>';
			}
			
			/*
				Border radius?
			*/
			if ( $counter_border_corner !== '0') {
			$border_roundness .= 'border-radius:'.$counter_border_corner.'px;-moz-border-radius:'.$counter_border_corner.'px;-webkit-border-radius:'.$counter_border_corner.'px;-o-border-radius:'.$counter_border_corner.'px;';
			}
			
			switch($counter_background_settings){
				case 'none':
					$counter_bg = 'background:none;';
				break;
				
				case 'custom-counter-background':
					$counter_bg = 'background-color:'.$counter_background_color.';';
				break;
				
				default:
			}
			
			switch($counter_border_settings){
				case 'none':
					$counter_bd = 'border:0px;';
				break;
				
				case 'custom-counter-border':
					$counter_bd = 'border:'.$counter_border_width.'px solid '.$counter_border_color.';';
				break;
				
				default:
			}
			
			$counter_id .= 'hgr-counter-'.uniqid();
			
			$js = '<script type="text/javascript">
						jQuery(document).ready(function() {
							jQuery(function($) {
								
								$(".'.$counter_id.'").appear(function() {
									$(this).countTo();
								});
							});
						});
					</script>';
				
			$output .= $js;
			
			switch($counter_icon_position){
			
				// Icon position left
				case 'icon-left':
					$output .= '<div class="hgr_counter ' . esc_attr( $css_class ) . ' '.(!empty($extra_class) ? $extra_class : '').'" style="'.$counter_bg.$counter_bd.$border_roundness.'">';
						$output .= '<div class="hgr_counter_row">';
							if(!empty($do_icon)) { 
								$output .= '<div class="hgr_counter_icon">';
								$output .= $do_icon; 
								$output .= '</div>';
							}
							$output .= '<div class="hgr_counter_content">';
								$output .= '<'.$counter_number_format.' class="hgr_counter_number">';
								$output .= '<span class="hgr_number_string '.$counter_id.'" style="color:'.$counter_number_color.'" data-from="0" data-to="'.$counter_number.'" data-speed="'.($counter_speed*1000).'" data-refresh-interval="50">0</span> <span class="hgr_counter_units" style="color:'.$counter_units_color.'">'.$counter_units.'</span>';
								$output .= '</'.$counter_number_format.'>';
								$output .= '<div class="hgr_counter_text"> <'.$counter_text_format.' style="color:'.$counter_text_color.'">'.$counter_text.'</'.$counter_text_format.'> </div>';
							$output .= '</div>';
						$output .= '</div> <!-- END .hgr_counter_row -->';
					$output .= '</div>';
				break;
				
				// Icon position top
				case 'icon-top':
					$output .= '<div class="hgr_counter ' . esc_attr( $css_class ) . ' '.(!empty($extra_class) ? $extra_class : '').'" style="'.$counter_bg.$counter_bd.$border_roundness.'">';
						if(!empty($do_icon)) { 
							$output .= '<div class="hgr_counter_icon" style="padding-bottom:2em;">';
							$output .= $do_icon; 
							$output .= '</div>';
						}
						$output .= '<div class="hgr_counter_content">';
							$output .= '<'.$counter_number_format.' class="hgr_counter_number">';
							$output .= '<span class="hgr_number_string '.$counter_id.'" style="color:'.$counter_number_color.'" data-from="0" data-to="'.$counter_number.'" data-speed="'.($counter_speed*1000).'" data-refresh-interval="50">0</span> <span class="hgr_counter_units" style="color:'.$counter_units_color.'">'.$counter_units.'</span>';
							$output .= '</'.$counter_number_format.'>';
							$output .= '<div class="hgr_counter_text"> <'.$counter_text_format.'  style="color:'.$counter_text_color.'">'.$counter_text.'</'.$counter_text_format.'> </div>';
						$output .= '</div>';
					$output .= '</div>';
				break;
				
				// Icon position right
				case 'icon-right':
					$output .= '<div class="hgr_counter ' . esc_attr( $css_class ) . ' '.(!empty($extra_class) ? $extra_class : '').'" style="'.$counter_bg.$counter_bd.$border_roundness.'">';
						$output .= '<div class="hgr_counter_row">';
							$output .= '<div class="hgr_counter_content">';
								$output .= '<'.$counter_number_format.' class="hgr_counter_number">';
								$output .= '<span class="hgr_number_string '.$counter_id.'" style="color:'.$counter_number_color.'" data-from="0" data-to="'.$counter_number.'" data-speed="'.($counter_speed*1000).'" data-refresh-interval="50">0</span> <span class="hgr_counter_units" style="color:'.$counter_units_color.'">'.$counter_units.'</span>';
								$output .= '</'.$counter_number_format.'>';
								$output .= '<div class="hgr_counter_text"> <'.$counter_text_format.' style="color:'.$counter_text_color.'">'.$counter_text.'</'.$counter_text_format.'> </div>';
							$output .= '</div>';
							if(!empty($do_icon)) { 
								$output .= '<div class="hgr_counter_icon">';
								$output .= $do_icon; 
								$output .= '</div>';
							}
						$output .= '</div> <!-- END .hgr_counter_row -->';
					$output .= '</div>';
				break;
				
				// Icon position bottom
				case 'icon-bottom':
					$output .= '<div class="hgr_counter ' . esc_attr( $css_class ) . ' '.(!empty($extra_class) ? $extra_class : '').'" style="'.$counter_bg.$counter_bd.$border_roundness.'">';
						$output .= '<div class="hgr_counter_content">';
							$output .= '<'.$counter_number_format.' class="hgr_counter_number">';
							$output .= '<span class="hgr_number_string '.$counter_id.'" style="color:'.$counter_number_color.'" data-from="0" data-to="'.$counter_number.'" data-speed="'.($counter_speed*1000).'" data-refresh-interval="50">0</span> <span class="hgr_counter_units" style="color:'.$counter_units_color.'">'.$counter_units.'</span>';
							$output .= '</'.$counter_number_format.'>';
							$output .= '<div class="hgr_counter_text"> <'.$counter_text_format.' style="color:'.$counter_text_color.'">'.$counter_text.'</'.$counter_text_format.'> </div>';
						$output .= '</div>';
						if(!empty($icon)) { 
							$output .= '<div class="hgr_counter_icon" style="padding-top:2em;">';
							$output .= $do_icon; 
							$output .= '</div>';
						}
					$output .= '</div>';
				break;
				
				default:
				$output .= '<div class="hgr_counter ' . esc_attr( $css_class ) . ' '.(!empty($extra_class) ? $extra_class : '').'" style="'.$counter_bg.$counter_bd.$border_roundness.'">';
					$output .= '<div class="hgr_counter_row">';
						if(!empty($do_icon)) { 
							$output .= '<div class="hgr_counter_icon">';
							$output .= $do_icon; 
							$output .= '</div>';
						}
						$output .= '<div class="hgr_counter_content">';
							$output .= '<'.$counter_number_format.' class="hgr_counter_number">';
							$output .= '<span class="hgr_number_string '.$counter_id.'" style="color:'.$counter_number_color.'" data-from="0" data-to="'.$counter_number.'" data-speed="'.($counter_speed*1000).'" data-refresh-interval="50">0</span> <span class="hgr_counter_units" style="color:'.$counter_units_color.'">'.$counter_units.'</span>';
							$output .= '</'.$counter_number_format.'>';
							$output .= '<div class="hgr_counter_text"> <'.$counter_text_format.' style="color:'.$counter_text_color.'">'.$counter_text.'</'.$counter_text_format.'> </div>';
						$output .= '</div>';
					$output .= '</div> <!-- END .hgr_counter_row -->';
				$output .= '</div>';
			}
			
			/*
				Return the output
			*/
			return $output;
		}
	}
	new HGR_VC_COUNTER;
}
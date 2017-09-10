<?php
/*
* Add-on Name: Pie Chart
* Add-on URI: http://highgradelab.com/plugins/highgrade-extender/
* Based on Rendro Easy Pie Chart: https://github.com/rendro/easy-pie-chart
* Since: 1.0
* Author: Eugen Petcu
*/
if(!class_exists('HGR_VC_PIE')) {
	class HGR_VC_PIE extends WPBakeryShortCode {

		function __construct() {
			add_action('admin_init', array($this, 'hgr_pie_init'));
			
			add_shortcode( 'hgr_pie_chart', array($this, 'hgr_pie') );
		}
		
		
		/*
			Visual Composer mapping function
			Public API
			Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
			Example:		http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*/	
		function hgr_pie_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"				=>	__("HGR Pie Chart", "hgrextender"),
					   "holder"			=>	"div",
					   "base"				=>	"hgr_pie_chart",
					   "class"				=>	"",
					   "icon"				=>	"hgr_pie_chart",
					   "category"			=>	__("HighGrade Extender", "hgrextender"),
					   "description"		=>	__("Animated pie chart", "hgrextender"),
					   "front_enqueue_js"	=>	"",
					   "content_element"	=>	true,
					   "params"			=>	array(
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Pie title", "hgrextender"),
								"param_name"	=>	"pie_title",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textarea_html",
								"class"			=>	"",
								"heading"		=>	__("Pie text", "hgrextender"),
								"param_name"	=>	"content",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								 "type"			=>	"vc_link",
								 "class"		=>	"",
								 "heading"		=>	__("Pie link to","hgrextender"),
								 "param_name"	=>	"gotourl",
								 "value"		=>	"",
								 "description"	=>	__("Link pie text to URL.", "hgrextender"),
								 "save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Pie size", "hgrextender"),
								"param_name"	=>	"pie_size",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Bar width", "hgrextender"),
								"param_name"	=>	"bar_width",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Pie percent", "hgrextender"),
								"param_name"	=>	"pie_percent",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Pie percent font size", "hgrextender"),
								"param_name"	=>	"hgr_pie_percent_size",
								"value"			=>	"30",
								"description"	=>	__("Enter value in pixels, example: 30", "hgrextender")	,
								"save_always" 	=>	true,		
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Back line color:", "hgrextender"),
								"param_name"	=>	"back_line_color",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Front line color:", "hgrextender"),
								"param_name"	=>	"front_line_color",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Scale color:", "hgrextender"),
								"param_name"	=>	"scale_color",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon to display:", "hgrextender"),
								"param_name"	=>	"icon_type",
								"value"			=>	array(
										__( 'Font Icon Browser', 'hgrextender' ) => 'selector',
										__( 'Custom Image Icon', 'hgrextender' ) => 'custom',
									),
								"save_always"	=> true,
							),
							array(
								"type"			=>	"icon_browser",
								"class"			=>	"",
								"heading"		=>	__("Select Icon", "hgrextender"),
								"param_name"	=>	"icon",
								"value"			=>	"",
								"dependency"	=>	array(
										"element"		=>	"icon_type",
										"value"			=>	array("selector"),
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
										"element"		=>	"icon_type",
										"value"			=>	array("custom"),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon color:", "hgrextender"),
								"param_name"	=>	"icon_color",
								"value"			=>	"#808080",
								"dependency"	=>	array(
										"element"		=>	"icon_type",
										"value"			=>	array("selector"),
									),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Icon size", "hgrextender"),
								"param_name"	=>	"hgr_pie_icnsize",
								"value"			=>	"",
								"description"	=>	__("Enter value in pixels, example: 30", "hgrextender")	,
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Extra class", "hgrextender"),
								"param_name"	=>	"hgr_pie_extraclass",
								"value"			=>	"",
								"description"	=>	__("Enter a extra css class for this element, if you wish to override default css settings", "hgrextender"),
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
		
		function hgr_pie( $atts, $content = null ) {
			/*
				Include required JS on front-end
			*/
			wp_enqueue_script('hgr-vc-jquery-appear');
			wp_enqueue_script('hgr-vc-jquery-easing');
			wp_enqueue_script('hgr-vc-jquery-easypiechart');
			
			/*
				Empty vars declaration
			*/
			$output = $pie_title = $gotourl = $pie_percent = $scale_color = $pie_size = $hgr_pie_percent_size = $bar_width = 
			$back_style = $icon_color = $back_line_color = $front_line_color = $icon_type = $icon = $icon_img = $hgr_pie_icnsize = $hgr_pie_extraclass = $css = '';
			
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'pie_title'					=>	'',
				'gotourl'					=>	'', 
				'pie_percent'				=>	'80', // %
				'hgr_pie_percent_size'		=>	'',
				'scale_color'				=>	'#808080',
				'pie_size'					=>	'80', // px
				'bar_width'					=>	'4', //px
				'back_style'					=>	'dashed',
				'back_line_color'			=>	'#e2e1dc',
				'front_line_color'			=>	'#80c8ac',
				'icon_type'					=>	'',
				'icon'						=>	'',
				'icon_img'					=>	'',
				'icon_color'					=>	'',
				'hgr_pie_icnsize'			=>	'',
				'hgr_pie_extraclass'		=>	'',
				'css'						=>	''
			), $atts));
			
			$uniqueID = "hgr_piechart_".mt_rand(999, 9999999);
			
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
			
			/*
				Do the icon, font or custom image
			*/
			if( $icon_type == 'selector' && !empty($icon) ) {
				$do_icon = do_shortcode('[icon name="'.$icon.'" size="'.$hgr_pie_icnsize.'px" height="'.$hgr_pie_icnsize.'px" color="'.$icon_color.'"]');
			}
			elseif($icon_type == 'custom' && !empty($icon_img)){
				/* Image icon... */
				$hgr_piechart_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $icon_img, 'thumb_size' => 'full', 'class' => "hgr_piechart_imgicon" ) );
				$do_icon = $hgr_piechart_img_array['thumbnail'];
			}
			
			$output .='<script type="text/javascript">
						jQuery(document).ready(function() {
							
							jQuery("#'.$uniqueID.(!empty($hgr_pie_extraclass) ? '.'.$hgr_pie_extraclass : '').'.hgr_pie_chart i").css("color","'.$icon_color.'");
							jQuery("#'.$uniqueID.(!empty($hgr_pie_extraclass) ? '.'.$hgr_pie_extraclass : '').'.hgr_pie_chart span.percent").css("font-size","'.$hgr_pie_percent_size.'px");
							
							jQuery("#'.$uniqueID.(!empty($hgr_pie_extraclass) ? '.'.$hgr_pie_extraclass : '').'.hgr_pie_chart").appear(function() {
							  jQuery("#'.$uniqueID.(!empty($hgr_pie_extraclass) ? '.'.$hgr_pie_extraclass : '').'.hgr_pie_chart .chart").easyPieChart({
									easing: "easeOutBounce",
									barColor:"'.$front_line_color.'",
									trackColor:"'.$back_line_color.'",
									scaleColor:"'.$scale_color.'",
									animate: 3500,
									size:"'.$pie_size.'",
									lineWidth:"'.$bar_width.'",
									onStep: function(from, to, percent) {
										jQuery(this.el).find(".percent").text(Math.round(percent));
									}
								});
								var chart = window.chart = jQuery("#'.$uniqueID.(!empty($hgr_pie_extraclass) ? '.'.$hgr_pie_extraclass : '').'.hgr_pie_chart .chart").data("easyPieChart");
							});
						});
				</script>';
			
			$output .= '<div id="'.$uniqueID.'" class="hgr_pie_chart '.$hgr_pie_extraclass.' ' . esc_attr( $css_class ) . '">';
				$output .='<span class="chart" data-percent="'.$pie_percent.'">';
					if(!empty($icon)) { $output .= '<span style="color:'.$back_line_color.'">'.$do_icon.'</span>'; } else { $output .= '<span>&nbsp;</span>'; }
					$output .='<span class="percent" style="color:'.$front_line_color.'"></span>';
				$output .='</span>';
				if(!empty($content)) { $output .= $content; }
				if(!empty($pie_text)) { $output .='<p>'.$pie_text.'</p>'; }
				$href = vc_build_link($gotourl);
				if($href['url'] !== '') {
					$link_target = (isset($href['target'])) ? 'target="'.$href['target'].'"' : '';
					$link_title = (isset($href['title'])) ? 'title="'.$href['title'].'"' : '';
				}
				if(!empty($href['url'])) { $output .='<p><a href="'.$href['url'].'" '.$link_target.' '.$link_title.' class="morelink-white">READ MORE</a></p>'; }
			$output .= '</div>';
			
			/*
				Return the output
			*/	
			return $output;
		}
	}
	new HGR_VC_PIE;
}
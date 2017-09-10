<?php
/*
* Add-on Name: Content Box
* Add-on URI: http://highgradelab.com/plugins/highgrade-extender/
* Since: 1.0
* Add-on Author: Bogdan COSTESCU
*/
if(!class_exists('HGR_VC_CONTENTBOX')) {
	class HGR_VC_CONTENTBOX extends WPBakeryShortCode {
		
		function __construct() {
			add_action('admin_init', array($this, 'hgr_contentbox_init'));
			
			add_shortcode('hgr_content_box', array($this, 'hgr_contentbox') );
			
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
		function hgr_contentbox_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"			=>	__("HGR ContentBox", "hgrextender"),
					   "base"			=>	"hgr_content_box",
					   "class"			=>	"",
					   "icon"			=>	"hgr_content_box",
					   "category"		=>	__("HighGrade Extender", "hgrextender"),
					   "description"	=>	__("ContentBox with advanced settings", "hgrextender"),
					   "params"			=>	array(
							/*
								Icon section configuration
							*/
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Display icon:","hgrextender"),
								"param_name"	=>	"icon_type",
								"value"			=>	array(
									__( 'Font Icon Browser', 'hgrextender' ) => 'selector',
									__( 'Custom Image Icon', 'hgrextender' ) => 'custom',
								),
								"save_always"	=>	true,
								"description"	=>	__("Use an existing font icon or upload a custom image.", "hgrextender"),
							),
							array(
								"type"			=>	"icon_browser",
								"class"			=>	"",
								"heading"		=>	__("Select Icon ","hgrextender"),
								"param_name"	=>	"icon",
								"value"			=>	"",
								"description"	=>	__("Click on an icon to select it.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"icon_type",
									"value"		=>	array( "selector" ),
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
								"description"	=>	__("Provide image width", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"icon_type",
									"value"		=>	array( "custom" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Size of Icon", "hgrextender"),
								"param_name"	=>	"icon_size",
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
								"type"			=>"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon Color on normal state", "hgrextender"),
								"param_name"	=>	"icon_color",
								"value"			=>	"#222222",
								"description"	=>	__("Select prefered color on normal state.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"icon_type",
									"value"		=>	array( "selector" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon Color on hover state", "hgrextender"),
								"param_name"	=>	"icon_color_hover",
								"value"			=>	"#FFFFFF",
								"description"	=>	__("Select prefered color on hover state.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"icon_type",
									"value"		=>	array( "selector" ),
								),
								"save_always" 	=>	true,
							),
							/*
								Text and color configuration
							*/
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Title text","hgrextender"),
								 "param_name"	=>	"title_normal",
								 "value"		=>	"Fast customization",
								 "description"	=>	__("Insert title text here.","hgrextender"),
								 "save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Title color on normal state", "hgrextender"),
								"param_name"	=>	"normal_title_color",
								"value"			=>	"#222222",
								"description"	=>	__("Color of title text in normal state.", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Title color on hover state", "hgrextender"),
								"param_name"	=>	"hover_title_color",
								"value"			=>	"#ffffff",
								"description"	=>	__("Color of title text in hover state.", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Description text","hgrextender"),
								 "param_name"	=>	"desc_normal",
								 "value"		=>	"Using the visual editor has never been easier.",
								 "description"	=>	__("Insert description here.","hgrextender"),
								 "save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Description color on normal state", "hgrextender"),
								"param_name"	=>	"normal_desc_color",
								"value"			=>	"#8d8d8d",
								"description"	=>	__("Color of description text in normal state.", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Description color on hover state", "hgrextender"),
								"param_name"	=>	"hover_desc_color",
								"value"			=>	"#85cee0",
								"description"	=>	__("Color of description text in hover state.", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Background type on normal state", "hgrextender"),
								"param_name"	=>	"normal_background_type",
								"value"			=>	array(
									__( 'Select color', 'hgrextender' )	=> 'custom-normal-color',
									__( 'None', 'hgrextender' )			=> 'none',
								),
								"save_always"	=>	true,
								"description"	=>	__("Select background type in normal state.", "hgrextender"),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Background color on normal state", "hgrextender"),
								"param_name"	=>	"normal_background_color",
								"value"			=>	"#ffffff",
								"description"	=>	__("Pick a background color for normal state.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"normal_background_type",
									"value"		=>	array( "custom-normal-color" )
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Border type on normal state", "hgrextender"),
								"param_name"	=>	"normal_border_type",
								"value"			=>	array(
									__( 'None', 'hgrextender' ) => 'none',
									__( 'Select color', 'hgrextender' ) => 'custom-normal-border',
								),
								"save_always"	=>	true,
								"description"	=>	__("Select border type in normal state.", "hgrextender"),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Border width on normal state", "hgrextender"),
								"param_name"	=>	"normal_border_width",
								"value"			=>	2,
								"min"			=>	1,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"normal_border_type",
									"value"		=>	array( "custom-normal-border" )
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Border color on normal state", "hgrextender"),
								"param_name"	=>	"normal_border_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a border color for normal state box.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"normal_border_type",
									"value"		=>	array( "custom-normal-border" )
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Background type on hover state", "hgrextender"),
								"param_name"	=>	"hover_background_type",
								"value"			=>	array(
									__( 'Select color', 'hgrextender' ) => 'custom-hover-color',
									__( 'None', 'hgrextender' ) => 'none',
								),
								"save_always"	=>	true,
								"description"	=>	__("Select background type in hover state.", "hgrextender"),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Background color on hover state", "hgrextender"),
								"param_name"	=>	"hover_background_color",
								"value"			=>	"#0484c9",
								"description"	=>	__("Pick a background color for hover state.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"hover_background_type",
									"value"		=>	array( "custom-hover-color" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Border type on hover state", "hgrextender"),
								"param_name"	=>	"hover_border_type",
								"value"			=>	array(
									__( 'None', 'hgrextender' ) => 'none',
									__( 'Select color', 'hgrextender' ) => 'custom-hover-border',
								),
								"save_always"	=>	true,
								"description"	=>	__("Select border type in hover state.", "hgrextender"),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Border width on hover state", "hgrextender"),
								"param_name"	=>	"hover_border_width",
								"value"			=>	2,
								"min"			=>	1,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"hover_border_type",
									"value"		=>	array( "custom-hover-border" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Border color on hover state", "hgrextender"),
								"param_name"	=>	"hover_border_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a border color for hover state box.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"hover_border_type",
									"value"		=>	array( "custom-hover-border" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Box Border Roundness:", "hgrextender"),
								"param_name"	=>	"nh_border_roundness",
								"value"			=>	0,
								"min"			=>	0,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels, example: 0 for square, or 5 for rounded corners.", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"		=>	"",
								"heading"		=>	__("Link","hgrextender"),
								"param_name"	=>	"custom_link",
								"value"			=>	array(
									__( 'No Link', 'hgrextender' ) => '#',
									__( 'Add custom link to box', 'hgrextender' ) => '1',
								),
								"save_always"	=>	true,
								"description"	=>	__("You can add / remove custom link", "hgrextender")
							),
							array(
								 "type"			=>	"vc_link",
								 "class"		=>	"",
								 "heading"		=>	__("Link ","hgrextender"),
								 "param_name"	=>	"contentbox_link",
								 "value"		=>	"",
								 "description"	=>	__("You can add or remove the existing link from here.", "hgrextender"),
								 "dependency"	=>	array(
								 	"element"	=>	"custom_link",
									"value"		=>	array( "1" )
								),
								"save_always" 	=>	true,
							),
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Extra class","hgrextender"),
								 "param_name"	=>	"cb_extra_class",
								 "value"		=>	"",
								 "description"	=>	__("Add extra class name. You can use this class for your css/js customizations.", "hgrextender"),
								 "save_always" 	=>	true,
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
		
		function hgr_contentbox($atts) {
		
			/*
				 Empty vars declaration
			*/
			$output = $normal_style = $normal_bg = $normal_bd = $hover_bg = $hover_bd = $border_roundness = $hgr_contbox_id = $icon_type = $icon = $icon_img = $img_width = $icon_size = $icon_color = $icon_color_hover = $title_normal = $normal_title_color = $hover_title_color = $desc_normal = $normal_desc_color = $hover_desc_color = $normal_background_type = $normal_background_color = $normal_border_type = $normal_border_width = $normal_border_color = $hover_background_type = $hover_background_color = $hover_border_type = $hover_border_width = $hover_border_color = $nh_border_roundness = $custom_link = $contentbox_link = $cb_extra_class = $css = '';
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts( array(
				'icon_type'					=>	'', 
				'icon'						=>	'', 
				'icon_img'					=>	'', 
				'img_width'					=>	'', 
				'icon_size'					=>	'', 
				'icon_color'					=>	'', 
				'icon_color_hover'			=>	'', 
				'title_normal'				=>	'', 
				'normal_title_color'		=>	'', 
				'hover_title_color'			=>	'', 
				'desc_normal'				=>	'', 
				'normal_desc_color'			=>	'', 
				'hover_desc_color'			=>	'', 
				'normal_background_type'	=>	'', 
				'normal_background_color'	=>	'', 
				'normal_border_type'		=>	'', 
				'normal_border_width'		=>	'', 
				'normal_border_color'		=>	'', 
				'hover_background_type'		=>	'', 
				'hover_background_color'	=>	'', 
				'hover_border_type'			=>	'', 
				'hover_border_width'		=>	'', 
				'hover_border_color'		=>	'', 
				'nh_border_roundness'		=>	'', 
				'custom_link'				=>	'', 
				'contentbox_link'			=>	'', 
				'cb_extra_class'			=>	'', 
				'css'						=>	'', 
			),$atts));
			
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

			
			if ( $nh_border_roundness !== '0') {
			$border_roundness .= 'style="border-radius:'.$nh_border_roundness.'px;-moz-border-radius:'.$nh_border_roundness.'px;-webkit-border-radius:'.$nh_border_roundness.'px;-o-border-radius:'.$nh_border_roundness.'px;"';
			}
			
			if( $icon_type == 'selector' && !empty($icon) ) {
				$content_icon = do_shortcode('[icon name="icon '.$icon.' normal-icon-cb" size="'.$icon_size.'px"]');
			}
			elseif($icon_type == 'custom' && !empty($icon_img)){
				$hgr_contentbox_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $icon_img, 'thumb_size' => 'full', 'class' => "" ) );
				$content_icon = '<div class="hgr-contbox-customimg" style="width:'.$img_width.'px;">'.$hgr_contentbox_img_array['thumbnail'].'</div>';
			}
			
			switch($normal_background_type){
				case 'none':
					$normal_bg = 'none';
				break;
				
				case 'custom-normal-color':
					$normal_bg = $normal_background_color;
				break;
				
				default:
			}
			
			switch($normal_border_type){
				case 'none':
					$normal_bd = '0px';
				break;
				
				case 'custom-normal-border':
					$normal_bd = $normal_border_width.'px solid '.$normal_border_color;
				break;
				
				default:
			}
			
			switch($hover_background_type){
				case 'none':
					$hover_bg = 'none';
				break;
				
				case 'custom-hover-color':
					$hover_bg = $hover_background_color;
				break;
				
				default:
			}
			
			switch($hover_border_type){
				case 'none':
					$hover_bd = '0px';
				break;
				
				case 'custom-hover-border':
					$hover_bd = $hover_border_width.'px solid '.$hover_border_color;
				break;
				
				default:
			}
			
			$hgr_contbox_id = "hgr-contbox-".uniqid();
			
			$output .='<script type="text/javascript">
						jQuery(document).ready(function() {
							jQuery(".'.$hgr_contbox_id.'").css("background","'.$normal_bg.'").css("border","'.$normal_bd.'");
							jQuery(".'.$hgr_contbox_id.' .normal-icon-cb").css("color","'.$icon_color.'");
							jQuery(".'.$hgr_contbox_id.' h4").css("color","'.$normal_title_color.'");
							jQuery(".'.$hgr_contbox_id.' p").css("color","'.$normal_desc_color.'");
							
							
							jQuery(".'.$hgr_contbox_id.'").mouseenter(function() {
								jQuery(this).css("background","'.$hover_bg.'").css("border","'.$hover_bd.'");
							}).mouseleave(function() {
								jQuery(this).css("background","'.$normal_bg.'").css("border","'.$normal_bd.'");
							});
							
							jQuery(".'.$hgr_contbox_id.'").mouseenter(function(){
								jQuery(this).find(".normal-icon-cb").css("color","'.$icon_color_hover.'");
							}).mouseleave(function(){
								jQuery(this).find(".normal-icon-cb").css("color","'.$icon_color.'");
							});
							
							jQuery(".'.$hgr_contbox_id.'").mouseenter(function(){
								jQuery(this).find("h4").css("color","'.$hover_title_color.'");
								
							}).mouseleave(function(){
								jQuery(this).find("h4").css("color","'.$normal_title_color.'");
							});
							
							jQuery(".'.$hgr_contbox_id.'").mouseenter(function(){
								jQuery(this).find("p").css("color","'.$hover_desc_color.'");
								
							}).mouseleave(function(){
								jQuery(this).find("p").css("color","'.$normal_desc_color.'");
							});
						});
				</script>';
			
			$output .= '<div class="hgr-content-box '.$hgr_contbox_id.' '.$cb_extra_class.'" '.$border_roundness.' ' . esc_attr( $css_class ) . '>';
				if($custom_link == '1'){
					$href = vc_build_link($contentbox_link);
					if($href['url'] !== '') {
						$link_target = (isset($href['target'])) ? ' target="'.$href['target'].'"' : '';
						$link_title = (isset($href['title'])) ? ' title="'.$href['title'].'"' : '';
					}
					$output .= '<a href="'.$href['url'].'"'.$link_target.''.$link_title.'>';
						if($icon !== '' || $icon_img !== '') {
							$output .= $content_icon;
						}
						if(!empty($title_normal)) {
							$output .='<h4>'.$title_normal.'</h4>';
						}
						if(!empty($desc_normal)) {
							$output .='<p>'.$desc_normal.'</p>';
						}
					$output .= '</a>';
				} elseif ($custom_link == '#') {
					$output .= '<span>';
						if($icon !== '' || $icon_img !== '') {
							$output .= $content_icon;
						}
						if(!empty($title_normal)) {
							$output .='<h4>'.$title_normal.'</h4>';
						}
						if(!empty($desc_normal)) {
							$output .='<p>'.$desc_normal.'</p>';
						}
					$output .= '</span>';
				}
			$output .= '<div class="clear"></div> </div>';
			
			/*
				Return the output
			*/
			return $output;		
		}
	}
	new HGR_VC_CONTENTBOX;
}
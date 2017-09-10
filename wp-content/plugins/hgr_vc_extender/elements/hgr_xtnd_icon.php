<?php
/*
* Add-on Name: Icon
* Add-on URI: http://highgradelab.com/plugins/highgrade-extender/
* Since: 1.0
* Author: Eugen Petcu
*/
if(!class_exists('HGR_VC_ICON')) {
	class HGR_VC_ICON extends WPBakeryShortCode {

		function __construct() {
			add_action('admin_init', array($this, 'hgr_icon_init'));
			
			add_shortcode( 'hgr_icon', array($this, 'hgr_icon') );
			
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
		function hgr_icon_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"				=>	__("HGR Icon", "hgrextender"),
					   "holder"			=>	"div",
					   "base"				=>	"hgr_icon",
					   "class"				=>	"",
					   "icon"				=>	"hgr_icon",
					   "description"		=>	__("Icon with advanced parameters", "hgrextender"),
					   "category"			=>	__("HighGrade Extender", "hgrextender"),
					   "content_element"	=>	true,
					   "params"			=>	array(
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Display icon:", "hgrextender"),
								"param_name"	=>	"icon_type",
								"value"			=>	array(
										__( 'Font Icon Browser', 'hgrextender' ) => 'selector',
										__( 'Custom Image Icon', 'hgrextender' ) => 'custom',
									),
								"save_always" => true,
								"description" =>	__("Select icon source.", "hgrextender")
							),
							array(
								"type"			=>	"icon_browser",
								"class"			=>	"",
								"heading"		=>	__("Select icon:", "hgrextender"),
								"param_name"	=>	"icntxt_icon",
								"value"			=>	"icon",
								"description"	=>	__("Click on an icon to select it.", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"icon_type",
										"value"			=>	array("selector"),
									),
							),
						   array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon color:", "hgrextender"),
								"param_name"	=>	"icntxt_iconcolor",
								"value"			=>	"",
								"description"	=>	__("Select prefered icon color.", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"icon_type",
										"value"			=>	array("selector"),
									),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon hover color:", "hgrextender"),
								"param_name"	=>	"icntxt_iconcolor_hover",
								"value"			=>	"",
								"description"	=>	__("Select prefered icon color on hover state.", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"icon_type",
										"value"			=>	array("selector"),
									),								
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Icon size:", "hgrextender"),
								"param_name"	=>	"icntxt_icnsize",
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
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon Alignment:", "hgrextender"),
								"param_name"	=>	"icon_alignment",
								"value"			=>	array(
										__( 'Left', 'hgrextender' ) => 'left',
										__( 'Center', 'hgrextender' ) => 'center',
										__( 'Right', 'hgrextender' ) => 'right',
									),
								"save_always" => true,
							),
							array(
								"type"			=>	"attach_image",
								"class"			=>	"",
								"heading"		=>	__("Upload image icon:", "hgrextender"),
								"param_name"	=>	"icontxt_img",
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
								"heading"		=>	__("Image width:", "hgrextender"),
								"param_name"	=>	"icontxt_img_width",
								"value"			=>	48,
								"min"			=>	16,
								"max"			=>	512,
								"suffix"		=>	"px",
								"description"	=>	__("Provide image width.", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"icon_type",
										"value"			=>	array("custom"),
									),
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon Background Settings:", "hgrextender"),
								"param_name"	=>	"icon_background_type",
								"value"			=>	array(
										__( 'None', 'hgrextender' ) => 'none',
										__( 'Select background color', 'hgrextender' ) => 'icon-background-select',
									),
								"save_always" => true,
								"description"	=>	__("Select background settings for your icon.", "hgrextender"),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon Background Color:", "hgrextender"),
								"param_name"	=>	"icntxt_icnbackcolor",
								"value"			=>	"#333333",
								"description"	=>	__("Pick a background color for your icon.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_background_type",
										"value"		=>	array( "icon-background-select" ),
									),						
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon Hover Background Color:", "hgrextender"),
								"param_name"	=>	"icntxt_icnbackcolor_hover",
								"value"			=>	"#333333",
								"description"	=>	__("Pick a background color for your icon on hover state.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_background_type",
										"value"		=>	array( "icon-background-select" ),
									),						
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Icon Background Size:", "hgrextender"),
								"param_name"	=>	"icntxt_icnbacksize",
								"value"			=>	60,
								"min"			=>	20,
								"max"			=>	100,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"icon_background_type",
									"value"		=>	array( "icon-background-select" ),
								),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Icon Background Roundness:", "hgrextender"),
								"param_name"	=>	"icntxt_icnbackroundness",
								"value"			=>	0,
								"min"			=>	0,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels, example: 0 for square, or 5 for rounded corners.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"icon_background_type",
									"value"		=>	array( "icon-background-select" ),
								),
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon Border Settings:", "hgrextender"),
								"param_name"	=>	"icon_border_type",
								"value"			=>	array(
										__( 'None', 'hgrextender' ) => 'none',
										__( 'Set border', 'hgrextender' ) => 'icon-border-select',
									),
								"save_always" => true,
								"description"	=>	__("Select border settings for your icon.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"icon_background_type",
									"value"		=>	array( "icon-background-select" ),
								),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon Border Color:", "hgrextender"),
								"param_name"	=>	"icntxt_icnbordercolor",
								"value"			=>	"",
								"description"	=>	__("Pick a border color for your icon.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_border_type",
										"value"		=>	array( "icon-border-select" ),
									),						
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon Hover Border Color:", "hgrextender"),
								"param_name"	=>	"icntxt_icnbordercolor_hover",
								"value"			=>	"",
								"description"	=>	__("Pick a border color for your icon on hover state.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_border_type",
										"value"		=>	array( "icon-border-select" ),
									),						
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Icon Border Size:", "hgrextender"),
								"param_name"	=>	"icntxt_icnbordersize",
								"value"			=>	1,
								"min"			=>	0,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_border_type",
										"value"		=>	array( "icon-border-select" ),
									),
							),
							array(
								 "type"			=>	"dropdown",
								 "class"		=>	"",
								 "heading"		=>	__("Link", "hgrextender"),
								 "param_name"	=>	"custom_link",
								 "value"			=>	array(
										__( 'No Link', 'hgrextender' ) => 'no-link',
										__( 'Add custom link to box', 'hgrextender' ) => 'yes-link',
									),
								 "save_always" => true,
								 "description"	=>	__("You can add / remove custom link.", "hgrextender")
							),
							array(
								 "type"			=>	"vc_link",
								 "class"		=>	"",
								 "heading"		=>	__("Link ","hgrextender"),
								 "param_name"	=>	"icntxt_link",
								 "value"		=>	"",
								 "description"	=>	__("You can add or remove the existing link from here.", "hgrextender"),
								 "dependency"	=>	array(
								 		"element"	=>	"custom_link",
										"value"		=>	array("yes-link"),
									),
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Icon extra class:", "hgrextender"),
								"param_name"	=>	"icntxt_extraclass",
								"value"			=>	"",
								"description"	=>	__("Add extra class name. You can use this class for your customizations.", "hgrextender")					
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
		
		function hgr_icon ($atts) {
			
	/*
		 Empty vars declaration
	*/
	$output = $icntxt_icon = $icntxt_iconcolor = $icntxt_icnsize = $icon_alignment = $icontxt_img = $icontxt_img_width = $icon_background_type = $icntxt_icnbackcolor = $icntxt_icnbacksize = $icntxt_icnbackroundness = $icon_border_type = $icntxt_icnbordercolor = $icntxt_icnbordercolor_hover = $icntxt_icnbordersize = $icntxt_iconcolor_hover = $icntxt_icnbackcolor_hover = $custom_link = $icntxt_link = $icntxt_extraclass = $hgr_icon_img_array = $content_icon = $normal_bd = $hover_bd = $css = '';
	
	/*
		WordPress function to extract shortcodes attributes
		Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
	*/
	extract(shortcode_atts(array(
		'icon_type'						=> '',
		'icntxt_icon'					=> '',
		'icntxt_iconcolor'				=> '',
		'icntxt_icnsize'				=> '',
		'icon_alignment'				=>	'',
		'icontxt_img'					=> '',
		'icontxt_img_width'				=> '',
		'icon_background_type'			=> '',
		'icntxt_icnbackcolor'			=> '',
		'icntxt_icnbacksize'			=> '',
		
		'icntxt_icnbackroundness'		=> '',
		'icon_border_type'				=> '',
		'icntxt_icnbordercolor'			=> '',
		'icntxt_icnbordercolor_hover'	=> '',
		'icntxt_icnbordersize'			=> '',
		'icntxt_iconcolor_hover'		=> '',
		'icntxt_icnbackcolor_hover'		=> '',
		'custom_link'		            => '',
		'icntxt_link'		            => '',
		'icntxt_extraclass'				=> '',
		'css'							=> '',
	), $atts));
	
	
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
	
	
	/*
		Font icon or Image icon?
	*/
	
	if( $icon_type == 'selector' && !empty($icntxt_icon) ) {
		$content_icon = do_shortcode('[icon name="'.$icntxt_icon.'" size="'.$icntxt_icnsize.'px" height="'.$icntxt_icnsize.'px" color="'.$icntxt_iconcolor.'"]');
	}
	elseif($icon_type == 'custom' && !empty($icontxt_img)){
		$hgr_icon_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $icontxt_img, 'thumb_size' => 'full', 'class' => "" ) );
		$content_icon = '<div style="display:table;width:100%;height:100%;"><div style="display:table-cell;"><div style="width:'.$icontxt_img_width.'px; height:'.$icontxt_img_width.'px; margin: auto; vertical-align: text-top;">'.$hgr_icon_img_array['thumbnail'].'</div></div></div>';
	}
	
	switch($icon_alignment){
		case 'left': $alignment_style = '';
			break;
		
		case 'center': $alignment_style = ' display:block; margin-left:auto; margin-right:auto;';
			break;
		
		case 'right': $alignment_style = ' width:100%; text-align:right;';
			break;
		
		default: $alignment_style = '';
	}
	
	switch($icon_border_type){
		case 'none':
			$normal_bd = '0px';
		break;
		
		case 'icon-border-select':
			$normal_bd = $icntxt_icnbordersize.'px solid '.$icntxt_icnbordercolor;
			$hover_bd = $icntxt_icnbordersize.'px solid '.$icntxt_icnbordercolor_hover;
		break;
		
		default:
	}
	
	$icon_id = "hgr-onlyicon-".uniqid();


	if($icntxt_icon !== '' && $icon_background_type == 'none') {
		
		if ($icntxt_iconcolor_hover !== '') {
	
			$output .='<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery(".'.$icon_id.' .icon").css("color","'.$icntxt_iconcolor.'");
					
					jQuery(".'.$icon_id.' .icon").mouseenter(function() {
							jQuery(this).css("color","'.$icntxt_iconcolor_hover.'");
						}).mouseleave(function() {
							jQuery(this).css("color","'.$icntxt_iconcolor.'");
						});
				});
			</script>';
		}
		$output .= '<div class="hgr-icontxt ' . esc_attr( $css_class ) . ' '.$icon_id.' '.$icntxt_extraclass.'" style="'.$alignment_style.'">';
		if($custom_link !== 'no-link'){
			$href = vc_build_link($icntxt_link);
			if($href['url'] !== '') {
				$link_target = (isset($href['target'])) ? ' target="'.$href['target'].'"' : '';
				$link_title = (isset($href['title'])) ? ' title="'.$href['title'].'"' : '';
			}
			$output .= '<a href="'.$href['url'].'"'.$link_target.$link_title.'>';
			$output .= $content_icon;
			$output .= '</a>';
		}
		else {
			$output .= $content_icon;
		}
		$output .= '</div>';
	}
	
	if($icntxt_icon !== '' && $icon_background_type == 'icon-background-select') {
		if ($icntxt_iconcolor_hover !== '' || $icntxt_icnbackcolor_hover !== '') {
			$output .='<script type="text/javascript">';
			
				$output .='jQuery(document).ready(function() {';
				if ($icntxt_iconcolor_hover !== '') {
					$output .= 'jQuery(".'.$icon_id.' .icon").css("color","'.$icntxt_iconcolor.'");
					jQuery(".'.$icon_id.'").mouseenter(function() {
							jQuery(this).find(".icon").css("color","'.$icntxt_iconcolor_hover.'");
						}).mouseleave(function() {
							jQuery(this).find(".icon").css("color","'.$icntxt_iconcolor.'");
						});';
				}
				
				/* Add border color */
				
				$output .= 'jQuery(".'.$icon_id.'").css("border","'.$normal_bd.'");';
				if ($icntxt_icnbordercolor_hover !== '') {
				$output .= 'jQuery(".'.$icon_id.'").mouseenter(function() {
						jQuery(this).css("border","'.$hover_bd.'");
					}).mouseleave(function() {
						jQuery(this).css("border","'.$normal_bd.'");
					});';
				}
				
				if ($icntxt_icnbackcolor_hover !== '') {
					$output .= 'jQuery(".'.$icon_id.'").css("background","'.$icntxt_icnbackcolor.'");
					jQuery(".'.$icon_id.'").mouseenter(function() {
							jQuery(this).css("background","'.$icntxt_icnbackcolor_hover.'");
						}).mouseleave(function() {
							jQuery(this).css("background","'.$icntxt_icnbackcolor.'");
						});';
				}
				$output .= '});';
			$output .='</script>';
		}
		
		$output .='<style>';
		$output .='.'.$icon_id.' .icon { position: relative;top:calc(47% - ' . $icntxt_icnbacksize/2 . 'px); }';
		$output .='</style>';
		
		$output .= '<div class="hgr-icontxt ' . esc_attr( $css_class ) . ' '.$icon_id.' '.(!empty($icntxt_extraclass) ? $icntxt_extraclass : '').'" style="'.$alignment_style.' background-color:'.$icntxt_icnbackcolor.';width:'.$icntxt_icnbacksize.'px;height:'.$icntxt_icnbacksize.'px;line-height:'.$icntxt_icnbacksize.'px;border-radius:'.$icntxt_icnbackroundness.'px;-moz-border-radius:'.$icntxt_icnbackroundness.'px;-webkit-border-radius:'.$icntxt_icnbackroundness.'px;-o-border-radius:'.$icntxt_icnbackroundness.'px;)">';
		if($custom_link == 'yes-link'){
			$href = vc_build_link($icntxt_link);
			if($href['url'] !== '') {
				$link_target = (isset($href['target'])) ? ' target="'.$href['target'].'"' : '';
				$link_title = (isset($href['title'])) ? ' title="'.$href['title'].'"' : '';
			}
			$output .= '<a href="'.$href['url'].'"'.$link_target.$link_title.'>';
			$output .= $content_icon;
			$output .= '</a>';
		}
		else {
			$output .= $content_icon;
		}
		$output .= '</div>';
	}
	
	/*
		Return the output
	*/
	return $output;
}
	}
	new HGR_VC_ICON;
}
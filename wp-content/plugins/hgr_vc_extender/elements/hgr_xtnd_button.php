<?php
/*
* Add-on Name: HGR Button
* Add-on URI: http://highgradelab.com/plugins/highgrade-extender/
* Since: 1.0
* Author: Eugen Petcu
*/
if(!class_exists('HGR_VC_BUTTON')) {
	class HGR_VC_BUTTON extends WPBakeryShortCode {

		function __construct() {
			add_action('admin_init', array($this, 'hgr_button_init'));
			
			add_shortcode( 'hgr_button', array($this, 'hgr_button') );
		}
		
		/*
			Visual Composer mapping function
			Public API
			Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
			Example:		http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*/
		function hgr_button_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"				=>	__("HGR Button", "hgrextender"),
					   "holder"			=>	"div",
					   "base"				=>	"hgr_button",
					   "class"				=>	"",
					   "icon"				=>	"hgr_button",
					   "description"		=>	__("Very configurable button", "hgrextender"),
					   "category"			=>	__("HighGrade Extender", "hgrextender"),
					   "content_element"	=>	true,
					   "params"	=>	array(
						   array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Text on the button", "hgrextender"),
								"param_name"	=>	"hgr_buttontext",
								"value"			=>	__("Buy now!", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Text size (pixels)", "hgrextender"),
								"param_name"	=>	"hgr_buttontextsize",
								"value"			=>	"14",
								"save_always" 	=>	true,
							),
							array(
								 "type"			=>	"vc_link",
								 "class"		=>	"",
								 "heading"		=>	__("Button action URL","hgrextender"),
								 "param_name"	=>	"hgr_buttonurl",
								 "value"		=>	"",
								 "description"	=>	__("Set button link here.", "hgrextender"),
								 "save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Button alignment", "hgrextender"),
								"param_name"	=>	"hgr_btn_alignment",
								"value"			=>	array(	
									__( 'Left', 'hgrextender' )	=> 'left',
									__( 'Center', 'hgrextender' )	=> 'none',
									__( 'Right', 'hgrextender' )		=> 'right',
								),
								"save_always" 	=> true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Button text color", "hgrextender"),
								"param_name"	=>	"hgr_buttontextcolor",
								"value"			=>	"#808080",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Button text color on hover", "hgrextender"),
								"param_name"	=>	"hgr_buttontexthovercolor",
								"value"			=>	"#808080",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Button color", "hgrextender"),
								"param_name"	=>	"hgr_buttoncolor",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Button color on hover", "hgrextender"),
								"param_name"	=>	"hgr_buttoncolorhover",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Button width", "hgrextender"),
								"description"	=>	__("Insert only numeric values",'hgrextender'),
								"param_name"	=>	"hgr_buttonwidth",
								"value"			=>	"100",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Button width units", "hgrextender"),
								"param_name"	=>	"hgr_buttonwidthunits",
								"value"			=>	array(	
									__( 'Pixels', 'hgrextender' )	=> 'px',
									__( 'Percent', 'hgrextender' )	=> '%',
									__( 'Ems', 'hgrextender' )		=> 'em',
								),
								"save_always" 	=> true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Button height", "hgrextender"),
								"description"	=>	__("Insert only numeric values",'hgrextender'),
								"param_name"	=>	"hgr_buttonheight",
								"value"			=>	"60",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Button height units", "hgrextender"),
								"param_name"	=>	"hgr_buttonheightunits",
								"value"			=>	array(
									__( 'Pixels', 'hgrextender' ) 	=> 'px',
									__( 'Percent', 'hgrextender' )	=> '%',
									__( 'Ems', 'hgrextender' )		=> 'em',
								),
								"save_always" 	=> true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Button border weight", "hgrextender"),
								"description"	=>	__("Insert only numeric values. Pixels will be used.",'hgrextender'),
								"param_name"	=>	"hgr_buttonborderweight",
								"value"			=>	"1",	
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Button border color", "hgrextender"),
								"param_name"	=>	"hgr_buttonbodercolor",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Button border color on hover", "hgrextender"),
								"param_name"	=>	"hgr_buttonbordercolorhover",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Button roundness", "hgrextender"),
								"description"	=>	__("Insert only numeric values",'hgrextender'),
								"param_name"	=>	"hgr_buttonroundness",
								"value"			=>	"4",	
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon", "hgrextender"),
								"param_name"	=>	"hgr_hasicon",
								"value"			=>	array(
									__( 'No icon', 'hgrextender' ) 	=> 'noicon',
									__( 'Use icon', 'hgrextender' )	=> 'withicon',
								),
								"save_always" 	=> true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon position", "hgrextender"),
								"param_name"	=>	"hgr_iconposition",
								"value"			=>	array(
									__( 'Left', 'hgrextender' ) 	=> 'left',
									__( 'Right', 'hgrextender' )	=> 'right',
								),
								"save_always" 	=>	true,
								"dependency"	=>	array(
									"element"	=>	"hgr_hasicon",
									"value"		=>	array( "withicon")
								),
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon type", "hgrextender"),
								"param_name"	=>	"hgr_button_icontype",
								"value"			=>	array(
									__( 'Font Icon Browser', 'hgrextender' ) 	=> 'selector',
									__( 'Custom Image Icon', 'hgrextender' )	=> 'custom',
								),
								"save_always" 	=>	true,
								"description"	=>	__("Use an existing font icon or upload a custom image.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"hgr_hasicon",
									"value"		=>	array( "withicon" )
								),
							),
							array(
								"type"			=>	"icon_browser",
								"class"			=>	"",
								"heading"		=>	__("Select Icon ","hgrextender"),
								"param_name"	=>	"hgr_button_icon",
								"value"			=>	"icon",
								"description"	=>	__("Click on an icon to select it.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"hgr_button_icontype",
									"value"		=>	array( "selector" )
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"attach_image",
								"class"			=>	"",
								"heading"		=>	__("Upload Image Icon:", "hgrextender"),
								"param_name"	=>	"hgr_button_img",
								"admin_label"	=>	true,
								"value"			=>	"",
								"description"	=>	__("Upload the custom image icon.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"hgr_button_icontype",
									"value"		=>	array( "custom" )
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Icon size", "hgrextender"),
								"param_name"	=>	"hgr_button_iconsize",
								"value"			=>	"",
								"description"	=>	__("Enter value in pixels, example: 24", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"hgr_hasicon",
									"value"		=>	array( "withicon" )
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Extra class", "hgrextender"),
								"param_name"	=>	"hgr_button_extraclass",
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
		
		function hgr_button ($atts) {
			/*
				 Include necessary JS and CSS
			*/
			wp_enqueue_script('hgr-vc-jquery-appear');
			
			/*
				 Empty vars declaration
			*/
			$output = $do_icon = $hgr_buttontext = $hgr_buttontextsize = $hgr_buttontextcolor = $hgr_buttontexthovercolor = 
			$hgr_buttoncolor = $hgr_btn_alignment = $hgr_buttoncolorhover = $hgr_buttonwidth = $hgr_buttonwidthunits = $hgr_buttonheight = 
			$hgr_buttonheightunits = $hgr_buttonborderweight = $hgr_buttonbodercolor = $hgr_buttonbordercolorhover = 
			$hgr_buttonroundness = $hgr_buttonurl = $hgr_hasicon = $hgr_iconposition = $hgr_button_icontype = 
			$hgr_button_icon = $hgr_button_img = $hgr_button_iconsize = 
			$hgr_button_extraclass = $link_target = $link_title = $hgr_button_id = $css = '';
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'hgr_buttontext'				=> '',
				'hgr_buttontextsize'			=> '',
				'hgr_buttontextcolor'			=> '',
				'hgr_buttontexthovercolor'		=> '',
				'hgr_buttoncolor'				=> '',
				'hgr_btn_alignment'				=> 'none',
				'hgr_buttoncolorhover'			=> '',
				'hgr_buttonwidth'				=> '',
				'hgr_buttonwidthunits'			=> '',
				'hgr_buttonheight'				=> '',
				'hgr_buttonheightunits'			=> '',
				'hgr_buttonborderweight'		=> '',
				'hgr_buttonbodercolor'			=> '',
				'hgr_buttonbordercolorhover'	=> '',
				'hgr_buttonroundness'			=> '',
				'hgr_buttonurl'					=> '',
				'hgr_hasicon'					=> '',
				'hgr_iconposition'				=> '',
				'hgr_button_icontype'			=> '',
				'hgr_button_icon'				=> '',
				'hgr_button_img'				=> '',
				'hgr_button_iconsize'			=> '',
				'hgr_button_extraclass'			=> '',
				'css'							=> ''
			), $atts));
			
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			/*
				Font icon or image icon?
			*/
			if( $hgr_button_icontype == 'selector' && !empty($hgr_button_icon) ) {
				$do_icon = do_shortcode('[icon name="'.$hgr_button_icon.'" size="'.$hgr_button_iconsize.'px" ]');
			}
			elseif($hgr_button_icontype == 'custom' && !empty($hgr_button_img)){
				// image icon...
				$hgr_button_img_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $hgr_button_img, 'thumb_size' => 'full', 'class' => "hgr_button_imgicon" ) );
				$do_icon = $hgr_button_img_array['thumbnail'];
			}
			
			$hgr_button_style = 'width:'.$hgr_buttonwidth.$hgr_buttonwidthunits.';height:'.$hgr_buttonheight.$hgr_buttonheightunits.';line-height:'.$hgr_buttonheight.$hgr_buttonheightunits.';';
			

			/*
				Font size...
			*/
			if( !empty($hgr_buttontextsize) && $hgr_buttontextsize > 0 ){
				$hgr_button_style .= 'font-size:'.$hgr_buttontextsize.'px;';
			}
			/*
				Rounded corners?
			*/
			if( !empty($hgr_buttonroundness) && $hgr_buttonroundness > 0 ){
				$hgr_button_style .= 'border-radius:'.$hgr_buttonroundness.'px; -moz-border-radius:'.$hgr_buttonroundness.'px; -webkit-border-radius:'.$hgr_buttonroundness.'px;';
			}
			
			$hgr_button_id = "hgr-button-".uniqid();
			
			
				$output .='<script type="text/javascript">
						jQuery(document).ready(function() { ';
							$output .= 'jQuery(".'.$hgr_button_id.'.hgr_button").css("background-color","'.$hgr_buttoncolor.'").css("display","block").css("margin-right","auto").css("margin-left","auto").css("float","'.$hgr_btn_alignment.'");';
							$output .= 'jQuery(".'.$hgr_button_id.'.hgr_button").css("color","'.$hgr_buttontextcolor.'");';
							if( !empty($hgr_buttonborderweight) && $hgr_buttonborderweight > 0 ) {
								$output .= 'jQuery(".'.$hgr_button_id.'.hgr_button").css("border","'.$hgr_buttonborderweight.'px solid '.$hgr_buttonbodercolor.'");';
							}
							$output .='jQuery(".'.$hgr_button_id.'.hgr_button").mouseenter(function() {';
								
								
								// Button border on hover
								if($hgr_buttonborderweight>0){
									$output .='jQuery(this).css("border","'.$hgr_buttonborderweight.'px solid '.$hgr_buttonbordercolorhover.'");';
								}
								// Button BG color on hover
								$output .='jQuery(this).css("background-color","'.$hgr_buttoncolorhover.'");';
								
								// Text color on hover
								$output .='jQuery(this).css("color","'.$hgr_buttontexthovercolor.'");';
								
								$output .='}).mouseleave(function() {';
									
									// Button BG color on normal state
									$output .='jQuery(this).css("background-color","'.$hgr_buttoncolor.'");';
									
									// Text color normal state
									$output .='jQuery(this).css("color","'.$hgr_buttontextcolor.'");';
									
									
									if( !empty($hgr_buttonborderweight) && $hgr_buttonborderweight > 0 ) {
								$output .= 'jQuery(this).css("border","'.$hgr_buttonborderweight.'px solid '.$hgr_buttonbodercolor.'");';
							}
									$output .='});';
				$output .='});</script>';
			
			$href = vc_build_link($hgr_buttonurl);
				if($href['url'] !== '') {
					$link_target = ( strlen( $href['target'] ) ? ' target="'.$href['target'].'" ' : '' );
					$link_title = ( strlen( $href['title'] ) ? ' title="'.$href['title'].'" ' : '' );
				}
			$output .= '<a href="'.$href['url'].'" '.$link_target.' '.$link_title.' class="hgr_button ' . esc_attr( $css_class ) . ' '.$hgr_button_id.' '.$hgr_button_extraclass.'" style="'.$hgr_button_style.'">';
				// NO ICON
				if( $hgr_hasicon == 'noicon' ){
					$output .= $hgr_buttontext;
				} else {
					// LEFT ICON
					if( $hgr_iconposition == 'left' ){
						$output .= $do_icon.' &nbsp;&nbsp; '.$hgr_buttontext;
					}
					// RIGHT ICON
					elseif( $hgr_iconposition == 'right' ){
						$output .= $hgr_buttontext.' &nbsp;&nbsp; '.$do_icon;
					}
				}		
			$output .='</a>';
			
			/*
				Return the output
			*/		
			return $output;
		}
	}
	new HGR_VC_BUTTON;
}
<?php
/*
	* Add-on Name: Flip Card
	* Add-on URI: http://highgradelab.com/plugins/highgrade-extender/
	* Since: 1.0
	* Add-on Author: Bogdan Costescu
*/
if(!class_exists('HGR_VC_FLIPCARD')) {
	class HGR_VC_FLIPCARD extends WPBakeryShortCode {
		function __construct() {
			add_action('admin_init', array($this, 'hgr_flipcard'));
			
			add_shortcode('hgr_flip_card', array($this, 'hgr_flipcard_shortcode') );
			
			
			/*
				Param type "number"
			*/ 
			if ( function_exists('vc_add_shortcode_param')){
				vc_add_shortcode_param('number' , array('HGR_XTND', 'make_number_input' ) );
			}
			
			/*
				Param type "icon_browser"
			*/ 
			if(function_exists('vc_add_shortcode_param')){
				vc_add_shortcode_param('icon_browser', array('HGR_XTND','icon_browser'));
			}
		}
		
		/*
			Visual Composer mapping function
			Public API
			Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
			Example:		http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*/
		function hgr_flipcard() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"			=>	__("HGR Flip Card","hgrextender"),
					   "base"			=>	"hgr_flip_card",
					   "class"			=>	"",
					   "icon"			=>	"hgr_flipcard",
					   "category"		=>	__("HighGrade Extender", "hgrextender"),
					   "description"	=>	__("Flip Card with advanced settings", "hgrextender"),
					   "params"		=>	array(
							/*
								Front panel icon settings
							*/
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon to display on front side:", "hgrextender"),
								"param_name"	=>	"icon_type",
								"value"			=>	array(
										__( 'Font Icon Browser', 'hgrextender' )	=> 'selector',
										__( 'None', 'hgrextender' ) 				=> 'none',
									),
								"save_always" 	=> true,
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
										"element"	=>	"icon_type",
										"value"		=>	array( "selector" )
									),
							),
							/*
								Front Icon position settings
							*/
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon position on front side:","hgrextender"),
								"param_name"	=>	"icon_front_place",
								"value"			=>	array(
										__( 'Top', 'hgrextender' )					=> 'icon_front_top',
										__( 'Bottom', 'hgrextender' ) 				=> 'icon_front_bottom',
										__( 'Just icon, no text', 'hgrextender' ) 	=> 'icon_front_notext',
									),
								"save_always" 	=> true,
								"description"	=>	__("Select where you want to display the icon.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_type",
										"value"		=>	array( "selector" )
									),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"hgr_range_class",
								"heading"		=>	__("Size of Icon on front side:", "hgrextender"),
								"param_name"	=>	"icon_size",
								"value"			=>	32,
								"min"			=>	12,
								"max"			=>	72,
								"suffix"		=>	"px",
								"description"	=>	__("Set the icon size on front panel", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_type",
										"value"		=>	array( "selector" )
									),
								),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Color of Icon on front side:", "hgrextender"),
								"param_name"	=>	"icon_color",
								"value"			=>	"#333333",
								"description"	=>	__("Pick your desired icon color", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_type",
										"value"		=>	array( "selector" ),
									),						
								),
							/*
								Front side icon bg settings
							*/
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Front side icon background settings:", "hgrextender"),
								"param_name"	=>	"icon_background_type",
								"value"			=>	array(
										__( 'None', 'hgrextender' )						=> 'none',
										__( 'Select background color', 'hgrextender' ) 	=> 'icon-background-select',
									),
								"save_always" 	=> true,
								"description"	=>	__("Select background settings for your icon.","hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_front_place",
										"value"		=>	array( "icon_front_top", "icon_front_bottom" ),
									),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Front side icon background color:", "hgrextender"),
								"param_name"	=>	"icon_background_color",
								"value"			=>	"#333333",
								"description"	=>	__("Pick a background color for your icon.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_background_type",
										"value"		=>	array( "icon-background-select" ),
									),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Front side icon background size:", "hgrextender"),
								"param_name"	=>	"icon_background_size",
								"value"			=>	60,
								"min"			=>	20,
								"max"			=>	100,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_background_type",
										"value"		=>	array("icon-background-select")
									),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Front Panel Icon Background Roundness:", "hgrextender"),
								"param_name"	=>	"icon_background_roundness",
								"value"			=>	0,
								"min"			=>	0,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels, example: 0 for square, or 5 for rounded corners.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_background_type",
										"value"		=>	array( "icon-background-select" )
									),
							),
							/*
								Back side icon settings
							*/
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Icon settings on back side:","hgrextender"),
								"param_name"	=>	"icon_type_back",
								"value"			=>	array(
										__( 'No icon', 'hgrextender' )				=> 'no_icon_back',
										__( 'Top position', 'hgrextender' ) 		=> 'top_icon_back',
										__( 'Bottom position', 'hgrextender' ) 		=> 'bottom_icon_back',
										__( 'Just icon, no text', 'hgrextender' ) 	=> 'notext_icon_back',
									),
								"save_always" 	=> true,
								"description"	=>	__("Display same icon from front side or none on the back side.", "hgrextender")
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Size of Icon on back side:", "hgrextender"),
								"param_name"	=>	"icon_size_back",
								"value"			=>	32,
								"min"			=>	12,
								"max"			=>	72,
								"suffix"		=>	"px",
								"description"	=>	__("Set the icon size for back side.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_type_back",
										"value"		=>	array( "top_icon_back", "bottom_icon_back", "notext_icon_back" )
									),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Color of Icon on back side:", "hgrextender"),
								"param_name"	=>	"icon_color_back",
								"value"			=>	"#333333",
								"description"	=>	__("Use the color picker.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_type_back",
										"value"		=>	array( "top_icon_back", "bottom_icon_back", "notext_icon_back" ),
									),						
							),
							/*
								Back side icon bg settings
							*/
							array(
								"type" 			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Back side icon background settings:", "hgrextender"),
								"param_name"	=>	"bpicon_background_type",
								"value"			=>	array(
										__( 'None', 'hgrextender' )						=> 'none',
										__( 'Select background color', 'hgrextender' ) 	=> 'bpicon-background-select',
									),
								"save_always" 	=> true,
								"description"	=>	__("Select background settings for your icon.","hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_type_back",
										"value"		=>	array( "top_icon_back", "bottom_icon_back" ),
									),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Back side icon background color:", "hgrextender"),
								"param_name"	=>	"bpicon_background_color",
								"value"			=>	"#333333",
								"description"	=>	__("Pick a background color for your icon.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"bpicon_background_type",
										"value"		=>	array( "bpicon-background-select" ),
									),					
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Back Panel Icon Background Size:", "hgrextender"),
								"param_name"	=>	"bpicon_background_size",
								"value"			=>	60,
								"min"			=>	20,
								"max"			=>	100,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"bpicon_background_type",
										"value"		=>	array( "bpicon-background-select" ),
									),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Back Panel Icon Background Roundness:", "hgrextender"),
								"param_name"	=>	"bpicon_background_roundness",
								"value"			=>	0,
								"min"			=>	0,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels, example: 0 for square, or 5 for rounded corners.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"bpicon_background_type",
										"value"		=>	array( "bpicon-background-select" ),
									),
							),
							/*
								Front side settings
							*/
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Front side title","hgrextender"),
								 "param_name"	=>	"title_front",
								 "value"		=>	"Fast customization",
								 "description"	=>	__("Title for the front panel.", "hgrextender"),
								 "dependency"	=>	array(
								 		"element"	=>	"icon_front_place",
										"value"		=>	array( "icon_front_top", "icon_front_bottom" ),
									),
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Front side Title HTML Format", "hgrextender"),
								"param_name"	=>	"title_front_format",
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
								"heading"		=>	__("Front title color", "hgrextender"),
								"param_name"	=>	"front_title_color",
								"value"			=>	"#333333",
								"description"	=>	__("Color of title on front side.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_front_place",
										"value"		=>	array( "icon_front_top", "icon_front_bottom" ),
									),
							),
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Description on front side","hgrextender"),
								 "param_name"	=>	"desc_front",
								 "value"		=>	"Using the visual editor has never been easier.",
								 "description"	=>	__("Insert front panel description here.", "hgrextender"),
								 "dependency"	=>	array(
								 		"element"	=>	"icon_front_place",
										"value"		=>	array( "icon_front_top", "icon_front_bottom" )
									),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Front side description color", "hgrextender"),
								"param_name"	=>	"front_desc_color",
								"value"			=>	"#333333",
								"description"	=>	__("Color of description on front panel.", "hgrextender"),
								"dependency"	=>	array("
										element"	=>	"icon_front_place",
										"value"		=>	array( "icon_front_top", "icon_front_bottom" ),
									),
							),
							/*
								Front side bg settings
							*/
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Front side background type", "hgrextender"),
								"param_name"	=>	"front_background_type",
								"value"			=>	array(
										__( 'None', 'hgrextender' )			=> 'none',
										__( 'Select color', 'hgrextender' )	=> 'custom-front-color',
									),
								"save_always" 	=> true,
								"description"	=>	__("Select background color for front panel.", "hgrextender"),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading" 		=>	__("Front Panel Background Color", "hgrextender"),
								"param_name"	=>	"front_background_color",
								"value"			=>	"#333333",
								"description"	=>	__("Pick a background color for front panel.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"front_background_type",
										"value"		=>	array("custom-front-color"),
									),						
							),
							/*
								Front side border settings
							*/
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Front side border type", "hgrextender"),
								"param_name"	=>	"front_border_type",
								"value"			=>	array(
										__( 'None', 'hgrextender' )						=> 'none',
										__( 'Custom border settings', 'hgrextender' )	=> 'custom-front-border',
									),
								"save_always" 	=> true,
								"description"	=>	__("Customize border settings for front side.", "hgrextender"),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Front Border Width", "hgrextender"),
								"param_name"	=>	"front_border_width",
								"value"			=>	2,
								"min"			=>	1,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"front_border_type",
										"value"		=>	array( "custom-front-border" ),
									),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Front Border Color", "hgrextender"),
								"param_name"	=>	"front_border_color",
								"value"			=>	"#333333",
								"description"	=>	__("Pick a color for front side border.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"front_border_type",
										"value"		=>	array( "custom-front-border" ),
									),						
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Front Border Roundness:", "hgrextender"),
								"param_name"	=>	"front_border_roundness",
								"value"			=>	0,
								"min"			=>	0,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels, example: 0 for square, or 5 for rounded corners.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"front_border_type",
										"value"		=>	array( "custom-front-border" ),
									),
							),
							/*
								Back side text config
							*/
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Back side title","hgrextender"),
								 "param_name"	=>	"title_back",
								 "value"		=>	"",
								 "description"	=>	__("Insert back panel title here.", "hgrextender"),
								 "dependency"	=>	array(
								 		"element"	=>	"icon_type_back",
										"value"		=>	array( "no_icon_back", "top_icon_back", "bottom_icon_back" ),
									),
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Front side Title HTML Format", "hgrextender"),
								"param_name"	=>	"title_back_format",
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
								"heading"		=>	__("Back title color", "hgrextender"),
								"param_name"	=>	"back_title_color",
								"value"			=>	"#333333",
								"description"	=>	__("Color of title on back side.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_type_back",
										"value"		=>	array( "no_icon_back", "top_icon_back", "bottom_icon_back" ),
									),
							),
							array(
								 "type"			=>	"textarea",
								 "class"		=>	"",
								 "heading"		=>	__("Back side description","hgrextender"),
								 "param_name"	=>	"desc_back",
								 "value"		=>	"",
								 "description"	=>	__("Insert back side description here.", "hgrextender"),
								 "dependency"	=>	array(
								 		"element"	=>	"icon_type_back",
										"value"		=>	array( "no_icon_back", "top_icon_back", "bottom_icon_back" ),
									),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Back side description color", "hgrextender"),
								"param_name"	=>	"back_desc_color",
								"value"			=>	"#333333",
								"description"	=>	__("Color of description on back side.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"icon_type_back",
										"value"		=>	array("no_icon_back","top_icon_back","bottom_icon_back"),
									),
							),
							/*
								Back side bg settings
							*/
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Back side background type", "hgrextender"),
								"param_name"	=>	"back_background_type",
								"value"			=>	array(
										__( 'None', 'hgrextender' )			=> 'none',
										__( 'Select color', 'hgrextender' )	=> 'custom-back-color',
									),
								"save_always" 	=> true,
								"description"	=>	__("Select background color for back panel.", "hgrextender"),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Back side background color", "hgrextender"),
								"param_name"	=>	"back_background_color",
								"value"			=>	"#333333",
								"description"	=>	__("Pick a background color for back side.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"back_background_type",
										"value"		=>	array( "custom-back-color" )
									),						
							),
							/*
								Back side border settings
							*/
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Back side border type", "hgrextender"),
								"param_name"	=>	"back_border_type",
								"value"			=>	array(
										__( 'None', 'hgrextender' )						=> 'none',
										__( 'Custom border setttings', 'hgrextender' )	=> 'custom-back-border',
									),
								"save_always" 	=> true,
								"description"	=>	__("Customize border settings for back side.", "hgrextender"),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Back border thickness", "hgrextender"),
								"param_name"	=>	"back_border_width",
								"value"			=>	2,
								"min"			=>	1,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"back_border_type",
										"value"		=>	array( "custom-back-border" )
									),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Back border bolor", "hgrextender"),
								"param_name"	=>	"back_border_color",
								"value"			=>	"#333333",
								"description"	=>	__("Pick a color for back side border.", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"back_border_type",
										"value"		=>	array( "custom-back-border" ),
									),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Back side border roundness:", "hgrextender"),
								"param_name"	=>	"back_border_roundness",
								"value"			=>	0,
								"min"			=>	0,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels, example: 0 for square, or 5 for rounded corners.", "hgrextender"),
								"dependency"	=> 	array(
										"element"	=>	"back_border_type",
										"value"		=>	array( "custom-back-border" ),
									),
							),
							/*
								Back side link button settings
							*/
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Button link on back side","hgrextender"),
								"param_name"	=>	"custom_link",
								"value"			=>	array(
										__( 'No Link', 'hgrextender' )						=> '',
										__( 'Add custom link with button', 'hgrextender' )	=> '1',
									),
								"save_always" 	=> true,
								"description"	=>	__("You can add / remove custom link", "hgrextender"),
								"dependency"	=>	array(
								 		"element"	=>	"icon_type_back",
										"value"		=>	array( "no_icon_back", "top_icon_back" ),
								),
							),
							array(
								 "type"			=>	"vc_link",
								 "class"		=>	"",
								 "heading"		=>	__("Link ","hgrextender"),
								 "param_name"	=>	"button_link",
								 "value"		=>	"",
								 "description"	=>	__("You can link or remove the existing link on the button from here.", "hgrextender"),
								 "dependency"	=>	array(
								 		"element"		=>	"custom_link",
										"not_empty"	=>	true, 
										"value"			=>	array("1"),
									),
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Button Text", "hgrextender"),
								"param_name"	=>	"button_text",
								"value"			=>	"Show me!",
								"description"	=>	__("Make sure the text clearly calls for a specific action.", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"custom_link",
										"not_empty"	=>	true,
										"value"			=>	array("1"),
									),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Button background color", "hgrextender"),
								"param_name"	=>	"button_bg",
								"value"			=>	"#333333",
								"description"	=>	__("Color of the button. Make sure it'll match with Back Side Box Color.", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"custom_link",
										"not_empty"	=>	true,
										"value"			=>	array("1"),
									),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Button Text Color", "hgrextender"),
								"param_name"	=>	"button_txt",
								"value"			=>	"#FFFFFF",
								"description"	=>	__("Select the color for button text.", "hgrextender"),
								"dependency"	=>	array(
										"element"		=>	"custom_link",
										"not_empty"	=>	true,
										"value"			=>	array("1"),
									),
							),
							/*
								Back side icon link
							*/
							array(
								"type"			=>	"dropdown",
								"class"		=>	"",
								"heading"		=>	__("Back side icon link", "hgrextender"),
								"param_name"	=>	"custom_link_back",
								"value"			=>	array(
										__( 'No Link', 'hgrextender' )			=> '',
										__( 'Add custom link', 'hgrextender' )	=> '1',
									),
								"save_always" 	=> true,
								"description"	=>	__("You can add / remove custom link", "hgrextender"),
								"dependency"	=>	array(
								 		"element"	=>	"icon_type_back",
										"value"		=>	array("notext_icon_back"),
									),
							),
							array(
								 "type"			=>	"vc_link",
								 "class"		=>	"",
								 "heading"		=>	__("Link ", "hgrextender"),
								 "param_name"	=>	"back_icon_link",
								 "value"		=>	"",
								 "description"	=>	__("You can link or remove the existing link on the back panel icon from here.", "hgrextender"),
								 "dependency"	=>	array(
								 		"element"		=>	"custom_link_back",
										"not_empty"	=>	true,
										"value"			=>	array("1"),
									),
							),
							/*
								Box height settings
							*/
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Set Box Height", "hgrextender"),
								"param_name"	=>	"height_type",
								"value"			=>	array(
										__( 'Auto', 'hgrextender' )		=> 'auto',
										__( 'Custom', 'hgrextender' )	=> 'custom',
									),
								"save_always" 	=> true,
								"description"	=>	__("Select height option for this box.", "hgrextender"),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Box Height", "hgrextender"),
								"param_name"	=>	"box_height",
								"value"			=>	300,
								"min"			=>	200,
								"max"			=>	1200,
								"suffix"		=>	"px",
								"description"	=>	__("Provide box height", "hgrextender"),
								"dependency"	=>	array(
										"element"	=>	"height_type",
										"value"		=>	array( "custom" ),
									),	
							),
							/*
								Item extra class
							*/
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Extra class", "hgrextender"),
								 "param_name"	=>	"fb_extra_class",
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
		
		function hgr_flipcard_shortcode($atts) {
			/*
				 Empty vars declaration
			*/
			$icon_type = $icon_img = $img_width = $icon = $icon_color = $title_front_format = $title_back_format = $icon_size = $icon_background_type = $icon_background_color = $icon_background_size = $icon_background_roundness = $icon_front_place = $icon_type_back = $icon_img_back = $img_width_back = $icon_back = $icon_color_back = $icon_size_back = $bpicon_background_type = $bpicon_background_color = $bpicon_background_size = $bpicon_background_roundness = $icon_back_place = $title_front = $front_title_color = $desc_front = $front_desc_color = $front_background_type = $front_background_color = $front_border_type = $front_border_width = $front_border_color = $front_border_roundness = $title_back = $back_title_color = $desc_back = $back_desc_color = $back_background_color = $back_border_type = $back_border_width = $back_border_color = $back_border_roundness = $button_text = $button_link = $animation = $font_size_icon = $custom_link = $button_bg = $button_txt = $custom_link_back = $back_icon_link = $height_type = $box_height = $flip_card_style = $fb_extra_class = $output = $link_style = $front_style = $front_bg = $front_icon_display = $front_title_display = $front_desc_display = $back_icon_display = $back_icon_display_notext = $back_title_display = $back_desc_display = $back_style = $back_bg = $height = $css = '';
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts( array(
				'icon_type'							=>	'',
				'icon'								=>	'',
				'icon_img'							=>	'',
				'img_width'							=>	'',
				'icon_size'							=>	'',				
				'icon_color'							=>	'',
				'title_front_format'				=>	'',
				'title_back_format'					=>	'',
				'icon_background_type'				=>	'',
				'icon_background_color'				=>	'',
				'icon_background_size'				=>	'',
				'icon_background_roundness'			=>	'',
				'icon_front_place'					=>	'',
				'icon_type_back'					=>	'',
				'icon_back'							=>	'',
				'icon_img_back'						=>	'',
				'img_width_back'					=>	'',
				'icon_size_back'					=>	'',				
				'icon_color_back'					=>	'',
				'bpicon_background_type'			=>	'',
				'bpicon_background_color'			=>	'',
				'bpicon_background_size'			=>	'',
				'bpicon_background_roundness'		=>	'',
				'icon_back_place'					=>	'',
				'title_front'						=>	'',
				'front_style'						=>	'',
				'front_title_color'					=>	'',
				'desc_front'							=>	'',
				'front_desc_color'					=>	'',
				'front_background_type'				=>	'',
				'front_background_color'			=>	'',
				'front_border_type'					=>	'',
				'front_border_width'				=>	'',
				'front_border_color'				=>	'',
				'front_border_roundness'			=>	'',
				'title_back'							=>	'',
				'back_title_color'					=>	'',
				'desc_back'							=>	'',
				'back_desc_color'					=>	'',
				'back_background_type'				=>	'',
				'back_background_color'				=>	'',
				'back_border_type'					=>	'',
				'back_border_width'					=>	'',
				'back_border_color'					=>	'',
				'back_border_roundness'				=>	'',
				'custom_link'						=>	'',
				'button_text'						=>	'',
				'button_link'						=>	'',
				'button_bg'							=>	'',
				'button_txt'							=>	'',
				'custom_link_back'					=>	'',
				'back_icon_link'					=>	'',
				'height_type'						=>	'',
				'box_height'							=>	'',
				'flip_card_style'					=>	'',
				'fb_extra_class'					=>	'',
				'css'								=>	'',
			),$atts));
			
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			
			/*
				Icon shortcode exec
			*/
			$flip_icon = do_shortcode('[icon name="icon '.$icon.'" icon_img="'.$icon_img.'" img_width="'.$img_width.'" size="'.$icon_size.'px " color="'.$icon_color.'"]');
			$flip_icon_back = do_shortcode('[icon name="icon '.$icon.'" icon_img="'.$icon_img.'" img_width="'.$img_width_back.'" size="'.$icon_size_back.'px " color="'.$icon_color_back.'"]');
			$css_trans = $icon_border = $box_border = '';
			
			switch($front_background_type){
				case 'none':
					$front_bg = 'background:none;';
				break;
				
				case 'custom-front-color':
					$front_bg = 'background:'.$front_background_color.';';
				break;
			}
			
			switch($front_border_type){
				case 'none':
					$front_bd = 'border:0px;';
				break;
				
				case 'custom-front-border':
					$front_bd = 'border:'.$front_border_width.'px solid '.$front_border_color.';border-radius:'.$front_border_roundness.'px;-moz-border-radius:'.$front_border_roundness.'px;-webkit-border-radius:'.$front_border_roundness.'px;-o-border-radius:'.$front_border_roundness.'px;';
				break;
			}
			
			if($front_title_color !== '') {
				$front_tc = 'color:'.$front_title_color.';';
			}
			
			$front_style = $front_bg.$front_bd;
			
			switch($back_background_type) {
				case 'none':
					$back_bg = 'background:none;';
				break;
				
				case 'custom-back-color':
					$back_bg = 'background:'.$back_background_color.';';
				break;
			}
			
			switch($back_border_type) {
				case 'none':
					$back_bd = 'border:0px;';
				break;
				
				case 'custom-back-border':
					$back_bd = 'border:'.$back_border_width.'px solid '.$back_border_color.';border-radius:'.$back_border_roundness.'px;-moz-border-radius:'.$back_border_roundness.'px;-webkit-border-radius:'.$back_border_roundness.'px;-o-border-radius:'.$back_border_roundness.'px;';
				break;
			}

			if($back_title_color !== '') {
				$back_tc = 'color:'.$back_title_color.';';
			}
			
			$back_style = $back_bg.$back_bd;
			
			if($height_type == "custom") {
				$height = 'height:'.$box_height.'px;';
			}
			
			$output .= '<div class="hgr-flipcard '.$fb_extra_class.' ' . esc_attr( $css_class ) . '">';
				$output .= '<div class="flipper" style="'.$height.'">';
					$output .= '<div class="front-fb" style="'.$front_style.'">';
						if($icon !== '' && $icon_background_type == 'none') {
							$front_icon_display .='<div class="f-front-icon-fb">'.$flip_icon.'</div>';
							}
						if($icon !== '' && $icon_background_type == 'icon-background-select') {
							$front_icon_display .='<div class="f-front-icon-fb" style="background:'.$icon_background_color.';width:'.$icon_background_size.'px;height:'.$icon_background_size.'px;line-height:'.$icon_background_size.'px;border-radius:'.$icon_background_roundness.'px;-moz-border-radius:'.$icon_background_roundness.'px;-webkit-border-radius:'.$icon_background_roundness.'px;-o-border-radius:'.$icon_background_roundness.'px;">'.$flip_icon.'</div>';
							}
						if(!empty($title_front)) {
							$front_title_display .='<'.$title_front_format.' style="'.$front_tc.'">'.$title_front.'</'.$title_front_format.'>';
							}
						if(!empty($desc_front)) {
							$front_desc_display .='<p style="color:'.$front_desc_color.'">'.$desc_front.'</p>';
							}
						switch($icon_front_place){
							case 'icon_front_top':
								$output .= $front_icon_display.$front_title_display.$front_desc_display;
							break;
							
							case 'icon_front_bottom':
								$output .= $front_title_display.$front_desc_display.$front_icon_display;
							break;
							
							case 'icon_front_notext':
								$output .='<div class="f-front-icon-notext">'.$flip_icon.'</div>';
							break;
						}	
					$output .='</div>';
					$output.='<div class="back-fb" style="'.$back_style.'">';
					
					if($icon !== '' && $bpicon_background_type == 'none') {
						$back_icon_display .='<div class="f-back-icon-fb">'.$flip_icon_back.'</div>';
					}
					if($icon !== '' && $bpicon_background_type == 'bpicon-background-select') {
						$back_icon_display .='<div class="f-back-icon-fb" style="background:'.$bpicon_background_color.';width:'.$bpicon_background_size.'px;height:'.$bpicon_background_size.'px;line-height:'.$bpicon_background_size.'px;border-radius:'.$bpicon_background_roundness.'px;-moz-border-radius:'.$bpicon_background_roundness.'px;-webkit-border-radius:'.$bpicon_background_roundness.'px;-o-border-radius:'.$bpicon_background_roundness.'px;">'.$flip_icon_back.'</div>';
					}
					
					if($icon !== '' || $icon_img !== '') {
						if(!empty($custom_link_back)) {
							$href_back = vc_build_link($back_icon_link);
							if($href_back['url'] !== '') {
								$link_target_back = (isset($href_back['target'])) ? ' target="'.$href_back['target'].'"' : '';
								$link_title_back = (isset($href_back['title'])) ? ' title="'.$href_back['title'].'"' : '';
							}
							$back_icon_display_notext .='<a href="'.$href_back['url'].'"'.$link_target_back.''.$link_title_back.' class="f-back-icon-notext">'.$flip_icon_back.'</a>';
						}
						else {
							$back_icon_display_notext .='<div class="f-back-icon-notext">'.$flip_icon_back.'</div>';
						}
					}
					if(!empty($title_back)) {
						$back_title_display .='<'.$title_back_format.' style="'.$back_tc.'">'.$title_back.'</'.$title_back_format.'>';
					}
					if(!empty($desc_back)) {
						$back_desc_display .='<p style="color:'.$back_desc_color.'">'.$desc_back.'</p>';
					}

					switch($icon_type_back){
							case 'top_icon_back':
								$output .= $back_icon_display.$back_title_display.$back_desc_display;
							break;
							
							case 'bottom_icon_back':
								$output .= $back_title_display.$back_desc_display.$back_icon_display;
							break;
							
							case 'notext_icon_back':
								$output .= $back_icon_display_notext;
							break;
							
							case 'no_icon_back':
								$output .= $back_title_display.$back_desc_display;
							break;
						}
							
					if($button_text !== '' && $custom_link){
						$link_prefix = '<div class="back-button">';
							if($button_bg !== '' && $button_txt !== '')
								$link_style = 'style="background-color:'.$button_bg.'; color:'.$button_txt.';"';
									if($button_link !== ''){								
										$href = vc_build_link($button_link);
										if($href['url'] !== '') {
											$link_target = (isset($href['target'])) ? ' target="'.$href['target'].'"' : '';
											$link_title = (isset($href['title'])) ? ' title="'.$href['title'].'"' : '';
										}
										$link_prefix .= '<a href="'.$href['url'].'"'.$link_target.''.$link_title.' '.$link_style.'>';
										$link_sufix .= '</a>';
									}
						$link_sufix .= '</div>';
						$output .=$link_prefix.$button_text.$link_sufix;
					}
					$output .='</div>';
				$output .= '</div>';
			$output .= '</div>';
			
			/*
				Return the output
			*/
			return $output;		
		}
	}
	new HGR_VC_FLIPCARD;
}
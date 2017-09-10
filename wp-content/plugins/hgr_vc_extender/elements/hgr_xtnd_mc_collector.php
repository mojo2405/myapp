<?php
/*
* Add-on Name: HGR MailChimp Collector
* Add-on URI: http://highgradelab.com/plugins/highgrade-extender/
* Based on MailChimp API, version 1.3
* Since: 1.0
* Author: Eugen Petcu
*/
if(!class_exists('HGR_VC_MCHIMP_COLLECTOR')) {
	class HGR_VC_MCHIMP_COLLECTOR extends WPBakeryShortCode {
		
		function __construct() {
			add_action('admin_init', array($this, 'hgr_mchimp_collector_init'));
			
			add_shortcode( 'hgr_mailchimpcollector', array($this, 'hgr_mchimp_collector') );
		}
		
		
		/*
			Visual Composer mapping function
			Public API
			Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
			Example:		http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*/
		function hgr_mchimp_collector_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"				=>	__("HGR MailChimp Collector", "hgrextender"),
					   "holder"			=>	"div",
					   "base"				=>	"hgr_mailchimpcollector",
					   "class"				=>	"",
					   "icon"				=>	"hgr_mailchimpcollector",
					   "category"			=>	__("HighGrade Extender", "hgrextender"),
					   "description"		=>	__("Collect email addresses to your MailChimp list.", "hgrextender"),
					   "content_element"	=>	true,
					   "params"			=>	array(
							array(
								"type"				=>	"textfield",
								"class"				=>	"",
								"heading"			=>	__("MailChimp API Key", "hgrextender"),
								"param_name"		=>	"hgr_mc_apikey",
								"value"				=>	"",
								"description"		=>	__('Your MailChimp API Key. Grab an API Key from <a href="http://admin.mailchimp.com/account/api/" target="_blank">http://admin.mailchimp.com/account/api/</a>.', "hgrextender"),
								"save_always" 		=>	true,		
							),
							array(
								"type"				=>	"textfield",
								"class"				=>	"",
								"heading"			=>	__("MailChimp List ID", "hgrextender"),
								"param_name"		=>	"hgr_mc_listid",
								"value"				=>	"",
								"save_always" 		=>	true,	
							),
							array(
								"type"				=>	"checkbox",
								"heading"			=>	__("Enable anti-spam disclaimer", "hgrextender"),
								"param_name"		=>	"hgr_mc_enable_disclaimer",
								"description"		=>	__("If checked, 'We'll never spam or give this address away' will be displayed.", "hgrextender"),
								"value"				=>	array( esc_html__("Yes, please", "hgrextender") => "yes" ),
								"save_always" 		=>	true,
						    ),
							array(
								"type"				=>	"checkbox",
								"heading"			=>	__("Collect name too", "hgrextender"),
								"param_name"		=>	"hgr_mc_collect_name",
								"description"		=>	__("If checked, 'Name' will be required too.", "hgrextender"),
								"value"				=>	array( esc_html__("Yes, please", "hgrextender") => "yes" ),
								"save_always" 		=>	true,
						    ),
							array(
								"type"				=>	"checkbox",
								"heading"			=>	__("Collect last name too", "hgrextender"),
								"param_name"		=>	"hgr_mc_collect_lastname",
								"description"		=>	__("If checked, 'Lastname' will be required too.", "hgrextender"),
								"value"				=>	array(	__( "Yes, please", "hgrextender") => "yes" ),
								"save_always" 		=>	true,
						    ),
							array(
								"type"				=>	"colorpicker",
								"class"				=>	"",
								"heading"			=>	__("Background color of inputs", "hgrextender"),
								"param_name"		=>	"hgr_mc_collect_inputbgcolor",
								"value"				=>	"#333333",
								"description"		=>	__("Use the color picker.", "hgrextender"),	
								"save_always" 		=>	true,				
							),
							array(
								"type"				=>	"colorpicker",
								"class"				=>	"",
								"heading"			=>	__("Text color of inputs", "hgrextender"),
								"param_name"		=>	"hgr_mc_collect_inputstextcolor",
								"value"				=>	"#333333",
								"description"		=>	__("Color of the text inside the inputs", "hgrextender"),
								"save_always" 		=>	true,				
							),
							array(
								"type"				=>	"colorpicker",
								"class"				=>	"",
								"heading"			=>	__("Background color of button", "hgrextender"),
								"param_name"		=>	"hgr_mc_collect_btnbgcolor",
								"value"				=>	"#333333",
								"description"		=>	__("Use the color picker.", "hgrextender"),	
								"save_always" 		=>	true,
							),
							array(
								"type"				=>	"colorpicker",
								"class"				=>	"",
								"heading"			=>	__("Text color of button", "hgrextender"),
								"param_name"		=>	"hgr_mc_collect_btntextcolor",
								"value"				=>	"#333333",
								"description"		=>	__("Color of the text inside the button", "hgrextender"),
								"save_always" 		=>	true,
							),
							array(
								"type"				=>	"colorpicker",
								"class"				=>	"",
								"heading"			=>	__("NO-SPAM & response text color", "hgrextender"),
								"param_name"		=>	"hgr_mc_collect_nstextcolor",
								"value"				=>	"#333333",
								"description"		=>	__("Color of the NO-SPAM text", "hgrextender"),	
								"save_always" 		=>	true,
							),
							array(
								"type"				=>	"textfield",
								"class"				=>	"",
								"heading"			=>	__("Extra class", "hgrextender"),
								"param_name"		=>	"extra_class",
								"value"				=>	"",
								"description"		=>	__("Extra CSS class for custom CSS", "hgrextender")	,
								"save_always" 		=>	true,
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
		
		function hgr_mchimp_collector ($atts) {
			/*
				Incldue the MC API
			*/
			require_once( plugin_dir_path( dirname(__FILE__) ).'includes/apis/MCAPI.class.php');
			// plugins_url('../includes/gfx/',__FILE__);
			
			
			/*
				Empty vars declaration
			*/
			$output = $hgr_mc_apikey = $hgr_mc_listid = $hgr_mc_enable_disclaimer = $hgr_mc_collect_name = $hgr_mc_collect_lastname = 
			$hgr_mc_collect_inputbgcolor = $hgr_mc_collect_inputstextcolor = $hgr_mc_collect_btnbgcolor = $hgr_mc_collect_btntextcolor = 
			$hgr_mc_collect_nstextcolor = $extra_class = $inputs_style = $submit_style = $texts_style = $css = '';

			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'hgr_mc_apikey'						=>	'',
				'hgr_mc_listid'						=>	'',
				'hgr_mc_enable_disclaimer'			=>	'',
				'hgr_mc_collect_name'				=>	'',
				'hgr_mc_collect_lastname'			=>	'',
				'hgr_mc_collect_inputbgcolor'		=>	'',
				'hgr_mc_collect_inputstextcolor'	=>	'',
				'hgr_mc_collect_btnbgcolor'			=>	'',
				'hgr_mc_collect_btntextcolor'		=>	'',
				'hgr_mc_collect_nstextcolor'		=>	'',
				'extra_class'						=>	'',
				'css'								=>	'',
			), $atts));
			
			if( empty($hgr_mc_apikey) ) {return 'Please insert your MailChimp API Key!';}	
			if( empty($hgr_mc_listid) ) {return 'Please insert your MailChimp list ID!';}
			
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			/*
				Text inputs color & background color
			*/
			if(!empty($hgr_mc_collect_inputbgcolor)) {
				$inputs_style .= ' background-color:'.$hgr_mc_collect_inputbgcolor.'; ';
			}
			if(!empty($hgr_mc_collect_inputstextcolor)) {
				$inputs_style .= ' color:'.$hgr_mc_collect_inputstextcolor.'; ';
			}
			/*
				Submit btn color and text color
			*/
			if(!empty($hgr_mc_collect_btnbgcolor)) {
				$submit_style .= ' background-color:'.$hgr_mc_collect_btnbgcolor.'; ';
			}
			if(!empty($hgr_mc_collect_btntextcolor)) {
				$submit_style .= ' color:'.$hgr_mc_collect_btntextcolor.'; ';
			}
			/*
				No-spam and response text color
			*/
			if(!empty($hgr_mc_collect_nstextcolor)) {
				$texts_style .= ' color:'.$hgr_mc_collect_nstextcolor.'; ';
			}
			
			if(isset($_GET['submit'])) {
				
				$hgr_mc_name = ( isset($_GET['hgr_mc_name']) && !empty($_GET['hgr_mc_name']) ? strip_tags($_GET['hgr_mc_name']) : 'No name');
				$hgr_mc_lastname = ( isset($_GET['hgr_mc_lastname']) && !empty($_GET['hgr_mc_lastname']) ? strip_tags($_GET['hgr_mc_lastname']) : 'No last name');
			
				$mc_response = $this->storeAddress($hgr_mc_apikey, $hgr_mc_listid, $hgr_mc_name, $hgr_mc_lastname );
				
				
			
				$output .= '<!-- Begin MailChimp Signup Form -->
					<div class="hgr_mc_collector '.$extra_class.' ' . esc_attr( $css_class ) . '">
						<form id="hgr_mc_signup_'.$hgr_mc_listid.'" action="#" method="get">	  
							<span id="hgr_mc_response" class="hgr_mc_response" style="'.$texts_style.'">'.$mc_response.'</span>
							'.($hgr_mc_collect_name == 'yes' ? '<input type="text" name="hgr_mc_name" id="hgr_mc_name" class="hgr_mc_name" placeholder="'.__("Your name", 'hgrextender').'" style="'.$inputs_style.'" />' : '<input type="hidden" name="hgr_mc_name" id="hgr_mc_name" class="hgr_mc_name" value="" style="'.$inputs_style.'" />').'
							'.($hgr_mc_collect_lastname == 'yes' ? '<input type="text" name="hgr_mc_lastname" id="hgr_mc_lastname" class="hgr_mc_lastname" placeholder="'.__("Your last name", 'hgrextender').'" style="'.$inputs_style.'" />' : '<input type="hidden" name="hgr_mc_lastname" id="hgr_mc_lastname" class="hgr_mc_lastname" value="" />').'
							<input type="text" name="hgr_mc_email" id="hgr_mc_email" class="hgr_mc_email" placeholder="'.__("Email Address", 'hgrextender').'" style="'.$inputs_style.'" />
							<input type="submit" name="submit" value="'.__("Join",'hgrextender').'" class="hgr_mc_btn" style="'.$submit_style.'" />
							'.($hgr_mc_enable_disclaimer == 'yes' ? '<div class="hgr_mc_no_spam" style="'.$texts_style.'">'.__('We\'ll never spam or give this address away','hgrextender').'</div>' :'').'
						</form>
					</div>
					<!--End mc_embed_signup-->';
			}
			else{
				$output .= '<!-- Begin MailChimp Signup Form -->
				<div class="hgr_mc_collector '.$extra_class.' ' . esc_attr( $css_class ) . '">
					<form id="hgr_mc_signup_'.$hgr_mc_listid.'" action="#" method="get">	  
						'.($hgr_mc_collect_name == 'yes' ? '<input type="text" name="hgr_mc_name" id="hgr_mc_name" class="hgr_mc_name" placeholder="'.__("Your name", 'hgrextender').'" style="'.$inputs_style.'" />' : '<input type="hidden" name="hgr_mc_name" id="hgr_mc_name" class="hgr_mc_name" value="" style="'.$inputs_style.'" />').'
						'.($hgr_mc_collect_lastname == 'yes' ? '<input type="text" name="hgr_mc_lastname" id="hgr_mc_lastname" class="hgr_mc_lastname" placeholder="'.__("Your last name", 'hgrextender').'" style="'.$inputs_style.'" />' : '<input type="hidden" name="hgr_mc_lastname" id="hgr_mc_lastname" class="hgr_mc_lastname" value="" />').'
						<input type="text" name="hgr_mc_email" id="hgr_mc_email" class="hgr_mc_email" placeholder="'.__("Email Address", 'hgrextender').'" style="'.$inputs_style.'" />
						<input type="submit" name="submit" value="'.__("Join",'hgrextender').'" class="hgr_mc_btn" style="'.$submit_style.'" />
						'.($hgr_mc_enable_disclaimer == 'yes' ? '<div class="hgr_mc_no_spam" style="'.$texts_style.'">'.__('We\'ll never spam or give this address away','hgrextender').'</div>' :'').'
					</form>
				</div>
				<!--End mc_embed_signup-->';
			}
			return $output;
		}
		
		function storeAddress($your_apikey, $my_list_unique_id, $name, $surname){
		
		/*
			Validation
		*/
		if( !isset($_GET['hgr_mc_email']) ){ return "No email address provided"; } 
	
		if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $_GET['hgr_mc_email'])) {
			return "Email address is invalid"; 
		}
	
		/*
			Grab an API Key from http://admin.mailchimp.com/account/api/
		*/
		$api = new MCAPI($your_apikey);
		
		/*
			Grab your List's Unique Id by going to http://admin.mailchimp.com/lists/
			Click the "settings" link for the list - the Unique Id is at the bottom of that page.
		*/ 
		
		$merge_vars = array('FNAME'=>$name, 'LNAME'=>$surname);
		
		/*
			Return the succes or error message
		*/
		if($api->listSubscribe($my_list_unique_id, strip_tags($_GET['hgr_mc_email']), $merge_vars) === true) {
			/*
				It worked!
			*/
			return esc_html__("Success! Check your email to confirm sign up.", "hgrextender");
		}else{
			/*
				An error ocurred, return error message	
			*/
			return esc_html__("Error: %s", $api->errorMessage, "hgrextender");
		}
		
	}
	}
	new HGR_VC_MCHIMP_COLLECTOR;
}
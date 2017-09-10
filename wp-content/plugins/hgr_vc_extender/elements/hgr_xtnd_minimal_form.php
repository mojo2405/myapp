<?php
/*
* Add-on Name: Minimal Form
* Add-on URI: http://highgradelab.com/plugins/highgrade-extender/
* Since: 1.1
* Add-on Author: Bogdan COSTESCU
*/
if(!class_exists('HGR_VC_MINIMALFORM')) {
	class HGR_VC_MINIMALFORM extends WPBakeryShortCodesContainer {
		
		function __construct() {
		add_action('admin_init', array($this, 'hgr_minimalform_init'));
		
		add_shortcode( 'hgr_minimal_form', array($this, 'hgr_minimal_form'));
		
		add_shortcode( 'hgr_minimal_input', array($this, 'hgr_minimal_input'));
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
		function hgr_minimalform_init() {
			if(function_exists('vc_map')) {
				/*
					parent element
				*/
				vc_map(
					array(
					   "name"						=>	__("HGR MinimalForm", "hgrextender"),
					   "base"						=>	"hgr_minimal_form",
					   "class"						=>	"",
					   "icon"						=>	"hgr_minimal_form",
					   "category"					=>	__("HighGrade Extender", "hgrextender"),
					   "as_parent"					=>	array("only" =>	"hgr_minimal_input"),
					   "description"				=>	__("Minimal Form with advanced settings", "hgrextender"),
					   "content_element"			=>	true,
					   "show_settings_on_create"	=>	true,
					   "params"					=>	array(
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Form size settings:", "hgrextender"),
								"param_name"	=>	"form_size",
								"value"			=>	array(
										"Large"				=>	"large",
										"Medium"			=>	"medium",
										"Small"			 	=>	"small",
									),
								"description"	=>	__("Choose from our 3 preset values.", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Form style settings:", "hgrextender"),
								"param_name"	=>	"form_style",
								"value"			=>	array(
										"Standard"				=>	"standard",
										"Advanced"				=>	"advanced",
									),
								"description"	=>	__("Choose customization settings.", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Label text size:", "hgrextender"),
								"param_name"	=>	"label_text_size",
								"value"			=>	'',
								"min"			=>	8,
								"max"			=>	80,
								"suffix"		=>	"px",
								"description"	=>	__("Set label text size in pixels.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"form_style",
									"value"		=>	array( "advanced" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Label text color:", "hgrextender"),
								"param_name"	=>	"label_text_color",
								"value"			=>	"",
								"description"	=>	__("Set label text color.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"form_style",
									"value"		=>	array( "advanced" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Input text color:", "hgrextender"),
								"param_name"	=>	"input_text_color",
								"value"			=>	"",
								"description"	=>	__("Set input text color.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"form_style",
									"value"		=>	array( "advanced" )
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Next icon color:", "hgrextender"),
								"param_name"	=>	"next_icon_color",
								"value"			=>	"",
								"description"	=>	__("Set next icon color.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"form_style",
									"value"		=>	array( "advanced" ),
								),
								"save_always" 	=>	true,
							),
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Confirmation text:","hgrextender"),
								 "param_name"	=>	"confirmation_text",
								 "value"		=>	"Form has been submitted. Thank you for your time!",
								 "description"	=>	__("Thank you message after the form is submitted.","hgrextender"),
								 "save_always" 	=>	true,
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Confirmation text size:", "hgrextender"),
								"param_name"	=>	"confirmation_text_size",
								"value"			=>	'',
								"min"			=>	8,
								"max"			=>	80,
								"suffix"		=>	"px",
								"description"	=>	__("Set confirmation text size in pixels.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"form_style",
									"value"		=>	array( "advanced" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Confirmation text color:", "hgrextender"),
								"param_name"	=>	"confirmation_text_color",
								"value"			=>	"",
								"description"	=>	__("Set confirmation text color.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"form_style",
									"value"		=>	array( "advanced" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Steps text color:", "hgrextender"),
								"param_name"	=>	"steps_text_color",
								"value"			=>	"",
								"description"	=>	__("Set steps text color.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"form_style",
									"value"		=>	array( "advanced" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Form input background color:", "hgrextender"),
								"param_name"	=>	"form_input_color",
								"value"			=>	"",
								"description"	=>	__("Set color for input background.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"form_style",
									"value"		=>	array( "advanced" ),
								),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Progress bar background color:", "hgrextender"),
								"param_name"	=>	"progress_bar_bgcolor",
								"value"			=>	"",
								"description"	=>	__("Set the background color for progress bar.", "hgrextender"),
								"dependency"	=>	array(
									"element"	=>	"form_style",
									"value"		=>	array( "advanced" ),
								),
								"save_always" 	=>	true,
							),
							array(
								'type' => 'css_editor',
								'heading' => __( 'Css', 'hgrextender' ),
								'param_name' => 'css',
								'group' => __( 'Design options', 'hgrextender' ),
							),
						),
					"js_view"	=>	"VcColumnView"
				));
				
				
				/*
					Child element
				*/
				vc_map(
					array(
					   "name"				=>	__("Input field", "hgrextender"),
					   "holder"			=>	"div",
					   "base"				=>	"hgr_minimal_input",
					   "class"				=>	"",
					   "icon"				=>	"",
					   "content_element"	=>	true,
					   "as_child"			=>	array("only" =>	"hgr_minimal_form"),
					   "params"			=>	array(
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Label text:", "hgrextender"),
								"param_name"	=>	"label_text",
								"admin_label" 	=> 	true,
								"value"			=>	"",
								"description"	=>	__("Set a label text (eg. First name, Address, Telephone).", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Input type","hgrextender"),
								"param_name"	=>	"input_type",
								"value"			=>	array(
										"Text"		=>	"text",
										"E-mail"	=>	"e-mail",
										"Telephone"	=>	"telephone",
									),
								"description"	=>	__("Select input type. This will verify submitted data.", "hgrextender"),
								"save_always" 	=>	true,
							),
					   )
					) 
				);
			}
		}
		
		function send_AJAX_mail_before_submit() {
			//$email_param = WPBMap::getParam('hgr_minimal_form', 'email_form');
			
			$to = get_option('admin_email');
			$form_fields = $_POST['whatever'];
			
			$subject = 'E-mail sent through Minimal Form on '.get_site_url();
			$message = 'Got this response from a visitor through Minimal Form on your site:'."\r\n \r\n";
			
			foreach($form_fields as $key => $value){
				$message .= $key.': '.$value."\r\n";
			}
			
			check_ajax_referer('my_email_ajax_nonce');
			if (isset($_POST['action']) && $_POST['action'] == "mail_before_submit") {
				// send email  
				wp_mail( $to, $subject, $message, $headers, $attachments );
			}
		}
		
		function hgr_minimal_form($atts, $content = null ) {
			
			/*
				Include required scripts
			*/
			wp_enqueue_script('hgr-vc-modernizr');
			wp_enqueue_script('hgr-vc-classie');
			wp_enqueue_script('hgr-vc-stepsform');
			
			
			/*
				Empty vars declaration
			*/
			$output = $form_size = $form_style = $form_size_class = $label_text_size = $label_text_color = $input_text_color = $next_icon_color = $confirmation_text = $confirmation_text_size = $confirmation_text_color = $steps_text_color = $form_input_color = $progress_bar_bgcolor = $email_form = $confirmation_text_style = $progress_bar_style = $steps_text_style = $next_icon_style = $label_text_style = $input_text_style = $form_input_style = $hgr_minimal_sendmail = $css = '';
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'form_size'						=>	'',
				'form_style'						=>	'',
				'label_text_size'				=>	'',
				'label_text_color'				=>	'',
				'input_text_color'				=>	'',
				'next_icon_color'				=>	'',
				'confirmation_text'				=>	'',
				'confirmation_text_size'		=>	'',
				'confirmation_text_color'		=>	'',
				'steps_text_color'				=>	'',
				'form_input_color'				=>	'',
				'progress_bar_bgcolor'			=>	'',
				'email_form'						=>	'',
				'css'							=>	'',
			), $atts));
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			switch($form_size){
				case 'large':
					$form_size_class = 'simform-large';
				break;
				
				case 'medium':
					$form_size_class = 'simform-medium';
				break;
				
				case 'small':
					$form_size_class = 'simform-small';
				break;
			}
			
			switch($form_style){
				case 'standard':
					$confirmation_text_style = '';
					$progress_bar_style = '';
					$steps_text_style = '';
					$next_icon_style = '';
					$label_text_style = '';
					$input_text_style = '';
					$form_input_style = 'rgba(0,0,0,0.1)';
				break;
				
				case 'advanced':					
					$confirmation_text_style = 'style="'.($confirmation_text_size !== '' ? 'font-size:'.$confirmation_text_size.'px;' : '').''.($confirmation_text_color !== '' ? 'color:'.$confirmation_text_color.';' : '').'"';
					$progress_bar_style = 'style="'.($progress_bar_bgcolor !== '' ? 'background:'.$progress_bar_bgcolor : '').'"';
					$steps_text_style = 'style="'.($steps_text_color !== '' ? 'color:'.$steps_text_color : '').'"';
					$next_icon_style = 'style="'.($next_icon_color !== '' ? 'color:'.$next_icon_color : '').'"';
					$label_text_style = 'style="'.($label_text_size !== '' ? 'font-size:'.$label_text_size.'px;' : '').''.($label_text_color !== '' ? 'color:'.$label_text_color.';' : '').'"';
					$input_text_style = 'style="'.($input_text_color !== '' ? 'color:'.$input_text_color : '').'"';
					$form_input_style = ($form_input_color !== '' ? $form_input_color : 'rgba(0,0,0,0.1)');
				break;
			}
			
			
			
			$GLOBALS['hgr_label_style'] = $label_text_style;
			$GLOBALS['hgr_input_text_style'] = $input_text_style;
			$GLOBALS['hgr_minimal_sendmail'] = $email_form;
			
			
			
			$output .= '<script>
				jQuery( document ).ready(function() {
					//Add form size class
					jQuery("#theForm").addClass("'.$form_size_class.'");
					
					//Add form background color
					jQuery("head").append("<style>.hgr-minimal-form .simform ol:before{background:'.$form_input_style.';}</style>");
					
					var theForm = document.getElementById( "theForm" );
					new stepsForm( theForm, {
						onSubmit : function( form ) {
							classie.addClass( theForm.querySelector( ".simform-inner" ), "hide" );
							var messageEl = theForm.querySelector( ".final-message" );
							messageEl.innerHTML = "'.$confirmation_text.'";
							classie.addClass( messageEl, "show" );
						}
					} );
					
					// Submits the form
					stepsForm.prototype._submit = function() {
						// get all the inputs into an array.
						var $inputs = jQuery("#theForm :input");

						var values = {};
						$inputs.each(function() {
							if( jQuery(this).val() != "" ) {
								values[jQuery(this).attr("data-question")] = jQuery(this).val();
							}
						});

						// send email
						var data = {
							action: "mail_before_submit",
							whatever: values,
							_ajax_nonce: "'.wp_create_nonce( "my_email_ajax_nonce" ).'"
						};

						jQuery.post("'. get_bloginfo("url").'/wp-admin/admin-ajax.php", data);
						
						// show confirmation text
						this.options.onSubmit( this.el );
					}
				});
			</script>';
			
				$output .= '<div class="hgr-minimal-form ' . esc_attr( $css_class ) . '">';
					$output .= '<form id="theForm" class="simform" autocomplete="off">';
						$output .= '<div class="simform-inner">';
							$output .= '<ol class="questions">';
								$output .= do_shortcode($content);
							$output .= '</ol><!-- /questions -->';
							$output .= '<button class="submit" type="submit">Send answers</button>';
							$output .= '<div class="controls" '.$progress_bar_style.'>';
								$output .= '<button class="hgr-next-button" '.$next_icon_style.'></button>';
								$output .= '<div class="progress"></div>';
								$output .= '<span class="number" '.$steps_text_style.'>';
									$output .= '<span class="number-current"></span>';
									$output .= '<span class="number-total"></span>';
								$output .= '</span>';
								$output .= '<span class="error-message"></span>';
							$output .= '</div><!-- / controls -->';
						$output .= '</div><!-- /simform-inner -->';
						$output .= '<span class="final-message" '.$confirmation_text_style.'></span>';
					$output .= '</form><!-- /simform -->';
				$output .= '</div>';
			
			/*
				Return the output
			*/
			return $output;
		}
		
		function hgr_minimal_input($atts,$content = null) {
			
			
			/*
				Empty vars declaration
			*/
			$output = $label_text = $input_type = $input_type_front = $hgr_question_id = $input_validate = '';
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'label_text'			=>	'',
				'input_type'			=>	''
			), $atts));
			
			/*
				Shortcode content output
			*/
			switch($input_type){
				case 'text':
					$input_type_front = 'text';
					$input_validate = 'data-validate="none"';
				break;
				
				case 'e-mail':
					$input_type_front = 'email';
					$input_validate = 'data-validate="email"';
				break;
				
				case 'telephone':
					$input_type_front = 'tel';
					$input_validate = 'data-validate="none"';
				break;
			}
			
			$hgr_question_id = "q-".uniqid();

			$output .= '<li>';
				$output .= '<span><label for="'.$hgr_question_id.'"><h2 '.$GLOBALS["hgr_label_style"].'>'.$label_text.'</h2></label></span>';
				$output .= '<input id="'.$hgr_question_id.'" name="'.$hgr_question_id.'" type="'.$input_type_front.'" '.$GLOBALS["hgr_input_text_style"].' '.$input_validate.' data-question="'.$label_text.'"/>';
			$output .= '</li>';
			
			/*
				Return the output
			*/
			return $output;
		}
	}
	new HGR_VC_MINIMALFORM;
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_hgr_minimal_form extends WPBakeryShortCodesContainer {
	}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_hgr_minimal_input extends WPBakeryShortCode {
	}
}
<?php
/*
* Add-on Name: Team Pack
* Add-on URI: http://highgradelab.com/plugins/highgrade-extender/
* Since: 1.0
* Author: Eugen Petcu
* Update & Bug fixes: Bogdan Costescu
*/
if(!class_exists('HGR_VC_TEAM')) {
	class HGR_VC_TEAM extends WPBakeryShortCode {
		var $team_nav_color;
		var $team_nav_min_height;
		
		function __construct() {
			add_action('admin_init', array($this, 'add_team'));
			
			add_shortcode( 'hgr_team', array($this, 'hgr_team') );
			
			add_shortcode( 'hgr_team_member', array($this, 'hgr_team_member') );
		}
		
		/*
			Visual Composer mapping function
			Public API
			Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
			Example:		http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*/	
		function add_team() {
			if(function_exists('vc_map')) {
				/*
					parent element
				*/
				vc_map(
					array(
					   "name"						=>	__("Team", "hgrextender"),
					   "base"						=>	"hgr_team",
					   "class"						=>	"",
					   "icon"						=>	"hgr_team",
					   "category"					=>	__("HighGrade Extender", "hgrextender"),
					   "as_parent"					=>	array( "only" => "hgr_team_member" ),
					   "description"				=>	__("Team block", "hgrextender"),
					   "content_element"			=>	true,
					   "show_settings_on_create"	=>	true,
					   "deprecated"					=>	'4.5',
					   "params"						=>	array(
							array(
								"type"				=>	"colorpicker",
								"class"				=>	"",
								"heading"			=>	__("Team nav bar color:", "hgrextender"),
								"param_name"		=>	"team_nav_color",
								"value"				=>	"#e2e1dc",
								"dependency"		=>	array( 
										"not_empty"=>	true 
									),
								"save_always" 	=>	true,
							),
							array(
								"type"				=>	"colorpicker",
								"class"				=>	"",
								"heading"			=>	__("Team dominant color:", "hgrextender"),
								"param_name"		=>	"team_dominant_color",
								"value"				=>	"#80c8ac",
								"dependency"		=>	array(
										"not_empty"=>	true
									),
								"save_always" 	=>	true,
							),
							array(
								"type"				=>	"textfield",
								"class"				=>	"",
								"heading"			=>	__("Social icons size size (pixels)", "hgrextender"),
								"param_name"		=>	"hgr_team_iconsize",
								"value"				=>	"24",
								"save_always" 		=>	true,
							),
							array(
								"type"				=>	"checkbox",
								"heading"			=>	__("Contained team", "hgrextender"),
								"param_name"		=>	"hgr_team_contained",
								"description"		=>	__("If checked, team members will be contained, else, will be full page width. This does not apply to nav bar holding members names.", "hgrextender"),
								"value"				=>	array( esc_html__("Yes, please", "hgrextender") => "yes" ),
								"save_always" 		=>	true,
						    ),
							array(
								"type"				=>	"textfield",
								"class"				=>	"",
								"heading"			=>	__("Extra class", "hgrextender"),
								"param_name"		=>	"extra_class",
								"value"				=>	"",
								"description"		=>	__("Optional extra CSS class", "hgrextender"),
								"save_always" 		=>	true,
							),
							array(
								"type"				=>	"heading",
								"sub_heading"		=>	"This is a global setting page for the whole \"Team\" block. Add some \"Team Members\" in the container row to make it complete.",
								"param_name"		=>	"notification",
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
					   "name"				=>	__("Team Member", "hgrextender"),
					   "holder"			=>	"div",
					   "base"				=>	"hgr_team_member",
					   "class"				=>	"",
					   "icon"				=>	"",
					   "content_element"	=>	true,
					   "as_child"			=>	array( "only" => "hgr_team" ),
					   "params"			=>	array(
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Member name", "hgrextender"),
								"param_name"	=>	"member_name",
								"value"			=>	"",
								"description"	=>	__("Provide a team member name.", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Member position", "hgrextender"),
								"param_name"	=>	"member_position",
								"value"			=>	"",
								"description"	=>	__("Member position in company", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"attach_image",
								"class"			=>	"",
								"heading"		=>	__("Member image:", "hgrextender"),
								"param_name"	=>	"member_image",
								"admin_label"	=>	true,
								"value"			=>	"",
								"description"	=>	__("Upload member photo.", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Image style","hgrextender"),
								"param_name"	=>	"image_style",
								"value"			=>	array(
										"Full image"		=>	"img-full",
										"Circle image"		=>	"img-circle",
										"Rounded image"	=>	"img-rounded",
									),
								"description"	=>	__("For Circle or Rounded image we reccomend a square image of 265 pixels.", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textarea_html",
								"class"			=>	"",
								"heading"		=>	__("Member intro text", "hgrextender"),
								"param_name"	=>	"content",
								"value"			=>	"",
								"description"	=>	__("Description about this member", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Member skills", "hgrextender"),
								"param_name"	=>	"member_skills",
								"value"			=>	"",
								"description"	=>	__( "photoshop,80|wordpress,95|php,99", "hgrextender"),
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Dribbble", "hgrextender"),
								"param_name"	=>	"member_dribbble",
								"value"			=>	"",
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Twitter", "hgrextender"),
								"param_name"	=>	"member_twitter",
								"value"			=>	"",
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Facebook", "hgrextender"),
								"param_name"	=>	"member_facebook",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Skype", "hgrextender"),
								"param_name"	=>	"member_skype",
								"value"			=>	 "",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("LinkedIN", "hgrextender"),
								"param_name"	=>	"member_linkedin",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Vimeo", "hgrextender"),
								"param_name"	=>	"member_vimeo",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Yahoo", "hgrextender"),
								"param_name"	=>	"member_yahoo",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Youtube", "hgrextender"),
								"param_name"	=>	"member_youtube",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Picasa", "hgrextender"),
								"param_name"	=>	"member_picasa",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("DeviantArt", "hgrextender"),
								"param_name"	=>	"member_deviantart",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Pinterest", "hgrextender"),
								"param_name"	=>	"member_pinterest",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("SoundCloud", "hgrextender"),
								"param_name"	=>	"member_soundcloud",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Behance", "hgrextender"),
								"param_name"	=>	"member_behance",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Instagram", "hgrextender"),
								"param_name"	=>	"member_instagram",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
							array(
								"type"			=>	"textfield",
								"class"			=>	"",
								"heading"		=>	__("Google Plus", "hgrextender"),
								"param_name"	=>	"member_googleplus",
								"value"			=>	"",
								"save_always" 	=>	true,
							),
					   )
					) 
				);
			}
		}
		
		function hgr_team($atts, $content = null ) {
			
			/*
				Include required scripts
			*/
			wp_enqueue_script('hgr-vc-jquery-appear');
			
			/*
				Empty vars declaration
			*/
			$output = $team_nav_color = $team_nav_min_height = $team_nav_min_height = $hgr_team_contained = $extra_class = $css = '';
			$navs=array();
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'team_nav_color'		=>	'#e2e1dc',
				'team_dominant_color'	=>	'#80c8ac', 
				'team_nav_min_height'	=>	'80',
				'hgr_team_iconsize'	=>	'24',
				'hgr_team_contained'	=>	'',
				'extra_class'			=>	''
			), $atts));
			
			$GLOBALS['hgr_team_tdc'] = $team_dominant_color;
			$GLOBALS['hgr_team_iconsize'] = $hgr_team_iconsize;
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			/*
				Tab navigation
			*/
			preg_match_all( '/hgr_team_member member_name="([^\"]+)" member_position="([^\"]+)"{0,1}/i', $content, $matches, PREG_OFFSET_CAPTURE );
			$tab_titles = array();
			if ( isset($matches[0]) ) { $tab_titles = $matches[0]; }
			$tabs_nav = '';
			$tabs_nav .= '<ul class="nav nav-tabs" id="teamTab">';
			
			foreach ( $tab_titles as $tab ) {
				preg_match('/hgr_team_member member_name="([^\"]+)" member_position="([^\"]+)"{0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
				if(isset($tab_matches[1][0])) {
					$tabs_nav .= '<li><a href="#tab-'. (isset($tab_matches[3][0]) ? strtolower(str_replace(' ','',$tab_matches[3][0])) : strtolower(str_replace(' ','', $tab_matches[1][0] )) ) .'" data-toggle="tab">' . $tab_matches[1][0] . '</a> <small>' . $tab_matches[2][0] . '</small></li>';
				}
			}
			$tabs_nav .= '</ul>'."\n";
			
			
			$output .= '<div class="hgr_team_wrap '.(!empty($extra_class) ? $extra_class : '').' ' . esc_attr( $css_class ) . '">';
				$output .= '<div class="'.($hgr_team_contained == 'yes' ? 'container': '').' hgr_team_members tab-content">';
						$output .= do_shortcode($content);
				$output .= '</div>';
					$output .='<div class="team_nav" style="background-color:'.$team_nav_color.'; min-height:'.$team_nav_min_height.'px;">';
					if($hgr_team_contained == 'yes'){ $output .='<div class="container">'; }
							$output .= $tabs_nav;
					if($hgr_team_contained == 'yes'){ $output .='</div>'; }
					$output .='</div>';
			$output .= '</div>';
			
			$output .='<script type="text/javascript">
						jQuery(document).ready(function() {
							
							// Tabs navigation next prev
							var $tabs = jQuery("#teamTab li");
							jQuery(".team_left").on("click", function() {
								$tabs.filter(".active").prev("li").find("a[data-toggle=\"tab\"]").tab("show");
							});
							jQuery(".team_right").on("click", function() {
								$tabs.filter(".active").next("li").find("a[data-toggle=\"tab\"]").tab("show");
							});	
							
							// reset bars before tab shown
							jQuery("#teamTab a[data-toggle=\"tab\"]").on("show.bs.tab", function (e) {
							  jQuery(e.target).each(function() {
								 jQuery(".skillfill").each(function() {
									var fill = jQuery(this).attr("data-value");
									jQuery(this).animate({
										"width": "0%"
									}, 1, function() {
									});
									jQuery(this).css("overflow","visible");
									jQuery(this).css("background-color","'.$team_dominant_color.'");
								});
							  });
							});
							
							// on tab shown, animate the bars
							jQuery("#teamTab a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
							  jQuery(e.target).each(function() {
								 jQuery(".skillfill").each(function() {
									var fill = jQuery(this).attr("data-value");					
									jQuery(this).animate({
										width: fill+"%"
									}, { duration: 1500, queue: false });
								});
							  });
							});
							
							if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
								jQuery("#teamTab a:first").tab("show");
								jQuery(".hgr_team_members div:first").addClass("in").addClass("active");
								jQuery(".hgr_team_members div:first").addClass("in").addClass("active");
								
								jQuery(".skillfill").each(function() {
									var fill = jQuery(this).attr("data-value");					
									jQuery(this).animate({
										width: fill+"%"
									}, { duration: 1500, queue: false });
								});
								
							} else {			
								jQuery("#teamTab a:first").appear(function() {
									jQuery(this).tab("show");
									jQuery(".hgr_team_members div:first").addClass("in").addClass("active");
									jQuery(".hgr_team_members div:first").addClass("in").addClass("active");
								});
							}

						});
						</script>';
			/*
				Return the output
			*/
			return $output;
		}
		
		function hgr_team_member($atts,$content = null) {
			
			
			/*
				Empty vars declaration
			*/
			$output = $hgr_tm_img_style = '';
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'member_name'			=>	'',
				'member_position'		=>	'',
				'member_image'			=>	'',
				'image_style'			=>	'',
				'member_skills'		=>	'',
				'member_dribbble'		=>	'',
				'member_twitter'		=>	'',
				'member_facebook'		=>	'',
				'member_skype'			=>	'',
				'member_linkedin'		=>	'',
				'member_vimeo'			=>	'',
				'member_yahoo'			=>	'',
				'member_youtube'		=>	'',
				'member_picasa'		=>	'',
				'member_deviantart'	=>	'',
				'member_pinterest'		=>	'',
				'member_soundcloud'	=>	'',
				'member_behance'		=>	'',
				'member_instagram'		=>	'',
				'member_googleplus'	=>	'',
			), $atts));
			
			/*
				Team member image
			*/
			$member_image_array = wpb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => $member_image, 'thumb_size' => 'full', 'class' => "" ) );

			$output .= '<div class="hgr_team_member tab-pane fade " id="tab-'.strtolower(str_replace(' ','',$member_name)).'">';
			
				switch($image_style){
					case 'img-full':
						$hgr_tm_img_style .='team_member_image';
					break;
					
					case 'img-rounded':
						$hgr_tm_img_style .='team_member_image_rounded';
					break;
					
					case 'img-circle':
						$hgr_tm_img_style .='team_member_image_circle';
					break;
				}
				$output .= '<div class="vc_col-sm-3 wpb_column column_container '.$hgr_tm_img_style.'">';				
				$output .= $member_image_array['thumbnail'];
				$output .= '</div>';
				$output .= '<div class="vc_col-sm-1 wpb_column column_container">&nbsp;</div>';
				$output .= '<div class="vc_col-sm-8 wpb_column column_container">';
					$output .= '<div class="team_nav_small"><div class="team_btn team_left" style="background-color: '.$GLOBALS["hgr_team_tdc"].';"><i class="icon fa fa-angle-left"></i></div> <div class="team_btn team_right" style="background: '.$GLOBALS["hgr_team_tdc"].'"><i class="icon fa fa-angle-right"></i></div> </div><div class="clearfix"></div>';
					$output .= '<h3>'.$member_name.'</h3>';
					$output .= '<small>'.$member_position.'</small>';
				$output .= '<div class="team_member_socials">';
					if($member_dribbble) { $output .= '<a href="'.$member_dribbble.'" style="color: '.$GLOBALS["hgr_team_tdc"].'" target="_blank"><i class="icon social-dribbble" style="font-size:'.$GLOBALS['hgr_team_iconsize'].'px!important;"></i></a>';}
					if($member_twitter) {$output .= '<a href="'.$member_twitter.'" style="color: '.$GLOBALS["hgr_team_tdc"].'" target="_blank"><i class="icon social-twitter" style="font-size:'.$GLOBALS['hgr_team_iconsize'].'px!important;"></i></a>';}
					if($member_facebook) {$output .= '<a href="'.$member_facebook.'" style="color: '.$GLOBALS["hgr_team_tdc"].'" target="_blank"><i class="icon social-facebook" style="font-size:'.$GLOBALS['hgr_team_iconsize'].'px!important;"></i></a>';}
					if($member_skype) {$output .= '<a href="'.$member_skype.'" style="color: '.$GLOBALS["hgr_team_tdc"].'" target="_blank"><i class="icon social-skype" style="font-size:'.$GLOBALS['hgr_team_iconsize'].'px!important;"></i></a>';}
					if($member_linkedin) {$output .= '<a href="'.$member_linkedin.'" style="color: '.$GLOBALS["hgr_team_tdc"].'" target="_blank"><i class="icon social-linkedin" style="font-size:'.$GLOBALS['hgr_team_iconsize'].'px!important;"></i></a>';}
					if($member_vimeo) {$output .= '<a href="'.$member_vimeo.'" style="color: '.$GLOBALS["hgr_team_tdc"].'" target="_blank"><i class="icon social-vimeo" style="font-size:'.$GLOBALS['hgr_team_iconsize'].'px!important;"></i></a>';}
					if($member_yahoo) {$output .= '<a href="'.$member_yahoo.'" style="color: '.$GLOBALS["hgr_team_tdc"].'" target="_blank"><i class="icon social-yahoo" style="font-size:'.$GLOBALS['hgr_team_iconsize'].'px!important;"></i></a>';}
					if($member_youtube) {$output .= '<a href="'.$member_youtube.'" style="color: '.$GLOBALS["hgr_team_tdc"].'" target="_blank"><i class="icon social-youtube" style="font-size:'.$GLOBALS['hgr_team_iconsize'].'px!important;"></i></a>';}
					if($member_picasa) {$output .= '<a href="'.$member_picasa.'" style="color: '.$GLOBALS["hgr_team_tdc"].'" target="_blank"><i class="icon social-picasa" style="font-size:'.$GLOBALS['hgr_team_iconsize'].'px!important;"></i></a>';}
					if($member_deviantart) {$output .= '<a href="'.$member_deviantart.'" style="color: '.$GLOBALS["hgr_team_tdc"].'" target="_blank"><i class="icon social-deviantart" style="font-size:'.$GLOBALS['hgr_team_iconsize'].'px!important;"></i></a>';}
					if($member_pinterest) {$output .= '<a href="'.$member_pinterest.'" style="color: '.$GLOBALS["hgr_team_tdc"].'" target="_blank"><i class="icon social-pinterest" style="font-size:'.$GLOBALS['hgr_team_iconsize'].'px!important;"></i></a>';}
					if($member_soundcloud) {$output .= '<a href="'.$member_soundcloud.'" style="color: '.$GLOBALS["hgr_team_tdc"].'" target="_blank"><i class="icon social-soundcloud" style="font-size:'.$GLOBALS['hgr_team_iconsize'].'px!important;"></i></a>';}
					if($member_behance) {$output .= '<a href="'.$member_behance.'" style="color: '.$GLOBALS["hgr_team_tdc"].'" target="_blank"><i class="icon social-behance" style="font-size:'.$GLOBALS['hgr_team_iconsize'].'px!important;"></i></a>';}
					if($member_instagram) {$output .= '<a href="'.$member_instagram.'" style="color: '.$GLOBALS["hgr_team_tdc"].'" target="_blank"><i class="icon social-instagram" style="font-size:'.$GLOBALS['hgr_team_iconsize'].'px!important;"></i></a>';}
					if($member_googleplus) {$output .= '<a href="'.$member_googleplus.'" style="color: '.$GLOBALS["hgr_team_tdc"].'" target="_blank"><i class="icon social-google-plus" style="font-size:'.$GLOBALS['hgr_team_iconsize'].'px!important;"></i></a>';}
				$output .='</div>';
				$output .= wpb_js_remove_wpautop($content, true);
					if(!empty($member_skills)) {
						$output .= '<div class="skills_pack">';
							$each_skill = explode('|',$member_skills);
							foreach($each_skill as $skill) {
								$output .= '<div class="hgr_skill">';
									$skill_parts = explode(',', $skill, 2);
									// output each skill
									$output .= '<h4>'.strtoupper($skill_parts[0]).'</h4>';
									$output .='';
									$output .= '<div class="hgr_skillfull"><span class="skillfill " data-value="'.$skill_parts[1].'"><span class="valuemarker">'.$skill_parts[1].'%</span></span></div>';
								$output .= '</div>';
							}
						$output .= '</div>';
					}
				$output .= '</div>';
			$output .= '<div class="clearfix"></div></div>';
			
			/*
				Return the output
			*/
			return $output;
		}
	}
	new HGR_VC_TEAM;
}
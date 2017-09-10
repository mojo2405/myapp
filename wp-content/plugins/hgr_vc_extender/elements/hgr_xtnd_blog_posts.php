<?php
/*
* Add-on Name: Blog POsts
* Add-on URI: http://highgradelab.com/plugins/highgrade-extender/
* Since: 1.0
* Author: Eugen Petcu
*/
if(!class_exists('HGR_VC_BLOGPOSTS')) {
	class HGR_VC_BLOGPOSTS extends WPBakeryShortCode {

		function __construct() {
			add_action('admin_init', array($this, 'hgr_posts_init'));
			add_shortcode( 'hgr_blog_posts', array($this, 'hgr_blog_posts') );
		}
		
		/*
			Visual Composer mapping function
			Public API
			Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
			Example:		http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*/
		function hgr_posts_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"				=>	__("HGR Blog Posts",'hgrextender'),
					   "holder"			=>	"div",
					   "base"				=>	"hgr_blog_posts",
					   "class"				=>	"",
					   "icon"				=>	"hgr_blog_posts",
					   "category"			=>	__("HighGrade Extender",'hgrextender'),
					   "description"		=>	__("Grid style blog posts.","hgrextender"),
					   "content_element"	=>	true,
					   "params"			=>	array(
								array(
									"type"			=>	"textfield",
									"class"			=>	"",
									"heading"		=>	__("How many posts to fetch?", "hgrextender"),
									"param_name"	=>	"posts_number",
									"value"			=>	"",
									"description"	=>	__("Enter the desired number of posts to fetch from blog. Recomended: 6", "hgrextender"),
									"save_always" 	=>	true,
								),
								array(
									"type"			=>	"textfield",
									"class"			=>	"",
									"heading"		=>	__("How many posts to display on a row?", "hgrextender"),
									"param_name"	=>	"posts_columns",
									"value"			=>	"",
									"description"	=>	__("Enter the desired number of posts to display on each row.", "hgrextender"),
									"save_always" 	=>	true,
								),
								array(
									"type"			=>	"dropdown",
									"class"			=>	"",
									"heading"		=>	__("Display order", "hgrextender"),
									"param_name"	=>	"display_order",
									"value"			=>	array(
										__( 'Image > Title > Text', 'hgrextender' ) => 'img_title_txt',
										__( 'Title > Text', 'hgrextender' ) => 'title_txt',
									),
									"save_always"	=>	true,
									"description"	=>	__("How to display posts", "hgrextender")
								),
								array(
									"type"			=>	"dropdown",
									"class"			=>	"",
									"heading"		=>	__("Order posts by", "hgrextender"),
									"param_name"	=>	"display_by",
									"value"			=>	array(
										__( 'Default', 'hgrextender' ) => 'none',
										__( 'ID', 'hgrextender' ) => 'ID',
										__( 'Title', 'hgrextender' ) => 'title',
										__( 'Name (post slug)', 'hgrextender' ) => 'name',
										__( 'Date', 'hgrextender' ) => 'date',
										__( 'Modified date', 'hgrextender' ) => 'modified',
										__( 'Number of comments', 'hgrextender' ) => 'comment_count',
										__( 'Random', 'hgrextender' ) => 'rand',
										
									),
									"save_always"	=>	true,
								),
								array(
									"type"			=>	"dropdown",
									"class"			=>	"",
									"heading"		=>	__("Order", "hgrextender"),
									"param_name"	=>	"order",
									"value"			=>	array(
										__( 'Ascending', 'hgrextender' ) => 'ASC',
										__( 'Descending', 'hgrextender' ) => 'DESC',
									),
									"save_always"	=>	true,
								),
								array(
									"type"			=>	"dropdown",
									"class"			=>	"",
									"heading"		=>	__("Blog post title size", "hgrextender"),
									"param_name"	=>	"blog_post_title_size",
									"value"			=>	array(
										__( 'H1', 'hgrextender' ) => 'h1',
										__( 'H2', 'hgrextender' ) => 'h2',
										__( 'H3', 'hgrextender' ) => 'h3',
										__( 'H4', 'hgrextender' ) => 'h4',
										__( 'H5', 'hgrextender' ) => 'h5',
										__( 'H6', 'hgrextender' ) => 'h6',
									),
									"save_always"	=>	true,
								),
								array(
									"type"			=>	"dropdown",
									"class"			=>	"",
									"heading"		=>	__("Blog post footer type", "hgrextender"),
									"param_name"	=>	"blogpost_footer",
									"value"			=>	array(
										__( 'Icon based', 'hgrextender' ) => 'iconbased',
										__( 'Compact', 'hgrextender' ) => 'compact',
										__( 'Simple', 'hgrextender' ) => 'simple',
									),
									"save_always"	=>	true,
								),
								array(
									"type"			=>	"colorpicker",
									"class"			=>	"hgr_left_floated",
									"heading"		=>	__("Footer background color:", "hgrextender"),
									"param_name"	=>	"footer_bg_color",
									"value"			=>	"",	
									"dependency"	=>	array(
										"element"		=>	"blogpost_footer",
										"value"			=>	array("compact")
									),
									"save_always" 	=>	true,				
								),
								array(
									"type"			=>	"colorpicker",
									"class"			=>	"",
									"heading"		=>	__("Footer border & separators color:", "hgrextender"),
									"param_name"	=>	"footer_sep_border_color",
									"value"			=>	"",	
									"dependency"	=>	array(
										"element"		=>	"blogpost_footer",
										"value"			=>	array("compact")
									),
									"save_always" 	=>	true,					
								),
								array(
									"type"			=>	"colorpicker",
									"class"			=>	"",
									"heading"		=>	__("Links color:", "hgrextender"),
									"param_name"	=>	"links_color",
									"value"			=>	"",
									"save_always" 	=>	true,
								),
								array(
									"type"			=>	"colorpicker",
									"class"			=>	"",
									"heading"		=>	__("Background color:", "hgrextender"),
									"param_name"	=>	"hgr_bg_color",
									"value"			=>	"",
									"save_always" 	=>	true,
								),
								array(
									"type"			=>	"textfield",
									"class"			=>	"",
									"heading"		=>	__("Extra class", "hgrextender"),
									"param_name"	=>	"extra_class",
									"value"			=>	"",
									"description"	=>	__("Extra CSS class for custom CSS", "hgrextender")	,
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
		
		function hgr_blog_posts ($atts) {
			/*
				 Empty vars declaration
			*/
			$output = $posts_number = $posts_columns = $display_order = $metas_separator = $meta_border = $display_by = $order = $links_color = $hgr_bg_color = $extra_class = $blogpost_footer = $footer_bg_color = $footer_sep_border_color = $css = '';
			$validPosts = array();
			$this_post = array();
			$id_pot = array();
			$i = 0;
			
			/*
				WordPress function to extract shortcodes attributes
				Refference: http://codex.wordpress.org/Function_Reference/shortcode_atts
			*/
			extract(shortcode_atts(array(
				'posts_number'			=>	'6', 
				'posts_columns'			=>	'3',
				'display_order'			=>	'img_title_txt',
				'display_by'				=>	'date',
				'order'					=>	'DESC',
				'blog_post_title_size'	=>	'h2',
				'links_color'			=>	'#1e73be',
				'hgr_bg_color'			=>	'',
				'extra_class'			=>	'',
				'blogpost_footer'		=>	'',
				'footer_bg_color'		=>	'',
				'footer_sep_border_color'=>	'',
				'css'					=>	''
			), $atts));
			
			$args = array(
				   'post_type'			=>	'post',
				   'posts_per_page'		=>	$posts_number,
				   'orderby'				=>	$display_by,
				   'order'				=>	$order,
				 );
			$hgr_query = new WP_Query($args);
			
			if( !empty($footer_sep_border_color) ){
				$metas_separator	=	' border-right:1px solid '.$footer_sep_border_color.'; ';
				$meta_border		=	' border:1px solid '.$footer_sep_border_color.'; ';
			}
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
			
			$uniqueID = "hgr_blog_posts_".mt_rand(999, 9999999);
			
			if( $hgr_query->have_posts()) {
				/*
					We add JS only if there are some posts to display
				*/
				wp_enqueue_script( 'isotope' );
				wp_enqueue_script('hgr-vc-tooltip');
				wp_enqueue_script('hgr-vc-blogposts');
				
				if( ! empty($hgr_bg_color) ) {
					$output .='<style>';
					$output .= '#' . $uniqueID . ' .hgr_blog_post {background-color:'.$hgr_bg_color.';}';
					$output .='</style>';
				}
				
				$output .='<div class="hgr_blog_posts ' . esc_attr( $css_class ) . '" id="'.$uniqueID.'" data-fetch="'.$posts_number.'" data-cols="'.$posts_columns.'">';
					
					while ( $hgr_query->have_posts() ) {
						
						$hgr_query->the_post();
						$output .='<div id="" class="hgr_blog_post '.(!empty($extra_class) ? $extra_class : '').'">';
							$src = wp_get_attachment_image_src( get_post_thumbnail_id(), array( 5600,1000 ), false, '' );
							$num_comments = get_comments_number(); // get_comments_number returns only a numeric value
							if ( $num_comments == 0 ) {
									$comments = esc_html__('No Comments');
							} elseif ( $num_comments > 1 ) {
									$comments = $num_comments . esc_html__(' Comments', 'hgrextender');
							} else {
									$comments = esc_html__('1 Comment', 'hgrextender');
							}
							$category = get_the_category();
							
							switch($display_order){
								case 'img_title_txt':
									if(!empty($src[0])) {
										$output .='<div class="hgr_post_image" style="margin-bottom:20px;">';
											$output .='<a href="'.get_permalink().'"><img src="'.$src[0].'" alt="'.get_the_title().'" title="'.get_the_title().'"></a>';
										$output .='</div>';
									}
									elseif( get_post_format() == "video"){
											$output .='<div class="hgr_post_image" style="margin-bottom:20px;">';
												$output .= HGR_XTND::hgr_xtnd_getPostContent();
											$output .='</div>';
										}
									
									$output .='<div class="hgr_post_content">';
										$output .='<'.$blog_post_title_size.'><a href="'.get_permalink().'" style="color:'.$links_color.';">'.get_the_title().'</a></'.$blog_post_title_size.'>';
										if( get_post_format() != "video"){
											$output .= HGR_XTND::hgr_xtnd_getPostContent();
										}
										
									$output .='</div>';
									
									if($blogpost_footer == 'iconbased') {
										$output .='<div class="hgr_post_metas" style="color:'.$links_color.';">';
											$output .='<div class="hgr_post_meta"><a href="' . get_permalink() . '" data-tooltip="'.get_the_time('M jS,  Y').'"><i class="icon fa fa-calendar"></i></a></div>';
											$output .='<div class="hgr_post_meta"><a href="' . get_the_author_link() . '" data-tooltip="'.__('Written by ', 'hgrextender').ucwords(get_the_author()).'"><i class="icon fa fa-user"></i></a></div>';
											$output .='<div class="hgr_post_meta"><a href="' . get_category_link($category[0]->term_id ) . '" style="color:'.$links_color.';" data-tooltip="'.__('Filled under ', 'hgrextender').$category[0]->cat_name.'"><i class="icon fa fa-folder"></i></a></div>';
											$output .='<div class="hgr_post_meta"><a href="' . get_comments_link() . '" style="color:'.$links_color.';" data-tooltip="'.$comments.'"><i class="icon fa fa-comments-o"></i></a></div>';
											$output .='<div class="hgr_post_meta"><a href="' . get_permalink() . '" style="color:'.$links_color.';" data-tooltip="'.__('Read more on ', 'hgrextender').get_the_title().'"><i class="icon fa fa-plus"></i></a></div>';
										$output .='</div>';
									}
									elseif($blogpost_footer == 'compact') {
										$output .='<div class="hgr_post_metas compact_metas" style="color:'.$links_color.';'.(!empty($footer_bg_color) ? 'background-color:'.$footer_bg_color.';' : '').' '.$meta_border.'">';
											if(is_sticky()){
												$output .='<div style="'.$metas_separator.'" class="hgr_post_meta"><a href="' . get_permalink() . '" data-tooltip="' . __('Sticky Post', 'hgrextender') . '"><i class="icon fa fa-bookmark"></i></a></div>';
											}
											elseif( get_post_format() == "audio"){
												$output .='<div style="'.$metas_separator.'" class="hgr_post_meta"><a href="' . get_permalink() . '" data-tooltip="' . __('Audio Post', 'hgrextender') . '"><i class="icon fa fa-music"></i></a></div>';
											}
											elseif( get_post_format() == "video"){
												$output .='<div style="'.$metas_separator.'" class="hgr_post_meta"><a href="' . get_permalink() . '" data-tooltip="' . __('Video Post', 'hgrextender') . '"><i class="icon fa fa-youtube-play"></i></a></div>';
											}
											elseif( get_post_format() == "quote"){
												$output .='<div style="'.$metas_separator.'" class="hgr_post_meta"><a href="' . get_permalink() . '" data-tooltip="' . __('Quote Post', 'hgrextender') . '"><i class="icon fa fa-quote-left"></i></a></div>';
											}
											else{
												$output .='<div style="'.$metas_separator.'" class="hgr_post_meta"><a href="' . get_permalink() . '" data-tooltip="' . __('Regular Post', 'hgrextender') . '"><i class="icon fa fa-align-left"></i></a></div>';
											}

											$output .='<div style="'.$metas_separator.'" class="hgr_post_meta"><a href="' . get_permalink() . '" data-tooltip="' . get_the_time('M jS,  Y') . '"><i class="icon fa fa-clock-o"></i> '.get_the_time('M jS').'</a></div>';
											$output .='<div style="'.$metas_separator.'" class="hgr_post_meta"><a href="' . get_the_author_link() . '" data-tooltip="'.__('Written by ', 'hgrextender').ucwords(get_the_author()).'"><i class="icon fa fa-user"></i></a></div>';
											$output .='<div style="'.$metas_separator.'" class="hgr_post_meta"><a href="'.get_category_link($category[0]->term_id ).'" style="color:'.$links_color.';" data-tooltip="'.__('Filled under ', 'hgrextender').$category[0]->cat_name.'"><i class="icon fa fa-folder"></i></a></div>';
											$output .='<div style="" class="hgr_post_meta"><a href="' . get_comments_link() .'" style="color:'.$links_color.';" data-tooltip="'.$comments.'"><i class="icon fa fa-comments-o"></i> '.$num_comments.'</a></div>';
										$output .='</div>';
									}
									else {
										$output .='<div class="hgr_post_metas_simple">';
											$output .='<div class="hgr_post_meta_simple">@ ' . HGR_XTND::hgr_xtnd_tes(get_the_time('M jS,  Y')) . esc_html__('by', 'hgrextender').' '.ucwords(get_the_author()).'</div>';
										$output .='</div>';
									}
								break;
								
								case 'title_txt':
									$output .='<div class="hgr_post_content">';
										$output .='<'.$blog_post_title_size.'><a href="'.get_permalink().'" style="color:'.$links_color.';">'.get_the_title().'</a></'.$blog_post_title_size.'>';
										$output .= HGR_XTND::hgr_xtnd_getPostContent();
									$output .='</div>';
									
									if($blogpost_footer == 'iconbased') {
										$output .='<div class="hgr_post_metas" style="color:'.$links_color.';">';
											$output .='<div class="hgr_post_meta" title="'.get_the_time('M jS,  Y').'" data-toggle="tooltip" data-placement="top"><i class="icon fa fa-calendar"></i></div>';
											$output .='<div class="hgr_post_meta" title="'.__('Written by ', 'hgrextender').ucwords(get_the_author()).'" data-toggle="tooltip" data-placement="top"><i class="icon fa fa-user"></i></div>';
											$output .='<div class="hgr_post_meta" title="'.__('Filled under ', 'hgrextender').$category[0]->cat_name.'" data-toggle="tooltip" data-placement="top"><a href="'.get_category_link($category[0]->term_id ).'" style="color:'.$links_color.';"><i class="icon fa fa-folder"></i></a></div>';
											$output .='<div class="hgr_post_meta" title="'.$comments.'"><a href="' . get_comments_link() .'" data-toggle="tooltip" data-placement="top" style="color:'.$links_color.';"><i class="icon fa fa-comments-o"></i></a></div>';
											$output .='<div class="hgr_post_meta" title="'.__('Read more on ', 'hgrextender').get_the_title().'" data-toggle="tooltip" data-placement="top"><a href="'.get_permalink().'" style="color:'.$links_color.';"><i class="icon fa fa-plus"></i></a></div>';
										$output .='</div>';
									}
									elseif($blogpost_footer == 'compact') {
										$output .='<div class="hgr_post_metas compact_metas" style="color:'.$links_color.';'.(!empty($footer_bg_color) ? 'background-color:'.$footer_bg_color.';' : '').' '.$meta_border.'">';
											if(is_sticky()){
												$output .='<div style="'.$metas_separator.'" class="hgr_post_meta" title="Sticky Post" data-toggle="tooltip" data-placement="right"><i class="icon fa fa-bookmark"></i></div>';
											}
											elseif( get_post_format() == "audio"){
												$output .='<div style="'.$metas_separator.'" class="hgr_post_meta" title="Audio Post" data-toggle="tooltip" data-placement="right"><i class="icon fa fa-music"></i></div>';
											}
											elseif( get_post_format() == "video"){
												$output .='<div style="'.$metas_separator.'" class="hgr_post_meta" title="Video Post" data-toggle="tooltip" data-placement="right"><i class="icon fa fa-youtube-play"></i></div>';
											}
											elseif( get_post_format() == "quote"){
												$output .='<div style="'.$metas_separator.'" class="hgr_post_meta" title="Quote Post" data-toggle="tooltip" data-placement="right"><i class="icon fa fa-quote-left"></i></div>';
											}
											else{
												$output .='<div style="'.$metas_separator.'" class="hgr_post_meta" title="Regular Post" data-toggle="tooltip" data-placement="right"><i class="icon fa fa-align-left"></i></div>';
											}

											$output .='<div style="'.$metas_separator.'" class="hgr_post_meta" title="'.get_the_time('M jS,  Y').'" data-toggle="tooltip" data-placement="top"><i class="icon fa fa-clock-o"></i> '.get_the_time('M jS').'</div>';
											$output .='<div style="'.$metas_separator.'" class="hgr_post_meta" title="'.__('Written by ', 'hgrextender').ucwords(get_the_author()).'" data-toggle="tooltip" data-placement="top"><i class="icon fa fa-user"></i></div>';
											$output .='<div style="'.$metas_separator.'" class="hgr_post_meta" title="'.__('Filled under ', 'hgrextender').$category[0]->cat_name.'" data-toggle="tooltip" data-placement="top"><a href="'.get_category_link($category[0]->term_id ).'" style="color:'.$links_color.';"><i class="icon fa fa-folder"></i></a></div>';
											$output .='<div style="" class="hgr_post_meta" title="'.$comments.'" data-toggle="tooltip" data-placement="left"><a href="' . get_comments_link() .'" style="color:'.$links_color.';"><i class="icon fa fa-comments-o"></i> '.$num_comments.'</a></div>';
										$output .='</div>';
									}
									else {
										$output .='<div class="hgr_post_metas_simple">';
											$output .='<div class="hgr_post_meta_simple">@ ' . HGR_XTND::hgr_xtnd_tes(get_the_time('M jS,  Y')) . esc_html__('by', 'hgrextender').' '.ucwords(get_the_author()).'</div>';
										$output .='</div>';
									}
								break;
							}
						$output .= '</div>';
					}
				$output .= '</div>';
			} else {
				$output .=	'<div class="hgr_blog_posts" data-fetch="'.$posts_number.'" data-cols="'.$posts_columns.'">';
				$output .=	'<p>'.__('No posts to display. Please add some blog posts!', 'hgrextender').'</p>';
				$output .=	'</div>';
			}
			wp_reset_postdata();						
			return $output;
		}
	}
	new HGR_VC_BLOGPOSTS;
}
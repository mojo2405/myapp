<?php
/**
 * Upshot Theme: Home page for site or blog
 * @package WordPress
 * @subpackage Upshot Theme
 * @since 1.0
 */
 
 	// Include framework options
 	$hgr_options = get_option( 'redux_options' );
 
 	// Get metaboxes values from database
 	$this_page_id 			=	esc_attr( get_option('page_for_posts') );
 	$hgr_page_color_scheme	=	esc_attr( get_post_meta( $this_page_id, '_hgr_page_color_scheme', true ) );

	get_header();
 ?>

<?php if( is_home() ) : ?>

		<?php if (get_header_image() != '') : ?>
        <!-- Header Image -->
        <div class="header_image_container"> <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php echo get_bloginfo('name'); ?>" class="header_image" />
          <div class="headerWelcome">
            <h1>
              <?php bloginfo('name'); ?>
            </h1>
            <h2><a href="#" class="readTheBlogBtn"><?php esc_attr( 'Read the blog', 'upshot' );?></a></h2>
          </div>
        </div>
        <!-- Header Image End -->
        <?php endif;?>

        <!-- blog content front-page.php -->
        <div class="row blogPosts <?php echo esc_attr( (isset($hgr_options['blog_color_scheme']) ? $hgr_options['blog_color_scheme'] : '') );?>" id="blogPosts">
          <div class="container"> 
            <!-- posts -->
            <div class="vc_col-md-9 vc_col-sm-12 vc_col-xs-12">
              <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
              <?php 
                $format = get_post_format();
              ?>
              <div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                <?php 
                    if ( has_post_thumbnail() ) {
                      the_post_thumbnail('full', array('class' => 'img-responsive'));
                    } 
                 ?>
                <?php if($format != 'aside') : ?>
                <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php esc_html_e('Permanent Link to', 'upshot');?> <?php the_title_attribute(); ?>">
                  <?php the_title(); ?>
                  </a></h1>
                <?php endif;?>
                <small> <span class="highlight"><i class="icon blog-date"></i>
                <?php the_time('F jS, Y') ?>
                </span> <span class="highlight"><i class="icon blog-user"></i>
                <?php esc_html_e('Posted by ', 'upshot');?>
                <?php the_author_posts_link() ?>
                </span> <span class="highlight"><i class="icon blog-category"></i>
                <?php the_category(', '); ?>
                </span> <span class="highlight"><i class="icon blog-comments"></i>
                <?php
                    $comments_number = get_comments_number();
                    if ( 1 === $comments_number ) {
                        /* translators: %s: post title */
                        printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'upshot' ), get_the_title() );
                    } else {
                        printf(
                            /* translators: 1: number of comments, 2: post title */
                            _nx(
                                '%1$s thought on &ldquo;%2$s&rdquo;',
                                '%1$s thoughts on &ldquo;%2$s&rdquo;',
                                $comments_number,
                                'comments title',
                                'upshot'
                            ),
                            number_format_i18n( $comments_number ),
                            get_the_title()
                        );
                    }
                ?>
                </span> </small>
                <div class="entry">
                  <?php if(has_excerpt()) : ?>
                  <?php the_excerpt(); ?>
                  <?php else : ?>
                  <?php the_content(); ?>
                  <?php endif;?>
                </div>
                <div class="entry-meta">
                  <?php the_tags(); ?>
                </div>
              </div>
              <?php endwhile; ?>
              
              	<?php
					$prev_link = get_previous_posts_link( esc_html__('&larr; Previous', 'upshot') );
					$next_link = get_next_posts_link( esc_html__('Next &rarr;', 'upshot') );
					if ($prev_link || $next_link) : ?>
					  <div class="navigation">
						<div class="alignleft">
						  <?php echo( !empty($prev_link) ? $prev_link : '' ); ?>
						</div>
						<div class="alignright">
						  <?php echo ( !empty($next_link) ? $next_link : ''); ?>
						</div>
					  </div>
				<?php endif;?>
      

       
              
              <?php else: ?>
              <p>
                <?php esc_html_e('Sorry, no posts matched your criteria.', 'upshot'); ?>
              </p>
              <?php endif; ?>
              <?php wp_reset_postdata();?>
            </div>
            <!-- / posts --> 
            
            <!-- sidebar -->
            <div class="vc_col-md-3 vc_col-sm-12 vc_col-xs-12">
              <?php 
                get_sidebar();
             ?>
            </div>
            <!-- / sidebar --> 
            <div class="clearfix"></div>
          </div>
        </div>
        <!-- blog content end -->

<?php else : ?>

<!-- Site home page -->

<?php
	$homePageID = get_the_ID();
 	$args = array(	'post_type'     => 'page',
					'posts_per_page'=> -1,
					'post_parent'   => $homePageID ,
					'post__not_in'	=> array($homePageID),
					'order'         => 'ASC',
					'orderby'       => 'menu_order'
				 );
 	$parent = new WP_Query( $args );
	
 ?>
<?php
	if ( $parent->have_posts() ) :
	$firstSection = 1; 
 ?>
<?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
<?php $page_template = str_replace('page-','',str_replace('.php','',basename( get_page_template() ))); ?>
<?php if($page_template && $page_template !='page') : ?>
<?php get_template_part( $page_template, get_post_format() ); ?>
<?php wp_reset_postdata(); ?>
<?php else : ?>
<?php get_template_part('loop'); ?>
<?php wp_reset_postdata(); ?>
<?php endif;?>
<?php $firstSection++;?>
<?php endwhile; ?>

<?php
	else :
?>

<div class="row blogPosts <?php echo esc_attr( (isset( $hgr_options['blog_color_scheme'] ) ? $hgr_options['blog_color_scheme'] : '') );?>" id="blogPosts">
  <div class="container"> 
    <!-- posts -->
    <div class="vc_col-md-9 vc_col-sm-12 vc_col-xs-12">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <div class="post">
        <?php 
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			  the_post_thumbnail('full', array('class' => 'img-responsive'));
			} 
		?>
        <!-- Display the Title as a link to the Post's permalink. -->
        <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php esc_html_e('Permanent Link to', 'upshot');?> <?php the_title_attribute(); ?>">
          <?php the_title(); ?>
          </a></h1>
        <small><span class="highlight"><i class="icon blog-date"></i>
        <?php the_time('F jS, Y') ?>
        </span> <span class="highlight"><i class="icon blog-user"></i><?php esc_html_e( 'Posted by', 'upshot' );?>
        <?php the_author_posts_link() ?>
        </span> <span class="highlight"><i class="icon blog-category"></i>
        <?php the_category(', '); ?>
        </span> <span class="highlight"><i class="icon blog-comments"></i>
        <?php
			$comments_number = get_comments_number();
			if ( 1 === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'upshot' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s thought on &ldquo;%2$s&rdquo;',
						'%1$s thoughts on &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'upshot'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
		?>
        </span></small> 
        <!-- Display the Post's content in a div box. -->
        <div class="entry">
          <?php if(has_excerpt()) : ?>
          <?php the_excerpt(); ?>
          <?php else : ?>
          <?php the_content(); ?>
          <?php endif;?>
        </div>
        <div class="entry-meta">
          <?php the_tags(); ?>
        </div> 
      </div>
      <!-- closes the first div box -->
      <?php endwhile; ?>

      <?php
			$prev_link = get_previous_posts_link( esc_html__('&larr; Previous', 'upshot') );
			$next_link = get_next_posts_link( esc_html__('Next &rarr;', 'upshot') );
			if ($prev_link || $next_link) : ?>
			  <div class="navigation">
				<div class="alignleft">
				  <?php echo( !empty($prev_link) ? $prev_link : '' ); ?>
				</div>
				<div class="alignright">
				  <?php echo ( !empty($next_link) ? $next_link : ''); ?>
				</div>
			  </div>
		<?php endif;?>

      <?php else: ?>
      <p>
        <?php esc_html_e('Sorry, no posts matched your criteria.', 'upshot'); ?>
      </p>
      <?php endif; ?>
    </div>
    <!-- / posts --> 
    
    <!-- sidebar -->
    <div class="vc_col-md-3 vc_col-sm-12 vc_col-xs-12">
      <?php 
		get_sidebar();
	 ?>
    </div>
    <!-- / sidebar -->
    <div class="clearfix"></div>
  </div>
</div>

<?php 
 	endif; 
	wp_reset_postdata(); 
 ?>
<!--/ Pages -->

<?php endif;?>
<?php 
 	get_footer();
 ?>

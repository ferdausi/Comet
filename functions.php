<?php

//-------------------------------------------------------------------------------
// Enqueue scripts and styles.
//-------------------------------------------------------------------------------

if ( ! function_exists( 'comet_scripts' ) ) :

add_action('wp_enqueue_scripts','comet_scripts');

function comet_scripts(){

    wp_enqueue_style( 'comet-fonts', comet_fonts_url(), array(), null );
    // Font Awesome Icons
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.1' );


    // Twitter BootStrap.
    wp_enqueue_style( 'bootstrap', get_template_directory_uri(). '/css/bootstrap.min.css', array(), '3.3.5' );


    //Comet Styles
    wp_enqueue_style('default-style',get_template_directory_uri(). '/css/style_blog.css');
    wp_enqueue_style('menu-style',get_template_directory_uri(). '/css/superfish.css');

    /** ====================================================================
     *  Loading JavaScripts
     * ====================================================================
     */


    // bootstrap
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.5', TRUE );


    // JS Plugin
    wp_enqueue_script( 'comet-script', get_template_directory_uri() . '/js/scripts.js', array(
        'jquery',
    ), NULL, TRUE );


}

endif;


if ( ! function_exists( 'comet_fonts_url' ) ):

    function comet_fonts_url()
    {
        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */

        if ('off' !== _x('on', 'Lato font: on or off', '')) {
            $fonts[] = 'Lora:400,700';
        }


        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urlencode(implode('|', $fonts)),
                'subset' => urlencode($subsets),
            ), 'https://fonts.googleapis.com/css');
        }

        return $fonts_url;
    }

    endif;





//-------------------------------------------------------------------------------
// Theme Support
//-------------------------------------------------------------------------------




add_action('init','comet_theme_setup');


function comet_theme_setup(){
    add_theme_support('menus');
    add_theme_support( 'post-thumbnails' );

    add_image_size( 'comet-blog-thumbnail', 850, 480, TRUE );


    register_nav_menu('primary','Primary Header navigation');


    //-------------------------------------------------------------------------------
    // Enable support for Post Formats.
    // See http://codex.wordpress.org/Post_Formats
    //-------------------------------------------------------------------------------
    add_theme_support( 'post-formats', apply_filters( 'comet_post_formats_theme_support', array(
        'status',
        'image',
        'audio',
        'video',
        'gallery',

    ) ) );


}





/*for deleting extra views in wp_head*/
function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_login_header');





//-------------------------------------------------------------------------------
// Register widget area.
// @link http://codex.wordpress.org/Function_Reference/register_sidebar
//-------------------------------------------------------------------------------
if ( ! function_exists( 'comet_widgets_init' ) ) :

    function comet_widgets_init() {

        do_action( 'comet_before_register_sidebar' );

        register_sidebar( apply_filters( 'comet_blog_sidebar', array(
            'name'          => esc_html__( 'Blog Sidebar', 'comet' ),
            'id'            => 'comet-blog-sidebar',
            'description'   => esc_html__( 'Appears in the blog sidebar.', 'comet' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h2 class="widget-title text-uppercase">',
            'after_title'   => '</h2>',
        ) ) );

        do_action( 'comet_after_register_sidebar' );

    }

    add_action( 'widgets_init', 'comet_widgets_init' );

endif;



//-------------------------------------------------------------------------------
// Pagination
//-------------------------------------------------------------------------------



if ( ! function_exists( 'comet_posts_pagination' ) ) :
    function comet_posts_pagination() {

        if ( $GLOBALS[ 'wp_query' ]->max_num_pages > 1 ) {
            $big   = 999999999; // need an unlikely integer
            $items = paginate_links( apply_filters( 'comet_posts_pagination_paginate_links', array(
                'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'    => '?paged=%#%',
                'prev_next' => TRUE,
                'current'   => max( 1, get_query_var( 'paged' ) ),
                'total'     => $GLOBALS[ 'wp_query' ]->max_num_pages,
                'type'      => 'array',
                'prev_text' => '<i class="fa  fa-chevron-left"></i>  ',
                'next_text' => '<i class="fa  fa-chevron-right"></i>  ',
                'end_size'  => 1,
                'mid_size'  => 1
            ) ) );

            $pagination = "<div class=\"pagination-wrap clearfix\"><ul class=\"pagination navigation\"><li>";
            $pagination .= join( "</li><li>", (array) $items );
            $pagination .= "</li></ul></div>";

            echo apply_filters( 'comet_posts_pagination', $pagination, $items, $GLOBALS[ 'wp_query' ] );
        }
    }
endif;





// Register custom navigation walker
require get_template_directory() . "/inc/class-comet-menu-walker.php";


//Excert more

function new_excerpt_more( $more ) {

    return '<div class="pull-right">
                 <a href = "'.get_permalink().'"> <button type = "button" class="btn btn-default text-uppercase" > Read more </button > </a >
             </div>';

}
add_filter( 'excerpt_more', 'new_excerpt_more' );





//
////Category widget
//require get_template_directory() . "/inc/widget/comet-category-widget.php";


//----------------------------------------------------------------------
/* Get comment form */
//----------------------------------------------------------------------
if ( ! function_exists( 'comet_comment_form' ) ) :

function comet_comment_form(){
	global $user_identity;
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	if ( comments_open() ) { ?>
		<div id="respond" class="section-contact-us">
        	<div class="comment-title text-uppercase">
            	<h4><?php comment_form_title(__('Leave A Comment', 'comet'), __('Leave A Comment', 'comet')); ?></h4>
        	</div>
            <div class="cancel-reply padding-left"><?php cancel_comment_reply_link(); ?></div>

			<form id="comment-form" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
        	
            <?php if ( is_user_logged_in() ) : ?>

			<div id="comment-input" >
			   <div class="row">
				<div class="col-md-12">
					<div id="comment-textarea" class="placeholding-input">

						<label for="comment" class="comment-placeholder placeholder"></label>
						<textarea placeholder="<?php esc_html_e('Text here', 'comet'); ?>" name="comment" id="comment" cols="60" rows="8" tabindex="5" class="textarea-comment form-control"></textarea>
					</div>
				</div>
				</div>
				<div class="row">
					<div class="form-submit col-md-12">
						 <input class="btn btn-primary btn-lg text-uppercase" name="submit" type="submit" id="submit" value="<?php esc_html_e('Submit Now', 'comet'); ?>">
                         <?php comment_id_fields(); ?>
						<?php do_action('comment_form', get_the_ID()); ?>
					</div>
				</div>
				</div>

			</div>	
		
		<?php else : ?>
		
			<div id="comment-input" >

				<div class="row">

				<div class="col-md-7 form-group ps-formtag-style">
					<label for="author" class="placeholder"></label>
					<input placeholder="<?php esc_html_e('Name', 'comet'); ?> *" type="text" name="author" id="author" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> class="form-control input-name" />
				</div>
				<div class="col-md-5 form-group ps-formtag-style">
					<label for="email" class="placeholder"></label>
					<input placeholder="<?php esc_html_e('Email', 'comet'); ?>" type="text" name="email" id="email" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> class="form-control input-email"  />
				</div>


				</div>
				<div class="row">
				<div class="col-md-5 form-group ps-formtag-style">
					<label for="phone" class="placeholder"></label>
					<input placeholder="<?php esc_html_e('Phone', 'comet'); ?>" type="text" name="phone" id="phone" tabindex="3" <?php if ($req) echo "aria-required='true'"; ?> class="form-control input-phone" />
				</div>
				<div class="col-md-7 form-group ps-formtag-style">
					<label for="subject" class="placeholder"></label>
					<input placeholder="<?php esc_html_e('Subject', 'comet'); ?>" type="text" name="Subject" id="subject" tabindex="4" <?php if ($req) echo "aria-required='true'"; ?> class="form-control input-subject"  />
				</div>

				</div>
				 <div class="row">
                <div id="comment-textarea" class="col-md-12 col-sm-12">
					<div class="placeholding-input">
						<label for="comment" class="comment-placeholder placeholder"></label>
						<textarea placeholder="<?php esc_html_e('Text here', 'comet'); ?>" name="comment" id="comment" cols="60" rows="8" tabindex="5" class="textarea-comment form-control"></textarea>
					</div>
				</div>
                </div>


			</div>
<!--			<div class="form-allowed-tags">-->
<!--				<h5 class="ps-single-endtag">--><?php //esc_html_e( 'You may use these', 'comet')?><!-- <abbr title="HyperText Markup Language">--><?php //esc_html_e( 'HTML', 'comet'); ?><!--</abbr> --><?php //esc_html_e( 'tags and attributes:', 'comet'); ?><!--</h5>-->
<!--				<code> --><?php //echo allowed_tags(); ?><!-- </code>-->
<!--			</div>-->


            <div class="form-submit">
                <input class="btn btn-primary btn-lg text-uppercase" name="submit" type="submit" id="submit" value="<?php esc_html_e('Submit Now', 'comet'); ?>">
                <?php comment_id_fields(); ?>
                <?php do_action('comment_form', get_the_ID()); ?>
            </div>
    
            <?php endif; ?>
        </form>
    
	<?php
	}
}
endif;

//----------------------------------------------------------------------
// Comments list
//----------------------------------------------------------------------

if ( ! function_exists( "comet_comments" ) ) :

	function comet_comments( $comment, $args, $depth ) {

		$GLOBALS[ 'comment' ] = $comment;
		switch ( $comment->comment_type ) {

			// Display trackbacks differently than normal comments.
			case 'pingback' :
			case 'trackback' :
				?>

				<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<p><?php esc_html_e( 'Pingback:', 'comet' ); ?><?php comment_author_link(); ?><?php edit_comment_link( esc_html__( '(Edit)', 'comet' ), '<span class="edit-link">', '</span>' ); ?></p>

				<?php
				break;

			default :
				// Proceed with normal comments.
				global $post;
				?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<div id="comment-<?php comment_ID(); ?>" class="comment media">
					<div class="comment-author clearfix">
						<div class="media-left">
						<?php if ($args['avatar_size'] != 0) echo  get_avatar( $comment, 80 ); ?>
						</div>
						<div class="media-body">
							<div class="comment-meta media-heading">
								<h4>
									<span class="author-name">
										<?php echo get_comment_author(); ?>
									</span>
								</h4>
								<span>
									<span class="comment-date"><?php echo get_comment_date(' jS \of F Y'); ?><?php echo " at ".get_comment_time(); ?></span>
								</span>
								<div class="comment-meta">
									<?php edit_comment_link( esc_html__( 'Edit', 'comet' ), '<span class="edit-link">', '</span>' ); //edit link
									?>
									<?php comment_reply_link( array_merge( $args, array(
										'reply_text' => '<span class="reply-text">' . esc_html__( 'Reply', 'comet' ) . '</span>',
										'depth'      => $depth,
										'max_depth'  => $args[ 'max_depth' ],
										'before'  => '<span class="reply">',
                                         'after'   => '</span>',
									) ) ); ?>

								</div>

							</div>

							<?php if ( '0' == $comment->comment_approved ) { //Comment moderation ?>
								<div class="alert alert-info">
									<?php esc_html_e( 'Your comment is awaiting moderation.', 'comet' ); ?>
								</div>
							<?php } ?>

							<div class="comment-content">
								<?php comment_text(); //Comment text
								?>
							</div>
							<!-- .comment-content -->
						</div>
					</div>
				</div>
				<!-- #comment-## -->
				<?php
				break;
		} // end comment_type check

	}

endif;

    //----------------------------------------------------------------------
	// Get Default Custom Logo
	//----------------------------------------------------------------------

	if ( ! function_exists( 'comet_get_default_logo' ) ) :

		function comet_get_default_logo( $html = '' ) {

			if ( empty( $html ) ) :

				$html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home">%2$s</a>',
				                 esc_url( home_url( '/' ) ),
				                 '<img class="custom-logo"
							src="' . esc_url( get_template_directory_uri() . '/img/mylogo.png' ) . '"
							alt="' . esc_attr( get_bloginfo( 'name' ) ) . '"/>'
				);

			endif;

			return $html;

		}

		add_filter( 'get_custom_logo', 'comet_get_default_logo' );
	endif;

//----------------------------------------------------------------------
	// Custom Logo Option
	//----------------------------------------------------------------------

	if ( ! function_exists( 'comet_custom_logo' ) ) :

		function comet_custom_logo() {
			if ( function_exists( 'the_custom_logo' ) ) :
				the_custom_logo();
			else:
				echo comet_get_default_logo();
			endif;
		}
	endif;
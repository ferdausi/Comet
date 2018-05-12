<?php
get_header();
?>

    <div class="container">
        <div class="row">
            <div id="primary-single" class="content-area col-md-9">
                <main id="main" class="site-main" role="main">
                    <?php get_template_part( 'post-content/content-single' ); ?>


                </main><!-- .site-main -->

                <?php
                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>



            </div><!-- .content-area -->

            <div id="secondary-single" class="col-md-3 section-sidebar">
                <?php get_sidebar()?>
            </div>

        </div>
    </div>

<?php get_footer();?>
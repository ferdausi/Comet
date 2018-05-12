<?php get_header(); ?>


<?php
$comet_all_query = new WP_Query(array(
    'post_type'=>'post',
    'post_status'=>'publish',

    'paged'=> get_query_var( 'paged' )

));
?>

<!---->
<div class="banner">

    <!-- Second Header -->
    <div class="section-second-header blog " data-stellar-background-ratio="0.4" data-stellar-vertical-offset="0">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 blog-header text-center">
                    <div class="space2"></div>
                    <!--                <div class="mark"></div>-->
                    <h1 class="banner-title text-uppercase">Blog</h1>
                    <p class="blog-text1">
                        Proin ultricies, nisl in imperdiet interdum, est tortor viverra neque,
                        eu molestie dolor lacus sollicitudin sem.<br>
                        Aenean fringilla suscipit justo. Curabitur sagittis quam dolor
                    </p>
                </div>

            </div>
        </div>
    </div>
    <!--/ Second Header -->


</div>



<div class="container">
    <div class="row">
        <div id="primary" class="content-area col-md-9  ">
                <main id="main" class="site-main" role="main">

        <?php
        if ($comet_all_query-> have_posts() ) :

            while ( $comet_all_query->have_posts() ) : $comet_all_query->the_post();?>

                        <?php
                            get_template_part( 'post-content/content', get_post_format() );

            endwhile;
        endif;
            comet_posts_pagination();

        wp_reset_query();
         ?>

                </main><!-- .site-main -->





        </div><!-- .content-area -->

        <div class="col-md-3 section-sidebar">

        <?php get_sidebar()?>

        </div>
    </div>
</div>

<?php get_footer();?>
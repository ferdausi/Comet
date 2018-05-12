<?php

// Don't print empty markup if there's nowhere to navigate.
$previous = get_adjacent_post( FALSE, '', TRUE );
$next     = get_adjacent_post( FALSE, '', FALSE );

if ( ! $next && ! $previous ) :
    return;
endif;

$author_meta = trim( get_the_author_meta( 'description' ) );

$has_author_meta_class = ( empty( $author_meta ) ) ? 'no-author-meta' : 'has-author-meta';

?>
<div class="row">
    <nav class="navigation next-previous-post <?php echo esc_attr( $has_author_meta_class ) ?>">
        <?php if ( $previous ) : ?>
            <div class="col-md-6 previous-post">
                <div class="col-md-4">
                    <a href="<?php echo esc_url( get_permalink( $previous->ID ) ); ?>"><?php echo get_the_post_thumbnail( $previous->ID,array(110,100) ); ?></a>
                </div>
                <div class="col-md-8 single-nav-desc">
                    <?php previous_post_link( '<div class="previous text-uppercase">%link</div>','' . esc_html__( 'Previous Post', 'lifestyle' ) ); ?>
                    <div class="single-entry-title">

                            <a href="<?php echo esc_url( get_permalink( $previous->ID ) ); ?>"><?php echo wp_trim_words(wp_kses( get_the_title( $previous->ID ), array() ),3,'' ); ?></a>

                    </div>
                </div>

            </div> <!-- /.previous-post -->
        <?php endif; ?>

        <?php if ( $next ) : ?>
            <div class="col-md-6 next-post ">

                <div class="col-md-8 single-nav-desc">
                <?php next_post_link( '<div class="next text-uppercase">%link</div>', esc_html__( 'Next Post', 'lifestyle' ) . '' ); ?>
                <div class="single-entry-title">

                        <a href="<?php echo esc_url( get_permalink( $next->ID ) ); ?>"><?php echo wp_trim_words( wp_kses( get_the_title( $next->ID ), array() ),3,''); ?></a>

                </div>
                </div>
                <div class="col-md-4">
                    <a href="<?php echo esc_url( get_permalink( $previous->ID ) ); ?>"><?php echo get_the_post_thumbnail( $next->ID,array(100,100) ); ?></a>
                </div>
            </div> <!-- /.next-post -->
        <?php endif; ?>
    </nav>
    <!-- .next-previous-post -->
</div>
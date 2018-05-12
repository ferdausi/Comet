
<article xmlns="http://www.w3.org/1999/html" class="section-blog-post">


    <div class="entry-thumbnail">
        <?php if(has_post_thumbnail() ) :?>
            <a href="<?php echo esc_url(get_the_permalink());?>"><?php the_post_thumbnail('comet-blog-thumbnail');?></a>
            <?php else:
                endif;
             ?>
    </div>

    <div class="space2"></div>


    <div class="blog-post row">
        <div class="sitebar col-md-2 ">
            <div>
                <a href="<?php the_permalink()?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 70 ); ?></a>
            </div>

            <div class="post-date post-date-custom">
                <a href="<?php the_permalink()?>">
                    <span class="date"><?php the_time('j') ?></span><br>
                    <span class="month"><?php the_time('F') ?></span>
                </a>
            </div>

            <div class="post-comment post-comment-custom">
                <div class="glyph">
                <i class="fa fa-quote-right" aria-hidden="true"></i>
                </div>
            </div>
       </div>

        <div class="clearfix main-content content-custom-1 col-md-10">
            <div class="content-text content-text-custom">
                <?php the_title( sprintf( '<h2 class="entry-title text-uppercase"><a href="%s" >', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                <p class="text6">
                    <?php the_excerpt();?>
                </p>

            </div>
        </div>

    </div>



    <div class="space2"></div>


</article>

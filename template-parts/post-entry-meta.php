
<ul class="list-inline post-entry-meta">
    <li class="posted-on">
        <a href="<?php the_permalink()?>"><i class="fa fa-clock-o"></i> <?php the_time('j F, Y')?></a>
    </li>
    <li class="posted-by">
        <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><i class="fa fa-user-circle"></i> <?php global $post; the_author_meta('display_name', $post->post_author ); ?></a>
    </li>

    <li class="post-comment">
        <a href="<?php the_permalink()?>"><i class="fa fa-comment-o"></i> <?php comments_number( 'no comments', 'one comment', '% comments' ); ?></a>
    </li>

    <li class=" social-share pull-right">
                <span class="box">
                    <span class="top">
                        <i class="fa fa-share" aria-hidden="true"></i>
                    </span>
                    <span class="bottom">
                        <p>
                            <a href=' http://www.facebook.com/sharer.php?url=" . <?php  the_permalink()?>. " ' target='_blank' ><i class="fa fa-facebook "></i></a>
                            <a href='https://twitter.com/share?url=" . <?php  the_permalink()?>. " ' target='_blank' ><i class="fa fa-twitter "></i></a>
                            <a href='https://plus.google.com/share?url=" . <?php  the_permalink()?>. "' target='_blank'  ><i class="fa fa-google-plus "></i></a>
                            <a href='http://www.tumblr.com/share/link?url=" . <?php  the_permalink()?>. "' target='_blank'  ><i class="fa fa-tumblr "></i></a>
                        </p>
                    </span>
                </span>
    </li>




</ul>


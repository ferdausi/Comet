<?php

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( "blog-post-wrapper blog-post-default" ); ?>>

	<?php if ( has_post_thumbnail() || story_post_thumbnail( TRUE ) ) : ?>
		<?php story_post_thumbnail(); ?>
	<?php endif; ?>


		<header class="entry-header">
			<div class="entry-meta">
				<?php story_entry_meta() ?>
			</div>
			<!-- .entry-meta -->
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header>
		<!-- .entry-header -->


		<?php if ( has_excerpt() ) : ?>
			<div class="entry-summary">
				<?php
					the_excerpt();
				?>
			</div><!-- .entry-summary -->

		<?php else : ?>
			<div class="entry-content">
				<?php
					the_content( '<span class="read-more">' . esc_html__( 'Read More', 'breakingstory' ) . '</span>' );
				?>
			</div>
		<?php endif; ?>

</article><!-- #post-## -->
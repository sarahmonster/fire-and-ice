<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Fire_and_Ice
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( '' != get_the_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'fireandice-featured-image' ); ?>
				</a>
			</div>
		<?php endif; ?>

		<?php
			if ( 'post' === get_post_type() ) :
				get_template_part( 'components/post/content', 'meta' );
			endif;

			if ( is_single() ) {
				the_title( '<h1 class="entry-title"><span>', '</span></h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
	</header>

	<section class="fireandice-content">
		<div class="entry-content">
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'fireandice' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fireandice' ),
					'after'  => '</div>',
				) );
			?>
		</div>
		<?php get_template_part( 'components/post/content', 'footer' ); ?>
	</section>
</article><!-- #post-## -->

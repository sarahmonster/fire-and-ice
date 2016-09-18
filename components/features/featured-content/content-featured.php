<?php
/**
 * The template for displaying featured posts on the front page
 *
 * @package Fire_and_Ice
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a class="post-thumbnail" href="<?php the_permalink(); ?>">
	<?php
		// Output the featured image.
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'fireandice-thumbnail' );
		}
	?>
	</a>

	<header class="entry-header">
		<?php
			the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h1>' );
		?>
	</header>
</article>

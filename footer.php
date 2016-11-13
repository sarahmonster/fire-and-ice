<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fire_and_Ice
 */

?>

	</div>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php get_template_part( 'components/footer/site', 'info' ); ?>
	</footer>
</div>
<?php wp_footer(); ?>

<svg class="fireandice-filter">
	<defs>
		<filter id="duotone">
			<feColorMatrix
			type="matrix"
			values="1  0  0  0  0
				1  0  0  0  0
				1  0  0  0  0
				0  0  0  1  0"/>
		</filter>
	</defs>
</svg>

</body>
</html>

<?php
/**
 * App Layout: layouts/app.php
 *
 * This is the template that is used for displaying all pages by default.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPEmergeTheme
 */
?>
<?php
if (!is_front_page() && is_page()):
	get_template_part('template-parts/page-hero');
endif;

if (is_front_page()):
	the_content();
else:
	?>
	<div class="wrapper-content">
		<?php
		the_content();
		?>
	</div>
	<?php
endif;
?>
<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<div class="errorpage custom-404 search-result container min-page-height">
	<section id="error">
		<div class="content">
			<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			<h1>404</h1>
			<p>Page not found</p>
			<a class="back" href="<?php echo site_url(); ?>">Back</a>
		</div>
	</section>
</div>
<?php get_footer();

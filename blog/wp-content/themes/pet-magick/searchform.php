<?php
/**
 * The template for Search Form.
 *
 * @package Simon WP Framework
 * @since Simon WP Framework 1.0
 */
?>

<form action="<?php echo site_url(); ?>" id="searchform" method="get">
	<div id="blog-search-wrapper">
		<input type="text" id="blog-search" name="s" value="" placeholder="Search posts" />
		<input type="submit" value="Search" id="searchsubmit" class="btn" />
	</div>
</form>

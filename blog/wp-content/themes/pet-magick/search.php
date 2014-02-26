<?php 
/**
 * The template for displaying Search.
 *
 * @package Simon WP Framework
 * @since Simon WP Framework 1.0
 */get_header(); ?>

<div class="container_12" id="blog-content">
    <div class="grid_8">
      
        <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
        <div <?php post_class() ?>>
          <div class="mod vet-talk-mod">
            
            <div class="mod-header">
                <h2 id="post-<?php the_ID(); ?>">
                  <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                    <?php the_title(); ?>
                  </a>
                </h2>
            </div>
            <div class="mod-content">    
                <div class="postmetadata">
                  <?php get_template_part( '/inc/meta' );?>
                </div>
            </div>
            
          </div>
        </div>
        <?php endwhile; ?>
        <?php get_template_part( '/inc/nav' );?>
        <?php else : ?>
        <div class="mod vet-talk-mod">
          <div class="mod-header">
            <h2 class="">No posts found.</h2>
          </div>
          <div class="mod-content">
            <h4>Try a different search?</h4>
            <?php get_search_form(); ?>
          </div>
        </div>
        <?php endif; ?>
      
      
    </div>
    <?php get_sidebar(); ?>
  
</div>
<?php get_footer(); ?>

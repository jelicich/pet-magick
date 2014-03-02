<?php 
/**
 * The template for displaying Single Page.
 *
 * @package Simon WP Framework
 * @since Simon WP Framework 1.0
 */
 get_header(); ?>

<div class="container_12" id="blog-content">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="grid_12">      
      <div clas="mod pet-loss-mod">
        <div class="mod-header">
          <h2 class="entry-title textcenter">
            <?php the_title(); ?>
          </h2>
        </div>
    </div>

    <div class="grid_12">
      
        <div class="post" id="post-<?php the_ID(); ?>">
          <div class="entry">
            <?php the_content(); ?>
            <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
          </div>
          <div class="postmetadata">
            <?php get_template_part( '/inc/meta' );?>
          </div>
        </div>
        <div id="comment-block">
          <?php comments_template(); ?>
        </div>
            
    </div>
    <?php endwhile; endif; ?>
    
  
</div>
<?php get_footer(); ?>

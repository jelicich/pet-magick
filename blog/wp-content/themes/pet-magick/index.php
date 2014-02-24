<?php
/**
 * The template for displaying Index.
 *
 * @package Simon WP Framework
 * @since Simon WP Framework 1.0
 */

get_header(); ?>

<div class="container_12" id="blog-content">
  
    <div class="grid_8" >
      
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
          <div class="flex_10">
            <div class="postdate">
              <div class="postmonth">
                <?php the_time('M, d') ?>
              </div>
              <div class="postyear">
                <?php the_time('Y') ?>
              </div>
            </div>
          </div>
          
          <div class="flex_90 mod profiles-mod"> 
            
            <div class="mod-header">
              <span class="categories">
                <?php the_category(', '); ?>
              </span>
              <h2 id="post-<?php the_ID(); ?>"  class="entry-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                <?php if ( get_the_title() == '' ) { ?>
                <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link">No Title</a>
                <?php } else { ?>
                <?php the_title(); ?>
                <?php } ?>
                </a>
              </h2>
            </div>

            <div class="entry">
              <?php get_template_part( 'format', get_post_format() ); ?>
            </div>
          </div>
          <div class="clear"></div>
        </div>
        <?php endwhile; ?>
        <?php get_template_part( '/inc/nav' );?>
        <?php else : ?>
        <h2>Not Found</h2>
        <?php endif; ?>
      
    </div><!-- grid 8 -->

<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>

<?php 
/**
 * The template for displaying Single Posts.
 *
 * @package Simon WP Framework
 * @since Simon WP Framework 1.0
 */
get_header(); ?>

<div class="container_12" id="blog-content">
  
    <div class="grid_8">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="bread-crumb">
        <?php simonwpframework_breadcrumb();?>
      </div>
      <h3 class="entry-title">
        <?php the_title(); ?>
        <?php edit_post_link('Edit'); ?>
      </h3>
      <div class="postmetadata">
        <?php get_template_part( '/inc/meta' );?>
      </div>
      <div class="flex_vert_pad"></div>
      
      <!-- -->
      <div>
        <div class="">
          <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
            <div class="entry">
              <?php get_template_part( 'format', get_post_format() ); ?>
            </div>
            <div class="postmetadata">
              <div class="author">
                <?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '100' ); }?>
                <div class="authorinfo">
                  <h3>About <span rel="author">
                    <?php the_author_posts_link(); ?>
                    </span> </h3>
                  <p>
                    <?php the_author_meta('description'); ?>
                  </p>
                  <div class="clear"></div>
                </div>
              </div>
            </div>
          </div>
          <div id="comment-block">
            <?php comments_template(); ?>
          </div>
          <?php endwhile; endif; ?>
          <div>
            <?php wp_link_pages(); ?>
          </div>
        </div>
        
      </div>
    </div>
    <?php get_template_part('sidebar'); ?>
  
</div>
<?php get_footer(); ?>

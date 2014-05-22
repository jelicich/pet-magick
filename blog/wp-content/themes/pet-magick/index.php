<?php
/**
 * The template for displaying Index.
 *
 * @package Simon WP Framework
 * @since Simon WP Framework 1.0
 */
  include_once "../php/classes/BOPopups.php";
  $pop = new BOPopups;
get_header(); ?>

<div class="container_12" id="blog-content">
  
  <div id='what' >
    <a href="#"><p>What is the blog ?</p></a>
    <div class='active'>
      <div id='pop-up' class='mod grid_4 '>

        <p> 
          <?php echo nl2br($pop->getPopUps("blog")); ?>
        </p>

      </div>
      <div class=' arrow-top'></div>
    </div>
  </div>
  
    <div class="grid_8">
      
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
          
          
          <div class="mod vet-talk-mod"> 
            <div class="mod-header">
              
                <span>
                  <?php the_time('M, d') ?>
                  <?php the_time('Y') ?> | 
                </span>
                
              

              <span class="categories">
                <?php the_category(', '); ?>
              </span>
              <h2 id="post-<?php the_ID(); ?>"  class="entry-title">
                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                <?php if ( get_the_title() == '' ) { ?>
                <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link">No Title</a>
                <?php } else { ?>
                <?php the_title(); ?>
                <?php } ?>
                </a>
              </h2>
            </div>

            <div class="entry mod-content blog-content">
              <?php get_template_part( 'format', get_post_format() ); ?>
            </div>
          </div>
          
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

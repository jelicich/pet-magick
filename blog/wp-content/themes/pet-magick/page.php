<?php 
/**
 * The template for displaying Single Page.
 *
 * @package Simon WP Framework
 * @since Simon WP Framework 1.0
 */
 get_header(); ?>

<div class="container_12" id="blog-content">
  <?php
  if(isset($_GET['post_type']) && $_GET['post_type'] == 'forum')
  {
    include_once "../php/classes/BOPopups.php";
    $pop = new BOPopups;
  ?>
  <div id='what' >
    <a href="#"><p>What is the forum ?</p></a>
    <div class='active'>
      <div id='pop-up' class='mod grid_4 '>

        <p> 
          <?php echo nl2br($pop->getPopUps("forum")); ?>
        </p>

      </div>
      <div class=' arrow-top'></div>
    </div>
  </div>
  <?php
  }
  ?>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="grid_12">      
      <div class="mod forum-mod">
        <div class="mod-header">
          <h2>
            <?php the_title(); ?>
          </h2>
        </div>
      </div>
    </div>

    <div class="grid_12" id="forum-content">
      
        <div class="post" id="post-<?php the_ID(); ?>">
          <div class="entry">
            <?php the_content(); ?>
            <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
          </div>
          <div class="postmetadata">
            <?php //get_template_part( '/inc/meta' );?>
          </div>
        </div>
        <div id="comment-block">
          <?php //comments_template(); ?>
        </div>
            
    </div>
    <?php endwhile; endif; ?>
    
  
</div>
<?php get_footer(); ?>

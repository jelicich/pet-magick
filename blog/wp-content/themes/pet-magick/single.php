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
      
      <div class="mod vet-talk-mod">
        
        <div class="mod-header">
          <div class="bread-crumb">
            <?php simonwpframework_breadcrumb();?>
          </div>
          <h2 class="entry-title">
            <?php the_title(); ?>
            <?php edit_post_link('Edit'); ?>
          </h2>
          <div class="postmetadata">
            <?php get_template_part( '/inc/meta' );?>
          </div>
          
        </div><!-- end mod header -->
        
        <!-- -->
        <div class="mod-content">
          <div class="">
            <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
              <div class="entry">
                <?php get_template_part( 'format', get_post_format() ); ?>
              </div>
              <div class="postmetadata">
                <div class="author">
                  <?php
                    //if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '100' ); }
                    //get picture from pet magick
                    $author_ID = get_the_author_meta('ID');
                    include_once '../php/classes/BOUsers.php';
                    $pmuser = new BOUsers;
                    $pic = $pmuser->getProfilePicWP($author_ID);
                    //var_dump($pic);
                    echo '<a href="'.$pic['PIC'].'"><img src="'.$pic['THUMB'].'" width="123" height="123" /></a>'
            
                  ?>
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
            
            <div>
              <?php wp_link_pages(); ?>
            </div>
          </div>
          
        </div><!-- end mod content -->
      </div><!-- end mod -->

      <div id="comment-block">
        <?php comments_template(); ?>
      </div>
      <?php endwhile; endif; ?>
    </div><!-- end grid_8 -->
    
    <?php get_template_part('sidebar'); ?>
  
</div>
<?php get_footer(); ?>

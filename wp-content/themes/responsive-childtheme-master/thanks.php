<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Full Content Template
 *
Template Name:  Thanks Page (no sidebar)
 *
 * @file           full-width-page.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/full-width-page.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */
get_header(); ?>
<script>
function changeURL() {
  setTimeout(function(){window.location.href = "<?php echo SITEURL;?>"}, 5000);
}changeURL();
</script>
<div class="clearfix"></div>
<div class="banner register-banner">
  <div class="container">
    <div class="form-wrapper">
      <div class="form-wrapper-inner">
        <div class="form-col">
          <div class="logo-section"> <img src="<?php echo SITEURL;?>wp-content/uploads/2018/04/logo.png" alt="logo">
            <p> Find the best matches as
              per your requirements. </p>
          </div>
        </div>
        <div class="form-col">
          <div class="heeding_outer_rgster">
            <h4>Thank You</h4>
          </div>
          <?php if ( have_posts() ) : ?>
          <?php while( have_posts() ) : the_post(); ?>
          <?php //get_template_part( 'loop-header', get_post_type() ); ?>
          <?php responsive_entry_before(); ?>
          <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php responsive_entry_top(); ?>
            <?php get_template_part( 'post-meta', get_post_type() ); ?>
            <div class="post-entry">
              <?php responsive_page_featured_image(); ?>
              <?php the_content( __( 'Read more &#8250;', 'responsive' ) ); ?>
              <?php wp_link_pages( array( 'before' => '<div class="pagination">' . __( 'Pages:', 'responsive' ), 'after' => '</div>' ) ); ?>
            </div>
            <div id="success">
			<p style="text-align:center;">Thanks for contacting us. We will get back to you shortly.</p>
			</div>
            <?php get_template_part( 'post-data', get_post_type() ); ?>
            <?php responsive_entry_bottom(); ?>
          </div>
          <!-- end of #post-<?php the_ID(); ?> -->
          <?php responsive_entry_after(); ?>
          <?php responsive_comments_before(); ?>
          <?php comments_template( '', true ); ?>
          <?php responsive_comments_after(); ?>
          <?php
			endwhile; 
			?>
          <?php
			get_template_part( 'loop-nav', get_post_type() );
			else:
			get_template_part( 'loop-no-posts', get_post_type() );
			endif;
		  ?>
        </div>
      </div>
    </div>
  </div>
  <!-- end of #content-full -->
</div>
<?php get_footer(); ?>
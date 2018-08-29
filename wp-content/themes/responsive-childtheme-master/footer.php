<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Footer Template
 *
 *
 * @file           footer.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.2
 * @filesource     wp-content/themes/responsive/footer.php
 * @link           http://codex.wordpress.org/Theme_Development#Footer_.28footer.php.29
 * @since          available since Release 1.0
 */

/*
 * Globalize Theme options
 */
global $responsive_options;
$responsive_options = responsive_get_options();
?>
<?php responsive_wrapper_bottom(); // after wrapper content hook ?>
</div><!-- end of #wrapper -->

<?php responsive_wrapper_end(); // after wrapper hook ?>
<?php if ( is_home() && ! is_front_page() ) {?>
</div>
<?php } ?>	 
</div><!-- end of #container -->
<?php responsive_container_end(); // after container hook ?>

<div id="footer" class="clearfix getin_foot" role="contentinfo">
	<?php responsive_footer_top(); ?>
	
<div class="container">
  <div class="col-sm-12">
	<!--<div class="w3-col l3 footer_logo_"> <img src="/wp-content/uploads/2018/04/cropped-Desi-Homes-Logo.png" width="167" height="104" alt="Desi Homes"></div>-->
	
	<div class="col-sm-3 mobile_hidden_ftr_">
			<ul>
			<li><a href="<?php echo SITEURL?>about-us">About Us</a></li>
			<li><a href="<?php echo SITEURL?>terms-and-conditions">Terms and Conditions</a></li>
			</ul>
	</div>
		
<!--<ul>
<li><a href="http://www.enthropia.com/labs/ibox/images/large/image_1b.jpg"  rel="ibox" title="Good Barbeque at 1024x450!"><img 
src="http://www.enthropia.com/labs/ibox/images/small/image_1.jpg" alt=""/></a></li>
</ul>-->
    
    
    <div class="w3-col l2 mobile_show_ftr">
		<ul>
			<li><a href = '<?php echo SITEURL?>about-us'>About Us</a></li>
			<li><a href="<?php echo SITEURL?>terms-and-conditions">Terms and Conditions</a></li>
		</ul>
	</div>
	
	<div class="col-sm-3">
	<ul>
		<li><a href="<?php echo SITEURL;?>get-in-touch">Get in touch</a></li>
		<li><a href="<?php echo SITEURL;?>blog">Blog</a></li>
	</ul>
	</div>
	
	<div class="col-sm-3">
	<ul>	
        <li><a href="<?php echo SITEURL;?>privacy-policy">Privacy Policy</a></li>
         <li><a href="<?php echo SITEURL;?>cookie-policy">Cookie Policy</a></li>
     </ul>
	</div>
	<div class="col-sm-3 hide_on_mobile_">
	 <div class="social-media">
	  <h3>Stay Connected </h3>
	  <div class="socia-btns">
		  <a href="https://www.instagram.com/desihomesuk" target="_blank" class="insta"><i class="fa fa-instagram"></i></a> 
		  <a href="https://www.facebook.com/Desi-Homes-622557758109512" target="_blank" class="fb"><i class="fa fa-facebook"></i></a> 
		  <a href="https://twitter.com/desihomes" target="_blank" class="tw"><i class="fa fa-twitter"></i></a> 
		  <a href="https://www.linkedin.com/in/desi-homes-18a426167/" target="_blank" class="ln"><i class="fa fa-linkedin"></i></a> 
	  </div>
	 </div>
	</div>
    
    <div class="col-md-l2 show_on_mobile_">
	 <div class="social-media">
	  <h3>Stay Connected </h3>
	  <div class="socia-btns">
		  <a href="https://www.instagram.com/desihomesuk" target="_blank" class="insta"><i class="fa fa-instagram"></i></a> 
		  <a href="https://www.facebook.com/Desi-Homes-622557758109512" target="_blank" class="fb"><i class="fa fa-facebook"></i></a> 
		  <a href="https://twitter.com/desihomes" target="_blank" class="tw"><i class="fa fa-twitter"></i></a> 
		  <a href="https://www.linkedin.com/in/desi-homes-18a426167/" target="_blank" class="ln"><i class="fa fa-linkedin"></i></a> 
	  </div>
	 </div>
	</div>
   </div>
 </div>
	<div id="footer-wrapper">
		
		 <!--   main-->
		
	<?php if (isset($responsive_options['site_layout_option']) && ($responsive_options['site_layout_option'] == 'full-width-no-box')) {?>
		<div class="social_div grid col-940">
			<div id="content-outer">
			<?php echo responsive_get_social_icons_new() ?>	
		</div>
		</div>	
		<div class="footer_div grid col-940">
			<div id="content-outer">
		<?php get_sidebar( 'footer' ); ?>
		</div>
		</div>		
		<div id="content-outer">
		<div class="grid col-940">

			<div class="grid col-540">
				<?php /*if ( has_nav_menu( 'footer-menu', 'responsive' ) ) {
					wp_nav_menu( array(
						'container'      => '',
						'fallback_cb'    => false,
						'menu_class'     => 'footer-menu',
						'theme_location' => 'footer-menu'
					) );
				} */ ?>
			</div><!-- end of col-540 -->

			

		</div><!-- end of col-940 -->
		<?php get_sidebar( 'colophon' ); ?>

		<div class="grid col-300 copyright">
			<?php esc_attr_e( '&copy;', 'responsive' ); ?> <?php echo date( 'Y' ); ?><a id="copyright_link" href="<?php echo esc_url( home_url( '/' ) ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				<?php bloginfo( 'name' ); ?>
			</a>
		</div><!-- end of .copyright -->

		<div class="grid col-300 scroll-top"><!--<a href="#scroll-top" title="<?php esc_attr_e( 'scroll to top', 'responsive' ); ?>"><?php _e( '&uarr;', 'responsive' ); ?></a>
		<div id="scroll-to-top"><span class="glyphicon glyphicon-chevron-up"></span></div>--></div>

		<div class="grid col-300 fit powered">
			<a href="<?php echo esc_url( 'http://cyberchimps.com/responsive-theme/' ); ?>" title="<?php esc_attr_e( 'Responsive Theme', 'responsive' ); ?>" rel="noindex, nofollow">Responsive Theme</a>
			<?php esc_attr_e( 'powered by', 'responsive' ); ?> <a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" title="<?php esc_attr_e( 'WordPress', 'responsive' ); ?>">
				WordPress</a>
		</div><!-- end .powered -->
	</div>
	<?php }else{?>
	<div id="content-outer">			
		<?php get_sidebar( 'footer' ); ?>
		</div>
		<div id="content-outer">
		<div class="grid col-940">

			<div class="grid col-540">
				<?php if ( has_nav_menu( 'footer-menu', 'responsive' ) ) {
					wp_nav_menu( array(
						'container'      => '',
						'fallback_cb'    => false,
						'menu_class'     => 'footer-menu',
						'theme_location' => 'footer-menu'
					) );
				} ?>
			</div><!-- end of col-540 -->

			<div class="grid col-380 fit">
				<?php echo responsive_get_social_icons() ?>
			</div><!-- end of col-380 fit -->

		</div><!-- end of col-940 -->
		<?php get_sidebar( 'colophon' ); ?>

		

		<div class="grid col-300 scroll-top"><!--<a href="#scroll-top" title="<?php esc_attr_e( 'scroll to top', 'responsive' ); ?>"><?php _e( '&uarr;', 'responsive' ); ?></a>
		<div id="scroll-to-top"><span class="glyphicon glyphicon-chevron-up"></span></div>--></div>

		<div class="grid col-300 fit powered">
			<a href="<?php echo esc_url( 'http://cyberchimps.com/responsive-theme/' ); ?>" title="<?php esc_attr_e( 'Responsive Theme', 'responsive' ); ?>" rel="noindex, nofollow">Responsive Theme</a>
			<?php esc_attr_e( 'powered by', 'responsive' ); ?> <a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" title="<?php esc_attr_e( 'WordPress', 'responsive' ); ?>">
				WordPress</a>
		</div><!-- end .powered -->
	</div>
	<?php }?>
	
	</div><!-- end #footer-wrapper -->

	<?php responsive_footer_bottom(); ?>
</div><!-- end #footer -->

<!--<div class="copyright">
	<div class="container">
		 <p class="copy_text">© Copyright 2018 Desi Homes</p>
		 <p class="dev_text">Developed &amp; Designed by :<a href="https://www.reinventdigital.com/" target="_blank"> Reinvent Digital</a></p>
	</div>
</div>-->

<?php responsive_footer_after(); ?>
<div id="scroll" title="Scroll to Top" style="display: block;">Top<span></span></div>
<link href="<?php echo get_stylesheet_directory_uri() ?>/media.css" rel="stylesheet">
<link href="<?php echo get_stylesheet_directory_uri() ?>/animate.css" rel="stylesheet">
<script src="<?php echo get_stylesheet_directory_uri(); ?>/wow.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/slider/js/owl.carousel.js"></script>
<script>


(function($){
            $(document).ready(function() {
              $('.choice_slider , .happy_fmly_slider').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
				autoplay: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: false
                  },
                  768: {
                    items: 1,
                    nav: false
                  },
                  1000: {
                    items: 5,
                    nav: true,
                    loop: false,
                    margin: 20
                  }
                }
              });
      
				
	$('#latest-property-slider').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
	       autoplay: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: false
                  },
                  768: {
                    items: 1,
                    nav: false
                  },
                  1000: {
                    items: 5,
                    nav: true,
                    loop: false,
                    margin: 20
                  }
                }
              });
      			
			
              $('.populr_cities').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
				autoplay: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: false
                  },
                  580: {
                    items: 2,
                    nav: false
                  },
                  1000: {
                    items: 2,
                    nav: true,
                    loop: false,
                    margin: 20
                  }
                }
              });
            
              $('.propty_feat_image').owlCarousel({
                loop: true,
				navigation: true,
  				navText: ["<img src='<?php echo SITEURL;?>images/myprevimage.png'>","<img src='<?php echo SITEURL;?>images/mynextimage.png'>"],
                margin: 10,
                responsiveClass: true,
				autoplay: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: false
                  },
                  580: {
                    items: 1,
                    nav: false
                  },
                  1000: {
                    items: 1,
                    nav: false,
                    loop: false
                    
                  }
                }
              });
			  
			  
			  
				  
            });

}(jQuery));
			
          </script>     
          <script>
			new WOW().init();
		</script>

<?php wp_footer(); ?>

<!--<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '344260856097092',
      cookie     : true,
      xfbml      : true,
      version    : 'v3.0'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>-->



</body>
</html>

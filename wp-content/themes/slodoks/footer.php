<?php
/**
 * Footer template.
 *
 * @package Elementor_Theme
 */

global $elementor_options;
?>
<footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-8">
				<?php if ( ! empty( $elementor_options['footer_title_1'] ) ) : ?>
                <h2 class="footer-heading mb-4"><?php echo esc_html( $elementor_options['footer_title_1'] ); ?></h2>
				<?php endif; ?>
				<?php if ( ! empty( $elementor_options['footer_text_1'] ) ) : ?>
                <?php echo wpautop( esc_html( $elementor_options['footer_text_1'] ) ); ?>
				<?php endif; ?>
              </div>
              <div class="col-md-4 ml-auto">
				<?php if ( ! empty( $elementor_options['footer_title_2'] ) ) : ?>
                <h2 class="footer-heading mb-4"><?php echo esc_html( $elementor_options['footer_title_2'] ); ?></h2>
				<?php endif; ?>
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer-menu',
							'menu_id'        => 'footer-menu',
							'menu_class'     =>  'list-unstyled',
							'container'      =>  '',
						)
					);
				?>
                
              </div>
              
            </div>
          </div>
          <div class="col-md-4 ml-auto">

            <div class="mb-5">
              <div class="mb-5">
				<?php if ( ! empty( $elementor_options['footer_title_3'] ) ) : ?>
                <h2 class="footer-heading mb-4"><?php echo esc_html( $elementor_options['footer_title_3'] ); ?></h2>
				<?php endif; ?>
				<?php if ( ! empty( $elementor_options['footer_text_2'] ) ) : ?>
                <?php echo wpautop( esc_html( $elementor_options['footer_text_2'] ) ); ?>
				<?php endif; ?>
              </div>
			  <?php if ( ! empty( $elementor_options['footer_form_title'] ) ) : ?>
              <h2 class="footer-heading mb-4"><?php echo esc_html( $elementor_options['footer_form_title'] ); ?></h2>
			  <?php endif; ?>
			  <?php if ( ! empty( $elementor_options['footer_form_shortcode'] ) ) : ?>
              <div class="mb-3"><?php echo do_shortcode( $elementor_options['footer_form_shortcode'] ); ?></div>
			  <?php endif; ?>


              <h2 class="footer-heading mb-4">Follow Us</h2>
                <a href="#about-section" class="smoothscroll pl-0 pr-3"><span class="icon-facebook"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
            </div>
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
            <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            </div>
          </div>
          
        </div>
      </div>
    </footer>

  </div>
<?php wp_footer(); ?>

</body>
</html>

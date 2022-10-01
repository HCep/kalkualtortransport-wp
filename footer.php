<?php

?>

	</div><!-- #content -->
	</div><!-- .row -->
			</div>
			</div>
	<footer id="colophon" class="site-footer" role="contentinfo">

			<div class="footer-blue">
		
					<div class="container mx-auto">
				
						<?php
							get_sidebar('footer');
						
						?>
					
					
					</div>
				
</div>
		<!-- prawa autorskie -->
		<div class="footer-bottom-row">
	
			
				
						<div class="site-info text-center">
							Wszystkie prawa zastrzeżone 2022 TYM-TRANS
						</div><!-- .site-info -->
					</div> <!-- col-lg-12 -->
				<!-- .containr -->
		
		

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri(); ?>/js/splide.min.js"></script>
<script>

document.addEventListener( 'DOMContentLoaded', function () {
	<?php if(is_page('o-firmie')) { ?>	
new Splide( '.about', {
	loop:true,
  rewind: true,
  speed: number = 400,
  perPage: 3,
  breakpoints: {
	
		500: {
			perPage:1,
		}
	},
  perMove: 1,
	arrowPath: 'M30,18.591a1.906,1.906,0,0,0-1.748,1.029l-13,23.409A2,2,0,0,0,17,46H43a2,2,0,0,0,1.748-2.971l-13-23.409A1.906,1.906,0,0,0,30,18.591m0-8a9.9,9.9,0,0,1,8.742,5.144l13,23.409A10,10,0,0,1,43,54H17A10,10,0,0,1,8.254,39.144l13-23.409A9.9,9.9,0,0,1,30,10.591Z" transform="matrix(-0.017, -1, 1, -0.017, -9.664, 53.954)',
} ).mount();
<?php } ?>
<?php if(is_page('about-us')) { ?>
new Splide( '.about-us', {
	loop:true,
  rewind: true,
  speed: number = 400,
  perPage: 3,
  breakpoints: {
	
		500: {
			perPage:1,
		}
	},
  perMove: 1,
	arrowPath: 'M30,18.591a1.906,1.906,0,0,0-1.748,1.029l-13,23.409A2,2,0,0,0,17,46H43a2,2,0,0,0,1.748-2.971l-13-23.409A1.906,1.906,0,0,0,30,18.591m0-8a9.9,9.9,0,0,1,8.742,5.144l13,23.409A10,10,0,0,1,43,54H17A10,10,0,0,1,8.254,39.144l13-23.409A9.9,9.9,0,0,1,30,10.591Z" transform="matrix(-0.017, -1, 1, -0.017, -9.664, 53.954)',
} ).mount();
<?php } ?>
});


</script>

<?php if(is_front_page() || is_page('kalkulator-transportu') || is_page('kalkulator-ldm')): ?>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtQKnsUvR0-f8yymO6psYx-ia2XFGeJKA&libraries=geometry,places&callback=initMap"
  type="text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <?php endif;?>
</body>
</html>

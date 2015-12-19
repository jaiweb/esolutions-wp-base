<?php
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );

add_shortcode('_testimonials','_esc_shortcode__testimonials');
add_shortcode('_chart','esc_chart');
function esc_chart( $atts, $content = null ) {
	$a	=	_esc_shortcode_atts($atts);
	if(!$a['data'])
		$a['data']	=	'1,1,3,2,5,4,7';
	
	$a['data']	=	'0,' . $a['data'] . ',0';
	global $_print_array_js_graph;
	$_print_array_js_graph	=	$a['data'];
	ob_start();
?>
	<div id="esc-chart"<?php echo $a['class'] ?>></div>
<?php
	return ob_get_clean();
}
function _esc_shortcode__testimonials( $atts, $content = null ) {
	$a	=	_esc_shortcode_atts($atts);
	ob_start();
?>
<section>
	<div class="container text-center">
		<div class="row">
			<div id="testimonial" class="carousel slide col-sm-10 col-sm-offset-1<?php echo $a['effect'] ?>"<?php echo $a['delay'] ?> data-ride="carousel">
				<div class="carousel-inner">
					<div class="item active">
						<div class="row">
							<p>We've worked with Justin for some time now as a strategic partner for Link Development for CHG Healthcare and can't say enough about Justin's savvy and attention to detail in SEO/SEM. I highly recommend Justin to any company looking for a SEO champion!</p>
							<cite><strong>Sean Bolton</strong>, CEO - Lead to Conversion, LLC</cite>
						</div>
					</div>
					<div class="item">
					   <div class="row">
							<p>In sit amet arcu quis libero lacinia sodales. Ut vel arcu facilisis, egestas libero eu, bibendum sem. Etiam id magna metus. Fusce quis quam quis nisl fermentum lobortis vel et felis quis nisl fermentum lobortis vel et feli quis nisl fermentum lobortis vel et feli.</p>
							<cite><strong>egestas libero</strong>, CEO - Lead to Conversion, LLC</cite>
					   </div>
					</div>
					<div class="item">
					   <div class="row">
							<p>Sed nec quam urna. Ut venenatis venenatis accumsan. Integer semper suscipit turpis, at iaculis turpis vulputate at. Nulla vitae lacus congue dui pellentesque lacinia vitae eget ante quis nisl fermentum lobortis vel et feli quis nisl fermentum lobortis vel et feli.</p>
							<cite><strong>suscipit turpis</strong>, CEO - Lead to Conversion, LLC</cite>
					   </div>
					</div>
				</div><?php	/*	?>
				<!-- Controls -->
				<a class="left carousel-control" href="#testimonial" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a>
				<a class="right carousel-control" href="#testimonial" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a>
				<?php	*/	?>
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#testimonial" data-slide-to="0" class="active"></li>
					<li data-target="#testimonial" data-slide-to="1"></li>
					<li data-target="#testimonial" data-slide-to="2"></li>
				</ol><!-- Wrapper for slides -->
			</div>
		</div>
	</div>
</section>
<?php
	return ob_get_clean();
}
add_shortcode('_our_tools','_esc_shortcode__tools');
function _esc_shortcode__tools( $atts ) {
	$a	=	_esc_shortcode_atts($atts);
	$_images	=	_esc_shortcode__images() . '/tools';
	ob_start();
?>
<section id="our-tools">
	<div class="container">
		<div class="row">
		<h3>TOOLS</h3>
			<div class="carousel slide<?php echo $a['effect'] ?>"<?php echo $a['delay'] ?> data-ride="carousel">
				<div class="carousel-inner text-center">
					<div class="item active">
							<div class="col-sm-2 col-xs-6"><img src="<?php	echo $_images	?>/logo-semrush.png" alt="..."></div>
							<div class="col-sm-2 col-xs-6"><img src="<?php	echo $_images	?>/logo-citation-labs.png" alt="..."></div>
							<div class="col-sm-2 col-xs-6"><img src="<?php	echo $_images	?>/logo-icons.png" alt="..."></div>
							<div class="col-sm-2 col-xs-6"><img src="<?php	echo $_images	?>/logo-ahrefs.png" alt="..."></div>
							<div class="col-sm-2 col-xs-6"><img src="<?php	echo $_images	?>/logo-marin-software.png" alt="..."></div>
							<div class="col-sm-2 col-xs-6"><img src="<?php	echo $_images	?>/logo-crazyegg.png" alt="..."></div>
					</div>
					<div class="item">
							<div class="col-sm-2 col-xs-6"><img src="<?php	echo $_images	?>/logo-citation-labs.png" alt="..."></div>
							<div class="col-sm-2 col-xs-6"><img src="<?php	echo $_images	?>/logo-semrush.png" alt="..."></div>
							<div class="col-sm-2 col-xs-6"><img src="<?php	echo $_images	?>/logo-ahrefs.png" alt="..."></div>
							<div class="col-sm-2 col-xs-6"><img src="<?php	echo $_images	?>/logo-marin-software.png" alt="..."></div>
							<div class="col-sm-2 col-xs-6"><img src="<?php	echo $_images	?>/logo-icons.png" alt="..."></div>
							<div class="col-sm-2 col-xs-6"><img src="<?php	echo $_images	?>/logo-google.png" alt="..."></div>
					</div>
					<div class="item">
							<div class="col-sm-2 col-xs-6"><img src="<?php	echo $_images	?>/logo-crazyegg.png" alt="..."></div>	
							<div class="col-sm-2 col-xs-6"><img src="<?php	echo $_images	?>/logo-semrush.png" alt="..."></div>
							<div class="col-sm-2 col-xs-6"><img src="<?php	echo $_images	?>/logo-marin-software.png" alt="..."></div>
							<div class="col-sm-2 col-xs-6"><img src="<?php	echo $_images	?>/logo-ahrefs.png" alt="..."></div>
							<div class="col-sm-2 col-xs-6"><img src="<?php	echo $_images	?>/logo-icons.png" alt="..."></div>
							<div class="col-sm-2 col-xs-6"><img src="<?php	echo $_images	?>/logo-citation-labs.png" alt="..."></div>
					</div>
				</div>
				<a class="left carousel-control" href="#our-tools" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a>
				<a class="right carousel-control" href="#our-tools" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a>
				<?php	/*	?><!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#our-tools" data-slide-to="0" class="active"></li>
					<li data-target="#our-tools" data-slide-to="1"></li>
					<li data-target="#our-tools" data-slide-to="2"></li>
				</ol><?php	*/	?><!-- Wrapper for slides -->
			</div>
		</div>
	</div>
</section>
<?php
	return ob_get_clean();
}
add_shortcode('_gallery_grid','_esc_shortcode__gallery_grid');
function _esc_shortcode__gallery_grid( $atts ) {
	$a	=	_esc_shortcode_atts($atts);
	$_images	=	_esc_shortcode__images();
	ob_start();
?>
<section class="esc-gallery-grid clearfix esc-block<?php echo $a['effect'] ?>"<?php echo $a['delay'] ?>>
	<div id="ri-grid" class="ri-grid ri-grid-size-2">
		<img class="ri-loading-image" src="<?php	echo $_images	?>/loading.gif"/>
		<ul>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/about/photo-1.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/about/photo-2.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/about/photo-3.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/1.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/2.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/3.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/4.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/5.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/6.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/7.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/8.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/9.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/10.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/11.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/12.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/13.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/14.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/15.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/16.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/17.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/18.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/19.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/20.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/21.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/22.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/23.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/24.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/25.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/26.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/27.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/28.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/29.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/30.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/31.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/32.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/33.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/34.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/35.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/36.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/37.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/38.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/39.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/40.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/41.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/42.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/43.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/44.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/45.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/46.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/47.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/48.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/49.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/50.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/51.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/52.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/53.jpg"/></a></li>
			<li class="col-sm-4 col-sm-np"><a href="#"><img src="<?php	echo $_images	?>/rotator/54.jpg"/></a></li>
		</ul>
	</div>
</section><?php
	return ob_get_clean();
}
add_shortcode('_gallery','_esc_shortcode__gallery');
function _esc_shortcode__gallery( $atts ) {
	$a	=	_esc_shortcode_atts($atts);
	$_images	=	_esc_shortcode__images();
	ob_start();
?>
<section class="esc-gallery clearfix<?php echo $a['effect'] ?>"<?php echo $a['delay'] ?>>
	<div class="col-sm-4 col-sm-np">
		<div class="ih-item square effect6 top_to_bottom"><a href="#">
			<div class="img"><img src="<?php	echo $_images	?>/work/sc-1.jpg" alt="CASE STUDIES - Monitronics"></div>
			<div class="info">
			<span>icon here</span>
			<h3>CASE STUDIES</h3>
			<p>Monitronics</p>
			</div>
			</a>
		</div>
	</div>
	<div class="col-sm-4 col-sm-np">
		<div class="ih-item square effect6 top_to_bottom">
			<a href="#">
				<div class="img"><img src="<?php	echo $_images	?>/work/sc-2.jpg" alt="CASE STUDIES - Monitronics"></div>
				<div class="info">
					<span>icon here</span>
					<h3>SAMPLE REPORTS</h3>
					<p>Vista Staff</p>
				</div>
			</a>
		</div>
	</div>
	<div class="col-sm-4 col-sm-np">
		<div class="ih-item square effect6 top_to_bottom">
			<a href="#">
				<div class="img"><img src="<?php	echo $_images	?>/work/sc-3.jpg" alt="CASE STUDIES - Monitronics"></div>
				<div class="info">
					<span>icon here</span>
					<h3>DESIGN PORTFOLIO</h3>
					<p>City Home</p>
				</div>
			</a>
		</div>
	</div>
</section><?php
	return ob_get_clean();
}
add_shortcode('_images', '_esc_shortcode__images');
function _esc_shortcode__images() {
	return get_template_directory_uri() . '/images';
}
add_shortcode('_block', '_esc_shortcode__block');
function _esc_shortcode__block( $atts, $content = null ) {
	$a	=	_esc_shortcode_atts($atts);
	ob_start();
?>
<section class="esc-block<?php echo $a['class'] ?>"<?php echo $a['id'] ?>>
	<?php	echo do_shortcode($content)	?>	
</section>
<?php
	return ob_get_clean();
}
add_shortcode('_section', '_esc_shortcode__section');
function _esc_shortcode__section( $atts, $content = null ) {
	$a	=	_esc_shortcode_atts($atts, array('button_title'	=>	'',	'button_link'	=>	''));
	ob_start();
?>
<section class="clearfix section<?php echo $a['effect'].$a['class'] ?>"<?php echo $a['delay'] ?><?php echo $a['id'] ?><?php //echo $a['style'] ?>>
	<div class="container<?php //echo $a['class'] ?>">
		<div class="row">
			<?php	
				$content	= do_shortcode($content);
				echo $content;
			?>
		</div>
<?php	if($a['button_title'])	:	?>
		<a class="btn btn-primary btn-lg" href="<?php	echo $a['button_link'] ?>" role="button"><?php	echo $a['button_title'] ?></a>
<?php	endif;	?>
	</div>
</section>
<?php
	return ob_get_clean();
}
function _esc_shortcode__section_title( $atts, $content = null ) {
	$a	=	_esc_shortcode_atts($atts);
	ob_start();
?>
	<header class="section-header text-center">
		<h2 class="section-title"><?php	echo do_shortcode($content)	?></h2>		
	</header><!-- .section-header -->
<?php
	return ob_get_clean();
}
add_shortcode('_section_title', '_esc_shortcode__section_title');

add_shortcode('_banner','_esc_shortcode__banner');
function _esc_shortcode__banner( $atts, $content = null ) {
	$a	=	_esc_shortcode_atts($atts, array('image'	=>	''));
	$content	=	do_shortcode($content);
	ob_start();
?>
<div class="bg">
	<div class="banner<?php echo $a['effect'] ?>"<?php echo $a['delay'] ?>>
		<div class="container">
			<div class="banner-info text-center<?php echo $a['class'] ?>"><?php	echo $content	?></div>
		</div>
	</div>
</div>
<?php
	return ob_get_clean();
}
add_shortcode('_covers','_esc_shortcode__covers');
function _esc_shortcode__covers( $atts, $content = null ) {
	$a	=	_esc_shortcode_atts($atts, array('image'	=>	''));
	ob_start();
?>
<section class="clearfix section<?php echo $a['effect'].$a['class'] ?>"<?php echo $a['delay'] ?><?php echo $a['id'] ?>>
	<div class="container">
		<div class="row">    
			<div class="carousel carousel-showmanymoveone three slide media-carousel" id="carousel-covers">
				<div class="carousel-inner">
					<div class="item active" data-slide-number="0">
						<div class="col-xs-12 col-sm-6 col-md-4 text-center">
							<a href="#">
								<img src="http://placehold.it/500/0f2d5a/fff/&amp;text=1" class="img-responsive img-circle">
								<h3>Morbi sed</h3>
								Nullam pulvinar et dui sit
							</a>
						</div>
					</div>
					<div class="item" data-slide-number="1">
						<div class="col-xs-12 col-sm-6 col-md-4 text-center">
							<a href="#">
								<img src="http://placehold.it/500/002d5a/fff/&amp;text=2" class="img-responsive img-circle">
								<h3>quis sodales</h3>
								quis tortor molestie
							</a>
						</div>
					</div>
					<div class="item" data-slide-number="2">
						<div class="col-xs-12 col-sm-6 col-md-4 text-center">
							<a href="#">
								<img src="http://placehold.it/500/d6d6d6/333&amp;text=3" class="img-responsive img-circle">
								<h3>laoreet vitae dolor</h3>
								Etiam vitae sollicitudin leo
							</a>
						</div>
					</div>          
					<div class="item" data-slide-number="3">
						<div class="col-xs-12 col-sm-6 col-md-4 text-center">
							<a href="#">
								<img src="http://placehold.it/500/002040/eeeeee&amp;text=4" class="img-responsive img-circle">
								<h3>Nullam sit amet</h3>
								metus ac ante ullamcorper euismod
							</a>
						</div>
					</div>
					<div class="item" data-slide-number="4">
						<div class="col-xs-12 col-sm-6 col-md-4 text-center">
							<a href="#">
								<img src="http://placehold.it/500/0054A6/fff/&amp;text=5" class="img-responsive img-circle">
								<h3>Cras eros erat</h3>
								ornare id dapibus eleifend
							</a>
						</div>
					</div>
					<div class="item" data-slide-number="5">
						<div class="col-xs-12 col-sm-6 col-md-4 text-center">
							<a href="#">
								<img src="http://placehold.it/500/002d5a/fff/&amp;text=6" class="img-responsive img-circle">
								<h3>Etiam non purus</h3>
								at neque pharetra pretium
							</a>
						</div>
					</div>
					<div class="item" data-slide-number="6">
						<div class="col-xs-12 col-sm-6 col-md-4 text-center">
							<a href="#">
								<img src="http://placehold.it/500/eeeeee&amp;text=7" class="img-responsive img-circle">
								<h3>volutpat est</h3>
								scelerisque turpis id
							</a>
						</div>
					</div>
					<div class="item" data-slide-number="7">
						<div class="col-xs-12 col-sm-6 col-md-4 text-center">
							<a href="#">
								<img src="http://placehold.it/500/40a1ff/002040&amp;text=8" class="img-responsive img-circle">
								<h3>amet ultricies</h3>
								Nullam pulvinar et dui sit
							</a>
						</div>
					</div>
				</div>
				<a class="left carousel-control" href="#carousel-covers" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
				<a class="right carousel-control" href="#carousel-covers" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
			</div>
		</div>
	</div>
</section>
<section id="container-carousel-text">
	<div class="container">
		<div class="row">    
		
			<div class="col-sm-8 col-offset-2" id="carousel-text"></div>	
			<div id="slide-content" style="display: none;">
				<div id="slide-content-0">
					<h2>Slider One</h2>
					<p>Lorem Ipsum Dolor</p>
					<p class="sub-text">October 24 2014 - <a href="#">Read more</a></p>
				</div>
				<div id="slide-content-1">
					<h2>Slider Two</h2>
					<p>Lorem Ipsum Dolor</p>
					<p class="sub-text">October 24 2014 - <a href="#">Read more</a></p>
				</div>
				<div id="slide-content-2">
					<h2>Slider Three</h2>
					<p>Lorem Ipsum Dolor</p>
					<p class="sub-text">October 24 2014 - <a href="#">Read more</a></p>
				</div>
				<div id="slide-content-3">
					<h2>Slider Four</h2>
					<p>Lorem Ipsum Dolor</p>
					<p class="sub-text">October 24 2014 - <a href="#">Read more</a></p>
				</div>
				<div id="slide-content-4">
					<h2>Slider Five</h2>
					<p>Lorem Ipsum Dolor</p>
					<p class="sub-text">October 24 2014 - <a href="#">Read more</a></p>
				</div>
				<div id="slide-content-5">
					<h2>Slider Six</h2>
					<p>Lorem Ipsum Dolor</p>
					<p class="sub-text">October 24 2014 - <a href="#">Read more</a></p>
				</div>
				<div id="slide-content-6">
					<h2>Slider Seven</h2>
					<p>Lorem Ipsum Dolor</p>
					<p class="sub-text">October 24 2014 - <a href="#">Read more</a></p>
				</div>
				<div id="slide-content-7">
					<h2>Slider Eight</h2>
					<p>Lorem Ipsum Dolor</p>
					<p class="sub-text">October 24 2014 - <a href="#">Read more</a></p>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
	return ob_get_clean();
}
function _esc_shortcode_covers_wp_footer(){}
//add_action('wp_footer', '_esc_shortcode_covers_wp_footer',200);
//Enable shortcodes in widgets
if ( !is_admin() )
    add_filter('widget_text', 'do_shortcode', 11);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Hotel Sivana</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Resort Inn Responsive , Smartphone Compatible web template , Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>


<!-- //for-mobile-apps -->
{{-- <link href="hotel-css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="hotel-css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="hotel-css/chocolat.css" type="text/css" media="screen">
<link href="hotel-css/easy-responsive-tabs.css" rel='stylesheet' type='text/css'/>
<link rel="stylesheet" href="hotel-css/flexslider.css" type="text/css" media="screen" property="" />
<link rel="stylesheet" href="hotel-css/jquery-ui.css" />
<link href="hotel-css/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="/hotel-js/modernizr-2.6.2.min.js"></script> --}}




<!--fonts-->
@vite(['resources/hotel-js/app.js'])
@vite(['resources/hotel-css/app.css'])

<style>

    .w3layouts-banner-top{
        @foreach ( $banner as $banner )


        background-image: url("/{{ $banner->banner }}");
        @endforeach
    }
</style>`



<link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Federo" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<!--//fonts-->
</head>
<body>


    @if (session('contactmessage'))

    {{ session('contactmessage') }}

    @endif




<!-- header -->
<div class="banner-top">
			<div class="social-bnr-agileits">
				<ul class="social-icons3">
						<li><a href=" {{ $sitesettings->facebook }} " class="fa fa-facebook icon-border facebook"> </a></li>
						<li><a href=" {{ $sitesettings->twitter }} " class="fa fa-twitter icon-border twitter"> </a></li>
					{{-- <li><a href=" {{ $sitesettings->linkedin }} " class="fa fa-linkedin-plus icon-border linkedin"> </a></li> --}}
				</ul>
			</div>
			<div class="contact-bnr-w3-agile">
				<ul>
					<li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:admin@hotelroyalpalace.in"> {{ $sitesettings->email }} </a></li>
					<li><i class="fa fa-phone" aria-hidden="true"></i> {{ $sitesettings->number }} </li>
					<li class="s-bar">
						<div class="search">
							<input class="search_box" type="checkbox" id="search_box">
							<label class="icon-search" for="search_box"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></label>
							<div class="search_form">
								<form action="#" method="post">
									<input type="search" name="Search" placeholder=" " required=" " />
									<input type="submit" value="Search">
								</form>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>
	<div class="w3_navigation">
		<div class="container">
			<nav class="navbar navbar-default">
				<div class="navbar-header navbar-left">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<h1><a class="navbar-brand" href="index.php">{{ $sitesettings->title }}<p class="logo_w3l_agile_caption">Service and Hospitality</p></a></h1>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					<nav class="menu menu--iris">
						<ul class="nav navbar-nav menu__list">
							<li class="menu__item menu__item--current"><a href="" class="menu__link">{{ $navbar->nav_text1 }}</a></li>
							<li class="menu__item"><a href="#about" class="menu__link scroll">  </a></li>
							<li class="menu__item"><a href="#team" class="menu__link scroll">{{ $navbar->nav_text2 }}</a></li>
							<li class="menu__item"><a href="#gallery" class="menu__link scroll">{{ $navbar->nav_text3 }}</a></li>
							<li class="menu__item"><a href="#rooms" class="menu__link scroll">{{ $navbar->nav_text4 }}</a></li>
							<li class="menu__item"><a href="#contact" class="menu__link scroll">{{ $navbar->nav_text5 }}</a></li>
						</ul>
					</nav>
				</div>
			</nav>

		</div>
	</div>
<!-- //header -->
		<!-- banner -->
		<div id="home" class="w3ls-banner">
		<!-- banner-text -->
		<div class="slider">
			<div class="callbacks_container">
				<ul class="rslides callbacks callbacks1" id="slider4">
					<li>
						<div class="w3layouts-banner-top">
							<div class="container">
								<div class="agileits-banner-info">
								<h4>Royal <span>Palace</h4>
									<h3>We know what you love</h3>
										<p>Welcome to our hotels</p>
									<div class="agileits_w3layouts_more menu__item">
										<a href="#" class="menu__link" data-toggle="modal" data-target="#myModal">Learn More</a>
									</div>
								</div>
							</div>
						</div>
					</li>



				</ul>
			</div>
			<div class="clearfix"> </div>
			<!--banner Slider starts Here-->
		</div>
		    <div class="thim-click-to-bottom">
				<a href="#about" class="scroll">
					<i class="fa fa-long-arrow-down" aria-hidden="true"></i>
				</a>
			</div>
	</div>


<!-- //Modal1 -->
<div id="availability-agileits">
<div class="col-md-12 book-form-left-w3layouts">
	<a href="admin/reservation.php"><h2>Recent Trip</h2></a>
</div>

			<div class="clearfix"> </div>
</div>
<!-- banner-bottom -->
	<div class="banner-bottom">
		<div class="container">
			<div class="agileits_banner_bottom">
				<h3><span>Here are Recent Trips</span> Experience a good stay, enjoy fantastic offers</h3>
			</div>
			<div class="w3ls_banner_bottom_grids">
				<ul class="cbp-ig-grid">

                    @foreach ($trips as $trips )


                    <li>
						<div class="w3_grid_effect">
                            {{-- <span class="cbp-ig-icon w3_road"></span> --}}

                            <img src="/{{ $trips->image }}" alt="" width="100px" height="100px">
							<h4 class="cbp-ig-title"> {{ $trips->title }}  </h4>
							<span class="cbp-ig-category">Royal <span>Palace</span>
						</div>
					</li>
                    @endforeach

				</ul>
			</div>
		</div>
	</div>
<!-- //banner-bottom -->
<!-- /about -->
 	<div class="about-wthree" id="about">
		  <div class="container">
				   <div class="ab-w3l-spa">
                            <h3 class="title-w3-agileits title-black-wthree">About Us</h3>
						   <p class="about-para-w3ls"> {{ $sitesettings->detail }}  .</p>
						   <img src="/{{ $sitesettings->about_image }}" class="img-responsive" alt="Hair Salon">
						   <hr>
						   <p class="about-para-w3ls" >  {{ $sitesettings->detail2 }} .</p>
		          </div>
		   	<div class="clearfix"> </div>
    </div>
</div>
 	<!-- //about -->
<!--sevices-->
<div class="col-md-12 book-form-left-w3layouts">
	<a href="admin/reservation.php"><h2> Events</h2></a>
</div>
<div class="advantages">

	<div class="container">

		<div class="advantages-main">
            <div class="col-md-12 ">
            </div>
			<div class="advantage-bottom">

                @foreach ($events as  $events)


				<div class="col-md-6 advantage-grid left-w3ls wow bounceInLeft" data-wow-delay="0.3s">
                 <div class=" d-flex advantage-block  justify-content-center align-item-center" >
                    <img src="/{{ $events->image }} " alt="" width="170px" height="120px">
								</div>
								<h3 style="color: white;" class="text-center">{{ $events->title }}</h3>
								<p style="color: white;" class="text-white text-center"> {{ $events->detail }} </p>
				</div>

                @endforeach

			<div class="clearfix"> </div>
			</div>
		</div>
	</div>
</div>
<!--//sevices-->
<!-- team -->
<!-----   <div class="team" id="team">
	<div class="container">
			<h3 class="title-w3-agileits title-black-wthree">Meet Our Team</h3>
			<div id="horizontalTab">
					<ul class="resp-tabs-list">
					<li>
						<img src="images/teams1.jpg" alt=" " class="img-responsive" />
					</li>
					<li>
						<img src="https://hotelroyalpalace.orgfree.com/images/teams2.jpg" alt=" " class="img-responsive" />
					</li>
					<li>
						<img src="https://hotelroyalpalace.orgfree.com/images/teams3.jpg" alt=" " class="img-responsive" />
					</li>
					<li>
						<img src="https://hotelroyalpalace.orgfree.com/images/teams4.jpg" alt=" " class="img-responsive" />
					</li>
					</ul>
					<div class="resp-tabs-container">
					<div class="tab1">
						<div class="col-md-6 team-img-w3-agile">
						</div>
						<div class="col-md-6 team-Info-agileits">
							<h4>Lucas Jimenez</h4>
							<span>Manager</span>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.Lorem ipsum dolor .</p>
						<div class="social-bnr-agileits footer-icons-agileinfo">
							<ul class="social-icons3">
								<li><a href="#" class="fa fa-facebook icon-border facebook"> </a></li>
								<li><a href="#" class="fa fa-twitter icon-border twitter"> </a></li>
								<li><a href="#" class="fa fa-google-plus icon-border googleplus"> </a></li>
								<li><a href="#" class="fa fa-rss icon-border rss"> </a></li>
							</ul>
						</div>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="tab2">
					<div class="col-md-6 team-img-w3-agile">
						</div>
						<div class="col-md-6 team-Info-agileits">
							<h4>Sarah Connor</h4>
							<span>Receptionist</span>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.Lorem ipsum dolor .</p>
						<div class="social-bnr-agileits footer-icons-agileinfo">
							<ul class="social-icons3">
								<li><a href="#" class="fa fa-facebook icon-border facebook"> </a></li>
								<li><a href="#" class="fa fa-twitter icon-border twitter"> </a></li>
								<li><a href="#" class="fa fa-google-plus icon-border googleplus"> </a></li>
								<li><a href="#" class="fa fa-rss icon-border rss"> </a></li>
							</ul>
						</div>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="tab3">
						<div class="col-md-6 team-img-w3-agile">
						</div>
						<div class="col-md-6 team-Info-agileits">
							<h4>Ivan Simpson</h4>
							<span>Manager</span>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.Lorem ipsum dolor .</p>
						<div class="social-bnr-agileits footer-icons-agileinfo">
							<ul class="social-icons3">
								<li><a href="#" class="fa fa-facebook icon-border facebook"> </a></li>
								<li><a href="#" class="fa fa-twitter icon-border twitter"> </a></li>
								<li><a href="#" class="fa fa-google-plus icon-border googleplus"> </a></li>
								<li><a href="#" class="fa fa-rss icon-border rss"> </a></li>
							</ul>
						</div>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="tab4">
					<div class="col-md-6 team-img-w3-agile">
						</div>
						<div class="col-md-6 team-Info-agileits">
							<h4>Marc Gutierrez</h4>
							<span>Receptionist</span>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.Lorem ipsum dolor .</p>
						<div class="social-bnr-agileits footer-icons-agileinfo">
							<ul class="social-icons3">
								<li><a href="#" class="fa fa-facebook icon-border facebook"> </a></li>
								<li><a href="#" class="fa fa-twitter icon-border twitter"> </a></li>
								<li><a href="#" class="fa fa-google-plus icon-border googleplus"> </a></li>
								<li><a href="#" class="fa fa-rss icon-border rss"> </a></li>
							</ul>
						</div>
						</div>
						<div class="clearfix"> </div>
					</div>
					</div>
			</div>
	</div>
</div> ----->
<!-- //team -->
<!-- Gallery -->
<section class="portfolio-w3ls" id="gallery">
		 <h3 class="title-w3-agileits title-black-wthree">Our Gallery</h3>

         @foreach ($gallery as $gallery )



				<div class="col-md-3 gallery-grid gallery1">
					<a href="https://hotelroyalpalace.orgfree.com/images/g1.jpg" class="swipebox"><img src=" {{ $gallery->image }} " class="img-responsive" alt="/">
						<div class="textbox">
						<h4>Royal <span>Palace</h4>
							<p><i class="fa fa-picture-o" aria-hidden="true"></i></p>
						</div>
					</a>
				</div>

                @endforeach

				<div class="clearfix"> </div>
</section>
<!-- //gallery -->
	 <!-- rooms & rates -->
      <div class="plans-section" id="rooms">
				<div class="container">
				 <h3 class="title-w3-agileits title-black-wthree">Latest Blogs</h3>
						<div class="priceing-table-main">

                            @foreach ($blogs as $blog )



				 <div class="col-md-3 price-grid">
					<div class="price-block agile">
						<div class="price-gd-top">
						<img src="/{{ $blog->image }}" alt=" " class="img-responsive" />
                        <span>Date: {{ $blog->created_at }}</span>
						<h3  > {{ $blog->title }} </h3>
						<p > {{ $blog->content }} </p>
						</div>

						<div class="price-gd-bottom">

							<div class="price-selet">

								<a href="admin/reservation.php" >Read More</a>
							</div>
						</div>
					</div>
				</div>


                @endforeach




				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	 <!--// rooms & rates -->
  <!-- visitors -->
	<div class="w3l-visitors-agile" >
		<div class="container">
                 <h3 class="title-w3-agileits title-black-wthree">What other visitors experienced</h3>
		</div>
		<div class="w3layouts_work_grids">
			<section class="slider">
				<div class="flexslider">
					<ul class="slides">
						<li>
							<div class="w3layouts_work_grid_left">
								<img src="https://hotelroyalpalace.orgfree.com/images/5.jpg" alt=" " class="img-responsive" />
								<div class="w3layouts_work_grid_left_pos">
									<img src="https://hotelroyalpalace.orgfree.com/images/c1.jpg" alt=" " class="img-responsive" />
								</div>
							</div>
							<div class="w3layouts_work_grid_right">
								<h4>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								Worth to come again
								</h4>
								<p>it was pleasure and having good experience.
									jalgaon's best hotel i have known till date...
									Good breakfast and quality of food is good </p>
								<h5>ayesha wankhede</h5>
								<p>Travel</p>
							</div>
							<div class="clearfix"> </div>
						</li>
						<li>
							<div class="w3layouts_work_grid_left">
								<img src="https://hotelroyalpalace.orgfree.com/images/5.jpg" alt=" " class="img-responsive" />
								<div class="w3layouts_work_grid_left_pos">
									<img src="https://hotelroyalpalace.orgfree.com/images/c2.jpg" alt=" " class="img-responsive" />
								</div>
							</div>
							<div class="w3layouts_work_grid_right">
								<h4>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star-o" aria-hidden="true"></i>
								The stay was very pleasant
								</h4>
								<p>Nice hotel to stay, Good food quality and very clean and comfortable hotel.
									Little bit expensive and costlier.
									One of the good quality hotel in Jalgaon.</p>
								<h5>chetra sonawane</h5>
								<p>travel</p>
							</div>
							<div class="clearfix"> </div>
						</li>
						<li>
							<div class="w3layouts_work_grid_left">
								<img src="https://hotelroyalpalace.orgfree.com/images/5.jpg" alt=" " class="img-responsive" />
								<div class="w3layouts_work_grid_left_pos">
									<img src="https://hotelroyalpalace.orgfree.com/images/c3.jpg" alt=" " class="img-responsive" />
								</div>
							</div>
							<div class="w3layouts_work_grid_right">
								<h4>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star-o" aria-hidden="true"></i>
								Rooms are neat and clean
								</h4>
								<p>Staff are friendly and well behaved.
									Basic toiletries and daily water bottles as
									provided in all hotels were missing.</p>
								<h5>aditya chaudhari</h5>
								<p>business</p>
							</div>
							<div class="clearfix"> </div>
						</li>
						<li>
							<div class="w3layouts_work_grid_left">
								<img src="https://hotelroyalpalace.orgfree.com/images/5.jpg" alt=" " class="img-responsive" />
								<div class="w3layouts_work_grid_left_pos">
									<img src="https://hotelroyalpalace.orgfree.com/images/c4.jpg" alt=" " class="img-responsive" />
								</div>
							</div>
							<div class="w3layouts_work_grid_right">
								<h4>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star" aria-hidden="true"></i>
								<i class="fa fa-star-o" aria-hidden="true"></i>
								<i class="fa fa-star-o" aria-hidden="true"></i>
								Food also tasty
								</h4>
								<p>Hotel property is clean and  service is quite good,
									yes restaurant food is also nice. location is convenient
									but quite far fro railway station.
									good </p>
								<h5>Jayesh Baviskar</h5>
								<p>business</p>
							</div>
							<div class="clearfix"> </div>
						</li>
					</ul>
				</div>
			</section>
		</div>
	</div>
  <!-- visitors -->
<!-- contact -->
<section class="contact-w3ls" id="contact">
	<div class="container">
		<div class="col-lg-6 col-md-6 col-sm-6 contact-w3-agile2" data-aos="flip-left">
			<div class="contact-agileits">
				<h4>Contact Us</h4>
				<p class="contact-agile2">Sign Up For Our News Letters</p>
				<form  action="/contact-submit" method="post"   >
					@csrf
                    <div class="control-group form-group">

                            <label class="contact-p1">Full Name:</label>
                            <input type="text" name="name" class="form-control"      id="name" required >
                            <p class="help-block"></p>

                    </div>
                    <div class="control-group form-group">

                            <label class="contact-p1">Email:</label>
                            <input name="email" type="tel" class="form-control" id="phone" required >
							<p class="help-block"></p>

                    </div>
                    <div class="control-group form-group">
                            <label class="contact-p1">Message:</label>
                            <textarea type="text" class="form-control"  name="message" required ></textarea>
							<p class="help-block"></p>

                    </div>

<button type="submit">Submit</button>
                    {{-- <input type="submit" name="sub" value="Send Now" class="btn btn-primary"> --}}
				</form>
							</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 contact-w3-agile1" data-aos="flip-right">
			<h4>Connect With Us</h4>
			<p class="contact-agile1"><strong>Phone :</strong> {{ $sitesettings->number }}</p>
			<p class="contact-agile1"><strong>Email :</strong> <a href="mailto:name@example.com"> {{ $sitesettings->email }} </a></p>
			<p class="contact-agile1"><strong>Address :</strong>  {{ $sitesettings->address }} </p>
			<div class="social-bnr-agileits footer-icons-agileinfo">
				<ul class="social-icons3">
								<li><a href="https://www.facebook.com/hotelroyalpalacejalgaon" class="fa fa-facebook icon-border facebook"> </a></li>
								<li><a href="#" class="fa fa-twitter icon-border twitter"> </a></li>
								<li><a href="#" class="fa fa-google-plus icon-border googleplus"> </a></li>
							</ul>
			</div>
			<div style="width: 100%">
			<iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src={{ $sitesettings->map_link }}>
				<a href="https://www.gps.ie/sport-gps/">swimming watch</a></iframe></div>
		</div>
		<div class="clearfix"></div>
	</div>
</section>
<!-- /contact -->
			<div class="copy">
		        <p>© 2017 Royal <span>Palace . All Rights Reserved | Design by <a href="index.php">Royal <span>Palace</a> </p>
		    </div>
<!--/footer -->
<!-- js -->
<script type="text/javascript" src="/hotel-js/jquery-2.1.4.min.js"></script>
<!-- contact form -->
<script src="/hotel-js/jqBootstrapValidation.js"></script>

<!-- /contact form -->
<!-- Calendar -->
		<script src="/hotel-js/jquery-ui.js"></script>
		<script>
				$(function() {
				$( "#datepicker,#datepicker1,#datepicker2,#datepicker3" ).datepicker();
				});
		</script>
<!-- //Calendar -->
<!-- gallery popup -->
<link rel="stylesheet" href="hotel-css/swipebox.css">
				<script src="/hotel-js/jquery.swipebox.min.js"></script>
					<script type="text/javascript">
						jQuery(function($) {
							$(".swipebox").swipebox();
						});
					</script>
<!-- //gallery popup -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="/hotel-js/move-top.js"></script>
<script type="text/javascript" src="/hotel-js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
<!-- flexSlider -->
				<script defer src="/hotel-js/jquery.flexslider.js"></script>
				<script type="text/javascript">
				$(window).load(function(){
				  $('.flexslider').flexslider({
					animation: "slide",
					start: function(slider){
					  $('body').removeClass('loading');
					}
				  });
				});
			  </script>
			<!-- //flexSlider -->
<script src="/hotel-js/responsiveslides.min.js"></script>
			<script>
						// You can also use "$(window).load(function() {"
						$(function () {
						  // Slideshow 4
						  $("#slider4").responsiveSlides({
							auto: true,
							pager:true,
							nav:false,
							speed: 500,
							namespace: "callbacks",
							before: function () {
							  $('.events').append("<li>before event fired.</li>");
							},
							after: function () {
							  $('.events').append("<li>after event fired.</li>");
							}
						  });

						});
			</script>
		<!--search-bar-->
		<script src="/hotel-js/main.js"></script>
<!--//search-bar-->
<!--tabs-->
<script src="/hotel-js/easy-responsive-tabs.js"></script>
<script>
$(document).ready(function () {
$('#horizontalTab').easyResponsiveTabs({
type: 'default', //Types: default, vertical, accordion
width: 'auto', //auto or any width like 600px
fit: true,   // 100% fit in a container
closed: 'accordion', // Start closed if in accordion view
activate: function(event) { // Callback function if tab is switched
var $tab = $(this);
var $info = $('#tabInfo');
var $name = $('span', $info);
$name.text($tab.text());
$info.show();
}
});
$('#verticalTab').easyResponsiveTabs({
type: 'vertical',
width: 'auto',
fit: true
});
});
</script>
<!--//tabs-->
<!-- smooth scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {

			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear'
			};

		$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>

	<div class="arr-w3ls">
	<a href="#home" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	</div>
<!-- //smooth scrolling -->
<script type="text/javascript" src="/hotel-js/bootstrap-3.1.1.min.js"></script>

<div style="text-align:right;position:fixed;bottom:3px;right:3px;width:100%;z-index:999999;cursor:pointer;line-height:0;display:block;"><a target="_blank" href="https://www.freewebhostingarea.com" title="Free Web Hosting with PHP5 or PHP7"><img alt="Free Web Hosting" src="https://www.freewebhostingarea.com/images/poweredby.png" style="border-width: 0px;width: 180px; height: 45px; float: right;"></a></div>
</body>
</html>



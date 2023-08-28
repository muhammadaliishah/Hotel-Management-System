
@extends('layouts.app-master')
@push('css')
    <link rel="stylesheet" href="{{ asset('home/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
<link rel="stylesheet" href="{{ asset('home/dist/css/adminlte.min.css')}}">
<link rel="stylesheet" href="{{ asset('home/frontend/home/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{ asset('home/frontend/home/css/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
<link rel="stylesheet" href="{{ asset('home/frontend/home/css/style.css')}}">
<style>
        body {
            background: none !important;
        }

        .main_container {
            margin-top: 62px !important;
        }

        .container {
            max-width: 1700px;
            padding-left: 0px;
            padding-right: 0px;
        }
        /*Gallery Settings*/
        .thumb {
            margin-bottom: 15px;
        }

            .thumb:last-child {
                margin-bottom: 0;
            }
            /* CSS Image Hover Effects: https://www.nxworld.net/tips/css-image-hover-effects.html */
            .thumb
            figure img {
                -webkit-filter: grayscale(100%);
                filter: grayscale(100%);
                -webkit-transition: .3s ease-in-out;
                transition: .3s ease-in-out;
            }

            .thumb
            figure:hover img {
                -webkit-filter: grayscale(0);
                filter: grayscale(0);
            }
        /*End Gallery Settings*/

        /* Using supplied code from https://www.reddit.com/r/webdev/comments/3ox80m/how_to_vertical_align_using_vh/ */

        .hero {
            width: 100%;
            min-height: 75vh;
            background: no-repeat fixed url('home/frontend/home/images/main.jpg') center / cover; /* from Unsplash */
            margin-top: 50px;
            /* This is what centers it */
            display: flex;
            justify-content: center;
            align-items: center;
        }

            .hero h1 {
                color: white;
                font-family: 'Museo Sans', Avenir, 'Helvetica Neue', Helvetica, sans-serif;
                text-align: center;
                font-weight:700;
                line-height: 110%;
                text-shadow: 7px -3px black;
			    font-size: 60px;
            }

            .hero .txt-btn{
                position: absolute;
                margin-top: 130px;
            }
            .contactbg{
            	background: url('home/frontend/home/images/loc.jpg') center / cover;
            }
    </style>
@endpush
@section('content')
<section class="hero">
    <h1>Sivana</h1>
        <div class="txt-btn text-white" style="text-align: center; background: black;">
        <p class="ml-4 mr-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
        </div>
</section>
    <div class="row-fluid">
        <div class="col-md-12">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="card-header mt-3" style="text-align:center;background: white;border: none;">
                    <h3 class="text-centre border-bottom text-site">Our Services</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="featured-carousel owl-carousel">
                                <div class="item">
                                    <div class="blog-entry">
                                        <a href="#" class="block-20 d-flex align-items-start" style="background-image: url('home/frontend/home/images/1.jpg');">
                                            <div class="meta-date text-center p-2 bg-site">
                                                <span class="day">17</span>
                                                <span class="mos">Dec.</span>
                                                <span class="yr">2021</span>
                                            </div>
                                        </a>
                                        <div class="text border border-top-0 p-4">
                                    <h3 class="heading "><a class="text-site-2" href="#">The best place to chat and enjoy quality food</a></h3>
                                            <p class="text-site">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                                            <div class="d-flex align-items-center mt-4">
                                            <p class="mb-0"><a href="https://sehathifazat.gog.pk/" class="btn bg-site text-white">Read More <span class="ion-ios-arrow-round-forward"></span></a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="blog-entry">
                                        <a href="#" class="block-20 d-flex align-items-start" style="background-image: url('home/frontend/home/images/2.jpg');">
                                            <div class="meta-date text-center p-2 bg-site">
                                                <span class="day">17</span>
                                                <span class="mos">Dec.</span>
                                                <span class="yr">2021</span>
                                            </div>
                                        </a>
                                        <div class="text border border-top-0 p-4">
                                    <h3 class="heading "><a class="text-site-2" href="#">The best place to chat and enjoy quality food</a></h3>
                                            <p class="text-site">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                                            <div class="d-flex align-items-center mt-4">
                                            <p class="mb-0"><a href="https://sehathifazat.gog.pk/" class="btn bg-site text-white">Read More <span class="ion-ios-arrow-round-forward"></span></a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="blog-entry">
                                        <a href="#" class="block-20 d-flex align-items-start" style="background-image: url('home/frontend/home/images/3.jpg');">
                                            <div class="meta-date text-center p-2 bg-site">
                                                <span class="day">17</span>
                                                <span class="mos">Dec.</span>
                                                <span class="yr">2021</span>
                                            </div>
                                        </a>
                                        <div class="text border border-top-0 p-4">
                                    <h3 class="heading "><a class="text-site-2" href="#">The best place to chat and enjoy quality food</a></h3>
                                            <p class="text-site">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                                            <div class="d-flex align-items-center mt-4">
                                            <p class="mb-0"><a href="https://sehathifazat.gog.pk/" class="btn bg-site text-white">Read More <span class="ion-ios-arrow-round-forward"></span></a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header mt-3" style="text-align:center;background: white;border: none;">
                    <h3 class="text-centre border-bottom text-site">Our Team</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header border-bottom-0 bg-site text-white">
                            Owner
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>Tansir</b></h2>
                                    <p class="text-muted text-sm"><b>About: </b> CO-Founder Sivana </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building text-site"></i></span> Address: Chinarbagh Gilgit</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone text-site"></i></span> Phone #: +923-462745275</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope text-site"></i></span> Email: info@sivana.com</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="home/frontend/home/images/user.png" alt="user-avatar" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-header border-bottom-0 bg-site text-white">
                            Owner
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>Tansir</b></h2>
                                    <p class="text-muted text-sm"><b>About: </b> CO-Founder Sivana </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building text-site"></i></span> Address: Chinarbagh Gilgit</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone text-site"></i></span> Phone #: +923-462745275</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope text-site"></i></span> Email: info@sivana.com</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="home/frontend/home/images/user.png" alt="user-avatar" class="img-circle img-fluid">
                                </div>
                            	</div>
                                </div>
                            </div>
                        </div>
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header border-bottom-0 bg-site text-white">
                            Owner
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>Tansir</b></h2>
                                    <p class="text-muted text-sm"><b>About: </b> CO-Founder Sivana </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building text-site"></i></span> Address: Chinarbagh Gilgit</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone text-site"></i></span> Phone #: +923-462745275</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope text-site"></i></span> Email: info@sivana.com</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="home/frontend/home/images/user.png" alt="user-avatar" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>
                </div>
                <div class="card-header mt-3" style="text-align:center;background: white;border: none;">
                    <h3 class="text-centre border-bottom text-site">Gallery</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="row gallery">
                            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                <a href="home/frontend/home/images/gallery.jpg">
                                    <figure><img class="img-fluid img-thumbnail" src="home/frontend/home/images/4.jpg" alt="Random Image"></figure>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                <a href="home/frontend/home/images/gallery.jpg">
                                    <figure><img class="img-fluid img-thumbnail" src="home/frontend/home/images/5.jpg" alt="Random Image"></figure>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                <a href="home/frontend/home/images/gallery.jpg">
                                    <figure><img class="img-fluid img-thumbnail" src="home/frontend/home/images/6.jpg" alt="Random Image"></figure>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                <a href="home/frontend/home/images/gallery.jpg">
                                    <figure><img class="img-fluid img-thumbnail" src="home/frontend/home/images/7.jpg" alt="Random Image"></figure>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                <a href="home/frontend/home/images/gallery.jpg">
                                    <figure><img class="img-fluid img-thumbnail" src="home/frontend/home/images/8.jpg" alt="Random Image"></figure>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                <a href="home/frontend/home/images/gallery.jpg">
                                    <figure><img class="img-fluid img-thumbnail" src="home/frontend/home/images/4.jpg" alt="Random Image"></figure>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                <a href="home/frontend/home/images/gallery.jpg">
                                    <figure><img class="img-fluid img-thumbnail" src="home/frontend/home/images/5.jpg" alt="Random Image"></figure>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                <a href="home/frontend/home/images/gallery.jpg">
                                    <figure><img class="img-fluid img-thumbnail" src="home/frontend/home/images/6.jpg" alt="Random Image"></figure>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header mt-3" style="text-align:center;background: white;border: none;">
                    <h3 class="text-centre border-bottom text-site">Contact Us</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-center d-flex align-items-center justify-content-center contactbg">
                            <div class="">
                                <p class="lead mb-5">
                                    <strong class="text-site-2" style="font-weight: bold; ">Chinarbagh Gilgit</strong><br />
                                    Food Street Chinarbagh Gilgit Pakistan.<br>
                                    Phone: 00000-0000000<br />
                                    Email: info@sivana.com
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12923.603749911545!2d74.30068999528885!3d35.92492472207869!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38e637c841f6546f%3A0xc6c60bc3c4ec3efa!2sSivana!5e0!3m2!1sen!2s!4v1679394958639!5m2!1sen!2s" height="450" style="border:0;width: inherit;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
                <!-- Remove the container if you want to extend the Footer to full width. -->
        </div>
    </div>
    <!-- /.row -->
    
    <!-- End of .container -->
@endsection
 @push('script')
 <script src="{{ asset('home/frontend/home/js/jquery.min.js')}}"></script>
    <script src="{{ asset('home/frontend/home/js/popper.js')}}"></script>
    <script src="{{ asset('home/frontend/home/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('home/frontend/home/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('home/frontend/home/js/main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
    <script>
        $(document).ready(function () {
            $(".gallery").magnificPopup({
                delegate: "a",
                type: "image",
                tLoading: "Loading image #%curr%...",
                mainClass: "mfp-img-mobile",
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
                }
            });
        });

    </script>
 @endpush
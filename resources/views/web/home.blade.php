@extends('web.layouts.e_master')

@section('title', 'Taj Tailors : Home')

@section('head')
    <link rel="stylesheet" href="{{url('css/sequence-slide.css')}}"/>
    <script type="text/javascript" src="{{url('js/sequence.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
    <style type="text/css">

    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            pagemenuclick = true;
            var sequenceElement = document.getElementById("sequence");
            var options = {
                animateCanvas: true,
                phaseThreshold: true,
                preloader: true,
                reverseWhenNavigatingBackwards: true
            }
            var mySequence = sequence(sequenceElement, options);

            $("#testimonial-slider").owlCarousel({
                items: 2,
                itemsDesktop: [1000, 2],
                itemsDesktopSmall: [980, 1],
                itemsTablet: [768, 1],
                pagination: true,
                navigation: false,
                navigationText: ["", ""],
                autoPlay: true
            });
        });
    </script>
@stop

@section('content')
    <section class="slider_block">
        <div id="sequence" class="seq">
            <div class="seq-screen">
                <ul class="seq-canvas">
                    <li class="seq-in">
                        <div class="seq-model">
                            <img data-seq src="images/coat_banner_img.png" alt="coat"/>
                        </div>

                        <div class="seq-title">
                            <h2 data-seq>Suit and Shirt</h2>
                            <h3 data-seq>Trending in suiting , shirting and more</h3>
                        </div>
                    </li>

                    <li>
                        <div class="seq-model">
                            <img data-seq src="images/sherwani_banner_img.png" alt="sherwani"/>
                        </div>

                        <div class="seq-title">
                            <h2 data-seq>Sherwani</h2>
                            <h3 data-seq>Explore the best styles of traditional and indo-western.</h3>
                        </div>
                    </li>

                    <li>
                        <div class="seq-model">
                            <img data-seq src="images/febric_banner_img.png" alt="febric"/>
                        </div>

                        <div class="seq-title">
                            <h2 data-seq>Febric</h2>
                            <h3 data-seq>Wear your favorite fabric head-to-toe for a quick uplift .</h3>
                        </div>
                    </li>
                </ul>
            </div>

            <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
                <button type="button" class="seq-prev" aria-label="Previous">Previous</button>
                <button type="button" class="seq-next" aria-label="Next">Next</button>
            </fieldset>

            <ul role="navigation" aria-label="Pagination" class="seq-pagination">
                <li><a href="#step1" rel="step1" title="Go to Coat"><img src="{{url('images/coat_banner_img.png')}}"/></a></li>
                <li><a href="#step2" rel="step2" title="Go to Sherwani"><img src="{{url('images/sherwani_banner_img.png')}}"/></a></li>
                <li><a href="#step3" rel="step3" title="Go to Febric"><img src="{{url('images/febric_banner_imgsmall.png')}}"/></a>
                </li>
            </ul>

        </div>
    </section>
    <section class="about_block" id="how_row_block">
        <div class="container">
            <div class="row">
                <div class="main_heading">
                    <div class="main_head_txt">
                        How It Work
                    </div>
                    <div class="border_bottom main_border"></div>
                    <div class="main_subhead">
                        Get perfectly stitched clothes at your doorstep in just 4 steps
                    </div>
                </div>
                <div class="staps_block">
                    <div class="col-sm-3">
                        <div class="staps_brics_block stap1_color">
                            <div class=" icon_upper" style="
    box-shadow: 0 12px 20px -10px rgb(254, 129, 82), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(156, 39, 176, 0.2);
">
                                <i class="mdi mdi-calendar-multiple-check stap_icon1"></i>
                            </div>
                            <h2>Book Appointment</h2>
                            <p>Fill the form on website or call 9589883533</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="staps_brics_block stap4_color">
                            <div class="icon_upper" style="
    box-shadow: 0 12px 20px -10px rgb(45, 148, 255), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(156, 39, 176, 0.2);
">
                                <i class="mdi mdi-cards stap_icon2"></i>
                            </div>
                            <h2>Give/Select Fabric</h2>
                            <p>Give your fabric or choose from our collection</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="staps_brics_block stap2_color">
                            <div class="icon_upper " style="
    box-shadow: 0 12px 20px -10px rgb(255, 108, 224), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(156, 39, 176, 0.2);
">
                                <i class="mdi mdi-format-list-checks stap_icon3"></i>
                            </div>
                            <h2>Get Measured</h2>
                            <p>Get measuremed at your home or office and website</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="staps_brics_block stap3_color ">
                            <div class="icon_upper " style="
    box-shadow: 0 12px 20px -10px rgb(239, 181, 57), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(156, 39, 176, 0.2);
">
                                <i class="mdi mdi-truck-delivery stap_icon4"></i>
                            </div>
                            <h2>Quick Delivery</h2>
                            <p>Delivery within 5-10 days based on garment</p>
                        </div>
                    </div>
                </div>
                <div class="appointment_btn_block">
                    <a class="btn btn-success btn_get_appointment" href="{{url('book_appointment')}}">
                        <i class="mdi mdi-calendar-multiple-check basic_icon_margin"></i>Get Appointment
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="price_box" id="price_row_block">
        <div class="container">
            <div class="row">
                <div class="main_heading">
                    <div class="main_head_txt">
                        Stiching Prices
                    </div>
                    <div class="border_bottom main_border"></div>
                    <div class="main_subhead">
                        Taj Tailors proudly brings you the ultimate experience in confidence, comfort and peace of mind.
                        If you are not satisfied with the fit of your garment we will adjust and replace it for free. No
                        returns needed.
                    </div>
                </div>
                <div class="price_list_block">
                    <div class="price_list_head_block">
                        <div class="price_product_box">
                            <div class="price_prodoct_brics">
                                <b>Product Name</b>
                            </div>
                        </div>
                        <div class="price_basic">
                            <div class="price_basic_brics">
                                <b>Basic Stitching</b>
                            </div>
                        </div>
                        <div class="price_premium">
                            <div class="price_premium_brics">
                                <b>Premium Stitching</b>
                            </div>
                        </div>
                    </div>
                    <div class="price_list_box">
                        <div class="price_list_row">
                            <div class="price_product_box price_product_list_col">
                                2 Piece Suit
                            </div>
                            <div class="price_basic price_list_col">
                                <i class="mdi mdi-currency-inr"></i>4299
                            </div>
                            <div class="price_premium price_list_col">
                                <i class="mdi mdi-currency-inr"></i>6499
                            </div>
                        </div>

                        <div class="price_list_row">
                            <div class="price_product_box price_product_list_col">
                                Tuxedo Suit (2 piece)
                            </div>
                            <div class="price_basic price_list_col">
                                <i class="mdi mdi-currency-inr"></i>4699
                            </div>
                            <div class="price_premium price_list_col">
                                <i class="mdi mdi-currency-inr"></i>6899
                            </div>
                        </div>
                        <div class="price_list_row">
                            <div class="price_product_box price_product_list_col">3 Piece Suit</div>
                            <div class="price_basic price_list_col">
                                <i class="mdi mdi-currency-inr"></i>4699
                            </div>
                            <div class="price_premium price_list_col">
                                <i class="mdi mdi-currency-inr"></i>6899
                            </div>
                        </div>
                        <div class="price_list_row">
                            <div class="price_product_box price_product_list_col">Safari Suit</div>
                            <div class="price_basic price_list_col">
                                <i class="mdi mdi-currency-inr"></i>4699
                            </div>
                            <div class="price_premium price_list_col">
                                <i class="mdi mdi-currency-inr"></i>6899
                            </div>
                        </div>
                        <div class="price_list_row">
                            <div class="price_product_box price_product_list_col">Blazer</div>
                            <div class="price_basic price_list_col">
                                <i class="mdi mdi-currency-inr"></i>4699
                            </div>
                            <div class="price_premium price_list_col">
                                <i class="mdi mdi-currency-inr"></i>6899
                            </div>
                        </div>
                        <div class="price_list_row">
                            <div class="price_product_box price_product_list_col">BandhGala Blazer</div>
                            <div class="price_basic price_list_col">
                                <i class="mdi mdi-currency-inr"></i>4699
                            </div>
                            <div class="price_premium price_list_col">
                                <i class="mdi mdi-currency-inr"></i>6899
                            </div>
                        </div>
                        <div class="price_list_row">
                            <div class="price_product_box price_product_list_col">Tuxedo Blazer</div>
                            <div class="price_basic price_list_col">
                                <i class="mdi mdi-currency-inr"></i>4699
                            </div>
                            <div class="price_premium price_list_col">
                                <i class="mdi mdi-currency-inr"></i>6899
                            </div>
                        </div>
                        <div class="price_list_row">
                            <div class="price_product_box price_product_list_col">Overcoat/Long Coat</div>
                            <div class="price_basic price_list_col">
                                <i class="mdi mdi-currency-inr"></i>4699
                            </div>
                            <div class="price_premium price_list_col">
                                <i class="mdi mdi-currency-inr"></i>6899
                            </div>
                        </div>
                        <div class="price_list_row">
                            <div class="price_product_box price_product_list_col">Shirt</div>
                            <div class="price_basic price_list_col">
                                <i class="mdi mdi-currency-inr"></i>4699
                            </div>
                            <div class="price_premium price_list_col">
                                <i class="mdi mdi-currency-inr"></i>6899
                            </div>
                        </div><div class="price_list_row">
                            <div class="price_product_box price_product_list_col">Trouser</div>
                            <div class="price_basic price_list_col">
                                <i class="mdi mdi-currency-inr"></i>4699
                            </div>
                            <div class="price_premium price_list_col">
                                <i class="mdi mdi-currency-inr"></i>6899
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="home_about" id="review_row_block">
        <div class="container">
            <div class="row">
                <div class="main_heading">
                    <div class="main_head_txt">
                        Coustomer Reviews
                    </div>
                    <div class="border_bottom main_border"></div>
                    <div class="main_subhead">
                        Loved by our customers
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="testimonial-slider" class="owl-carousel testomonial_mainbox">
                        <div class="testimonial">
                            <div class="pic">
                                <img src="images/testominial_img1.jpg" alt="">
                            </div>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer convallis tempus est non
                                fermentum. Nulla ut placerat tellus. Donec faucibus mi eu felis bibendum, eget.
                            </p>
                            <div class="testimonial-content">
                                <a href="#" class="title">Williamson</a>
                                <span class="post">Web Developer</span>
                            </div>
                        </div>
                        <div class="testimonial">
                            <div class="pic">
                                <img src="images/testominial_img2.jpg" alt="">
                            </div>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer convallis tempus est non
                                fermentum. Nulla ut placerat tellus. Donec faucibus mi eu felis bibendum, eget.
                            </p>
                            <div class="testimonial-content">
                                <a href="#" class="title">kristiana</a>
                                <span class="post">Web Designer</span>
                            </div>
                        </div>
                        <div class="testimonial">
                            <div class="pic">
                                <img src="images/testominial_img3.jpg" alt="">
                            </div>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer convallis tempus est non
                                fermentum. Nulla ut placerat tellus. Donec faucibus mi eu felis bibendum, eget.
                            </p>
                            <div class="testimonial-content">
                                <a href="#" class="title">Williamson</a>
                                <span class="post">Web Developer</span>
                            </div>
                        </div>
                        <div class="testimonial">
                            <div class="pic">
                                <img src="images/testominial_img4.jpg" alt="">
                            </div>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer convallis tempus est non
                                fermentum. Nulla ut placerat tellus. Donec faucibus mi eu felis bibendum, eget.
                            </p>
                            <div class="testimonial-content">
                                <a href="#" class="title">kristiana</a>
                                <span class="post">Web Designer</span>
                            </div>
                        </div>
                        <div class="testimonial">
                            <div class="pic">
                                <img src="images/testominial_img3.jpg" alt="">
                            </div>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer convallis tempus est non
                                fermentum. Nulla ut placerat tellus. Donec faucibus mi eu felis bibendum, eget.
                            </p>
                            <div class="testimonial-content">
                                <a href="#" class="title">Williamson</a>
                                <span class="post">Web Developer</span>
                            </div>
                        </div>
                        <div class="testimonial">
                            <div class="pic">
                                <img src="images/testominial_img2.jpg" alt="">
                            </div>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer convallis tempus est non
                                fermentum. Nulla ut placerat tellus. Donec faucibus mi eu felis bibendum, eget.
                            </p>
                            <div class="testimonial-content">
                                <a href="#" class="title">kristiana</a>
                                <span class="post">Web Designer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
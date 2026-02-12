<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>





    <!-- Start Header Area -->
    <header class="header-area">
        <!-- main header start -->
        <div class="main-header d-none d-lg-block">
            <!-- header middle area start -->
            <div class="header-main-area">
                <div class="container">
                    <div class="row align-items-center ptb-30">
                        <!-- header social area start -->
                        <div class="col-lg-4">
                            <div class="header-social-link">
                                <a href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a href="https://www.twitter.com" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a href="https://www.instagram.com" target="_blank"><i class="fa fa-instagram"></i></a>
                                <a href="https://www.youtube.com" target="_blank"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                        <!-- header social area end -->
                        <!-- start logo area -->
                        <div class="col-lg-4">
                            <div class="logo text-center">
                                <a href="index.html">
                                    <img src="assets/img/logo/logo.png" alt="Tribal Vibes by Shubhangi">
                                </a>
                            </div>
                        </div>
                        <!-- start logo area -->
                        <!-- mini cart area start -->
                        <div class="col-lg-4">
                            <div class="header-right d-flex align-items-center justify-content-end">
                                <div class="header-configure-area">
                                    <ul class="nav justify-content-end">
                                        <li class="header-search-container mr-0">
                                            <button class="search-trigger d-block"><i class="pe-7s-search"></i></button>
                                            <form class="header-search-box d-none">
                                                <input type="text" placeholder="Search entire store hire" class="header-search-field">
                                                <button class="header-search-btn"><i class="pe-7s-search"></i></button>
                                            </form>
                                        </li>
                                        <li class="user-hover">
                                            <a href="#">
                                                <i class="pe-7s-user"></i>
                                            </a>
                                            <ul class="dropdown-list">
                                                <li><a href="login.html">login</a></li>
                                                <li><a href="register.html">register</a></li>
                                                <li><a href="my-account.html">my account</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="pe-7s-like"></i>
                                                <div class="notification">0</div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="minicart-btn">
                                                <i class="pe-7s-shopbag"></i>
                                                <div class="notification">2</div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- mini cart area end -->
                    </div>
                    <div class="row">
                        <!-- main menu area start -->
                        <div class="col-12">
                            <div class="main-menu-area sticky">
                                <div class="main-menu">
                                    <!-- main menu navbar start -->
                                    <nav class="desktop-menu">
                                        <ul class="justify-content-center header-style-4">
                                            <li class="active"><a href="index.html">Home</a></li>
                                            <li><a href="about-tribal-vibes.html">About Tribal Vibes</a></li>
                                            <li class="position-static"><a href="#">Categories <i class="fa fa-angle-down"></i></a>
                                                <ul class="megamenu dropdown">
                                                    <li class="mega-title"><a href="product-category.html"><span>Jewellery</span></a>
                                                        <ul>
                                                            <li><a href="product-sub-category.html">Necklaces</a></li>
                                                            <li><a href="product-sub-category.html">Earrings</a></li>
                                                            <li><a href="product-sub-category.html">Finger Rings</a></li>
                                                            <li><a href="product-sub-category.html">Bracelets</a></li>
                                                            <li><a href="product-sub-category.html">Eyeglasses Straps</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mega-title"><a href="product-category.html"><span>Apparels</span></a>
                                                        <ul>
                                                            <li><a href="product-sub-category.html">Tunics</a></li>
                                                            <li><a href="product-sub-category.html">Skirts</a></li>
                                                            <li><a href="product-sub-category.html">Short Kimono</a></li>
                                                            <li><a href="product-sub-category.html">Co-Ord Sets</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mega-title"><a href="product-category.html"><span>Incense Sticks</span></a>
                                                        <ul>
                                                            <li><a href="product-sub-category.html">Rose</a></li>
                                                            <li><a href="product-sub-category.html">Jasmin</a></li>
                                                            <li><a href="product-sub-category.html">Lavender</a></li>
                                                            <li><a href="product-sub-category.html">Sandal Wood</a></li>
                                                            <li><a href="product-sub-category.html">Kesar Chandan</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mega-title"><a href="product-category.html"><span>Handicrafts</span></a>
                                                        <ul>
                                                            <li><a href="product-sub-category.html">Purse</a></li>
                                                            <li><a href="product-sub-category.html">Handbags</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="blog.html">Blog</a></li>
                                            <li><a href="contact-us.html">Contact us</a></li>
                                            <li><a href="reviews.html">Reviews</a></li>
                                        </ul>
                                    </nav>
                                    <!-- main menu navbar end -->
                                </div>
                            </div>
                        </div>
                        <!-- main menu area end -->
                    </div>
                </div>
            </div>
            <!-- header middle area end -->
        </div>
        <!-- main header start -->
        <!-- mobile header start -->
        <!-- mobile header start -->
        <div class="mobile-header d-lg-none d-md-block sticky">
            <!--mobile header top start -->
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="mobile-main-header">
                            <div class="mobile-logo">
                                <a href="index.html">
                                    <img src="assets/img/logo/logo.png" alt="Tribal Vibes by Shubhangi">
                                </a>
                            </div>
                            <div class="mobile-menu-toggler">
                                <div class="mini-cart-wrap">
                                    <a href="cart.html">
                                        <i class="pe-7s-shopbag"></i>
                                        <div class="notification">0</div>
                                    </a>
                                </div>
                                <button class="mobile-menu-btn">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mobile header top start -->
        </div>
        <!-- mobile header end -->
        <!-- mobile header end -->
        <!-- offcanvas mobile menu start -->
        <!-- off-canvas menu start -->
        <aside class="off-canvas-wrapper">
            <div class="off-canvas-overlay"></div>
            <div class="off-canvas-inner-content">
                <div class="btn-close-off-canvas">
                    <i class="pe-7s-close"></i>
                </div>
                <div class="off-canvas-inner">
                    <!-- search box start -->
                    <div class="search-box-offcanvas">
                        <form>
                            <input type="text" placeholder="Search Here...">
                            <button class="search-btn"><i class="pe-7s-search"></i></button>
                        </form>
                    </div>
                    <!-- search box end -->
                    <!-- mobile menu start -->
                    <div class="mobile-navigation">
                        <!-- mobile menu navigation start -->
                        <nav>
                            <ul class="mobile-menu">
                                <li><a href="index.html">Home</a></li>
                                <li><a href="about-tribal-vibes.html">About Tribal Vibes</a></li>
                                <li class="menu-item-has-children"><a href="#">Categories</a>
                                    <ul class="megamenu dropdown">
                                        <li class="mega-title menu-item-has-children"><a href="product-category.html">Jewellery</a>
                                            <ul class="dropdown">
                                                <li><a href="product-sub-category.html">Necklaces</a></li>
                                                <li><a href="product-sub-category.html">Earrings</a></li>
                                                <li><a href="product-sub-category.html">Finger Rings</a></li>
                                                <li><a href="product-sub-category.html">Bracelets</a></li>
                                                <li><a href="product-sub-category.html">Eyeglasses Straps</a></li>
                                            </ul>
                                        </li>
                                        <li class="mega-title menu-item-has-children"><a href="product-category.html">Apparels</a>
                                            <ul class="dropdown">
                                                <li><a href="product-sub-category.html">Tunics</a></li>
                                                <li><a href="product-sub-category.html">Skirts</a></li>
                                                <li><a href="product-sub-category.html">Short Kimono</a></li>
                                                <li><a href="product-sub-category.html">Co-Ord Sets</a></li>
                                            </ul>
                                        </li>
                                        <li class="mega-title menu-item-has-children"><a href="product-category.html">Incense Sticks</a>
                                            <ul class="dropdown">
                                                <li><a href="product-sub-category.html">Rose</a></li>
                                                <li><a href="product-sub-category.html">Jasmin</a></li>
                                                <li><a href="product-sub-category.html">Lavender</a></li>
                                                <li><a href="product-sub-category.html">Sandal Wood</a></li>
                                                <li><a href="product-sub-category.html">Kesar Chandan</a></li>
                                            </ul>
                                        </li>
                                        <li class="mega-title menu-item-has-children"><a href="product-category.html">Handicrafts</a>
                                            <ul class="dropdown">
                                                <li><a href="product-sub-category.html">Purse</a></li>
                                                <li><a href="product-sub-category.html">Handbags</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="contact-us.html">Contact us</a></li>
                                <li><a href="reviews.html">Reviews</a></li>
                            </ul>
                        </nav>
                        <!-- mobile menu navigation end -->
                    </div>
                    <!-- mobile menu end -->
                    <div class="mobile-settings">
                        <ul class="nav">
                            <li>
                                <div class="dropdown mobile-top-dropdown">
                                    <a href="#" class="dropdown-toggle" id="myaccount" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        My Account
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="myaccount">
                                        <a class="dropdown-item text-capitalize" href="my-account.html">my account</a>
                                        <a class="dropdown-item text-capitalize" href="login.html"> login</a>
                                        <a class="dropdown-item text-capitalize" href="register.html">register</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- offcanvas widget area start -->
                    <div class="offcanvas-widget-area">
                        <div class="off-canvas-contact-widget">
                            <ul>
                                <li><i class="fa fa-mobile"></i>
                                    <a href="tel:+91 7219 111 073">+91 7219 111 073</a>
                                </li>
                                <li><i class="fa fa-envelope-o"></i>
                                    <a href="mailto:info@tribalvibes.shop">info@tribalvibes.shop</a>
                                </li>
                            </ul>
                        </div>
                        <div class="off-canvas-social-widget">
                            <a href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="https://www.twitter.com" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="https://www.instagram.com" target="_blank"><i class="fa fa-instagram"></i></a>
                            <a href="https://www.youtube.com" target="_blank"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                    <!-- offcanvas widget area end -->
                </div>
            </div>
        </aside>
        <!-- off-canvas menu end -->
        <!-- offcanvas mobile menu end -->
    </header>




    <main>
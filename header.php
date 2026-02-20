<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="header-area">

        <div class="main-header d-none d-lg-block">
            <div class="header-main-area">
                <div class="container">
                    <div class="row align-items-center ptb-30">
                        <div class="col-lg-4">
                            <?php 
                                if( have_rows('social_links', 'options') ): 
                                    echo '<div class="header-social-link">';
                                        while( have_rows('social_links', 'options') ): the_row(); 
                                            $social_icon = get_sub_field('social_icon');
                                            $social_url = get_sub_field('social_url');
                                            if($social_url) :
                                                echo '<a href="'.$social_url.'" target="_blank"><i class="fa fa-'.$social_icon.'"></i></a>';
                                            endif;
                                        endwhile;
                                    echo '</div>';
                                endif; 
                            ?>
                        </div>
                        <div class="col-lg-4">
                            <div class="logo text-center">
                                <a href="<?php echo site_url(); ?>">
                                    <?php
                                        $logo = get_field('logo', 'options');
                                        if($logo) :
                                            echo '<img src="'.$logo['url'].'" alt="'.$logo['alt'].'">';
                                        endif;
                                    ?>
                                </a>
                            </div>
                        </div>
                        <!-- to do 1-->
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
                                                <div class="header-sec notification"><?php echo WC()->cart->get_cart_contents_count(); ?></div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- to do 1 end -->
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="main-menu-area sticky">
                                <div class="main-menu">
                                    <nav class="desktop-menu">
                                        <?php
                                            wp_nav_menu(array(
                                                'theme_location' => 'header-menu',
                                                'container'      => false,
                                                'menu_class'     => 'justify-content-center header-style-4',
                                                'depth'          => 3,
                                                'walker'         => new Tribal_Desktop_Menu_Walker()
                                            ));
                                        ?>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="mobile-header d-lg-none d-md-block sticky">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="mobile-main-header">
                            <div class="mobile-logo">
                                <a href="<?php echo site_url(); ?>">
                                    <?php
                                        $logo = get_field('logo', 'options');
                                        if($logo) :
                                            echo '<img src="'.$logo['url'].'" alt="'.$logo['alt'].'">';
                                        endif;
                                    ?>
                                </a>
                            </div>
                            <div class="mobile-menu-toggler">
                                <!-- to do 2 -->
                                <div class="mini-cart-wrap">
                                    <a href="cart.html">
                                        <i class="pe-7s-shopbag"></i>
                                        <div class="notification">0</div>
                                    </a>
                                </div>
                                 <!-- to do 2 end -->
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
        </div>

        <aside class="off-canvas-wrapper">
            <div class="off-canvas-overlay"></div>
            <div class="off-canvas-inner-content">
                <div class="btn-close-off-canvas">
                    <i class="pe-7s-close"></i>
                </div>
                <div class="off-canvas-inner">
                    <div class="search-box-offcanvas">
                        <!-- to do 3 -->
                        <form>
                            <input type="text" placeholder="Search Here...">
                            <button class="search-btn"><i class="pe-7s-search"></i></button>
                        </form>
                        <!-- to do 3 end -->
                    </div>
                    <div class="mobile-navigation">
                        <nav>
                            <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'header-menu',
                                    'container' => false,
                                    'menu_class' => 'mobile-menu',
                                    'walker' => new Tribal_Mobile_Menu_Walker()
                                ));
                            ?>
                        </nav>
                    </div>
                    <!-- to do 4 -->
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
                    <!-- to do 4 end -->
                    <div class="offcanvas-widget-area">
                        <div class="off-canvas-contact-widget">
                            <?php
                                $email = get_field('email', 'options');
                                $phone = get_field('phone', 'options');
                                if($email || $phone) :
                                    echo '<ul>';
                                        if($phone) :
                                            echo '<li><i class="fa fa-mobile"></i> <a href="tel:'.$phone.'">'.$phone.'</a> </li>';
                                        endif;
                                        if($email) :
                                            echo '<li><i class="fa fa-envelope-o"></i><a href="mailto:'.$email.'">'.$email.'</a></li>';
                                        endif;
                                    echo '</ul>';
                                endif;
                            ?>
                        </div>
                        <?php 
                            if( have_rows('social_links', 'options') ): 
                                echo '<div class="off-canvas-social-widget">';
                                    while( have_rows('social_links', 'options') ): the_row(); 
                                        $social_icon = get_sub_field('social_icon');
                                        $social_url = get_sub_field('social_url');
                                        if($social_url) :
                                            echo '<a href="'.$social_url.'" target="_blank"><i class="fa fa-'.$social_icon.'"></i></a>';
                                        endif;
                                    endwhile;
                                echo '</div>';
                            endif; 
                        ?>
                    </div>
                </div>
            </div>
        </aside>

    </header>

    <main>
    </main>

    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div>

    <footer class="footer-widget-area">
        <div class="footer-top section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="widget-item">
                            <div class="widget-title">
                                <div class="widget-logo">
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
                            <?php 
                                $footer_about = get_field('footer_about', 'options');
                                if($footer_about) :
                                    echo '<div class="widget-body">'.$footer_about.'</div>';
                                endif;
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget-item">
                            <?php
                                $footer_contact_label = get_field('footer_contact_label', 'options');
                                if($footer_contact_label) :
                                    echo '<h6 class="widget-title">'.$footer_contact_label.'</h6>';
                                endif;
                            ?>
                            <div class="widget-body">
                                <address class="contact-block">
                                    <ul>
                                        <?php 
                                            $address = get_field('address', 'options');
                                            $email = get_field('email', 'options');
                                            $phone = get_field('phone', 'options');
                                            if($address):
                                                echo '<li><i class="pe-7s-home"></i> '.$address.'</li>';
                                            endif;
                                            if($email) :
                                                echo '<li><i class="pe-7s-mail"></i> <a href="mailto:'.$email.'">'.$email.' </a></li>';
                                            endif;
                                            if($phone) :
                                                echo '<li><i class="pe-7s-call"></i> <a href="tel:'.$phone.'">'.$phone.'</a></li>';
                                            endif;
                                        ?>
                                    </ul>
                                </address>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget-item">
                            <?php
                                $footer_menu_label = get_field('footer_menu_label', 'options');
                                if($footer_menu_label) :
                                    echo '<h6 class="widget-title">'.$footer_menu_label.'</h6>';
                                endif;
                            ?>
                            <div class="widget-body">
                                <?php
                                    wp_nav_menu(array(
                                        'theme_location' => 'footer-menu',
                                        'container' => false,
                                        'menu_class' => 'info-list',
                                    ));
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget-item">
                            <?php 
                                $footer_social_label = get_field('footer_social_label', 'options');
                                if($footer_social_label) :
                                    echo '<h6 class="widget-title">'.$footer_social_label.'</h6>';
                                endif;

                                if( have_rows('social_links', 'options') ): 
                                    echo '<div class="widget-body social-link">';
                                        while( have_rows('social_links', 'options') ): the_row(); 
                                            $social_icon = get_sub_field('social_icon');
                                            $social_url = get_sub_field('social_url');
                                            if($social_url) :
                                                echo '<a href="'.$social_url.'" target="_blank"><i class="fa fa-'.$social_icon.'"></i></a>';
                                            endif;
                                        endwhile;
                                    echo '</div>';
                                endif; 
                                
                                $footer_payment = get_field('footer_payment', 'options');
                                if($footer_payment) :
                                    echo '<div class="footer-payment mt-20"><img src="'.$footer_payment['url'].'" alt="'.$footer_payment['alt'].'"> </div>';
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?php
                            $footer_copyright = get_field('footer_copyright', 'options');
                            if($footer_copyright) :
                                echo '<div class="copyright-text text-center">'.$footer_copyright.'</div>';
                            endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>



    <!-- to do 5 -->
    <!-- Quick view modal start -->
    <div class="modal" id="quick_view">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider">
                                    <div class="pro-large-img img-zoom">
                                        <img src="assets/img/product/product-details-img1.jpg" alt="product-details" />
                                    </div>
                                    <div class="pro-large-img img-zoom">
                                        <img src="assets/img/product/product-details-img2.jpg" alt="product-details" />
                                    </div>
                                    <div class="pro-large-img img-zoom">
                                        <img src="assets/img/product/product-details-img3.jpg" alt="product-details" />
                                    </div>
                                    <div class="pro-large-img img-zoom">
                                        <img src="assets/img/product/product-details-img4.jpg" alt="product-details" />
                                    </div>
                                    <div class="pro-large-img img-zoom">
                                        <img src="assets/img/product/product-details-img5.jpg" alt="product-details" />
                                    </div>
                                </div>
                                <div class="pro-nav slick-row-10 slick-arrow-style">
                                    <div class="pro-nav-thumb">
                                        <img src="assets/img/product/product-details-img1.jpg" alt="product-details" />
                                    </div>
                                    <div class="pro-nav-thumb">
                                        <img src="assets/img/product/product-details-img2.jpg" alt="product-details" />
                                    </div>
                                    <div class="pro-nav-thumb">
                                        <img src="assets/img/product/product-details-img3.jpg" alt="product-details" />
                                    </div>
                                    <div class="pro-nav-thumb">
                                        <img src="assets/img/product/product-details-img4.jpg" alt="product-details" />
                                    </div>
                                    <div class="pro-nav-thumb">
                                        <img src="assets/img/product/product-details-img5.jpg" alt="product-details" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="product-details-des">
                                    <div class="manufacturer-name">
                                        <a href="product-details.html">HasTech</a>
                                    </div>
                                    <h3 class="product-name">Handmade Golden Necklace</h3>
                                    <div class="ratings d-flex">
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <div class="pro-review">
                                            <span>1 Reviews</span>
                                        </div>
                                    </div>
                                    <div class="price-box">
                                        <span class="price-regular"><i class="fa fa-inr"></i> 70.00</span>
                                        <span class="price-old"><del><i class="fa fa-inr"></i> 90.00</del></span>
                                    </div>
                                    <h5 class="offer-text"><strong>Hurry up</strong>! offer ends in:</h5>
                                    <div class="product-countdown" data-countdown="2022/12/20"></div>
                                    <div class="availability">
                                        <i class="fa fa-check-circle"></i>
                                        <span>200 in stock</span>
                                    </div>
                                    <p class="pro-desc">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna.</p>
                                    <div class="quantity-cart-box d-flex align-items-center">
                                        <h6 class="option-title">qty:</h6>
                                        <div class="quantity">
                                            <div class="pro-qty"><input type="text" value="1"></div>
                                        </div>
                                        <div class="action_link">
                                            <a class="btn btn-cart2" href="#">Add to cart</a>
                                        </div>
                                    </div>
                                    <div class="useful-links">
                                        <a href="compare.html" data-bs-toggle="tooltip" title="Compare"><i class="pe-7s-refresh-2"></i>compare</a>
                                        <a href="wishlist.html" data-bs-toggle="tooltip" title="Wishlist"><i class="pe-7s-like"></i>wishlist</a>
                                    </div>
                                    <div class="like-icon">
                                        <a class="facebook" href="https://www.facebook.com" target="_blank"><i class="fa fa-facebook"></i>like</a>
                                        <a class="twitter" href="https://www.twitter.com" target="_blank"><i class="fa fa-twitter"></i>tweet</a>
                                        <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                        <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- product details inner end -->
                </div>
            </div>
        </div>
    </div>
    <!-- to do 5 end -->








    <div class="offcanvas-minicart-wrapper">
        <div class="minicart-inner">
            <div class="offcanvas-overlay"></div>
            <div class="minicart-inner-content">
                <div class="minicart-close">
                    <i class="pe-7s-close"></i>
                </div>
                <?php if ( WC()->cart && ! WC()->cart->is_empty() ) : ?>
                    <div class="minicart-content-box">
                        <?php get_template_part('includes/ajax/minicart');  ?>
                        <div class="minicart-pricing-box">
                            <ul>
                                <li>
                                    <span>sub-total</span>
                                    <span>
                                        <strong><?php echo WC()->cart->get_cart_subtotal(); ?></strong>
                                    </span>
                                </li>
                                <li>
                                    <span>Shipping</span>
                                    <span>
                                        <strong>
                                            <?php 
                                                $shipping_total = WC()->cart->get_shipping_total();
                                                echo wc_price( $shipping_total );
                                            ?>
                                        </strong>
                                    </span>
                                </li>
                                <li class="total">
                                    <span>total</span>
                                    <span>
                                        <strong><?php echo WC()->cart->get_total(); ?></strong>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <?php
                            $cart_url     = wc_get_cart_url();
                            $checkout_url = wc_get_checkout_url();
                        ?>
                        <div class="minicart-button">
                            <a href="<?php echo $cart_url; ?>"><i class="fa fa-shopping-cart"></i> View Cart</a>
                            <a href="<?php echo $checkout_url; ?>"><i class="fa fa-share"></i> Checkout</a>
                        </div>
                    </div>
                <?php else : ?>
                    <li class="minicart-item empty">
                        <p><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>
                    </li>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
<?php wp_footer(); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfmCVTjRI007pC1Yk2o2d_EhgkjTsFVN8"></script>
</body>
</html>
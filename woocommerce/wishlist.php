<?php get_template_part('template/breadcrumb'); ?>

<div class="wishlist-main-wrapper section-padding">
    <div class="container">
        <div class="section-bg-color">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table table-responsive">
                        <?php

                            do_action( 'yith_wcwl_wishlist_before_wishlist_content', $var );
                            
                            do_action( 'yith_wcwl_wishlist_main_wishlist_content', $var );
                            
                            do_action( 'yith_wcwl_wishlist_after_wishlist_content', $var );

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    add_action( 'woocommerce_before_thankyou', function() {
        get_template_part( 'template/breadcrumb' );
        echo '<section class="thankyou-page section-padding"><div class="container"><div class="row align-items-center justify-content-center"><div class="col-lg-12">';
    }, 1 );

    add_action( 'woocommerce_after_thankyou', function() {
        echo '</section></div></div></div>';
    }, 999 );

?>
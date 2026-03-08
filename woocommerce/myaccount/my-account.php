<?php get_template_part('template/breadcrumb');  ?>

<?php
defined( 'ABSPATH' ) || exit;
$current_user = wp_get_current_user();
global $wp;
?>

<div class="my-account-wrapper section-padding">
    <div class="container">
        <div class="section-bg-color">
            <div class="row">
                <div class="col-lg-12">
                    <div class="myaccount-page-wrapper">
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                               <?php do_action( 'woocommerce_account_navigation' ); ?>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                    <div class="myaccount-content">
                                        <?php do_action( 'woocommerce_account_content' ); ?>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
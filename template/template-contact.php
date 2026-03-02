<?php 
/* Template Name: Contact page */ 
/* Template Post Type: page */ 
?>
<?php get_header(); ?>

    <?php get_template_part('template/breadcrumb');  ?>

    <?php
        $map_iframe_src = get_field('map_iframe_src');
        $form_shortcode = get_field('form_shortcode');
        $form_title = get_field('form_title');
        $address = get_field('address', 'option');
        $email = get_field('email', 'option');
        $phone = get_field('phone', 'option');
        $working_hours = get_field('working_hours', 'option');
    ?>
    <?php
        if($map_iframe_src) :
            echo'<div class="map-area section-padding">
                    <iframe src="'.$map_iframe_src.'" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>';
        endif;
    ?>
       
    <div class="contact-area section-padding pt-0">
        <div class="container">
            <div class="row justify-content-center">
                <?php  if($form_shortcode) : ?>
                    <div class="col-lg-6">
                        <div class="contact-message">
                            <?php
                                if($form_title) :
                                    echo '<h4 class="contact-title">'.$form_title.'</h4>';
                                endif;
                                echo do_shortcode($form_shortcode);
                            ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($address || $email || $phone || $working_hours) : ?>
                    <div class="col-lg-6">
                        <div class="contact-info">
                            <h4 class="contact-title">Contact Us</h4>
                            <ul>
                                <?php
                                    if($address) :
                                        echo '<li><i class="fa fa-fax"></i> Address :  '.$address.'</li>';
                                    endif;
                                    if($email) :
                                        echo '<li><i class="fa fa-phone"></i> E-mail : <a href="mailto:'.$email.'"> '.$email.' </a></li>';
                                    endif;
                                    if($phone) :
                                        echo '<li><i class="fa fa-envelope-o"></i> Phone : <a href="tel:'.$phone.'"> '.$phone.' </a></li>';
                                    endif;
                                ?>
                            </ul>
                            <?php 
                                if($working_hours) :
                                    echo '<div class="working-time"> <h6>Working Hours</h6> '.$working_hours.' </div>';
                                endif;
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>
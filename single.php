<?php

get_header();

    get_template_part('template/hero-cpt-page');

    echo '<section class="resources appearance-default padding-tp-default padding-bt-default">';
        echo '<div class="container">';
            echo '<div class="content">';
                the_content();
            echo '</div>';
        echo '</div>';
    echo '</section>';

    get_template_part('template/cta_consultation');
    
get_footer(); 

?>
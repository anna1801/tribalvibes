<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo site_url(); ?>"><i class="fa fa-home"></i></a></li>
                            <?php
                                if ( is_category() || is_product_category() ) {
                                    echo '<li class="breadcrumb-item" aria-current="page">Categories</li>';
                                    $current_term = get_queried_object();
                                    if ( $current_term && in_array( $current_term->taxonomy, array( 'category', 'product_cat' ) ) ) {
                                        $taxonomy = $current_term->taxonomy;
                                        if ($current_term->parent) {
                                            $parent_term = get_term( $current_term->parent, $taxonomy );
                                            if (!is_wp_error($parent_term)) {
                                                $parent_cat_name = $parent_term->name;
                                                $parent_cat_link = get_term_link($parent_term);
                                                if (!is_wp_error($parent_cat_link)) {
                                                    echo '<li class="breadcrumb-item"><a href="' . esc_url($parent_cat_link) . '">' . esc_html($parent_cat_name) . '</a></li>';
                                                }
                                            }
                                            echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html($current_term->name) . '</li>';
    
                                        } else {
                                            echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html($current_term->name) . '</li>';
                                        }
                                    }
                                } elseif ( is_singular('product') ) {
                                    echo '<li class="breadcrumb-item">Categories</li>';
                                    $terms = get_the_terms( $post->ID, 'product_cat' );
                                    if ( $terms && ! is_wp_error( $terms ) ) {
                                        $main_term = null;
                                        foreach ( $terms as $term ) {
                                            if ( $term->parent != 0 ) {
                                                $main_term = $term;
                                                break;
                                            }
                                        }
                                        if ( ! $main_term ) {
                                            $main_term = $terms[0];
                                        }
                                        if ( $main_term->parent ) {
                                            $parent_term = get_term( $main_term->parent, 'product_cat' );
                                            echo '<li class="breadcrumb-item"><a href="' . get_term_link( $parent_term ) . '">' . esc_html( $parent_term->name ) . '</a></li>';
                                        }
                                        echo '<li class="breadcrumb-item"><a href="' . get_term_link( $main_term ) . '">' . esc_html( $main_term->name ) . '</a></li>';
                                        echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';                                        
                                    }
                                } elseif ( is_page() ) {
                                    global $post;
                                    if ( $post->post_parent ) :
                                        $parent_id = $post->post_parent;
                                        $parent_title = get_the_title( $parent_id );
                                        $parent_url   = get_permalink( $parent_id );
                                        echo '<li class="breadcrumb-item"><a href="' . esc_url($parent_url) . '">'.esc_html($parent_title).'</a></li>';
                                    endif;
                                    if ( is_account_page() ) {
                                        if ( is_wc_endpoint_url( 'lost-password' ) ) {
                                            $text = 'Forgot Password';
                                        } elseif ( is_wc_endpoint_url( 'edit-account' ) ) {
                                            $text = 'My Account';
                                        } else {
                                            $text = 'Login';
                                        }
                                        if ( is_user_logged_in() ) {
                                            echo '<li class="breadcrumb-item active" aria-current="page">'. get_the_title().'</li>';
                                        } else {
                                            echo '<li class="breadcrumb-item active" aria-current="page">'.$text.'</li>';
                                        }
                                    } else {
                                        echo '<li class="breadcrumb-item active" aria-current="page">'. get_the_title().'</li>';
                                    }
                                } elseif ( is_month() ) {
                                    echo '<li class="breadcrumb-item" aria-current="page">Blog Archive</li>';
                                    echo '<li class="breadcrumb-item active" aria-current="page">'. single_month_title(' ', false).'</li>';
                                } elseif ( is_tag() ) {
                                    echo '<li class="breadcrumb-item" aria-current="page">Blog Tag</li>';
                                    echo '<li class="breadcrumb-item active" aria-current="page">'. single_tag_title('', false).'</li>';
                                } elseif ( is_single() && get_post_type() === 'post' ) {
                                    echo '<li class="breadcrumb-item" aria-current="page"><a href="'.site_url().'/blog/">Blog</a></li>';
                                    echo '<li class="breadcrumb-item active" aria-current="page">'. get_the_title().'</li>';
                                } elseif ( is_shop() ) { 
                                    $title = woocommerce_page_title(false);
                                    echo '<li class="breadcrumb-item active" aria-current="page">'. $title .'</li>';
                                }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
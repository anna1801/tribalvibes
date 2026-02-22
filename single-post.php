<?php get_header(); ?>

    <?php get_template_part('template/breadcrumb'); ?>

    <div class="blog-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-2">
                    <?php get_template_part('template/blog-sidebar'); ?>
                </div>
                <div class="col-lg-9 order-1">
                    <div class="blog-item-wrapper">
                        <div class="blog-post-item blog-details-post">
                            <figure class="blog-thumb">
                                <?php
                                    if (has_post_thumbnail()) {
                                        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                    } else {
                                        $image_url = get_template_directory_uri().'/assets/images/placeholder.png';
                                    }
                                    echo '<div class="blog-single-slide"><img src="'.$image_url.'" alt="'.get_the_title().'"></div>';
                                ?>
                            </figure>
                            <div class="blog-content">
                                <h3 class="blog-title"> <?php the_title(); ?> </h3>
                                <div class="blog-meta"> <p> <?php the_time('j/F/Y'); ?></p> </div>
                                <div class="entry-summary">
                                   <?php the_content(); ?> 
                                    <?php
                                        $post_tags = get_the_tags();
                                        if ( $post_tags ) :
                                            echo '<div class="tag-line">';
                                            echo '<h6>Tag :</h6>';
                                            $i = 1;
                                            foreach( $post_tags as $tag ) :
                                                if($i != 1) {
                                                    echo ', ';
                                                }
                                                echo '<a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a> ';
                                            $i++;
                                            endforeach;
                                            echo '</div>';
                                        endif;
                                    ?>
                                    <div class="blog-share-link">
                                        <h6>Share :</h6>
                                        <?php
                                            $share_link = get_the_permalink();
                                            $share_title = get_the_title();
                                            if ( has_post_thumbnail( get_the_ID() ) ) {
                                                $share_img = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                                            } else {
                                                $share_img = get_template_directory_uri().'/assets/images/placeholder.png';
                                            }
                                        ?>
                                        <div class="blog-social-icon">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_link; ?>" class="facebook"><i class="fa fa-facebook"></i></a>
                                            <a href="https://twitter.com/intent/tweet?text=<?php echo $share_title; ?>&url=<?php echo $share_link; ?>" class="twitter"><i class="fa fa-twitter"></i></a>
                                            <a href="https://pinterest.com/pin/create/button/?url=<?php echo $share_link; ?>&media=<?php echo $share_img; ?>&description=<?php echo $share_title; ?>" class="pinterest"><i class="fa fa-pinterest"></i></a>
                                            <!-- <a href="#" class="google"><i class="fa fa-google-plus"></i></a> -->
                                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $share_link; ?>" class="linkedin"><i class="fa fa-linkedin"></i></a> 
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

<?php get_footer(); ?>
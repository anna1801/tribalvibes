<div class="blog-main-wrapper section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12 blog-page-list">
                <div class="blog-item-wrapper">
                    <div class="row mbn-30" id="ajax-post-container">
                        <?php 
                            if (have_posts()) : 
                                while (have_posts()) : the_post();
                                    echo '<div class="col-md-6">';
                                        get_template_part('template/blog-list-layout');
                                    echo '</div>';
                                endwhile; 
                            else :
                                echo '<h4 class="text-center">No post found</h4>';
                            endif; 
                        ?>
                    </div>
                    <?php
                        global $wp_query;
                        $paged = max(1, get_query_var('paged'));
                        $total = $wp_query->max_num_pages;
                        if ($total > 1) :
                            echo '<div class="paginatoin-area text-center">';
                                echo '<ul class="pagination-box">';
                                if ($paged > 1) {
                                    echo '<li>
                                            <a class="previous" href="' . get_pagenum_link($paged - 1) . '">
                                                <i class="pe-7s-angle-left"></i>
                                            </a>
                                        </li>';
                                }
                                for ($i = 1; $i <= $total; $i++) {
                                    $active = ($i == $paged) ? 'active' : '';
                                    echo '<li class="' . $active . '">
                                            <a href="' . get_pagenum_link($i) . '">' . $i . '</a>
                                        </li>';
                                }
                                if ($paged < $total) {
                                    echo '<li>
                                            <a class="next" href="' . get_pagenum_link($paged + 1) . '">
                                                <i class="pe-7s-angle-right"></i>
                                            </a>
                                        </li>';
                                }
                                echo '</ul>';
                            echo '</div>';
                        endif;
                    ?>                        
                </div>
            </div>
        </div>
    </div>
</div>
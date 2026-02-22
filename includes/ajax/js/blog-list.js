jQuery(document).ready(function($){

    function loadposts(page = 1) {
        $.ajax({
            url: ajax_post_obj.ajax_url,
            type: 'POST',
            data: {
                action: 'load_posts',
                page: page,
            },
            success: function(response){
                $('#ajax-post-container').html(response.posts);
                $('#ajax-pagination').html(response.pagination);

                $('html, body').animate({
                    scrollTop: $('#ajax-post-container').offset().top - 100
                }, 300);
            }
        });
    }

    $(document).on('click', '.ajax-post', function(e){
        e.preventDefault();
        var page = $(this).data('page'); console.log(page);
        loadposts(page);
    });

});
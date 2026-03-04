// add
jQuery(document).on('click', '.custom-compare-btn', function(e){
    e.preventDefault();

    var button = jQuery(this);
    if(button.hasClass('added')){
        e.preventDefault();
        return false;
    }
    e.preventDefault();
    var product_id = jQuery(this).data('product-id');

    jQuery.ajax({
        type: 'POST',
        url: myCompareAjax.ajaxurl,
        data: {
            action: 'add_to_compare',
            product_id: product_id
        },
        success: function(response){
            if(response.success && response.data.added){
                button.addClass('added');
                button.html('<i class="fa fa-check-circle" aria-hidden="true"></i> <span class="label">Product added!</span>');
                button.attr('data-bs-original-title', 'Added to Compare')
                      .tooltip('dispose')
                      .tooltip();

                jQuery('.my-compare-count').text(response.data.count);
            }
        }
    });
});

// remove
jQuery(document).on('click', '.remove-compare', function(e){
    e.preventDefault();

    var button = jQuery(this);
    var product_id = button.data('product-id');

    jQuery.ajax({
        type: 'POST',
        url: myCompareAjax.ajaxurl,
        data: {
            action: 'remove_from_compare',
            product_id: product_id
        },
        success: function(response){
            if(response.success){

                button.closest('td').remove();

                location.reload();
                jQuery('.my-compare-count').text(response.data.count);
            }
        }
    });

});
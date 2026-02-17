jQuery(document).ready(function($){

    function loadProducts(page = 1) {
        var attributes = {};
        $('.ajax-attribute:checked').each(function(){
            var attr = $(this).data('attribute');
            if (!attributes[attr]) {
                attributes[attr] = [];
            }
            attributes[attr].push($(this).val());
        });

        var sortby = $('.ajax-sort').val();

        var min_price = parseFloat($('#price_min').val()) || 0;
        var max_price = parseFloat($('#price_max').val()) || 0;

        $.ajax({
            url: ajax_obj.ajax_url,
            type: 'POST',
            data: {
                action: 'load_products',
                page: page,
                cat_id: ajax_obj.cat_id,
                attributes: attributes,
                sortby: sortby,
                min_price: min_price,
                max_price: max_price
            },
            success: function(response){
                $('#ajax-product-container').html(response.products);
                $('#ajax-pagination').html(response.pagination);
                $('.product-amount p').text(response.product_count);

                $('html, body').animate({
                    scrollTop: $('#ajax-product-container').offset().top - 100
                }, 300);
            }
        });
    }

    // Pagination click
    $(document).on('click', '.ajax-page', function(e){
        e.preventDefault();
        var page = $(this).data('page');
        loadProducts(page);
    });

    // Attribute checkbox change
    $(document).on('change', '.ajax-attribute', function(){
        loadProducts(1);
    });

    // Sorting change
    $(document).on('change', '.ajax-sort', function(){ console.log('anna');
        loadProducts(1);
    });

    // Price filter submit
    $(document).on('click', '.filter-btn', function(e){
        e.preventDefault();
        loadProducts(1);
    });
    
    // Initialize jQuery UI slider
    $(".price-range").each(function(){
        var $slider = $(this),
            min = $slider.data('min'),
            max = $slider.data('max');

        $slider.slider({
            range: true,
            min: min,
            max: max,
            values: [min, max],
            slide: function(event, ui){
                $('#amount').val('$' + ui.values[0] + ' - $' + ui.values[1]);
                $('#price_min').val(ui.values[0]);
                $('#price_max').val(ui.values[1]);
            }
        });
        // Hidden inputs to hold slider values
        $slider.after('<input type="hidden" id="price_min" value="'+min+'"><input type="hidden" id="price_max" value="'+max+'">');
        $('#amount').val('₹' + min + ' - ₹' + max);
    });

});
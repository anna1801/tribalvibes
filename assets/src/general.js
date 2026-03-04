// change add to cart button to tick after added ti cart
jQuery(document).ready(function($){
    $(document.body).on('added_to_cart', function(event, fragments, cart_hash, $button){
        if ($button) {
            var originalText = $button.html();
            $button
                .removeClass('loading')
                .addClass('added')
                .html('<i class="fa fa-check"></i>');
                setTimeout(function(){
                    $button
                        .removeClass('added')
                        .html(originalText);
                }, 2000);
        }
    });
});

// update car total based on shipping method
document.addEventListener('DOMContentLoaded', function() {
    const subtotalElem = document.querySelector('.cart-calculate-items .table tbody tr:first-child td span.woocommerce-Price-amount');
    const totalElem = document.querySelector('.cart-calculate-items .table tbody tr.order-total td.total-amount span.woocommerce-Price-amount');
    const shippingInputs = document.querySelectorAll('input.shipping_method');

    function formatCurrency(amount) {
        return '₹' + amount.toFixed(2);
    }
    function updateTotal() {
        let subtotal = parseFloat(subtotalElem.textContent.replace('₹', '')) || 0;
        let shipping = 0;
        shippingInputs.forEach(input => {
            if(input.checked) {
                const label = input.nextElementSibling;
                if(label) {
                    const match = label.textContent.match(/₹([\d,.]+)/);
                    if(match) shipping = parseFloat(match[1].replace(',', '')) || 0;
                }
            }
        });
        const newTotal = subtotal + shipping;
        totalElem.textContent = formatCurrency(newTotal);
    }
    shippingInputs.forEach(input => {
        input.addEventListener('change', updateTotal);
    });
});

// My account Login/Register toggle
jQuery(document).ready(function($){
    var $accountWrapper = $('#custom_login_register');
    if (!$accountWrapper.length) return;
    var $breadcrumb = $('.breadcrumb-item.active');
    $accountWrapper.find('#woo_register_form').hide();
    $breadcrumb.text('Login');
    $accountWrapper.on('click', '#create_account', function(e){
        e.preventDefault();
        $accountWrapper.find('#woo_login_form').hide();
        $accountWrapper.find('#woo_register_form').fadeIn();
        $breadcrumb.text('Register');
    });
    $accountWrapper.on('click', '#login_account', function(e){
        e.preventDefault();
        $accountWrapper.find('#woo_register_form').hide();
        $accountWrapper.find('#woo_login_form').fadeIn();
        $breadcrumb.text('Login');
    });
});

// Tooltip for whishlist button
jQuery(document).ready(function ($) {
    function initWishlistTooltip() {
        $('.useful-links .yith-wcwl-add-to-wishlist-button').each(function () {
            var $btn = $(this);
            var isAdded = $btn.hasClass('yith-wcwl-add-to-wishlist-button--added');
            var tooltipText = isAdded ? 'Added to Wishlist' : 'Wishlist';
            $btn.attr({
                'data-bs-toggle': 'tooltip',
                'data-bs-placement': 'top',
                'title': tooltipText
            });
            if ($btn.data('bs.tooltip')) {
                $btn.data('bs.tooltip').dispose();
            }
            if (typeof bootstrap !== 'undefined') {
                new bootstrap.Tooltip(this);
            }
        });
    }
    initWishlistTooltip();
    $(document).on('yith_wcwl_init added_to_wishlist removed_from_wishlist', function () {
        initWishlistTooltip();
    });
});
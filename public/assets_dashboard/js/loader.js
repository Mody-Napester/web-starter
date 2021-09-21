// Loaders
var loader = '<div class="loading"><div class="loader"></div></div>';
function addLoader(selector = 'body') {
    if(selector !== 'body'){
        $(selector).css({
            position : 'relative'
        });
    }

    $(selector).append(loader);
}
function removeLoader() {
    $('.loading').hide(200).remove();
}

// Button
$(document).on('click', '.fire-loader-button', function (e) {
    e.preventDefault();
    addLoader();
    $(this).parents('form').submit();
});

// Anchor
$(document).on('click', '.fire-loader-anchor', function (e) {
    e.preventDefault();
    addLoader();
    window.location = $(this).attr('href');
});

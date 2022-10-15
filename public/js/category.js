jQuery(document).ready(function() {

    getCategoryAjaxData();

    //Categories Links 
    $(document).on('click', '.cat_links .pagination a', function(event) {
        event.preventDefault();

        var page = $(this).attr('href').split('page=')[1];
        $('#catFltrPage').val(page);
        getCategoryAjaxData();
    });

    $(document).on('change', '.cat_fltr', function(event) {
        $('#catFltrPage').val(1);
        getCategoryAjaxData();
    });
});

function getCategoryAjaxData() {
    $('.loaderOverlay').fadeIn();

    jQuery.ajax({
        url: "/get_categories",
        data: $("#catFilterform").serializeArray(),
        method: 'POST',
        dataType: 'html',
        success: function(response) {
            $('.loaderOverlay').fadeOut();
            $("#all_categories").html(response);
        }
    });
}

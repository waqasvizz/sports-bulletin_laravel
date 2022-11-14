
$(document).on('change', '#category', function(event) {
    getSubCategoryList();
});

function getSubCategoryList() {
    $('.loaderOverlay').fadeIn();

    jQuery.ajax({
        url: "/get_sub_categories",
        data: $("#news_form").serializeArray(),
        method: 'POST',
        dataType: 'html',
        success: function(response) {
            $('.loaderOverlay').fadeOut();
            $("#sub_category").html(response);
        }
    });
}
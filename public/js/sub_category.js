jQuery(document).ready(function() {

    var path = $(location).attr("pathname");
    if (path === '/sub_category'){
        // getSubCategoryAjaxData();
    }

    //Sub Categories Links 
    $(document).on('click', '.sub_cat_links .pagination a', function(event) {
        event.preventDefault();

        var page = $(this).attr('href').split('page=')[1];
        $('#subCatFltrPage').val(page);
        getSubCategoryAjaxData();
    });

    $(document).on('change', '.sub_cat_fltr', function(event) {
        $('#subCatFltrPage').val(1);
        getSubCategoryAjaxData();
    });
});

function getSubCategoryAjaxData() {
    $('.loaderOverlay').fadeIn();

    jQuery.ajax({
        url: "/get_sub_categories",
        data: $("#subCatFilterform").serializeArray(),
        method: 'POST',
        dataType: 'html',
        success: function(response) {
            $('.loaderOverlay').fadeOut();
            $("#all_sub_categories").html(response);
        }
    });
}


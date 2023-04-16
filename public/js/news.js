
$(document).on('change', '#category', function(event) {
    getSubCategoryList();
});

function getSubCategoryList() {
    $('.loaderOverlay').fadeIn();

    var sdata = 'category='+ $("#category").val();
    jQuery.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: base_url+"/get_sub_categories",
        data: sdata,
        method: 'POST',
        dataType: 'html',
        success: function(response) {
            $('.loaderOverlay').fadeOut();
            $("#sub_category").html(response);
        }
    });
}
jQuery(document).ready(function() {


    var path = $(location).attr("pathname");
    if (path === '/permission'){
        getPermissionAjaxData();
    }

    //Permissions Links 
    $(document).on('click', '.permission_links .pagination a', function(event) {
        event.preventDefault();

        var page = $(this).attr('href').split('page=')[1];
        $('#permissionFltrPage').val(page);
        getPermissionAjaxData();
    });

    $(document).on('change', '.permission_fltr', function(event) {
        $('#permissionFltrPage').val(1);
        getPermissionAjaxData();
    });

    $(document).on('change', '.asset_type', function(event) {        
        
        $('.image_div').hide();
        $('.icon_div').hide();

        if($(this).val()=='Icon')
            $('.icon_div').show();
        else
            $('.image_div').show();
    });


});

function getPermissionAjaxData() {
    $('.loaderOverlay').fadeIn();

    jQuery.ajax({
        url: "/get_permissions",
        data: $("#permissionFilterform").serializeArray(),
        method: 'POST',
        dataType: 'html',
        success: function(response) {
            $('.loaderOverlay').fadeOut();
            $("#all_permissions").html(response);
        }
    });
}

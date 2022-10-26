jQuery(document).ready(function() {

    var path = $(location).attr("pathname");
    if (path === '/assign_permission'){
        getPermissionAjaxData();
    }

    //Permissions Links 
    $(document).on('click', '.assign_permission_links .pagination a', function(event) {
        event.preventDefault();

        var page = $(this).attr('href').split('page=')[1];
        $('#assignPermissionFltrPage').val(page);
        getPermissionAjaxData();
    });

    $(document).on('change', '.assign_permission_fltr', function(event) {
        $('#assignPermissionFltrPage').val(1);
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
        url: "/get_assign_permissions",
        data: $("#assignPermissionFilterform").serializeArray(),
        method: 'POST',
        dataType: 'html',
        success: function(response) {
            $('.loaderOverlay').fadeOut();
            $("#all_assign_permissions").html(response);
        }
    });
}

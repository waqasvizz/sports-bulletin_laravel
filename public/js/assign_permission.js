jQuery(document).ready(function() {

    var path = $(location).attr("pathname");
    if (path === '/assign_permission'){
        getAssignPermissionAjaxData();
    }

    //Permissions Links 
    $(document).on('click', '.assign_permission_links .pagination a', function(event) {
        event.preventDefault();

        var page = $(this).attr('href').split('page=')[1];
        $('#assignPermissionFltrPage').val(page);
        getAssignPermissionAjaxData();
    });

    $(document).on('change', '.role_fltr', function(event) {
        $('#assignPermissionFltrPage').val(1);
        getAssignPermissionAjaxData();
    });

    $(document).on('change', '.role_fltr', function(event) {        
    
        if($(this).val() == '')
            $('.assign_permissions_list').hide();
        else
            $('.assign_permissions_list').show();
    });
});

function getAssignPermissionAjaxData() {
    $('.loaderOverlay').fadeIn();

    jQuery.ajax({
        url: "/get_assign_permissions",
        data: $("#assignPermissionFilterform").serializeArray(),
        method: 'POST',
        dataType: 'html',
        success: function(response) {
            $('.loaderOverlay').fadeOut();
            $(".assign_permissions_list").html(response);
        }
    });
}

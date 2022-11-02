jQuery(document).ready(function() {

    var path = $(location).attr("pathname");
    if (path === '/sub_menu'){
        // getSubMenuAjaxData();
    }

    //Sub Menus Links 
    $(document).on('click', '.sub_menu_links .pagination a', function(event) {
        event.preventDefault();

        var page = $(this).attr('href').split('page=')[1];
        $('#subMenuFltrPage').val(page);
        getSubMenuAjaxData();
    });

    $(document).on('change', '.sub_menu_fltr', function(event) {
        $('#subMenuFltrPage').val(1);
        getSubMenuAjaxData();
    });
});

function getSubMenuAjaxData() {
    $('.loaderOverlay').fadeIn();

    jQuery.ajax({
        url: "/get_sub_menus",
        data: $("#subMenuFilterform").serializeArray(),
        method: 'POST',
        dataType: 'html',
        success: function(response) {
            $('.loaderOverlay').fadeOut();
            $("#all_sub_menus").html(response);
        }
    });
}


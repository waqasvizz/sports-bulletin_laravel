jQuery(document).ready(function() {


    var path = $(location).attr("pathname");
    if (path === '/menu'){
        getMenuAjaxData();
    }

    //Menus Links 
    $(document).on('click', '.menu_links .pagination a', function(event) {
        event.preventDefault();

        var page = $(this).attr('href').split('page=')[1];
        $('#menuFltrPage').val(page);
        getMenuAjaxData();
    });

    $(document).on('change', '.menu_fltr', function(event) {
        $('#menuFltrPage').val(1);
        getMenuAjaxData();
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

function getMenuAjaxData() {
    $('.loaderOverlay').fadeIn();

    jQuery.ajax({
        url: "/get_menus",
        data: $("#menuFilterform").serializeArray(),
        method: 'POST',
        dataType: 'html',
        success: function(response) {
            $('.loaderOverlay').fadeOut();
            $("#all_menus").html(response);
        }
    });
}

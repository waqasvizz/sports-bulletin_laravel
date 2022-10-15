
jQuery(document).ready(function() {

    getUserAjaxData();

    $(document).on('click', '#delButton, #block_user', function(event) {
        var btn_txt = $(this).text();
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
                title: `Are you sure you want to delete this record?`,
                icon: "warning",
                buttons: ["No", "Yes"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });

        if (btn_txt == 'Block' || btn_txt == 'Unblock') {
            swal({
                title: `Are you sure you want to update this record?`,
                icon: "warning",
                buttons: ["No", "Yes"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        }

    });

    $(document).on('click', '#send_login_button', function(event) {
        var btn_txt = $(this).text();
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        var link = $(this).attr('href');
        // alert(link);

        swal({
            title: `Are you sure you want send login credentials`,
            icon: "warning",
            buttons: ["No", "Yes"],
            dangerMode: true,
        })
        .then(function(value) {
            if (value) {
                window.location.href = link;
            }
        });
    });

    //Users Links 
    $(document).on('click', '.users_links .pagination a', function(event) {
        event.preventDefault();

        var page = $(this).attr('href').split('page=')[1];
        $('#userFltrPage').val(page);
        getUserAjaxData();
    });

    $(document).on('change', '.userfltr', function(event) {
        getUserAjaxData();
    });

});

function getUserAjaxData(data) {
    $('.loaderOverlay').fadeIn();
    jQuery.ajax({
        url: "/get_users",
        data: $("#userFilterform").serializeArray(),
        method: 'POST',
        dataType: 'html',
        success: function(response) {
            $('.loaderOverlay').fadeOut();
            $("#all_users").html(response);
        }
    });
}
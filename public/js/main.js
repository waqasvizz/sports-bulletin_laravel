$(window).on("load", function () {
    if (feather) {
        feather.replace({
            width: 14,
            height: 14,
        });
    }
});

jQuery(document).ready(function () {
    setTimeout(function () {
        $(".alert-success").hide();
    }, 4000);

    $("#theme_layout").click(function (event) {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            method: "post",
            url: "/theme_mode",
            success: function (data) {
                if (data.record.theme_mode == "Light") {
                    $("html").removeClass("dark-layout");
                    $("html").addClass("light-layout");
                    $("i").removeClass("sun");
                    $("i").addClass("moon");
                    $("div").removeClass("menu-dark");
                    $("div").addClass("menu-light");
                    $("nav").removeClass("navbar-dark");
                    $("nav").addClass("navbar-light");
                } else {
                    $("html").addClass("dark-layout");
                    $("html").removeClass("light-layout");
                    $("i").addClass("sun");
                    $("i").removeClass("moon");
                    $("div").addClass("menu-dark");
                    $("div").removeClass("menu-light");
                    $("nav").addClass("navbar-dark");
                    $("nav").removeClass("navbar-light");
                }
            },
            error: function (e) {},
        });
    });

    $(document).on("click", "#delButton, #block_user", function (event) {
        var btn_txt = $(this).text();
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Are you sure you want to delete this record?`,
            icon: "warning",
            buttons: ["No", "Yes"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });

        if (btn_txt == "Block" || btn_txt == "Unblock") {
            swal({
                title: `Are you sure you want to update this record?`,
                icon: "warning",
                buttons: ["No", "Yes"],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        }
    });

    $(document).on(
        "click",
        ".pagination_links .pagination a",
        function (event) {
            event.preventDefault();

            var page = $(this).attr("href").split("page=")[1];
            $("#filterPage").val(page);
            getAjaxData();
        }
    );

    $(document).on("change", ".formFilter", function (event) {
        getAjaxData();
    });

    // =============================================================
    // =============================================================

    var navbar = document.getElementById("navbar");
    var breaking_news = document.getElementById("breaking_news");
    var sticky = navbar.offsetTop;
    // var brkg_sticky = breaking_news.offsetTop;
    $(function () {
        $(".pop").on("click", function () {
            $(".imagepreview").attr("src", $(this).find("img").attr("src"));
            $(".mod_ads_title").text($(this).find("img").attr("ads_title"));
            $(".mod_ads_detail").text($(this).find("img").attr("ads_detail"));
            $("#imagemodal").modal("show");
        });
    });

    window.onscroll = function () {
        myFunction();
    };

    $(".dropdown-menu a.dropdown-toggle").on("click", function (e) {
        if (!$(this).next().hasClass("show")) {
            $(this)
                .parents(".dropdown-menu")
                .first()
                .find(".show")
                .removeClass("show");
        }
        var subMenu = $(this).next(".dropdown-menu");
        subMenu.toggleClass("show");

        $(this)
            .parents("li.nav-item.dropdown.show")
            .on("hidden.bs.dropdown", function (e) {
                $(".dropdown-submenu .show").removeClass("show");
            });

        return false;
    });

    $("#search").on("keyup click", function (e) {
        var search = $("#search").val();
        $.ajax({
            url: "{{ url('search_list') }}",
            data: {
                _token: "{{ csrf_token() }}",
                search: search,
            },
            type: "POST",
            json: true,
        })
            .done(function (data) {
                // console.log(data.records);
                $("#autocomplete").show();
                $("#autocomplete").html(data.records.html);
                // data = JSON.parse(data);
                // console.log('visit added successfully');
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                // console.log('server not responding...');
                // alert('server not responding...');
            });
    });

    document.getElementById("body_html").addEventListener("click", (e) => {
        if (e.target.id == "autocomplete") {
            $(".autocomplete").show();
        } else {
            $(".autocomplete").hide();
        }
    });
});

function getAjaxData(data) {
    $(".loaderOverlay").fadeIn();
    jQuery.ajax({
        url: $("#filterForm").attr("action"),
        data: $("#filterForm").serializeArray(),
        method: $("#filterForm").attr("method"),
        dataType: "html",
        success: function (response) {
            $(".loaderOverlay").fadeOut();
            $("#table_data").html(response);

            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14,
                });
            }
        },
    });
}

function openNav() {
    var nav_width = document.getElementById("mySidenav").style.width;
    if (nav_width == "250px") {
        document.getElementById("mySidenav").style.width = "0";
    } else {
        document.getElementById("mySidenav").style.width = "250px";
    }
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

function myFunction() {
    if (window.pageYOffset >= sticky) {
        // console.log($('#navbarDropdownMenuLink').attr('aria-expanded'));
        if ($("#navbarDropdownMenuLink").attr("aria-expanded") == "false") {
            navbar.classList.add("sticky");
        } else {
            navbar.classList.remove("sticky");
        }
        // breaking_news.classList.add("sticky");
        // $('#breaking_news').css('margin-top','74px');
        // $('main').css('margin-top','120px');
        $("main").css("margin-top", "40px");
    } else {
        navbar.classList.remove("sticky");
        // breaking_news.classList.remove("sticky");
        // $('#breaking_news').css('margin-top','0px');
        $("main").css("margin-top", "0px");
    }
}

;(function () {

    'use strict';

    var owlCarousel = function(){

        $('#slider1').owlCarousel({
            loop: false,
            margin: 10,
            dots: false,
            nav: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        });

        $('#slider2').owlCarousel({
            loop: false,
            margin: 10,
            dots: false,
            nav: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });

        $('#slider3').owlCarousel({
            loop: false,
            margin: 10,
            dots: false,
            nav: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });

    };


    var videos = function() {


        $(document).ready(function () {
            $('#play-video').on('click', function (ev) {
                $(".fh5co_hide").fadeOut();
                $("#video")[0].src += "&autoplay=1";
                ev.preventDefault();

            });
        });


        $(document).ready(function () {
            $('#play-video_2').on('click', function (ev) {
                $(".fh5co_hide_2").fadeOut();
                $("#video_2")[0].src += "&autoplay=1";
                ev.preventDefault();

            });
        });

        $(document).ready(function () {
            $('#play-video_3').on('click', function (ev) {
                $(".fh5co_hide_3").fadeOut();
                $("#video_3")[0].src += "&autoplay=1";
                ev.preventDefault();

            });
        });


        $(document).ready(function () {
            $('#play-video_4').on('click', function (ev) {
                $(".fh5co_hide_4").fadeOut();
                $("#video_4")[0].src += "&autoplay=1";
                ev.preventDefault();

            });
        });
    };

    var googleTranslateFormStyling = function() {
        $(window).on('load', function () {
            $('.goog-te-combo').addClass('form-control');
        });
    };


    var contentWayPoint = function() {
        var i = 0;

        $('.animate-box').waypoint( function( direction ) {

            if( direction === 'down' && !$(this.element).hasClass('animated-fast') ) {

                i++;

                $(this.element).addClass('item-animate');
                setTimeout(function(){

                    $('body .animate-box.item-animate').each(function(k){
                        var el = $(this);
                        setTimeout( function () {
                            var effect = el.data('animate-effect');
                            if ( effect === 'fadeIn') {
                                el.addClass('fadeIn animated-fast');
                            } else if ( effect === 'fadeInLeft') {
                                el.addClass('fadeInLeft animated-fast');
                            } else if ( effect === 'fadeInRight') {
                                el.addClass('fadeInRight animated-fast');
                            } else {
                                el.addClass('fadeInUp animated-fast');
                            }

                            el.removeClass('item-animate');
                        },  k * 50, 'easeInOutExpo' );
                    });

                }, 100);

            }

        } , { offset: '85%' } );
        // }, { offset: '90%'} );
    };


	var goToTop = function() {

		$('.js-gotop').on('click', function(event){
			
			event.preventDefault();

			$('html, body').animate({
				scrollTop: $('html').offset().top
			}, 500, 'swing');
			
			return false;
		});

		$(window).scroll(function(){

			var $win = $(window);
			if ($win.scrollTop() > 200) {
				$('.js-top').addClass('active');
			} else {
				$('.js-top').removeClass('active');
			}

		});
	
	};

	
	$(function(){
		owlCarousel();
		videos();
        contentWayPoint();
		goToTop();
		googleTranslateFormStyling();
	});

}());
function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}



    // =============================================================
    // =============================================================

var navbar = document.getElementById("navbar");
var breaking_news = document.getElementById("breaking_news");
var sticky = navbar.offsetTop;
jQuery(document).ready(function () {
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
            url: base_url+"/search_list",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
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

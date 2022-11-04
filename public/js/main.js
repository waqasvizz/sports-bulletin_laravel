$(window).on('load', function () {
    if (feather) {
        feather.replace({
            width: 14,
            height: 14
        });
    }
});

jQuery(document).ready(function () {
    setTimeout(function () {
        $('.alert-success').hide();
    }, 4000);

    $("#theme_layout").click(function (event) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "post",
            url: "/theme_mode",
            success: function (data) {

                if (data.record.theme_mode == 'Light') {
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
            error: function (e) { }
        });

    });



    // var editor = $('.editor');
    // if (editor.length) {

    //     setTimeout(() => {
    //         var quill = new Quill('.editor', {
    //             bounds: '.editor',
    //             modules: {
    //                 toolbar: '.toolbar'
    //             },
    //             theme: 'snow'
    //         });

    //         // var container = document.getElementById(editorId);
    //         // var editor    = new Quill( container );
    //     }, 3000);
    // }

    // if (commentEditor.length) {
    //     new Quill('.comment-editor', {
    //         modules: {
    //             toolbar: '.comment-toolbar'
    //         },
    //         placeholder: 'Write a Comment... ',
    //         theme: 'snow'
    //     });
    // }

    // var quill = new Quill('.editor', {
    //     modules: {
    //         toolbar: '#toolbar'
    //     },
    //     theme: 'snow'
    // });



    $(document).on('click', '#delButton, #block_user', function (event) {
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

    // $(":textarea.getPos").on("keyup click", function(e) {
    //     var pos = getCursorPos(this);

    //     console.log(" START ==> " + pos.start);
    //     console.log("   END ==> " + pos.end);

    //     // $(this).siblings(".posStart").val(pos.start);
    //     // $(this).siblings(".posEnd").val(pos.end);
    // }).siblings("input").keydown(function(e){
    //     if (e.keyCode == 13){
    //         $(this).siblings("button").click();
    //         e.preventDefault();
    //     }
    // });

    // $("button").click(function(e) {
    //     var par = $(this).parent();
    //     setCursorPos(par.find(":input.getPos")[0], +par.find(".posStart").val(), +par.find(".posEnd").val());
    // });

    // $('.ql-editor').keyup(function() {
    // var keyed = $(this).val().replace(/\n/g, '<br/>');
    // console.log($(this).val().indexOf('*'));

    // console.log(keyed);
    // var keyed = $(this).val().replace(/\n/g, '<br/>');
    // $("#target").html(keyed);
    // }); 


});



// function getCursorPos(input) {
//     if ("selectionStart" in input && document.activeElement == input) {
//         return {
//             start: input.selectionStart,
//             end: input.selectionEnd
//         };
//     }
//     else if (input.createTextRange) {
//         var sel = document.selection.createRange();
//         if (sel.parentElement() === input) {
//             var rng = input.createTextRange();
//             rng.moveToBookmark(sel.getBookmark());
//             for (var len = 0; rng.compareEndPoints("EndToStart", rng) > 0; rng.moveEnd("character", -1)) {
//                 len++;
//             }
//             rng.setEndPoint("StartToStart", input.createTextRange());
//             for (var pos = { start: 0, end: len }; rng.compareEndPoints("EndToStart", rng) > 0; rng.moveEnd("character", -1)) {
//                 pos.start++;
//                 pos.end++;
//             }
//             return pos;
//         }
//     }
//     return -1;
// }

// function setCursorPos(input, start, end) {
//     if (arguments.length < 3) end = start;
//     if ("selectionStart" in input) {
//         setTimeout(function() {
//             input.selectionStart = start;
//             input.selectionEnd = end;
//         }, 1);
//     }
//     else if (input.createTextRange) {
//         var rng = input.createTextRange();
//         rng.moveStart("character", start);
//         rng.collapse();
//         rng.moveEnd("character", end - start);
//         rng.select();
//     }
// }
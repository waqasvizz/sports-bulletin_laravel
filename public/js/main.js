$(window).on('load', function () {
    if (feather) {
        feather.replace({
            width: 14,
            height: 14
        });
    }
});

jQuery(document).ready(function () {

    $("#theme_layout").click(function (event) {
        $.ajax({
            method: "post",
            url: "{{ URL::to('theme_mode') }}",
            data: {
                _token: "{{ csrf_token() }}"
            },

            success: function (data) { },
            error: function (e) { }
        });

    });

    setTimeout(function () {
        // $('.alert-success').hide();
    }, 4000);

    // Add email Shortcodes
    $("#emaiil_short_codes").change(function (e) {
        var email_message = $('.ql-editor').html();
        // alert(email_message);
        $("#editorClone").val(email_message + " " + e.target.value).focus();
        $('.ql-editor').html(email_message + " " + e.target.value);
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

    var quill = new Quill('#editor-container', {
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                ['image', 'code-block'],
                ['link'],
                [{ 'script': 'sub' }, { 'script': 'super' }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['clean']
            ]
        },
        placeholder: 'Enter the message...',
        theme: 'snow'  // or 'bubble'
    });
    quill.on('text-change', function (delta, source) {
        updateHtmlOutput()
    })

    // When the convert button is clicked, update output
    $('#btn-convert').on('click', () => { updateHtmlOutput() })

    // Return the HTML content of the editor
    function getQuillHtml() { return quill.root.innerHTML; }

    // Highlight code output
    function updateHighlight() { hljs.highlightBlock(document.querySelector('#output-html')) }


    function updateHtmlOutput() {
        let html = getQuillHtml();
        // console.log(html);
        document.getElementById('output-html').innerText = html;
        updateHighlight();
    }


    updateHtmlOutput()

    $(document).on('submit', '#email_msg_form', function (event) {
        // $("#editorClone").val($(".editor").html());
        // $("#editorClone").val($('.ql-editor').html());

        var html = quill.root.innerHTML;
        $("#editorClone").val(html);
        // $("#editorClone").val($('#output-html').html());


    });

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
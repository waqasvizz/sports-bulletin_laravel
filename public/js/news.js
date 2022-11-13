
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


updateHtmlOutput();


$(document).on('submit', '#news_form', function (event) {
    // $("#editorClone").val($(".editor").html());
    // $("#editorClone").val($('.ql-editor').html());

    var html = quill.root.innerHTML;
    $("#editorClone").val(html);
    // $("#editorClone").val($('#output-html').html());
});



$(document).on('change', '#category', function(event) {
    getSubCategoryList();
});

function getSubCategoryList() {
    $('.loaderOverlay').fadeIn();

    jQuery.ajax({
        url: "/get_sub_categories",
        data: $("#news_form").serializeArray(),
        method: 'POST',
        dataType: 'html',
        success: function(response) {
            $('.loaderOverlay').fadeOut();
            $("#sub_category").html(response);
        }
    });
}
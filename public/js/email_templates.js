
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


$(document).on('submit', '#email_msg_form', function (event) {
    // $("#editorClone").val($(".editor").html());
    // $("#editorClone").val($('.ql-editor').html());

    var html = quill.root.innerHTML;
    $("#editorClone").val(html);
    // $("#editorClone").val($('#output-html').html());
});



// Add email Shortcodes
$("#emaiil_short_codes").change(function (e) {
    // var email_message = $('.ql-editor').html();
    // // alert(email_message);
    // $("#editorClone").val(email_message + " " + e.target.value).focus();
    // $('.ql-editor').html(email_message + " " + e.target.value);


    quill.focus();
    var symbol = e.target.value;
    var caretPosition = quill.getSelection(true);

    quill.insertText(caretPosition, symbol);
    // $(this).val('');

    // console.log(caretPosition.index);
    // console.log('-----------------');
    // console.log(quill.scroll.length());
    // if (caretPosition.index == 0) {
    //     console.log('if');
    //     quill.insertText(quill.scroll.length(), symbol);
    // } else {
    //     console.log('else');
    //     quill.insertText(caretPosition, symbol);
    // }
});
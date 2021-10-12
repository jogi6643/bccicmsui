


<!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
      tinymce.init({
        selector: '#mytextarea'
      });
</script> -->

<script src="https://cdn.tiny.cloud/1/5orxol55pinopywbk09yrbw1ryxu73rl6q0r6h29utlwe1s9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#mytextarea',
        // file: { title: 'File', items: 'newdocument restoredraft | preview | print ' },
        // edit: { title: 'Edit', items: 'undo redo | cut copy paste | selectall | searchreplace' },
        // view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen' },
        // insert: { title: 'Insert', items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime' },
        // format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align lineheight | forecolor backcolor | removeformat' },
        // tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | code wordcount' },
        // table: { title: 'Table', items: 'inserttable | cell row column | tableprops deletetable' },
        // help: { title: 'Help', items: 'help' },
        plugins: 'fullscreen code undo redo lists link anchor table media mediaembed paste',
        menubar: false,
        // menubar: 'view tools',
        // toolbar: 'fullscreen code undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent'
        toolbar: 'fullscreen code | undo redo | cut copy paste pastetext | styleselect | bold italic underline removeformat | numlist bullist outdent indent | link anchor | table | media',
        audio_template_callback: function(data) {
            return '<audio controls>' + '\n<source src="' + data.source + '"' + (data.sourcemime ? ' type="' + data.sourcemime + '"' : '') + ' />\n' + (data.altsource ? '<source src="' + data.altsource + '"' + (data.altsourcemime ? ' type="' + data.altsourcemime + '"' : '') + ' />\n' : '') + '</audio>';
        }
        // mediaembed_service_url: 'SERVICE_URL',
        // mediaembed_max_width: 450


        // plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
        // toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
        // toolbar_mode: 'floating',
        // tinycomments_mode: 'embedded',
        // tinycomments_author: 'Author name',
    });
</script>

<!-- menu: {
    file: { title: 'File', items: 'newdocument restoredraft | preview | print ' },
    edit: { title: 'Edit', items: 'undo redo | cut copy paste | selectall | searchreplace' },
    view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen' },
    insert: { title: 'Insert', items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime' },
    format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align lineheight | forecolor backcolor | removeformat' },
    tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | code wordcount' },
    table: { title: 'Table', items: 'inserttable | cell row column | tableprops deletetable' },
    help: { title: 'Help', items: 'help' }
  } -->

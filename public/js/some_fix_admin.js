$(document).ready(function () {
    $('#admin_data_table').DataTable({
            "pageLength": 50,
            order: []
        }
    );
});

window.onload = function () {
    let editor = CKEDITOR.replaceAll();
    CKFinder.setupCKEditor(editor);

    // CKEDITOR.editorConfig = function( config ) {
    //     config.language = 'en';
    //     config.width = 850;
    // };
};

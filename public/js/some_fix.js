$(document).on('click', ".show_toggle_invokers", function () {
    $(this.dataset.toShow).fadeToggle();
    $('#s').focus();

});

//anti-bot counter
let ct = 0;

function count_keyup() {
    document.getElementById('countMe').value = ++ct;
}

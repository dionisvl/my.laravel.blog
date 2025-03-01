$(document).on('click', ".show_toggle_invokers", function () {
    $(this.dataset.toShow).fadeToggle();
    $('#s').focus();

});

//anti-bot counter
let ct = 0;

function count_keyup() {
    const elements = document.getElementsByClassName('countMe');
    for (let i = 0; i < elements.length; i++) {
        elements[i].value = ++ct;
        //console.log(elements[i].value);
    }
}

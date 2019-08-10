$(document).on('click',".show_toggle_invokers",function(){
    $(this.dataset.toShow).fadeToggle();
    $('#s').focus();

});
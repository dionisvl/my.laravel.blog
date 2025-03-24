$(document).ready(function () {
  $('#example1').DataTable({
    /* No ordering applied by DataTables during initialisation */
    'order': []
  })
  $('.select2').select2()

  //Date picker
  flatpickr('#datepicker', {
    dateFormat: 'd/m/y',
    defaultDate: 'today'
  })
})

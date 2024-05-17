$(document).on('change', 'table thead [type="checkbox"]', function(e){
    e && e.preventDefault();
    var $table = $(e.target).closest('table'), $checked = $(e.target).is(':checked');
    $('tbody [type="checkbox"]',$table).prop('checked', $checked);
    $("#btn-del-reports").toggle();
  });
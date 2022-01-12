$(document).ready(function () {
    var table = $("#tblservicerequest").DataTable({
"dom": '<"top">rt<"bottom"flpi><"clear">',
"bFilter": false,    
lengthMenu: [10, 5, 20, 50, 100, 200, 500],
"info": false,

"bPaginate":{
  
}, "pagingType": "simple_numbers",
"language": {
"paginate": {
"previous": '<i class="fa fa-caret-left"></i>',
"next":'<i class="fa fa-caret-right"></i>',

},
 "lengthMenu":     "Show _MENU_ Entries",   
}
});
  });
 
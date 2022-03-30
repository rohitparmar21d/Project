$(document).ready(function () {
    
    var base_url = "http://localhost/Helperland/";
    
    adminservicerequest();
    usermanagement();
    fill_option("username",1,2);
    fill_option("customers",1);
    fill_option("sps",2);
   
   function adminservicerequest()
   {
       /* list Service request */
        $.ajax({
            type: "POST",
            url: base_url + "?controller=Helperland&function=adminservicesrequests",
            success: function (response) {
                $(".adminservicerequest").html(response);
                $('#tblSRreq').DataTable({
                    paging: true,
                    "pagingType": "full_numbers",
                    // bFilter: false,
                    ordering: true,
                    searching: false,
                    info: false,
                    "columnDefs": [
                        { "orderable": false, "targets": 1 },
                        { "orderable": false, "targets": 2 },
                        { "orderable": false, "targets": 4 },
                        { "orderable": false, "targets": 7 }
                    ],
                    "oLanguage": {
                        "sInfo": "Total Records: TOTAL"
                    },
                    "dom": '<"top">rt<"bottom"lip><"clear">',
                    responsive: true,
                    "order": []
                });
            }
        });
   }

   function usermanagement()
   {
       /* list User List*/
       $.ajax({
        type: "POST",
        url: base_url + "?controller=Helperland&function=usermanagement",
        success: function (response) {
            $(".usermanagement").html(response);
            $('#tblusermanagement').DataTable({
                    paging: true,
                    "pagingType": "full_numbers",
                    // bFilter: false,
                    ordering: true,
                    searching: false,
                    info: false,
                    "columnDefs": [
                        { "orderable": false, "targets": 1 },
                        { "orderable": false, "targets": 2 },
                        { "orderable": false, "targets": 4 },
                        { "orderable": false, "targets": 7 }
                    ],
                    "oLanguage": {
                        "sInfo": "Total Records: TOTAL"
                    },
                    "dom": '<"top">rt<"bottom"lip><"clear">',
                    responsive: true,
                    "order": []
                });
        }
    });
   }
   /*  Active user*/
   $(document).on ('click', '.letactive', function (e) { 
        e.preventDefault();
        $('.loading').removeClass("d-none");
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Active'
          }).then((result) => {
            if (result.isConfirmed) {
                
                 $.ajax({
                    type: "POST",
                    url:base_url + "?controller=Helperland&function=activeuser",
                    data: { "userid" : this.id },
                    success: function (response) {
                        $('.loading').addClass("d-none");
                        usermanagement();
                        Swal.fire({
                            icon: 'success',
                            title: 'Activated',
                            text:'Activated successfully.',
                            showConfirmButton: false,
                            timer: 1500
                            })

                    }
                });
            }
          })
   });
   /* Deactive User*/ 
   $(document).on ('click', '.letdeactive', function (e) { 
       e.preventDefault();
       $('.loading').removeClass("d-none");
       Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Deactive'
      }).then((result) => {
        if (result.isConfirmed) {
            
             $.ajax({
                type: "POST",
                url:base_url + "?controller=Helperland&function=deactiveuser",
                data: { "userid" : this.id },
                success: function (response) {
                    $('.loading').addClass("d-none");
                    usermanagement();
                    Swal.fire({
                        icon: 'success',
                        title: 'Activated',
                        text:'Deactivated successfully.',
                        showConfirmButton: false,
                        timer: 1500
                        })

                }
            });
        }
      })
   });
   /* Approve SP*/
   $(document).on ('click', '.letapprove', function (e) { 
       e.preventDefault();
       $('.loading').removeClass("d-none");
       $.ajax({
        type: "POST",
        url:base_url + "?controller=Helperland&function=approvesp",
        data: { "userid" : this.id },
        success: function (response) {
            $('.loading').addClass("d-none");
            usermanagement();
            Swal.fire({
                icon: 'success',
                title: 'Approved',
                showConfirmButton: false,
                timer: 1500
                })
        }
    });
   });

   /* Cancel Request From Admin Panel*/
   $(document).on ('click', '.cancelrq', function (e) { 
    e.preventDefault();
    $('.loading').removeClass("d-none");
    Swal.fire({
     title: 'Are you sure?',
     icon: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Yes, Cancel it'
   }).then((result) => {
     if (result.isConfirmed) {
         
          $.ajax({
             type: "POST",
             url:base_url + "?controller=Helperland&function=cancelfromadmin",
             data: { "reqid" : this.id },
             success: function (response) {
                 $('.loading').addClass("d-none");
                 adminservicerequest();;
                 Swal.fire({
                     icon: 'success',
                     text:'Request Cancelled  successfully.',
                     showConfirmButton: false,
                     timer: 1500
                     })

             }
         });
     }
   })
});



$(document).on ('click', '.editreschedule', function (e) {
    $.ajax({
        type: "POST",
        url: base_url + "?controller=Helperland&function=fill_reschedule_servicerequest_detail",
        data: {
                'selectedrequestid' : this.id
        },
        success: function (response) {
            $(".fill_selected_service_request_data").html(response);
        }
    });
});
$(document).on ('click', '.admin-sr-update', function (e) {
    
        var srdate = $("input[name='srdate']").val();
        var srtime = $("input[name='srtime']").val();
        var streetname = $("input[name='streetname']").val();
        var housenumber = $("input[name='housenumber']").val();
        var postalcode = $("input[name='postalcode']").val();
        var city = $("input[name='city']").val();
        var comment = $("textarea[name='reschedulereason']").val();

        if(srdate == "" || srtime == "" || streetname == "" || housenumber == "" || postalcode == "" || city == "" || comment == "")
        {
            $(".admin-error").css('display', 'block');
            $(".admin-error").html("fill all the details.");
        }
        else
        {
            $(".admin-error").html("");
            $.ajax({
                type: "POST",
                url: base_url + "?controller=Helperland&function=reschedule_selected_service_request",
                data: {
                    'srdate' : srdate,
                    'srtime' : srtime,
                    'streetname' : streetname,
                    'housenumber' : housenumber,
                    'postalcode' : postalcode,
                    'city' : city,
                    'comment' : comment,
                    'selectedrequestid' : this.id
                },
                success: function (response) {
                    if(response == 1)
                    {
                        $("#reschedule_admin_modal").modal("hide");
                        Swal.fire({
                            icon: 'error',
                            text: 'You can not reschedule the service because only 1 day remains to start service.',
                            showConfirmButton: false,
                            timer: 1000,
                        })
                    }
                    else
                    {
                        $("#reschedule_admin_modal").modal("hide");
                        Swal.fire({
                            icon: 'success',
                            text: 'request rescheduled successfully.',
                            showConfirmButton: false,
                            timer: 1000,
                        })
                    }
                }
            });
        }
});

function fill_option(classname,typeid1,typeid2="")
{
    $.ajax({
        type: "POST",
        url: base_url + "?controller=Helperland&function=fill_option",
        data: {
            'typeid1':typeid1,
            'typeid2':typeid2
        },
        success: function (response) {
            $("."+classname).append(response);
            $("."+classname).select2();
        }
    });
}

$(".requestformreset").click(function (e) { 
    e.preventDefault();
    $(".postalcodeservierequest").val("");
    $(".serviceidservicereuqest").val("");
    $(".customers").val("1").change();
    $(".sps").val("1").change();
    $(".status").val("0").change();
    $(".fromdateservicereuqest").val("");
    $(".todateservicerequest").val("");
    adminservicerequest();
});
$(".userformreset").click(function (e) { 
    e.preventDefault();
    $(".username").val("0").change();
    $(".usertypeuser").val("0").change();
    $(".mobileuser").val("");
    $(".postalcodeuser").val("");
    $(".emailuser").val("");
    $(".fromdateuser").val("");
    $(".todateuser").val("");
    usermanagement();
});
$(".usertypeuser").select2();
$(".status").select2();
$(".userformsearch").click(function (e) { 
    e.preventDefault();
   var username= $(".username").val();
    var usertype=$(".usertypeuser").val();
    var mobile=$(".mobileuser").val();
    var postalcode=$(".postalcodeuser").val();
    var email=$(".emailuser").val();
   var fromdate= $(".fromdateuser").val();
    var todate=$(".todateuser").val();
    
    $.ajax({
        type: "POST",
        url: base_url + "?controller=Helperland&function=userfilter",
        data: {
            'username':username,
            'usertype':usertype,
            'mobile':mobile,
            'postalcode':postalcode,
            'fromdate':fromdate,
            'todate':todate
        },
        success: function (response) {
            $(".usermanagement").html(response);
            $('#tblusermanagement').DataTable({
                    paging: true,
                    "pagingType": "full_numbers",
                    // bFilter: false,
                    ordering: true,
                    searching: false,
                    info: false,
                    "columnDefs": [
                        { "orderable": false, "targets": 1 },
                        { "orderable": false, "targets": 2 },
                        { "orderable": false, "targets": 4 },
                        { "orderable": false, "targets": 7 }
                    ],
                    "oLanguage": {
                        "sInfo": "Total Records: TOTAL"
                    },
                    "dom": '<"top">rt<"bottom"lip><"clear">',
                    responsive: true,
                    "order": []
                });
        }
    });
});
$(".requestformsearch").click(function (e) { 
    e.preventDefault();
    var serviceid=$(".serviceidservicereuqest").val();
    var postalcode=$(".postalcodeservierequest").val();
    var customer=$(".customers").val();
    var sp=$(".sps").val();
    var status=$(".status").val();
    var fromdate=$(".fromdateservicereuqest").val();
    var todate=$(".todateservicerequest").val();

    $.ajax({
        type: "POST",
        url: base_url + "?controller=Helperland&function=requestfilter",
        data: {
            'serviceid':serviceid,
            'postalcode':postalcode,
            'customer':customer,
            'sp':sp,
            'status':status,
            'fromdate':fromdate,
            'todate':todate
        },
        success: function (response) {
            $(".adminservicerequest").html(response);
            $('#tblSRreq').DataTable({
                paging: true,
                "pagingType": "full_numbers",
                // bFilter: false,
                ordering: true,
                searching: false,
                info: false,
                "columnDefs": [
                    { "orderable": false, "targets": 1 },
                    { "orderable": false, "targets": 2 },
                    { "orderable": false, "targets": 4 },
                    { "orderable": false, "targets": 7 }
                ],
                "oLanguage": {
                    "sInfo": "Total Records: TOTAL"
                },
                "dom": '<"top">rt<"bottom"lip><"clear">',
                responsive: true,
                "order": []
            });
        }
    });
});

});
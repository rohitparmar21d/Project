$(document).ready(function () {
    
    var base_url = "http://localhost/Helperland/";
    var reqIdforreschedule;
    var reqIdfordetailmodal;
    var reqIdforrate;
    
    
    
    
    history();
    dashboard();
    function history()
    {
        /*listing service history */
        $.ajax({
            type: "POST",
            url: base_url + "?controller=Helperland&function=service_history",
            success: function (response) 
            {
                   $(".history").html(response);
                   $(".rateyo").rateYo({
                    starWidth: "20px",
                    readOnly: true
                   });
            }
        });
        
    }
    
    function dashboard()
    {
        /* listing dashboard*/
    $.ajax({
        type: "POST",
        url: base_url + "?controller=Helperland&function=dboard",
        success: function (response) 
        {
               $(".dboard").html(response);
               $(".rateyo").rateYo({
                starWidth: "20px",
                readOnly: true
               });
               $(".dboard tr .td").click(function (e) 
               { 
                    $("#servicedetailmodal").modal("show");
                    reqIdfordetailmodal=e.target.id;
                    $.ajax({
                        type: "POST",
                        url:  base_url + "?controller=Helperland&function=SDmodal",
                        data: {
                        "requId" : reqIdfordetailmodal
                        },
                        success: function (response) {
                            $(".SD").html(response);
                            $(".btn-reschedule").click(function () { 
                                $("#servicedetailmodal").modal("hide");
                                
                            });
                            $(".btn-cancel").click(function () { 
                                $("#servicedetailmodal").modal("hide");
                                
                            });
                        }
                });
               });
        }
    });
    
    }
    

   

    /*service history modals */
    $(".history").click(function (e) { 
        reqIdforrate=e.target.id;
        $.ajax({
            type: "POST",
            url: base_url + "?controller=Helperland&function=rate_sp",
            data: {
                "reqId" : reqIdforrate
            },
            success: function (response) {
                var ontimearrival=0;
                var friendly=0;
                var quality=0;
                $(".ratesp").html(response);
                $(".rate_modal_head").rateYo({
                    starWidth: "20px",
                    readOnly: true
                   });
                $(".on_time_arrrival").rateYo({
                     starWidth: "20px"
                    });
                $(".on_time_arrrival").rateYo().on("rateyo.change", function (e, data) { 
                    ontimearrival = data.rating;
                });
                $(".friendly").rateYo({
                        starWidth: "20px"
                       });
                $(".friendly").rateYo().on("rateyo.change", function (e, data) {
                    friendly = data.rating;
                });
                $(".quality").rateYo({
                        starWidth: "20px"
                       });
                $(".quality").rateYo().on("rateyo.change", function (e, data) {
                    quality = data.rating;
                });
                $(".btn-ratesp-submit").click(function (e) { 
                    var feedback=$(".rate-feedback").val();
                    $.ajax({
                        type: "POST",
                        url: base_url + "?controller=Helperland&function=submitrate",
                        data: {
                            "SRId" : e.target.id,
                            "friendly" : friendly,
                            "quality" : quality,
                            "ontimearrival" : ontimearrival,
                            "feedback" : feedback
                        },
                        success: function (response) {
                            history();
                            $("#ratesp_modal").modal("hide");
                            Swal.fire({
                                icon: 'success',
                                title: 'Done',
                                text: 'Rate Submitted successfully',
                                
                              })
                            
                        }
                    });
                });
            }
        });
    });

    /*dashboard modal */
    $(".dboard").click(function (e) { 
        reqIdforreschedule=e.target.id;
    });
    $(".ft").click(function (e) { 
        reqIdforreschedule=e.target.id;
        
    });
    $(".btn-update").click(function () { 
        var rescheduledate=$(".rescheduledate").val();
        var rescheduletime=$(".rescheduletime").val();
        $.ajax({
            type: "POST",
            url:  base_url + "?controller=Helperland&function=reschedule",
            data: {
                "reqId" : reqIdforreschedule,
                "rescheduledate":rescheduledate,
                "rescheduletime":rescheduletime
            },
            
            success: function (response) {
                dashboard();
                $("#reschedule_modal").modal("hide");
                Swal.fire({
                    icon: 'success',
                    title: 'Done',
                    text: 'Service rescheduled successfully',
                    
                  })
                
            }
        }); 
        
    });

    $(".btn-cancelnow").click(function () { 
        var comment=$(".why-cancel").val();
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, cancel it!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: base_url + "?controller=Helperland&function=cancel",
                    data: {
                        "reqId" : reqIdforreschedule,
                        "comment":comment
                    },
                    success: function (response) {
                        history();
                        dashboard();
                        $("#cancel_bookingrequest_modal").modal("hide");
                        Swal.fire({
                            icon: 'success',
                            title: 'Cancelled',
                            text: 'Service cancelled successfully',
                            
                          })
                    }
                    
                });
            }
          })
        
        
    });

    /*addresses tAb open*/
    $(".mysettingbtn").click(function (e) { 
        e.preventDefault();
        
           $(".leftsidebar .nav-link").removeClass("active");
           $(".tab-content .tab-pane").removeClass("show active");
           $("#v-pills-notification").addClass("show active");
    
       
        
    });


    $(".details").click(function () { 
        $(".details").addClass("active");
        $(".addresses").removeClass("active");
        $(".password").removeClass("active");
        $(".details-body").show();
        $(".address-body").hide();
        $(".password-body").hide();
    });
    $(".addresses").click(function () { 
        $(".details").removeClass("active");
        $(".addresses").addClass("active");
        $(".password").removeClass("active");
        $(".details-body").hide();
        $(".address-body").show();
        $(".password-body").hide();
    });
    $(".password").click(function () { 
        $(".details").removeClass("active");
        $(".addresses").removeClass("active");
        $(".password").addClass("active");
        $(".details-body").hide();
        $(".address-body").hide();
        $(".password-body").show();
    });
    
    $(".password-save").click(function () { 
        var oldpassword = $("input[name='oldpassword']").val();
        var newpassword = $("input[name='newpassword']").val();
        var confirmpassword = $("input[name='confirmpassword']").val();

        if(oldpassword == "" || newpassword == "" || confirmpassword == "")
        {
            $(".password_error").html("fill all details.");
        }
        else
        {
            $(".password_error").html("");
            $.ajax({
                type: "POST",
                url: "http://localhost/Helperland/?controller=Helperland&function=update_password",
                data: {
                        "oldpassword" : oldpassword,
                        "newpassword" : newpassword,
                        "confirmpassword" : confirmpassword,
                      },
                success: function (response) {
                    if(response==1)
                    {
                        Swal.fire({
                            icon: "warning",
                            text: 'Password And Confirm Password Must be Same',
                            
                          })
                    }
                    else if(response==2)
                    {
                        Swal.fire({
                            icon: "warning",
                            text: 'You entered wrong Old Password',
                            
                          })
                    }
                    else
                    {
                        Swal.fire({
                            icon: "success",
                            title: "Done",
                            text: 'Password Updated Successfully',
                            
                          }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = base_url + "?controller=Helperland&function=logout";
                            }
                              
                          });
                    }
                    
                }
            });
        }
    });


    /*updating details*/

    $.ajax({
        type: "POST",
        url: base_url +"?controller=Helperland&function=mydetails",
        success: function (response) {
            $(".details-body").html(response);
           
            $(".details-save").click(function () { 
                
                var fname = $("input[name='fname']").val();
                var lname = $("input[name='lname']").val();
                var mobile = $("input[name='mobile']").val();
                var dob = $("input[name='dob']").val();

                if(fname == "" || lname == "" || mobile == "" || dob == "")
                {
                    $(".error-message").html("please fill all the details.");
                }
                else
                {
                    $(".error-message").html("");
                    $.ajax({
                        type: "POST",
                        url: base_url +"?controller=Helperland&function=updatemydetails",
                        data: {
                            "fname" : fname,
                            "lname" : lname,
                            "mobile" : mobile,
                            "birthdate" : dob,
                        },
                        success: function (response) {
                            if(response)
                            {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Updated',
                                    text:'Detail changed successfully.',
                                    showConfirmButton: false,
                                    timer: 1500
                                    })
                            }
                        }
                    });
                } 
             });
        }
    });


    AddInSet();

    /* enlist the addresses in settings*/
   function AddInSet()
   {
    $.ajax({
        type: "POST",
        url: base_url +"?controller=Helperland&function=addressesinsettings",
        success: function (response) {
            $(".addressinsettings").html(response);
            
            /*delete address in settings*/
            $(".fa-trash-alt").click(function (e) { 
        
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        
                        $.ajax({
                            type: "POST",
                            url: base_url +"?controller=Helperland&function=deleteaddressesinsettings",
                            data:{ "AddId" : e.target.id},
                            success: function (response) {
                                AddInSet();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'deleted',
                                    text:'Deleted successfully.',
                                    showConfirmButton: false,
                                    timer: 1500
                                    })

                            }
                        });
                    }
                  })
            });

            /*add mew address in setings*/
            $(".fa-edit").click(function (eve) { 
                $("#addedit_address_modal").modal("show");
                $.ajax({
                    type: "POST",
                    url: base_url +"?controller=Helperland&function=addmodal",
                    data: {"Addnum": eve.target.id},
                    success: function (response) {
                        $(".addmodal").html(response);

                        $(".btn-addresssave").click(function (e) { 
                           
                            var housenum = $("input[name='housenumber']").val();
                            var streetname = $("input[name='streetname']").val();
                            var postalcode = $("input[name='postal_code']").val();
                            var city = $("input[name='city']").val();
                            var mobile = $("input[name='phonenumber']").val();

                            $.ajax({
                                type: "POST",
                                url: base_url +"?controller=Helperland&function=editadd",
                                data: {
                                    "adid":e.target.id,
                                    "addline1":housenum,
                                    "addline2":streetname,
                                    "postalcode":postalcode,
                                    "city":city,
                                    "mobile":mobile

                                },
                                success: function (response) {
                                    AddInSet();
                                    $("#addedit_address_modal").modal("hide");
                                    if(response)
                                    {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Updated',
                                            text:'Address updated',
                                            showConfirmButton: false,
                                            timer: 1500
                                            })
                                    }
                                }
                            });
                            
                        });
                    }
                });
                
            });
        }
    });
   }   
   /* blank modal content*/

   $(".addnewaddress").click(function () { 
        
        $("#addedit_address_modal").modal("show");
        $.ajax({
            type: "POST",
            url: base_url +"?controller=Helperland&function=addmodal",
            success: function (response) {
                $(".addmodal").html(response);

                $(".btn-addresssave").click(function () { 

                    var housenum = $("input[name='housenumber']").val();
                    var streetname = $("input[name='streetname']").val();
                    var postalcode = $("input[name='postal_code']").val();
                    var city = $("input[name='city']").val();
                    var mobile = $("input[name='phonenumber']").val();
                    
                    $.ajax({
                        type: "POST",
                        url: base_url +"?controller=Helperland&function=editadd",
                        data: {
                            "addline1":housenum,
                            "addline2":streetname,
                            "postalcode":postalcode,
                            "city":city,
                            "mobile":mobile

                        },
                        success: function (response) {
                            AddInSet();
                            $("#addedit_address_modal").modal("hide");
                            if(response)
                            {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'New One Added',
                                    text:'New Address added successfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                    })
                            }
                        }
                    });
                     
                 });
            }
        });
   });

   $("#export").click(function () { 
       $.ajax({
           type: "POST",
           url: base_url +"?controller=Helperland&function=exporthistory",
           success: function (response) {
               $(".serhist").html(response);
            // if(response)
            // {
            //     Swal.fire({
            //         icon: 'success',
            //         title: 'Exported ',
            //         showConfirmButton: false,
            //         timer: 1500
            //         })
            // }
               
           }
       });
       
   });
});





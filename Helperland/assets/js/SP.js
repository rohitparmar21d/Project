$(document).ready(function () {

    var base_url = "http://localhost/Helperland/";
    var includepet=0;
    var selectedaddressid = "";
    selectedavatar = [];
    $(".details").click(function () { 
        $(".details").addClass("active");
        $(".password").removeClass("active");
        $(".details-body").show();
        $(".password-body").hide();
    });
    $(".password").click(function () { 
        $(".details").removeClass("active");
        $(".password").addClass("active");
        $(".details-body").hide();
        $(".password-body").show();
    });
    /*addresses tAb open*/
    $(".mysettingbtn").click(function (e) { 
        e.preventDefault();
           $(".leftsidebar .nav-link").removeClass("active");
           $(".tab-content .tab-pane").removeClass("show active");
           $("#v-pills-notification").addClass("show active");
    });

    $("#pet").click(function () { 
        if(this.checked == true){

            includepet = 1;

           }else{
            
            includepet = 0;

        } 
        newrequest();
    });


    newrequest();
    upcoming();
    sphistory();
    sprate();
    blockcard();
    spdetails();
    function newrequest()
    {
        /*list new requests*/
        $.ajax({
            type: "POST",
            data:{"pet" : includepet},
            url: base_url + "?controller=Helperland&function=newservicesrequests",
            success: function (response)
            {
                $(".newrequest").html(response);
                $('#newrequest').DataTable({
                    paging: true,
                    "pagingType": "full_numbers",
                    // bFilter: false,
                   ordering: true,
                   searching: false,
                   info: false,
                   // "columnDefs": [
                   //     { "orderable": false, "targets": 1 },
                   //     { "orderable": false, "targets": 2 },
                   //     { "orderable": false, "targets": 4 },
                   //     { "orderable": false, "targets": 7 }
                   // ],
                   // "oLanguage": {
                   //     "sInfo": "Total Records: TOTAL"
                   // },
                   "dom": '<"top">rt<"bottom"lip><"clear">',
                    responsive: true,
                   "order": []
                });
            }
        });
    }
     
    function upcoming()
    {
        /* list upcoming request */
        $.ajax({
            type: "POST",
            url: base_url + "?controller=Helperland&function=upcoming",
            success: function (response)
            {
                $(".upcoming").html(response);
                $('#upcoming').DataTable({
                    paging: true,
                    "pagingType": "full_numbers",
                    // bFilter: false,
                   ordering: true,
                   searching: false,
                   info: false,
                   // "columnDefs": [
                   //     { "orderable": false, "targets": 1 },
                   //     { "orderable": false, "targets": 2 },
                   //     { "orderable": false, "targets": 4 },
                   //     { "orderable": false, "targets": 7 }
                   // ],
                   // "oLanguage": {
                   //     "sInfo": "Total Records: TOTAL"
                   // },
                   "dom": '<"top">rt<"bottom"lip><"clear">',
                    responsive: true,
                   "order": []
                });
            }
        });
    }
    function sphistory()
    {
        /* list SP History */
        $.ajax({
            type: "POST",
            url: base_url + "?controller=Helperland&function=sphistory",
            success: function (response)
            {
                $(".sphistory").html(response);
                $('#sphistory').DataTable({
                    paging: true,
                    "pagingType": "full_numbers",
                    // bFilter: false,
                   ordering: true,
                   searching: false,
                   info: false,
                   // "columnDefs": [
                   //     { "orderable": false, "targets": 1 },
                   //     { "orderable": false, "targets": 2 },
                   //     { "orderable": false, "targets": 4 },
                   //     { "orderable": false, "targets": 7 }
                   // ],
                   // "oLanguage": {
                   //     "sInfo": "Total Records: TOTAL"
                   // },
                   "dom": '<"top">rt<"bottom"lip><"clear">',
                    responsive: true,
                   "order": []
                });
            }
        });
    }
    function sprate()
    {
        /*list SP rate */
        $.ajax({
            type: "POST",
            url: base_url + "?controller=Helperland&function=sprate",
            success: function (response) 
            {
                $(".sprate").html(response);
                $("#tablerating").DataTable({
                    paging: true,
                    "pagingType": "full_numbers",
                    // bFilter: false,
                   ordering: true,
                   searching: false,
                   info: false,
                   // "columnDefs": [
                   //     { "orderable": false, "targets": 1 },
                   //     { "orderable": false, "targets": 2 },
                   //     { "orderable": false, "targets": 4 },
                   //     { "orderable": false, "targets": 7 }
                   // ],
                   // "oLanguage": {
                   //     "sInfo": "Total Records: TOTAL"
                   // },
                   "dom": '<"top">rt<"bottom"lip><"clear">',
                    responsive: true,
                   "order": []
                });
                $(".rateyo").rateYo({
                    starWidth: "16px",
                    ratedFill: "#FFD600",
                    readOnly: true,
                });
            }
        });
    }
    function blockcard()
    {
        /* fill block cards*/
        $.ajax({
            type: "POST",
            url: base_url + "?controller=Helperland&function=blockcard",
            success: function (response) {
                $(".card-customer").html(response);
            }
        });
    }
    function spdetails()
    {
        /* SP Details*/
        $.ajax({
            type: "POST",
            url: base_url + "?controller=Helperland&function=spdetails",
            success: function (response) {
                $(".sp-details-body").html(response);
                let avatars = document.querySelectorAll(".avatar-image");

                for (let i = 1; i <= avatars.length; i++) {
                    $("#avatar"+i).click(function (e) { 
                        for (let j = 1; j <= avatars.length; j++){
                            if(i == j){
                                activateAvatar("avatar" + j);
                                selectedavatar = [];
                                selectedavatar.push(j);
                            }
                            else{
                                deactiveAvatar("avatar" + j);
                            }
                        }
                    });
                }
                function activateAvatar(avatarid) {
                    $("#"+avatarid).addClass("active");
                    $("#"+avatarid).css("border", "3px solid #1D7A8C");
                }

                function deactiveAvatar(avatarid) {
                    $("#"+avatarid).removeClass("active");
                    $("#"+avatarid).css("border", "none");
                }
            }
        });
    }
    
    $(document).on ('click', '.accept-btn', function (e) { 
        e.stopPropagation();
        $(".loading").removeClass("d-none");
        $.ajax({
            type: "POST",
            url:base_url + "?controller=Helperland&function=acceptrequest",
            data: {
                "reqId" : this.id,
            },
            success: function (response) {
                newrequest();
                upcoming();
                sphistory();
                $(".loading").addClass("d-none");
                if(response==1)
                {
                    Swal.fire({
                        icon: 'warning',
                        text: "You are already assigned another request At this time "
                        })
                }
                else
                {
                    Swal.fire({
                        icon: 'success',
                        title: "Accepted",
                        text: 'The request Assigned to ',
                        showConfirmButton: false,
                        timer: 1000
                        })
                }
            }
        });
    });
   
    
    $(document).on ('click', '.cancel-btn', function (e) {  
        e.stopPropagation();
        $(".loading").removeClass("d-none");
        $.ajax({
            type: "POST",
            url:base_url + "?controller=Helperland&function=cancelrequest",
            data: {
                "reqId" : this.id,
            },
            success: function (response) {
                $(".loading").addClass("d-none");
                newrequest();
                upcoming();
                sphistory();
                if(response==1)
                {
                    Swal.fire({
                        icon: 'warning',
                        title: "Can not cancel"
                        })
                }
                else
                {
                    Swal.fire({
                        icon: 'success',
                        title: "Cancelled",
                        text: 'Request cancelled',
                        showConfirmButton: false,
                        timer: 1000
                        })
                }
                }
                
        });
        
    });
    
    $(document).on ('click', '.complete-btn', function (e) {  
        e.stopPropagation();
        $.ajax({
            type: "POST",
            url:base_url + "?controller=Helperland&function=completerequest",
            data: {
                "reqId" : this.id,
            },
            success: function (response) {
                newrequest();
                upcoming();
                sphistory();
                Swal.fire({
                    icon: 'success',
                    text: 'Marked as Completed',
                    showConfirmButton: false,
                    timer: 1000
                    })
            }
        });
        
    });

    $(document).on ('click', '.block-button', function () {
        $.ajax({
            type: "POST",
            url: base_url + "?controller=Helperland&function=blockcustomer",
            data: { "userid" : this.id ,},
            success: function (response) {
                blockcard();
                
            }
        });
        
    });
    $(document).on ('click', '.unblock-button', function () {
        $.ajax({
            type: "POST",
            url: base_url + "?controller=Helperland&function=unblockcustomer",
            data: { "userid" : this.id ,},
            success: function (response) {
                blockcard();
                
            }
        });
        
    });

    $(document).on ('click', '.sp-details-save', function () {
        selectedaddressid = this.id;
        var spfname = $("input[name='spfname']").val();
        var splname = $("input[name='splname']").val();
        var spmobile = $("input[name='spmobile']").val();
        var spemail = $("input[name='spemail']").val();
        var spdob = $("input[name='spdob']").val();
        var spnationality = $("[name='spnationality'] option:selected").val();
        var splanguage = $("[name='splanguage'] option:selected").val();
        var spgender = document.querySelector('input[name="spgender"]:checked').value;
        var spstreetname = $("input[name='spstreetname']").val();
        var sphousenumber = $("input[name='sphousenumber']").val();
        var sppostalcode = $("input[name='sppostalcode']").val();
        var spcity = $("input[name='spcity']").val();
        
        if(selectedaddressid == "")
        {
            if(spfname == "" || splname == "" || spmobile == "" || spdob == "" || spnationality == "" || splanguage == "" || spgender == "" || selectedavatar == "" || spstreetname == "" || sphousenumber == "" || sppostalcode == "" || spcity == "")
            {
                $(".error-line").css("display", "flex");
                $(".sp-error-message").html("Please fill all the details...");
            }
            else
            {
                $(".sp-error-message").html("");
                $.ajax({
                    type: "POST",
                    url: base_url + "?controller=Helperland&function=savespdetails",
                    data: {
                        "spfname" : spfname,
                        "splname" : splname,
                        "spmobile" : spmobile,
                        "spemail" : spemail,
                        "spdob" : spdob,
                        "spnationality" : spnationality,
                        "splanguage" : splanguage,
                        "spgender" : spgender,
                        "selectedavatar" : selectedavatar,
                        "spstreetname" : spstreetname,
                        "sphousenumber" : sphousenumber,
                        "sppostalcode" : sppostalcode,
                        "spcity" : spcity,
                    },
                    success: function (response) {
                        spdetails();
                        Swal.fire({
                            icon: 'success',
                            text: 'Your details updated and address insereted successfully..',
                            showConfirmButton: false,
                            timer: 1000
                            })
                    }
                });
            }
           
        }
        else
        {
            if(spfname == "" || splname == "" || spmobile == "" || spdob == "" || spnationality == "" || splanguage == "" || spgender == "" || selectedavatar == "" || spstreetname == "" || sphousenumber == "" || sppostalcode == "" || spcity == "")
            {
                $(".error-line").css("display", "flex");
                $(".sp-error-message").html("Please fill all the details...");
            }
            else
            {
                $(".sp-error-message").html("");
                $.ajax({
                    type: "POST",
                    url: base_url + "?controller=Helperland&function=savespdetails",
                    data: {
                        "selectedaddressid" : selectedaddressid,
                        "spfname" : spfname,
                        "splname" : splname,
                        "spmobile" : spmobile,
                        "spemail" : spemail,
                        "spdob" : spdob,
                        "spnationality" : spnationality,
                        "splanguage" : splanguage,
                        "spgender" : spgender,
                        "selectedavatar" : selectedavatar,
                        "spstreetname" : spstreetname,
                        "sphousenumber" : sphousenumber,
                        "sppostalcode" : sppostalcode,
                        "spcity" : spcity,
                    },
                    success: function (response) {
                        spdetails();
                        Swal.fire({
                            icon: 'success',
                            text: 'your details updated successfully.',
                            showConfirmButton: false,
                            timer: 1000
                            })
                    }
                });
            }
        }
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

});
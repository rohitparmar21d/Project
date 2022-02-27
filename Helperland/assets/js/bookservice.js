
$(document).ready(function(){
    var seladdid ;
    var postalcode;
    var servicedatetime;
    var servicehours;
    var extraservicehours = 0;
    var comments;
    var haspet =0;
    var subtotal= 0;
    var totalpayment = 0;
    var useraddId ;
     var base_url = "http://localhost/Helperland/";
       function switchtab(from, to )
    {
        $("#pills-"+from+"-tab").removeClass("active");
        $("#pills-"+from).removeClass("show active");
        $("#pills-"+to+"-tab").removeClass("disabled");
        $("#pills-"+to+"-tab").addClass("active");
        $("#pills-"+to).addClass("show active");

    }

    $(".check-avail").click(function () { 

        postalcode = $(".postalcode").val();
        if(postalcode == "")
        {
          document.querySelector(".avail-msg").innerHTML="Please enter the postalcode";
        }
        else
        {
            $.ajax({
                type: "POST",
                url: base_url + "?controller=Helperland&function=checkavail",
                data: { "zipcode" : postalcode},
                success: function (response) 
                {
                    if(response == 0)
                    {
                         document.querySelector(".avail-msg").innerHTML="We are not providing service in this area. We'll notify you if any helper would start working near your area.";
                    }
                    else
                    {
                        
                        switchtab("SetupService","SchedulePlan");
                    }
                    
                    
                    
                }
            });
            enlistaddress();
            
        }
     });
     $(".continue-tab-2").click(function () { 
        switchtab("SchedulePlan","YourDetails");
        comments = $(".service-comment").val();
        
    });
    $(".extra-image-1").click(function ()
    { 
        
        if(!(document.querySelector(".extra-image-1").classList.contains("active")))
        {
            extra_service_active("extra-image-1");
            $(".cabinet").show();
            $(".cabinet-txt").show();
         }
        else
        {
            extra_service_diactive("extra-image-1");
            $(".cabinet").hide();
            $(".cabinet-txt").hide();
        }
        totaltime();
    
        
    });
    $(".extra-image-5").click(function ()
    { 
        if(!(document.querySelector(".extra-image-5").classList.contains("active")))
        {
            extra_service_active("extra-image-5");
            $(".window").show();
            $(".window-txt").show();
         }
        else
        {
            extra_service_diactive("extra-image-5");
            $(".window").hide();
            $(".window-txt").hide();
        }
        totaltime();
    
        
    });
    $(".extra-image-2").click(function ()
    { 
        if(!(document.querySelector(".extra-image-2").classList.contains("active")))
        {
            extra_service_active("extra-image-2");
            $(".fridge").show();
            $(".fridge-txt").show();
         }
        else
        {
            extra_service_diactive("extra-image-2");
            $(".fridge").hide();
            $(".fridge-txt").hide();
        }
        totaltime();
        
        
    });
    $(".extra-image-3").click(function ()
    { 
        if(!(document.querySelector(".extra-image-3").classList.contains("active")))
        {
            extra_service_active("extra-image-3");
            $(".oven").show();
            $(".oven-txt").show();
         }
        else
        {
            extra_service_diactive("extra-image-3");
            $(".oven").hide();
            $(".oven-txt").hide();
        }
        totaltime();
    
        
    });
    $(".extra-image-4").click(function ()
    { 
        if(!(document.querySelector(".extra-image-4").classList.contains("active")))
        {
            extra_service_active("extra-image-4");
            $(".wash").show();
            $(".wash-txt").show();
         }
        else
        {
            extra_service_diactive("extra-image-4");
            $(".wash").hide();
            $(".wash-txt").hide();
        }
        totaltime();
        
    });
    
    function extra_service_active(srvc_name)
    {
        $("."+srvc_name).addClass("active");
        document.querySelector("."+srvc_name).style.border="2px solid #1D7A8C";
        document.querySelector("."+srvc_name+" img").src=document.querySelector("."+srvc_name+" img").src.replace(".png","-green.png");
    }
    function extra_service_diactive(srvc_name)
    {
        $("."+srvc_name).removeClass("active");
        document.querySelector("."+srvc_name).style.border="1px solid";
        document.querySelector("."+srvc_name+" img").src=document.querySelector("."+srvc_name+" img").src.replace("-green.png",".png");
    }
    /***payment summary*/
    servicehours =parseFloat($("#servicetime  option:selected").val());
    document.querySelector(".basic").innerHTML=servicehours +" "+ "Hrs";
    servicedatetime =$("#formdate").val() + " " + $("#formtime").val();
    document.querySelector(".datetime").innerHTML=servicedatetime;

    $("#servicetime").click(function () { 
        document.querySelector(".basic").innerHTML=$("#servicetime  option:selected").val() +" "+ "Hrs";
    });

    $("#servicetime").on("change", function () {
      totaltime();
      
    });
    $("#formdate").click(function () { 
        document.querySelector(".datetime").innerHTML=$("#formdate").val() + " " + $("#formtime").val();
    });
    $("#formtime").click(function () { 
        document.querySelector(".datetime").innerHTML=$("#formdate").val() + " " + $("#formtime").val();
    });

    $("#pet").click(function () { 
        if(this.checked == true){

            haspet = 1;

           }else{
            
            haspet = 0;

        } 
        
        
    });

    //total service time
    document.querySelector(".totaltime").innerHTML=$("#servicetime  option:selected").val()+" " +"Hrs";
           
    function totaltime()
    {
        var total =parseFloat($("#servicetime  option:selected").val());

        if(document.querySelector(".extra-image-1").classList.contains("active"))
        {
            var ex1 = 0.5;
        }
        else
        {
            var ex1 = 0;
        }
        if(document.querySelector(".extra-image-2").classList.contains("active"))
        {
            var ex2 = 0.5;
        }
        else
        {
            var ex2 = 0;
        }
        if(document.querySelector(".extra-image-3").classList.contains("active"))
        {
            var ex3 = 0.5;
        }
        else
        {
            var ex3 = 0;
        }
        if(document.querySelector(".extra-image-4").classList.contains("active"))
        {
            var ex4 = 0.5;
        }
        else
        {
            var ex4 = 0;
        }
        if(document.querySelector(".extra-image-5").classList.contains("active"))
        {
            var ex5 = 0.5;
        }
        else
        {
            var ex5 = 0;
        }
        
        total = total + ex1 + ex2 + ex3 + ex4 + ex5;
        extraservicehours= ex1 + ex2 + ex3 + ex4 + ex5 ;
        document.querySelector(".totaltime").innerHTML=total +" "+ "Hrs";
         totalpayment = total*25;
         document.querySelector(".totalpayment b").innerHTML= "$"+totalpayment ;
         subtotal =total*25;
         document.querySelector(".charge").innerHTML= "$"+subtotal ;
    
    }
    $(".add-new-address").click(function () { 
        $(".add-address").css("display", "block");
        $(".add-new-address").css("display", "none");
    });
    $(".address-cancel").click(function () { 
        $(".add-address").css("display", "none");
        $(".add-new-address").css("display", "block");
    });

    //enlisting addresses
    function enlistaddress()
    {
        var postalcode = $(".postalcode").val();
        $.ajax({
            type: "POST",
            url:  base_url + "?controller=Helperland&function=add_addresses",
            data: { "zipcode" : postalcode},
            success: function (response) {
                
             
         
                document.querySelector(".address").innerHTML=response;
                $(".area-label").click(function () { 
                    if('input[name="age"]:checked'){
                        $(".continue-tab-3").removeAttr("disabled");
            
                    }else{
                     
                     $(".continue-tab-3").attr("disabled", true);
            
                 } 
                });
                
            }
        });
    }
   
    $(".address-save").click(function () {
        

        var housenumber = $(".housenumber").val();
        var streetname = $(".streetname").val();
        var city = $(".city").val();
        var postal_code = $(".postal_code").val();
        var phonenumber = $(".phonenumber").val();

        $.ajax({
            type: "POST",
            url: base_url + "?controller=Helperland&function=insert_address",
            data: {
                    "housenumber" : housenumber,
                    "streetname" : streetname,
                    "city" : city,
                    "postalcode" : postal_code,
                    "phonenumber" : phonenumber
                   },
            success: function (response) {enlistaddress(); }
        });
        $(".add-address").css("display", "none");
        $(".add-new-address").css("display", "block");
    });

    $(".continue-tab-3").click(function () { 
        switchtab("YourDetails", "MakePayment");        
    });

    $("#terms-conditions-last").click(function () { 
            
           
        if(this.checked == true){

            $(".complete-booking").removeAttr("disabled");

           }else{
            
            $(".complete-booking").attr("disabled", true);

        } 

        
    });
    $(".complete-booking").click(function () { 
        add_service_request();

        
    });
    $(".address").click(function (event) { 
         seladdid =event.target.value;
    });
    function add_service_request()
    {
        $.ajax({
            type: "POST",
            url:  base_url + "?controller=Helperland&function=add_service_request",
            data: {
                "servicedatetime" : servicedatetime,
                "postalcode" : postalcode,
                "servicehours" : servicehours,
                "extraservicehours" : extraservicehours,
                "subtotal" : subtotal,
                "totalpayment" : totalpayment,
                "comments":comments,
                "haspet" : haspet,
                 "seladdid" : seladdid
               },
            success: function (response) {
                alert("request submited successfully, we'll mail you when it will get confirmed");
                window.location.href = base_url;
            }
        });
    }
 
});


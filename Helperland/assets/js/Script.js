$(document).ready(function () {
        var path = window.location.pathname.split("/").pop();
        
        if(path == ''){
            path = 'index.php';
        }
        
        var target = $('.navbar-nav .nav-item a[href="./'+path+'"]');
        if(target.addClass('active')){
            $(".navbar-nav .nav-item .active").css("color", "yellow");
        }



     
        $("#check1").click(function () { 
            
           
            if(this.checked == true){

                $("#submitButton").removeAttr("disabled");

               }else{
                
                $("#submitButton").attr("disabled", true);

            } 

            
        });
        $("#exampleCheck2").click(function () { 
            
           
            if(this.checked == true){

                $("#register").removeAttr("disabled");

               }else{
                
                $("#register").attr("disabled", true);

            } 

            
        });
         

        $(".logout").click(function (e) { 
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "http://localhost/Helperland/?controller=helperland&function=logout",
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Logged Out',
                        showConfirmButton: false,
                        timer: 1500
                        }).then((result) => {
                            window.location.href = "http://localhost/Helperland/";
                         });
                    
                }
            });
            
        });

});
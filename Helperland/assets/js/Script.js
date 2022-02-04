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



});
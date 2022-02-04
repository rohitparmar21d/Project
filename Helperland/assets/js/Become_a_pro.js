window.addEventListener('scroll', function () {
    let nav = document.querySelector('nav');
    let windowPosition = window.scrollY > 0;
    nav.classList.toggle('scrolling-active', windowPosition);

  })

  $("#exampleCheck2").click(function () { 
            
           
    if(this.checked == true){

        $("#register").removeAttr("disabled");

       }else{
        
        $("#register").attr("disabled", true);

    } 

    
});
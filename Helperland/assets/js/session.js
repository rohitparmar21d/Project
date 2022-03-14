$(document).ready(function () {
    $.ajax({
        type: "POST",
        url: "http://localhost/Helperland/session",
        success: function (response) {
          if(response==0)
          {
            Swal.fire({
                icon: 'warning',
                title: 'Please Log In First',
                text: 'You are Not Logged In anymore '
                })
          }
            
        }
    });
});
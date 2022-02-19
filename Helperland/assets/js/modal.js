function LoginModal() {
    window.location.href = "#LoginModal";

    $('#LoginModal .close').click(function() {
        window.location.href = "";
    });
}
$(document).ready(function() {

    if (window.location.href.indexOf('#LoginModal') != -1) {

        $('#LoginModal').modal('show');

        $('#LoginModal .close').click(function() {
            window.location.href = "";
        });

    }
});
//<a href="#LoginModal" data-toggle="modal" data-target="#LoginModal"  data-dismiss="modal" onclick="LoginModal()" class="py-0 text-decoration-none text-light">Login</a>
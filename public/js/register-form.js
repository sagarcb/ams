
$(document).ready(function () {
    $('#submitBtn').on('click', function (e) {
        let pass = $('#password').val();
        let confirmPass = $('#confirm-password').val();
        if (pass !== confirmPass){
            e.preventDefault();
            alert("Confirm password didn't match with Password!!!");
        }else{
            $(this).attr('type','submit');
        }
    })
});


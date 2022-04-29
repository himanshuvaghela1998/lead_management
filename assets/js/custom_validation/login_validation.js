$(document).ready(function () {
    $('#login_form').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
            },
        },
        message: {
            email: {
                required: "Enter your Email",
                email: "Please enter a valid email address.",
            },
            password: "Password is required",
        },
        submitHandler: function(form){
            form.submit();
        }
    });

});

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

    $('#lead_store').validate({
        rules: {
            project_title : 'required',
            project_type_id : 'required',
            time_estimation : 'required',
            source_id : 'required',
            billing_type : 'required',
            status : 'required',
            user_id : 'required',
            client_name : 'required',
            client_email : 'required'
        },
        message: {

            project_title : 'Project title is required',
            project_type_id : 'Project type is required',
            time_estimation : 'Time estimation is required',
            source_id : 'Lead source is required',
            billing_type : 'Billing type is required',
            status : 'Project status is required',
            user_id : 'Assigned too is required',
            client_name : 'Client name is required',
            client_email : 'Client email is required'

        },
        submitHandler: function(form){
            form.submit();
        }
    });



});

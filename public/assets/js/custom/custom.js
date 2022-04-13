$(function(){	
    if($("#user_store").val() !== undefined)
    {
        jQuery.validator.addMethod('checkemail', function (value) { 
            return /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(value); 
        }, 'Please enter a valid email address.');
        jQuery.validator.addMethod("noSpace", function(value, element) {      
            return this.optional( element ) || /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/.test( value );
        }, "No space please and don't leave it empty");
    
        jQuery.validator.addMethod("noSpacePwd", function(value, element) { 
            return value.indexOf(" ") < 0 && value != ""; 
        }, "No space please and don't leave it empty");
    
        jQuery.validator.addMethod("pwcheck", function(value) {
            return /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/.test(value) // consists of only these
        });
    }		
    $("#user_store").validate({
        ignore: [],
        rules: {
            email: {
                checkemail: true,
                required: true,
            },
            role: {
                required: true,
            },
            password: {
                required: true,
                noSpacePwd : true,
                minlength : 8,
                pwcheck: true,
            },
            name: {
                required: true,
                noSpace:true,
                minlength:1,
            },
        }, 
        messages: {
            "email":{
                required:"Email is required."
            }, 
            "role":{
                required:"Select a role."
            },
            "password":{
                required:"Password is required.",
                noSpacePwd:"Password is required.",
                minlength:"Password may not be less than 8 character.",
                pwcheck: "Password must contain at least 1 number, 1 lowercase, 1 uppercase letter and at least 1 special character from @#$%&",
            },
            "name":{
                required:"Name is required.",
                noSpace:"Name is required.",
            }, 
        },
        //perform an AJAX post to ajax.php
        submitHandler: function() {    
            console.log('mouuu');                    
            return true;
        }
    });
}); 

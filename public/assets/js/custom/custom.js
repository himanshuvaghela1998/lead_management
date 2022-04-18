$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var _token = $("meta[name='_token']").attr('content');
var user_rules = {
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
        minlength:1,
    },
}

var user_msgs = {
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
    },
}
// Start add user
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
$("#user_store").validate({
    ignore: [],
    rules: user_rules,
    messages: user_msgs,
    //perform an AJAX post to ajax.php
    submitHandler: function() {
        return true;
    }
});

$('#add_user_btn').on('click',function(){
    $('#add_user_modal').modal('show')
})
$('.close-modal').on('click',function(){
    $('#add_user_modal').modal('hide')
})
// End add User

// Start Edit User
$('.edit_user').on('click',function(e){
    e.preventDefault();
    var id = $(this).attr('id');
    var url = $(this).data('url');
    var _modal=$('#edit_user_modal');
    $.ajax({
        url: url,
        type: 'get',
        cache : false,
        processData: false,
        contentType: false,
        success: function(response){
            if(response.status == 'success'){
                $('#edit_user_modal').html(response.content);
                _modal.modal('show');
                $("#user_update").validate({
                    ignore: [],
                    rules: user_rules,
                    messages: user_msgs,
                    //perform an AJAX post to ajax.php
                    submitHandler: function() {
                        return true;
                    }
                });
                $('.close-modal').on('click',function(){
                    $('#edit_user_modal').modal('hide')
                })
            }else{
                toastr.error('No user found');
            }
        },
        error: function(error){
            toastr.error('Something went wrong');
        }
    });

})
// end edit user


check_all_click();

function get_all_checked_ids() {
    var ids_list = [];
    if($('.selected_rows:checked').length > 0) {
        $('.selected_rows:checked').each(function(index) {
            var check_value = parseInt($(this).val());
            ids_list.push(check_value);
        });
    }
    return ids_list;
}

function check_all_click() {
$(document).on("click","#search-select-all",function () {
        $(".selected_rows").prop('checked', $(this).prop('checked'));
        delete_enable_disable();
    });
}

$(document).on("click",".selected_rows",function () {
    select_main_check_box();
    delete_enable_disable();
});

function select_main_check_box(){
    if($('.selected_rows:checked').length == $('.selected_rows').length) {
        $('#search-select-all').prop('checked', true);
    }else{
        $('#search-select-all').prop('checked', false);
    }
}

/*Begin status update Ajax*/
$(document).on('change','.update_status',function(){
    var URL = $(this).attr('href');
    var title  = $(this).data('title');
    var $this = $(this);
    if($(this).is(":checked")){
        var status = 1;
        var current_status = 'active';
    }
    else if($(this).is(":not(:checked)")){
        var status = 0;
        var current_status = 'inactive';
    }

    Swal.fire({
        text: "Are you sure to "+current_status+" this "+title+" ?",
        icon: "warning",
        showCancelButton: !0,
        buttonsStyling: !1,
        confirmButtonText: "Confirm",
        cancelButtonText: "Cancel",
        customClass: { confirmButton: "btn fw-bold btn-success", cancelButton: "btn fw-bold btn-active-light-danger" },
    }).then(function (result) {
        console.log(result.isConfirmed,_token);
        if(result.isConfirmed){
               $.ajax({
                    url: URL,
                    type: 'post',
                    data: {status: status},

                    success: function(response){
                        if(response.status == 'success'){
                            toastr.success(response.message);
                        }else{
                            Swal.fire({ text: response.message, icon: "error", buttonsStyling: !1, confirmButtonText: "Okay", customClass: { confirmButton: "btn fw-bold btn-primary" } }).then(function (result) { if(result.isConfirmed){ location.reload() } });;
                        }
                    },
                    error: function(error){
                        Swal.fire({ text: 'Something went wrong', icon: "error", buttonsStyling: !1, confirmButtonText: "Okay", customClass: { confirmButton: "btn fw-bold btn-primary" } }).then(function (result) { if(result.isConfirmed){ location.reload() } });;
                    }
                });
        }else{


            if($this.is(":checked")){
                $this.prop('checked', false);
            }
            else{
                $this.prop('checked', true);
            }

        }
    });

});
/* END status update */

// filter-ajax
$(document).on('keyup','#filter_form input',function(e){
    if($(this).val().length > 2 || $(this).val().length == 0){
        $('#filter_page').val(0);
        $('#filter_form').trigger('submit');
    }
});
$(document).on('change','#filter_form select',function(){
    $('#filter_form').trigger('submit');
});

/* Status Filter */
$('#status_filter').on('change', function (){
       var status  =$('#status_filter').val();
       console.log(status);
       $('#status_id').val(status);
       $('#filter_form').trigger('submit');
});
$(document).on('submit','#filter_form',function(e){
    e.preventDefault();
    var form_data = $(this).serialize();
    var form_url = $(this).attr('action');
    $.ajax({
        type: "GET",
        url: form_url,
        dataType: 'json',
        cache: false,
        data: form_data,

        success: function(data) {
            if(data.status == 200){
                $('#load_content').html(data.content);
            }else{
                toastr.error(data.message);
            }
        },
        error: function(){
            toastr.error('Something went wrong');
        }
    });
});
/* END Filter Ajax*/


/* Delete Record Jquery */
$(document).on('click','.delete_row',function(e){
    e.preventDefault();
    var URL  = $(this).data('href');
    var user_id  = $(this).data('user_id');
    var title  = $(this).data('title');

    Swal.fire({
        text: "Are you sure to delete this "+title+" ?",
        icon: "warning",
        showCancelButton: !0,
        buttonsStyling: !1,
        confirmButtonText: "Confirm",
        cancelButtonText: "Cancel",
        customClass: { confirmButton: "btn fw-bold btn-danger", cancelButton: "btn fw-bold btn-active-light-primary" },
    }).then(function (result) {
        console.log(result.isConfirmed);
        if(result.isConfirmed){
            $.ajax({
                url:URL,
                type:'delete', // replaced from put
                dataType: "JSON",
                success: function (response)
                {
                    toastr.success(response.message);
                    $("#user_"+user_id).remove();
                },
                error: function(xhr) {
                    console.log(xhr.responseText); // this line will save you tons of hours while debugging
                    Swal.fire({ text: "Something went wrong!", icon: "error", buttonsStyling: !1, confirmButtonText: "Okay", customClass: { confirmButton: "btn fw-bold btn-primary" } });
                }
            });
        }else{

        }
    });
});
/* END Delete Record Jquery */

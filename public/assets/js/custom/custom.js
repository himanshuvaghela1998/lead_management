$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var _token = $("meta[name='_token']").attr('content');
// extra checking methods start

jQuery.validator.addMethod('checkemail', function (value) {
    return /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(value);
}, 'Please enter a valid email address.');
jQuery.validator.addMethod("noSpace", function(value, element) {
    return this.optional( element ) || /^[a-z+_]+(?:-[a-z+_]+)*$/ .test( value );
}, "No space please and don't leave it empty");

jQuery.validator.addMethod("noSpacePwd", function(value, element) {
    return value.indexOf(" ") < 0 && value != "";
}, "No space please and don't leave it empty");

jQuery.validator.addMethod("pwcheck", function(value) {
    return /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/.test(value) // consists of only these
});

// extra checking methods end

// User validation Start
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
        // noSpacePwd : true,
        minlength : 8,
        // pwcheck: true,
    },
    name: {
        required: true,
        minlength:1,
    },
    confirm_password: {
        required: true,
        equalTo : "#password",
        // noSpacePwd : true,
        minlength : 8,
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
    "confirm_password":{
        required:"Confirm Password is required.",
        minlength:"Confirm Password may not be less than 8 character.",
        equalTo : "Password and Confirm password are not same."
    },
}

// Start add user
$("#user_store").validate({
    ignore: [],
    rules: user_rules,
    messages: user_msgs,
    //perform an AJAX post to ajax.php
    submitHandler: function() {
        return true;
    }
});

// User validation end

$('#add_user_btn').on('click',function(){
    $('#add_user_modal').modal('show')
})
$('.close-modal').on('click',function(){
    $('#add_user_modal').modal('hide')
})
// End add User

// Password change start
$(document).on("click",".change_password",function (e) {
    e.preventDefault();
    var id = $(this).attr('id');
    var url = $(this).data('url');
    var _modal = $('#change_password_modal');
    $.ajax({
        url: url,
        type: 'get',
        cache: false,
        processData: false,
        contentType: false,
        success: function(response){
            if (response.status == 'success') {
                $('#change_password_modal').html(response.content);
                _modal.modal('show');
                $('.close-modal').on('click', function(){
                    $('#change_password_modal').modal('hide');
                });
            }else{
                toastr.error('No user found');
            }
        }
    })
})
//Change password end

// Start Edit User
$(document).on("click",".edit_user",function (e) {
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
                    $('#edit_user_modal').modal('hide');
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
// end Edit User


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
$(document).on("click","#search_select_all",function () {
        $(".search_select_all").prop('checked', $(this).prop('checked'));
        submodule_enable_disable();
    });
}

function get_all_checked_ids() {
    var ids_list = [];
    if($('.search_select_all:checked').length > 0) {
        $('.search_select_all:checked').each(function(index) {
            var check_value = parseInt($(this).val());
            ids_list.push(check_value);
        });
    }
    return ids_list;
}

function submodule_enable_disable(){
    var selected_rows_count = get_all_checked_ids();
    if (selected_rows_count.length > 0) {
        $('#selected_rows').attr({
            'disabled' : false
        })
    }
    else{
        $('#selected_rows').attr({
            'disabled' : true
        })
    }
}

// $(document).on("click",".selected_rows",function () {
//     select_main_check_box();
//     delete_enable_disable();
// });

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

/* start date filter */
$(".date_filter").flatpickr();
$(document).on('change', '#start_date_filter', function(e){

    if ($('#start_date_filter').val() != '' && $('#end_date_filter').val() != '') {

        var str_date = $('#start_date_filter').val();
        var end_date = $('#end_date_filter').val();
        $('#from_date').val(str_date);
        $('#to_date').val(end_date);
        $('#filter_form').trigger('submit');
    }
})

$(document).on('change', '#end_date_filter', function(e){
    if ($('#start_date_filter').val() != '' && $('#end_date_filter').val() != '') {

        var str_date = $('#start_date_filter').val();
        var end_date = $('#end_date_filter').val();
        $('#from_date').val(str_date);
        $('#to_date').val(end_date);
        $('#filter_form').trigger('submit');
    }


})

/* Status Filter */
$(document).on('change','#status_filter',function(){
       var status  =$('#status_filter').val();
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
                //var menu = document.querySelector(".kt-action-menu");
                //menu.update();
                KTMenu.createInstances();
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
                    Swal.fire({ text: "Something went wrong!", icon: "error", buttonsStyling: !1, confirmButtonText: "Okay", customClass: { confirmButton: "btn fw-bold btn-primary" } });
                }
            });
        }else{

        }
    });
});
/* END Delete Record Jquery */


$('.lead_assignee_span').on('click',function(e){
    $(this).hide();
    var secret = $(this).data('secret');
    $('#lead_assignee_'+secret).show();
    $('#lead_check_assignee_btn_'+secret).show();
    $('#lead_cross_assignee_btn_'+secret).show();
});
$('.lead_cross_assignee_btn').on('click',function(e){
    var secret = $(this).data('secret');
    $('#lead_assignee_'+secret).hide();
    $('#lead_check_assignee_btn_'+secret).hide();
    $('#lead_cross_assignee_btn_'+secret).hide();
    $('#lead_assignee_span_'+secret).show();
});
$('.lead_assignee_change').on('click', function (e) {
    var url = $(this).data('url');
    var secret = $(this).data('secret');
    var $selected_lead = $('#lead_assignee_'+secret);
    var selected_assignee = $selected_lead.val();
    console.log(selected_assignee);
    $.ajax({
        type: "POST",
        url: url,
        dataType: 'json',
        cache: false,
        data: {selected_assignee : selected_assignee},
        success: function(data) {
            console.log(data.content);
            if(data.status == 'success'){
                toastr.success(data.message);
                $('#lead_assignee_span_'+secret).html(data.content.name);
            }else{
                toastr.error(data.message);
            }
            $selected_lead.hide();
            $('#lead_check_assignee_btn_'+secret).hide();
            $('#lead_cross_assignee_btn_'+secret).hide();
            $('#lead_assignee_span_'+secret).show();
        },
        error: function(){
            toastr.error('Something went wrong');
            $selected_lead.hide();
            $('#lead_check_assignee_btn_'+secret).hide();
            $('#lead_cross_assignee_btn_'+secret).hide();
            $('#lead_assignee_span_'+secret).show();
        }
    });
})

/* Start status Jquery */
$('.lead_status_span').on('click',function(e){
    $(this).hide();
    var secret = $(this).data('secret');
    $('#lead_status_'+secret).show();
    $('#lead_check_btn_'+secret).show();
    $('#lead_cross_btn_'+secret).show();
});
$('.lead_cross_btn').on('click',function(e){
    var secret = $(this).data('secret');
    $('#lead_status_'+secret).hide();
    $('#lead_check_btn_'+secret).hide();
    $('#lead_cross_btn_'+secret).hide();
    $('#lead_status_span_'+secret).show();
});
$('.lead_status_change').on('click', function (e) {
    var url = $(this).data('url');
    var secret = $(this).data('secret');
    var $selected_lead = $('#lead_status_'+secret);
    var selected_status = $selected_lead.val();
    console.log(selected_status);
    $.ajax({
        type: "POST",
        url: url,
        dataType: 'json',
        cache: false,
        data: {selected_status : selected_status},
        success: function(data) {
            if(data.status == 'success'){
                toastr.success(data.message);
                $('#lead_status_span_'+secret).html(selected_status.replaceAll('_',' '));

            }else{
                toastr.error(data.message);
            }
            $selected_lead.hide();
            $('#lead_check_btn_'+secret).hide();
            $('#lead_cross_btn_'+secret).hide();
            $('#lead_status_span_'+secret).show();
        },
        error: function(){
            toastr.error('Something went wrong');
            $selected_lead.hide();
            $('#lead_check_btn_'+secret).hide();
            $('#lead_cross_btn_'+secret).hide();
            $('#lead_status_span_'+secret).show();
        }
    });
})


$('#message').keypress(function (e) {
    if (e.which == 13) {
      $('#frm_lead_thread').submit();
      return false;
    }
});
$(document).on('submit','#frm_lead_thread',function(e){
    e.preventDefault();
    var form_data = new FormData($('#frm_lead_thread')[0]);
    var form_url = $('#frm_lead_thread').attr('action');
    var no_msg = ($('#message').val() == '' || $('#message').val() == null);
    if($('#thread_attachment').val() == '' && no_msg)
    {
        toastr.error('Please enter a message')
    }
    else
    {
        $.ajax({
            type: "POST",
            url: form_url,
            dataType: 'json',
            cache: false,
            data: form_data,
            processData: false,
            contentType: false,
            success: function(data) {
                cancelAttachment();
                if(data.status == 200){
                    $('#thread_messages').append(data.content);
                    $("#thread_messages").animate({ scrollTop: $("#thread_messages")[0].scrollHeight }, 1000);
                    toastr.success(data.message);
                    $('#message').val('');
                }else{
                    toastr.error(data.message);
                }
            },
            error: function(){
                cancelAttachment();
                toastr.error('Something went wrong');
            }
        });
    }
});

function attachmentTemplate(fileType, fileName, imgURL = null) {
    if (fileType == 'image') {
        return `
        <div class="attachment-preview">
            <span class="fas fa-times cancel"></span>
            <div class="image-file chat-image" style="background-image: url('`+ imgURL + `');"></div>
            <p><span class="fas fa-file-image"></span> `+ fileName + `</p>
        </div>
        `;
    }else if(fileType == 'video')
        {
            return `
            <div class="attachment-preview">
                <span class="fas fa-times cancel"></span>
                <div><video src="`+imgURL+`" height="90" width="140" controls></video></div>
                <p><span class="fas fa-file-image"></span> `+ fileName + `</p>
            </div>
            `;
        }
     else {
        return `
        <div class="attachment-preview">
            <span class="fas fa-times cancel"></span>
            <p style="padding:0px 30px;"><span class="fas fa-file"></span> `+ fileName + `</p>
        </div>
        `;
    }
}

$('#thread_attachment').on('change',function(e){
    let file = e.target.files[0];
    let reader = new FileReader();
    reader.readAsDataURL(file);
    reader.addEventListener('load', (e) => {
        if (file.type.match("image.*")) {
            // if the file is an image
            $('#chat_messenger_footer').find('.attachment-preview').remove(); // older one
            $('#chat_messenger_footer').prepend(attachmentTemplate('image', file.name, e.target.result));
        }else if(file.type.match("video.*"))
        {
            $('#chat_messenger_footer').find('.attachment-preview').remove(); // older one
            $('#chat_messenger_footer').prepend(attachmentTemplate('video', file.name, e.target.result));
        }
         else {
            // if the file not image
            $('#chat_messenger_footer').find('.attachment-preview').remove(); // older one
            $('#chat_messenger_footer').prepend(attachmentTemplate('file', file.name));
            var allowedExtensions = /(\.doc|\.docx|\.pdf|\.tex|\.txt)$/i;
            // files validation
            if (!allowedExtensions.exec(file.name)) {
                cancelAttachment();
                toastr.error("Please upload file as images, videos, pdf, doc only","Invalid file");
            }
        }
    });
});

function cancelAttachment() {
    $('#chat_messenger_footer').find('.attachment-preview').remove();
    $('#thread_attachment').replaceWith($('#thread_attachment').val('').clone(true));
}

// Attachment preview cancel button.
$('body').on('click', ".attachment-preview .cancel", (e) => {
    cancelAttachment();
});

/* start module validation */
var module_rules = {
    name: {
        required: true,
    },
    slug: {
        required: true,
        noSpace : true,
    },
}

var module_msgs = {
    "name":{
        required:"Name is required."
    },
    "slug":{
        required:"Slug is required.",
        noSpace:"Space and capital letters are not valid input.",
    },
}
/* end module validation */

// Start add module
$("#store_module").validate({
    ignore: [],
    rules: module_rules,
    messages: module_msgs,
    //perform an AJAX post to ajax.php
    submitHandler: function() {
        return true;
    }
});

$('#add_module_btn').on('click',function(){
    $('#add_module_modal').modal('show');
});
$('.close-module-modal').on('click',function(){
    $('#add_module_modal').modal('hide');
});
// end add module

// start edit module
$(document).on("click",".edit_module",function (e) {
    e.preventDefault();
    var id = $(this).attr('id');
    var url = $(this).data('url');
    $.ajax({
        url: url,
        type: 'get',
        cache: false,
        processData: false,
        contentType: false,
        success: function(response){
            if (response.status == 'success') {
                $('#edit_lead_modal').html(response.content);
                $('#edit_lead_modal').modal('show');
                $("#edit_module").validate({
                    ignore: [],
                    rules: module_rules,
                    messages: module_msgs,
                    //perform an AJAX post to ajax.php
                    submitHandler: function() {
                        return true;
                    }
                });
                $('.close-modal').on('click', function(){
                    $('#edit_lead_modal').modal('hide');
                });
            }else{
                toastr.error('No module found');
            }
        }
    });
});

// end edit module

/* start submodule validation */
var sub_module_rules = {
    module_id: {
        required: true
    },
    name: {
        required: true
    },
    slug: {
        required: true,
        noSpace : true
    },
}

var sub_module_msgs = {
    "module_id":{
        required:"Module name is required."
    },
    "name":{
        required:"Name is required."
    },
    "slug":{
        required:"Slug is required.",
        noSpace:"Space and capital letters are not valid input.",
    },
}

$('#add_subModule_btn').on('click',function(){
    $('#add_subModule_modal').modal('show');
});
$('.close-subModule-modal').on('click', function(){
    $('#add_subModule_modal').modal('hide');
});

/* end submodule validation */

// Start add submodule
$("#store_submodule").validate({
    ignore: [],
    rules: sub_module_rules,
    messages: sub_module_msgs,
    //perform an AJAX post to ajax.php
    submitHandler: function() {
        return true;
    }
});
// End add submodule

// Start edit submodule
$(document).on("click",".edit_subModule",function (e) {
    e.preventDefault();
    var id = $(this).attr('id');
    var url = $(this).data('url');
    $.ajax({
        url: url,
        type: 'get',
        cache : false,
        processData: false,
        contentType: false,
        success: function(response){
            if(response.status == 'success'){
                $('#edit_subModule_modal').html(response.content);
                $('#edit_subModule_modal').modal('show');
                $("#edit_submodule").validate({
                    ignore: [],
                    rules: sub_module_rules,
                    messages: sub_module_msgs,
                    //perform an AJAX post to ajax.php
                    submitHandler: function() {
                        return true;
                    }
                });
                $('.close-modal').on('click',function(){
                    $('#edit_subModule_modal').modal('hide');
                })
            }else{
                toastr.error('No submodule found');
            }
        },
        error: function(error){
            toastr.error('Something went wrong');
        }
    });
});
// End edit submodule

$(document).on('click','.selected_permission_rows',function(){
    var slug  = $(this).data('slug');
    var URL = $(this).data('url');

    if($(this).is(":checked")){
        $(this).attr('checked', true);
        var status = 1;
    }
    else if($(this).is(":not(:checked)")){
        $(this).attr('checked', false);
        var status = 0;
    }

    $.ajax({
        url:URL,
        type:'post',
        dataType: "JSON",
        data: {slug : slug, status:status},
        success: function (response)
        {
            toastr.success(response.message);
        },
        error: function(xhr) {
        }
    });
});

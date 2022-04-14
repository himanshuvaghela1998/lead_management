const { method } = require("lodash");

$(document).ready(function(){

    $(document).on('keyup', '#filter_form #search_text', function(event){
       event.preventDefault();
       if ($(this).val().length > 2 || $(this).val().length == 0) {
           alert($(this).val().length > 2);
           $('#hidden_page').val(0);
           $('#customer_filter_form').trigger('submit');
       }
    });

    // $(document).on('click', '.customer-pagination .pagination a', function(event){
    //     event.preventDefault();
    //     var page = $(this).attr('href').split('page=')[1];
    //     // alert(page);
    //     console.log(page);
    //     $('#hidden_page').val(page);
    //     $('#customer_filter_form').trigger('submit');
    //  });


    // $(document).on('submit', '#customer_filter_form', function(event){
    //     event.preventDefault();
    //     var request_url = $(this).attr('action')
    //     var request_Data = $(this).serialize();
    //     fetch_data(request_url, request_Data);
    //  });

    // function fetch_data(request_url, request_Data)
    // {
    //  $.ajax({
    //      url:request_url,
    //      method:"GET",
    //      data:request_Data,
    //      success:function(data)
    //      {
    //         $('#main-content').html(data.content);
    //      }
    //    });
    // }

   });


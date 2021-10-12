$(document).ready(function () {
    $("#search_term_submit").click();

    $("button.btn.btn--toggle-filter").click(function () {
        $(".reference-search .inner.open ").append('<button type="button" class="addtocontentrefrence" id="add-sel"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>');
    });
  
    $('.selectedvalue').on('click', '#close-selected', function () {
        $(this).parents('.selectedcol').fadeOut();
    });
    $("button.close.btn.innerpopup").click(function () {
        $('#Favourites').modal('hide');
    });


    $('.checked_all').on('change', function () {
        $('.checkbox').prop('checked', $(this).prop("checked"));
    });

    $('.checkbox').change(function () {
        if ($('.checkbox:checked').length == $('.checkbox').length) {
        
            $('.checked_all').prop('checked', true);
        } else {
            $('.checked_all').prop('checked', false);
        }
    });


    $("#delete_icon").click(function () {
        var f_ids = [];
        $.each($("input[name='check_video']:checked"), function () {
            f_ids.push($(this).val());
        });
        if(f_ids.length>0)
        {
            var all_id = f_ids.join(",")
            console.log("all_id check", all_id);
            $("#user_id").val(all_id);
        }
        else
        {
            alert('Please Select atleast one User!!');
            return false;
        }
       
    });

    $("#yes_button").click(function () {
        if ($('.checkbox:checked').length > 0) {
            var ids = $("#user_id").val();
            $.ajax({
                url: "/deleteBulkUser",
                type: "post",
                data: {
                    'user_ids': ids,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {

                    if (data.delete_status == true) {
                        // start ajax call for delete
                    
                        var search_term = $('#search_term').val();
                        var pg_page = $(".current_page").data('page');
                        $.ajax({
                            url: "/userfilter",
                            type: "post",
                            data:'&search_term=' + search_term + '&page=' + pg_page,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: 'JSON',
                            success: function (response) {
                               
                                if (response.status) {
                                    $("#exampleModalLong").modal('hide');
                                    $('#delete_msg').show();
                                    $('.tableBody').html(response.listhtml);
                                    var link = response.data.payload.links;
                                    var pagination = link.slice(1, -1)
                                    var pre = response.data.payload.current_page - 1;
                                    var next = response.data.payload.current_page + 1;
                                    if (response.data.payload.total == 0) {
                                        $('.tableBody').html('<tr> <td colspan="9" style="text-align: center;"> No Record Found </td></tr>');
                                        $('.ajax_pagination').html('');
                                        $('.showing_page_data').text('Showing 0 of 0 results');
                                    } else {
                                        var previousLink = '<li class="page-item "><a class="page-link pagination_link" data-view="search" data-page="' + pre + '" href="javascript:void(0);">Previous</a></li>';
                                        $('.ajax_pagination').html(previousLink);
                                        $.each(pagination, function (index, value) {
                                            if (value.active == true) {
                                                var activeCls = 'active';
                                            } else {
                                                var activeCls = '';
                                            }
                                            var paginationLink = '<li class="page-item ' + activeCls + '"><a class="page-link pagination_link" data-view="search" data-page="' + value.label + '" href="javascript:void(0);">' + value.label + '</a></li>';
                                            $('.ajax_pagination').append(paginationLink);
                                        });
                                        var nextLink = '<li class="page-item "><a class="page-link pagination_link" data-view="search" data-page="' + next + '" href="javascript:void(0);">Next</a></li>';
                                        $('.ajax_pagination').append(nextLink);
                                        $('.showing_page_data').text('Showing ' + response.data.payload.from + ' - ' + response.data.payload.to + ' of ' + response.data.payload.total + ' results');
                                    }

                                } else if (response.status == false) {
                                    $('.tableBody').html('<tr> <td colspan="9" style="text-align: center;"> No Record Found </td></tr>');
                                    $('.ajax_pagination').html('');
                                    $('.showing_page_data').text('Showing 0 of 0 results');
                                }

                            },
                            error: function (response) {}
                        });

                    }
                    else{
                        console.log('Unable to Detele');
                        $("#exampleModalLong").modal('hide');
                        $('#un_delete_msg').show();
                    }
                    
                }

            });
            // End Bulk dletes

            // $("#deleteBulkarticle").submit();
        } else {
            var id = $('#single_user_id').val();
            $.ajax({
                url: "/deleteUser",
                type: "post",
                data: {
                    'user_id': id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                  ;
                    console.log(data.delete_status);
                  
                    if (data.delete_status == true) {
                        // start ajax call for delete

                        var search_term = $('#search_term').val();
                        var pg_page = $(".current_page").data('page');
                        $.ajax({
                            url: "/userfilter",
                            type: "post",

                            data:'&search_term=' + search_term + '&page=' + pg_page,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: 'JSON',
                            success: function (response) {
                             
                                if (response.status) {
                                    $("#exampleModalLong").modal('hide');
                                    $('#delete_msg').show();
                                    $("#delete_msg").focus();
                                    $('.tableBody').html(response.listhtml);
                                    $('.gride_ajax_data').html(response.gridehtml);
                                    var link = response.data.payload.links;
                                    var pagination = link.slice(1, -1)
                                    var pre = response.data.payload.current_page - 1;
                                    var next = response.data.payload.current_page + 1;
                                    if (response.data.payload.total == 0) {
                                        $('.tableBody').html('<tr> <td colspan="9" style="text-align: center;"> No Record Found </td></tr>');
                                        $('.gride_ajax_data').html(' <li  style="text-align: center;margin: 0px 50px"> No Record Found </li>');
                                        $('.ajax_pagination').html('');
                                        $('.showing_page_data').text('Showing 0 of 0 results');
                                    } else {
                                        var previousLink = '<li class="page-item "><a class="page-link pagination_link" data-view="search" data-page="' + pre + '" href="javascript:void(0);">Previous</a></li>';
                                        $('.ajax_pagination').html(previousLink);
                                        $.each(pagination, function (index, value) {
                                            if (value.active == true) {
                                                var activeCls = 'active';
                                            } else {
                                                var activeCls = '';
                                            }
                                            var paginationLink = '<li class="page-item ' + activeCls + '"><a class="page-link pagination_link" data-view="search" data-page="' + value.label + '" href="javascript:void(0);">' + value.label + '</a></li>';
                                            $('.ajax_pagination').append(paginationLink);
                                        });
                                        var nextLink = '<li class="page-item "><a class="page-link pagination_link" data-view="search" data-page="' + next + '" href="javascript:void(0);">Next</a></li>';
                                        $('.ajax_pagination').append(nextLink);
                                        $('.showing_page_data').text('Showing ' + response.data.payload.from + ' - ' + response.data.payload.to + ' of ' + response.data.payload.total + ' results');
                                    }

                                } else if (response.status == false) {
                                    $('.tableBody').html('<tr> <td colspan="9" style="text-align: center;"> No Record Found </td></tr>');
                                    $('.gride_ajax_data').html(' <li  style="text-align: center;margin: 0px 50px"> No Record Found </li>');
                                    $('.ajax_pagination').html('');
                                    $('.showing_page_data').text('Showing 0 of 0 results');
                                }

                            },
                            error: function (response) {}
                        });

                    }
                    else{
                        console.log('Unable to Detele');
                        $("#exampleModalLong").modal('hide');
                        $('#un_delete_msg').show();
                    }
                    
                }

            });


            // end ajax call 
            // $(".deleteSingleUser").submit();
        }
    });


   
    $(".firstLng,.firstStatus").change(function () {
        var FilterBylanguage = $('select.firstLng').val();
        var FilterBystatus = $('select.firstStatus').val();
        // $('.secondLng').selectpicker('val', [FilterBylanguage]);
        $('.secondLng').val(FilterBylanguage);
        $('.secondStatus').val(FilterBystatus);
        $('.secondLng').selectpicker('refresh');
        $('.secondStatus').selectpicker('refresh');

    });

    $(".secondLng,.secondStatus").change(function () {
        var FilterBylanguage = $('select.secondLng').val();
        var FilterBystatus = $('select.secondStatus').val();
        // $('.secondLng').selectpicker('val', [FilterBylanguage]);
        $('.firstLng').val(FilterBylanguage);
        $('.firstStatus').val(FilterBystatus);
        $('.firstLng').selectpicker('refresh');
        $('.firstStatus').selectpicker('refresh');

    });


    // Tags that
$("#inputTag").select2({
    minimumInputLength: 2,
    tags: [],
    ajax: {
        url: "/articletagList",
        dataType: 'json',
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        type: "POST",
        success: function (res){
           $.each(res.data, function (index, value) {
            var option = '<option>'+value.label+'</option>';
            $('#inputTag').append(option);
        });
        $(".taginput-item").select2({
            tags: true,
            tokenSeparators: [',', ' ']
    })
         },
    }
});
// End Tags 
});

$(document).on("click", ".single_delete_icon", function (e) {
    // e.preventDefault();
    var id = $(this).attr('id');
    $('#single_user_id').val(id);
    // $('#exampleModalLong').modal('show');
});

$(".listview").click(function () {
    $('.listing_table').show();
    $('.gride_ajax_data').hide();
    $('.gride_checked_all').hide();
    $('.checkbox,.checked_all').prop('checked', false);
});

$(document).on("click", "#search_term_submit", function () {
  
    var search_term = $('#search_term').val();
    var pg_page = $(".current_page").data('page');
    
    $.ajax({
        url: "/userfilter",
        type: "post",
        data: '&search_term=' + search_term + '&page=' + pg_page,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'JSON',
        success: function (response) {
            console.log(response);
            if (response.status) {
                $('.tableBody').html(response.listhtml);
                var link = response.data.payload.links;
                var pagination = link.slice(1, -1)
                var pre = response.data.payload.current_page - 1;
                var next = response.data.payload.current_page + 1;
                if (response.data.payload.total == 0) {
                    $('.tableBody').html('<tr> <td colspan="9" style="text-align: center;"> No Record Found </td></tr>');
                    $('.ajax_pagination').html('');
                    $('.showing_page_data').text('Showing 0 of 0 results');
                } else {
                    var previousLink = '<li class="page-item "><a class="page-link pagination_link" data-view="search" data-page="' + pre + '" href="javascript:void(0);">Previous</a></li>';
                    $('.ajax_pagination').html(previousLink);
                    $.each(pagination, function (index, value) {
                        if (value.active == true) {
                            var activeCls = 'active';
                        } else {
                            var activeCls = '';
                        }
                        var paginationLink = '<li class="page-item ' + activeCls + '"><a class="page-link pagination_link" data-view="search" data-page="' + value.label + '" href="javascript:void(0);">' + value.label + '</a></li>';
                        $('.ajax_pagination').append(paginationLink);
                    });
                   
                    console.log("Next : "+response.data.payload.next_page_url);
                    if (response.data.payload.next_page_url==null) {
                        console.log("Next if");
                        var nextLink = '<li class="page-item "><a class="page-link" data-page="" href="javascript:void(0);">Next</a></li>';
                    $('.ajax_pagination').append(nextLink);
                    } else {
                        console.log("Next else");
                        var nextLink = '<li class="page-item "><a class="page-link pagination_link" data-view="search" data-page="' + next + '" href="javascript:void(0);">Next</a></li>';
                    $('.ajax_pagination').append(nextLink);
                    }
                    $('.showing_page_data').text('Showing ' + response.data.payload.from + ' - ' + response.data.payload.to + ' of ' + response.data.payload.total + ' results');
                }

            } else if (response.status == false) {
                $('.tableBody').html('<tr> <td colspan="9" style="text-align: center;"> No Record Found </td></tr>');
                $('.ajax_pagination').html('');
                $('.showing_page_data').text('Showing 0 of 0 results');
            }
        },
        error: function( xhr, status, errorThrown ) {
            alert( errorThrown );
        },
    });
});



$(document).on("click", ".apply", function (e) {
    e.preventDefault();
    var search_term = $('#search_term').val();
    $.ajax({
        url: "/userfilter",
        type: "post",
        data: '&search_term=' + search_term,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'JSON',
        success: function (response) {
            if (response.status == true) {
                $("#Allfilter").modal('hide');
                $('.tableBody').html(response.listhtml);
                var link = response.data.payload.links;
                var pagination = link.slice(1, -1)
                var pre = response.data.payload.current_page - 1;
                var next = response.data.payload.current_page + 1;
                if (response.data.payload.total == 0) {
                    $('.tableBody').html('<tr> <td colspan="9" style="text-align: center;"> No Record Found </td></tr>');
                    $('.ajax_pagination').html('');
                    $('.showing_page_data').text('Showing 0 of 0 results');
                } else {
                    var previousLink = '<li class="page-item "><a class="page-link pagination_link" data-view="search" data-page="' + pre + '" href="javascript:void(0);">Previous</a></li>';
                    $('.ajax_pagination').html(previousLink);
                    $.each(pagination, function (index, value) {
                        if (value.active == true) {
                            var activeCls = 'active';
                        } else {
                            var activeCls = '';
                        }
                        var paginationLink = '<li class="page-item ' + activeCls + '"><a class="page-link pagination_link" data-view="search" data-page="' + value.label + '" href="javascript:void(0);">' + value.label + '</a></li>';
                        $('.ajax_pagination').append(paginationLink);
                        
                    });
                    var nextLink = '<li class="page-item "><a class="page-link pagination_link" data-view="search" data-page="' + next + '" href="javascript:void(0);">Next</a></li>';
                    $('.ajax_pagination').append(nextLink);
                    $('.showing_page_data').text('Showing ' + response.data.payload.from + ' - ' + response.data.payload.to + ' of ' + response.data.payload.total + ' results');
                }
            } else if (response.status == false) {

                $('.tableBody').html('<tr> <td colspan="9" style="text-align: center;"> No Record Found </td></tr>');
                $('.ajax_pagination').html('');
                $('.showing_page_data').text('Showing 0 of 0 results');
            }
        },

        error: function (response) {}
    });
});

$('#search_term').keypress(function (e) {
    var key = e.which;
    if (key == 13) {
        $("#search_term_submit").click();
    }
});

$(document).on("click", ".pagination_link", function () {

    var pg_page = $(this).data('page');
    $(this).addClass('current_page');
    var view = $(this).data('view');
    $("#search_term_submit").click();
});
$("#search_term_submit").click();

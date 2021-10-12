$(document).ready(function () {
    $("#search_term_submit").click();

    $("button.btn.btn--toggle-filter").click(function () {
        $(".reference-search .inner.open ").append('<button type="button" class="addtocontentrefrence" id="add-sel"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>');
    });
    $("button.btn.btn--toggle-filter").click(function () {
        $("button#add-sel").click(function () {
            var optionsselected = $("select#browsers").val();

            $('.selectedvalue').html("");
            $.each(optionsselected, function (i, x) {

                $('.selectedvalue').append('<div class=" selectedcol ">' + x + '<span id="close-selected" > <i class="mdi mdi-close fa-fw" data-icon="v"></i>  </span> </div>')
            });
            //$('div#Allfilter .reference-search ul.dropdown-menu.inner li.selected').hide();  
        });
        $('.selectedvalue').on('click', '#close-selected', function () {
            $(this).parents('.selectedcol').fadeOut();
        });

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
            $("#article_id").val(all_id);
        }
        else
        {
            alert('Please Select atleast one Article!!');
            return false;
        }
       
    });

    $("#yes_button").click(function () {
        if ($('.checkbox:checked').length > 0) {
            var ids = $("#article_id").val();
            var single_article_id = $('#single_article_id').val();
            $.ajax({
                url: "/bulkdeletearticles",
                type: "post",
                data: {
                    'article_ids': ids,
                    'article_id': single_article_id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {

                    if (data.delete_status == true) {
                        $('#single_article_id').val('');
                        // start ajax call for delete
                        var FilterBylanguage = $('select.FilterBylanguage').val();
                        var FilterBystatus = $('select.FilterByStatus').val();
                        var max_item = $('.max_item_filter').val();
                        var sortby = $('.sortby_filter').val();
                        var show_content_from = $('.show_content_from_filter').val();
                        var search_term = $('#search_term').val();
                        var formData = $(".AllFilterForm").serialize();
                        var pg_page = $(".current_page").data('page');
                        $.ajax({
                            url: "/atriclefilter",
                            type: "post",

                            data: formData + '&lang=' + FilterBylanguage + '&current_status=' + FilterBystatus + '&max_items=' + max_item + '&sortby=' + sortby + '&show_content_from=' + show_content_from + '&search_term=' + search_term + '&page=' + pg_page,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: 'JSON',
                            success: function (response) {
                               
                                if (response.status) {
                                    $("#exampleModalLong").modal('hide');
                                    $('#delete_msg').show();
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
            // End Bulk dletes

            // $("#deleteBulkarticle").submit();
        } else {
            var id = $('#single_article_id').val();
            $.ajax({
                url: "/articledelete",
                type: "post",
                data: {
                    'article_id': id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    console.log(data.delete_status);
                    if (data.delete_status == true) {
                        // start ajax call for delete
                        var FilterBylanguage = $('select.FilterBylanguage').val();
                        var FilterBystatus = $('select.FilterByStatus').val();
                        var max_item = $('.max_item_filter').val();
                        var sortby = $('.sortby_filter').val();
                        var show_content_from = $('.show_content_from_filter').val();
                        var search_term = $('#search_term').val();
                        var formData = $(".AllFilterForm").serialize();
                        var pg_page = $(".current_page").data('page');
                        $.ajax({
                            url: "/atriclefilter",
                            type: "post",

                            data: formData + '&lang=' + FilterBylanguage + '&current_status=' + FilterBystatus + '&max_items=' + max_item + '&sortby=' + sortby + '&show_content_from=' + show_content_from + '&search_term=' + search_term + '&page=' + pg_page,
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


    $(".content_ref").change(function () {
        var value = $(this).val();
        var dropdown = $(this).data('type');
        if (value) {
            $.ajax({
                type: "POST",
                url: "/referanceRelated",
                data: {
                    'dropdown': dropdown,
                    'type': value
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {

                    if (dropdown == 'related') {
                        $.each(res.data, function (index, value) {
                            $('.relatedResponse').selectpicker('refresh');
                            var lang = (value.language) ? value.language : '';
                            var option = '<option value="<h2>'+value.title +'</h2> <span>'+lang +'|'+ 'Last updated 31/08/2021</span> <span >ID:'+value.ID+'</span>"><h2>'+value.title +'</h2> <span class="lan">'+lang +'|'+ 'Last updated 31/08/2021</span> <span class="id">ID:'+value.ID+'</span></option>';
                            $('select.relatedResponse').append(option);
                        });

                    } else {

                        $.each(res.data, function (index, value) {
                            $('.referencesResponse').selectpicker('refresh');
                            console.log(value.language);
                            var lang = (value.language) ? value.language : '';
                            var option = '<option value="<h2>'+value.title +'</h2> <span>'+lang +'|'+ 'Last updated 31/08/2021</span> <span >ID:'+value.ID+'</span>"><h2>'+value.title +'</h2> <span class="lan">'+lang +'|'+ 'Last updated 31/08/2021</span> <span class="id">ID:'+value.ID+'</span></option>';
                            $('select.referencesResponse').append(option);
                        });

                    }

                },
                error: function () {
                    return false;
                },
                complete: function () {
                    console.log('complete');
                }
            })
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
    $('#single_article_id').val(id);
    // $('#exampleModalLong').modal('show');
});

$(".listview").click(function () {
    $('.listing_table').show();
    $('.gride_ajax_data').hide();
    $('.gride_checked_all').hide();
    $('.checkbox,.checked_all').prop('checked', false);
});

$(".gridview").click(function () {
    $('.listing_table').hide();
    $('.gride_ajax_data').show();;
    $('.gride_checked_all').show();
    $('.checkbox,.checked_all').prop('checked', false);
});


$(document).on("click", ".apply", function (e) {

    e.preventDefault();
    var FilterBylanguage = $('select.FilterBylanguage').val();
    var FilterBystatus = $('select.FilterByStatus').val();
    var max_item = $('select.max_item_filter').val();
    var sortby = $('.sortby_filter').val();
    var show_content_from = $('.show_content_from_filter').val();
    var search_term = $('#search_term').val();
    var formData = $(".AllFilterForm").serialize();
    $.ajax({
        url: "/atriclefilter",
        type: "post",
        data: formData + '&lang=' + FilterBylanguage + '&current_status=' + FilterBystatus + '&max_items=' + max_item + '&sortby=' + sortby + '&show_content_from=' + show_content_from + '&search_term=' + search_term,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'JSON',
        success: function (response) {
            if (response.status == true) {
                $("#Allfilter").modal('hide');
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
                $('.gride_ajax_data').html(' <li  style="text-align: center;margin:50px"> No Record Found </li>');
                $('.ajax_pagination').html('');
                $('.showing_page_data').text('Showing 0 of 0 results');
            }
        },

        error: function (response) {}
    });
});


$('.max_item_filter,.sortby_filter,.show_content_from_filter').change(function () {
    var FilterBylanguage = $('select.FilterBylanguage').val();
    var FilterBystatus = $('select.FilterByStatus').val();
    var max_item = $('.max_item_filter').val();
    var sortby = $('.sortby_filter').val();
    var show_content_from = $('.show_content_from_filter').val();
    var search_term = $('#search_term').val();
    var formData = $(".AllFilterForm").serialize();
    $.ajax({
        url: "/atriclefilter",
        type: "post",

        data: formData + '&lang=' + FilterBylanguage + '&current_status=' + FilterBystatus + '&max_items=' + max_item + '&sortby=' + sortby + '&show_content_from=' + show_content_from + '&search_term=' + search_term,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'JSON',
        success: function (response) {
          
            if (response.status == true) {
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
                $('.gride_ajax_data').html(' <li  style="text-align: center;margin:50px"> No Record Found </li>');
                $('.ajax_pagination').html('');
                $('.showing_page_data').text('Showing 0 of 0 results');
            }
        },
        error: function (response) {}
    });
});

$('.goto').keypress(function (e) {
    var key = e.which;
    if (key == 13) {
        $(".goto_submit").click();
    }
});

$(document).on("click", "#search_term_submit,.goto_submit", function () {

    var FilterBylanguage = $('select.FilterBylanguage').val();
    var FilterBystatus = $('select.FilterByStatus').val();
    var max_item = $('.max_item_filter').val();
    var sortby = $('.sortby_filter').val();
    var show_content_from = $('.show_content_from_filter').val();
    var search_term = $('#search_term').val();
    var formData = $(".AllFilterForm").serialize();
    // var pg_page = $(".current_page").data('page');
    var pg_page = ($(".current_page").data('page')) ? $(".current_page").data('page') : $(".goto").val();
    // alert(pg_page);
    $(".goto").val(pg_page);
    $.ajax({
        url: "/atriclefilter",
        type: "post",

        data: formData + '&lang=' + FilterBylanguage + '&current_status=' + FilterBystatus + '&max_items=' + max_item + '&sortby=' + sortby + '&show_content_from=' + show_content_from + '&search_term=' + search_term + '&page=' + pg_page,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'JSON',
        success: function (response) {
            if (response.status) {
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


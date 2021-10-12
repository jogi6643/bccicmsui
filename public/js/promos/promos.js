$(document).ready(function () {
    $(".search_term_submit").click();

    $("button.btn.btn--toggle-filter").click(function () {
        $(".reference-search .inner.open ").append('<button type="button" class="addtocontentrefrence" id="add-sel"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>');
    });
    $("button.btn.btn--toggle-filter").click(function () {
        $("button#add-sel").click(function () {
            var optionsselected = $("select#browsers").val();
          
            $('.selectedvalue').html("");
            $.each(optionsselected, function (i, x) {

                $('.selectedvalue').append('<div class=" selectedcol ">' + x + '<span class="close-selected" > <i class="mdi mdi-close fa-fw" data-icon="v"></i>  </span> </div>')
            });
            //$('div#Allfilter .reference-search ul.dropdown-menu.inner li.selected').hide();  
        });
        $('.selectedvalue').on('click', '.close-selected', function () {
            $(this).parents('.selectedcol').fadeOut();
        });

    });
    $('.selectedvalue').on('click', '.close-selected', function () {
        $(this).parents('.selectedcol').fadeOut();
    });
    $("button.close.btn.innerpopup").click(function () {
        $('#Favourites').modal('hide');
    });





});

setTimeout(function () {
    $('.error_message').html('');
}, 10000);

$(document).on("click", ".single_delete_icon", function () {
    var id = $(this).data('id');
    $(".yes_button_single").attr("href", APP_URL + "/contentList/deletePromos/" + id);
    $('#single_user_id_form').val(id);
    $('#exampleModalLong').modal('show');
});


$(".listview").click(function () {
    $('.promos_listing_table').show();
    $('.gride_ajax_data').hide();
    $('.gride_checked_all').hide();
    $('.checkbox,.checked_all').prop('checked', false);
});

$(".gridview").click(function () {
    $('.promos_listing_table').hide();
    $('.gride_ajax_data').show();;
    $('.gride_checked_all').show();
    $('.checkbox,.checked_all').prop('checked', false);
});

$(".delete_icon").click(function () {
    var f_ids = [];
    $.each($("input[name='check_user']:checked"), function () {
        f_ids.push($(this).val());
    });

    var all_id = f_ids.join(",")
    console.log(all_id);
    $("#promos_id").val(all_id);
    if (all_id.length > 0) {
        $('#allModalLong').modal('show');
        return false;
    }
    else {
        alert('Please Select atleast one Promos!!');
        return false;
    }
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
        url: "/contentList/filter",
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
                var previousLink = '<li class="page-item "><a class="page-link pagination_link" data-view="search" data-page="' + pre + '" href="javascript:void(0);">Previous</a></li>';
                $('.ajax_pagination').html(previousLink);
                $.each(pagination, function (index, value) {
                    if (value.active == true) { var activeCls = 'active'; } else { var activeCls = ''; }
                    var paginationLink = '<li class="page-item ' + activeCls + '"><a class="page-link pagination_link" data-view="search" data-page="' + value.label + '" href="javascript:void(0);">' + value.label + '</a></li>';
                    $('.ajax_pagination').append(paginationLink);
                });
                var nextLink = '<li class="page-item "><a class="page-link pagination_link" data-view="search" data-page="' + next + '" href="javascript:void(0);">Next</a></li>';
                $('.ajax_pagination').append(nextLink);
                $('.showing_page_data').text('Showing ' + response.data.payload.from + ' - ' + response.data.payload.to + ' of ' + response.data.payload.total + ' results');
            } else if (response.status == false) {
                $('.tableBody').html('<tr> <td colspan="9" style="text-align: center;"> No Record Found </td></tr>');
                $('.gride_ajax_data').html(' <li  class="no_record" style="text-align: center;margin: 30px  500px 0px  500px "> No Record Found </li>');
                $('.ajax_pagination').html('');
                $('.showing_page_data').text('Showing 0 of 0 results');
            }
        },
        error: function (response) {
        }
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
        url: "/contentList/filter",
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
                var previousLink = '<li class="page-item "><a class="page-link pagination_link" data-view="search" data-page="' + pre + '" href="javascript:void(0);">Previous</a></li>';
                $('.ajax_pagination').html(previousLink);
                $.each(pagination, function (index, value) {
                    if (value.active == true) { var activeCls = 'active'; } else { var activeCls = ''; }
                    var paginationLink = '<li class="page-item ' + activeCls + '"><a class="page-link pagination_link" data-view="search" data-page="' + value.label + '" href="javascript:void(0);">' + value.label + '</a></li>';
                    $('.ajax_pagination').append(paginationLink);
                });
                var nextLink = '<li class="page-item "><a class="page-link pagination_link" data-view="search" data-page="' + next + '" href="javascript:void(0);">Next</a></li>';
                $('.ajax_pagination').append(nextLink);
                $('.showing_page_data').text('Showing ' + response.data.payload.from + ' - ' + response.data.payload.to + ' of ' + response.data.payload.total + ' results');
            } else if (response.status == false) {
                $('.tableBody').html('<tr> <td colspan="9" style="text-align: center;"> No Record Found </td></tr>');
                $('.gride_ajax_data').html(' <li  class="no_record" style="text-align: center;margin: 30px  500px 0px  500px"> No Record Found </li>');
                $('.ajax_pagination').html('');
                $('.showing_page_data').text('Showing 0 of 0 results');
            }
        },
        error: function (response) {
        }
    });
});


$(document).on("click", ".search_term_submit,.goto_submit", function () {
    var FilterBylanguage = $('select.FilterBylanguage').val();
    var FilterBystatus = $('select.FilterByStatus').val();
    var max_item = $('.max_item_filter').val();
    var sortby = $('.sortby_filter').val();
    var show_content_from = $('.show_content_from_filter').val();
    var search_term = $('#search_term').val();
    var formData = $(".AllFilterForm").serialize();
    var pg_page = ($(".current_page").data('page')) ? $(".current_page").data('page') : $(".goto").val();
    $(".goto").val(pg_page);
    $.ajax({
        url: "/contentList/filter",
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
                var previousLink = '<li class="page-item "><a class="page-link pagination_link" data-view="search" data-page="' + pre + '" href="javascript:void(0);">Previous</a></li>';
                $('.ajax_pagination').html(previousLink);
                $.each(pagination, function (index, value) {
                    if (value.active == true) { var activeCls = 'active'; } else { var activeCls = ''; }
                    var paginationLink = '<li class="page-item ' + activeCls + '"><a class="page-link pagination_link" data-view="search" data-page="' + value.label + '" href="javascript:void(0);">' + value.label + '</a></li>';
                    $('.ajax_pagination').append(paginationLink);
                });
                var nextLink = '<li class="page-item "><a class="page-link pagination_link" data-view="search" data-page="' + next + '" href="javascript:void(0);">Next</a></li>';
                $('.ajax_pagination').append(nextLink);
                $('.showing_page_data').text('Showing ' + response.data.payload.from + ' - ' + response.data.payload.to + ' of ' + response.data.payload.total + ' results');

            }
            else if (response.status == false) {
                $('.tableBody').html('<tr> <td colspan="9" style="text-align: center;"> No Record Found </td></tr>');
                $('.gride_ajax_data').html(' <li class="no_record" style="text-align: center;margin: 30px  500px 0px  500px"> No Record Found </li>');
                $('.ajax_pagination').html('');
                $('.showing_page_data').text('Showing 0 of 0 results');

            }
        },
        error: function (response) {
        }
    });
});


$('#search_term').keypress(function (e) {
    var key = e.which;
    if (key == 13) {
        $(".search_term_submit").click();
    }
});

$('.goto').keypress(function (e) {
    var key = e.which;
    if (key == 13) {
        $(".goto_submit").click();
    }
});

$(document).on("click", ".pagination_link", function () {
    var pg_page = $(this).data('page');
    $(this).addClass('current_page');
    var view = $(this).data('view');
    $(".search_term_submit").click();
});


$(document).ready(function () {
    $("#latitudeArea").addClass("d-none");
    $("#longtitudeArea").addClass("d-none");
});
google.maps.event.addDomListener(window, 'load', initialize);

function initialize() {
    var input = document.getElementById('promoslocationsearch');
    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener('place_changed', function () {
        var place = autocomplete.getPlace();
        $('#latitudepromos').val(place.geometry['location'].lat());
        $('#longitudepromos').val(place.geometry['location'].lng());

        $("#latitudeArea").removeClass("d-none");
        $("#longtitudeArea").removeClass("d-none");
    });
}
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
        var view = $(".layout.active").data('view');
        $('.videoview').val(view);
        $('.deleteType').val('bulkDelete');
        var f_ids = [];
        $.each($("input[name='check_video']:checked"), function () {
            f_ids.push($(this).val());
        });
        var all_id = f_ids.join(",")
        if (all_id != "") {
            $("#video_id").val(all_id);
            $('#exampleModalLong').modal('show');
        } else {
            alert("Please select aleast one id")
            return false;
        }

    });

    $("#yes_button").click(function () {
        var deleteType = $('.deleteType').val();
        if (deleteType == "bulkDelete") {
            $("#deleteBulkVideo").submit();
        } else {
            $(".deleteSingleUser").submit();
        }
    });


    $(".content_ref").change(function () {
        var value = $(this).val();
        var dropdown = $(this).data('type');
        if (value) {
            $.ajax({
                type: "POST",
                url: "/referanceRelated",
                data: { 'dropdown': dropdown, 'type': value },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {

                    if (dropdown == 'related') {
                        $.each(res.data, function (index, value) {
                            $('.relatedResponse').selectpicker('refresh');
                            var lang = (value.language) ? value.language : '';
                            // var updateDate = ( value.language) ?  value.language : '';
                            var option = '<option value=' + value.ID + '><h2>' + value.title + '</h2> <span class="lan"> ' + lang + ' | ' + ' Last updated 00/00/0000</span> <span class="id">ID:' + value.ID + '</span></option>';
                            $('select.relatedResponse').append(option);
                        });

                    } else {

                        $.each(res.data, function (index, value) {
                            $('.referencesResponse').selectpicker('refresh');
                            var lang = (value.language) ? value.language : '';
                            var option = '<option value=' + value.ID + '><h2>' + value.title + '</h2> <span class="lan">' + lang + ' | ' + 'Last updated 00/00/0000</span> <span class="id">ID:' + value.ID + '</span></option>';
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


    $.ajax({
        type: "get",
        url: "/commonStatusLang",
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
            if (res.status == true) {
                $.each(res.lang_data.payload, function (index, value) {
                    let option = '<option value = "' + index + '"> ' + value + '</option>';
                    $('select.FilterBylanguage').append(option);
                    $('.FilterBylanguage').selectpicker('refresh');

                });

                $.each(res.status_data.payload, function (index, value) {
                    let option = '<option value = "' + index + '"> ' + value + '</option>';
                    $('select.FilterByStatus').append(option);
                    $('.FilterByStatus').selectpicker('refresh');

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

    $('.goto').keypress(function (e) {
        var key = e.which;
        if (key == 13) {
            $(".goto_submit").click();
        }
    });

    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $('#publish_date').datepicker({
        startDate: today,
        todayHighlight: true,
        onSelect: function (date) {
            $("#expiry_date").datepicker("startDate", endDate);
        }
    });

});


$(document).on("change", ".expiry_date", function () {
    var pulish_date = new Date($('.publish_date').val());
    var expiry_date = new Date($(this).val());
    if (pulish_date > expiry_date) {
        $('.Expiryerror').html('<p style="color:red">please select greater than publish date</p>');
        video_form
        $("input[type=submit]").prop("disabled", true);
    }else{
        $('.Expiryerror').html('');
        $("input[type=submit]").prop("disabled", false);
    }
});

$(document).on("click", ".single_delete_icon", function (e) {
    e.preventDefault();
    var id = $(this).attr('id');
    var view = $(this).data('view');
    $('.deleteType').val('singleDelete');
    // id = id.replace('delete_single_photo_', '');
    $('#single_video_id').val(id);
    $('.videoview').val(view);
    $('#exampleModalLong').modal('show');
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
        url: "/search",
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
        url: "/search",
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
        url: "/search",
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

$(document).on("click", ".pagination_link", function () {
    var pg_page = $(this).data('page');
    $(this).addClass('current_page');
    var view = $(this).data('view');
    $(".search_term_submit").click();
});

$(document).on("click", ".open-data", function () {

    var id = $(this).data('id');
    if (id != undefined && id != null) {
        $.ajax({
            type: 'GET',
            url: '/video/fetchVideo',
            data: {
                "id": id,
            },
            success: function (res) {

                if (res.data) {
                    console.log(res.data);
                    $('#title').html(res.data.title);
                    var video_url = res.data.video_url;
                    var thumb = res.data.video_url ? res.data.thumbnail_image : '/img/no-video.jpg';
                    $('#video_url').attr('src', video_url);
                    $('#video_url').attr('poster', thumb);
                    $('#Viewpage').modal('show');
                }
            },
            error: function (e) {
                alert(e);
            },
            complete: function () {

            }
        });
    }
})

$(document).ready(function () {
    $("#latitudeArea").addClass("d-none");
    $("#longtitudeArea").addClass("d-none");
});
google.maps.event.addDomListener(window, 'load', initialize);

function initialize() {
    var input = document.getElementById('videolocationsearch');
    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener('place_changed', function () {
        var place = autocomplete.getPlace();
        $('#latitudevideo').val(place.geometry['location'].lat());
        $('#longitudevideo').val(place.geometry['location'].lng());

        $("#latitudeArea").removeClass("d-none");
        $("#longtitudeArea").removeClass("d-none");
    });
}

function fileValidation(){
    var fileInput = document.getElementById('videofile');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.mp4|\.mkv|\.flv|\.webm)$/i;
    if(!allowedExtensions.exec(filePath)){
        $('#imagePreview').html('<strong style="color:red">Please Select .MP4/.mkv/.flv only.</strong>');

        fileInput.value = '';
        return false;
    }else{
        $('#imagePreview').html('');
    }
}

function fileValidation1(){
    var fileInput = document.getElementById('thumbnail_image');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.JPEG|\.PNG|\.GIF|\.TIFF|\.PSD|\.PDF|\.EPS|\.AI|\.INDD|\.RAW)$/i;
    if(!allowedExtensions.exec(filePath)){
        $('#imagePreview1').html('<strong style="color:red">Please Select .JPEG|.PNG|.GIF|.TIFF|.PSD|.PDF|.EPS|.AI|.INDD|.RAW type only.</strong>');
        fileInput.value = '';
        return false;
    }else{
        $('#imagePreview1').html('');
    }
}


$(document).ready(function () {

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
                        var option = '<option value=' + value.ID + '><h2>' + value.title + '</h2> <span class="lan"> ' + lang + ' | ' + ' Last updated 00/00/0000</span> <span class="id">ID:' + value.ID + '</span></option>';
                        $('select.relatedResponse').append(option);
                    });

                } else {
                       
                    $.each(res.data, function (index, value) {
                        $('.referencesResponse').selectpicker('refresh');
                        var lang = (value.language) ? value.language : '';
                        var option = '<option value="' + value.ID + '" data-value="' + value.title +  lang +'| Last updated 00/00/0000 "><h2>' + value.title + '</h2> <span class="lan">' + lang + ' | ' + 'Last updated 00/00/0000</span> <span class="id">ID:' + value.ID + '</span></option>';
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



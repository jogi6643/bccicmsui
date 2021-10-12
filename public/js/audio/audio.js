
    $(document).ready(function () {
        $("#clear_search").click(function () {
            $("#search_term").val('');
            $("#current_status").val('');
            $("#search_language").val('');
            location.reload();
            $(".filter-option-inner-inner").html('Nothing selected');
        });

        $("#apply_search,#search_term_submit").click(function () {
            load_data();
        });
        $("#max_items,#sort_by,#content_from").change(function () {
            load_data();
        });
        $("#go").click(function () {
            load_data();
        });
       
    });
    function load_data(){
       
        $.ajax({
            type: 'POST',
            url: '/audiosearchlist',
            data: {
                'search_term': $("#search_term").val(),
                'language': $("#search_language").val(),
                'current_status': $("#current_status").val(),
                'max_items': $("#max_items").val(),
                'sort_by': $("#sort_by").val(),
                'content_from': $("#content_from").val(),
                'order': 'desc',
            },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
            success: function (data) {
                $('#load_data').html(data.html);
            }
        });
    }


<script>
    $(document).ready(function () {
        $('#check_all').click(function () {
            if ($(this).prop("checked") == true) {
                $('.check_content').prop('checked', true);
            } else if ($(this).prop("checked") == false) {
                $('.check_content').prop('checked', false);
            }
        });

        $("#delete_icon").click(function () {
            var f_ids = [];
            $.each($("input[name='check_content']:checked"), function () {
                f_ids.push($(this).val());
            });
            var all_id = f_ids.join(",")
            $("#content_id").val(all_id);
        });

        $("#yes_delete").click(function () {
            $("#content_form").submit();
        });

        $("#clear_search").click(function () {
            $("#search_term").val('');
            $("#current_status").val('');
            $("#search_language").val('');
            location.reload();
            $(".filter-option-inner-inner").html('Nothing selected');
            //load_data();
        });

        $("#apply_search,#search_term_submit").click(function () {
            load_data();
            // alert($("#search_status").val());
            // alert($("#search_language").val());
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
            url: '/searchContent/articles',
            data: {
                "_token": "{{ csrf_token() }}",
                'search_term': $("#search_term").val(),
                'language': $("#search_language").val(),
                'current_status': $("#current_status").val(),
                'max_items': $("#max_items").val(),
                'sort_by': $("#sort_by").val(),
                'content_from': $("#content_from").val(),
                'go_to': $("#go_to").val(),
                'order': 'desc',
            },
            dataType: 'json',
            success: function (data) {
                $('#load_data').html(data.html);
            }
        });
    }
</script>

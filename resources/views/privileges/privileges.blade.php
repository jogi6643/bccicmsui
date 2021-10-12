@extends('base')
@section('epic_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<style type="text/css">
    button.btn.dropdown-toggle.bs-placeholder.btn-default {
        padding: 8px 11px;
    }
</style>

<div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"></h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{url('#')}}">User Management</a></li>
            <li class="active">Assign Role</li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
    <div class="row">
        <div class="col-md-12" style="margin-top:2%;">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <p class="box-title">Assign Role</p>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="form-body">
                            <hr>
                            <form method="POST" action="{{ route('update-previleges') }}" name="previleges_form" id="previleges_form" data-parsley-validate>
                                {{csrf_field()}}
                                <div class="row">
                                    @include('show_message')
                                    <input type="hidden" name="read_list" id="read_list">
                                    <input type="hidden" name="write_list" id="write_list">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Role Name</label>
                                            <select required name="user_role" class="form-control" id="user_role">
                                                <option value="">-- Select --</option>
                                                @foreach($privileges['data'] as $val)
                                                    <option  value="{{$val['role_id']}}" data-id="{{$val['role_name']}}">{{$val['role_name']}}</option>
                                                @endforeach
                                            </select>

{{--                                                        <span class="help-block"> <i>User Level</i> </span> </div>--}}
                                        </div>

                                        {{--<div class="form-group">
                                            <label class="control-label">Change Role Name</label>
                                            <input type="hidden"  class="form-control" name="role_name" id="role_name">
                                        </div>--}}
                                        <input type="hidden"  class="form-control" name="role_name" id="role_name">

                                    </div>

                                    <div class="">
                                        <div class="col-md-4 select-all">
                                            <div class="select-all-div">
                                                <input name="product_all" class="checked_all" type="checkbox">&nbsp; Select All Privillages
                                            </div>
                                         </div>

                           <!--table start select read and write access checkbox checkbox-->
                                        <table class="table table-hover table-bordered results access-role">
                                            <thead>
                                                <tr>
                                                <th>SR No</th>
                                                <th class="col-md-5 col-xs-5">Menu</th>
                                                <th class="col-md-4 col-xs-4">Read</th>
                                                <th class="col-md-3 col-xs-3">Write</th>
                                                </tr>
                                                <!-- <tr class="warning no-result">
                                                <td colspan="4"><i class="fa fa-warning"></i> No result</td>
                                                </tr> -->
                                            </thead>
                                            <tbody>
                                                @php $i = 1; @endphp
                                                @foreach($menu as $menu_name=>$sub_menu)
                                                @if(!empty($sub_menu))
                                                  <tr>
                                                      <td scope="row">{{$i}}</td>
                                                      <td style="font-weight: bold;">{{ucwords(str_replace("_"," ",$menu_name))}}</td>
                                                      <td></td>
                                                      <td></td>
                                                  </tr>

                                                  @foreach($sub_menu as $sub_menu_name)
                                                      <tr>
                                                          <td scope="row"></td>
                                                          <td>{{ucwords(str_replace("_"," ",$sub_menu_name))}}</td>
                                                          <td><input value="{{$sub_menu_name}}_read"  name="{{$sub_menu_name}}_read" class="read_pr checkbox form-element" type="checkbox"></td>
                                                          <td><input value="{{$sub_menu_name}}_write" name="{{$sub_menu_name}}_write" class="write_pr checkbox form-element" type="checkbox"></td>
                                                      </tr>
                                                  @endforeach
                                                @else
                                                  <tr>
                                                      <td scope="row">{{$i}}</td>
                                                      <td style="font-weight: bold;">{{ucwords(str_replace("_"," ",$menu_name))}}</td>
                                                      <td><input value="{{$menu_name}}_read"  name="{{$menu_name}}_read" class="read_pr checkbox form-element" type="checkbox"></td>
                                                      <td><input value="{{$menu_name}}_write" name="{{$menu_name}}_write" class="write_pr checkbox form-element" type="checkbox"></td>
                                                  </tr>
                                                @endif
                                                @php $i++; @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="text-left">
                                        <button class="submit" id="submit_privilege">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $(document).ready(function() {

        $('.checked_all').on('change', function() {
            $('.checkbox').prop('checked', $(this).prop("checked"));
        });
        //deselect "checked all", if one of the listed checkbox product is unchecked amd select "checked all" if all of the listed checkbox product is checked
        $('.checkbox').change(function(){ //".checkbox" change
            if($('.checkbox:checked').length == $('.checkbox').length){
                $('.checked_all').prop('checked',true);
            }else{
                $('.checked_all').prop('checked',false);
            }
        });

        $("#submit_privilege").click(function(){
            var read_list = [];
            var write_list = [];

            $.each($("input[name$='_read']:checked"), function(){
                var r_list = $(this).val().replace("_read", "");
                read_list.push(r_list);
            });

            $.each($("input[name$='_write']:checked"), function(){
                var w_list = $(this).val().replace("_write", "");
                write_list.push(w_list);
            });

            $("#read_list").val(read_list);
            $("#write_list").val(write_list);
        });

        $("#user_role").change(function(){
            var role_id = $(this).val();

            $.ajax({
                url: APP_URL+'/searchprivilege',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'role_id' : role_id
                },
                dataType: "json",
                success: function(data){
                    //update value in text boxes
                    $("#role_name").val(data.role_name);
                    $("#read_list").val(data.read);
                    $("#write_list").val(data.write);

                    //make object from comma separeted string
                    var read_checkbox_names = (data.read).split(',');
                    var write_checkbox_names = (data.write).split(',');

                    //clear previous
                    $("input[name$='_read']").prop('checked', false);
                    $("input[name$='_write']").prop('checked', false);

                    //check read write check boxes
                    $.each(read_checkbox_names, function (key, val) {
                        $("input[name='"+val+"_read']").prop('checked', true);
                    });

                    $.each(write_checkbox_names, function (key, val) {
                        $("input[name='"+val+"_write']").prop('checked', true);
                    });

                    //to mark/unmark Select All Privillages
                    $(".checkbox").change();
                }
            });
        });

        $('#user_role').on('change', function() {
            // var id = $(this).attr('data-id');
            var id = $(this).children("option:selected").attr('data-id');
            $('#role_name').val(id);
        });
    });
</script>
@stop

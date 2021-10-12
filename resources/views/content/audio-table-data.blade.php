  <div class="table-responsive">
      <table class="table table-striped table-hover table-bordered results list_view">
          <thead>
              <tr>
                  <th>
                      <form method="POST" action="{{ route('deleteBulkaudio') }}" name="user_form"
                          id="deleteBulkVideo" data-parsley-validate>
                          {{ csrf_field() }}
                          <input type="hidden" value="" name="video_id" id="video_id">
                          <input type="hidden" value="tableview" name="videoview" id="videoview">
                      </form>
                      <!-- <input id="check_all" name="product_all" type="checkbox" class="checked_all form-element"
                          type="checkbox">
                      <a class="view_delete" id="delete_icon" href="" data-original-title="Delete" type="button"
                          data-toggle="modal" data-target="#exampleModalLong"><i class="glyphicon glyphicon-trash"
                              style="color: #e20101"></i></a> -->
                  </th>
                  <th>ID
                      <!-- <i class="glyphicon glyphicon glyphicon-sort" ></i> -->
                  </th>
                  <th>Title
                      <!-- <i class="glyphicon glyphicon glyphicon-sort" ></i> -->
                  </th>
                  <th>Status
                      <!-- <i class="glyphicon glyphicon glyphicon-sort" ></i> -->
                  </th>
                  <th>Publication Date
                      <!-- <i class="glyphicon glyphicon glyphicon-sort" ></i> -->
                  </th>
                  <th>Last Updated
                      <!-- <i class="glyphicon glyphicon glyphicon-sort" ></i> -->
                  </th>
                  <th>Language
                      <!-- <i class="glyphicon glyphicon glyphicon-sort" ></i> -->
                  </th>
                  <th class="action">Action</th>
                  <th class="action">Publish and unpublish</th>
              </tr>
              <tr class="warning no-result">
                  <td colspan="4"><i class="fa fa-warning"></i> No result</td>
              </tr>
          </thead>
          <tbody>
              @foreach ($data['videoslist'] as $video)
                  <tr>
                      <td scope="row">
                          <input value="{{ $video['ID'] }}" name="check_video"
                              class="checkbox check_video form-element" type="checkbox">
                          <!-- <input value="{{ isset($video['ID']) }}" name="check_audios" class="checkbox check_audios form-element" type="checkbox"> -->
                      </td>
                      <td>{{ $video['ID'] }}</td>
                      <!-- <td>{{ $video['title'] ?? '' }}</td> -->
                      <td class="title">
                          <a class="titletab open-data" title="" data-toggle="modal" data-id="{{ $video['ID'] }}">

                              {{ $video['title'] ?? '' }}
                          </a>
                      </td>
                      <td>{{ $video['current_status'] ?? '' }} </td>
                      <td>{{ date('Y-m-d H:i:s', strtotime($video['publish_date'])) ?? '' }}</td>
                      <td>{{ date('Y-m-d H:i:s', strtotime($video['updated_at'])) ?? '' }}</td>
                      <td>{{ $video['language'] ?? '' }}</td>
                     <td class="action">
                          <a class="view1 open-data tdaction" title="" data-toggle="modal" data-id="{{ $video['ID'] }}"
                              data-original-title="view">
                              <!-- <i class="glyphicon glyphicon-eye-open"></i> -->
                              <span class="ti-eye"></span>
                          </a>

                          <a class="view1 tdaction" title="" data-toggle="tooltip"
                              href="{{ url('editAudio') }}/{{ $video['ID'] }}" data-original-title="Edit"><!-- <i
                                  class="glyphicon glyphicon-pencil"></i> -->
                                    <span class="ti-pencil-alt"></span>
                                  </a>

                         <a class="view_delete single_delete_icon tdaction" id="delete_single_photo_{{ $video['ID'] }}"
                              href="" data-original-title="Delete" type="button" data-toggle="modal"
                              data-target="#exampleModalLong">
                              <span class="ti-trash"></span>
                          </a>         

                          <!-- <i class="glyphicon glyphicon-trash single_delete_icon"
                              id="delete_single_photo_{{ $video['ID'] }}" style="color: #e20101"></i> -->

                         
                          <form method="POST" action="{{ route('deleteAudio') }}" name="user_form"
                              id="deleteSinglevideo_{{ $video['ID'] }}" data-parsley-validate>
                              {{ csrf_field() }}
                              <input type="hidden" value="{{ $video['ID'] }}" name="single_video_id"
                                  id="single_video_id">
                              <input type="hidden" value="tableview" name="videoview" id="videoview">
                          </form>
                      </td> 
                      <td>
                          <a class="publish" title="" data-toggle="tooltip" data-original-title="publish">
                              <span class="label">No</span>
                              <input type="checkbox" hidden="hidden" id="publish" class="publish_unpublish">
                              <label class="publish_unpublish" for="publish"> </label>
                              <span class="label">Yes</span>
                          </a>
                      </td>
                  </tr>
              @endforeach
          </tbody>
      </table>
  </div>

  <section>
      <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                  <div class="content-ref">
                      <h2>Content references</h2>
                      <div class="reference-search">
                          <div class="reference-search__select-container">
                              <select class="reference-search-s" name='type_reference' id="reference">
                                  <option selected="selected" name='type' disabled="disabled">Select type</option>
                                  <option value="articles">Articles</option>
                                  <option value="images">Photos</option>
                                  <option value="playlists">Playlists</option>
                                  <option value="videos">Videos</option>
                                  <option value="audios">Audio</option>
                                  <option value="promos">Promos</option>
                                  <option value="documents">Documents</option>
                                  <option value="bios">Bios</option>
                              </select>

                              <select class="form-control selectpicker refclass rt" name="ref[]" id="browsers"
                                  data-live-search="true" multiple data-actions-box="true" data-live-search="true"
                                  data-show-subtext="true">

                              </select>

                              <div class="selectedvalue" role="document"> </div>

                              <input id="removerefedit" type="hidden" name="removerefeedit1">

                              @if (isset($edit_data['references']) && $edit_data['references'] != null && !is_array($edit_data['references']))
                                  <?php
                                  $ref = json_decode($edit_data['references']);
                                  ?>

                                  @if ($ref != null)
                                      <input type="hidden" name="refeedit" value="{{ $edit_data['references'] }}">
                                      <div class="content-ref">
                                          <div class="selectedvalue" role="document">

                                              @foreach ($ref as $key => $value)
                                                  <div class="selectedcol">
                                                      <h2>{{ $value->title }}
                                                      </h2>
                                                      <span>en|Last updated
                                                          31/08/2021</span>
                                                      <span>ID:{{ $value->id }}</span><span id="close-selected"
                                                          onclick="remove_cont_ref({{ $value->id }})">
                                                          <i class="mdi mdi-close fa-fw" data-icon="v"></i>
                                                      </span>
                                                  </div>


                                              @endforeach
                                          </div>
                                      </div>
                                  @endif
                              @endif



                          </div>
                          <ul class="added-freq">
                              <li data-toggle="modal" data-target="#Favouritess">
                                  <i class="mdi mdi-account-plus fa-fw" data-icon="v"></i> Frequently Added

                              </li>
                              <li data-toggle="modal" data-target="#Favouritess">
                                  <i class="mdi mdi-restore fa-fw" data-icon="v"></i> Recently Visited
                              </li>
                              <li data-toggle="modal" data-target="#Favouritess">
                                  <i class="mdi mdi-heart-outline fa-fw" data-icon="v"></i> Favourites
                              </li>
                          </ul>
                          <div class="modal fade" id="Favourites" tabindex="-1" role="dialog"
                              aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content" style="width: 60%; margin: 0 auto;">
                                      <button type="button" class="close" data-dismiss="modal"
                                          aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                      <h2>Click the add button to attach the
                                          content reference</h2>
                                      <select class="form-control selectpicker" id="browsers" data-live-search="true"
                                          multiple data-actions-box="true" data-live-search="true"
                                          data-show-subtext="true">
                                          <option>
                                              <h2>India’s squad for WTC Final and
                                                  Test series against England
                                                  announced</h2> <span class="lan">English
                                                  | Last updated 31/08/2021</span>
                                              <span class='id'>ID: 154375</span>
                                          </option>
                                          <option>
                                              <h2>India’s squad for WTC Final and
                                                  Test series against England
                                                  announced</h2> <span class="lan">English
                                                  | Last updated 31/08/2021</span>
                                              <span class='id'>ID: 154375</span>
                                          </option>
                                          <option>
                                              <h2>India’s squad for WTC Final and
                                                  Test series against England
                                                  announced</h2> <span class="lan">English
                                                  | Last updated 31/08/2021</span>
                                              <span class='id'>ID: 154375</span>
                                          </option>
                                          <option>
                                              <h2>India’s squad for WTC Final and
                                                  Test series against England
                                                  announced</h2> <span class="lan">English
                                                  | Last updated 31/08/2021</span>
                                              <span class='id'>ID: 154375</span>
                                          </option>
                                          <option>
                                              <h2>India’s squad for WTC Final and
                                                  Test series against England
                                                  announced</h2> <span class="lan">English
                                                  | Last updated 31/08/2021</span>
                                              <span class='id'>ID: 154375</span>
                                          </option>
                                          <option>
                                              <h2>India’s squad for WTC Final and
                                                  Test series against England
                                                  announced</h2> <span class="lan">English
                                                  | Last updated 31/08/2021</span>
                                              <span class='id'>ID: 154375</span>
                                          </option>
                                          <option>
                                              <h2>India’s squad for WTC Final and
                                                  Test series against England
                                                  announced</h2> <span class="lan">English
                                                  | Last updated 31/08/2021</span>
                                              <span class='id'>ID: 154375</span>
                                          </option>
                                          <option>
                                              <h2>India’s squad for WTC Final and
                                                  Test series against England
                                                  announced</h2> <span class="lan">English
                                                  | Last updated 31/08/2021</span>
                                              <span class='id'>ID: 154375</span>
                                          </option>
                                          <option>
                                              <h2>India’s squad for WTC Final and
                                                  Test series against England
                                                  announced</h2> <span class="lan">English
                                                  | Last updated 31/08/2021</span>
                                              <span class='id'>ID: 154375</span>
                                          </option>
                                          <option>
                                              <h2>India’s squad for WTC Final and
                                                  Test series against England
                                                  announced</h2> <span class="lan">English
                                                  | Last updated 31/08/2021</span>
                                              <span class='id'>ID: 154375</span>
                                          </option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="tagsinput1">
                      <h2>Tags</h2>
                    <?php
                    $get_tags = get_all_tags();
                    ?>
                      <select class="form-control taginput-item" id="inputTagxyxcvxhddj" name="tags[]" multiple="multiple">
                          @if (isset($edit_data['tags']) && $edit_data['tags'] != null && !is_array($edit_data['tags']))
                              <?php $tags = json_decode($edit_data['tags']);
                            
                              $match_tags = array_column(json_decode($edit_data['tags'], true), 'label');
                             
                              ?>

                              @foreach ($get_tags['data'] as $key => $t)
                                  @if (in_array($t['label'], $match_tags))
                                      <option value="{{ $t['label'] }}" selected>
                                          {{ $t['label'] }}</option>
                                  @else
                                      <option value="{{ $t['label'] }}">
                                          {{ $t['label'] }}</option>
                                  @endif

                              @endforeach
                              @else
                                 @foreach ($get_tags['data'] as $key => $t)
                                      <option value="{{ $t['label'] }}">
                                          {{ $t['label'] }}</option>
                              @endforeach
                          @endif


                      </select>

                      <ul class="added-freq">
                          <li data-toggle="modal" data-target="#Favourites">
                              <i class="mdi mdi-account-plus fa-fw" data-icon="v"></i> Frequently Added
                          </li>
                          <li data-toggle="modal" data-target="#Favourites">
                              <i class="mdi mdi-restore fa-fw" data-icon="v"></i>
                              Recently Visited
                          </li>
                      </ul>
                  </div>


                  <div class="content-ref">
                      <h2>Related content</h2>
                      <div class="reference-search">
                          <div class="reference-search__select-container">
                              <select class="reference-search-s" name="type_content" id="contentId">
                                  <option disabled="disabled" selected="selected">
                                      Select type</option>
                                  <option value="articles">Articles</option>
                                  <option value="images">Photos</option>
                                  <option value="playlists">Playlists</option>
                                  <option value="videos">Videos</option>
                                  <option value="audios">Audio</option>
                                  <option value="promos">Promos</option>
                                  <option value="documents">Documents</option>
                                  <option value="bios">Bios</option>
                              </select>

                              <select class="form-control selectpicker contentClass2" name="content[]" id="browsers"
                                  data-live-search="true" multiple data-actions-box="true" data-live-search="true"
                                  data-show-subtext="true">

                              </select>
                              <div class="selectedrelcont" role="document">
                                  <input id="removecontedit" type="hidden" name="removeconteedit">
                              </div>

                              @if (isset($edit_data['related']) && $edit_data['related'] != null && !is_array($edit_data['related']))
                                  <?php
                                  $cont = json_decode($edit_data['related']);
                                  ?>
                                  @if ($cont != null)
                                      <input type="hidden" name="contedit" value="{{ $edit_data['related'] }}">
                                      <div class="content-ref">
                                          <div class="selectedrelcont" role="document">
                                              @foreach ($cont as $key => $value)
                                                  <div class="selectedcol">
                                                      <h2>{{ $value->title }}
                                                      </h2>
                                                      <span>en|Last updated
                                                          31/08/2021</span>
                                                      <span>ID:{{ $value->id }}</span><span id="close-selected"
                                                          onclick="remove_cont({{ $value->id }})"> <i
                                                              class="mdi mdi-close fa-fw" data-icon="v"></i>
                                                      </span>
                                                  </div>
                                              @endforeach
                                          </div>
                                      </div>
                                  @endif
                              @endif



                          </div>
                          <ul class="added-freq">
                              <li data-toggle="modal" data-target="#Favouritess">
                                  <i class="mdi mdi-account-plus fa-fw" data-icon="v"></i> Frequently Added

                              </li>
                              <li data-toggle="modal" data-target="#Favouritess">
                                  <i class="mdi mdi-restore fa-fw" data-icon="v"></i>
                                  Recently Visited
                              </li>
                              <li data-toggle="modal" data-target="#Favouritess">
                                  <i class="mdi mdi-heart-outline fa-fw" data-icon="v"></i> Favourites
                              </li>
                          </ul>
                          <div class="modal fade" id="Favourites" tabindex="-1" role="dialog"
                              aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content" style="width: 60%; margin: 0 auto;">
                                      <button type="button" class="close" data-dismiss="modal"
                                          aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                      <h2>Click the add button to attach the
                                          content reference</h2>
                                      <select class="form-control selectpicker" id="browsers" data-live-search="true"
                                          multiple data-actions-box="true" data-live-search="true"
                                          data-show-subtext="true">
                                          <option>
                                              <h2>India’s squad for WTC Final and
                                                  Test series against England
                                                  announced</h2> <span class="lan">English
                                                  | Last updated 31/08/2021</span>
                                              <span class='id'>ID: 154375</span>
                                          </option>
                                          <option>
                                              <h2>India’s squad for WTC Final and
                                                  Test series against England
                                                  announced</h2> <span class="lan">English
                                                  | Last updated 31/08/2021</span>
                                              <span class='id'>ID: 154375</span>
                                          </option>
                                          <option>
                                              <h2>India’s squad for WTC Final and
                                                  Test series against England
                                                  announced</h2> <span class="lan">English
                                                  | Last updated 31/08/2021</span>
                                              <span class='id'>ID: 154375</span>
                                          </option>
                                          <option>
                                              <h2>India’s squad for WTC Final and
                                                  Test series against England
                                                  announced</h2> <span class="lan">English
                                                  | Last updated 31/08/2021</span>
                                              <span class='id'>ID: 154375</span>
                                          </option>
                                          <option>
                                              <h2>India’s squad for WTC Final and
                                                  Test series against England
                                                  announced</h2> <span class="lan">English
                                                  | Last updated 31/08/2021</span>
                                              <span class='id'>ID: 154375</span>
                                          </option>
                                          <option>
                                              <h2>India’s squad for WTC Final and
                                                  Test series against England
                                                  announced</h2> <span class="lan">English
                                                  | Last updated 31/08/2021</span>
                                              <span class='id'>ID: 154375</span>
                                          </option>
                                          <option>
                                              <h2>India’s squad for WTC Final and
                                                  Test series against England
                                                  announced</h2> <span class="lan">English
                                                  | Last updated 31/08/2021</span>
                                              <span class='id'>ID: 154375</span>
                                          </option>
                                          <option>
                                              <h2>India’s squad for WTC Final and
                                                  Test series against England
                                                  announced</h2> <span class="lan">English
                                                  | Last updated 31/08/2021</span>
                                              <span class='id'>ID: 154375</span>
                                          </option>
                                          <option>
                                              <h2>India’s squad for WTC Final and
                                                  Test series against England
                                                  announced</h2> <span class="lan">English
                                                  | Last updated 31/08/2021</span>
                                              <span class='id'>ID: 154375</span>
                                          </option>
                                          <option>
                                              <h2>India’s squad for WTC Final and
                                                  Test series against England
                                                  announced</h2> <span class="lan">English
                                                  | Last updated 31/08/2021</span>
                                              <span class='id'>ID: 154375</span>
                                          </option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>


          </div>
      </div>
  </section>

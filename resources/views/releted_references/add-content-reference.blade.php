<section>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="content-ref">
                    <h2>Content references</h2>
                    <div class="reference-search">
                        <div class="reference-search__select-container">
                            <select class="reference-search-s" name='type_reference' id="reference">
                                <option selected="selected" disabled="disabled">Select type</option>
                                <option value="articles">Articles</option>
                                <option value="images">Photos</option>
                                <option value="playlists">Playlists</option>
                                <option value="videos">Videos</option>
                                <option value="audios">Audio</option>
                                <option value="promos">Promos</option>
                                <option value="documents">Documents</option>
                                <option value="bios">Bios</option>
                            </select>

                            <select class="form-control selectpicker refclass" name="ref[]" multiple="multiple"
                                id="browsers" data-live-search="true" multiple data-actions-box="true"
                                data-live-search="true" data-show-subtext="true">
                            </select>
                            <div class="selectedvalue" role="document"></div>


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
                                    <h2>Click the add button to attach the content reference</h2>
                                    <select class="form-control selectpicker" id="browsers" data-live-search="true"
                                        multiple data-actions-box="true" data-live-search="true"
                                        data-show-subtext="true">
                                        <option>
                                            <h2>India’s squad for WTC Final and Test series against England
                                                announced</h2> <span class="lan">English | Last
                                                updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                        </option>
                                        <option>
                                            <h2>India’s squad for WTC Final and Test series against England
                                                announced</h2> <span class="lan">English | Last
                                                updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                        </option>
                                        <option>
                                            <h2>India’s squad for WTC Final and Test series against England
                                                announced</h2> <span class="lan">English | Last
                                                updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                        </option>
                                        <option>
                                            <h2>India’s squad for WTC Final and Test series against England
                                                announced</h2> <span class="lan">English | Last
                                                updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                        </option>
                                        <option>
                                            <h2>India’s squad for WTC Final and Test series against England
                                                announced</h2> <span class="lan">English | Last
                                                updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                        </option>
                                        <option>
                                            <h2>India’s squad for WTC Final and Test series against England
                                                announced</h2> <span class="lan">English | Last
                                                updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                        </option>
                                        <option>
                                            <h2>India’s squad for WTC Final and Test series against England
                                                announced</h2> <span class="lan">English | Last
                                                updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                        </option>
                                        <option>
                                            <h2>India’s squad for WTC Final and Test series against England
                                                announced</h2> <span class="lan">English | Last
                                                updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                        </option>
                                        <option>
                                            <h2>India’s squad for WTC Final and Test series against England
                                                announced</h2> <span class="lan">English | Last
                                                updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                        </option>
                                        <option>
                                            <h2>India’s squad for WTC Final and Test series against England
                                                announced</h2> <span class="lan">English | Last
                                                updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="tagsinput1">
                            <h2>Tags</h2>
                            
                               <select class="form-control taginput-item" id="inputTag" name="tags[]" multiple="multiple">
                            </select>
                            <ul class="added-freq">
                                <li data-toggle="modal" data-target="#Favourites">
                                    <i class="mdi mdi-account-plus fa-fw" data-icon="v"></i> Frequently Added
                                </li>
                                <li data-toggle="modal" data-target="#Favourites">
                                    <i class="mdi mdi-restore fa-fw" data-icon="v"></i> Recently Visited
                                </li>
                            </ul>
                        </div> --}}
                <div class="tagsinput1">
                    <h2>Tags</h2>
                    <select class="form-control taginput-item" id="inputTag1xyz" name="tags[]" multiple="multiple">
                        @foreach ($get_tags['data'] as $key => $t)
                            <option value="{{ $t['label'] }}">
                                {{ $t['label'] }}</option>
                        @endforeach


                    </select>
                </div>


                <div class="content-ref">
                    <h2>Related content</h2>
                    <div class="reference-search">
                        <div class="reference-search__select-container">
                            <select name="type_content" id="contentId" class="reference-search-s">
                                <option disabled="disabled" selected="selected">Select type</option>
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
                            <div class="selectedrelcont" role="document"></div>

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
                                    <h2>Click the add button to attach the content reference</h2>
                                    <select class="form-control selectpicker" id="browsers" data-live-search="true"
                                        multiple data-actions-box="true" data-live-search="true"
                                        data-show-subtext="true">
                                        <option>
                                            <h2>India’s squad for WTC Final and Test series against England
                                                announced</h2> <span class="lan">English | Last
                                                updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                        </option>
                                        <option>
                                            <h2>India’s squad for WTC Final and Test series against England
                                                announced</h2> <span class="lan">English | Last
                                                updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                        </option>
                                        <option>
                                            <h2>India’s squad for WTC Final and Test series against England
                                                announced</h2> <span class="lan">English | Last
                                                updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                        </option>
                                        <option>
                                            <h2>India’s squad for WTC Final and Test series against England
                                                announced</h2> <span class="lan">English | Last
                                                updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                        </option>
                                        <option>
                                            <h2>India’s squad for WTC Final and Test series against England
                                                announced</h2> <span class="lan">English | Last
                                                updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                        </option>
                                        <option>
                                            <h2>India’s squad for WTC Final and Test series against England
                                                announced</h2> <span class="lan">English | Last
                                                updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                        </option>
                                        <option>
                                            <h2>India’s squad for WTC Final and Test series against England
                                                announced</h2> <span class="lan">English | Last
                                                updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                        </option>
                                        <option>
                                            <h2>India’s squad for WTC Final and Test series against England
                                                announced</h2> <span class="lan">English | Last
                                                updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                        </option>
                                        <option>
                                            <h2>India’s squad for WTC Final and Test series against England
                                                announced</h2> <span class="lan">English | Last
                                                updated 31/08/2021</span> <span class='id'>ID: 154375</span>
                                        </option>
                                        <option>
                                            <h2>India’s squad for WTC Final and Test series against England
                                                announced</h2> <span class="lan">English | Last
                                                updated 31/08/2021</span> <span class='id'>ID: 154375</span>
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

<style type="text/css">
    img#image {
        display: block;
        max-width: 100%;
        height: 200px;
        min-height: 100%;
    }

    .docs-preview {
        margin-right: -1rem;
        margin-top: 1rem;
    }

    .img-preview {
        /* float: left; */
        margin-bottom: 0.5rem;
        margin-right: 0.5rem;
        overflow: hidden;
    }

    .img-preview>img {
        max-width: 100%;
    }

    .preview-lg {
        height: 18rem;
        width: 26rem;
    }
</style>

<!-- cropper functional button -->
<div class="row">
    <div class="col-md-12">
        <div class="row" id="actions">
            <div class="col-md-12 docs-buttons">
                <!-- <h3>Toolbar:</h3> -->
                <div class="btn-group">
                    <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                        <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                        <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs">
                            <span class="fa fa-upload"></span>
                        </span>upload Image
                    </label>
                </div>

                <div class="btn-group btn-group-crop">
                    <button type="button" class="btn btn-success" data-method="getCroppedCanvas" data-option="{ &quot;maxWidth&quot;: 4096, &quot;maxHeight&quot;: 4096 }">
                        <span class="docs-tooltip" data-toggle="tooltip" title="Save Cropped Image">
                            Save Cropped Image
                        </span>
                    </button>
                </div>

                <!-- <div class="btn-group btn-group-crop">
                    <button type="button" class="btn btn-primary" >
                        <span class="docs-tooltip edit_crop_image" data-toggle="tooltip" title="edit">
                            Edit
                        </span>
                    </button>
                </div> -->

                <div class="btn-group">
                    <!-- <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move" title="Move">
                        <span class="docs-tooltip" data-toggle="tooltip" title="move">
                            <span class="fa fa-arrows-alt"></span>
                        </span>
                    </button> -->
                    <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
                        <span class="docs-tooltip" data-toggle="tooltip" title="Zoom In">
                            <span class="fa fa-search-plus"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
                        <span class="docs-tooltip" data-toggle="tooltip" title="Zoom Out">
                            <span class="fa fa-search-minus"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
                        <span class="docs-tooltip" data-toggle="tooltip" title="Move Left">
                            <span class="fa fa-arrow-left"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
                        <span class="docs-tooltip" data-toggle="tooltip" title="Move Right">
                            <span class="fa fa-arrow-right"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
                        <span class="docs-tooltip" data-toggle="tooltip" title="Move Up">
                            <span class="fa fa-arrow-up"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
                        <span class="docs-tooltip" data-toggle="tooltip" title="Move Down">
                            <span class="fa fa-arrow-down"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
                        <span class="docs-tooltip" data-toggle="tooltip" title="Rotate Left">
                            <span class="fa fa-undo-alt"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
                        <span class="docs-tooltip" data-toggle="tooltip" title="Rotate Right">
                            <span class="fa fa-redo-alt"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
                        <span class="docs-tooltip" data-toggle="tooltip" title="Flip Horizontal">
                            <span class="fa fa-arrows-alt-h"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
                        <span class="docs-tooltip" data-toggle="tooltip" title="Flip Vertical">
                            <span class="fa fa-arrows-alt-v"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="crop" title="Crop">
                        <span class="docs-tooltip" data-toggle="tooltip" title="crop">
                            <span class="fa fa-check"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="clear" title="Clear">
                        <span class="docs-tooltip" data-toggle="tooltip" title="clear">
                            <span class="fa fa-times"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="disable" title="Disable">
                        <span class="docs-tooltip" data-toggle="tooltip" title="disable">
                            <span class="fa fa-lock"></span>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="enable" title="Enable">
                        <span class="docs-tooltip" data-toggle="tooltip" title="enable">
                            <span class="fa fa-unlock"></span>
                        </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
                        <span class="docs-tooltip" data-toggle="tooltip" title="reset">
                            <span class="fa fa-sync-alt"></span>
                        </span>
                    </button>

                    <button type="button" class="btn btn-primary" data-method="destroy" title="Destroy">
                        <span class="docs-tooltip" data-toggle="tooltip" title="destroy">
                            <span class="fa fa-power-off"></span>
                        </span>
                    </button>
                </div>

                <a class="btn btn-primary" style="display: none;" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                <!-- /.modal -->
            </div>
        </div>
    </div>
</div>
<!-- cropper functional button -->
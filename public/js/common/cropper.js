window.onload = function () {

    function urltoFile(url, filename, mimeType) {
        return (fetch(url)
            .then(function (res) { return res.arrayBuffer(); })
            .then(function (buf) { return new File([buf], filename, { type: mimeType }); })
        );
    }

    'use strict';
    var Cropper = window.Cropper;
    var URL = window.URL || window.webkitURL;
    var container = document.querySelector('.img-container');
    var image = document.getElementById('image');
    // image.crossOrigin = 'anonymous';
    // image.setAttribute('crossorigin', 'anonymous')

    console.log(container);
    console.log(image);
    var download = document.getElementById('download');
    var actions = document.getElementById('actions');
    var options = {
        aspectRatio: 16 / 9,
        // checkCrossOrigin: false, 
        // allowTaint: true,    
        preview: '.img-preview',
        ready: function (e) {
            console.log(e.type);
        },
        cropstart: function (e) {
            console.log(e.type, e.detail.action);
        },
        cropmove: function (e) {
            console.log(e.type, e.detail.action);
        },
        cropend: function (e) {
            console.log(e.type, e.detail.action);
        },
        // crop: function(e) {
        //     var data = e.detail;
        //     console.log(e.type);
        //     dataX.value = Math.round(data.x);
        //     dataY.value = Math.round(data.y);
        //     dataHeight.value = Math.round(data.height);
        //     dataWidth.value = Math.round(data.width);
        //     dataRotate.value = typeof data.rotate !== 'undefined' ? data.rotate : '';
        //     dataScaleX.value = typeof data.scaleX !== 'undefined' ? data.scaleX : '';
        //     dataScaleY.value = typeof data.scaleY !== 'undefined' ? data.scaleY : '';
        // },
        zoom: function (e) {
            console.log(e.type, e.detail.ratio);
        }
    };
    var cropper = new Cropper(image, options);
    var originalImageURL = image.src;
    var uploadedImageType = 'image/jpeg';
    var uploadedImageName = 'cropped.jpg';
    var uploadedImageURL;

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Buttons
    if (!document.createElement('canvas').getContext) {
        $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
    }

    if (typeof document.createElement('cropper').style.transition === 'undefined') {
        $('button[data-method="rotate"]').prop('disabled', true);
        $('button[data-method="scale"]').prop('disabled', true);
    }

    // Download
    if (typeof download.download === 'undefined') {
        download.className += ' disabled';
        download.title = 'Your browser does not support download';
    }

    // Methods
    actions.querySelector('.docs-buttons').onclick = function (event) {
        var e = event || window.event;
        var target = e.target || e.srcElement;
        var cropped;
        var result;
        var input;
        var data;

        if (!cropper) {
            return;
        }

        while (target !== this) {
            if (target.getAttribute('data-method')) {
                break;
            }

            target = target.parentNode;
        }

        if (target === this || target.disabled || target.className.indexOf('disabled') > -1) {
            return;
        }

        data = {
            method: target.getAttribute('data-method'),
            target: target.getAttribute('data-target'),
            option: target.getAttribute('data-option') || undefined,
            secondOption: target.getAttribute('data-second-option') || undefined
        };

        cropped = cropper.cropped;

        if (data.method) {
            if (typeof data.target !== 'undefined') {
                input = document.querySelector(data.target);

                if (!target.hasAttribute('data-option') && data.target && input) {
                    try {
                        data.option = JSON.parse(input.value);
                    } catch (e) {
                        console.log(e.message);
                    }
                }
            }

            switch (data.method) {
                case 'rotate':
                    if (cropped && options.viewMode > 0) {
                        cropper.clear();
                    }

                    break;

                case 'getCroppedCanvas':
                    try {
                        data.option = JSON.parse(data.option);
                    } catch (e) {
                        console.log(e.message);
                    }

                    if (uploadedImageType === 'image/jpeg') {
                        if (!data.option) {
                            data.option = {};
                        }
                        data.option.fillColor = '#fff';
                    }

                    break;
            }

            result = cropper[data.method](data.option, data.secondOption);

            switch (data.method) {
                case 'rotate':
                    if (cropped && options.viewMode > 0) {
                        cropper.crop();
                    }

                    break;

                case 'scaleX':
                case 'scaleY':
                    target.setAttribute('data-option', -data.option);
                    break;

                case 'getCroppedCanvas':
                    if (result) {
                        download.download = uploadedImageName;
                        $('#image_name').val(uploadedImageName);
                        download.href = result.toDataURL(uploadedImageType);
                        $('#imgBaseUrl,.editimg').val(download.href);
                        // $('.').val(download.href);                        
                        $('#imgBaseUrl-error,#imageUrl-error').text('');
                        $('.errorsuccmsg').html('<p style=color:green;>Cropped Image saved</p>');
                        setTimeout(function () { $('.errorsuccmsg').html(''); }, 3000);
                    }
                    break;

                case 'destroy':
                    cropper = null;

                    if (uploadedImageURL) {
                        URL.revokeObjectURL(uploadedImageURL);
                        uploadedImageURL = '';
                        image.src = originalImageURL;
                    }
                    break;
            }

            if (typeof result === 'object' && result !== cropper && input) {
                try {
                    input.value = JSON.stringify(result);
                } catch (e) {
                    console.log(e.message);
                }
            }
        }
    };

    document.body.onkeydown = function (event) {
        var e = event || window.event;

        if (e.target !== this || !cropper || this.scrollTop > 300) {
            return;
        }

        switch (e.keyCode) {
            case 37:
                e.preventDefault();
                cropper.move(-1, 0);
                break;

            case 38:
                e.preventDefault();
                cropper.move(0, -1);
                break;

            case 39:
                e.preventDefault();
                cropper.move(1, 0);
                break;

            case 40:
                e.preventDefault();
                cropper.move(0, 1);
                break;
        }
    };

    // Import image
    var inputImage = document.getElementById('inputImage');

    if (URL) {
        inputImage.onchange = function () {
            $('#imgBaseUrl').val('');
            $('#imgBaseUrl-error,#imageUrl-error').text('');
            $('.errorsuccmsg').html('<p style=color:red;>Please save the changes</p>');
            var files = this.files;
            var file;

            if (files && files.length) {
                file = files[0];

                if (/^image\/\w+/.test(file.type)) {
                    uploadedImageType = file.type;
                    uploadedImageName = file.name;

                    if (uploadedImageURL) {
                        URL.revokeObjectURL(uploadedImageURL);
                    }

                    image.src = uploadedImageURL = URL.createObjectURL(file);

                    if (cropper) {
                        cropper.destroy();
                    }

                    cropper = new Cropper(image, options);
                    inputImage.value = null;
                } else {
                    window.alert('Please choose an image file.');
                }
            }
        };
    } else {
        inputImage.disabled = true;
        inputImage.parentNode.className += ' disabled';
    }





};


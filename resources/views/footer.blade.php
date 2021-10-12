@section('footer')

<script src="{{URL::asset('plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{URL::asset('assets/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{URL::asset('assets/js/custom.js')}}"></script>
<script src="{{URL::asset('assets/js/waves.js')}}"></script>
<script src="{{URL::asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{URL::asset('plugins/bower_components/switchery/dist/switchery.min.js')}}"></script>
<script src="{{URL::asset('plugins/bower_components/custom-select/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{URL::asset('plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{URL::asset('plugins/bower_components/multiselect/js/jquery.multi-select.js')}}"></script>
<script src="{{URL::asset('plugins/bower_components/dropify/dist/js/dropify.min.js')}}"></script>
<script src="{{URL::asset('plugins/bower_components/jquery-wizard-master/jquery.steps.min.js')}}"></script>
<script src="{{URL::asset('plugins/bower_components/jquery-wizard-master/jquery.validate.min.js')}}"></script>
<script src="{{URL::asset('plugins/bower_components/toast-master/js/jquery.toast.js')}}"></script>
<script src="{{URL::asset('plugins/bower_components/blockUI/jquery.blockUI.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{URL::asset('plugins/bower_components/nestable/jquery.nestable.js')}}"></script>
<script src="{{URL::asset('plugins/bower_components/moment/moment.js')}}"></script>
<script src="{{URL::asset('plugins/bower_components/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{URL::asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.js"></script>

<script src="{{URL::asset('plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script>
<script src="{{URL::asset('plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js')}}"></script>

<script src="{{URL::asset('assets/js/epic-player.js')}}"></script>
<script src="{{URL::asset('assets/js/common-validation.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>
<script src="{{URL::asset('plugins/bower_components/styleswitcher/jQuery.style.switcher.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    $('.js-switch').each(function() {
        new Switchery($(this)[0], $(this).data());
    });

    $('.mydatepicker').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    //var form_show = $(".validation-wizard").show();
    // console.log(form_show);
    $(".validation-wizard").steps({
        headerTag: "h6",
        bodyTag: "section",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: "Submit"
        },
        onStepChanging: function(event, currentIndex, newIndex) {
            $('.dropify').dropify();
            $(".select2").select2();
            var form = $(this);
            console.log(form);
            return currentIndex > newIndex || (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid());
        },
        // onFinishing: function (event, currentIndex) {
        //     return form_show.validate().settings.ignore = ":disabled", form_show.valid()
        // },
        onFinished: function(event, currentIndex) {
            var form_id = $(this).attr('id');
            $("#" + form_id).submit();
        }
    });

    // $(".validation-wizard").validate({
    //     ignore: "input[type=hidden]",
    //     errorClass: "text-danger",
    //     successClass: "text-success",
    //     highlight: function (element, errorClass) {
    //         $(element).removeClass(errorClass)
    //     },
    //     unhighlight: function (element, errorClass) {
    //         $(element).removeClass(errorClass)
    //     },
    //     errorPlacement: function (error, element) {
    //         error.insertAfter(element)
    //     },
    //     rules: {
    //         email: {
    //             email: !0
    //         }
    //     }
    // });

    $(document).ready(function() {
        $('#userlist').DataTable();

        window.Parsley.addValidator('maxFileSize', {
            validateString: function(_value, maxSize, parsleyInstance) {
                if (!window.FormData) {
                    alert('You are making all developpers in the world cringe. Upgrade your browser!');
                    return true;
                }
                var files = parsleyInstance.$element[0].files;
                return files.length != 1 || files[0].size <= maxSize * 1024;
            },
            requirementType: 'integer',
            messages: {
                en: 'This file should not be larger than %s Kb',
                fr: 'Ce fichier est plus grand que %s Kb.'
            }
        });

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            //format: 'dd-mm-yyyy',
            orientation: 'bottom'
        });
        $('[name="title"]').on('keyup', function() {
            var Text = $(this).val();
            url = Text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $('[name="titleUrlSegment"]').val(url);
            $('[name="titleslug"]').val(url);
        });
        $(".tagsinput").tagsinput();
    });
    $(".taginput-item").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    })
    $(document).ready(function() {
        $(".sidebar-head").click(function() {
            $(".navbar-default.sidebar").toggleClass("nav-active");
            $("div#page-wrapper").toggleClass("body-active");
            if (!$(".navbar-default.sidebar").hasClass("nav-active")) {
                $("ul.nav.nav-second-level.collapse").removeClass('in');
            }
        });
        setTimeout(function() {
            $("ul.nav.nav-second-level").removeClass('in');
        }, 100);
        $(document).mouseup(function(e) {
            var container = $("#side-menu");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                $("ul.nav.nav-second-level").removeClass('in');
                $(".navbar-default.sidebar").removeClass("nav-active");
            }
        });

    });

    $(".select-content-list").select2({  
    minimumInputLength: 3,
ajax: {
  method: "POST",
  url: "{{url('searchByTitle')}}",
  delay: 250,
  dataType: 'json',
  data: function (params) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    return {title:params.term};
  },
  minimumInputLength: 3,
}
});
</script>
</body>

</html>

@show
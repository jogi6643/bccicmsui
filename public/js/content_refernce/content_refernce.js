$(document).ready(function () {  
 
    // End title convert in to segnatamente
    $('.reference-search__select-container').on('click', '.dropdown.bootstrap-select.form-control.refclass',
    function() {
        $("#collapsingsidebar .reference-search .inner").append(
            '<button type="button" class="addtocontentrefrence" id="add-sel"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>'
        );
        $("#collapsingsidebar .reference-search .inner").append(
            '<div class="loader-background"><div class="loader"></div></div>'
        );
        for (let i = 1; i <= $('select.refclass option').length; i++) {
            if(i==$('select.refclass option').length)
            {   console.log(i+"=="+$('select.refclass option').length);
                $('.loader-background').hide(); 
            }
          }
        // if ($('select.refclass option').length != 0) {
        //     $('.loader-background').hide();
        // }
    });
$('.reference-search__select-container').on('click',
    '.dropdown.bootstrap-select.form-control.contentClass2',
    function() {
        $("#collapsingsidebar .reference-search .inner").append(
            '<button type="button" class="addtocontentrefrence" id="add-sels"> <i class="mdi mdi-plus fa-fw" data-icon="v"></i> Add selected references</button>'
        );
        $("#collapsingsidebar .reference-search .inner").append(
            '<div class="loader-background"><div class="loader"></div></div>'
        );
        for (let i = 1; i <= $('select.contentClass2 option').length; i++) {
            if(i==$('select.contentClass2 option').length)
            {   console.log(i+"=="+$('select.contentClass2 option').length);
                $('.loader-background').hide(); 
            }
          }
        // if ($('select.contentClass2 option').length == 0) {
        //     $('.loader-background').hide();
        // }
    });
$('.reference-search__select-container').on('click', '.dropdown.bootstrap-select.form-control.refclass',
    function() {
        $('.dropdown.bootstrap-select.form-control.refclass').on('click', 'button#add-sel',
            function() {

                var optionsselected = $("select.refclass").val();
                $.each(optionsselected, function(i, x) {
                    var myStr = x.replace(/(<([^>]+)>)/ig, '');
                    var strArray = myStr.split("ID:");
                    dataid = strArray[1];
                    $('.selectedvalue').append(
                        '<div class="selectedcol" onclick="remove_cont_ref('+dataid + ')"  id="' + dataid + '">' + x +
                        '<span id="close-selected" > <i class="mdi mdi-close fa-fw" data-icon="v"></i>  </span> </div>'
                    )

                });

            });
    });
$('.reference-search__select-container').on('click',
    '.dropdown.bootstrap-select.form-control.contentClass2',
    function() {
        $('.dropdown.bootstrap-select.form-control.contentClass2').on('click', 'button#add-sels',
            function() {
                var optionsselected = $("select.contentClass2").val();
                //$('.selectedrelcont').html("");
                $.each(optionsselected, function(i, x) {
                    var myStr = x.replace(/(<([^>]+)>)/ig, '');
                    var strArray = myStr.split("ID:");
                    dataid = strArray[1];
                    $('.selectedrelcont').append('<div class="selectedcol " onclick="remove_cont('+dataid + ')"  id="' + dataid + '">' + x +
                        '<span id="close-selected" > <i class="mdi mdi-close fa-fw" data-icon="v"></i>  </span> </div>'
                    )

                });

            });
    });
$('.selectedvalue').on('click', '#close-selected', function() {
    $(this).parents('.selectedcol').fadeOut();
});
$("button.close.btn.innerpopup").click(function() {
    $('#Favourites').modal('hide');
});

// End loader

    $("#reference").on('change', function () {
      var ref = $(this).val();
      if(ref!=undefined && ref!=null)
      {
       
          $.ajax({
               type: "POST",
               url: "/commonsearch",
               data:{type:ref},
               dataType: 'json',
               headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
               success: function (res){
                $('select.refclass').empty();
                 $('select.refclass').selectpicker('destroy');
                 $('select.refclass').selectpicker();
                console.log(res.data);
                $.each(res.data, function (index, value) {
                    
                    var option = '<option data-id="'+value.ID+'" value="<h2>'+value.title +'</h2> <span>'+value.language +'|'+ 'Last updated 31/08/2021</span> <span>ID:'+value.ID+'</span>"><h2>'+value.title +'</h2> <span>'+value.language +'|'+ 'Last updated 31/08/2021</span> <span>ID:'+value.ID+'</span></option>';
                    $('select.refclass').append(option);
                 
                });
                $('select.refclass').selectpicker('refresh');
                if ($('select.refclass option').length != 0) {
                    $('.loader-background').hide();
                }
               
                
               },
               error: function(){
                   return false;
               },
               complete: function(){
                   console.log('complete');
               }
          })
      }
     
    });



// Releted 
    $("#contentId").on('change', function () {
        var ref = $(this).val();
        if(ref!=undefined && ref!=null)
        {
            $.ajax({
                 type: "POST",
                 url: "/commonsearch",
                 data:{type:ref},
                 dataType: 'json',
                 headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                 success: function (res){
                    $('select.contentClass2').empty();
                    $('select.contentClass2').selectpicker('destroy');
                    $('select.contentClass2').selectpicker();
                  $.each(res.data, function (index, value) {
                      var option = '<option data-id="'+value.ID+'" value="<h2>'+value.title +'</h2> <span>'+value.language +'|'+ 'Last updated 31/08/2021</span> <span >ID:'+value.ID+'</span>"><h2>'+value.title +'</h2> <span class="lan">'+value.language +'|'+ 'Last updated 31/08/2021</span> <span class="id">ID:'+value.ID+'</span></option>';
                      $('select.contentClass2').append(option);
                  });
                  $('select.contentClass2').selectpicker('refresh');
                  console.log($('select.contentClass2 option').length);
                  if ($('select.contentClass2 option').length != 0) {
                      $('.loader-background').hide();
                  }
                 },
                 error: function(){
                     return false;
                 },
                 complete: function(){
                     console.log('complete');
                 }
            })
        }
       
      });
// ALERT

$("#inputTag").select2({
    minimumInputLength: 2,
    tags: [],
    ajax: {
        url: "/articletagList",
        dataType: 'json',
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        type: "POST",
        success: function (res){
           console.log(res.data);
           $.each(res.data, function (index, value) {
            console.log(value.label);
            var option = '<option>'+value.label+'</option>';
            $('#inputTag').append(option);
        });
        $(".taginput-item").select2({
            tags: true,
            tokenSeparators: [',', ' ']
    })
         },
    }
});
  // End Tags Search 
 
});
const removerefedit = [];
function remove_cont_ref(id)
{
    removerefedit.push(id);
    $('#removerefedit').val(removerefedit);
    console.log(removerefedit);
}
const removecontedit = [];
function remove_cont(id)
{
    removecontedit.push(id);
    $('#removecontedit').val(removecontedit);
    console.log(removerefedit);
}

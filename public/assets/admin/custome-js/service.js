Dropzone.autoDiscover = false;
// Dropzone class:
// If you use jQuery, you can use the jQuery plugin Dropzone ships with:
$("div.dropzone").dropzone({ 
    maxFilesize: 2,
	renameFile: function(file) {
        var dt = new Date();
        var time = dt.getTime();
       return time+file.name;
    },
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    addRemoveLinks: true,
    removedfile: function(file) 
    {
        var name = file.upload.filename;
        var _token   = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            
            type: 'POST',
            url: '/admin/services/gallary/imageRemove',
            data: {_token:_token,filename: name},
            success: function (data){
                console.log(data);
                $('#id_'+data).val('');
            },
            error: function(e) {
                console.log(e);
            }
        });
            var fileRef;
            return (fileRef = file.previewElement) != null ? 
            fileRef.parentNode.removeChild(file.previewElement) : void 0;
    },

	url: "/admin/services/gallary/imageUpload",
    success:function(file,response){
        var image = '<input type="hidden" name="service_image[]" value="'+response.success+'" id="id_'+response.success+'">';
        $('#image_field').append(image);
        // console.log(response.success);
    }, 

});

// append new field
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><div class="form-group">'+
                        '<label for="title" class="col-form-label">FAQ Title</label>'+
                        '<div class="">'+
                            '<input id="faq_title" name="faq_title[]" type="text" class="form-control" placeholder="Enter faq answer...">'+
                       ' </div>'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label for="title" class="col-form-label">FAQ Answer</label>'+
                        '<div class="">'+
                            '<input id="faq_answer" name="faq_answer[]" type="text" class="form-control" placeholder="Enter faq answer...">'+
                        '</div>'+
                    '</div><a href="" class="btn btn-danger btn-sm remove_field text-right mb-2">Remove</a></div>'); //add input box
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
$(document).ready(function() {
    $('select.category_id').change(function(){
        var category_id = $('#category_id').children("option:selected").val();
        var _token   = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/admin/services/get/subcategory",
            type: "POST",
            data:{
                '_token': _token,
                'category_id':category_id,
            },
            success:function(response){
                console.log(response.html);
                $('#sub_category_id').html(response.html);
            },
        })
    })


    $('.image_delete_button').click(function(){
        var confirmation = confirm("You want to delete?");

        if (confirmation) {
            var _token   = $('meta[name="csrf-token"]').attr('content');
            var id    = $(this).val();
            $.ajax({
                url: "/admin/services/delete_services",
                type: "post",
                data:{
                    '_token': _token,
                    'id':id,
                },
                success:function(response){
                    $("#service_image"+id).fadeOut(5000);
                },
            })

        }

    })


    $('.remove_faq').click(function(){
        var confirmation = confirm("You want to delete?");

        if (confirmation) {
            var _token   = $('meta[name="csrf-token"]').attr('content');
            var id    = $(this).val();
            $.ajax({
                url: "/admin/faq/delete_faq",
                type: "post",
                data:{
                    '_token': _token,
                    'id':id,
                },
                success:function(response){
                    $("#faq_delete_id"+id).fadeOut(5000);
                },
            })

        }

    })



});

// append new field
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_icon_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_icon_field_button"); //Add button ID
    var countFeature    = $('#count_feature').val();
    var x = 1; //initlal text box count
    if(countFeature > 0){
         var x = countFeature;
    }
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="form-group row">'+
                                '<input id="feature_name" name="feature_name[]" type="text" class="form-control col-md-7" placeholder="Enter feature name" required>'+
                                '<input type="hidden" name="feature_iocn[]" id="feature_iocn_'+x+'" value="">'+
                                '<button class="col-md-1 btn btn-info" id="icon_button_id_'+x+'"></button>'+
                                '<button type="button" value="'+x+'" class="col-md-3 btn btn-primary btn-sm select_icon_button" data-toggle="modal" data-target="#myModal">Select Icon</button>'+
                                '<a href="" class="col-md-1 btn iocon_remove_field"><i class="fa fa-trash"></i></a>'+
                            '</div>'); //add input box
        }
    });

    $(wrapper).on("click",".iocon_remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })


    $(document).on('click','.select_icon_button',function(){
        var value = $(this).val();
        console.log(value);
        $('#icon_button_value').val(value);
    })


    $(document).on('click','.icon_class',function(){
        var value = $(this).val();
        var id    = $('#icon_button_value').val();
        console.log(id);
        $('#feature_iocn_'+id).val(value);
        $('#icon_button_id_'+id).html('<i class="'+value+'"></i>');
    })
});

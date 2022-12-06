"use strict";

var images=[];
var selectedimage=null;
var paginates=[];
var last_link=null;
const media_url=$('.media_url').val();
const single_media_name="mediaimage";
const multi_media_name="mediaimages[]";
var checkboxtype="radio";
var medianame="mediaimage";

var gallery_images= [];

var singlemedia_input_target="#preview";
var singlemedia_preview_target=".input_preview";

$('input[name="multi_images[]"]').each(function(i){
	gallery_images.push($(this).val());
});

/*----------------------------
        Media Radio Active
      ------------------------------*/
$(document).on('click', '.media_radio', function(e){
	$('.checkbox').prop("checked", false);
	checkboxtype="radio";
	medianame="mediaimage";
	$('.checkbox_use').hide();


	singlemedia_input_target='#'+$(this).data('inputid');
	singlemedia_preview_target='.'+$(this).data('previewclass');

	$('.checkbox').attr('name',medianame);
	$('.checkbox').addClass('radio');
	$('.checkbox').removeClass('checkbox');

	$('.checkbox_use').addClass('radio_use');
	$('.checkbox_use').removeClass('checkbox_use');
});


/*----------------------------
        Media Checkbox Active
      ------------------------------*/
$(document).on('click', '.media_checkbox', function(e){
	$('.radio').prop("checked", false);
	checkboxtype="checkbox";
	medianame="mediaimages[]";
	$('.radio_use').hide();
	$('.radio').attr('name',medianame);
	$('.radio').addClass('checkbox');
	$('.radio').removeClass('radio');
	$('.checkbox_use').addClass('radio_use');
	$('.radio_use').removeClass('checkbox_use');

	$('.radio_use').addClass('checkbox_use');
	$('.radio_use').removeClass('radio_use');
});


/*----------------------------
        Dropzone Active
      ------------------------------*/
var previousImages=[];
Dropzone.autoDiscover = false;
$(function(){
  var url= $('.dropzone').attr('action');
   var uploader = new Dropzone(".dropzone",{
        url: url,
        paramName : "media",
        uploadMultiple :false,
        acceptedFiles : "image/*",
        addRemoveLinks: false,
        forceFallback: false,
        maxFilesize:3,
        parallelUploads: 1,

    });//end drop zone

  uploader.on("success", function(file,response) {
  	previousImages.push(response);

  	$('.media-images').remove();

  	render_media(previousImages,checkboxtype,'.radio-media-list');
  	render_media(images,checkboxtype,'.radio-media-list');

  });
});


/*----------------------
        Modal Active
      ------------------------*/
$(document).on('click', ".single-modal", function(e) {
	if (images.length == 0) {
		get_media(media_url);
    }
});


/*--------------------------
        Get Media Active
      -------------------------*/
function get_media(url) {
	$.ajax({
			type: 'GET',
			url: url,
			dataType: 'json',

			beforeSend: function() {

       			render_preload('.media-list')

    		},

			success: function(response){
				images=response.data;
				render_media(images,"checkbox",'.checkbox-media-list');
  	            render_media(images,"radio",'.radio-media-list');

  	            if (response.next_page_url != null) {
  	            	last_link=response.next_page_url;
  	            	$('.last_link').show();
  	            }
  	            else{
  	            	last_link=null;
				    $('.last_link').hide();
  	            }
			},
			error: function(xhr, status, error)
			{

			}
	})
}


/*--------------------------
        Last Link Active
      -------------------------*/
$(document).on('click', '.last_link', function (argument) {
	if (last_link != null) {
		get_media(last_link);
	}
	else{
		$('.last_link').hide();
	}
})

/*--------------------------
        Render Media Active
      -------------------------*/
function render_media(data,type="checkbox",target) {
	$.each(data, function (key, row)
	{
		var image=`<div class="col-3 col-sm-2 media-images">
                        <label class="imagecheck mb-4">
                           <input name="${medianame}" type="checkbox"  data-imageid="${row.id}" value="${row.url}" class="imagecheck-input ${checkboxtype}"  />
                           <figure class="imagecheck-figure">
                              <img src="${replaceimagename(row.url,'small')}" alt="" class="imagecheck-image">
                           </figure>
                        </label>
                     </div>`;
        $(target).append(image);
	});

}

function render_preload(target) {
	// body...
}

/*--------------------------
        Replace Image Name
      -------------------------*/
function replaceimagename(param,name) {
	var myarray= ['.jpeg','.jpg','.png','.gif','.ico','.webp'];

	var ext= param.substring(param.lastIndexOf("."));
	if(jQuery.inArray(ext, myarray) != -1) {
		var filename = param.substring(0, param.lastIndexOf(".")) + name + param.substring(param.lastIndexOf("."));

		return filename;

	} else {
		var filename = $('#base_url').val()+"/uploads/file.png";
		return '/'+filename;
	}
}
function onlyUnique(value, index, self) {
  return self.indexOf(value) === index;
}
$(document).on('click','.radio',function(e) {
    var $box = $(this);
	  if ($box.is(":checked")) {
	    // the name of the box is retrieved using the .attr() method
	    // as it is assumed and expected to be immutable
	    var group = "input:checkbox[name='" + $box.attr("name") + "']";
	    // the checked state of the group/box on the other hand will change
	    // and the current value is retrieved using .prop() method
	    $(group).prop("checked", false);
	    $box.prop("checked", true);
	    $('.radio_use').show();

	    var image=$(this).val();
	    $('#previewimg').attr('src',image);
	    $('#medialink').val(image);
	  } else {
	    $box.prop("checked", false);
	    $('.radio_use').hide();
	  }
});

$(document).on('click','.checkbox',function(e) {
      var $box = $(this);
	  if ($box.is(":checked")) {
	  	$('.checkbox_use').show();

	  	var image=$(this).val();
	  	$('#previewimg').attr('src',image);
	    $('#medialink').val(image);
	  }
	  else{
	  	$('.checkbox_use').hide();
	  }

});
$(document).on('click', '.radio_use',function(e) {

	$('input[name="'+medianame+'"]:checked').each(function(i){
		selectedimage = $(this).val();
		$(this).removeAttr('checked');
		$(singlemedia_input_target).val(selectedimage);
        $(singlemedia_preview_target).attr('src',selectedimage);
	});

	$('.radio').prop("checked", false);
	$('.checkbox').prop("checked", false);
	$('.radio_use').hide();
    $('.media-single').modal('hide');
});

$(document).on('click','.checkbox_use',function(e) {
	$('input[name="'+medianame+'"]:checked').each(function(i){
         gallery_images.push($(this).val());
         $(this).prop("checked", false);
	});
	$('.img-wrap').remove();
	$.each(gallery_images, function (index, item){
		var html=`<div class="img-wrap gallery_image_area ml-1 mt-1 gallery${index}">
            <a href="javascript:void(0)" class="image_close" data-id="${index}"><span class="close " >&times;</span></a>
            <img height="100" alt="${item}" src="${replaceimagename(item,'small')}">
            <input type="hidden" value="${item}" name="multi_images[]">
          </div>`;

        $('.multi_images_preview_area').append(html);
	});

	$('.checkbox_use').hide();

	if($('.multi_images_preview_area').length && jQuery().sortable) {
		$( ".multi_images_preview_area" ).sortable();
		$( ".multi_images_preview_area" ).disableSelection();
	}

});

/*---------------------
        Image Close
      --------------------*/
$(document).on('click','.image_close',function(e){
	var id=$(this).data('id');
	$('.gallery'+id).remove();

});
if($('.multi_images_preview_area').length && jQuery().sortable) {
   $( ".multi_images_preview_area" ).sortable();
   $( ".multi_images_preview_area" ).disableSelection();
 }


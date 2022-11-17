
let imageWhenValidated = $( "#image" ).find('.row').find('.col-sm-6').find('img');

$(document).ready(function () {




let value = $('#image-theme').val()

if (value) { 

  $.ajax({
    'url' : `/api/admin/attach-image/${value}`,
    'type' : 'get'

  }).then((image) => {


  imageWhenValidated.after("<div class='imageFrameCreate'> </div>");
  $('.imageFrameCreate').css("background-image", "url('"+image+"')");

  });

} 

let selectImage = $('#image-theme').on('change', function (value = null) {

  if (value.target.value == '') 
    return;

  $.ajax({
    'url' : `/api/admin/attach-image/${value.target.value}`,
    'type' : 'get'
  }).then((image) => {
  imageWhenValidated.after("<div class='imageFrameCreate'> </div>");
  $('.imageFrameCreate').css("background-image", "url('"+image+"')");
  });

});




if (imageWhenValidated.attr('src').length) {



} else {

let img = $( ".preview-lg" );
let parentImage = $( "#image" ).find('.row').find('.col-sm-6');

let selectImage = $('#image-theme').on('change', function (value) {

  if (value.target.value == '') 
    return;

  $.ajax({
    'url' : `/api/admin/attach-image/${value.target.value}`,
    'type' : 'get'
  }).then((image) => {


    let previewWidth = img[0].clientWidth;

  img.after("<div class='imageFrameCreate'> </div>");

  $('.imageFrameCreate').css("width", previewWidth+'px');
  $('.imageFrameCreate').css("background-image", "url('"+image+"')");

  });

});
}

});








$(document).ready(function () {
let img = $( ".preview-lg" ).find('img');

let value = $('#image-theme').val();

if (value == '') { 
  value = 0;
}

  $.ajax({
    'url' : `/api/admin/attach-image/${value}`,
    'type' : 'get'
  }).then((image) => {

    img.after("<div class='imageFrame'> </div>");
    $('.imageFrame').css("background-image", "url('"+image+"')");

  });


});

let selectImage = $('#image-theme').on('change', function (value) {

  let currentSelectedValue = 0;
  if (value.target.value != '') { 
    currentSelectedValue = value.target.value;
  }

  $.ajax({
    'url' : `/api/admin/attach-image/${currentSelectedValue}`,
    'type' : 'get'
  }).then((image) => {

  img.after("<div class='imageFrame'> </div>");

  $('.imageFrame').css("background-image", "url('"+image+"')");

  });

});

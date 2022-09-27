$(document).ready(function () {

  $('[data-handle=mainImage]').ready(function (val) {
    console.log($('[data-handle=mainImage]'));
    if ($('[data-handle=mainImage]')[0].currentSrc == '') 
      return;

    $('.image_caption').removeClass('d-none');
    $('.image_theme').removeClass('d-none');   // console.log(val);
  })


  $('.image').change(function (val) {

    $('.image_caption').removeClass('d-none');
    $('.image_theme').removeClass('d-none');   // console.log(val);

  });

  $('[data-handle=remove]').click(function () {

   
    $('.image_caption').addClass('d-none');
    $('.image_theme').addClass('d-none');

    $('.image_caption').val('');
    $('.image_caption').val('');
    // console.log('handle with care')

  })
})

crud.field('image').onChange(function(field) {
// crud.field('players').subfield('chips', field.rowNumber).input.value = Math.floor(Math.random() * 100) 


});

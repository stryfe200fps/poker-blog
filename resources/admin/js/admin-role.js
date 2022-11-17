$(document).ready(function () {

  $('.col-sm-4').each(function(i, obj) {

    if (i % 5 === 0 ) { 
let splitted  = $(`.col-sm-4:eq(${i})`)[0].innerText.split(".")[0];

let trimmed = splitted.trim();

var newElement = document.createElement('b');
newElement.className = 'col-md-12';
newElement.innerHTML = trimmed;

      let anotherElement =  $(`.col-sm-4:eq(${i})`);
      anotherElement.before(newElement);

      
    }
  });

})

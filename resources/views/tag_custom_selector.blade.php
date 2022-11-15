Tags 
<link rel="stylesheet" href="/css/bootstrap-tagsinput.css" />
  <div class="bs-example">
        <input name="fake_tags" id="fake_tags" value="{{implode(',', collect($crud->entry->tags ?? [])->map->only('title')->pluck('title')->toArray())}} " type="text"  data-role="tagsinput" />
        <div id="tag_result" style=" box-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25); padding:5px;z-index:100; position:absolute;height:auto; background-color:#fff; width:100%;">Loading...</div>
  </div>

<script src="/js/jquery.min.js"> </script>

<script>

  $(document).ready(function () {

  var tagResult = $('#tag_result');

  var firstResult = '';

  tagResult.hide();

  function search (query) { 
  $.ajax({
    url: "/api/fetch/tag",
    data: {query:query},
    method: 'GET',
  }).done(function(results) {
    firstResult = '';
    tagResult.html('');

    var resultString = '<ul style="list-style-type:none; padding:5px;">';

    results.forEach(function (result, index) {
      if (index == 0)
        firstResult = result.title

      resultString += ' <a href="#"><li>  ' + result.title + '</li> </a> ';
    });

    resultString += '</ul>';

    if (results.length === 0)
    {
      tagResult.html('No result');
    } else {
      tagResult.html(resultString);
    }


  });
  }
    setTimeout(function () {
    var input = $('.bootstrap-tagsinput').find('input[type=text]');
    var keyStroke = [];

    input.keydown(function (event)  {
      if (event.keyCode == 9) { 
        setTimeout(function () {
          input.focus();
        }, 50)
        if (firstResult !== '') 
          input.val(firstResult)

          tagResult.hide();
      }
        tagResult.show();
        search(input.val());
    });

    input.keyup(function (event) {
      if (input.val() === '')
        tagResult.hide();
    });

    input.keypress(function (event) {
      if (event.keyCode == 13) { 
        if (firstResult !== '') 
          input.val(firstResult)

        tagResult.hide();
        event.preventDefault();
      }

    })
    }, 500)
  });

  </script>

<style>
  .label-info {
    color:#000!important;
  }

  .bootstrap-tagsinput {
    padding-top:5px;
    padding-bottom:5px;
    width:1200px!important;
  }
</style> 
Tags 
<link rel="stylesheet" href="/css/bootstrap-tagsinput.css" />
        <div class="bs-example">
              <input name="fake_tags" value="{{implode(',', collect($crud->entry->tags ?? [])->map->only('title')->pluck('title')->toArray())}} " type="text"  data-role="tagsinput" />
        </div>

<script src="/js/jquery.min.js"> </script>

<script>

  $(document).ready(function () {
    setTimeout(function () {
    var input = $('.bootstrap-tagsinput').find('input[type=text]');
    input.keydown(function (event)  {
      if (event.keyCode == 9) { 
        setTimeout(function () {
          input.focus();
        }, 50)
      }
    });

    input.keypress(function (event) {

      if (event.keyCode == 13)
        event.preventDefault();
      
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
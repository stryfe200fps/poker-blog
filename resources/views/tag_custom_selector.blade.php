  Tags

<input type="text" name="fake_tags" value="{{implode(',', collect($crud->entry->tags ?? [])->map->only('title')->pluck('title')->toArray())}}" id="tags-input" data-role="tagsinput"/>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js-bootstrap-css/1.2.1/typeaheadjs.min.css" integrity="sha512-jG7NmK8Pm8iKEjw8aIWc+GVFBM33O/Ow4U0Xw34D5yyST0fgmlcV6shsghOXexDsAqtE2TCM6WwNy35qX8E6ng==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
	body { 
		font-family:calibri;
	}
	.twitter-typeahead { 
		display:initial !important; 
	}
	.bootstrap-tagsinput {
		overflow: hidden;
		box-sizing: border-box;
    text-overflow: ellipsis;
    white-space: nowrap;

		display:block !important;
    background-color: #fff;
    border: 1px solid rgba(0,40,100,.12);
    border-radius: 3px;
    color: #506690;
    font-size: .9375rem;
    font-weight: 400;
		line-height: 1.6;
    padding: 0.375rem 0.75rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    width: 100%;
	}
	.bootstrap-tagsinput:focus{
		border-color: #f44336;
    box-shadow: 0 0 0 2px #dcdefb;
	}

	.bootstrap-tagsinput .tag {
		color: #555;
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
    cursor: default;
    float: left;
    padding: 0 6px;
	}
	.tt-hint {
		opacity: 0 !important;
	}
	/* .tt-input{
		vertical-align:baseline !important;
	} */
	.typeahead { 
		border: 1px solid #CCCCCC;
		border-radius: 4px;
		padding: 8px 12px;
		width: 300px;
		font-size:1.5em;
	}
	.tt-menu { 
		position: static !important;
		width: 569.328px !important;
		max-width: 100% !important;
		margin: 0 !important;
		padding: 0 !important;
		float: none !important;
	}
	span.twitter-typeahead .tt-suggestion {
		padding: 10px 20px;	
		border-bottom:#CCC 1px solid;
		cursor:pointer;
	}
	span.twitter-typeahead .tt-suggestion:last-child { 
		border-bottom:0px; 
	}
	/* .demo-label {
		font-size:1.5em;
		color: red;
		font-weight: 500;
	} */
	/* .bgcolor {
		max-width: 440px;
		height: 200px;
		background-color: #c3e8cb;
		padding: 40px 70px;
		border-radius:4px;
		margin:20px 0px;
	} */
  .bootstrap-tagsinput:nth-child(2) { 
		display:none!important; 
	}
</style>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.3.1/typeahead.bundle.js" integrity="sha512-4hPOi7CoTBuZdApqBMe475jm2uuzC7dvUGCSDFkPMyfBWZHulaw4JmJVl4plJAtKVGmonz7YvB9j1aT0ayqsqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	var tags = new Bloodhound({
	  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	  queryTokenizer: Bloodhound.tokenizers.whitespace,
	  prefetch: {
		url: '/api/fetch/tag',
		filter: function(list) {
		  return $.map(list, function(name) {
			return { name: name }; });
		}
	  }
	});

	let data= {
		name: 'tags',
		displayKey: 'name',
		valueKey: 'name',
		source: tags.ttAdapter() 
  };
	$('#tags-input').tagsinput({
	  typeaheadjs: data,
	});
</script>

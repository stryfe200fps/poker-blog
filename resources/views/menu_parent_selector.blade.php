<select name="parent_id" class="form-control">
<option value="0">-</option> 
@foreach (\App\Models\MenuItem::getTree(); as $item)

<option value="{{$item->id}}"> {{ $item->name }} </option> 

  @foreach ($item->children as $child) 
    <option disabled> -- {{ $child->name }} </option>
  @endforeach

@endforeach 
</select>

<select value="{{$crud->entry?->parent_id}}" name="parent_id" class="form-control">

  <option value="0">-</option>
  @foreach (\App\Models\MenuItem::getTree(); as $item)

  <option value="{{$item->id}}"> {{ $item->name }} </option>

  @foreach ($item->children as $child)
  <option disabled> -- {{ $child->name }} </option>
  @endforeach

  @endforeach
</select>

<script>
  window.addEventListener("load", (event) => {

    let qs = document.querySelector("select[name='parent_id']")
    let val = '{{ $crud->entry?->parent_id }}' === '' ? 0 : '{{ $crud->entry?->parent_id }}';
    console.log(typeof(val));

    qs.value = val;
    // console.log('t' + val + ' value' + qs.value)


    let menuItem = document.querySelector("select[data-identifier='page_or_link_select']")

    console.log(menuItem);
    menuItem.options[1].selected = true;
    fireEvent(menuItem, 'change');

    setTimeout(() => {
      menuItem.options[0].selected = true;
      fireEvent(menuItem, 'change');
    }, 250);
    // menuItem.onchange();

    // menuItem.addEventListener('click', function() {
    // select.value = 2;
    // var evt = document.createEvent("HTMLEvents");
    // evt.initEvent("change", 1, 1);
    // menuItem.
    // menuItem.dispatchEvent(evt);
    // });
    // console.log(qs);

    // qs.selectedIndex = 0;

  });

  // function clickSelect(element) {
  //   const event = new MouseEvent("mousedown");
  //   console.log(element);
  //   element.dispatchEvent(event);
  // }

  function fireEvent(element, event) {
    if (document.createEventObject) {
      // dispatch for IE
      var evt = document.createEventObject();
      return element.fireEvent('on' + event, evt)
    } else {
      // dispatch for firefox + others
      var evt = document.createEvent("HTMLEvents");
      evt.initEvent(event, true, true); // event type,bubbling,cancelable
      return !element.dispatchEvent(evt);
    }
  }
</script>
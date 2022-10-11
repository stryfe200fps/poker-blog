{{-- CKeditor --}}
@php
    $field['extra_plugins'] = isset($field['extra_plugins']) ? implode(',', $field['extra_plugins']) : "embed,widget";

    $defaultOptions = [
        "filebrowserBrowseUrl" => backpack_url('elfinder/ckeditor'),
        "extraPlugins" => $field['extra_plugins'],
        "embed_provider" => "//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}",
    ];

    $field['options'] = array_merge($defaultOptions, $field['options'] ?? []);
@endphp

@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')
    <textarea
        name="{{ $field['name'] }}"
        data-init-function="bpFieldInitCKEditorElement"
        data-options="{{ trim(json_encode($field['options'])) }}"
        bp-field-main-input
        @include('crud::fields.inc.attributes', ['default_class' => 'form-control'])
    	>{{ old_empty_or_null($field['name'], '') ??  $field['value'] ?? $field['default'] ?? '' }}</textarea>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')


{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        @loadOnce('packages/ckeditor/ckeditor.js')
        @loadOnce('packages/ckeditor/adapters/jquery.js')
        @loadOnce('bpFieldInitCKEditorElement')
        <script>

   var suits = ['s','c','h','d'];
                var cards = ['2','3','4','5','6','7','8','9','t','a','j','q','k'];
                var PLACEHOLDERS = [];
                suits.forEach(function (suit, index) {
                cards.forEach(function (card, indexs) {
                    PLACEHOLDERS.push({
                    id: (index+1)*20 + indexs, 
                    code: card + suit
                    });
                });  
                });   

            function bpFieldInitCKEditorElement(element) {

                element.on('CrudField:delete', function(e) {
                    if (typeof element.editor !== undefined) {
                        element.editor.destroy(true);
                    }
                });

                // trigger a new CKEditor
                element.ckeditor(element.data('options'));

                // element.ckeditor.allowedContent = true;

                // trigger the change event on textarea when ckeditor changes
                element.editor.on('change', (evt, data) => {
                element.trigger('change');

                    
                });

                element.editor.on('instanceReady', (evt) => {
                     var itemTemplate = '<li data-id="{id}">' +
                    '<img width="25" height="15" class="photo" src="/cards/{code}.png" />' +
                    '</li>',
                    outputTemplate = '<img width="25" height="15" style="margin-right:5px;" src="/cards/{code}.png"/>';

                    var autocomplete = new CKEDITOR.plugins.autocomplete(evt.editor, {
                    textTestCallback: textTestCallback,
                    dataCallback: dataCallback,
                    itemTemplate: itemTemplate,
                    outputTemplate: outputTemplate
                    });

                       autocomplete.getHtmlToInsert = function(item) {
                    return this.outputTemplate.output(item);
                    }

                })


                element.on('CrudField:disable', function(e) {
                    if (typeof element.editor !== undefined) {
                        element.editor.setReadOnly(true);
                    }
                });

                element.on('CrudField:enable', function(e) {
                    if (typeof element.editor !== undefined) {
                        element.editor.setReadOnly(false);
                    }
                });

                // console.log(new CKEDITOR.plugins.autocomplete());
            }

                function textTestCallback(range) {
      if (!range.collapsed) {
        return null;
      }

      return CKEDITOR.plugins.textMatch.match(range, matchCallback);
    }


    function matchCallback(text, offset) {
      var pattern = /\/{1}([a-z0-9])+$/i,
        match = text.slice(0, offset)
        .match(pattern);

      if (!match) {
        return null;
      }

      return {
        start: match.index,
        end: offset
      };
    }


    function dataCallback(matchInfo, callback) {
      var data = PLACEHOLDERS.filter(function(item) {
        var itemName = '/' + item.code;
        
        return itemName.indexOf(matchInfo.query.toLowerCase()) == 0;
      });


      callback(data);
    }


        </script>
        @endLoadOnce
    @endpush

{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}

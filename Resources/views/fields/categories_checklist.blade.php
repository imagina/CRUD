<!-- select2 -->
<div @include('bcrud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    <?php $entity_model = $crud->getModel(); ?>

    <div class="row checkbox">

        <ul class="checkbox col-xs-12">

        @foreach ($field['model']::where('parent_id',0)->get() as $connected_entity_entry)
                  <li>

                  <label>
                    <input type="checkbox" class="flat-blue jsInherit"
                      name="{{ $field['name'] }}[]"
                      value="{{ $connected_entity_entry->id }}"

                      @if( ( old( $field["name"] ) && in_array($connected_entity_entry->id, old( $field["name"])) ) || (isset($field['value']) && in_array($connected_entity_entry->id, $field['value']->pluck('id', 'id')->toArray())))
                             checked = "checked"
                      @endif > {!! $connected_entity_entry->{$field['attribute']} !!}
                  </label>


                    @if(count($connected_entity_entry->children))
                        @include('iblog::admin.fields.categories_checklist_child',['children' => $connected_entity_entry->children])
                    @endif
                   </li>

        @endforeach
        </ul>
    </div>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>
@push('crud_fields_styles')
{{--
<link href="{{ asset('modules/iblog/vendor/checkbox-inline/build.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('modules/iblog/vendor/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet" type="text/css" />--}}
@endpush

@push('crud_fields_scripts')
<script>
    jQuery(document).ready(function($) {
        $('input[type="checkbox"].flat-blue, input[type="radio"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });
    });
</script>
@endpush
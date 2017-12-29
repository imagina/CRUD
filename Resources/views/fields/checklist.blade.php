<!-- select2 -->
<div @include('bcrud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    @include('bcrud::inc.field_translatable_icon')
    <?php $entity_model = $crud->getModel(); ?>

    <div class="row checkbox">
        @foreach ($field['model']::all() as $connected_entity_entry)
            <div class="checkbox col-xs-12">
                <label>
                    <input type="checkbox" class="flat-blue jsInherit"
                           name="{{ $field['name'] }}[]"
                           value="{{ $connected_entity_entry->getKey() }}"

                           @if( ( old( $field["name"] ) && in_array($connected_entity_entry->getKey(), old( $field["name"])) ) || (isset($field['value']) && in_array($connected_entity_entry->getKey(), $field['value']->pluck($connected_entity_entry->getKeyName(), $connected_entity_entry->getKeyName())->toArray())))
                           checked="checked"
                            @endif > {!! $connected_entity_entry->{$field['attribute']} !!}
                </label>
            </div>
        @endforeach
    </div>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>

@push('crud_fields_scripts')
    <script>
        jQuery(document).ready(function ($) {
            $('input[type="checkbox"].flat-blue, input[type="radio"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
@endpush
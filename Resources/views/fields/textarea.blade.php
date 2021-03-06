<!-- textarea -->
<div @include('bcrud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    @include('bcrud::inc.field_translatable_icon')
    <textarea
    	name="{{ $field['name'] }}"
        @include('bcrud::inc.field_attributes')

    	>{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}</textarea>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>
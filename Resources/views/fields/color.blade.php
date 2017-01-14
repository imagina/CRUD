<!-- html5 color input -->
<div @include('bcrud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    @include('bcrud::inc.field_translatable_icon')
    <input
    	type="color"
    	name="{{ $field['name'] }}"
        value="{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}"
        @include('bcrud::inc.field_attributes')
    	>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>
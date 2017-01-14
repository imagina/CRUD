<!-- password -->
<div @include('bcrud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    @include('bcrud::inc.field_translatable_icon')
    <input
    	type="password"
    	name="{{ $field['name'] }}"
        @include('bcrud::inc.field_attributes')
    	>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>
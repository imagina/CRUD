<!-- hidden input -->
<div @include('bcrud::inc.field_wrapper_attributes') >
  <input
  	type="hidden"
    name="{{ $field['name'] }}"
    value="{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}"
    @include('bcrud::inc.field_attributes')
  	>
</div>
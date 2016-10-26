<!-- view field -->

<div @include('bcrud::inc.field_wrapper_attributes') >
  @include($field['view'], compact('crud', 'entry', 'field'))
</div>

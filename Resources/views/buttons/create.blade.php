@if ($crud->hasAccess('create'))
	<a href="{{ url($crud->route.'/create') }}" class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i> {{ trans('bcrud::crud.add') }} {{ $crud->entity_name }}</span></a>
@endif
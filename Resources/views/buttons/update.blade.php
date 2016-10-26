@if ($crud->hasAccess('update'))
	<a href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{ trans('bcrud::crud.edit') }}</a>
@endif
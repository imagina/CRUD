@extends('layouts.master')

@section('header')
	<section class="content-header">
	  <h1>
	    {{ trans('bcrud::crud.edit') }} <span class="text-lowercase">{{ $crud->entity_name }}</span>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="{{ url('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
	    <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('bcrud::crud.edit') }}</li>
	  </ol>
	</section>
@endsection

@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<!-- Default box -->
		@if ($crud->hasAccess('list'))
			<a href="{{ url($crud->route) }}"><i class="fa fa-angle-double-left"></i> {{ trans('bcrud::crud.back_to_all') }} <span class="text-lowercase">{{ $crud->entity_name_plural }}</span></a><br><br>
		@endif

		  {!! Form::open(array('url' => $crud->route.'/'.$entry->getKey(), 'method' => 'put', 'files'=>$crud->hasUploadFields('create'))) !!}
		  <div class="box">
		    <div class="box-header with-border">
		      <h3 class="box-title">{{ trans('bcrud::crud.edit') }}</h3>
		    </div>
		    <div class="box-body row">
		      <!-- load the view from the application if it exists, otherwise load the one in the package -->
		      @if(view()->exists('vendor.backpack.crud.form_content'))
		      	@include('vendor.backpack.crud.form_content')
		      @else
		      	@include('bcrud::form_content', ['fields' => $crud->getFields('update', $entry->getKey())])
		      @endif
		    </div><!-- /.box-body -->
		    <div class="box-footer">

			  <button type="submit" class="btn btn-success ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-save"></i> {{ trans('bcrud::crud.save') }}</span></button>
		      <a href="{{ url($crud->route) }}" class="btn btn-default ladda-button" data-style="zoom-in"><span class="ladda-label">{{ trans('bcrud::crud.cancel') }}</span></a>
		    </div><!-- /.box-footer-->
		  </div><!-- /.box -->
		  {!! Form::close() !!}
	</div>
</div>
@endsection

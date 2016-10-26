@extends('layouts.master')

@section('content-header')
	<section class="content-header">
	  <h1>
	    {{ trans('bcrud::crud.preview') }} <span class="text-lowercase">{{ $crud->entity_name }}</span>
	  </h1>
	  <ol class="breadcrumb">
		  <li><a href="{{ url('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
	    <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('bcrud::crud.preview') }}</li>
	  </ol>
	</section>
@endsection

@section('content')
	@if ($crud->hasAccess('list'))
		<a href="{{ url($crud->route) }}"><i class="fa fa-angle-double-left"></i> {{ trans('bcrud::crud.back_to_all') }} <span class="text-lowercase">{{ $crud->entity_name_plural }}</span></a><br><br>
	@endif

	<!-- Default box -->
	  <div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">{{ trans('bcrud::crud.preview') }} <span class="text-lowercase">{{ $crud->entity_name }}</h3>
	    </div>
	    <div class="box-body">
	      {{ dump($entry) }}
	    </div><!-- /.box-body -->
	  </div><!-- /.box -->

@endsection

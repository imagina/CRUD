@extends('layouts.master')

@section('header')
  <section class="content-header">
    <h1>
      <span>{{ ucfirst($crud->entity_name) }}</span> {{ trans('bcrud::crud.revisions') }}
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
      <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
      <li class="active">{{ trans('bcrud::crud.revisions') }}</li>
    </ol>
  </section>
@endsection

@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <!-- Default box -->
    @if ($crud->hasAccess('list'))
      <a href="{{ url($crud->route) }}"><i class="fa fa-angle-double-left"></i> {{ trans('bcrud::crud.back_to_all') }} <span class="text-lowercase">{{ $crud->entity_name_plural }}</span></a><br><br>
    @endif

    @if(!count($revisions))
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">{{ trans('bcrud::crud.no_revisions') }}</h3>
        </div>
      </div>
    @else
      @include('bcrud::inc.revision_timeline')
    @endif
  </div>
</div>
@endsection

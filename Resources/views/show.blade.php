@extends('layouts.master')

@section('content-header')
    <section class="content-header">
        <h1>
            {{ trans('bcrud::crud.preview') }} <span class="text-lowercase">{{ $crud->entity_name }}</span>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::route('dashboard.index') }}"><i
                            class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
            <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
            <li class="active">{{ trans('bcrud::crud.preview') }}</li>
        </ol>
    </section>
@endsection

@section('content')
    @if ($crud->hasAccess('list'))
        <a href="{{ url($crud->route) }}"><i class="fa fa-angle-double-left"></i> {{ trans('bcrud::crud.back_to_all') }}
            <span class="text-lowercase">{{ $crud->entity_name_plural }}</span></a><br><br>
    @endif

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                {{ trans('bcrud::crud.preview') }}
                <span class="text-lowercase">{{ $crud->entity_name }}</span>
            </h3>
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered">
                <tbody>
                @foreach ($crud->columns as $column)
                    <tr>
                        <td>
                            <strong>{{ $column['label'] }}</strong>
                        </td>
                        @if (!isset($column['type']))
                            @include('bcrud::columns.text')
                        @else
                            @if(view()->exists('vendor.backpack.crud.columns.'.$column['type']))
                                @include('vendor.backpack.crud.columns.'.$column['type'])
                            @else
                                @if(view()->exists('bcrud::columns.'.$column['type']))
                                    @include('bcrud::columns.'.$column['type'])
                                @else
                                    @include('bcrud::columns.text')
                                @endif
                            @endif
                        @endif
                    </tr>
                @endforeach
                @if ($crud->buttons->where('stack', 'line')->count())
                    <tr>
                        <td><strong>{{ trans('bcrud::crud.actions') }}</td>
                        <td>
                            @include('bcrud::inc.button_stack', ['stack' => 'line'])
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

@endsection


@section('after_styles')
    <link rel="stylesheet" href="{{ asset('modules/bcrud/vendor/crud/css/crud.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/bcrud/vendor/crud/css/show.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('modules/bcrud/vendor/crud/js/crud.js') }}"></script>
    <script src="{{ asset('modules/bcrud/vendor/crud/js/show.js') }}"></script>
@endsection

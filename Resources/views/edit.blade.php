@extends('layouts.master')

@section('header')
    <section class="content-header">
        <h1>
            {{ trans('bcrud::crud.edit') }} <span class="text-lowercase">{{ $crud->entity_name }}</span>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::route('dashboard.index') }}"><i
                            class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
            <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
            <li class="active">{{ trans('bcrud::crud.edit') }}</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Default box -->
            @if ($crud->hasAccess('list'))
                <a href="{{ url($crud->route) }}"><i
                            class="fa fa-angle-double-left"></i> {{ trans('bcrud::crud.back_to_all') }} <span
                            class="text-lowercase">{{ $crud->entity_name_plural }}</span></a><br><br>
            @endif

            @include('bcrud::inc.grouped_errors')

            {!! Form::open(array('url' => $crud->route.'/'.$entry->getKey(), 'method' => 'put', 'files'=>$crud->hasUploadFields('update', $entry->getKey()))) !!}
            <div class="box">

                <div class="box-header with-border">
                @if ($crud->model->translationEnabled())
                    <!-- Single button -->
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                {{trans('bcrud::crud.language')}}
                                : {{ $crud->model->getAvailableLocales()[$crud->request->input('locale')?$crud->request->input('locale'):App::getLocale()] }}
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($crud->model->getAvailableLocales() as $key => $locale)
                                    <li>
                                        <a href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}?locale={{ $key }}">{{ $locale }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <h3 class="box-title" style="line-height: 30px;">{{ trans('bcrud::crud.edit') }}</h3>
                    @else
                        <h3 class="box-title">{{ trans('bcrud::crud.edit') }}</h3>
                    @endif
                </div>
                <div class="box-body row">
                    <!-- load the view from the application if it exists, otherwise load the one in the package -->
                    @if(view()->exists('vendor.backpack.crud.form_content'))
                        @include('vendor.backpack.crud.form_content', ['fields' => $fields, 'action' => 'edit'])
                    @else
                        @include('bcrud::form_content', ['fields' => $fields, 'action' => 'edit'])
                    @endif
                </div><!-- /.box-body -->
                <div class="box-footer">

                    @include('bcrud::inc.form_save_buttons')

                </div><!-- /.box-footer-->

            </div><!-- /.box -->
            {!! Form::close() !!}
        </div>
        @stack('gallery_fields')
    </div>

@endsection
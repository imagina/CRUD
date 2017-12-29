{{-- Show the inputs --}}
@foreach ($fields as $field)
    @if(!empty($field['viewposition']))
        @push($field['viewposition'].'_fields')
            <!-- load the view from the application if it exists, otherwise load the one in the package -->
            @include('bcrud::fields.'.$field['type'], array('field' => $field))
        @endpush
            @else
                @push('left_fields')
                    @include('bcrud::fields.'.$field['type'], array('field' => $field))
                @endpush
            @endif

@endforeach
<div class="col-xs-12 col-md-8">
    <div class="row">
        @stack('left_fields')
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel box box-primary">
                <div class="box-header">
                    <h4 class="box-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            {{ trans('bcrud::crud.additional') }}
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="box-body">
                        @stack('additional_fields')
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<div class="col-xs-12 col-md-4">
    @stack('right_fields')
</div>
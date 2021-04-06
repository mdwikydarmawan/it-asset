@extends('layouts.app')

@section('content')
    <h3 class="page-title">Add New Data Center</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['param.dc.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Data Center Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('dc_name', old('dc_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'dc_name']) !!}
                    {!! Form::label('name', 'Data Center Telephone*', ['class' => 'control-label']) !!}
                    {!! Form::text('dc_telephone', old('dc_telephone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'dc_telephone']) !!}
                    {!! Form::label('name', 'Data Center Address*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('dc_address', old('dc_address'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'dc_address']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


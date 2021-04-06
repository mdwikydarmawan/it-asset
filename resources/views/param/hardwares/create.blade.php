@extends('layouts.app')

@section('content')
    <h3 class="page-title">Add New Hardware Parameter</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['param.hardwares.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Hardware Asset Code*', ['class' => 'control-label']) !!}
                    {!! Form::text('param_hardware_asset_code', old('param_hardware_asset_code'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'param_hardware_asset_code']) !!}
                    {!! Form::label('name', 'Hardware Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('param_hardware_name', old('param_hardware_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'param_hardware_name']) !!}
                    {!! Form::label('name', 'Hardware Information*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('param_hardware_information', old('param_hardware_information'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'param_hardware_information']) !!}
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


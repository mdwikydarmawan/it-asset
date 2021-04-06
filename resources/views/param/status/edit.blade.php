@extends('layouts.app')

@section('content')
    <h3 class="page-title">Details PKS Type</h3>
    
    {!! Form::model($param_status, ['method' => 'PUT', 'route' => ['param.status.update', $param_status->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Status Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('status_name', old('status_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'status_name']) !!}
                    {!! Form::label('name', 'Status Information*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('status_information', old('status_information'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'status_information']) !!}
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


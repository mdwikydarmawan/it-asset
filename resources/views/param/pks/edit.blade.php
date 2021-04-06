@extends('layouts.app')

@section('content')
    <h3 class="page-title">Details PKS Type</h3>
    
    {!! Form::model($param_pks, ['method' => 'PUT', 'route' => ['param.pkstype.update', $param_pks->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'PKS Type*', ['class' => 'control-label']) !!}
                    {!! Form::text('pks_type', old('pks_type'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'pks_type']) !!}
                    {!! Form::label('name', 'PKS Type Information*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('pks_type_information', old('pks_type_information'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'pks_type_information']) !!}
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


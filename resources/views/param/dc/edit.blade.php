@extends('layouts.app')

@section('content')
    <h3 class="page-title">Details Data Center</h3>
    
    {!! Form::model($param_dc, ['method' => 'PUT', 'route' => ['param.dc.update', $param_dc->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Data Center Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('dc_name', old('dc_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    {!! Form::label('name', 'Data Center Telephone*', ['class' => 'control-label']) !!}
                    {!! Form::text('dc_telephone', old('dc_telephone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    {!! Form::label('name', 'Data Center Address*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('dc_address', old('dc_address'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


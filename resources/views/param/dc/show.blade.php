@extends('layouts.app')

@section('content')
    <h3 class="page-title">Detail</h3>

    {!! Form::model($param_dc, ['method' => 'PUT', 'route' => ['param.dc.update', $param_dc->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Data Center Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('dc_name', old('dc_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                    {!! Form::label('name', 'Data Center Telephone*', ['class' => 'control-label']) !!}
                    {!! Form::text('dc_telephone', old('dc_telephone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                    {!! Form::label('name', 'Data Center Address*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('dc_address', old('dc_address'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                </div>
            </div>
            
        </div>
    </div>

    <div>
        <a class="btn btn-danger" href="{{ route('param.dc.index') }}"> Back</a>
    </div>
    {!! Form::close() !!}
@stop


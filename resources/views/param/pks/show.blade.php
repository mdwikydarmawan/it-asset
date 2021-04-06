@extends('layouts.app')

@section('content')
    <h3 class="page-title">Detail</h3>

    {!! Form::model($param_pks, ['method' => 'PUT', 'route' => ['param.pkstype.update', $param_pks->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'PKS Type*', ['class' => 'control-label']) !!}
                    {!! Form::text('pks_type', old('pks_type'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'pks_type', 'disabled' => 'disabled']) !!}
                    {!! Form::label('name', 'PKS Type Information*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('pks_type_information', old('pks_type_information'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'pks_type_information', 'disabled' => 'disabled']) !!}
                </div>
            </div>
            
        </div>
    </div>

    <div>
        <a class="btn btn-danger" href="{{ route('param.pkstype.index') }}"> Back</a>
    </div>
    {!! Form::close() !!}
@stop


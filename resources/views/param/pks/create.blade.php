@extends('layouts.app')

@section('content')
    <h3 class="page-title">Add New PKS Type</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['param.pkstype.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'PKS Type*', ['class' => 'control-label']) !!}
                    {!! Form::text('pks_type', old('pks_type'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'pks_type']) !!}
                    {!! Form::label('name', 'PKS Type Information*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('pks_type_information', old('pks_type_information'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'pks_type_information']) !!}
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


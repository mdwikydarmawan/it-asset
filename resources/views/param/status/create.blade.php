@extends('layouts.app')

@section('content')
    <h3 class="page-title">Add New Status Parameter</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['param.status.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Status Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('status_name', old('status_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'status_name']) !!}
                    {!! Form::label('name', 'Status Information*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('status_information', old('status_information'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'status_information']) !!}
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


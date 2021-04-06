@extends('layouts.app')

@section('content')
    <h3 class="page-title">Detail</h3>

    {!! Form::model($helpdesk_hardware, ['method' => 'PUT', 'route' => ['helpdesk.hardware.update', $helpdesk_hardware->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('3', 'Hardware Name*', ['class' => 'control-label']) !!}
                                <select class="form-control" name="hardware_id" disabled="disabled">
                                    <option value="{{$helpdesk_hardware->hardware_id}}">{{$helpdesk_hardware->param_hardware_name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Hardware Total*', ['class' => 'control-label']) !!}
                                {!! Form::text('hardware_total', old('hardware_total'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                {!! Form::label('name', 'Hardware Information*', ['class' => 'control-label']) !!}
                                {!! Form::textarea('hardware_information', old('hardware_information'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  

    </div>

    <div>
        <a class="btn btn-danger" href="{{ route('helpdesk.hardware.index') }}"> Back</a>
    </div>
    {!! Form::close() !!}
@stop


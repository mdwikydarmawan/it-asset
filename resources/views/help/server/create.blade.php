@extends('layouts.app')

@section('content')
    <h3 class="page-title">Add New Server</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['helpdesk.server.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                {!! Form::label('3', 'Data Center Name*', ['class' => 'control-label']) !!}
                                <!-- {!! Form::text('application_name', old('application_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!} -->
                                <select class="form-control" name="dc_id" required>
                                    <option value="">--Choose--</option>
                                    @foreach($dc_list as $data)
                                      <option value="{{$data->id}}">{{$data->dc_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Label Name*', ['class' => 'control-label']) !!}
                                {!! Form::text('label_name', old('label_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('3', 'Server Information*', ['class' => 'control-label']) !!}
                                <!-- {!! Form::text('application_name', old('application_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!} -->
                                <select class="form-control" name="label_information" required>
                                    <option value="">--Choose--</option>
                                    <option value="PRODUCTION">PRODUCTION</option>
                                    <option value="DEVELOPMENT">DEVELOPMENT</option>
                                    <option value="DRC">DRC</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Server Name*', ['class' => 'control-label']) !!}
                                {!! Form::text('server_name', old('server_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'IP Address Server*', ['class' => 'control-label']) !!}
                                {!! Form::text('server_ip_address', old('server_ip_address'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Serial Number Server', ['class' => 'control-label']) !!}
                                {!! Form::text('serial_number', old('serial_number'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Device Name*', ['class' => 'control-label']) !!}
                                {!! Form::text('device_name', old('device_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Username Server', ['class' => 'control-label']) !!}
                                {!! Form::text('server_username', old('server_username'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Password Server', ['class' => 'control-label']) !!}
                                {!! Form::text('server_password', old('server_password'), ['class' => 'form-control', 'placeholder' => '']) !!}
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
                                {!! Form::label('name', 'Server Specification*', ['class' => 'control-label']) !!}
                                {!! Form::textarea('server_specification', old('server_specification'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    
    <div>
        <a class="btn btn-danger" href="{{ route('helpdesk.server.index') }}"> Back</a>
        {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@stop


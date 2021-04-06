@extends('layouts.app')

@section('content')
    <h3 class="page-title">Details Application Server</h3>
    
    {!! Form::model($dev_server, ['method' => 'PUT', 'route' => ['dev.server.update', $dev_server->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                {!! Form::label('3', 'Data Center Name*', ['class' => 'control-label']) !!}
                                <!-- {!! Form::text('application_name', old('application_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!} -->
                                <select class="form-control" name="dc_id">
                                    @foreach($server_detail as $data)
                                      <option value="{{$data->id}}">{{$data->dc_name}}</option>
                                    @endforeach
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
                                {!! Form::label('name', 'Serial Number Server*', ['class' => 'control-label']) !!}
                                {!! Form::text('serial_number', old('serial_number'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
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
                                {!! Form::label('name', 'Username Server*', ['class' => 'control-label']) !!}
                                {!! Form::text('server_username', old('server_username'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Password Server*', ['class' => 'control-label']) !!}
                                {!! Form::text('server_password', old('server_password'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
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

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


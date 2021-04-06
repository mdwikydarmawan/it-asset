@extends('layouts.app')

@section('content')
    <h3 class="page-title">Detail</h3>

    {!! Form::model($helpdesk_recap, ['method' => 'PUT', 'route' => ['helpdesk.server.update', $helpdesk_recap->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                {!! Form::label('3', 'Data Center Name*', ['class' => 'control-label']) !!}
                                <!-- {!! Form::text('application_name', old('application_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!} -->
                                <select class="form-control" name="dc_id" disabled="disabled">
                                    @foreach($server_detail as $data)
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
                                {!! Form::text('server_name', old('server_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'IP Address Server*', ['class' => 'control-label']) !!}
                                {!! Form::text('server_ip_address', old('server_ip_address'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
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
                                {!! Form::text('serial_number', old('serial_number'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Device Name*', ['class' => 'control-label']) !!}
                                {!! Form::text('device_name', old('device_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
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
                                {!! Form::text('server_username', old('server_username'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Password Server*', ['class' => 'control-label']) !!}
                                <!-- {!! Form::text('server_password', old('server_password'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!} -->
                                <input type="text" class="form-control" placeholder="Server Password" name="server_password" value="<?php echo $server_password ?>" disabled="disabled"/>
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
                                {!! Form::textarea('server_specification', old('server_specification'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  

    </div>

    <div>
        <a class="btn btn-danger" href="{{ route('helpdesk.server.index') }}"> Back</a>
    </div>
    {!! Form::close() !!}
@stop


@extends('layouts.app')

@section('content')
    <h3 class="page-title">Add New Application</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['dev.applications.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Application Name*', ['class' => 'control-label']) !!}
                                        {!! Form::text('application_name', old('application_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'application_name']) !!}
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
                                        {!! Form::label('name', 'Application Function*', ['class' => 'control-label']) !!}
                                        {!! Form::text('application_function', old('application_function'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'application_function']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Label Name Server Production*', ['class' => 'control-label']) !!}
                                        <select class="form-control" name="label_production" id="label_production" required>
                                            <option value="">--Choose--</option>
                                            @foreach($param_label as $data)
                                              <option value="{{$data->id}}">{{$data->label_name}} - {{$data->label_information}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Label Name Server DRC', ['class' => 'control-label']) !!}
                                        <select class="form-control" name="label_drc" id="label_drc">
                                            <option value="">--Choose--</option>
                                            @foreach($param_label as $data)
                                              <option value="{{$data->id}}">{{$data->label_name}} - {{$data->label_information}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Label Name Server Backup', ['class' => 'control-label']) !!}
                                        <select class="form-control" name="label_development" id="label_development">
                                            <option value="">--Choose--</option>
                                            @foreach($param_label as $data)
                                              <option value="{{$data->id}}">{{$data->label_name}} - {{$data->label_information}}</option>
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
                                        {!! Form::label('name', 'Development By*', ['class' => 'control-label']) !!}
                                        <select class="form-control input dynamic" data-dependent="pic" name="dev_by" id="vendor_id" required>
                                            <option value="">--Choose--</option>
                                            @foreach($param_vendor as $data)
                                              <option value="{{$data->id}}">{{$data->vendor_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('name', 'PIC*', ['class' => 'control-label']) !!}
                                        <select class="form-control input" name="pic" id="pic" required>
                                            <option value="">--Choose--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--{!! Form::label('name', 'DC Location*', ['class' => 'control-label']) !!} 
                    <select class="form-control" name="dc_location" required>
                        <option value="">--Choose--</option>
                        @foreach($param_dc as $data)
                          <option value="{{$data->dc_name}}">{{$data->dc_name}}</option>
                        @endforeach
                    </select>
                    {!! Form::label('name', 'DRC Location*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="drc_location" required>
                        <option value="">--Choose--</option>
                        @foreach($param_dc as $data)
                          <option value="{{$data->dc_name}}">{{$data->dc_name}}</option>
                        @endforeach
                        <option value="None">None</option>
                    </select> -->
                    <!-- {!! Form::label('name', 'Development By*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="dev_by">
                        <option value="">--Choose--</option>
                        @foreach($param_vendor as $data)
                          <option value="{{$data->id}}">{{$data->vendor_name}}</option>
                        @endforeach
                    </select> -->
                    {{ csrf_field() }}
                    <!-- {!! Form::label('name', 'Paltform OS in Server*', ['class' => 'control-label']) !!}
                    {!! Form::text('platform_os', old('platform_os'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'platform_os']) !!} -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Application Database*', ['class' => 'control-label']) !!}
                                        {!! Form::text('application_database', old('application_database'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'application_database']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Implementation Year*', ['class' => 'control-label']) !!}
                                        {!! Form::text('implementation_year', old('implementation_year'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'implementation_year']) !!}
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
                                        {!! Form::label('name', 'Source Code*', ['class' => 'control-label']) !!}
                                        <select class="form-control" name="source_code" required>
                                            <option value="">--Choose--</option>
                                            <option value="YES">YES</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Maintenance*', ['class' => 'control-label']) !!}
                                        <select class="form-control" name="isMaintenance" required>
                                            <option value="">--Choose--</option>
                                            <option value="YES">YES</option>
                                            <option value="NO">NO</option>
                                        </select>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


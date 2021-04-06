@extends('layouts.app')

@section('content')
    <h3 class="page-title">Details Application</h3>
    
    {!! Form::model($dev_applications, ['method' => 'PUT', 'route' => ['dev.applications.update', $dev_applications->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
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
                                            @foreach($param_detail as $detail)
                                                <option value="{{$detail->label_production}}">{{$detail->lprod}} - {{$detail->lprod_info}}</option>
                                                @foreach($param_label as $data)
                                                  <option value="{{$data->id}}">{{$data->label_name}} - {{$data->label_information}}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Label Name Server DRC', ['class' => 'control-label']) !!}
                                        <select class="form-control" name="label_drc" id="label_drc">
                                            @foreach($param_detail as $detail)
                                                @if($detail->label_drc != '')
                                                    <option value="{{$detail->label_drc}}">{{$detail->ldrc}} - {{$detail->ldrc_info}}</option>
                                                    @foreach($param_label as $data)
                                                      <option value="{{$data->id}}">{{$data->label_name}} - {{$data->label_information}}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">--Choose--</option>
                                                    @foreach($param_label as $data)
                                                      <option value="{{$data->id}}">{{$data->label_name}} - {{$data->label_information}}</option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Label Name Server Backup', ['class' => 'control-label']) !!}
                                        <select class="form-control" name="label_development" id="label_development">
                                            @foreach($param_detail as $detail)
                                                @if($detail->label_development != '')
                                                    <option value="{{$detail->label_development}}">{{$detail->ldev}} - {{$detail->ldev_info}}</option>
                                                    @foreach($param_label as $data)                                                      
                                                      <option value="{{$data->id}}">{{$data->label_name}} - {{$data->label_information}}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">--Choose--</option>
                                                    @foreach($param_label as $data)                                                      
                                                      <option value="{{$data->id}}">{{$data->label_name}} - {{$data->label_information}}</option>
                                                    @endforeach
                                                @endif
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
                                            @foreach($param_detail as $detail)
                                                <option value="{{$detail->dev_by}}">{{$detail->vendor_name}}</option>
                                            @endforeach
                                            @foreach($vendor_list as $data)
                                                <option value="{{$data->id}}">{{$data->vendor_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('name', 'PIC*', ['class' => 'control-label']) !!}
                                        <select class="form-control input" name="pic" id="pic" required>
                                            @foreach($param_detail as $detail)
                                                <option value="{{$detail->pic}}">{{$detail->pic_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ csrf_field() }}
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
                                            <option value="{{$dev_applications->source_code}}">{{$dev_applications->source_code}}</option>
                                            <option value="YES">YES</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Maintenance*', ['class' => 'control-label']) !!}
                                        <select class="form-control" name="isMaintenance" required>
                                            <option value="{{$dev_applications->isMaintenance}}">{{$dev_applications->isMaintenance}}</option>
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

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


@extends('layouts.app')

@section('content')
    <h3 class="page-title">Detail</h3>

    {!! Form::model($dev_applications, ['method' => 'PUT', 'route' => ['dev.applications.update', $dev_applications->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
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
                                        {!! Form::text('application_name', old('application_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'application_name', 'disabled' => 'disbaled']) !!}
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
                                        {!! Form::text('application_function', old('application_function'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'application_function', 'disabled' => 'disbaled']) !!}
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
                                        <select class="form-control" name="label_production" id="label_production" disabled="disabled">
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
                                        <select class="form-control" name="label_drc" id="label_drc" disabled="disabled">
                                            @foreach($param_detail as $detail)
                                                @if($detail->label_drc != '')
                                                    <option value="{{$detail->label_drc}}">{{$detail->ldrc}} - {{$detail->ldrc_info}}</option>
                                                @else
                                                    <option value="">No Data</option>
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
                                        <select class="form-control" name="label_development" id="label_development" disabled="disabled">
                                            @foreach($param_detail as $detail)
                                                @if($detail->label_development != '')
                                                    <option value="{{$detail->label_development}}">{{$detail->ldev}} - {{$detail->ldev_info}}</option>
                                                @else
                                                    <option value="">No Data</option>
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
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <!-- <button type="button" name="view" value="view" class="btn btn-primary mr-5 view_data" id="{{ $dev_applications->label_production }}">View Server Detail</button> -->
                                        <input type="button" name="view" value="Server Production Detail" id="{{ $dev_applications->label_production }}" class="btn btn-primary view_data" />
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <!-- <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#serverDrc">View Server Detail</button> -->
                                        <input type="button" name="view" value="Server DRC Detail" id="{{ $dev_applications->label_drc }}" class="btn btn-primary view_data" />
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <!-- <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#serverDev">View Server Detail</button> -->
                                        <input type="button" name="view" value="Server Development Detail" id="{{ $dev_applications->label_development }}" class="btn btn-primary view_data" />
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
                                        <select class="form-control input dynamic" data-dependent="pic" name="dev_by" id="vendor_id" disabled="disabled">
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
                                        <select class="form-control input" name="pic" id="pic" disabled="disabled">
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
                                        {!! Form::text('application_database', old('application_database'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'application_database', 'disabled' => 'disbaled']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Implementation Year*', ['class' => 'control-label']) !!}
                                        {!! Form::text('implementation_year', old('implementation_year'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'implementation_year', 'disabled' => 'disbaled']) !!}
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
                                        <select class="form-control" name="source_code" disabled="disabled">
                                            <option value="{{$dev_applications->source_code}}">{{$dev_applications->source_code}}</option>
                                            <option value="YES">YES</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Maintenance*', ['class' => 'control-label']) !!}
                                        <select class="form-control" name="isMaintenance" disabled="disabled">
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

        <div id="dataModal" class="modal fade">  
            <div class="modal-dialog">  
               <div class="modal-content">  
                    <div class="modal-header">  
                         <button type="button" class="close" data-dismiss="modal">&times;</button>  
                         <h4 class="modal-title">Server Detail</h4>  
                    </div>
                    <div class="modal-body" id="serverDetail">  
                    </div>
                    <div class="modal-footer">  
                         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                    </div>  
               </div>  
            </div>  
        </div> 

    </div>

    <div>
        <a class="btn btn-danger" href="{{ route('dev.applications.index') }}"> Back</a>
    </div>
    {!! Form::close() !!}
@stop


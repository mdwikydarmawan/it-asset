@extends('layouts.app')

@section('content')
    <h3 class="page-title">Detail</h3>

    {!! Form::model($dev_applications_enhacement, ['method' => 'PUT', 'route' => ['dev.applications_enhancement.update', $dev_applications_enhacement->id]]) !!}

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
                                {!! Form::label('name', 'Title*', ['class' => 'control-label']) !!}
                                {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'CR Number*', ['class' => 'control-label']) !!}
                                {!! Form::text('cr_number', old('cr_number'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
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
                                {!! Form::label('3', 'Application Name*', ['class' => 'control-label']) !!}
                                <!-- {!! Form::text('application_name', old('application_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!} -->
                                <select class="form-control" name="application_id" disabled="disabled">
                                    @foreach($detail_application as $data)
                                      <option value="{{$data->id}}">{{$data->application_name}} - {{$data->vendor_name}}</option>
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
                                {!! Form::label('date', 'Request Date*', ['class' => 'control-label']) !!}
                                <div class="form-group input-group date">
                                    {!! Form::text('request_date', old('request_date'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('date', 'Submit Date*', ['class' => 'control-label']) !!}
                                <div class="form-group input-group date">
                                    {!! Form::text('submit_date', old('submit_date'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('date', 'Live Date*', ['class' => 'control-label']) !!}
                                <div class="form-group input-group date">
                                    {!! Form::text('live_date', old('live_date'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
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
                                {!! Form::label('name', 'User Owner*', ['class' => 'control-label']) !!}
                                {!! Form::text('user_owner', old('user_owner'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
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
                                {!! Form::label('name', 'Detail*', ['class' => 'control-label']) !!}
                                {!! Form::textarea('application_information', old('application_information'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
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
                                {!! Form::label('name', 'PIC*', ['class' => 'control-label']) !!}
                                <select class="form-control" name="pic" disabled="disabled">
                                    @foreach($detail_pic as $data)
                                        @if($data->pic_name == '')
                                            <option value="">--Choose--</option>
                                        @else
                                            <option value="{{$data->pic}}">{{$data->pic_name}} - {{$data->vendor_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

    </div>

    <div>
        <a class="btn btn-danger" href="{{ route('dev.applications_enhancement.index') }}"> Back</a>
    </div>
    {!! Form::close() !!}
@stop


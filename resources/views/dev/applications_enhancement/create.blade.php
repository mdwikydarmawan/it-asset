@extends('layouts.app')

@section('content')
    <h3 class="page-title">Add New Application</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['dev.applications_enhancement.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Title*', ['class' => 'control-label']) !!}
                                {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'CR Number*', ['class' => 'control-label']) !!}
                                {!! Form::text('cr_number', old('cr_number'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
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
                                <select class="form-control" name="application_id">
                                    <option value="">--Choose--</option>
                                    @foreach($dev_applications as $data)
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
                                    {!! Form::text('request_date', old('request_date'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '']) !!}
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('date', 'Submit Date', ['class' => 'control-label']) !!}
                                <div class="form-group input-group date">
                                    {!! Form::text('submit_date', old('submit_date'), ['class' => 'form-control datepicker', 'placeholder' => '']) !!}
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('date', 'Live Date', ['class' => 'control-label']) !!}
                                <div class="form-group input-group date">
                                    {!! Form::text('live_date', old('live_date'), ['class' => 'form-control datepicker', 'placeholder' => '']) !!}
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
                                {!! Form::text('user_owner', old('user_owner'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
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
                                {!! Form::textarea('application_information', old('application_information'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
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
                                <select class="form-control" name="pic">
                                    <option value="">--Choose--</option>
                                    @foreach($pic as $data)
                                        <option value="{{$data->id}}">{{$data->pic_name}} - {{$data->vendor_name}}</option>
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
        {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-primary']) !!}
        <a class="btn btn-danger" href="{{ route('dev.applications_enhancement.index') }}"> Back</a>
    </div>

    {!! Form::close() !!}
@stop


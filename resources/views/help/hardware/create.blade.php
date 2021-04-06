@extends('layouts.app')

@section('content')
    <h3 class="page-title">Add New Hardware</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['helpdesk.hardware.store']]) !!}

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
                                {!! Form::label('3', 'Hardware Name*', ['class' => 'control-label']) !!}
                                <select class="form-control" name="hardware_id" required>
                                    <option value="">--Choose--</option>
                                    @foreach($param_hardware as $data)
                                      <option value="{{$data->id}}">{{$data->param_hardware_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Hardware Total*', ['class' => 'control-label']) !!}
                                {!! Form::text('hardware_total', old('hardware_total'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
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
                                {!! Form::textarea('hardware_information', old('hardware_information'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
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


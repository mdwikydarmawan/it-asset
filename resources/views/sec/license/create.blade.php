@extends('layouts.app')

@section('content')
    <h3 class="page-title">License</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['sec.license.store']]) !!}

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
                                {!! Form::label('name', 'Vendor*', ['class' => 'control-label']) !!}
                                <select class="form-control input" name="vendor_id" id="vendor_id" required>
                                    <option value="">--Choose--</option>
                                    @foreach($param_vendor as $data)
                                      <option value="{{$data->id}}">{{$data->vendor_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6 form-group">
                            {!! Form::label('name', 'Purchase Date*', ['class' => 'control-label']) !!}
                            {!! Form::text('purchase_date', old('purchase_date'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '']) !!}
                        </div>
                    </div>
                </div>                
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'License Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('license_name', old('license_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Renewal?*', ['class' => 'control-label']) !!}
                    <select class="form-control input" name="renual" id="isRenual" onchange="isRenualFunction()" required>
                        <option value="">--Choose--</option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Expired Date*', ['class' => 'control-label']) !!}
                    {!! Form::text('license_expired_date', old('license_expired_date'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'id' => 'license_expired_date']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'License information*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('license_information', old('license_information'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


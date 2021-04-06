@extends('layouts.app')

@section('content')
    <h3 class="page-title">Detail</h3>

    {!! Form::model($sec_license, ['method' => 'PUT', 'route' => ['sec.license.update', $sec_license->id]]) !!}

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
                                {!! Form::label('name', 'Vendor*', ['class' => 'control-label']) !!}
                                <select class="form-control input" name="vendor_id" id="vendor_id" disabled="disabled">                                    
                                    <option value="{{$sec_license->vendor_id}}">{{$sec_license->vendor_name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6 form-group">
                            {!! Form::label('name', 'Purchase Date*', ['class' => 'control-label']) !!}
                            {!! Form::text('purchase_date', old('purchase_date'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                        </div>
                    </div>
                </div>                
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'License Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('license_name', old('license_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Renewal?*', ['class' => 'control-label']) !!}
                    <select class="form-control input" name="renual" id="isRenual" onchange="isRenualFunction()" disabled="disabled">
                        <option value="{{$sec_license->renual}}">{{$sec_license->renual}}</option>
                    </select>
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Expired Date', ['class' => 'control-label']) !!}
                    {!! Form::text('license_expired_date', old('license_expired_date'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'id' => 'license_expired_date', 'disabled' => 'disabled']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'License information*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('license_information', old('license_information'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'license_information', 'disabled' => 'disabled']) !!}
                </div>
            </div>
        </div>
    </div>

    <div>
        <a class="btn btn-danger" href="{{ route('sec.license.index') }}"> Back</a>
    </div>
    {!! Form::close() !!}
@stop


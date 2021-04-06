@extends('layouts.app')

@section('content')
    <h3 class="page-title">Details Vendor</h3>
    
    {!! Form::model($param_vendor, ['method' => 'PUT', 'route' => ['ba.vendors_non_app.update', $param_vendor->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Vendor Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('vendor_name', old('vendor_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    {!! Form::label('name', 'Vendor Telephone*', ['class' => 'control-label']) !!}
                    {!! Form::text('vendor_telephone', old('vendor_telephone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    {!! Form::label('name', 'Vendor Address*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('vendor_address', old('vendor_address'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    {!! Form::label('name', 'Information (PIC & No HP PIC)*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('vendor_information', old('vendor_information'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'vendor_information']) !!}
                    {!! Form::label('name', 'Maintenance*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="isMaintenance" required>
                        @if($param_vendor->isMaintenance != "")
                        <option value="{{$param_vendor->isMaintenance}}">{{$param_vendor->isMaintenance}}</option>
                        @else
                        <option value="">--Choose--</option>
                        @endif
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                    </select> 
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


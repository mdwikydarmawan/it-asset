@extends('layouts.app')

@section('content')
    <h3 class="page-title">Detail</h3>

    {!! Form::model($param_vendor, ['method' => 'PUT', 'route' => ['ba.vendors_non_app.update', $param_vendor->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Vendor Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('vendor_name', old('vendor_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                    {!! Form::label('name', 'Vendor Telephone*', ['class' => 'control-label']) !!}
                    {!! Form::text('vendor_telephone', old('vendor_telephone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                    {!! Form::label('name', 'Vendor Address*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('vendor_address', old('vendor_address'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                    {!! Form::label('name', 'Information (PIC & No HP PIC)*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('vendor_information', old('vendor_information'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                    {!! Form::label('name', 'Maintenance*', ['class' => 'control-label']) !!}
                    {!! Form::text('isMaintenance', old('isMaintenance'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}

                </div>
            </div>
            
        </div>
    </div>

    <div>
        <a class="btn btn-danger" href="{{ route('ba.vendors_non_app.index') }}"> Back</a>
    </div>
    {!! Form::close() !!}
@stop


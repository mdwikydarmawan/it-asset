@extends('layouts.app')

@section('content')
    <h3 class="page-title">Add New Vendor</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['param.vendor.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Vendor Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('vendor_name', old('vendor_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'vendor_name']) !!}
                    {!! Form::label('name', 'Vendor Telephone*', ['class' => 'control-label']) !!}
                    {!! Form::text('vendor_telephone', old('vendor_telephone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'vendor_telephone']) !!}
                    {!! Form::label('name', 'Vender Address*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('vendor_address', old('vendor_address'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'vendor_address']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger', 'name' => 'btnVendor']) !!}
    {!! Form::close() !!}
@stop


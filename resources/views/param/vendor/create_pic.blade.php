@extends('layouts.app')

@section('content')
    
    {!! Form::open(['method' => 'POST', 'route' => ['param.vendor.store', $id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Vendor ID*', ['class' => 'control-label']) !!}
                    <input type="text" class="form-control" placeholder="Subject" value="{{ $id }}" name="vendor_id" required readonly="readonly" />
                    {!! Form::label('name', 'PIC Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('pic_name', old('pic_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'pic_name']) !!}
                    {!! Form::label('name', 'PIC Telephone*', ['class' => 'control-label']) !!}
                    {!! Form::text('pic_telephone', old('pic_telephone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'pic_telephone']) !!}
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

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-primary', 'name' => 'btnPIC']) !!}
    {!! Form::close() !!}
@stop


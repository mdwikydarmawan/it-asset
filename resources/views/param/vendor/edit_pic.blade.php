@extends('layouts.app')

@section('content')
    <h3 class="page-title">Details PIC</h3>
    
    {!! Form::model($param_pic, ['method' => 'PUT', 'route' => ['param.vendor.update', $param_pic->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Vendor ID*', ['class' => 'control-label']) !!}
                    <input type="text" class="form-control" placeholder="Subject" value="{{ $param_pic->vendor_id }}" name="vendor_id" required readonly="readonly" />
                    {!! Form::label('name', 'PIC Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('pic_name', old('pic_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    {!! Form::label('name', 'PIC Telephone*', ['class' => 'control-label']) !!}
                    {!! Form::text('pic_telephone', old('pic_telephone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger', 'name' => 'btnEditPIC']) !!}
    {!! Form::close() !!}
@stop


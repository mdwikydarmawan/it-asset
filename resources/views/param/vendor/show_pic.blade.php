@extends('layouts.app')

@section('content')
    <h3 class="page-title">Detail</h3>

    {!! Form::model($param_pic, ['method' => 'PUT', 'route' => ['param.pic.update', $param_pic->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'PIC Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('pic_name', old('pic_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                    {!! Form::label('name', 'PIC Telephone*', ['class' => 'control-label']) !!}
                    {!! Form::text('pic_telephone', old('pic_telephone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                </div>
            </div>
            
        </div>
    </div>

    <div>
        <a class="btn btn-danger" href="{{ route('param.vendor.show', $param_pic->vendor_id) }}"> Back</a>
    </div>
    {!! Form::close() !!}
@stop
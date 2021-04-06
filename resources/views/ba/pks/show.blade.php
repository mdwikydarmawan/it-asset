@extends('layouts.app')

@section('content')
    <h3 class="page-title">Detail</h3>

    {!! Form::model($ba_pks, ['method' => 'PUT', 'route' => ['ba.pks.update', $ba_pks->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

       <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Vendor Name*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="vendor_id" disabled="disabled">
                        @if($ba_pks->vendor_id != "")
                            <option value="{{ $ba_pks->vendor_id}}">{{$ba_pks->vendor_name}}</option>
                        @endif
                    </select>
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'PKS Type*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="pks_type_id" disabled="disabled">
                        @if($ba_pks->pks_id != "")
                            <option value="{{ $ba_pks->pks_id}}">{{$ba_pks->pks_type}}</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'PKS Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('pks_name', old('pks_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'PKS Number*', ['class' => 'control-label']) !!}
                    {!! Form::text('pks_number', old('pks_number'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'PKS Start Date*', ['class' => 'control-label']) !!}
                    {!! Form::text('pks_date_start', old('pks_date_start'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'PKS End Date*', ['class' => 'control-label']) !!}
                    {!! Form::text('pks_date_end', old('pks_date_end'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'PKS Date*', ['class' => 'control-label']) !!}
                    {!! Form::text('pks_date', old('pks_date'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Fee*', ['class' => 'control-label']) !!}
                    {!! Form::text('fee', old('fee'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Status*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="status" disabled="disabled">
                        @if($ba_pks->status != "")
                            <option value="{{ $ba_pks->status_id}}">{{$ba_pks->status_name}}</option>
                        @endif
                    </select>
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Hardcopy*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="isHardCopy" disabled="disabled">
                        @if($ba_pks->isHardCopy != "")
                            <option value="{{ $ba_pks->isHardCopy}}">{{$ba_pks->isHardCopy}}</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div>
        <a class="btn btn-danger" href="{{ route('ba.pks.index') }}"> Back</a>
    </div>
    {!! Form::close() !!}
@stop


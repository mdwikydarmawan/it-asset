@extends('layouts.app')

@section('content')
    <h3 class="page-title">Detail</h3>

    {!! Form::model($otherBilling, ['method' => 'PUT', 'route' => ['billpayment.billpayment.update', $otherBilling->id]]) !!}

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
                                {!! Form::label('name', 'Bill & Payment Name*', ['class' => 'control-label']) !!}
                                {!! Form::text('bill_title', old('bill_title'), ['class' => 'form-control', 'placeholder' => '', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Invoice Number*', ['class' => 'control-label']) !!}
                                {!! Form::text('bill_no', old('bill_no'), ['class' => 'form-control', 'placeholder' => '', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Invoice Date*', ['class' => 'control-label']) !!}
                                {!! Form::text('bill_date', old('bill_date'), ['class' => 'form-control datepicker', 'placeholder' => '', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Via GA?*', ['class' => 'control-label']) !!}
                                <select class="form-control input" name="isGA" id="isGA" disabled="disabled">
                                    <option value="{{$otherBilling->isGA}}">{{$otherBilling->isGA}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Vendor Name*', ['class' => 'control-label']) !!}
                                <select class="form-control" name="vendor_id" id="vendor_id" disabled="disabled">
                                    <option value="{{$otherBilling->vendor_id}}">{{$otherBilling->vendor_name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Nominal*', ['class' => 'control-label']) !!}
                                {!! Form::text('nominal', old('nominal'), ['class' => 'form-control', 'placeholder' => '', 'disabled' => 'disabled']) !!}
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
                                {!! Form::label('name', 'Bill & Payment Information*', ['class' => 'control-label']) !!}
                                {!! Form::textarea('information', old('information'), ['class' => 'form-control', 'placeholder' => '', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Created By', ['class' => 'control-label']) !!}
                                {!! Form::text('created_by', old('created_by'), ['class' => 'form-control', 'placeholder' => '', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Created At', ['class' => 'control-label']) !!}
                                {!! Form::text('created_at', old('created_at'), ['class' => 'form-control', 'placeholder' => '', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

    </div>

    <div>
        <a class="btn btn-danger" href="{{ route('billpayment.billpayment.index') }}"> Back</a>
    </div>
    {!! Form::close() !!}
@stop


@extends('layouts.app')

@section('content')
    <h3 class="page-title">Detail</h3>

    {!! Form::model($otherBilling, ['method' => 'PUT', 'route' => ['ba.billpayment.update', $otherBilling->id]]) !!}

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
                                {!! Form::label('name', 'Bill & Payment Name*', ['class' => 'control-label']) !!}
                                {!! Form::text('bill_title', old('bill_title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Via GA?*', ['class' => 'control-label']) !!}
                                <select class="form-control input" name="isGA" id="isGA" disabled="disabled" onchange="isGAfunction()">
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
                                {!! Form::label('name', 'Nominal', ['class' => 'control-label']) !!}
                                {!! Form::text('nominal', old('nominal'), ['class' => 'form-control', 'placeholder' => '', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($otherBilling->isGA == 'NO')
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        {!! Form::label('name', 'Payment Type*', ['class' => 'control-label']) !!}
                        <select class="form-control" name="payment_type" id="payment_type" required onchange="isPaymentTypeBillFunction()" disabled="disabled">
                            @if($otherBilling->payment_type != '')
                                <option value="{{$otherBilling->payment_type}}">{{$otherBilling->payment_type}}</option>
                            @else
                                <option value="">--Choose--</option>
                            @endif
                            <option value="Full Payment">Full Payment</option>
                            <option value="Down Payment">Down Payment</option>
                        </select>
                    </div>
                </div>
            </div>
            @if($otherBilling->payment_type == "Full Payment")
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Invoice Date*', ['class' => 'control-label']) !!}
                                {!! Form::text('bill_date', old('bill_date'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'id' => 'bill_date', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Invoice Number*', ['class' => 'control-label']) !!}
                                {!! Form::text('bill_no', old('bill_no'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'bill_no', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Paid?*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="isPayment" id="isPayment" required onchange="isPaymentBillFunction()" disabled="disabled">
                        <option value="">{{$otherBilling->isPayment}}</option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        {!! Form::label('name', 'Payment Date', ['class' => 'control-label']) !!}
                        {!! Form::text('payment_date', old('payment_date'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'id' => 'payment_date', 'disabled' => 'disabled']) !!}
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Payment Date (Term 1)*', ['class' => 'control-label']) !!}
                                {!! Form::text('p_date_1', old('p_date_1'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'id' => 'p_date_1', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Nominal (Term 1)*', ['class' => 'control-label']) !!}
                                {!! Form::text('nominal_1', old('nominal_1'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'nominal_1', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Note (Term 1)*', ['class' => 'control-label']) !!}
                                {!! Form::text('note_1', old('note_1'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'note_1', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Payment Date (Term 2)', ['class' => 'control-label']) !!}
                                {!! Form::text('p_date_2', old('p_date_2'), ['class' => 'form-control datepicker', 'placeholder' => '', 'id' => 'p_date_2', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Nominal (Term 2)', ['class' => 'control-label']) !!}
                                {!! Form::text('nominal_2', old('nominal_2'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'nominal_2', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Note (Term 2)', ['class' => 'control-label']) !!}
                                {!! Form::text('note_2', old('note_2'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'note_2', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Payment Date (Term 3)', ['class' => 'control-label']) !!}
                                {!! Form::text('p_date_3', old('p_date_3'), ['class' => 'form-control datepicker', 'placeholder' => '', 'id' => 'p_date_3', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Nominal (Term 3)', ['class' => 'control-label']) !!}
                                {!! Form::text('nominal_3', old('nominal_3'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'nominal_3', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Note (Term 3)', ['class' => 'control-label']) !!}
                                {!! Form::text('note_3', old('note_3'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'note_3', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Payment Date (Term 4)', ['class' => 'control-label']) !!}
                                {!! Form::text('p_date_4', old('p_date_4'), ['class' => 'form-control datepicker', 'placeholder' => '', 'id' => 'p_date_4', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Nominal (Term 4)', ['class' => 'control-label']) !!}
                                {!! Form::text('nominal_4', old('nominal_4'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'nominal_4', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Note (Term 4)', ['class' => 'control-label']) !!}
                                {!! Form::text('note_4', old('note_4'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'note_4', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Payment Date (Term 5)', ['class' => 'control-label']) !!}
                                {!! Form::text('p_date_5', old('p_date_5'), ['class' => 'form-control datepicker', 'placeholder' => '', 'id' => 'p_date_5', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Nominal (Term 5)', ['class' => 'control-label']) !!}
                                {!! Form::text('nominal_5', old('nominal_5'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'nominal_5', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Note (Term 5)', ['class' => 'control-label']) !!}
                                {!! Form::text('note_5', old('note_5'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'note_5', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                {!! Form::label('name', 'Bill & Payment Information*', ['class' => 'control-label']) !!}
                                {!! Form::textarea('information', old('information'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <a class="btn btn-danger" href="{{ route('ba.billpayment.index') }}"> Back</a>
    </div>
    {!! Form::close() !!}
@stop


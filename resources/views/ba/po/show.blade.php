@extends('layouts.app')

@section('content')
    <h3 class="page-title">Detail</h3>

    {!! Form::model($ba_po, ['method' => 'PUT', 'route' => ['ba.po.update', $ba_po->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'PO Title*', ['class' => 'control-label']) !!}
                    {!! Form::text('po_title', old('po_title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Nominal*', ['class' => 'control-label']) !!}
                    {!! Form::text('nominal', old('nominal'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                </div>                
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'PO Number*', ['class' => 'control-label']) !!}
                    {!! Form::text('po_no', old('po_no'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'PO Date*', ['class' => 'control-label']) !!}
                    {!! Form::text('po_date', old('po_date'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Vendor Name*', ['class' => 'control-label']) !!}
                                <select class="form-control input" name="vendor_id" id="vendor_id" disabled="disabled">
                                    <option value="{{$ba_po->vendor_id}}">{{$ba_po->vendor_name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'PIC', ['class' => 'control-label']) !!}
                                {!! Form::text('pic', old('pic'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Quotation Date*', ['class' => 'control-label']) !!}
                    {!! Form::text('quotation_date', old('quotation_date'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Quotation Number*', ['class' => 'control-label']) !!}
                    {!! Form::text('quotation_no', old('quotation_no'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Is PKS?*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="isPKS" id="isPKS" disabled="disabled">
                        <option value="{{$ba_po->isPKS}}">{{$ba_po->isPKS}}</option>
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        {!! Form::label('name', 'PKS No', ['class' => 'control-label']) !!}
                        <select class="form-control input" name="pks_id" id="pks_id" disabled="disabled">
                            @if($ba_po->pks_number != '')
                                <option value="{{$ba_po->pks_id}}">{{$ba_po->pks_number}}</option>
                            @else
                                <option value="">--Choose--</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        {!! Form::label('name', 'Payment Type*', ['class' => 'control-label']) !!}
                        <select class="form-control" name="payment_type" id="payment_type" disabled="disabled">
                            @if($ba_po->payment_type != '')
                                <option value="{{$ba_po->payment_type}}">{{$ba_po->payment_type}}</option>
                            @else
                                <option value="">--Choose--</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            @if($ba_po->payment_type == "Full Payment")
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Paid?*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="isPayment" id="isPayment" disabled="disabled">
                        @if($ba_po->isPayment != '')
                            <option value="{{$ba_po->isPayment}}">{{$ba_po->isPayment}}</option>
                        @else
                            <option value="">--Choose--</option>
                        @endif
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
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Is Payment (Term 1)?*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="isPayment1" id="isPayment1" disabled="disabled">
                        @if($ba_po->isPayment1 != '')
                            <option value="{{$ba_po->isPayment1}}">{{$ba_po->isPayment1}}</option>
                        @else
                            <option value="">--Choose--</option>
                        @endif
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        {!! Form::label('name', 'Payment Date (Term 1)', ['class' => 'control-label']) !!}
                        {!! Form::text('payment_date_1', old('payment_date_1'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'id' => 'payment_date_1', 'disabled' => 'disabled']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Is Payment (Term 2)?', ['class' => 'control-label']) !!}
                    <select class="form-control" name="isPayment2" id="isPayment2" disabled="disabled">
                        @if($ba_po->isPayment2 != '')
                            <option value="{{$ba_po->isPayment2}}">{{$ba_po->isPayment2}}</option>
                        @else
                            <option value="">--Choose--</option>
                        @endif
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        {!! Form::label('name', 'Payment Date (Term 2)', ['class' => 'control-label']) !!}
                        {!! Form::text('payment_date_2', old('payment_date_2'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'id' => 'payment_date_2', 'disabled' => 'disabled']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Is Payment (Term 3)?', ['class' => 'control-label']) !!}
                    <select class="form-control" name="isPayment3" id="isPayment3" disabled="disabled">
                        @if($ba_po->isPayment3 != '')
                            <option value="{{$ba_po->isPayment3}}">{{$ba_po->isPayment3}}</option>
                        @else
                            <option value="">--Choose--</option>
                        @endif
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        {!! Form::label('name', 'Payment Date (Term 3)', ['class' => 'control-label']) !!}
                        {!! Form::text('payment_date_3', old('payment_date_3'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'id' => 'payment_date_3', 'disabled' => 'disabled']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Is Payment (Term 4)?', ['class' => 'control-label']) !!}
                    <select class="form-control" name="isPayment4" id="isPayment4" disabled="disabled">
                        @if($ba_po->isPayment4 != '')
                            <option value="{{$ba_po->isPayment4}}">{{$ba_po->isPayment4}}</option>
                        @else
                            <option value="">--Choose--</option>
                        @endif
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        {!! Form::label('name', 'Payment Date (Term 4)', ['class' => 'control-label']) !!}
                        {!! Form::text('payment_date_4', old('payment_date_4'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'id' => 'payment_date_4', 'disabled' => 'disabled']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Is Payment (Term 5)?', ['class' => 'control-label']) !!}
                    <select class="form-control" name="isPayment5" id="isPayment5" disabled="disabled">
                        @if($ba_po->isPayment5 != '')
                            <option value="{{$ba_po->isPayment5}}">{{$ba_po->isPayment5}}</option>
                        @else
                            <option value="">--Choose--</option>
                        @endif
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        {!! Form::label('name', 'Payment Date (Term 5)', ['class' => 'control-label']) !!}
                        {!! Form::text('payment_date_5', old('payment_date_5'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'id' => 'payment_date_5', 'disabled' => 'disabled']) !!}
                    </div>
                </div>
            </div>
            @endif
            
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    {!! Form::label('name', 'Payment Status*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="payment_status" id="payment_status" disabled="disabled">
                        @if($ba_po->payment_status != '')
                            <option value="{{$ba_po->payment_status}}">{{$ba_po->status_name}}</option>
                        @else
                            <option value="">--Choose--</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        {!! Form::label('name', 'Requirement*', ['class' => 'control-label']) !!}
                        {!! Form::textarea('requirement', old('requirement'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div>
        <a class="btn btn-danger" href="{{ route('ba.po.index') }}"> Back</a>
    </div>
    {!! Form::close() !!}
@stop


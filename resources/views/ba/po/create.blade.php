@extends('layouts.app')

@section('content')
    <h3 class="page-title">Create PO</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['ba.po.store'], 'files' => true]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'PO Title*', ['class' => 'control-label']) !!}
                    {!! Form::text('po_title', old('po_title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Nominal*', ['class' => 'control-label']) !!}
                    {!! Form::text('nominal', old('nominal'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'PO Number*', ['class' => 'control-label']) !!}
                    {!! Form::text('po_no', old('po_no'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'PO Date*', ['class' => 'control-label']) !!}
                    {!! Form::text('po_date', old('po_date'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Vendor Name*', ['class' => 'control-label']) !!}
                                <select class="form-control input dynamics" data-dependent="pks_id" name="vendor_id" id="vendor_id" required>
                                    <option value="">--Choose--</option>
                                    @foreach($param_vendor as $data)
                                      <option value="{{$data->id}}">{{$data->vendor_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'PIC', ['class' => 'control-label']) !!}
                                {!! Form::text('pic', old('pic'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Quotation Date*', ['class' => 'control-label']) !!}
                    {!! Form::text('quotation_date', old('quotation_date'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '']) !!}
                </div>                
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Quotation Number*', ['class' => 'control-label']) !!}
                    {!! Form::text('quotation_no', old('quotation_no'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Is PKS?*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="isPKS" id="isPKS" required onchange="isPKSfunction()">
                        <option value="">--Choose--</option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        {!! Form::label('name', 'PKS No', ['class' => 'control-label']) !!}
                        <select class="form-control input" name="pks_id" id="pks_id">
                            <option value="">--Choose--</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        {!! Form::label('name', 'Payment Type*', ['class' => 'control-label']) !!}
                        <select class="form-control" name="payment_type" id="payment_type" required onchange="isPaymentTypeFunction()">
                            <option value="">--Choose--</option>
                            <option value="Full Payment">Full Payment</option>
                            <option value="Down Payment">Down Payment</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Paid?*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="isPayment" id="isPayment" required onchange="isPaymentFunction()">
                        <option value="">--Choose--</option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        {!! Form::label('name', 'Payment Date', ['class' => 'control-label']) !!}
                        {!! Form::text('payment_date', old('payment_date'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'id' => 'payment_date']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Paid (Term 1)?*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="isPayment1" id="isPayment1" required onchange="isPayment1Function()">
                        <option value="">--Choose--</option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        {!! Form::label('name', 'Payment Date (Term 1)', ['class' => 'control-label']) !!}
                        {!! Form::text('payment_date_1', old('payment_date_1'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'id' => 'payment_date_1']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Paid (Term 2)?', ['class' => 'control-label']) !!}
                    <select class="form-control" name="isPayment2" id="isPayment2" onchange="isPayment2Function()">
                        <option value="">--Choose--</option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        {!! Form::label('name', 'Payment Date (Term 2)', ['class' => 'control-label']) !!}
                        {!! Form::text('payment_date_2', old('payment_date_2'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'id' => 'payment_date_2']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Paid (Term 3)?', ['class' => 'control-label']) !!}
                    <select class="form-control" name="isPayment3" id="isPayment3" onchange="isPayment3Function()">
                        <option value="">--Choose--</option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        {!! Form::label('name', 'Payment Date (Term 3)', ['class' => 'control-label']) !!}
                        {!! Form::text('payment_date_3', old('payment_date_3'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'id' => 'payment_date_3']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Paid (Term 4)?', ['class' => 'control-label']) !!}
                    <select class="form-control" name="isPayment4" id="isPayment4" onchange="isPayment4Function()">
                        <option value="">--Choose--</option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        {!! Form::label('name', 'Payment Date (Term 4)', ['class' => 'control-label']) !!}
                        {!! Form::text('payment_date_4', old('payment_date_4'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'id' => 'payment_date_4']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Paid (Term 5)?', ['class' => 'control-label']) !!}
                    <select class="form-control" name="isPayment5" id="isPayment5" onchange="isPayment5Function()">
                        <option value="">--Choose--</option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        {!! Form::label('name', 'Payment Date (Term 5)', ['class' => 'control-label']) !!}
                        {!! Form::text('payment_date_5', old('payment_date_5'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'id' => 'payment_date_5']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label for="">File</label>
                        <input class="form-control" type="file" name="file">
                        <p class="text-danger">{{ $errors->first('file') }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    {!! Form::label('name', 'Payment Status*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="payment_status" id="payment_status" required>
                        <option value="">--Choose--</option>
                        @foreach($param_status as $data)
                          <option value="{{$data->id}}">{{$data->status_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        {!! Form::label('name', 'Requirement*', ['class' => 'control-label']) !!}
                        {!! Form::textarea('requirement', old('requirement'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


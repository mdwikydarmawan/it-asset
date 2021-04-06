@extends('layouts.app')

@section('content')
    <h3 class="page-title">Add Bill & Payment</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['ba.billpayment.store'], 'files' => true]) !!}

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
                                {!! Form::text('bill_title', old('bill_title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Via GA?*', ['class' => 'control-label']) !!}
                                <select class="form-control input" name="isGA" id="isGA" required onchange="isGAfunction()">
                                    <option value="">--Choose--</option>
                                    <option value="YES">YES</option>
                                    <option value="NO">NO</option>
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
                                <select class="form-control" name="vendor_id" id="vendor_id" required>
                                    <option value="">--Choose--</option>
                                    @foreach($param_vendor as $data)
                                      <option value="{{$data->id}}">{{$data->vendor_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Nominal', ['class' => 'control-label']) !!}
                                {!! Form::text('nominal', old('nominal'), ['class' => 'form-control', 'placeholder' => '']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        {!! Form::label('name', 'Payment Type*', ['class' => 'control-label']) !!}
                        <select class="form-control" name="payment_type" id="payment_type" required onchange="isPaymentTypeBillFunction()">
                            <option value="">--Choose--</option>
                            <option value="Full Payment">Full Payment</option>
                            <option value="Down Payment">Down Payment</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Invoice Date*', ['class' => 'control-label']) !!}
                                {!! Form::text('bill_date', old('bill_date'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'id' => 'bill_date']) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Invoice Number*', ['class' => 'control-label']) !!}
                                {!! Form::text('bill_no', old('bill_no'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'bill_no']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Paid?*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="isPayment" id="isPayment" required onchange="isPaymentBillFunction()">
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
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                {!! Form::label('name', 'Payment Date (Term 1)*', ['class' => 'control-label']) !!}
                                {!! Form::text('p_date_1', old('p_date_1'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'id' => 'p_date_1']) !!}
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                {!! Form::label('name', 'Nominal (Term 1)*', ['class' => 'control-label']) !!}
                                {!! Form::text('nominal_1', old('nominal_1'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'nominal_1']) !!}
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                {!! Form::label('name', 'Invoice Date (Term 1)*', ['class' => 'control-label']) !!}
                                {!! Form::text('bill_date_1', old('bill_date_1'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '', 'id' => 'bill_date_1']) !!}
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                {!! Form::label('name', 'Invoice Number (Term 1)*', ['class' => 'control-label']) !!}
                                {!! Form::text('bill_no_1', old('bill_no_1'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'bill_no_1']) !!}
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Note (Term 1)*', ['class' => 'control-label']) !!}
                                {!! Form::text('note_1', old('note_1'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'note_1']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                {!! Form::label('name', 'Payment Date (Term 2)', ['class' => 'control-label']) !!}
                                {!! Form::text('p_date_2', old('p_date_2'), ['class' => 'form-control datepicker', 'placeholder' => '', 'id' => 'p_date_2']) !!}
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                {!! Form::label('name', 'Nominal (Term 2)', ['class' => 'control-label']) !!}
                                {!! Form::text('nominal_2', old('nominal_2'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'nominal_2']) !!}
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                {!! Form::label('name', 'Invoice Date (Term 2)', ['class' => 'control-label']) !!}
                                {!! Form::text('bill_date_2', old('bill_date_2'), ['class' => 'form-control datepicker', 'placeholder' => '', 'id' => 'bill_date_2']) !!}
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                {!! Form::label('name', 'Invoice Number (Term 2)', ['class' => 'control-label']) !!}
                                {!! Form::text('bill_no_2', old('bill_no_2'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'bill_no_2']) !!}
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Note (Term 2)', ['class' => 'control-label']) !!}
                                {!! Form::text('note_2', old('note_2'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'note_2']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                {!! Form::label('name', 'Payment Date (Term 3)', ['class' => 'control-label']) !!}
                                {!! Form::text('p_date_3', old('p_date_3'), ['class' => 'form-control datepicker', 'placeholder' => '', 'id' => 'p_date_3']) !!}
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                {!! Form::label('name', 'Nominal (Term 3)', ['class' => 'control-label']) !!}
                                {!! Form::text('nominal_3', old('nominal_3'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'nominal_3']) !!}
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                {!! Form::label('name', 'Invoice Date (Term 3)', ['class' => 'control-label']) !!}
                                {!! Form::text('bill_date_3', old('bill_date_3'), ['class' => 'form-control datepicker', 'placeholder' => '', 'id' => 'bill_date_3']) !!}
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                {!! Form::label('name', 'Invoice Number (Term 3)', ['class' => 'control-label']) !!}
                                {!! Form::text('bill_no_3', old('bill_no_3'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'bill_no_3']) !!}
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Note (Term 3)', ['class' => 'control-label']) !!}
                                {!! Form::text('note_3', old('note_3'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'note_3']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                {!! Form::label('name', 'Payment Date (Term 4)', ['class' => 'control-label']) !!}
                                {!! Form::text('p_date_4', old('p_date_4'), ['class' => 'form-control datepicker', 'placeholder' => '', 'id' => 'p_date_4']) !!}
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                {!! Form::label('name', 'Nominal (Term 4)', ['class' => 'control-label']) !!}
                                {!! Form::text('nominal_4', old('nominal_4'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'nominal_4']) !!}
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                {!! Form::label('name', 'Invoice Date (Term 4)', ['class' => 'control-label']) !!}
                                {!! Form::text('bill_date_4', old('bill_date_4'), ['class' => 'form-control datepicker', 'placeholder' => '', 'id' => 'bill_date_4']) !!}
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                {!! Form::label('name', 'Invoice Number (Term 4)', ['class' => 'control-label']) !!}
                                {!! Form::text('bill_no_4', old('bill_no_4'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'bill_no_4']) !!}
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Note (Term 4)', ['class' => 'control-label']) !!}
                                {!! Form::text('note_4', old('note_4'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'note_4']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                {!! Form::label('name', 'Payment Date (Term 5)', ['class' => 'control-label']) !!}
                                {!! Form::text('p_date_5', old('p_date_5'), ['class' => 'form-control datepicker', 'placeholder' => '', 'id' => 'p_date_5']) !!}
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                {!! Form::label('name', 'Nominal (Term 5)', ['class' => 'control-label']) !!}
                                {!! Form::text('nominal_5', old('nominal_5'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'nominal_5']) !!}
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                {!! Form::label('name', 'Invoice Date (Term 5)', ['class' => 'control-label']) !!}
                                {!! Form::text('bill_date_5', old('bill_date_5'), ['class' => 'form-control datepicker', 'placeholder' => '', 'id' => 'bill_date_5']) !!}
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                {!! Form::label('name', 'Invoice Number (Term 5)', ['class' => 'control-label']) !!}
                                {!! Form::text('bill_no_5', old('bill_no_5'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'bill_no_5']) !!}
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Note (Term 5)', ['class' => 'control-label']) !!}
                                {!! Form::text('note_5', old('note_5'), ['class' => 'form-control', 'placeholder' => '', 'id' => 'note_5']) !!}
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
                                <label for="">File </label>
                                <input class="form-control" type="file" name="file">
                                <p class="text-danger">{{ $errors->first('file') }}</p>
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
                                {!! Form::textarea('information', old('information'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>          
    </div>
    
    <div>
        <a class="btn btn-danger" href="{{ route('ba.billpayment.index') }}"> Back</a>
        {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@stop


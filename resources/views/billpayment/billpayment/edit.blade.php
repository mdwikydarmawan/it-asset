@extends('layouts.app')

@section('content')
    <h3 class="page-title">Details Bill & Payment</h3>
    
    {!! Form::model($otherBilling, ['method' => 'PUT', 'route' => ['billpayment.billpayment.update', $otherBilling->id], 'files' => true]) !!}

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
                                {!! Form::label('name', 'Invoice Number*', ['class' => 'control-label']) !!}
                                {!! Form::text('bill_no', old('bill_no'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
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
                                {!! Form::text('bill_date', old('bill_date'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '']) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Via GA?*', ['class' => 'control-label']) !!}
                                <select class="form-control input" name="isGA" id="isGA" required>
                                    <option value="{{$otherBilling->isGA}}">{{$otherBilling->isGA}}</option>
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
                                    <option value="{{$otherBilling->vendor_id}}">{{$otherBilling->vendor_name}}</option>
                                    @foreach($param_vendor as $data)
                                      <option value="{{$data->id}}">{{$data->vendor_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Nominal*', ['class' => 'control-label']) !!}
                                {!! Form::text('nominal', old('nominal'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
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

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


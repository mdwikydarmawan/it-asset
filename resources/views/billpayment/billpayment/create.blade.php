@extends('layouts.app')

@section('content')
    <h3 class="page-title">Add Bill & Payment</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['billpayment.billpayment.store'], 'files' => true]) !!}

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
        </div>          
    </div>
    
    <div>
        <a class="btn btn-danger" href="{{ route('billpayment.billpayment.index') }}"> Back</a>
        {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@stop


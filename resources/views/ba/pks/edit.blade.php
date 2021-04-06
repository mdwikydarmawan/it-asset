@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.permissions.title')</h3>
    
    {!! Form::model($ba_pks, ['method' => 'PUT', 'route' => ['ba.pks.update', $ba_pks->id], 'files' => true]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Vendor Name*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="vendor_id" required>
                        @if($ba_pks->vendor_id != "")
                            <option value="{{ $ba_pks->vendor_id}}">{{$ba_pks->vendor_name}}</option>
                        @else
                            <option value="">--Choose--</option>
                        @endif
                        @foreach($param_vendor as $data)
                          <option value="{{$data->id}}">{{$data->vendor_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'PKS Type*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="pks_type_id" required>
                        @if($ba_pks->pks_id != "")
                            <option value="{{ $ba_pks->pks_id}}">{{$ba_pks->pks_type}}</option>
                        @else
                            <option value="">--Choose--</option>
                        @endif
                        @foreach($param_pks as $data)
                          <option value="{{$data->id}}">{{$data->pks_type}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'PKS Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('pks_name', old('pks_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'PKS Number*', ['class' => 'control-label']) !!}
                    {!! Form::text('pks_number', old('pks_number'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'PKS Start Date*', ['class' => 'control-label']) !!}
                    {!! Form::text('pks_date_start', old('pks_date_start'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '']) !!}
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'PKS End Date*', ['class' => 'control-label']) !!}
                    {!! Form::text('pks_date_end', old('pks_date_end'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'PKS Date*', ['class' => 'control-label']) !!}
                    {!! Form::text('pks_date', old('pks_date'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '']) !!}
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Fee*', ['class' => 'control-label']) !!}
                    {!! Form::text('fee', old('fee'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'id' => 'pks_fee', 'onkeypress' => 'return isNumber(event)']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Status*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="status" required>
                        @if($ba_pks->status != "")
                            <option value="{{ $ba_pks->status_id}}">{{$ba_pks->status_name}}</option>
                        @else
                            <option value="">--Choose--</option>
                        @endif
                        @foreach($param_status as $data)
                          <option value="{{$data->id}}">{{$data->status_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Hardcopy*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="isHardCopy" required>
                        @if($ba_pks->isHardCopy != "")
                            <option value="{{ $ba_pks->isHardCopy}}">{{$ba_pks->isHardCopy}}</option>
                        @else
                            <option value="">--Choose--</option>
                        @endif
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="">File 1</label>
                                <input class="form-control" type="file" name="file">
                                <p class="text-danger">{{ $errors->first('file') }}</p>
                            </div>    
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="">File 2</label>
                                <input class="form-control" type="file" name="file2">
                                <p class="text-danger">{{ $errors->first('file') }}</p>
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
                                <label for="">File 3</label>
                                <input class="form-control" type="file" name="file3">
                                <p class="text-danger">{{ $errors->first('file') }}</p>
                            </div>    
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="">File 4</label>
                                <input class="form-control" type="file" name="file4">
                                <p class="text-danger">{{ $errors->first('file') }}</p>
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


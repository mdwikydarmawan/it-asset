@extends('layouts.app')

@section('content')
    <h3 class="page-title">Add New PIC</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['param.pic.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Vendor Name*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="vendor_id">
                        <option value="">--Choose--</option>
                        @foreach($vendor_list as $data)
                          <option value="{{$data->id}}">{{$data->vendor_name}}</option>
                        @endforeach
                    </select>
                    {!! Form::label('name', 'PIC Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('pic_name', old('pic_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'pic_name']) !!}
                    {!! Form::label('name', 'PIC Telephone*', ['class' => 'control-label']) !!}
                    {!! Form::text('pic_telephone', old('pic_telephone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'pic_telephone']) !!}
                    {!! Form::label('name', 'PIC Name 2', ['class' => 'control-label']) !!}
                    {!! Form::text('pic_name_2', old('pic_name_2'), ['class' => 'form-control', 'placeholder' => '', 'name' => 'pic_name_2']) !!}
                    {!! Form::label('name', 'PIC Telephone 2', ['class' => 'control-label']) !!}
                    {!! Form::text('pic_telephone_2', old('pic_telephone_2'), ['class' => 'form-control', 'placeholder' => '', 'name' => 'pic_telephone_2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


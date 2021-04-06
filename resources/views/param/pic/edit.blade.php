@extends('layouts.app')

@section('content')
    <h3 class="page-title">Details PIC</h3>
    
    {!! Form::model($param_pic, ['method' => 'PUT', 'route' => ['param.pic.update', $param_pic->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Vendor Name*', ['class' => 'control-label']) !!}
                    <select class="form-control" name="vendor_id">
                        @foreach($param_detail as $data)
                          <option value="{{$data->id}}">{{$data->vendor_name}}</option>
                        @endforeach
                        @foreach($vendor_list as $data)
                          <option value="{{$data->id}}">{{$data->vendor_name}}</option>
                        @endforeach
                    </select>
                    {!! Form::label('name', 'PIC Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('pic_name', old('pic_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    {!! Form::label('name', 'PIC Telephone*', ['class' => 'control-label']) !!}
                    {!! Form::text('pic_telephone', old('pic_telephone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    {!! Form::label('name', 'PIC Name 2', ['class' => 'control-label']) !!}
                    {!! Form::text('pic_name_2', old('pic_name_2'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    {!! Form::label('name', 'PIC Telephone 2', ['class' => 'control-label']) !!}
                    {!! Form::text('pic_telephone_2', old('pic_telephone_2'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


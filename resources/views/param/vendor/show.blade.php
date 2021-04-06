@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Detail</h3>

    {!! Form::model($param_vendor, ['method' => 'PUT', 'route' => ['param.vendor.update', $param_vendor->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Vendor Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('vendor_name', old('vendor_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                    {!! Form::label('name', 'Vendor Telephone*', ['class' => 'control-label']) !!}
                    {!! Form::text('vendor_telephone', old('vendor_telephone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                    {!! Form::label('name', 'Vendor Address*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('vendor_address', old('vendor_address'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'disabled' => 'disabled']) !!}
                </div>
            </div>
            
        </div>
    </div>

    <h3 class="page-title">PIC List</h3>
    <p>
        <a href="{{ route('param.vendor.pic',[$param_vendor->id]) }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>

    @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
      </div>
    @endif

    @if ($message = Session::get('error'))
      <div class="alert alert-error alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
      </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($param_pic) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">ID</th>
                        <th style="text-align:center;">PIC Name</th>
                        <th style="text-align:center;">PIC Telephone</th>
                        <th style="text-align:center;">Aksi</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($param_pic) > 0)
                        @foreach ($param_pic as $data)
                            <tr data-entry-id="{{ $data->id }}">
                                <td style="text-align:center;">{{ $loop->iteration }}</td>
                                <td style="text-align:center;">{{ $data->id }}</td>
                                <td style="text-align:center;">{{ $data->pic_name }}</td>
                                <td style="text-align:center;">{{ $data->pic_telephone }}</td>
                                <td>
                                    <a href="{{ route('param.vendor.edit_pic',[$data->vendor_id, $data->id]) }}" class="btn btn-xs btn-warning">@lang('global.app_edit')</a>
                                    <a href="{{ route('param.vendor.detail_pic',[$data->vendor_id, $data->id]) }}" class="btn btn-xs btn-info">Detail</a>
                                    <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')" href="{{route('param.vendor.destroy_pic',[$data->vendor_id, $data->id])}}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div>
        <a class="btn btn-danger" href="{{ route('param.vendor.index') }}"> Back</a>
    </div>
    {!! Form::close() !!}
@stop


@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">PIC List</h3>
    <p>
        <a href="{{ route('param.pic.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
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
                        <th style="text-align:center;">Vendor Name</th>
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
                                <td style="text-align:center;">{{ $data->vendor_name }}</td>
                                @if ($data->pic_name_2 != '')
                                <td style="text-align:center;">{{ $data->pic_name }}, {{ $data->pic_name_2 }}</td>
                                @else
                                <td style="text-align:center;">{{ $data->pic_name }}</td>
                                @endif
                                @if ($data->pic_telephone_2 != '')
                                <td style="text-align:center;">{{ $data->pic_telephone }}, {{ $data->pic_telephone_2 }}</td>
                                @else
                                <td style="text-align:center;">{{ $data->pic_telephone }}</td>
                                @endif
                                <td>
                                    <a href="{{ route('param.pic.edit',[$data->id]) }}" class="btn btn-xs btn-warning">@lang('global.app_edit')</a>
                                    <a href="{{ route('param.pic.show',[$data->id]) }}" class="btn btn-xs btn-info">@lang('global.app_view')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['param.pic.destroy', $data->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
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
@stop


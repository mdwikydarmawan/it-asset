@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">PKS List</h3>
    <p>
        <a href="{{ route('ba.pks.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
		<a href="{{ action('BA\BAPKSController@report') }}" class="btn btn-info">Report Excel</a>
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
            <table class="table table-bordered table-striped {{ count($ba_pks) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">Vendor Name</th>
                        <th style="text-align:center;">No. PKS</th>
                        <th style="text-align:center;">PKS Name</th>
                        <th style="text-align:center;">Status</th>                         
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($ba_pks) > 0)
                        @foreach ($ba_pks as $data)
                            <tr data-entry-id="{{ $data->id }}">
                                <td style="text-align:center;">{{ $loop->iteration }}</td>
                                <td style="text-align:center;">{{ $data->vendor_name }}</td>
                                <td style="text-align:center;">{{ $data->pks_number }}</td>
                                <td style="text-align:center;">{{ $data->pks_name }}</td>
                                <td style="text-align:center;">{{ $data->status_name }}</td>
                                <td>
                                    <a href="{{ route('ba.pks.edit',[$data->id]) }}" class="btn btn-xs btn-warning">@lang('global.app_edit')</a>
                                    <a href="{{ route('ba.pks.show',[$data->id]) }}" class="btn btn-xs btn-info">
                                    @lang('global.app_view')</a>
                                    @if ($data->isFile == 1)
                                    <a href="{{ action('BA\BAPKSController@export', $data->id) }}" class="btn btn-xs btn-success">Download</a>
                                    @endif
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['ba.pks.destroy', $data->id])) !!}
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


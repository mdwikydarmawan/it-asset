@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Bill & Payment List</h3>
    <p>
        <a href="{{ route('ba.billpayment.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
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
            <table class="table table-bordered table-striped {{ count($otherBilling) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">Bill & Payment Title</th>
                        <th style="text-align:center;">Invoice Number</th>
                        <th style="text-align:center;">Via General Asset</th>
                        <th style="text-align:center;">Vendor Name</th>
                        <th style="text-align:center;">Created By</th>
                        <th style="text-align:center;">Action</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($otherBilling) > 0)
                        @foreach ($otherBilling as $data)
                            <tr data-entry-id="{{ $data->id }}">                                
                                <td style="text-align:center;">{{ $loop->iteration }}</td>
                                <td style="text-align:center;">{{ $data->bill_title }}</td>
                                <td style="text-align:center;">{{ $data->bill_no }}</td>
                                <td style="text-align:center;">{{ $data->isGA }}</td>
                                <td style="text-align:center;">{{ $data->vendor_name }}</td>
                                <td style="text-align:center;">{{ $data->created_by }}</td>
                                <td>
                                    <a href="{{ route('ba.billpayment.edit',[$data->id]) }}" class="btn btn-xs btn-warning">@lang('global.app_edit')</a>
                                    <a href="{{ route('ba.billpayment.show',[$data->id]) }}" class="btn btn-xs btn-info">View</a>
                                    @if ($data->isFile == 1)
                                    <a href="{{ action('BA\BAPKSController@export', $data->id) }}" class="btn btn-xs btn-success">Download</a>
                                    @endif
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['ba.billpayment.destroy', $data->id])) !!}
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


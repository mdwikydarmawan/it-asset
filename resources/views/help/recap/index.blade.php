@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">IT Helpdesk App Recap List</h3>
    <p>
        <a href="{{ route('helpdesk.recap.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
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
            <table class="table table-bordered table-striped {{ count($helpdesk_recap) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">Periode</th>
                        <th style="text-align:center;">Recap Information</th>
                        <th style="text-align:center;">Action</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($helpdesk_recap) > 0)
                        @foreach ($helpdesk_recap as $data)
                            <tr data-entry-id="{{ $data->id }}">                                
                                <td style="text-align:center;">{{ $loop->iteration }}</td>
                                <td style="text-align:center;">{{ $data->periode_start }} - {{ $data->periode_end }}</td>
                                <td style="text-align:center;">{{ $data->recap_information }}</td>
                                <td>
                                    <a href="{{ route('helpdesk.recap.edit',[$data->id]) }}" class="btn btn-xs btn-warning">@lang('global.app_edit')</a>
                                    <a href="{{ action('Helpdesk\RecapsController@export', $data->id) }}" class="btn btn-xs btn-info">Download</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['helpdesk.recap.destroy', $data->id])) !!}
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


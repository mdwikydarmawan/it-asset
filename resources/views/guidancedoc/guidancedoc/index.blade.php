@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Guidance Document List</h3>
    <p>
        <a href="{{ route('guidancedoc.guidancedoc.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
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
            <table class="table table-bordered table-striped {{ count($guidanceDoc) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">Document Name</th>
                        <th style="text-align:center;">Document Function</th>
                        <th style="text-align:center;">Document Date Release</th>
                        <th style="text-align:center;">Uploaded By</th>
                        <th style="text-align:center;">Action</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($guidanceDoc) > 0)
                        @foreach ($guidanceDoc as $data)
                            <tr data-entry-id="{{ $data->id }}">                                
                                <td style="text-align:center;">{{ $loop->iteration }}</td>
                                <td style="text-align:center;">{{ $data->doc_name }}</td>
                                <td style="text-align:center;">{{ $data->doc_function }}</td>
                                <td style="text-align:center;">{{ $data->doc_date }}</td>
                                <td style="text-align:center;">{{ $data->uploaded_by }}</td>
                                <td>
                                    <a href="{{ route('guidancedoc.guidancedoc.edit',[$data->id]) }}" class="btn btn-xs btn-warning">@lang('global.app_edit')</a>
                                    <a href="{{ action('GuidanceDoc\GuidanceDocController@export', $data->id) }}" class="btn btn-xs btn-info">Download</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['guidancedoc.guidancedoc.destroy', $data->id])) !!}
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


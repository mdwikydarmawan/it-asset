@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">PKS Type List</h3>
    <p>
        <a href="{{ route('param.pkstype.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
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
            <table class="table table-bordered table-striped {{ count($param_pks) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">PKS Type</th>
                        <th style="text-align:center;">PKS Information</th>
                        <th style="text-align:center;">Action</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($param_pks) > 0)
                        @foreach ($param_pks as $data)
                            <tr data-entry-id="{{ $data->id }}">
                                <td style="text-align:center;">{{ $loop->iteration }}</td>
                                <td style="text-align:center;">{{ $data->pks_type }}</td>
                                <td style="text-align:center;">{{ $data->pks_type_information }}</td>
                                <td>
                                    <a href="{{ route('param.pkstype.edit',[$data->id]) }}" class="btn btn-xs btn-warning">@lang('global.app_edit')</a>
                                    <a href="{{ route('param.pkstype.show',[$data->id]) }}" class="btn btn-xs btn-info">@lang('global.app_view')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['param.pkstype.destroy', $data->id])) !!}
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


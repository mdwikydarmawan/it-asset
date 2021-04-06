@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.permissions.title')</h3>
    
    {!! Form::model($sec_branch, ['method' => 'PUT', 'route' => ['sec.branch.update', $sec_branch->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Branch Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('branch_name', old('branch_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'branch_name']) !!}
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Branch Code*', ['class' => 'control-label']) !!}
                    {!! Form::text('branch_code', old('branch_code'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'branch_code']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Branch Telkom IP*', ['class' => 'control-label']) !!}
                    {!! Form::text('branch_ip_telkom', old('branch_ip_telkom'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'branch_ip_telkom']) !!}
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Branch Lintasarta IP', ['class' => 'control-label']) !!}
                    {!! Form::text('branch_ip_lintas', old('branch_ip_lintas'), ['class' => 'form-control', 'placeholder' => '', 'name' => 'branch_ip_lintas']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Branch Indihome ID', ['class' => 'control-label']) !!}
                    {!! Form::text('branch_indihome_id', old('branch_indihome_id'), ['class' => 'form-control', 'placeholder' => '', 'name' => 'branch_indihome_id']) !!}
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Branch Telephone*', ['class' => 'control-label']) !!}
                    {!! Form::text('branch_telephone', old('branch_telephone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'branch_telephone']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Link Main*', ['class' => 'control-label']) !!}
                    {!! Form::text('link_main', old('link_main'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Bandwith Main*', ['class' => 'control-label']) !!}
                    {!! Form::text('bw_main', old('bw_main'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Link Second', ['class' => 'control-label']) !!}
                    {!! Form::text('link_second', old('link_second'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Bandwith Second', ['class' => 'control-label']) !!}
                    {!! Form::text('bw_second', old('bw_second'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Link Inet', ['class' => 'control-label']) !!}
                    {!! Form::text('link_inet', old('link_inet'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'Bandwith Inet', ['class' => 'control-label']) !!}
                    {!! Form::text('bw_inet', old('bw_inet'), ['class' => 'form-control', 'placeholder' => '']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Branch Address*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('branch_address', old('branch_address'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'name' => 'branch_address']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


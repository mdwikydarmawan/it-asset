@extends('layouts.app')

@section('content')
    <h3 class="page-title">Details Recap Server</h3>
    
    {!! Form::model($helpdesk_recap, ['method' => 'PUT', 'route' => ['helpdesk.recap.update', $helpdesk_recap->id], 'files' => true]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        <div class="panel-body">

            {{-- notifikasi form validasi --}}
            @if ($errors->has('file'))
            <div class="alert alert-error alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $errors->first('file') }}</strong>
            </div>
            @endif
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">                                
                            <div class="form-group">
                                <label for="">File (.xlsx)</label>
                                <input class="form-control" type="file" name="file" required="required">
                                <p class="text-danger">{{ $errors->first('file') }}</p>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>        
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('date', 'Start Date*', ['class' => 'control-label']) !!}
                                <div class="form-group input-group date">
                                    {!! Form::text('periode_start', old('periode_start'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '']) !!}
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('date', 'End Date*', ['class' => 'control-label']) !!}
                                <div class="form-group input-group date">
                                    {!! Form::text('periode_end', old('periode_end'), ['class' => 'form-control datepicker', 'placeholder' => '', 'required' => '']) !!}
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                {!! Form::label('name', 'Recap Information*', ['class' => 'control-label']) !!}
                                {!! Form::textarea('recap_information', old('recap_information'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>        
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop


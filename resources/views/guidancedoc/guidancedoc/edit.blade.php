@extends('layouts.app')

@section('content')
    <h3 class="page-title">Details Guidance Doc</h3>
    
    {!! Form::model($guidanceDoc, ['method' => 'PUT', 'route' => ['guidancedoc.guidancedoc.update', $guidanceDoc->id], 'files' => true]) !!}

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
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Document Name*', ['class' => 'control-label']) !!}
                                {!! Form::text('doc_name', old('doc_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">                          
                            <div class="form-group">
                                <label for="">File *</label>
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
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                {!! Form::label('name', 'Document Function*', ['class' => 'control-label']) !!}
                                {!! Form::textarea('doc_function', old('doc_function'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
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




@if (isset($data->id))
    @section('title', 'Update Staff')
@else
    @section('title', 'Add Staff')
@endif
@extends('layouts.master_dashboard')

@section('content')

<div class="content-wrapper">
    <div class="content-header row">
        
    </div>
    <div class="content-body">
        <section id="multiple-column-form">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ isset($data->id)? 'Update':'Add' }} Staff</h4>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success"><b>Success: </b>{{ Session::get('message') }}</div>
                            @endif
                            @if (Session::has('error_message'))
                                <div class="alert alert-danger"><b>Sorry: </b>{{ Session::get('error_message') }}</div>
                            @endif

                            @if (isset($data->id))
                                <form id="staff_form" class="form" action="{{ route('staff.update', $data->id) }}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                <input type="hidden" name="update_id" value="{{$data->id}}">
                            @else
                                <form id="staff_form" class="form" action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">
                            @endif
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="staff_title">Staff Title</label>
                                            <input value="{{old('staff_title', isset($data->staff_title)? $data->staff_title: '')}}" type="text" id="staff_title" class="form-control @error('staff_title') is-invalid @enderror" placeholder="Staff Title" name="staff_title">
                                            @error('staff_title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="staff_status">Status</label>
                                            <select class="form-control @error('staff_status') is-invalid @enderror" id="staff_status"  name="staff_status">
                                                @foreach (\Config::get('constants.statusDraftPublished') as $key => $item)
                                                    <option {{ old('staff_status') == $item || (isset($data->staff_status) && $data->staff_status == $item )? 'selected': '' }} value="{{ $item }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @error('staff_status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label for="staff_image">Staff Image</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text basic-addon">
                                                    <div class="display_images preview_staff_image">
                                                        @if (isset($data->staff_image) && !empty($data->staff_image))
                                                            <a data-fancybox="demo" data-src="{{ is_image_exist($data->staff_image) }}">
                                                                <img title="{{ $data->staff_title }}" src="{{ is_image_exist($data->staff_image) }}" height="100"></a>
                                                        @endif
                                                    </div>
                                                </span>
                                                </div>
                                            <input type="file" id="staff_image" data-img-val="preview_staff_image" class="form-control @error('staff_image') is-invalid @enderror" placeholder="Profile Image" name="staff_image">
                                            @error('staff_image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 col-12 mt-1">
                                        <div class="form-group">
                                            <label for="staff_description">Staff Description</label>
                                            <textarea name="staff_description" style="display:none" id="editorClone"></textarea>
                                            <div id="editor-container">{!! old('staff_description', isset($data->staff_description)? $data->staff_description: '') !!}</div>
                                            <div id="output-html" style="display:none">{!! old('staff_description', isset($data->staff_description)? $data->staff_description: '') !!}</div>
                                            <!-- <input value="{{old('staff_description', isset($data->staff_description)? $data->staff_description: '')}}" type="text" id="staff_description" class="form-control @error('staff_description') is-invalid @enderror" placeholder="Staff Description" name="staff_description"> -->
                                            @error('staff_description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">{{ isset($data->id)? 'Update':'Add' }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

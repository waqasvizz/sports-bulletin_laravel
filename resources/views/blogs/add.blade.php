

@if (isset($data->id))
    @section('title', 'Update Blog')
@else
    @section('title', 'Add Blog')
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
                            <h4 class="card-title">{{ isset($data->id)? 'Update':'Add' }} Blog</h4>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success"><b>Success: </b>{{ Session::get('message') }}</div>
                            @endif
                            @if (Session::has('error_message'))
                                <div class="alert alert-danger"><b>Sorry: </b>{{ Session::get('error_message') }}</div>
                            @endif

                            @if (isset($data->id))
                                <form id="blog_form" class="form" action="{{ route('blog.update', $data->id) }}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                <input type="hidden" name="update_id" value="{{$data->id}}">
                            @else
                                <form id="blog_form" class="form" action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                            @endif
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="blog_title">Blog Title</label>
                                            <input value="{{old('blog_title', isset($data->blog_title)? $data->blog_title: '')}}" type="text" id="blog_title" class="form-control @error('blog_title') is-invalid @enderror" placeholder="Blog Title" name="blog_title">
                                            @error('blog_title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="blog_status">Status</label>
                                            <select class="form-control @error('blog_status') is-invalid @enderror" id="blog_status"  name="blog_status">
                                                @foreach (\Config::get('constants.statusDraftPublished') as $key => $item)
                                                    <option {{ old('blog_status') == $item || (isset($data->blog_status) && $data->blog_status == $item )? 'selected': '' }} value="{{ $item }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @error('blog_status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label for="blog_image">Blog Image</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text basic-addon">
                                                    <div class="display_images preview_blog_image">
                                                        @if (isset($data->blog_image) && !empty($data->blog_image))
                                                            <a data-fancybox="demo" data-src="{{ is_image_exist($data->blog_image) }}">
                                                                <img title="{{ $data->blog_title }}" src="{{ is_image_exist($data->blog_image) }}" height="100"></a>
                                                        @endif
                                                    </div>
                                                </span>
                                                </div>
                                            <input type="file" id="blog_image" data-img-val="preview_blog_image" class="form-control @error('blog_image') is-invalid @enderror" placeholder="Profile Image" name="blog_image">
                                            @error('blog_image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="blog_description">Blog Description</label>
                                            <textarea name="blog_description" style="display:none" id="editorClone"></textarea>
                                            <div id="editor-container">{!! old('blog_description', isset($data->blog_description)? $data->blog_description: '') !!}</div>
                                            <div id="output-html" style="display:none">{!! old('blog_description', isset($data->blog_description)? $data->blog_description: '') !!}</div>
                                            <!-- <input value="{{old('blog_description', isset($data->blog_description)? $data->blog_description: '')}}" type="text" id="blog_description" class="form-control @error('blog_description') is-invalid @enderror" placeholder="Blog Description" name="blog_description"> -->
                                            @error('blog_description')
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

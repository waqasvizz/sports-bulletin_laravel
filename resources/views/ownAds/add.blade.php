

@if (isset($data->id))
    @section('title', 'Update OwnAd')
@else
    @section('title', 'Add OwnAd')
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
                            <h4 class="card-title">{{ isset($data->id)? 'Update':'Add' }} OwnAd</h4>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success"><b>Success: </b>{{ Session::get('message') }}</div>
                            @endif
                            @if (Session::has('error_message'))
                                <div class="alert alert-danger"><b>Sorry: </b>{{ Session::get('error_message') }}</div>
                            @endif

                            @if (isset($data->id))
                                <form id="ownAd_form" class="form" action="{{ route('ownAd.update', $data->id) }}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                <input type="hidden" name="update_id" value="{{$data->id}}">
                            @else
                                <form id="ownAd_form" class="form" action="{{ route('ownAd.store') }}" method="POST" enctype="multipart/form-data">
                            @endif
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="ownAd_title">OwnAd Title</label>
                                            <input value="{{old('ownAd_title', isset($data->ownAd_title)? $data->ownAd_title: '')}}" type="text" id="ownAd_title" class="form-control @error('ownAd_title') is-invalid @enderror" placeholder="OwnAd Title" name="ownAd_title">
                                            @error('ownAd_title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="ownAd_status">Status</label>
                                            <select class="form-control @error('ownAd_status') is-invalid @enderror" id="ownAd_status"  name="ownAd_status">
                                                @foreach (\Config::get('constants.statusDraftPublished') as $key => $item)
                                                    <option {{ old('ownAd_status') == $item || (isset($data->ownAd_status) && $data->ownAd_status == $item )? 'selected': '' }} value="{{ $item }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @error('ownAd_status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label for="ownAd_image">OwnAd Image</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text basic-addon">
                                                    <div class="display_images preview_ownAd_image">
                                                        @if (isset($data->ownAd_image) && !empty($data->ownAd_image))
                                                            <a data-fancybox="demo" data-src="{{ is_image_exist($data->ownAd_image) }}">
                                                                <img title="{{ $data->ownAd_title }}" src="{{ is_image_exist($data->ownAd_image) }}" height="100"></a>
                                                        @endif
                                                    </div>
                                                </span>
                                                </div>
                                            <input type="file" id="ownAd_image" data-img-val="preview_ownAd_image" class="form-control @error('ownAd_image') is-invalid @enderror" placeholder="Profile Image" name="ownAd_image">
                                            @error('ownAd_image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 col-12 mt-1">
                                        <div class="form-group">
                                            <label for="ownAd_description">OwnAd Description</label>
                                            <textarea name="ownAd_description" style="display:none" id="editorClone"></textarea>
                                            <div id="editor-container">{!! old('ownAd_description', isset($data->ownAd_description)? $data->ownAd_description: '') !!}</div>
                                            <div id="output-html" style="display:none">{!! old('ownAd_description', isset($data->ownAd_description)? $data->ownAd_description: '') !!}</div>
                                            <!-- <input value="{{old('ownAd_description', isset($data->ownAd_description)? $data->ownAd_description: '')}}" type="text" id="ownAd_description" class="form-control @error('ownAd_description') is-invalid @enderror" placeholder="OwnAd Description" name="ownAd_description"> -->
                                            @error('ownAd_description')
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

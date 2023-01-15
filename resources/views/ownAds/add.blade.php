

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
                                            <label for="own_ad_title">OwnAd Title</label>
                                            <input value="{{old('own_ad_title', isset($data->own_ad_title)? $data->own_ad_title: '')}}" type="text" id="own_ad_title" class="form-control @error('own_ad_title') is-invalid @enderror" placeholder="OwnAd Title" name="own_ad_title">
                                            @error('own_ad_title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="own_ad_status">Status</label>
                                            <select class="form-control @error('own_ad_status') is-invalid @enderror" id="own_ad_status"  name="own_ad_status">
                                                @foreach (\Config::get('constants.statusDraftPublished') as $key => $item)
                                                    <option {{ old('own_ad_status') == $item || (isset($data->own_ad_status) && $data->own_ad_status == $item )? 'selected': '' }} value="{{ $item }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @error('own_ad_status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label for="own_ad_image">OwnAd Image</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text basic-addon">
                                                    <div class="display_images preview_own_ad_image">
                                                        @if (isset($data->own_ad_image) && !empty($data->own_ad_image))
                                                            <a data-fancybox="demo" data-src="{{ is_image_exist($data->own_ad_image) }}">
                                                                <img title="{{ $data->own_ad_title }}" src="{{ is_image_exist($data->own_ad_image) }}" height="100"></a>
                                                        @endif
                                                    </div>
                                                </span>
                                                </div>
                                            <input type="file" id="own_ad_image" data-img-val="preview_own_ad_image" class="form-control @error('own_ad_image') is-invalid @enderror" placeholder="Profile Image" name="own_ad_image">
                                            @error('own_ad_image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 col-12 mt-1">
                                        <div class="form-group">
                                            <label for="own_ad_description">OwnAd Description</label>

                                            <textarea id="own_ad_description" class="form-control @error('own_ad_description') is-invalid @enderror" placeholder="OwnAd Description" name="own_ad_description">{{old('own_ad_description', isset($data->own_ad_description)? $data->own_ad_description: '')}}</textarea>
                                            @error('own_ad_description')
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

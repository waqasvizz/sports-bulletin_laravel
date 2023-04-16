

@if (isset($data['news_detail']->id))
    @section('title', 'Update News')
@else
    @section('title', 'Add News')
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
                            <h4 class="card-title">{{ isset($data['news_detail']->id)? 'Update':'Add' }} News</h4>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success"><b>Success: </b>{{ Session::get('message') }}</div>
                            @endif
                            @if (Session::has('error_message'))
                                <div class="alert alert-danger"><b>Sorry: </b>{{ Session::get('error_message') }}</div>
                            @endif

                            @if (isset($data['news_detail']->id))
                                <form id="news_form" class="form" action="{{ route('news_content.update', $data['news_detail']->id) }}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                <input type="hidden" name="update_id" value="{{$data['news_detail']->id}}">
                            @else
                                <form id="news_form" class="form" action="{{ route('news_content.store') }}" method="POST" enctype="multipart/form-data">
                            @endif
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="category">Select Category</label>
                                            <select class="form-control @error('category') is-invalid @enderror" name="category" id="category">
                                                <option value="">Choose an option</option>
                                                @if (isset($data['categories']) && count($data['categories'])>0)
                                                    @foreach ($data['categories'] as $key => $item)
                                                        <option {{ (isset($data['news_detail']->categories_id) && $data['news_detail']->categories_id == $item->id)? 'selected': '' }} value="{{ $item->id }}">{{ $item->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('category')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="sub_category">Select Sub Category</label>
                                            <select class="form-control @error('sub_category') is-invalid @enderror" name="sub_category" id="sub_category">
                                                <option value="">Choose an option</option>
                                                @if (isset($data['sub_categories']) && count($data['sub_categories'])>0)
                                                    @foreach ($data['sub_categories'] as $key => $item)
                                                        <option {{ (isset($data['news_detail']->sub_categories_id) && $data['news_detail']->sub_categories_id == $item->id)? 'selected': '' }} value="{{ $item->id }}">{{ $item->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('sub_category')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="news_title">News Title</label>
                                            <input value="{{old('news_title', isset($data['news_detail']->title)? $data['news_detail']->title: '')}}" type="text" id="news_title" class="form-control @error('news_title') is-invalid @enderror" placeholder="News Title" name="news_title">
                                            @error('news_title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="status">News Status</label>
                                            <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                                @if ( isset($data['news_status_const']) && count($data['news_status_const']) > 0 )
                                                    @foreach ($data['news_status_const'] as $key => $item)
                                                        <option {{ old('status') == $item || (isset($data['news_detail']->status) && $data['news_detail']->status == $item )? 'selected': '' }} value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="news_date">News Date</label>
                                            <input value="{{old('news_date', isset($data['news_detail']->news_date)? $data['news_detail']->news_date: '')}}" type="date" id="news_date" class="form-control @error('news_date') is-invalid @enderror" name="news_date">
                                            @error('news_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-12">
                                        <label for="news_image">News Image</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text basic-addon">
                                                    <div class="display_images preview_news_image">
                                                        @if (isset($data['news_detail']->image_path) && !empty($data['news_detail']->image_path))
                                                            <a data-fancybox="demo" data-src="{{ is_image_exist($data['news_detail']->image_path) }}"><img title="{{ $data['news_detail']->name }}" src="{{ is_image_exist($data['news_detail']->image_path) }}" height="100"></a>
                                                        @endif
                                                    </div>
                                                </span>
                                                </div>
                                            <input type="file" id="news_image" data-img-val="preview_news_image" class="form-control @error('news_image') is-invalid @enderror" placeholder="Profile Image" name="news_image">
                                            @error('news_image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="news_description">News Description</label>
                                            <textarea name="news_description" class="form-control @error('news_description') is-invalid @enderror" style="display:none" id="editorClone"></textarea>
                                            <div id="editor-container">{!! old('news_description', isset($data['news_detail']->news_description)? $data['news_detail']->news_description: '') !!}</div>
                                            <div id="output-html" style="display:none">{!! old('news_description', isset($data['news_detail']->news_description)? $data['news_detail']->news_description: '') !!}</div>
                                            @error('news_description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    


                                </div>   
                                <br>
                                <br>
                                <br>
                                <br>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">{{ isset($data['news_detail']->id)? 'Update':'Add' }}</button>
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

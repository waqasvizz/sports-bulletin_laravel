

@if (isset($data->id))
    @section('title', 'Update Menu')
@else
    @section('title', 'Add Menu')
@endif
@extends('layouts.admin')

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
                            <h4 class="card-title">{{ isset($data->id)? 'Update':'Add' }} Menu</h4>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success"><b>Success: </b>{{ Session::get('message') }}</div>
                            @endif
                            @if (Session::has('error_message'))
                                <div class="alert alert-danger"><b>Sorry: </b>{{ Session::get('error_message') }}</div>
                            @endif

                            @if (isset($data->id))
                                <form class="form" action="{{ route('menu.update', $data->id) }}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                <input type="hidden" name="update_id" value="{{$data->id}}">
                            @else
                                <form class="form" action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                            @endif
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first_name">Menu Title</label>
                                            <input value="{{old('title', isset($data->title)? $data->title: '')}}" type="text" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Menu Title" name="title">
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first_name">Menu URL</label>
                                            <input value="{{old('url', isset($data->url)? $data->url: '')}}" type="text" id="url" class="form-control @error('url') is-invalid @enderror" placeholder="Menu URL" name="url">
                                            @error('url')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    @if (isset($data->id))
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first_name">Menu Slug</label>
                                            <input value="{{old('slug', isset($data->slug)? $data->slug: '')}}" type="text" id="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="Menu Slug" name="slug">
                                            @error('slug')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="ordering">Sort Order</label>
                                            <select class="form-control @error('ordering') is-invalid @enderror" name="ordering" id="ordering">
                                                <option value="">Choose an option</option>
                                                @if (isset($data['sort_order']) && count($data['all_opts'])>0)
                                                    @foreach ($data['all_opts'] as $item)
                                                        <option {{ old('all_opts') == $item || (isset($data->sort_order) && $data->sort_order == $item)? 'selected': '' }} value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('ordering')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    @endif

                                </div>                                                                
                                <div class="row">

                                    @if (isset($data->id))
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                                                <option value="">Choose an option</option>
                                                @if ( isset($data['status']) && count($data['statuses']) > 0 )
                                                    @foreach ($data['statuses'] as $key => $item)
                                                        <option {{ old('status') == $item || (isset($data->status) && $data->status == $item )? 'selected': '' }} value="{{ $item }}">{{ $item }}</option>
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
                                    @endif

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="asset_type">Icon Type</label>
                                            <select class="form-control @error('asset_type') is-invalid @enderror asset_type" name="asset_type">
                                                <option value="0">Choose an option</option>
                                                @if ( isset($data['asset_types']) && count($data['asset_types']) > 0 )
                                                    @foreach ($data['asset_types'] as $key => $item)
                                                        <option {{ old('asset_type') == $item || (isset($data->asset_type) && $data->asset_type == $item )? 'selected': '' }} value="{{ $item }}">{{ $item }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('asset_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-6 col-12 icon_div" style="display: {{ old('asset_type') == 'Icon' ? 'block' : 'none' }};">
                                        <div class="form-group">
                                            <label for="first_name">Icon</label>
                                            <input value="{{old('icon', isset($data->icon)? $data->icon: '')}}" type="text" id="icon" class="form-control @error('icon') is-invalid @enderror" placeholder="Icon Name" name="icon">
                                            @error('icon')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 image_div mb-1" style="display: {{ old('asset_type') == 'Image' ? 'block' : 'none' }};">
                                        <label for="image">Image</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text basic-addon">
                                                    <div class="display_images">
                                                        @if (isset($data->image) && !empty($data->image))
                                                        <a data-fancybox="demo" data-src="{{ is_image_exist($data->image) }}"><img title="{{ $data->name }}" src="{{ is_image_exist($data->image) }}" height="100"></a>
                                                        @endif
                                                    </div>
                                                </span>
                                            </div>
                                            <input type="file" id="image" data-img-val="" class="form-control @error('image') is-invalid @enderror" placeholder="Profile Image" name="image">
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    

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

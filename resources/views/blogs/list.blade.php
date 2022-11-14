@section('title', 'Blog List')
@extends('layouts.master_dashboard')

@section('content')

<div class="content-wrapper">
    <div class="content-header row">

    </div>
    <div class="content-body">

        <!-- Select2 Start  -->
        <section class="basic-select2">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Filter Blog</h4>
                        </div>
                        
                        <div class="card-body">
                            <form method="GET" id="filterForm" action="{{ url('/blog') }}">
                                @csrf
                                <input name="page" id="filterPage" value="1" type="hidden">
                                <div class="row">
                                    <div class="col-md-6 mb-1">
                                        
                                        <label class="form-label" for="select2-basic">Status</label>
                                        <select class="filterForm select2 form-select" name="blog_status" id="select2-account-menu-status">
                                            <option value=""> ---- Choose Status ---- </option>
                                            @foreach (App\Models\Blog::statusConst as $key => $item)
                                                <option {{ old('blog_status') == $item || (isset($data->blog_status) && $data->blog_status == $item )? 'selected': '' }} value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
    
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Select2 End -->
        
        @if (Session::has('message'))
        <div class="alert alert-success"><b>Success: </b>{{ Session::get('message') }}</div>
        @endif
        @if (Session::has('error_message'))
        <div class="alert alert-danger"><b>Sorry: </b>{{ Session::get('error_message') }}</div>
        @endif

        <div id="table_data">
            {{ $data['html'] }}
        </div>

    </div>
</div>

@endsection
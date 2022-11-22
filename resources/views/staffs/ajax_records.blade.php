<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Sr #</th>
                <th>Image</th>
                <th>Title</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($data['records']) && count($data['records'])>0)

                @php $any_staff_found = false; @endphp
                @foreach ($data['records'] as $key=>$item)
                    @php
                        $sr_no = $key + 1;
                        if ($data['records']->currentPage()>1) {
                            $sr_no = ($data['records']->currentPage()-1)*$data['records']->perPage();
                            $sr_no = $sr_no + $key + 1;
                        }
                    @endphp
                    <tr>
                        <td>{{ $sr_no }}</td>
                        <td>
                            <div class="display_images_list">
                                <span class="avatar-color">
                                    <a data-fancybox="demo" data-src="{{ is_image_exist($item['staff_image']) }}">
                                        <img title="{{ $item['staff_title'] }}" src="{{ is_image_exist($item['staff_image']) }}" height="100">
                                    </a>
                                </span>                            
                            </div>
                        </td>
                        <td>{{ $item['staff_title'] }}</td>
                        <td><span class="role-badge" style="background-color: {{ $item['staff_status'] == 'Published'? '#455356':'#b4b5af' }}">{{ $item['staff_status'] }}</span></td>
                        <td>
                            @canany(['staff-edit', 'staff-delete'])
                            <div class="dropdown">
                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-toggle="dropdown">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="12" cy="5" r="1"></circle>
                                        <circle cx="12" cy="19" r="1"></circle>
                                    </svg>
                                </button>
                                @php $any_staff_found = true; @endphp
                                <div class="dropdown-menu">
                                    @can('staff-edit')
                                    <a class="dropdown-item" href="{{ url('staff')}}/{{$item['id']}}/edit" >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-50">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                        </svg>
                                        <span>Edit</span>
                                    </a>
                                    @endcan

                                    @can('staff-delete')
                                    <form action="{{ url('staff/'.$item['id']) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button class="dropdown-item" id="delButton" type="submit" style="width: 100%">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash mr-50">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                            <span>Delete</span>

                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </div>
                            @endcanany
                            @if (!$any_staff_found)
                                {{ 'Not Available' }}
                            @endif
                        </td>
                    </tr>
                @endforeach

            @endif
        </tbody>
    </table>
    
    <div class="pagination_links">
        @if (isset($data['records']) && count($data['records'])>0)
            {{ $data['records']->links('vendor.pagination.bootstrap-4') }}
        @else
            <div class="alert alert-primary">Don't have records!</div>
        @endif
    </div>

</div>
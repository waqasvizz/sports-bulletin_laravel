<div class="row">
    {{--<div class="demo-inline-spacing">--}}
    @foreach( $data['permissions'] as $key => $perm_obj)
        <div class="col-md-3 col-12 mb-1">
            <div class="custom-control custom-control-primary custom-checkbox">
                <input type="checkbox" value="perm_id_{{$perm_obj->id}}" class="custom-control-input" name="perms[]" id="perm_id_{{$perm_obj->id}}" checked="">
                <label class="custom-control-label" for="perm_id_{{$perm_obj->id}}">{{$perm_obj->name}}</label>
            </div>
        </div>
    @endforeach

    <div class="col-12 mt-1">
        <button type="submit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">Save</button>
    </div>

</div>
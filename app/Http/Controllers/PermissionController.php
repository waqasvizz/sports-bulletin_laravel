<?php

   /**
    *  @author  DANISH HUSSAIN <danishhussain9525@hotmail.com>
    *  @link    Author Website: https://danishhussain.w3spaces.com/
    *  @link    Author LinkedIn: https://pk.linkedin.com/in/danish-hussain-285345123
    *  @since   2020-03-01
   **/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posted_data = array();
        $posted_data['orderBy_name'] = 'sort_order';
        $posted_data['orderBy_value'] = 'ASC';
        // $posted_data['paginate'] = 10;
        // $data['records'] = $this->PermissionObj->getPermissions($posted_data);

        // unset($posted_data['paginate']);
        // $data['permissions'] = $this->PermissionObj->all();

        // $data['statuses'] = $this->PermissionObj::Permission_Status_Constants;

        // return view('permission.list', compact('data'));
        return view('permission.list');
    }

    public function create()
    {
        // $data['asset_types'] = $this->PermissionObj::Permission_Asset_Type_Constants;
        // return view('permission.add', compact('data'));
        return view('permission.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $posted_data = $request->all();

        $rules = array(
            'title' => 'required',
        );

        $validator = \Validator::make($posted_data, $rules);

        if ($validator->fails()) {

            // echo "<pre>";
            // echo "0000"."<br>";
            // print_r($validator->errors());
            // echo "</pre>";
            // exit("@@@@");

            return redirect()->back()->withErrors($validator)->withInput();
            // ->withInput($request->except('password'));
        } else {

            $permissions_list = array();

            $slug = strtolower($posted_data['title']);
            $slug = preg_replace('/\s+/', '-', $slug);

            if( isset($posted_data['is_crud']) ) {
                $permissions_list[] = $slug."-create";
                $permissions_list[] = $slug."-list";
                $permissions_list[] = $slug."-update";
                $permissions_list[] = $slug."-delete";
            }
            else {
                $permissions_list[] = $slug;
            }

            $already_exist = false;

            foreach ($permissions_list as $permission) {

                $permission_detail = Permission::where('name', $permission)->first();
                if (!$permission_detail) {
                    Permission::create(['name' => $permission]);
                }
                else {
                    $already_exist = true;
                }
            }

            // echo "<pre>";
            // echo "0000"."<br>";
            // print_r($permissions_list);
            // echo "</pre>";
            // exit("@@@@");

            // $data = array();

            // $slug = strtolower($posted_data['title']);
            // $slug = preg_replace('/\s+/', '-', $slug);
            // $slug = $slug.'-permission';

            // $count = $this->PermissionObj->getPermissions(['count' => true]);
            // $data['title'] = $posted_data['title'];
            // $data['url'] = $posted_data['url'];
            // $data['slug'] = $slug;
            // $data['sort_order'] = ++$count;
            // $data['asset_type'] = $posted_data['asset_type'];
            // $data['asset_value'] = $posted_data['asset_value'];
           
            // $this->PermissionObj->saveUpdatePermission($data);

            if( !isset($posted_data['is_crud']) && $already_exist ) {

                \Session::flash('message', 'Permission already exist!');
            }
            else {
                \Session::flash('message', 'Permission created successfully!');
            }

            return redirect('/permission');
        }
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posted_data = array();
        $posted_data['id'] = $id;
        $posted_data['detail'] = true;
        $data = $this->PermissionObj->getPermissions($posted_data);
        
        $posted_data = array();
        $posted_data['count'] = true;
        $data['tot_permissions'] = $this->PermissionObj->getPermissions($posted_data);
        
        $arr = array();
        for ($i=1; $i <= $data['tot_permissions'] ; $i++) { 
            $arr[] = $i;
        }

        $data['all_opts'] = $arr;
        // $data['statuses'] = $this->PermissionObj::Permission_Status_Constants;
        // $data['asset_types'] = $this->PermissionObj::Permission_Asset_Type_Constants;

        return view('permission.add',compact('data'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $requested_data = $request->all();
   
        $validator = \Validator::make($requested_data, [
            'update_id' => 'required',
            'title' => 'required',
            'url' => 'required',
            'ordering' => 'required',
            'status' => 'required|in:Draft,Published',
            'asset_type' => 'required|in:Icon,Image',
            // 'asset_value' => 'required',
            // 'asset_value' => $requested_data['asset_type'] == 'Icon' ? 'required' : '',
        ]);
   
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();   
        }
        
        $posted_data = array();
        $posted_data['id'] = $requested_data['update_id'];
        $posted_data['detail'] = true;
        $update_rec = Permission::getPermissions($posted_data)->toArray();

        $base_url = public_path();
        if($request->file('asset_value')) {
            $extension = $request->asset_value->getClientOriginalExtension();
            if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){

                if (!is_null($update_rec['asset_value'])) {
                    $url = $base_url.'/'.$update_rec['asset_value'];
                    if (file_exists($url)) {
                        unlink($url);
                    }
                }   
                
                $file_name = time().'_'.$request->asset_value->getClientOriginalName();
                $file_path = $request->file('asset_value')->storeAs('other_images', $file_name, 'public');
                $requested_data['asset_value'] = $file_path;
            } else {
                return back()->withErrors([
                    'asset_value' => 'The image format is not correct you can only upload (jpg, jpeg, png).',
                ])->withInput();
            }
        }

        if ($update_rec) {
            if ($update_rec['sort_order'] != $requested_data['ordering']) {
                $posted_data = array();
                $posted_data['orderBy_name'] = 'sort_order';
                $posted_data['orderBy_value'] = 'ASC';
                $data_sources = Permission::getPermissions($posted_data)->toArray();
    
                $result_rec = swap_array_indexes($data_sources, 'sort_order', $update_rec['sort_order'], $requested_data['ordering']);
                $response = $this->update_sorting($result_rec);
            }
        }

        $update_rec = Permission::saveUpdatePermission($requested_data);

        \Session::flash('message', 'Permission updated successfully!');
        return redirect('/permission');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->PermissionObj->deletePermission($id);
        if($response) {
            \Session::flash('message', 'Permission deleted successfully!');
            return redirect('/permission');
        }
    }

    public function ajax_get_permissions(Request $request) {

        $posted_data = $request->all();
        $posted_data['paginate'] = 10;
        $data['records'] = $this->PermissionObj->getPermissions($posted_data);
        return view('permission.ajax_records', compact('data'));
    }

    public function update_sorting($posted_data = array())
    {
        if ( isset($posted_data['status']) && $posted_data['status'] ) {
            foreach ($posted_data as $key => $value) {
                if ($key === 'status') {}
                else {
                    $permission_obj = [];
                    $permission_obj = Permission::find($value['id']);
                    $permission_obj->sort_order = $value['sort_order'];
                    $permission_obj->save();
                }
            }
            return true;
        }
        else {
            return false;
        }
    }
}
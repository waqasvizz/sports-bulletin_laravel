<?php

   /**
    *  @author  DANISH HUSSAIN <danishhussain9525@hotmail.com>
    *  @link    Author Website: https://danishhussain.w3spaces.com/
    *  @link    Author LinkedIn: https://pk.linkedin.com/in/danish-hussain-285345123
    *  @since   2020-03-01
   **/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class AssignPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posted_data = array();
        // $posted_data['orderBy_name'] = 'sort_order';
        // $posted_data['orderBy_value'] = 'ASC';
        // $posted_data['paginate'] = 10;

        // $data['records'] = $this->AssignPermissionObj->getAssignPermissions($posted_data);

        // unset($posted_data['paginate']);
        // $data['permissions'] = $this->AssignPermissionObj->all();

        // $data['statuses'] = $this->AssignPermissionObj::AssignPermission_Status_Constants;

        // $data['permissions'] = $this->AssignPermissionObj->getAssignPermissions();

        $data['roles'] = $this->RoleObj->getRoles();
        $data['permissions'] = $this->PermissionObj->getPermissions([
            'paginate' => 10,
        ]);

        return view('assign_permission.list', compact('data'));
    }

    public function create()
    {
        // $data['asset_types'] = $this->AssignPermissionObj::AssignPermission_Asset_Type_Constants;
        // return view('assign_permission.add', compact('data'));

        $data['users'] = $this->UserObj->getUser();
        $data['records'] = $this->AssignPermissionObj->getAssignPermissions([
            'paginate' => 10,
        ]);

        return view('assign_permission.add', compact('data'));
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

        // echo "<pre>";
        //     echo "dee dee dee"."<br>";
        //     print_r($posted_data);
        //     echo "</pre>";
        //     exit("@@@@");

        if( isset($posted_data['role']) && $posted_data['role'] != '') {
            // $role = Role::where('name', $posted_data['role'])->get();
            $role = Role::findByName($posted_data['role']);

            // $res = $role->hasPermissionTo('update-menu');
            
            $role->givePermissionTo('edit articles');


            
            // App\Models\User
            // model_has_permissions

            // echo "<pre>";
            // echo "dee dee dee"."<br>";
            // print_r($res);
            // echo "</pre>";
            // exit("@@@@");
        }

        foreach ($posted_data['perms'] as $key => $permission) {

            $permission_id = substr($permission, strpos($permission, "id_") + 3);

            $permission_name = Permission::where('id', $permission_id)->pluck('name');
            // echo " ===> ".$permission_name."<br><br>";

            $permission_detail = DB::select('select * from model_has_permissions where model_type = ? AND permission_id = ?', ['App\Models\Role', $permission_id]);
            if (!$permission_detail) {
                echo "IFFF ID -- ".$permission_name[0]."<br><br>";
                $role->givePermissionTo($permission_name[0]);
                // AssignPermission::create(['name' => $permission]);
            }
            else {
                echo "FALSE ID -- ".$permission_id."<br><br>";
                // $already_exist = true;
            }
        }

        


        $rules = array(
            'name' => 'required',
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

            $slug = strtolower($posted_data['name']);
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

                $permission_detail = AssignPermission::where('name', $permission)->first();
                if (!$permission_detail) {
                    AssignPermission::create(['name' => $permission]);
                }
                else {
                    $already_exist = true;
                }
            }

            if( !isset($posted_data['is_crud']) && $already_exist )
                \Session::flash('message', 'Permission is already assigned!');
            else
                \Session::flash('message', 'Permission is assigned successfully!');

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
        // $data['records'] = AssignPermission::where('id', $id)->first();

        // $data['records'] = AssignPermission::paginate(10);
        
        // $posted_data = array();
        // $posted_data['count'] = true;
        // $data['tot_permissions'] = $this->AssignPermissionObj->getAssignPermissions($posted_data);
        
        // $arr = array();
        // for ($i=1; $i <= $data['tot_permissions'] ; $i++) { 
        //     $arr[] = $i;
        // }

        // $data['all_opts'] = $arr;
        // $data['statuses'] = $this->AssignPermissionObj::AssignPermission_Status_Constants;
        // $data['asset_types'] = $this->AssignPermissionObj::AssignPermission_Asset_Type_Constants;

        $data = $this->AssignPermissionObj->getAssignPermissions([
            'id' => $id,
            'detail' => true,
        ]);

        return view('assign_permission.add',compact('data'));
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
            'name' => 'required',
        ]);
   
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();   
        }

        $permission_name = strtolower($requested_data['name']);
        $permission_name = preg_replace('/\s+/', '-', $permission_name);

        $update_rec = $this->AssignPermissionObj->getAssignPermissions([
            'id' => $requested_data['update_id'],
            'detail' => true,
        ]);

        if ($update_rec) {

            $permission_detail = $this->AssignPermissionObj->getAssignPermissions([
                'name' => $permission_name,
                'detail' => true,
            ]);
    
            if($permission_detail && $permission_detail->id != $update_rec->id) {
                \Session::flash('error_message', 'Permission is already assigned!');
                return redirect('/permission');
            }
            else {
                $update_rec->name = $permission_name;
                $update_rec->save();
            }
            
            \Session::flash('message', 'Permission is updated successfully!');
            return redirect('/permission');
        }
        else {
            \Session::flash('error_message', 'Something went wrong during update!');
            return redirect('/permission');
        }
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->AssignPermissionObj->deleteAssignPermission($id);
        if($response) {
            \Session::flash('message', 'Permission deleted successfully!');
            return redirect('/permission');
        }
    }

    public function ajax_get_assign_permissions(Request $request) {
        $posted_data = $request->all();
        $params_data = array();
        $role = [];

        if( isset($posted_data['role']) && $posted_data['role'] != '') {
            $role = Role::where('name', $posted_data['role'])->get();
        }
    
        // $posted_data['paginate'] = 10;
        $data['permissions'] = Permission::all();

        echo "Line no @"."<br>";
        echo "<pre>";
        print_r($role);
        echo "</pre>";
        // exit("@@@@");
        
        // if ($role && $role->permissions->count() > 0) {
        //     $data['assing_permissions'] = $role->permissions->pluck('name');
        // }

        $data['records'] = [];
        return view('assign_permission.ajax_permissions', compact('data'));
    }

    public function update_sorting($posted_data = array())
    {
        if ( isset($posted_data['status']) && $posted_data['status'] ) {
            foreach ($posted_data as $key => $value) {
                if ($key === 'status') {}
                else {
                    $permission_obj = [];
                    $permission_obj = AssignPermission::find($value['id']);
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
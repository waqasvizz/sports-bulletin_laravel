<?php

   /**
    *  @author  DANISH HUSSAIN <danishhussain9525@hotmail.com>
    *  @link    Author Website: https://danishhussain.w3spaces.com/
    *  @link    Author LinkedIn: https://pk.linkedin.com/in/danish-hussain-285345123
    *  @since   2020-03-01
   **/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\SubMenu;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class SubMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posted_data = array();
        $posted_data['orderBy_name'] = 'menu_id';
        $posted_data['orderBy_value'] = 'ASC';
        $posted_data['paginate'] = 10;
        $data['records'] = $this->SubMenuObj->getSubMenus($posted_data)->toArray();

        unset($posted_data['paginate']);
        $data['menus'] = $this->MenuObj->all();

        $data['statuses'] = $this->SubMenuObj::SubMenu_Status_Constants;
        $data['asset_types'] = $this->SubMenuObj::SubMenu_Asset_Type_Constants;
    
        return view('sub_menus.list', compact('data'));
    }

    public function create()
    {
        $posted_data = array();
        $data['menus'] = $this->MenuObj->getMenus($posted_data);
        $data['asset_types'] = $this->SubMenuObj::SubMenu_Asset_Type_Constants;

        return view('sub_menus.add', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'title' => 'required',
            'menu' => 'required|exists:menus,id'
        );

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            // ->withInput($request->except('password'));
        } else {
            $posted_data = $request->all();
            $data = array();

            $count = $this->SubMenuObj->getSubMenus(['menu_id' => $posted_data['menu'], 'count' => true]);
            $data['title'] = $posted_data['title'];
            $data['menu_id'] = $posted_data['menu'];
            $data['sort_order'] = ++$count;
            // $data['status'] = $this->SubMenuObj::SubMenu_Constants['draft'];

            $base_url = public_path();
            if($request->file('image')) {
                $extension = $request->image->getClientOriginalExtension();
                if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
                    
                    $file_name = time().'_'.$request->image->getClientOriginalName();
                    $file_path = $request->file('image')->storeAs('other_images', $file_name, 'public');
                    $data['image'] = $file_path;
                } else {
                    return back()->withErrors([
                        'image' => 'The image format is not correct you can only upload (jpg, jpeg, png).',
                    ])->withInput();
                }
            }
            
            $this->SubMenuObj->saveUpdateSubMenu($data);

            \Session::flash('message', 'Sub Menu created successfully!');
            return redirect('/sub_menu');
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
        $data = $this->SubMenuObj->getSubMenus($posted_data);

        $data['menus'] = $this->MenuObj->all();
        
        $posted_data = array();
        $posted_data['count'] = true;
        $posted_data['menu_id'] = $data->menu_id;
        $posted_data['without_with'] = true;
        $data['tot_sub_menus'] = $this->SubMenuObj->getSubMenus($posted_data);
        
        $arr = array();
        for ($i=1; $i <= $data['tot_sub_menus'] ; $i++) { 
            $arr[] = $i;
        }

        $data['all_opts'] = $arr;
        $data['statuses'] = $this->SubMenuObj::SubMenu_Constants;

        return view('sub_menus.add',compact('data'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubMenu $menu)
    {
        $requested_data = $request->all();
   
        $validator = \Validator::make($requested_data, [
            'title' => 'required',
            'menu' => 'required|exists:menus,id',
            'status' => 'required|in:Draft,Published',
            'ordering' => 'required'
        ]);
   
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();   
        }

        $posted_data = array();
        $posted_data['without_with'] = true;
        $posted_data['menu_id'] = $requested_data['menu'];
        $posted_data['count'] = true;
        $sub_cat_count = $this->SubMenuObj->getSubMenus($posted_data);

        $posted_data = array();
        $posted_data['id'] = $requested_data['update_id'];
        $posted_data['detail'] = true;
        $update_rec = SubMenu::getSubMenus($posted_data)->toArray();

        if ($update_rec) {

            $posted_data = array();
            $posted_data['without_with'] = true;
            $posted_data['orderBy_name'] = 'sort_order';
            $posted_data['orderBy_value'] = 'ASC';
            $posted_data['menu_id'] = $update_rec['menu_id'];
            $data_sources = $this->SubMenuObj->getSubMenus($posted_data)->toArray();

            if ($update_rec['menu_id'] != $requested_data['menu']) {
                
                $result_rec = swap_array_indexes($data_sources, 'sort_order', $update_rec['sort_order'], 0);
                $response = $this->update_sorting($result_rec);
                
                $requested_data['sort_order'] = $sub_cat_count+1;
                unset($requested_data['ordering']);
            }
            else if ($update_rec['sort_order'] != $requested_data['ordering']) {

                $posted_data = array();
                $posted_data['without_with'] = true;
                $posted_data['menu_id'] = $requested_data['menu'];
                $posted_data['orderBy_name'] = 'sort_order';
                $posted_data['orderBy_value'] = 'ASC';
                $data_sources = $this->SubMenuObj->getSubMenus($posted_data)->toArray();

                $result_rec = swap_array_indexes($data_sources, 'sort_order', $update_rec['sort_order'], $requested_data['ordering']);
                $response = $this->update_sorting($result_rec);
            }
        }

        $base_url = public_path();
        if($request->file('image')) {
            $extension = $request->image->getClientOriginalExtension();
            if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){

                if (!is_null($update_rec['image'])) {
                    $url = $base_url.'/'.$update_rec['image'];
                    if (file_exists($url)) {
                        unlink($url);
                    }
                }   
                
                $file_name = time().'_'.$request->image->getClientOriginalName();
                $file_path = $request->file('image')->storeAs('other_images', $file_name, 'public');
                $requested_data['image'] = $file_path;
            } else {
                return back()->withErrors([
                    'image' => 'The image format is not correct you can only upload (jpg, jpeg, png).',
                ])->withInput();
            }
        }

        $requested_data['menu_id'] = $requested_data['menu'];
        unset($requested_data['menu']);

        $update_rec = $this->SubMenuObj->saveUpdateSubMenu($requested_data);

        \Session::flash('message', 'Sub Menu updated successfully!');
        return redirect('/sub_menu');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->SubMenuObj->deleteSubMenu($id);
        if($response) {
            \Session::flash('message', 'Sub Menu deleted successfully!');
            return redirect('/sub_menu');
        }
    }

    public function ajax_get_sub_menus(Request $request)
    {
        $posted_data = $request->all();
        $posted_data['paginate'] = 10;
        $data['records'] = $this->SubMenuObj->getSubMenus($posted_data);
        return view('sub_menus.ajax_records', compact('data'));
    }

    public function update_sorting($posted_data = array())
    {
        if ( isset($posted_data['status']) && $posted_data['status'] ) {
            foreach ($posted_data as $key => $value) {
                if ($key === 'status') {}
                else {
                    $menu_obj = [];
                    $menu_obj = SubMenu::find($value['id']);
                    $menu_obj->sort_order = $value['sort_order'];
                    $menu_obj->save();
                }
            }
            return true;
        }
        else {
            return false;
        }
    }
}
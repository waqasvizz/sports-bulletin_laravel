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
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class MenuController extends Controller
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
        $posted_data['paginate'] = 10;
        $data['records'] = $this->MenuObj->getMenus($posted_data);

        unset($posted_data['paginate']);
        $data['menus'] = $this->MenuObj->all();

        $data['statuses'] = $this->MenuObj::Menu_Status_Constants;

        return view('menu.list', compact('data'));
    }

    public function create()
    {
        $data['asset_types'] = $this->MenuObj::Menu_Asset_Type_Constants;
        return view('menu.add', compact('data'));
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
            'url' => 'required',
            'asset_type' => 'required|in:Icon,Image',
            'asset_value' => 'required',
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

            $data = array();

            $slug = strtolower($posted_data['title']);
            $slug = preg_replace('/\s+/', '-', $slug);
            $slug = $slug.'-menu';

            $count = $this->MenuObj->getMenus(['count' => true]);
            $data['title'] = $posted_data['title'];
            $data['url'] = $posted_data['url'];
            $data['slug'] = $slug;
            $data['sort_order'] = ++$count;
            $data['asset_type'] = $posted_data['asset_type'];
            $data['asset_value'] = $posted_data['asset_value'];

            $base_url = public_path();
            if( $request->file('asset_value') && $posted_data['asset_type'] == 'Image' ) {
                $extension = $request->asset_value->getClientOriginalExtension();
                if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
                    
                    $file_name = time().'_'.$request->asset_value->getClientOriginalName();
                    $file_path = $request->file('asset_value')->storeAs('other_images', $file_name, 'public');
                    $data['asset_value'] = $file_path;
                } else {
                    return back()->withErrors([
                        'asset_value' => 'The image format is not correct you can only upload (jpg, jpeg, png).',
                    ])->withInput();
                }
            }
           
            $this->MenuObj->saveUpdateMenu($data);

            \Session::flash('message', 'Menu created successfully!');
            return redirect('/menu');
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
        $data = $this->MenuObj->getMenus($posted_data);
        
        $posted_data = array();
        $posted_data['count'] = true;
        $data['tot_menus'] = $this->MenuObj->getMenus($posted_data);
        
        $arr = array();
        for ($i=1; $i <= $data['tot_menus'] ; $i++) { 
            $arr[] = $i;
        }

        $data['all_opts'] = $arr;
        $data['statuses'] = $this->MenuObj::Menu_Status_Constants;
        $data['asset_types'] = $this->MenuObj::Menu_Asset_Type_Constants;

        return view('menu.add',compact('data'));
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
        $update_rec = Menu::getMenus($posted_data)->toArray();

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
                $data_sources = Menu::getMenus($posted_data)->toArray();
    
                $result_rec = swap_array_indexes($data_sources, 'sort_order', $update_rec['sort_order'], $requested_data['ordering']);
                $response = $this->update_sorting($result_rec);
            }
        }

        $update_rec = Menu::saveUpdateMenu($requested_data);

        \Session::flash('message', 'Menu updated successfully!');
        return redirect('/menu');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->MenuObj->deleteMenu($id);
        if($response) {
            \Session::flash('message', 'Menu deleted successfully!');
            return redirect('/menu');
        }
    }

    public function ajax_get_menus(Request $request) {

        $posted_data = $request->all();
        $posted_data['paginate'] = 10;
        $data['records'] = $this->MenuObj->getMenus($posted_data);
        return view('menu.ajax_records', compact('data'));
    }

    public function update_sorting($posted_data = array())
    {
        if ( isset($posted_data['status']) && $posted_data['status'] ) {
            foreach ($posted_data as $key => $value) {
                if ($key === 'status') {}
                else {
                    $menu_obj = [];
                    $menu_obj = Menu::find($value['id']);
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
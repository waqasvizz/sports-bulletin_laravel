<?php

   /**
    *  @author  DANISH HUSSAIN <danishhussain9525@hotmail.com>
    *  @link    Author Website: https://danishhussain.w3spaces.com/
    *  @link    Author LinkedIn: https://pk.linkedin.com/in/danish-hussain-285345123
    *  @since   2020-03-01
   **/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class CategorieController extends Controller
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
        $data['records'] = $this->CategorieObj->getCategories($posted_data);

        unset($posted_data['paginate']);
        $data['categories'] = $this->CategorieObj->all();

        $data['statuses'] = $this->CategorieObj::Categorie_Constants;

        return view('categories.list', compact('data'));
    }

    public function create()
    {
        return view('categories.add');
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
            'title' => 'required'
        );

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            // ->withInput($request->except('password'));
        } else {
            $posted_data = $request->all();
            $data = array();

            $count = $this->CategorieObj->getCategories(['count' => true]);
            $data['title'] = $posted_data['title'];
            $data['sort_order'] = ++$count;

            $base_url = public_path();
            if($request->file('image')) {
                $extension = $request->image->getClientOriginalExtension();
                if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
                    
                    $file_name = time().'_'.$request->image->getClientOriginalName();
                    $file_path = $request->file('image')->storeAs('other_images', $file_name, 'public');
                    $data['image'] = $file_path;
                } else {
                    return back()->withErrors([
                        'image' => 'The Profile image format is not correct you can only upload (jpg, jpeg, png).',
                    ])->withInput();
                }
            }
            
            $this->CategorieObj->saveUpdateCategorie($data);

            \Session::flash('message', 'Category created successfully!');
            return redirect('/category');
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
        $data = $this->CategorieObj->getCategories($posted_data);
        
        $posted_data = array();
        $posted_data['count'] = true;
        $data['tot_categories'] = $this->CategorieObj->getCategories($posted_data);
        
        $arr = array();
        for ($i=1; $i <= $data['tot_categories'] ; $i++) { 
            $arr[] = $i;
        }

        $data['all_opts'] = $arr;
        $data['statuses'] = $this->CategorieObj::Categorie_Constants;

        // echo "Line no @"."<br>";
        // echo "<pre>";
        // print_r($data->toArray());
        // echo "</pre>";
        // exit("@@@@");

        return view('categories.add',compact('data'));
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
            'status' => 'required|in:Draft,Published'
        ]);
   
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();   
        }
        
        $posted_data = array();
        $posted_data['id'] = $requested_data['update_id'];
        $posted_data['detail'] = true;
        $update_rec = Categorie::getCategories($posted_data)->toArray();

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
                    'image' => 'The Profile image format is not correct you can only upload (jpg, jpeg, png).',
                ])->withInput();
            }
        }

        if ($update_rec) {
            if ($update_rec['sort_order'] != $requested_data['ordering']) {
                $posted_data = array();
                $posted_data['orderBy_name'] = 'sort_order';
                $posted_data['orderBy_value'] = 'ASC';
                $data_sources = Categorie::getCategories($posted_data)->toArray();
    
                $result_rec = swap_array_indexes($data_sources, 'sort_order', $update_rec['sort_order'], $requested_data['ordering']);
                $response = $this->update_sorting($result_rec);
            }
        }

        $update_rec = Categorie::saveUpdateCategorie($requested_data);

        \Session::flash('message', 'Category updated successfully!');
        return redirect('/category');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->CategorieObj->deleteCategorie($id);
        if($response) {
            \Session::flash('message', 'Category deleted successfully!');
            return redirect('/category');
        }
    }

    public function ajax_get_categories(Request $request) {

        $posted_data = $request->all();
        $posted_data['paginate'] = 10;
        $data['records'] = $this->CategorieObj->getCategories($posted_data);
        return view('categories.ajax_records', compact('data'));
    }

    public function update_sorting($posted_data = array())
    {
        if ( isset($posted_data['status']) && $posted_data['status'] ) {
            foreach ($posted_data as $key => $value) {
                if ($key === 'status') {}
                else {
                    $categorie_obj = [];
                    $categorie_obj = Categorie::find($value['id']);
                    $categorie_obj->sort_order = $value['sort_order'];
                    $categorie_obj->save();
                }
            }
            return true;
        }
        else {
            return false;
        }
    }
}
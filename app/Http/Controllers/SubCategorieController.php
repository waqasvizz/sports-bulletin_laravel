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
use App\Models\SubCategorie;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class SubCategorieController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->middleware('permission:sub-category-list|sub-category-edit|sub-category-delete', ['only' => ['index']]);
        $this->middleware('permission:sub-category-create', ['only' => ['create','store']]);
        $this->middleware('permission:sub-category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:sub-category-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posted_data = array();
        $posted_data['orderBy_name'] = 'category_id';
        $posted_data['orderBy_value'] = 'ASC';
        $posted_data['paginate'] = 10;
        $data['records'] = $this->SubCategorieObj->getSubCategories($posted_data);

        $data['html'] = view('sub_categories.ajax_records', compact('data'));
        
        unset($posted_data['paginate']);
        $data['categories'] = $this->CategorieObj->all();

        $data['statuses'] = $this->SubCategorieObj::SubCategorie_Constants;
    
        return view('sub_categories.list', compact('data'));
    }

    public function create()
    {
        $posted_data = array();
        $data['categories'] = $this->CategorieObj->getCategories($posted_data);

        return view('sub_categories.add', compact('data'));
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
            'category' => 'required|exists:categories,id'
        );

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            // ->withInput($request->except('password'));
        } else {
            $posted_data = $request->all();
            $data = array();

            $count = $this->SubCategorieObj->getSubCategories(['category_id' => $posted_data['category'], 'count' => true]);
            $data['title'] = $posted_data['title'];
            $data['category_id'] = $posted_data['category'];
            $data['sort_order'] = ++$count;
            // $data['status'] = $this->SubCategorieObj::SubCategorie_Constants['draft'];

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
            $this->SubCategorieObj->saveUpdateSubCategorie($data);

            \Session::flash('message', 'Sub Category created successfully!');
            return redirect('/sub_category');
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
        $data = $this->SubCategorieObj->getSubCategories($posted_data);

        $data['categories'] = $this->CategorieObj->all();
        
        $posted_data = array();
        $posted_data['count'] = true;
        $posted_data['category_id'] = $data->category_id;
        $posted_data['without_with'] = true;
        $data['tot_sub_categories'] = $this->SubCategorieObj->getSubCategories($posted_data);
        
        $arr = array();
        for ($i=1; $i <= $data['tot_sub_categories'] ; $i++) { 
            $arr[] = $i;
        }

        $data['all_opts'] = $arr;
        $data['statuses'] = $this->SubCategorieObj::SubCategorie_Constants;

        return view('sub_categories.add',compact('data'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategorie $category)
    {
        $requested_data = $request->all();
   
        $validator = \Validator::make($requested_data, [
            'title' => 'required',
            'category' => 'required|exists:categories,id',
            'status' => 'required|in:Draft,Published',
            'ordering' => 'required'
        ]);
   
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();   
        }

        $posted_data = array();
        $posted_data['without_with'] = true;
        $posted_data['category_id'] = $requested_data['category'];
        $posted_data['count'] = true;
        $sub_cat_count = $this->SubCategorieObj->getSubCategories($posted_data);

        $posted_data = array();
        $posted_data['id'] = $requested_data['update_id'];
        $posted_data['detail'] = true;
        $update_rec = SubCategorie::getSubCategories($posted_data)->toArray();

        if ($update_rec) {

            $posted_data = array();
            $posted_data['without_with'] = true;
            $posted_data['orderBy_name'] = 'sort_order';
            $posted_data['orderBy_value'] = 'ASC';
            $posted_data['category_id'] = $update_rec['category_id'];
            $data_sources = $this->SubCategorieObj->getSubCategories($posted_data)->toArray();

            if ($update_rec['category_id'] != $requested_data['category']) {
                
                $result_rec = swap_array_indexes($data_sources, 'sort_order', $update_rec['sort_order'], 0);
                $response = $this->update_sorting($result_rec);
                
                $requested_data['sort_order'] = $sub_cat_count+1;
                unset($requested_data['ordering']);
            }
            else if ($update_rec['sort_order'] != $requested_data['ordering']) {

                $posted_data = array();
                $posted_data['without_with'] = true;
                $posted_data['category_id'] = $requested_data['category'];
                $posted_data['orderBy_name'] = 'sort_order';
                $posted_data['orderBy_value'] = 'ASC';
                $data_sources = $this->SubCategorieObj->getSubCategories($posted_data)->toArray();

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

        $requested_data['category_id'] = $requested_data['category'];
        unset($requested_data['category']);

        $this->SubCategorieObj->saveUpdateSubCategorie($requested_data);

        \Session::flash('message', 'Sub Category updated successfully!');
        return redirect('/sub_category');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->SubCategorieObj->deleteSubCategorie($id);
        if($response) {
            \Session::flash('message', 'Sub Category deleted successfully!');
            return redirect('/sub_category');
        }
    }

    public function ajax_get_sub_categories(Request $request)
    {
        $posted_data = $request->all();
        if(isset($posted_data['category'])){
            $category_id = $posted_data['category'];
            $posted_data = array();
            $posted_data['category'] = $category_id;
            $posted_data['category_id'] = $posted_data['category'];
        }else{
            $posted_data['paginate'] = 10;
        }
        // $posted_data['printsql'] = true;
        $data['records'] = $this->SubCategorieObj->getSubCategories($posted_data);
        
        if(isset($posted_data['category'])){
            $html = '<option value="">Choose an option</option>';
            if (isset($data['records']) && count($data['records'])>0){
                foreach ($data['records'] as $key => $item){
                    $html .= '<option value="'.$item->id.'">'.$item->title.'</option>';
                }
            }
            return $html;

        }else{
            return view('sub_categories.ajax_records', compact('data'));
        }
    }

    public function update_sorting($posted_data = array())
    {
        if ( isset($posted_data['status']) && $posted_data['status'] ) {
            foreach ($posted_data as $key => $value) {
                if ($key === 'status') {}
                else {
                    $categorie_obj = [];
                    $categorie_obj = SubCategorie::find($value['id']);
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
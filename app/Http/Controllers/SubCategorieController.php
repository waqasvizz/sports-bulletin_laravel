<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategorie;

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
    public function index(Request $request)
    {
        $posted_data = $request->all();
        // $posted_data['orderBy_name'] = 'category_id';
        // $posted_data['orderBy_value'] = 'ASC';
        $posted_data['paginate'] = 10;
        $data['records'] = $this->SubCategorieObj->getSubCategories($posted_data);

        $data['html'] = view('sub_categories.ajax_records', compact('data'));

        if($request->ajax()){
            return $data['html'];
        }
        
        unset($posted_data['paginate']);
        $data['categories'] = $this->CategorieObj->all();

        $data['statuses'] = \Config::get('constants.statusDraftPublished');
    
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
        } else {
            $posted_data = $request->all();
            $data = array();

            $count = $this->SubCategorieObj->getSubCategories(['category_id' => $posted_data['category'], 'count' => true]);
            $data['title'] = $posted_data['title'];
            $data['category_id'] = $posted_data['category'];
            $data['sort_order'] = ++$count;

            $base_url = public_path();
            if($request->file('image')) {
                $extension = $request->image->getClientOriginalExtension();
                if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){

                    $imageData = array();
                    // $imageData['fileName'] = time().'_'.$request->image->getClientOriginalName();
                    $imageData['fileName'] = time().'_'.rand(1000000,9999999).'.'.$extension;
                    $imageData['uploadfileObj'] = $request->file('image');
                    $imageData['fileObj'] = \Image::make($request->file('image')->getRealPath());
                    $imageData['folderName'] = 'sub_category_images';
                    
                    $uploadAssetRes = uploadAssets($imageData, $original = false, $optimized = true, $thumbnail = false);
                    $data['image'] = $uploadAssetRes;
                    if(!$uploadAssetRes){
                        return back()->withErrors([
                            'image' => 'Something wrong with your image, please try again later!',
                        ])->withInput();
                    }
                    
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
        $data['statuses'] = \Config::get('constants.statusDraftPublished');

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
        $update_rec = $this->SubCategorieObj->getSubCategories($posted_data)->toArray();

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

                $imageData = array();
                // $imageData['fileName'] = time().'_'.$request->image->getClientOriginalName();
                $imageData['fileName'] = time().'_'.rand(1000000,9999999).'.'.$extension;
                $imageData['uploadfileObj'] = $request->file('image');
                $imageData['fileObj'] = \Image::make($request->file('image')->getRealPath());
                $imageData['folderName'] = 'sub_category_images';
                
                $uploadAssetRes = uploadAssets($imageData, $original = false, $optimized = true, $thumbnail = false);
                $requested_data['image'] = $uploadAssetRes;
                if(!$uploadAssetRes){
                    return back()->withErrors([
                        'image' => 'Something wrong with your image, please try again later!',
                    ])->withInput();
                }
                $imageData = array();
                $imageData['imagePath'] = $update_rec['image'];
                unlinkUploadedAssets($imageData);

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
        $data = $this->SubCategorieObj->getSubCategories([
            'id' => $id,
            'detail' => true,
        ]);
        $response = $this->SubCategorieObj->deleteSubCategorie($id);
        if($response) {
            unlinkUploadedAssets([
                'imagePath' => $data->image
            ]);
            \Session::flash('message', 'Sub Category deleted successfully!');
            return redirect('/sub_category');
        }
    }
    
    public function ajax_get_sub_categories(Request $request)
    {
        $posted_data = array();
        $posted_data['category_id'] = $request->get('category');
        $data = $this->SubCategorieObj->getSubCategories($posted_data);

        $html = '<option value="">Choose an option</option>';
        foreach ($data as $key => $value) {
            $html .= '<option value="'.$value->id.'">'.$value->title.'</option>';
        }
        return $html;
    }

    public function update_sorting($posted_data = array())
    {
        if ( isset($posted_data['status']) && $posted_data['status'] ) {
            foreach ($posted_data as $key => $value) {
                if ($key === 'status') {}
                else {
                    $categorie_obj = [];
                    $categorie_obj = $this->SubCategorieObj::find($value['id']);
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
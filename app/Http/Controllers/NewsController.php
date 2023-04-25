<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{

    function __construct()
    {
        parent::__construct();
        $this->middleware('permission:news-list|news-edit|news-delete', ['only' => ['index']]);
        $this->middleware('permission:news-create', ['only' => ['create','store']]);
        $this->middleware('permission:news-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:news-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posted_data = $request->all();
        // $posted_data['orderBy_name'] = 'sort_order';
        // $posted_data['orderBy_name'] = 'id';
        // $posted_data['orderBy_value'] = 'ASC';
        $posted_data['paginate'] = 10;
        // $posted_data['printsql'] = true;
        $data['records'] = $this->NewsObj->getNews($posted_data);
        $data['statuses'] = \Config::get('constants.statusDraftPublished');

        $data['html'] = view('news.ajax_records', compact('data'));
        
        if($request->ajax()){
            return $data['html'];
        }

        return view('news.list', compact('data'));
    }

    public function create()
    {
        $data['categories'] = $this->CategorieObj::getCategories([
            'orderBy_name' => 'categories.title',
            'orderBy_value' => 'ASC'
        ]);
        $data['news_status_const'] = \Config::get('constants.statusDraftPublished');

        return view('news.add', compact('data'));
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
        // echo '<pre>';print_r($posted_data);echo '</pre>';exit;
        $rules = array(
            'category' => 'required',
            'sub_category' => 'required',
            'news_title' => 'required',
            'status' => 'required|in:Draft,Published',
            'news_date' => 'required',
            'news_image' => 'required',
            'news_description' => 'required',
        );

        $validator = \Validator::make($posted_data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $data = array();
            $data['categories_id'] = $posted_data['category'];
            $data['sub_categories_id'] = $posted_data['sub_category'];
            $data['title'] = $posted_data['news_title'];
            $data['status'] = $posted_data['status'];
            $data['news_date'] = $posted_data['news_date'];
            $data['news_description'] = $posted_data['news_description'];

            $base_url = public_path();
            if( $request->file('news_image')) {
                $extension = $request->news_image->getClientOriginalExtension();
                if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
                    
                    $imageData = array();
                    $imageData['fileName'] = time().'_'.rand(1000000,9999999).'.'.$extension;
                    $imageData['uploadfileObj'] = $request->file('news_image');
                    $imageData['fileObj'] = \Image::make($request->file('news_image')->getRealPath());
                    $imageData['folderName'] = 'news_image';
                    
                    $uploadAssetRes = uploadAssets($imageData, $original = false, $optimized = true, $thumbnail = false);
                    $data['image_path'] = $uploadAssetRes;
                    if(!$uploadAssetRes){
                        return back()->withErrors([
                            'news_image' => 'Something wrong with your image, please try again later!',
                        ])->withInput();
                    }
                    
                } else {
                    return back()->withErrors([
                        'news_image' => 'The image format is not correct you can only upload (jpg, jpeg, png).',
                    ])->withInput();
                }
            }
           
            $this->NewsObj->saveUpdateNews($data);

            \Session::flash('message', 'News created successfully!');
            return redirect('/news_content');
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
        $data['news_detail'] = $this->NewsObj->getNews([
            'id' => $id,
            'detail' => true
        ]);
        
        $data['categories'] = $this->CategorieObj::getCategories([
            'orderBy_name' => 'categories.title',
            'orderBy_value' => 'ASC'
        ]);
        $data['sub_categories'] = $this->SubCategorieObj::getSubCategories([
            'category_id' => $data['news_detail']->category_id,
        ]);
        $data['news_status_const'] = \Config::get('constants.statusDraftPublished');

        return view('news.add',compact('data'));
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
        // echo '<pre>';print_r($requested_data);echo '</pre>';exit;
   
        $validator = \Validator::make($requested_data, [
            'category' => 'required',
            'sub_category' => 'required',
            'news_title' => 'required',
            'status' => 'required|in:Draft,Published',
            'news_date' => 'required',
            'news_description' => 'required',
        ]);
   
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();   
        }

        $data = array();
        $data['categories_id'] = $requested_data['category'];
        $data['sub_categories_id'] = $requested_data['sub_category'];
        $data['title'] = $requested_data['news_title'];
        $data['status'] = $requested_data['status'];
        $data['news_date'] = $requested_data['news_date'];
        $data['news_description'] = $requested_data['news_description'];
        
        $posted_data = array();
        $posted_data['id'] = $requested_data['update_id'];
        $posted_data['detail'] = true;
        $update_rec = $this->NewsObj::getNews($posted_data)->toArray();

        $base_url = public_path();
        if($request->file('news_image')) {
            $extension = $request->news_image->getClientOriginalExtension();
            if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
                
                $imageData = array();
                $imageData['fileName'] = time().'_'.rand(1000000,9999999).'.'.$extension;
                $imageData['uploadfileObj'] = $request->file('news_image');
                $imageData['fileObj'] = \Image::make($request->file('news_image')->getRealPath());
                $imageData['folderName'] = 'news_image';
                
                $uploadAssetRes = uploadAssets($imageData, $original = false, $optimized = true, $thumbnail = false);
                $requested_data['image_path'] = $uploadAssetRes;
                if(!$uploadAssetRes){
                    return back()->withErrors([
                        'news_image' => 'Something wrong with your image, please try again later!',
                    ])->withInput();
                }
                $imageData = array();
                $imageData['imagePath'] = $update_rec['image_path'];
                unlinkUploadedAssets($imageData);
                
            } else {
                return back()->withErrors([
                    'news_image' => 'The image format is not correct you can only upload (jpg, jpeg, png).',
                ])->withInput();
            }
        }

        // if ($update_rec) {
        //     if ($update_rec['sort_order'] != $requested_data['ordering']) {
        //         $posted_data = array();
        //         $posted_data['orderBy_name'] = 'sort_order';
        //         $posted_data['orderBy_value'] = 'ASC';
        //         $data_sources = $this->NewsObj::getNews($posted_data)->toArray();
    
        //         $result_rec = swap_array_indexes($data_sources, 'sort_order', $update_rec['sort_order'], $requested_data['ordering']);
        //         $response = $this->update_sorting($result_rec);
        //     }
        // }

        $update_rec = $this->NewsObj::saveUpdateNews($requested_data);

        \Session::flash('message', 'News updated successfully!');
        return redirect('/news_content');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->NewsObj->getNews([
            'id' => $id,
            'detail' => true,
        ]);
        $response = $this->NewsObj->deleteNews($id);
        if($response) {
            unlinkUploadedAssets([
                'imagePath' => $data->image_path
            ]);
            \Session::flash('message', 'News deleted successfully!');
            return redirect('/news_content');
        }
    }

    public function ajax_get_news(Request $request) {

        $posted_data = $request->all();
        $posted_data['paginate'] = 10;
        $data['records'] = $this->NewsObj->getNews($posted_data);
        return view('news.ajax_records', compact('data'));
    }

    public function update_sorting($posted_data = array())
    {
        if ( isset($posted_data['status']) && $posted_data['status'] ) {
            foreach ($posted_data as $key => $value) {
                if ($key === 'status') {}
                else {
                    $news_obj = [];
                    $news_obj = $this->NewsObj::find($value['id']);
                    $news_obj->sort_order = $value['sort_order'];
                    $news_obj->save();
                }
            }
            return true;
        }
        else {
            return false;
        }
    }
}
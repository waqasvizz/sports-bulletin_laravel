<?php

   /**
    *  @author  DANISH HUSSAIN <danishhussain9525@hotmail.com>
    *  @link    Author Website: https://danishhussain.w3spaces.com/
    *  @link    Author LinkedIn: https://pk.linkedin.com/in/danish-hussain-285345123
    *  @since   2020-03-01
   **/

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function index()
    {
        $posted_data = array();
        // $posted_data['orderBy_name'] = 'sort_order';
        $posted_data['orderBy_name'] = 'id';
        $posted_data['orderBy_value'] = 'ASC';
        $posted_data['paginate'] = 10;
        $data['records'] = $this->NewsObj->getNews($posted_data);
        $data['statuses'] = $this->NewsObj::News_Status_Constants;

        $data['html'] = view('news.ajax_records', compact('data'));
        return view('news.list', compact('data'));
    }

    public function create()
    {
        $data['categories'] = $this->CategorieObj::getCategories();
        $data['news_status_const'] = $this->NewsObj::News_Status_Constants;

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
                    
                    $file_name = time().'_'.$request->news_image->getClientOriginalName();
                    $file_path = $request->file('news_image')->storeAs('other_images', $file_name, 'public');
                    $data['image_path'] = $file_path;
                } else {
                    return back()->withErrors([
                        'news_image' => 'The image format is not correct you can only upload (jpg, jpeg, png).',
                    ])->withInput();
                }
            }
           
            $this->NewsObj->saveUpdateNews($data);

            \Session::flash('message', 'News created successfully!');
            return redirect('/news');
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
        
        $data['categories'] = $this->CategorieObj::getCategories();
        $data['news_status_const'] = $this->NewsObj::News_Status_Constants;

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
   
        $validator = \Validator::make($requested_data, [
            'categories_id' => 'required',
            'sub_categories_id' => 'required',
            'title' => 'required',
            'status' => 'required|in:Draft,Published',
            'news_date' => 'required',
            'image_path' => 'required',
            'news_description' => 'required',
        ]);
   
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();   
        }
        
        $posted_data = array();
        $posted_data['id'] = $requested_data['update_id'];
        $posted_data['detail'] = true;
        $update_rec = $this->NewsObj::getNews($posted_data)->toArray();

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
                $data_sources = $this->NewsObj::getNews($posted_data)->toArray();
    
                $result_rec = swap_array_indexes($data_sources, 'sort_order', $update_rec['sort_order'], $requested_data['ordering']);
                $response = $this->update_sorting($result_rec);
            }
        }

        $update_rec = $this->NewsObj::saveUpdateNews($requested_data);

        \Session::flash('message', 'News updated successfully!');
        return redirect('/news');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->NewsObj->deleteNews($id);
        if($response) {
            \Session::flash('message', 'News deleted successfully!');
            return redirect('/news');
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
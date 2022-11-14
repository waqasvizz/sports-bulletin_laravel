<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->middleware('permission:blog-list|blog-edit|blog-delete', ['only' => ['index']]);
        $this->middleware('permission:blog-create', ['only' => ['create','store']]);
        $this->middleware('permission:blog-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:blog-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posted_data = $request->all();
        $posted_data['paginate'] = 10;
        $data['records'] = $this->BlogObj->getBlog($posted_data);
    
        $data['html'] = view('blogs.ajax_records', compact('data'));
        
        if($request->ajax()){
            return $data['html'];
        }

        return view('blogs.list', compact('data'));
    }

    public function create()
    {
        return view('blogs.add');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requested_data = $request->all();
        $rules = array(
            'blog_title' => 'required',
            'blog_status' => 'required|in:Draft,Published',
            'blog_image' => 'required',
            'blog_description' => 'required'
        );

        $validator = \Validator::make($requested_data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            
            $base_url = public_path();
            if($request->file('blog_image')) {
                $extension = $request->blog_image->getClientOriginalExtension();
                if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
                    
                    $file_name = time().'_'.$request->blog_image->getClientOriginalName();
                    $file_path = $request->file('blog_image')->storeAs('blog_images', $file_name, 'public');
                    $requested_data['blog_image'] = $file_path;
                } else {
                    return back()->withErrors([
                        'blog_image' => 'The image format is not correct you can only upload (jpg, jpeg, png).',
                    ])->withInput();
                }
            }

            $this->BlogObj->saveUpdateBlog($requested_data);

            \Session::flash('message', 'Blog created successfully!');
            return redirect('/blog');
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

        $data = $this->BlogObj->getBlog($posted_data);

        return view('blogs.add',compact('data'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = 0)
    {
        $requested_data = $request->all();
        $requested_data['update_id'] = $id;
        $rules = array(
            'update_id' => 'required|exists:blogs,id',
            'blog_title' => 'required',
            'blog_status' => 'required|in:Draft,Published',
            // 'blog_image' => 'required',
            'blog_description' => 'required'
        );
        $validator = \Validator::make($requested_data, $rules);
   
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();   
        }

        
        $update_rec = $this->BlogObj->getBlog([
            'detail' => true,
            'id' => $requested_data['update_id'],
        ])->toArray();
            
        $base_url = public_path();
        if($request->file('blog_image')) {
            $extension = $request->blog_image->getClientOriginalExtension();
            if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
                if (!is_null($update_rec['blog_image'])) {
                    $url = $base_url.'/'.$update_rec['blog_image'];
                    if (file_exists($url)) {
                        unlink($url);
                    }
                }
                $file_name = time().'_'.$request->blog_image->getClientOriginalName();
                $file_path = $request->file('blog_image')->storeAs('blog_images', $file_name, 'public');
                $requested_data['blog_image'] = $file_path;
            } else {
                return back()->withErrors([
                    'blog_image' => 'The image format is not correct you can only upload (jpg, jpeg, png).',
                ])->withInput();
            }
        }

        $this->BlogObj->saveUpdateBlog($requested_data);

        \Session::flash('message', 'Blog updated successfully!');
        return redirect('/blog');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $base_url = public_path();
        if (!is_null($blog->blog_image)) {
            $url = $base_url.'/'.$blog->blog_image;
            if (file_exists($url)) {
                unlink($url);
            }
        }
        $blog->delete();

        \Session::flash('message', 'Blog deleted successfully!');
        return redirect('/blog');
    }
}
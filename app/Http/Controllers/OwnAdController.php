<?php

namespace App\Http\Controllers;

use App\Models\OwnAd;
use Illuminate\Http\Request;

class OwnAdController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->middleware('permission:ownAd-list|ownAd-edit|ownAd-delete', ['only' => ['index']]);
        $this->middleware('permission:ownAd-create', ['only' => ['create','store']]);
        $this->middleware('permission:ownAd-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:ownAd-delete', ['only' => ['destroy']]);
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
        $data['records'] = $this->OwnAdObj->getOwnAd($posted_data);
    
        $data['html'] = view('ownAds.ajax_records', compact('data'));
        
        if($request->ajax()){
            return $data['html'];
        }

        return view('ownAds.list', compact('data'));
    }

    public function create()
    {
        return view('ownAds.add');
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
            'ownAd_title' => 'required',
            'ownAd_status' => 'required|in:Draft,Published',
            'ownAd_image' => 'required',
            'ownAd_description' => 'required'
        );

        $validator = \Validator::make($requested_data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            
            $base_url = public_path();
            if($request->file('ownAd_image')) {
                $extension = $request->ownAd_image->getClientOriginalExtension();
                if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
                    
                    $imageData = array();
                    // $imageData['fileName'] = time().'_'.$request->ownAd_image->getClientOriginalName();
                    $imageData['fileName'] = time().'_'.rand(1000000,9999999).'.'.$extension;
                    $imageData['uploadfileObj'] = $request->file('ownAd_image');
                    $imageData['fileObj'] = \Image::make($request->file('ownAd_image')->getRealPath());
                    $imageData['folderName'] = 'ownAd_image';
                    
                    $uploadAssetRes = uploadAssets($imageData, $original = false, $optimized = true, $thumbnail = false);
                    $requested_data['ownAd_image'] = $uploadAssetRes;
                    if(!$uploadAssetRes){
                        return back()->withErrors([
                            'ownAd_image' => 'Something wrong with your image, please try again later!',
                        ])->withInput();
                    }
                    
                } else {
                    return back()->withErrors([
                        'ownAd_image' => 'The image format is not correct you can only upload (jpg, jpeg, png).',
                    ])->withInput();
                }
            }

            $this->OwnAdObj->saveUpdateOwnAd($requested_data);

            \Session::flash('message', 'OwnAd created successfully!');
            return redirect('/ownAd');
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

        $data = $this->OwnAdObj->getOwnAd($posted_data);

        return view('ownAds.add',compact('data'));
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
            'update_id' => 'required|exists:ownAds,id',
            'ownAd_title' => 'required',
            'ownAd_status' => 'required|in:Draft,Published',
            // 'ownAd_image' => 'required',
            'ownAd_description' => 'required'
        );
        $validator = \Validator::make($requested_data, $rules);
   
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();   
        }

        
        $update_rec = $this->OwnAdObj->getOwnAd([
            'detail' => true,
            'id' => $requested_data['update_id'],
        ])->toArray();
            
        $base_url = public_path();
        if($request->file('ownAd_image')) {
            $extension = $request->ownAd_image->getClientOriginalExtension();
            if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
                
                $imageData = array();
                $imageData['fileName'] = time().'_'.rand(1000000,9999999).'.'.$extension;
                $imageData['uploadfileObj'] = $request->file('ownAd_image');
                $imageData['fileObj'] = \Image::make($request->file('ownAd_image')->getRealPath());
                $imageData['folderName'] = 'ownAd_image';
                
                $uploadAssetRes = uploadAssets($imageData, $original = false, $optimized = true, $thumbnail = false);
                $requested_data['ownAd_image'] = $uploadAssetRes;
                if(!$uploadAssetRes){
                    return back()->withErrors([
                        'ownAd_image' => 'Something wrong with your image, please try again later!',
                    ])->withInput();
                }
                $imageData = array();
                $imageData['imagePath'] = $update_rec['ownAd_image'];
                unlinkUploadedAssets($imageData);
                
            } else {
                return back()->withErrors([
                    'ownAd_image' => 'The image format is not correct you can only upload (jpg, jpeg, png).',
                ])->withInput();
            }
        }

        $this->OwnAdObj->saveUpdateOwnAd($requested_data);

        \Session::flash('message', 'OwnAd updated successfully!');
        return redirect('/ownAd');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OwnAd $ownAd)
    {
        unlinkUploadedAssets([
            'imagePath' => $ownAd->ownAd_image
        ]);

        $ownAd->delete();

        \Session::flash('message', 'OwnAd deleted successfully!');
        return redirect('/ownAd');
    }
}
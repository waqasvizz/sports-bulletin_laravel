<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->middleware('permission:staff-list|staff-edit|staff-delete', ['only' => ['index']]);
        $this->middleware('permission:staff-create', ['only' => ['create','store']]);
        $this->middleware('permission:staff-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:staff-delete', ['only' => ['destroy']]);
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
        $data['records'] = $this->StaffObj->getStaff($posted_data);
    
        $data['html'] = view('staffs.ajax_records', compact('data'));
        
        if($request->ajax()){
            return $data['html'];
        }

        return view('staffs.list', compact('data'));
    }

    public function create()
    {
        return view('staffs.add');
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
            'staff_title' => 'required',
            'staff_status' => 'required|in:Draft,Published',
            'staff_image' => 'required',
            'staff_description' => 'required'
        );

        $validator = \Validator::make($requested_data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            
            $base_url = public_path();
            if($request->file('staff_image')) {
                $extension = $request->staff_image->getClientOriginalExtension();
                if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
                    
                    $imageData = array();
                    // $imageData['fileName'] = time().'_'.$request->staff_image->getClientOriginalName();
                    $imageData['fileName'] = time().'_'.rand(1000000,9999999).'.'.$extension;
                    $imageData['uploadfileObj'] = $request->file('staff_image');
                    $imageData['fileObj'] = \Image::make($request->file('staff_image')->getRealPath());
                    $imageData['folderName'] = 'staff_image';
                    
                    $uploadAssetRes = uploadAssets($imageData, $original = false, $optimized = true, $thumbnail = false);
                    $requested_data['staff_image'] = $uploadAssetRes;
                    if(!$uploadAssetRes){
                        return back()->withErrors([
                            'staff_image' => 'Something wrong with your image, please try again later!',
                        ])->withInput();
                    }
                    
                } else {
                    return back()->withErrors([
                        'staff_image' => 'The image format is not correct you can only upload (jpg, jpeg, png).',
                    ])->withInput();
                }
            }

            $this->StaffObj->saveUpdateStaff($requested_data);

            \Session::flash('message', 'Staff created successfully!');
            return redirect('/staff');
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

        $data = $this->StaffObj->getStaff($posted_data);

        return view('staffs.add',compact('data'));
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
            'update_id' => 'required|exists:staffs,id',
            'staff_title' => 'required',
            'staff_status' => 'required|in:Draft,Published',
            // 'staff_image' => 'required',
            'staff_description' => 'required'
        );
        $validator = \Validator::make($requested_data, $rules);
   
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();   
        }

        
        $update_rec = $this->StaffObj->getStaff([
            'detail' => true,
            'id' => $requested_data['update_id'],
        ])->toArray();
            
        $base_url = public_path();
        if($request->file('staff_image')) {
            $extension = $request->staff_image->getClientOriginalExtension();
            if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
                
                $imageData = array();
                $imageData['fileName'] = time().'_'.rand(1000000,9999999).'.'.$extension;
                $imageData['uploadfileObj'] = $request->file('staff_image');
                $imageData['fileObj'] = \Image::make($request->file('staff_image')->getRealPath());
                $imageData['folderName'] = 'staff_image';
                
                $uploadAssetRes = uploadAssets($imageData, $original = false, $optimized = true, $thumbnail = false);
                $requested_data['staff_image'] = $uploadAssetRes;
                if(!$uploadAssetRes){
                    return back()->withErrors([
                        'staff_image' => 'Something wrong with your image, please try again later!',
                    ])->withInput();
                }
                $imageData = array();
                $imageData['imagePath'] = $update_rec['staff_image'];
                unlinkUploadedAssets($imageData);
                
            } else {
                return back()->withErrors([
                    'staff_image' => 'The image format is not correct you can only upload (jpg, jpeg, png).',
                ])->withInput();
            }
        }

        $this->StaffObj->saveUpdateStaff($requested_data);

        \Session::flash('message', 'Staff updated successfully!');
        return redirect('/staff');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        unlinkUploadedAssets([
            'imagePath' => $staff->staff_image
        ]);

        $staff->delete();

        \Session::flash('message', 'Staff deleted successfully!');
        return redirect('/staff');
    }
}
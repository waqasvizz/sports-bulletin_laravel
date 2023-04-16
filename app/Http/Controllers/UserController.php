<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Laravel\Passport\Token;
use App\Exports\ExportData;
use Illuminate\Support\Arr;
use App\Models\User;
use Analytics;
use Carbon\Carbon;
use Spatie\Analytics\Period;
use DB;

class UserController extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->middleware('permission:user-list|user-edit|user-delete|user-status', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit|user-status', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function testing() {
		// category
        //$old_data = DB::connection('mysql2')->table('tbl_main_category')->paginate(50);
		//$count = 0;
		//foreach($old_data as $key => $value){
        //	echo '<pre>';print_r($value);'</pre>';
        //   $data = array();
        //    $data['id'] = $value->main_category_id;
        //    $data['title'] = $value->main_category_name;
        //    $data['sort_order'] = ++$count;
        //    $this->CategorieObj->saveUpdateCategorie($data);
		//}
		
		
		
		// sub category
		// $old_data = DB::connection('mysql2')->table('tbl_category')->paginate(50);
		// $count = 0;
		// foreach($old_data as $key => $value){
		//     echo '<pre>';print_r($value);'</pre>';
		//     $data = array();
		//     $data['id'] = $value->category_id;
		//     $data['category_id'] = $value->fk_main_category_id;
		//     $data['title'] = $value->category_name;
		//     $data['status'] = 'Published';
		//     $data['sort_order'] = ++$count;
		//     $this->SubCategorieObj->saveUpdateSubCategorie($data);
		// }
		
		
		// news
		$old_data = DB::connection('mysql2')->table('tbl_news')->paginate(200);
		$count = 0;
		foreach($old_data as $key => $value){
		    echo '<br><pre>';print_r($value->id);'</pre>';
		    $cat_detail = $this->SubCategorieObj->getSubCategories(['id' => $value->category_id, 'detail' => true]);
            if($cat_detail){
                $data = array();
                $data['id'] = $value->id;
                $data['title'] = $value->title;
                $data['categories_id'] = $cat_detail->category_id;
                $data['sub_categories_id'] = $cat_detail->id;
                $data['status'] = 'Published';
                $data['news_date'] = $value->news_date;
                $data['image_path'] = 'news_image/'.$value->image;
                $data['news_description'] = $value->description;
                $this->NewsObj->saveUpdateNews($data);
            }
		}
		
        echo '<pre>';print_r('ok');'</pre>';exit;
    }
    
    public function googleAnalytics(Request $request)
    {
        $data = array();
        $requestData = $request->all();
        if(isset($requestData['filter_date'])){
            $endDate = date('d/m/Y', strtotime($requestData['filter_date']));
            $startDate = date('d/m/Y', strtotime($requestData['filter_date'].' - 30 days'));
            $previousEndDate = date('d/m/Y', strtotime($requestData['filter_date'].' - 30 days'));
            $previousStartDate = date('d/m/Y', strtotime($requestData['filter_date'].' - 60 days'));
        }else{
            $startDate = date('d/m/Y', strtotime('today - 30 days'));
            $endDate = date('d/m/Y');
    
            $previousStartDate = date('d/m/Y', strtotime('today - 60 days'));
            $previousEndDate = date('d/m/Y', strtotime('today - 30 days'));
        }
        $startDate = Carbon::createFromFormat('d/m/Y', $startDate);
        $endDate = Carbon::createFromFormat('d/m/Y', $endDate);
        $diff = $startDate->diffInDays($endDate);
        $period = Period::create($startDate, $endDate);
    
        $previousStartDate = Carbon::createFromFormat('d/m/Y', $previousStartDate);
        $previousEndDate = Carbon::createFromFormat('d/m/Y', $previousEndDate);
        $previousPeriod = Period::create($previousStartDate, $previousEndDate);
    
        $data['analyticsData'] = Analytics::fetchTotalVisitorsAndPageViews($period)->ToArray();
        $data['previousAnalyticsData'] = Analytics::fetchTotalVisitorsAndPageViews($previousPeriod)->ToArray();
        $data['popular'] = Analytics::fetchMostVisitedPages($period, 2000)->ToArray();
        $data['topReferrers'] = Analytics::fetchTopReferrers($period, 2000)->ToArray();
        $data['userTypes'] = Analytics::fetchUserTypes($period, 2000)->ToArray();
        $data['topBrowsers'] = Analytics::fetchTopBrowsers($period, 2000)->ToArray();
        // echo '<pre>';print_r($data['previousAnalyticsData']);'</pre>';exit;
        $data['countries'] = Analytics::performQuery(
            $period,
            'ga:sessions', // metrics
            [
                'metrics' => 'ga:sessions, ga:pageviews, ga:visitors',
                'dimensions' => 'ga:country',
                'sort' => '-ga:sessions',
                'max-results' => 2000,
            ],
        );
        $data['countries'] = $data['countries']->rows;
    
    
        $data['requestData'] = $requestData;
        return view('analytics', compact('data'));
    }

    public function welcome()
    {
        return view('auth_v1.login');
    }

    public function login()
    {
        return view('auth_v1.login');
    }

    public function register()
    {
        return view('auth_v1.register');
    }

    public function resetPassword()
    {
        return view('auth_v1.reset-password');
    }

    public function forgotPassword()
    {
        return view('auth_v1.forgot-password');
    }

    public function logout()
    {
        if(\Auth::check()){
            
            $posted_data['device_id'] = \Session::getId();
            $posted_data['user_id'] = \Auth::user()->id;
            $posted_data['detail'] = true;
            $get_notification_tokens = $this->FcnTokenObj->getFcmTokens($posted_data);
            if($get_notification_tokens){
                $this->FcnTokenObj->deleteFCM_Token($get_notification_tokens->id);
            }
            \Auth::logout();

        }
        return redirect('/sb-login');
    }
    

    public function dashboard(Request $request)
    {
        $data = array();
        $data['counts'] = array();

        $data['counts']['roles'] = $this->RoleObj->getRoles([
            'count' => true
        ]);

        $data['counts']['permissions'] = $this->PermissionObj->getPermissions([
            'count' => true
        ]);

        $data['counts']['users'] = $this->UserObj->getUser([
            'count' => true
        ]);

        $data['counts']['menus'] = $this->MenuObj->getMenus([
            'count' => true
        ]);

        $data['counts']['sub_menus'] = $this->SubMenuObj->getSubMenus([
            'count' => true
        ]);

        $data['counts']['category'] = $this->CategorieObj->getCategories([
            'count' => true
        ]);

        $data['counts']['sub_category'] = $this->SubCategorieObj->getSubCategories([
            'count' => true
        ]);

        $data['counts']['email_messages'] = $this->EmailTemplateObj->getEmailTemplates([
            'count' => true
        ]);

        $data['counts']['short_codes'] = $this->EmailShortCodeObj->getEmailShortCode([
            'count' => true
        ]);




        // echo '<pre>';print_r($data);'</pre>';exit;

        $posted_data = array();
        $posted_data['orderBy_name'] = 'name';
        $posted_data['orderBy_value'] = 'Asc';
        $data['roles'] = $this->RoleObj->getRoles($posted_data);

        return view('dashboard', compact('data'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = array();
        $data['all_roles'] = $this->RoleObj->getRoles(['roles_not_in' => [1]]);
        $data['assigned_roles'] = \Auth::user()->getRoleNames();

        $posted_data = $request->all();
        $posted_data['paginate'] = 10;
        $posted_data['users_not_in'] = [1];
        // $posted_data['printsql'] = true;
        $data['users'] = $this->UserObj->getUser($posted_data);

        $data['html'] = view('user.ajax_records', compact('data'));

        if($request->ajax()){
            return $data['html'];
        }

        return view('user.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $posted_data = array();
        $posted_data['orderBy_name'] = 'name';
        $posted_data['orderBy_value'] = 'Asc';
        $data['roles'] = $this->RoleObj->getRoles($posted_data);
        
        return view('user.add',compact('data'));
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
            'phone_number' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
            'confirm_password' => 'required|required_with:password|same:password',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users',
            'last_name' => 'required',
            'first_name' => 'required',
            'user_role' => 'required',
            // 'profile_image' => 'required',
        );
        
        $messages = array(
            'phone_number.min' => 'The :attribute format is not correct (123-456-7890).'
        );

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            // ->withInput($request->except('password'));
        } else {

            try{ 
                $error_message = array();
                $posted_data['role'] = $posted_data['user_role'];

                if($posted_data['role'] == 2 || $posted_data['role'] == 3){

                    // if(empty($posted_data['phone_number'])){
                    //     $error_message['phone_number'] = 'The Phone number field is required.';
                    // }

                    if(!$request->file('profile_image')) {
                        $error_message['profile_image'] = 'The Profile image field is required.';
                    }

                    if(!empty($error_message)){ 
                        return back()->withErrors($error_message)->withInput();
                    }
                }

                // echo '<pre>';print_r($posted_data);echo '</pre>';exit;

                $base_url = public_path();
                if($request->file('profile_image')) {
                    $extension = $request->profile_image->getClientOriginalExtension();
                    if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){

                        $imageData = array();
                        // $imageData['fileName'] = time().'_'.$request->profile_image->getClientOriginalName();
                        $imageData['fileName'] = time().'.'.$extension;
                        $imageData['uploadfileObj'] = $request->file('profile_image');
                        $imageData['fileObj'] = \Image::make($request->file('profile_image')->getRealPath());
                        $imageData['folderName'] = 'profile_image';
                        
                        $uploadAssetRes = uploadAssets($imageData, $original = false, $optimized = true, $thumbnail = false);
                        $posted_data['profile_image'] = $uploadAssetRes;
                        if(!$uploadAssetRes){
                            return back()->withErrors([
                                'profile_image' => 'Something wrong with your icon image, please try again later!',
                            ])->withInput();
                        }
                    }else{
                        return back()->withErrors([
                            'profile_image' => 'The Profile image format is not correct you can only upload (jpg, jpeg, png).',
                        ])->withInput();
                    }
                }
                
                $latest_user = $this->UserObj->saveUpdateUser($posted_data);
                
                $latest_user->assignRole($posted_data['role']);

                \Session::flash('message', 'User Register Successfully!');

            } catch (Exception $e) {
                \Session::flash('error_message', $e->getMessage());
                // dd("Error: ". $e->getMessage());
            }
            // return redirect()->back()->withInput();
            return redirect('/user');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function theme_layout(Request $request) {

        $posted_data = $request->all();
        $posted_data['update_id'] = \Auth::user()->id;


        if(\Auth::user()->theme_mode == 'Light'){
            $posted_data['theme_mode'] = 'Dark';
        }
        else{
            $posted_data['theme_mode'] = 'Light';
        }
    //    echo '<pre>';print_r($posted_data);echo '</pre>';exit;
    $this->UserObj->saveUpdateUser($posted_data);
        // echo '<pre>';print_r($response);echo '</pre>';exit;
        return response()->json(['message' => 'Data submitted', 'record' => $posted_data]);

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
        $data = $this->UserObj->getUser($posted_data);
 
        $posted_data = array();
        $posted_data['orderBy_name'] = 'name';
        $posted_data['orderBy_value'] = 'Asc';
        $data['roles'] = $this->RoleObj->getRoles($posted_data);
        $data['user_role'] = count(\Auth::user()->getRoleNames()) > 0 ? \Auth::user()->getRoleNames()[0] : '';
        
        return view('user.add',compact('data'));
    }

    public function editProfile()
    {
        $id = \Auth::user()->id;
        
        $posted_data = array();
        $posted_data['id'] = $id;
        $posted_data['detail'] = true;
        $data = $this->UserObj->getUser($posted_data);

        $posted_data = array();
        $posted_data['orderBy_name'] = 'name';
        $posted_data['orderBy_value'] = 'Asc';
        $data['roles'] = $this->RoleObj->getRoles($posted_data);

        // echo '<pre>';print_r($data);echo '</pre>';exit;
        return view('user.add',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $posted_data = $request->all(); 
        
        $rules = array(
            'phone_number' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
            'confirm_password' => 'nullable|required_with:password|same:password',
            'password' => 'nullable|min:6',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'last_name' => 'required',
            'first_name' => 'required',
            'user_role' => 'required'
        );
        
        $messages = array(
            'phone_number.min' => 'The :attribute format is not correct (123-456-7890).'
        );

        $validator = \Validator::make($posted_data, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            // ->withInput($request->except('password'));
        } else {

            try{
                $posted_data['update_id'] = $id;
                $posted_data['role'] = $posted_data['user_role'];

                $user = $this->UserObj->getUser(['id' => $id, 'detail' => true]);

                if ($user) {
                    $pre_role = count($user->getRoleNames()) > 0 ? $user->getRoleNames()[0] : '';
                    $user->removeRole($pre_role);
                    $user->assignRole($posted_data['user_role']);
                }

                // if($posted_data['role'] == 2 || $posted_data['role'] == 3){

                //     if(empty($posted_data['phone_number'])){
                //         $error_message['phone_number'] = 'The Phone number field is required.';
                //     } 

                //     if(!empty($error_message)){
                //         return back()->withErrors($error_message)->withInput();
                //     }
                // }

                $base_url = public_path();
                if($request->file('profile_image')) {
                    $extension = $request->profile_image->getClientOriginalExtension();
                    if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){

                        $imageData = array();
                        // $imageData['fileName'] = time().'_'.$request->profile_image->getClientOriginalName();
                        $imageData['fileName'] = time().'.'.$extension;
                        $imageData['uploadfileObj'] = $request->file('profile_image');
                        $imageData['fileObj'] = \Image::make($request->file('profile_image')->getRealPath());
                        $imageData['folderName'] = 'profile_image';
                        
                        $uploadAssetRes = uploadAssets($imageData, $original = false, $optimized = true, $thumbnail = false);
                        $posted_data['profile_image'] = $uploadAssetRes;
                        if(!$uploadAssetRes){
                            return back()->withErrors([
                                'profile_image' => 'Something wrong with your icon image, please try again later!',
                            ])->withInput();
                        }
                        $imageData = array();
                        $imageData['imagePath'] = $update_rec['profile_image'];
                        unlinkUploadedAssets($imageData);
                        
                    }else{
                        return back()->withErrors([
                            'profile_image' => 'The Profile image format is not correct you can only upload (jpg, jpeg, png).',
                        ])->withInput();
                    }
                }

                $this->UserObj->saveUpdateUser($posted_data);
                \Session::flash('message', 'User Update Successfully!');
                return redirect()->back();

            } catch (Exception $e) {
                \Session::flash('error_message', $e->getMessage());
                // dd("Error: ". $e->getMessage());
            }
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function blockUnblockUser(Request $request)
    {
        $posted_data = $request->all(); 
        
        $rules = array(
            'update_id' => 'required',
            'user_status' => 'required'
        );

        $validator = \Validator::make($posted_data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $this->UserObj->saveUpdateUser($posted_data);

        \Session::flash('message', 'User Updated Successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        unlinkUploadedAssets([
            'imagePath' => $user->profile_image
        ]);
        $user->delete(); 
        \Session::flash('message', 'User deleted successfully!');
        return redirect('/user');
      
    }

    public function accountLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],  
        ]);
        // $credentials['role'] = 1;

        if (\Auth::attempt($credentials)) {


            // if(\Auth::user()->role == 1){
                return redirect('/dashboard');
            // }else if(\Auth::user()->role == 2){
            //     return redirect('/client');
            // }else if(\Auth::user()->role == 3){
            //     return redirect('/staff');
            // }
        }else{
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function accountRegister(Request $request)
    {
        $rules = array(
            'user_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|required_with:password|same:password'
        );

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            try{
                $posted_data = $request->all();
                $posted_data['role'] = 2;
                $posted_data['name'] = $posted_data['user_name'];

                $this->UserObj->saveUpdateUser($posted_data);
                \Session::flash('message', 'User Register Successfully!');

            } catch (Exception $e) {
                \Session::flash('error_message', $e->getMessage());
                // dd("Error: ". $e->getMessage());
            }
            return redirect('/sb-login');
        }
    }
    
    public function accountResetPassword(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            // 'email' => 'required|email|unique:users',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $users = $this->UserObj::where('email', '=', $request->input('email'))->first();
            if ($users === null) {
                // echo 'User does not exist';
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ]);
                // Session::flash('error_message', 'Your email does not exists.');
                return redirect()->back()->withInput();
            } else {
                // echo 'User exits';
                $random_hash = substr(md5(uniqid(rand(), true)), 10, 10); 
                $email = $request->get('email');
                $password = \Hash::make($random_hash);

                // $userObj = new user();
                // $posted_data['email'] = $email;
                // $posted_data['password'] = $password;
                // $userObj->updateUser($posted_data);

                \DB::update('update users set password = ? where email = ?',[$password,$email]);

                $data = [
                    'new_password' => $random_hash,
                    'subject' => 'Reset Password',
                    'email' => $email
                ];

                \Mail::send('emails.reset_password', $data, function($message) use ($data) {
                    $message->to($data['email'])
                    ->subject($data['subject']);
                });
                \Session::flash('message', 'Your password has been changed successfully please check you email!');
                return redirect('/sb-login');
            }

        }
    }


    public function sendNotification() {
        
        // echo '<pre>';print_r(Session::getId());'</pre>';exit;        
        // $token = "fHRRYnyQyrA:APA91bFGF5j4A76XXsC4xb2canvjRPlJqlcL_yKBmgQrOu9egO3Qk9v86Lh5eSE6EQ13DC6qdE4AoxgdFsIYZvv3PtCeNdbtj6zXazZuJKGI6Doxcriw-Zdpd9QnigCD_mDCgz_BA5N7";  

        $token = "fBvzndxKvpE:APA91bEc2l-37uRiTcYRulz3vVL63KtqmtwP5Tlm4E8hWvKUVAvfRMHjqb_ony4nHDNxuxmDjbmoPzDcmog2cX5zwL-vCf_CA0bdw8en7mVzdpCOUZeQb8Ne9HVr45LGLu3Nulees_V2";
        $from  = "AAAA1x62L-A:APA91bHPEZuPTTVn8tWhggUur4h2_k92s4cRWIu5L9lkRgS2pHtYJKMgCIkg4UcIMui1lWcXRGStyKxjIgrlH7KXefS0CkSS8tlrR0yDWiNRUkeYsNuivIgnV2rgep6QCmQL75-QpBTd";
        $msg = array
            (
                'body'  => "Testing",
                'title' => "Hi, From Raj1",
                'receiver' => 'erw',
                'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                'sound' => 'Default'/*Default sound*/
            );

        $fields = array
                (
                    'to'        => $token,
                    'notification'  => $msg
                );

        $headers = array
                (
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                );
        //#Send Reponse To FireBase Server 
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        dd($result);
        curl_close( $ch );
        // echo '<pre>';print_r('Notification send successfully');'</pre>';exit;
    }


    public function export_data(Request $request) 
    {
        $requested_data = $request->all();

        $data = array();
        if (isset($requested_data['product_id']) || $requested_data['product_id'] == '' )
            $data['product_id'] = $requested_data['product_id'];

        // $export_data = new ExportData();
        // $export_data->set_module = "items";
        // $export_data->set_product_id = $data['product_id'];

        return (new ExportData)
            ->set_module("items")
            ->set_product_id($data['product_id'])
            ->download('items.xlsx');
    }
}
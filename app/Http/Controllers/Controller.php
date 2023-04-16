<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\Role;
use App\Models\User;
use App\Models\EnquiryForm;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\EmailLogs;
use App\Models\FcmToken;
use App\Models\Notification;
use App\Models\EmailTemplate;
use App\Models\Task;
use App\Models\NotificationMessage;
use App\Models\OrderAsset;
use App\Models\ShortCode;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\SubCategorie;
use App\Models\Menu;
use App\Models\SubMenu;
// use Spatie\Permission\Models\Permission;
use App\Models\Permission;
use App\Models\AssignPermission;
use App\Models\News;
use App\Models\Blog;
use App\Models\Staff;
use App\Models\OwnAd;

use DB;
use Validator;
use Auth;
use Session;
use Carbon;
use Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $RoleObj;
    public $UserObj;
    public $OrderObj;
    public $InvoiceObj;
    public $EmailObj;
    public $TaskObj;
    public $NotificationObj;
    public $FcnTokenObj;
    public $EmailTemplateObj;
    public $NotificationMessageObj;
    public $EmailShortCodeObj;
    public $CategorieObj;
    public $SubCategorieObj;
    public $MenuObj;
    public $SubMenuObj;
    public $PermissionObj;
    public $AssignPermissionObj;
    public $NewsObj;
    public $BlogObj;
    public $StaffObj;
    public $OwnAdObj;


    public function __construct() {
        
        $this->RoleObj = new Role();
        $this->UserObj = new User();
        $this->EmailObj = new EmailLogs();
        $this->FcnTokenObj = new FcmToken();
        $this->NotificationObj = new Notification();
        $this->NotificationMessageObj = new NotificationMessage();
        $this->EmailTemplateObj = new EmailTemplate();
        $this->EmailShortCodeObj = new ShortCode();
        $this->CategorieObj = new Categorie();
        $this->SubCategorieObj = new SubCategorie();
        $this->MenuObj = new Menu();
        $this->SubMenuObj = new SubMenu();
        $this->PermissionObj = new Permission();
        $this->AssignPermissionObj = new AssignPermission();
        $this->NewsObj = new News();
        $this->BlogObj = new Blog();
        $this->StaffObj = new Staff();
        $this->OwnAdObj = new OwnAd();
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result = array(), $message, $count = 0)
    {
    	$response = [
            'success' => true,
            'records'    => $result,
            'message' => $message,
            'count'    => $count,
        ];
        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = array(), $code = 200)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['records'] = $errorMessages;
        }
        
        return response()->json($response, $code);
    }
    
    public function welcome()
    {
        $posted_data = array();
        $posted_data['paginate'] = 10;
        $posted_data['status'] = 'Published';
        // $posted_data['printsql'] = true;
        $data =  $this->NewsObj->getNews($posted_data);
        // echo '<pre>';print_r($data->ToArray());echo '</pre>';exit;
        return view('welcome', compact('data'));
    }
    
    public function newsDetail($slug)
    {
        $posted_data = array();
        $posted_data['detail'] = true;
        $posted_data['status'] = 'Published';
        $posted_data['news_slug'] = $slug;
        // $posted_data['printsql'] = true;
        $data['news_detail'] =  $this->NewsObj->getNews($posted_data);


        
        $posted_data = array();
        $posted_data['paginate'] = 6;
        $posted_data['status'] = 'Published';
        // $posted_data['news_slug'] = $slug;
        // $posted_data['printsql'] = true;
        $data['relevant'] =  $this->NewsObj->getNews($posted_data);
        // echo '<pre>';print_r($data->ToArray());echo '</pre>';exit;
        return view('news_detail', compact('data'));
    }
    
    public function single()
    {
        $data =  $this->NewsObj->getNews([
            'id' => $_GET['id'],
            'detail' => true
        ]);
        if($data){
            return redirect('news-detail/'.$data->news_slug);
        }else{
            abort(404);
        }
    }
    
    public function newsGET()
    {
        $posted_data['detail'] = true; 
        if(isset($_GET['cat_id'])){
            $posted_data['sub_category_id'] = $_GET['cat_id'];
        }
        if(isset($_GET['main_cat_id'])){
            $posted_data['category_id'] = $_GET['main_cat_id'];
        }
        $data =  $this->NewsObj->getNews($posted_data);
   
        if($data){
            
            if(isset($_GET['main_cat_id'])){
                return redirect('news/'.$data->category->slug);
            }else{
                return redirect('news/'.$data->category->slug.'/'.$data->sub_category->slug);
            }
        }else{
            abort(404);
        }
    }
    
    public function news($category_slug, $sub_category_slug = '')
    {
        $main_title = slugReverse($category_slug);
        $posted_data = array();
        $posted_data['paginate'] = 10;
        $posted_data['status'] = 'Published';
        $posted_data['category_slug'] = $category_slug;
        if(isset($sub_category_slug) && !empty($sub_category_slug)){
            $posted_data['sub_category_slug'] = $sub_category_slug;
            $main_title = slugReverse($category_slug).' - '.slugReverse($sub_category_slug);
        }
        // $posted_data['printsql'] = true;
        $data =  $this->NewsObj->getNews($posted_data);
        // echo '<pre>';print_r($data->ToArray());echo '</pre>';exit;
        return view('welcome', compact('data'), compact('main_title'));
    }
    
    public function events($event_slug = '')
    {
        $posted_data = array();
        $posted_data['status'] = 'Published';
        $posted_data['blog_slug'] = $event_slug;
        $posted_data['orderBy_name'] = 'blogs.id';
        $posted_data['orderBy_value'] = 'desc';
        if(isset($event_slug) && !empty($event_slug)){
            $posted_data['detail'] = true;
            $main_title = slugReverse($event_slug);
        }else{
            $posted_data['paginate'] = 10;
            $main_title = slugReverse('Latest Events');
        }
        // $posted_data['printsql'] = true;
        $data['latest_events'] =  $this->BlogObj->getBlog($posted_data);

        if(isset($event_slug) && !empty($event_slug)){
            $data['event_detail'] = $data['latest_events'];
            unset($data['latest_events']);
        }
        // echo '<pre>';print_r($data);echo '</pre>';exit;
        return view('events', compact('data'), compact('main_title'));
    }
    
    public function newsCategory($slug)
    {
        $main_title = slugReverse($slug);
        $posted_data = array();
        $posted_data['paginate'] = 10;
        $posted_data['status'] = 'Published';
        $posted_data['category_slug'] = $slug;
        // $posted_data['printsql'] = true;
        $data =  $this->NewsObj->getNews($posted_data);
        // echo '<pre>';print_r($data->ToArray());echo '</pre>';exit;
        return view('welcome', compact('data'), compact('main_title'));
    }
    
    public function newsSubCategory($slug)
    {
        $main_title = slugReverse($slug);
        $posted_data = array();
        $posted_data['paginate'] = 10;
        $posted_data['status'] = 'Published';
        $posted_data['sub_category_slug'] = $slug;
        // $posted_data['printsql'] = true;
        $data =  $this->NewsObj->getNews($posted_data);
        // echo '<pre>';print_r($data->ToArray());echo '</pre>';exit;
        return view('welcome', compact('data'), compact('main_title'));
    }
    
    public function aboutPage()
    {
        return view('about');
    }
    
    public function privacyPage()
    {
        return view('privacy');
    }
    
    public function termsPage()
    {
        return view('terms');
    }
    
    public function contactUsPage()
    {
        return view('contact_us');
    }
    
    public function contactUsSubmit(Request $request)
    {
        return redirect()->back();
        $posted_data = $request->all();
        
        // $this->EmailLogObj->saveUpdateEmailLogs([
        //     'user_id' => $chat->receiver_user_id,
        //     'template_id' => $temp_rec->id,
        //     'email' => $chat->rec_user_email,
        //     'message' => $generated_html,
        //     'subject' => $temp_rec->title,
        //     'response' => json_encode($response_data),
        // ]);
        
        echo '<pre>';print_r($posted_data);echo '</pre>';exit;
    }
    
    public function ourStaffPage()
    {
        $posted_data = array();
        $posted_data['paginate'] = 20;
        $posted_data['staff_status'] = 'Published';
        // $posted_data['printsql'] = true;
        $data =  $this->StaffObj->getStaff($posted_data);
        return view('our_staff', compact('data'));
    }
    
    public function searchCategorylist(Request $request)
    {
        $return_ary = array();
        $return_ary['html'] = '';

        
        $posted_data = $request->all();
        $posted_data['orderBy_name'] = 'title';
        $posted_data['orderBy_value'] = 'ASC';
        $posted_data['status'] = 'Published';
        $posted_data['title'] = $request->get('search');
        $catRecords = $this->CategorieObj->getCategories($posted_data);
        foreach ($catRecords as $key => $value) {
            $return_ary['html'] .= '<a href="'.url('/news').'/'.$value->slug.'"><p>'.$value->title.'</p></a>';
        }
        
        return $this->sendResponse($return_ary, 'Success.');
    }
    
}
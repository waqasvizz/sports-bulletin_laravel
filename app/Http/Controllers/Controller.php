<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Role;
use App\Models\User;
use App\Models\EnquiryForm;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\EmailLogs;
use App\Models\FcmToken;
use App\Models\Notification;
use App\Models\EmailMessage;
use App\Models\Task;
use App\Models\NotificationMessage;
use App\Models\OrderAsset;
use App\Models\ShortCode;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\SubCategorie;

use DB;
use Validator;
use Auth;
use Session;
use Carbon;

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
    public $EmailMessageObj;
    public $NotificationMessageObj;
    public $EmailShortCodeObj;
    public $CategorieObj;
    public $SubCategorieObj;


    public function __construct() {
        
        $this->RoleObj = new Role();
        $this->UserObj = new User();
        $this->EmailObj = new EmailLogs();
        $this->FcnTokenObj = new FcmToken();
        $this->NotificationObj = new Notification();
        $this->NotificationMessageObj = new NotificationMessage();
        $this->EmailMessageObj = new EmailMessage();
        $this->EmailShortCodeObj = new ShortCode();
        $this->CategorieObj = new Categorie();
        $this->SubCategorieObj = new SubCategorie();
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
}
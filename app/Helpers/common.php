<?php 
use App\Models\User;
use Laravel\Ui\Presets\Vue;

if (! function_exists('is_image_exist')) {

    /**
     * check and return the valid url image link. It mey be a real or default asset.
     *
     * @param  string $image_path // the url of the image
     * @param  string $type // it must be 'image' or 'profile-image'
     * @param  string $is_public_path // if true then it will find in public folder, if false then it will find in storage folder'
     * @return string $redirect_url // the wil be the valid url link with real or default asset
     */

    function is_image_exist($image_path = '', $type = "image", $is_public_path = false) {

        $default_asset = ($type == "image") ? 'default-image.png' : 'default-profile-image.png';

        $local_paths_url = array('127.0.0.1', '::1');
        if(in_array($_SERVER['REMOTE_ADDR'], $local_paths_url))
            $base_url = url('/');
        else
            $base_url = url('/').'/public';
      
        $asset_url = $base_url.'/app-assets/images/default-assets/'.$default_asset;

        if($image_path == '' || is_null($image_path)){
            return $asset_url;
        }else if($is_public_path && (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$image_path) || file_exists(public_path().'/'.$image_path))){
            return $base_url.'/'.$image_path;
        }else if(!$is_public_path && (file_exists($_SERVER['DOCUMENT_ROOT'].'/storage/'.$image_path) || file_exists(public_path().'/storage/'.$image_path))){
            return $base_url.'/storage/'.$image_path;
        }else{
            return $asset_url;
        }
    }
}

if (! function_exists('get_gayment_name')) {
    function get_gayment_name($id = 0) {
        
        if ( $id == 1)
            return 'Cash On Delivery';
        else if ( $id == 2)
            return 'Paypal Payment';
        else if ( $id == 3)
            return 'Stripe Payment';
        else
            return 'Unknown';
    }
}

if (! function_exists('get_task_step')) {
    function get_task_step($id = 0) {
        
        if ( $id == 1)
                return 'Step 1 (Sales Pick Up)';
            else if ( $id == 2)
                return 'Step 2 (Survey)';
            else if ( $id == 3)
                return 'Step 3 (Proposal)';
            else if ( $id == 4)
                return 'Step 4 (Reschedule)';
            else if ( $id == 5)
                return 'Step 4 (Itemsinfo)';
            else if ( $id == 6)
                return 'Step 4 (Showroominvite)';
            else if ( $id == 7)
                return 'Upload Invoice 30% (First Invoice)';
            else if ( $id == 8)
                return 'Upload Invoice 40% (Second Invoice)';
            else if ( $id == 9)
                return 'Step 4 (ShowroomInvoice)';
            else if ( $id == 10)
                return 'Step 4 (PortalloSection)';
            else if ( $id == 11)
                return 'Upload Invoice 20% (Third Invoice)';
            else if ( $id == 12)
                return 'Upload Invoice 10% (Fourth Invoice)';
            else if ( $id == 13)
                return 'Step 6 (InstallationChecklist)';
            else if ( $id == 14)
                return 'Step 6 (UploadMannual)';
            else if ( $id == 15)
                return 'Step 6 (GuranteeDoc)';
            else if ( $id == 16)
                return 'Step 6 (RectificationPer)';
            else if ( $id == 176)
                return 'Step 6 (ChecklistComplete)';
            else
                return 'Unknown';
    }
}

if (! function_exists('get_status_name')) {
    function get_status_name($id = 0) {
        
        if ( $id == 1)
            return 'Pending';
        else if ( $id == 2)
            return 'In-Progress';
        else if ( $id == 3)
            return 'Complete';
        else
            return 'Unknown';
    }
}

if (! function_exists('upload_files_to_storage')) {
    function upload_files_to_storage($request, $file_param, $path)
    {
        $response = array();

        $file_name = time().'_'.$file_param->getClientOriginalName();
        $file_name = preg_replace('/\s+/', '_', $file_name);
        $file_request = $file_param->storeAs($path, $file_name, ['disk' => 'public']);
        // $file_path = 'storage/'.$path.'/'.$file_name;
        $file_path = $path.'/'.$file_name;

        if( $file_param->isValid() )
            return $response = array(
                'action'        => true,
                'message'       => 'Requested file is uploaded successfully.',
                'file_name'     => $file_name,
                'file_path'     => $file_path
            );
        else
            return $response = array(
                'action'        => false,
                'message'       => 'Something went wrong during uploading.'
            );    
    }
}

if (! function_exists('delete_files_from_storage')) {
    function delete_files_from_storage($file)
    {
        if( $file != "" ) {
            // File::delete(public_path('upload/bio.png'));
            $process = File::delete(public_path('storage').'/'.$file);
            // $process = File::delete(storage_path().'/'.$file);

            if ( $process )
                return $response = array('action' => true, 'message'   => 'Requested file is delete successfully.');
            else
                return $response = array('action' => false, 'message'   => 'Requested file is not exist.', 'file' => public_path('storage').'/'.$file);
        }
        else 
            return $response = array('action' => false, 'message'   => 'There is no file available to delete.');
    }
}

if (! function_exists('isApiRequest')) {
    function isApiRequest($request)
    {
        $isApiRequest = false;
        if( $request->is('api/*')){
            $isApiRequest = true;
        }
        return $isApiRequest;
    }
}

if (! function_exists('array_flatten')) {
    function array_flatten($array) { 
        if (!is_array($array)) { 
            return FALSE; 
        } 
        $result = array(); 
        foreach ($array as $key => $value) { 
            if (is_array($value)) { 
                $result = array_merge($result, array_flatten($value)); 
            } 
            else { 
                $result[$key] = $value; 
            } 
        } 
        return $result; 
    } 
}

if (! function_exists('multidimentional_array_flatten')) {
    function multidimentional_array_flatten($array, $key) { 
        $unique_ids = array_unique(array_map(
            function ($i) use ($key) {
                return $i[$key];
            }, $array)
        );
    
        return $unique_ids;
    }
}

if (! function_exists('swap_array_indexes')) {

    /**
     * update sorting and store it into the database.
     *
     * @param  array $data_sources // the data array which you want to update
     * @param  string $sort_key // the key which you want to find in the array
     * @param  int $current_val // the current key which you want to find in the data set
     * @param  int $new_val // the updated key which you want to replace in the data set
     * @return array $data_sources // the updated data set which is sorted according to given keys
     */
    
    function swap_array_indexes($data_sources, $sort_key, $current_val, $new_val) {
        $status = false;
        $arr_size = count($data_sources);

        if ($arr_size <= 1) {
            $data_sources['status'] = true;
            return $data_sources;
        }

        $mode = "swap";

        // means user want to delete an item from the chain
        if ( $new_val == 0) {
            $new_val = $arr_size;
            $mode = "delete";
        }

        foreach ($data_sources as $key => $value) {
            if ($current_val < $new_val) {
                if ( $current_val <= $value[$sort_key] && $new_val >= $value[$sort_key] ) {
                    $data_sources[$key][$sort_key] = --$value[$sort_key];
                }
            }
            else if ($current_val > $new_val) {
                if ( $current_val >= $value[$sort_key] && $new_val <= $value[$sort_key] ) {
                    $data_sources[$key][$sort_key] = ++$value[$sort_key];
                }
            }
            $status = true;
        }
        $data_sources[$current_val-1][$sort_key] = $new_val;

        if ($mode == "delete") {
            $status = true;
            unset($data_sources[$current_val-1]);
        }

        $data_sources['status'] = $status;
        return $data_sources;
    }
}

if (! function_exists('split_metadata_strings')) {
    function split_metadata_strings($string = "") {
        $final_result = array();

        foreach (explode('&', $string) as $piece) {
            $result = array();
            $result = explode('=', $piece);
            $final_result[$result[0]] = $result[1];
        }
    
        return $final_result;
    }
}

if (! function_exists('updateTimeSpent')) {
    function updateTimeSpent()
    {
        
        $last_seen = date("Y-m-d H:i:s");  
        $login = Auth::user()->last_seen;
        if( Auth::user()->last_seen == NULL ) {
            $login = date("Y-m-d H:i:s");   
        }
        $logout = date("Y-m-d H:i:s"); 
        // $login = '2022-01-28 20:38:20';
        // $logout = '2022-01-28 21:48:35';
        $time_spent = round(abs(strtotime($login) - strtotime($logout)) / 3600, 2);
        $time_spent = $time_spent + Auth::user()->time_spent;
    
        // echo '<pre>';
        // print_r($time_spent);
        // exit;
        // $UserObj = new User();
        $user = User::find(Auth::user()->id);
        $user->time_spent = $time_spent;
        $user->last_seen = $last_seen;
        $user->update();
        return true;

    }
}

if (! function_exists('time_elapsed_string')) {
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}

if (! function_exists('decodeShortCodesTemplate')) {
        function decodeShortCodesTemplate($posted_data = array()) {
        
        // $email_subject = isset($posted_data['subject']) ? $posted_data['subject'] : '';
        // $email_body = isset($posted_data['body']) ? $posted_data['body'] : '';
        // $email_message_id = isset($posted_data['email_message_id']) ? $posted_data['email_message_id'] : 0;
        // $user_id = isset($posted_data['user_id']) ? $posted_data['user_id'] : 0;
        // $sender_id = isset($posted_data['sender_id']) ? $posted_data['sender_id'] : 0;
        // $receiver_id = isset($posted_data['receiver_id']) ? $posted_data['receiver_id'] : 0;
        // $new_password = isset($posted_data['new_password']) ? $posted_data['new_password'] : '[Something went wrong with server. Please request again]';
        // $verification_code = isset($posted_data['email_verification_url']) ? $posted_data['email_verification_url'] : '[Something went wrong with server. Please request again]';
        
        $EmailMessageObj = new \App\Models\EmailMessage;
        $ShortCodesObj = new \App\Models\ShortCode;
        $OrderObj = new \App\Models\Order;
        $InvoiceObj = new \App\Models\Invoice;
         
        $received_payment =  $received_payment_via_card = 0;
        $message_id = isset($posted_data['message_id']) ? $posted_data['message_id'] : 0;
        $order_id = isset($posted_data['order_id']) ? $posted_data['order_id'] : 0;
        $invoice_id = isset($posted_data['invoice_id']) ? $posted_data['invoice_id'] : 0;
        $order_data = $OrderObj->getOrders(['id' => $order_id, 'detail' => true]);
        $invoice_data = $InvoiceObj->getInvoice(['id' => $invoice_id, 'detail' => true]);

        $emailMessageDetail = $EmailMessageObj->getEmailMessages([
            'detail' => true,
            'id' => $message_id,
        ]);
        
        $email_subject = $emailMessageDetail->subject;
        $email_body = $emailMessageDetail->message;

        if (isset($invoice_data->invoice_step) && ($invoice_data->invoice_step == 1))  {
            $received_payment = ($order_data->proposal_cost * 30) / 100;
            $received_payment_via_card = (($received_payment * 1.5) / 100) + $received_payment;
        }
        elseif (isset($invoice_data->invoice_step) && ($invoice_data->invoice_step == 2)) {
            $received_payment = ($order_data->proposal_cost * 40) / 100;
            $received_payment_via_card = (($received_payment * 1.5) / 100) + $received_payment;
            $invoice_file = @$order_data->invoice_file;
        }
        elseif (isset($invoice_data->invoice_step) && ($invoice_data->invoice_step == 3)) {
            $received_payment = ($order_data->proposal_cost * 20) / 100;
            $received_payment_via_card = (($received_payment * 1.5) / 100) + $received_payment;
        }
        elseif (isset($invoice_data->invoice_step) && ($invoice_data->invoice_step == 4)) {
            $received_payment = ($order_data->proposal_cost * 10) / 100;
            $received_payment_via_card = (($received_payment * 1.5) / 100) + $received_payment;
        }

        $all_codes = $ShortCodesObj->getEmailShortCode();
        foreach ($all_codes as $key => $code ) {

            if ($code['title'] == '[sales_date_time]') {
                $search = $code['title'];
                $replace = $order_data ? ucwords($order_data->survey_datetime) : $search;
            }
            else if ($code['title'] == '[user_name]') {
                $search = $code['title'];
                $user_name = @$order_data->receiverUser->first_name.' '. @$order_data->receiverUser->last_name;
                $replace = $order_data ? ucwords($user_name) : $search;
            }
            else if ($code['title'] == '[invoice_number]') {
                $search = $code['title'];
                $replace = $invoice_data ? ucwords($invoice_data->invoice_number) : $search;
            }
            else if ($code['title'] == '[invoice_preferred_model_pod]') {
                $search = $code['title'];
                $replace = $order_data ? ucwords($order_data->enquiryDetail->preferred_model_of_pod) : $search;
            }
            else if ($code['title'] == '[received_payment_with_discount]') {
                $search = $code['title'];
                $replace = $invoice_data ? ucwords($received_payment) : $search;
            }
            else if ($code['title'] == '[received_payment_via_card]') {
                $search = $code['title'];
                $replace = $invoice_data ? ucwords($received_payment_via_card) : $search;
            }
            else if ($code['title'] == '[installation_date_time]') {
                $search = $code['title'];
                $replace = $order_data ? ucwords($order_data->installation_datetime) : $search;
            }
            else if ($code['title'] == '[login_url]') {
                $search = $code['title'];
                        
                $redirect_url = url('login');
                $login_url = '<a class="text-primary" href="'.$redirect_url.'">'.$redirect_url.'</a>';
        
                $replace = $order_data ? ucwords($login_url) : $search;
            }
            else if ($code['title'] == '[invoice_link]') {
                $search = $code['title'];
                        
                $asset_url = config('app.url').'/public/';
                $image_url = $asset_url.@$invoice_data->invoice_file;

                $invoice_file = '<a class="text-primary" href="'.$image_url.'">Download file</a>';
                $replace = $order_data ? ucwords($invoice_file) : $search;
            }
            if(isset($search)){
                $email_subject = stripcslashes(str_replace($search, $replace, $email_subject));
                $email_body = stripcslashes(str_replace($search, $replace, $email_body));
            }
            
        }
        // $SettingObj = new Setting();
        return $response = [
            'email_subject' => $email_subject,
            'email_body' => $email_body
        ];
    }
}
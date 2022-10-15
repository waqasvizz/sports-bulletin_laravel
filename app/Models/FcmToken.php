<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FcmToken extends Model
{
    use HasFactory;
    public function userDetails()
    {
        return $this->belongsTo('App\Models\User', 'user_id')
            ->with('role')
            ->select(['id', 'role', 'first_name', 'last_name', 'email', 'profile_image']);
    }

    // public function receiverDetails()
    // {
    //     return $this->belongsTo('App\Models\User', 'receiver_id')
    //         ->with('role')
    //         ->select(['id', 'role', 'name', 'first_name', 'last_name', 'email', 'profile_image']);
    // }

    public static function getFcmTokens($posted_data = array())
    {
        $query = FcmToken::latest();

        $query = $query->with('userDetails');
        //             ->with('receiverDetails');

        if (isset($posted_data['user_id'])) {
            $query = $query->where('fcm_tokens.user_id', $posted_data['user_id']);
        }
        if (isset($posted_data['device_id'])) {
            $query = $query->where('fcm_tokens.device_id', $posted_data['device_id']);
        }
        if (isset($posted_data['device_token'])) {
            $query = $query->where('fcm_tokens.device_token', $posted_data['device_token']);
        }
        if (isset($posted_data['device_type'])) {
            $query = $query->where('fcm_tokens.device_type', $posted_data['device_type']);
        }
        if (isset($posted_data['user_id_in'])) {
            $query = $query->whereIn('user_id', $posted_data['user_id_in']);
        } 

        if (isset($posted_data['last_chat'])) {
            $posted_data['orderBy_name'] = 'id';
            $posted_data['orderBy_value'] = 'DESC';

            if (isset($posted_data['paginate'])) {
                unset($posted_data['paginate']);
            }

            $posted_data['detail'] = true;
        }

        $query->select('fcm_tokens.*');

        $query->getQuery()->orders = null;
        if (isset($posted_data['orderBy_name'])) {
            $query->orderBy($posted_data['orderBy_name'], $posted_data['orderBy_value']);
        } else {
            $query->orderBy('id', 'ASC');
        }

        if (isset($posted_data['paginate'])) {
            $result = $query->paginate($posted_data['paginate']);
        } else {
            if (isset($posted_data['detail'])) {
                $result = $query->first();
            } else if (isset($posted_data['count'])) {
                $result = $query->count();
            } else {
                $result = $query->get();
            }
        }


        return $result;
    }

    public static function sendFcmNotification($posted_data = array())
    {
        if (!empty($posted_data)) {
            $fcm_authorization_key  = "AAAA1x62L-A:APA91bHPEZuPTTVn8tWhggUur4h2_k92s4cRWIu5L9lkRgS2pHtYJKMgCIkg4UcIMui1lWcXRGStyKxjIgrlH7KXefS0CkSS8tlrR0yDWiNRUkeYsNuivIgnV2rgep6QCmQL75-QpBTd";
       

            if (!isset($posted_data['title']))
                $posted_data['title'] = 'Notification';

            //     $title = 'New Text';
            // if ( isset($posted_data['title']) && $posted_data['title'] == 'assign-job' )
            //     $title = 'Job Offer Accepted';
            // if ( isset($posted_data['title']) && $posted_data['title'] == 'new-bid' )
            //     $title = 'New Bid Posted';

            $message = array(
                "title"         => $posted_data['title'],
                "body"          => $posted_data['body'],
                "metadata"      => $posted_data['metadata'],
                'detail'        => $posted_data['details']
            );
            // echo '<pre>';print_r($posted_data);echo '</pre>';exit;
            if(isset($posted_data['device_ids'])){
                $message['device_ids'] = $posted_data['device_ids'];
            }

            $fields    = array(
                'registration_ids'      => $posted_data['registration_ids'],
                'priority'                 => 'high',
                'data'                     => $message,
                'notification'          => $message
            );

            $headers    = array(
                'Authorization: key=' . $fcm_authorization_key,
                'Content-Type: application/json',
            );

            #Send Reponse To FireBase Server
            $ch    = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            $response = curl_exec($ch);
            curl_close($ch);

            // ob_flush();

            if ($response === false) {
                $fcm_response['status'] = false;
                // die('Curl failed ' . curl_error());
            } else {
                $fcm_response['status'] = true;
            }

            $fcm_response['response'] = $response;
            return $fcm_response;

            /*
                firebase sample response_object
                <pre>Array
                (
                    [status] => 1
                    [response] => {
                        "multicast_id":3249491517268760704,
                        "success":0,
                        "failure":1,
                        "canonical_ids":0,
                        "results":[
                            {
                                "error":"MessageTooBig"
                            }
                        ]
                    }
                )
                </pre>
            */
        }
    }

    public static function saveUpdateFcmToken($posted_data = array())
    {
        if (isset($posted_data['update_id'])) {
            $data = FcmToken::find($posted_data['update_id']);
        } else {
            $data = new FcmToken;
        }

        if (isset($posted_data['user_id'])) {
            $data->user_id = $posted_data['user_id'];
        }
        if (isset($posted_data['device_id'])) {
            $data->device_id = $posted_data['device_id'];
        }
        if (isset($posted_data['device_token'])) {
            $data->device_token = $posted_data['device_token'];
        }
        if (isset($posted_data['device_type'])) {
            $data->device_type = $posted_data['device_type'];
        }

        $data->save();
        return $data;
    }

    public static function deleteFCM_Token($id = 0, $where = array())
    {
        if($id == 0){
            if (isset($where['user_id_in'])) {
                $data = FcmToken::latest();                
                $data = $data->whereIn('user_id', $where['user_id_in']);
            }
        }else{
            $data = FcmToken::find($id);
        }
        if(isset($data)){
            return $data->delete();
        }else{
            return false;
        }
    }
}

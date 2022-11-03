<?php

   /**
    *  @author  DANISH HUSSAIN <danishhussain9525@hotmail.com>
    *  @link    Author Website: https://danishhussain.w3spaces.com/
    *  @link    Author LinkedIn: https://pk.linkedin.com/in/danish-hussain-285345123
    *  @since   2020-03-01
   **/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailMessage extends Model
{
    use HasFactory;
    
    public static function getEmailMessages($posted_data = array())
    {
        $query = EmailMessage::latest();

        if (isset($posted_data['id'])) {
            $query = $query->where('email_messages.id', $posted_data['id']);
        }
        if (isset($posted_data['subject'])) {
            $query = $query->where('email_messages.subject', $posted_data['subject']);
        }
        if (isset($posted_data['message'])) {
            $query = $query->where('email_messages.message', $posted_data['message']);
        }
 
        $query->select('email_messages.*');
        
        $query->getQuery()->email_messages = null;
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

    public function saveUpdateEmailMessages($posted_data = array())
    {
        if (isset($posted_data['update_id'])) {
            $data = EmailMessage::find($posted_data['update_id']);
        } else {
            $data = new EmailMessage;
        }
        if (isset($posted_data['subject'])) {
            $data->subject = $posted_data['subject'];
        }
        if (isset($posted_data['message'])) {
            $data->message = encrypt($posted_data['message']);
        }
        $data->save();
        return $data->id;
    }
}
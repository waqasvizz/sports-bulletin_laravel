<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailLogs extends Model
{
    use HasFactory;
    public static function getEmailLogs($posted_data = array())
    {
        $query = EmailLogs::latest();

        if (isset($posted_data['id'])) {
            $query = $query->where('email_logs.id', $posted_data['id']);
        }
        if (isset($posted_data['user_id'])) {
            $query = $query->where('email_logs.user_id', $posted_data['user_id']);
        }
        if (isset($posted_data['email'])) {
            $query = $query->where('email_logs.email', $posted_data['email']);
        }
        if (isset($posted_data['email_status'])) {
            $query = $query->where('email_logs.email_status', $posted_data['email_status']);
        }
        $query->select('email_logs.*');

        $query->getQuery()->orders = null;
        if (isset($posted_data['orderBy_email'])) {
            $query->orderBy($posted_data['orderBy_email'], $posted_data['orderBy_value']);
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

    public static function saveUpdateEmailLogs($posted_data = array())
    {
        if (isset($posted_data['update_id'])) {
            $data = EmailLogs::find($posted_data['update_id']);
        } else {
            $data = new EmailLogs;
        }
        if (isset($posted_data['user_id'])) {
            $data->user_id = $posted_data['user_id'];
        }

        if (isset($posted_data['email'])) {
            $data->email = $posted_data['email'];
        }

        if (isset($posted_data['email_message'])) {
            $data->email_message  = $posted_data['email_message'];
        }

        if (isset($posted_data['email_status'])) {
            $data->email_status = $posted_data['email_status'];
        }

        if (isset($posted_data['send_at'])) {
            $data->send_at = $posted_data['send_at'];
        }

        if (isset($posted_data['stop_at'])) {
            $data->stop_at = $posted_data['stop_at'];
        }

        if (isset($posted_data['email_subject'])) {
            $data->email_subject = $posted_data['email_subject'];
        }

        if (isset($posted_data['send_email_after'])) {
            $data->send_email_after = $posted_data['send_email_after'];
        }

        $data->save();
        $data = EmailLogs::getEmailLogs([
            'detail' => true,
            'id' => $data->id,
        ]);
        return $data;
    }
}

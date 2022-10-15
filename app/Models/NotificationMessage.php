<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationMessage extends Model
{
    use HasFactory;
    public static function getNotificationMessage($posted_data = array())
    {
        $query = NotificationMessage::latest();

        if (isset($posted_data['id'])) {
            $query = $query->where('notification_messages.id', $posted_data['id']);
        }
        $query->select('notification_messages.*');

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

    public static function saveUpdateNotificationMessage($posted_data = array())
    {
        if (isset($posted_data['update_id'])) {
            $data = NotificationMessage::find($posted_data['update_id']);
        } else {
            $data = new NotificationMessage;
        }
        if (isset($posted_data['title'])) {
            $data->title = $posted_data['title'];
        }

        if (isset($posted_data['message'])) {
            $data->message = $posted_data['message'];
        }

        $data->save();
        $data = NotificationMessage::getNotificationMessage([
            'detail' => true,
            'id' => $data->id,
        ]);
        return $data;
    }
}

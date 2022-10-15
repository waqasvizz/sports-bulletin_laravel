<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortCode extends Model
{
    use HasFactory;
    public static function getEmailShortCode($posted_data = array())
    {
        $query = ShortCode::latest();

        if (isset($posted_data['id'])) {
            $query = $query->where('short_codes.id', $posted_data['id']);
        }
        if (isset($posted_data['title'])) {
            $query = $query->where('short_codes.title', $posted_data['title']);
        }
 
        $query->select('short_codes.*');
        
        $query->getQuery()->short_codes = null;
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

    public function saveUpdateEmailShortCode($posted_data = array())
    {
        if (isset($posted_data['update_id'])) {
            $data = ShortCode::find($posted_data['update_id']);
        } else {
            $data = new ShortCode;
        }
        if (isset($posted_data['title'])) {
            $data->title = $posted_data['title'];
        }

        $data->save();
        return $data->id;
    }
}

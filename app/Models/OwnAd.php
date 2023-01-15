<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnAd extends Model
{
    use HasFactory;

    // public function setOwnAdDescriptionAttribute($value)
    // {
    //     $this->attributes['own_ad_description'] = encrypt($value);
    // }

    // public function getOwnAdDescriptionAttribute($value)
    // {
    //     return decrypt($value);
    // }

    public function setOwnAdTitleAttribute($value)
    {
        $this->attributes['own_ad_title'] = $value;
        $this->attributes['own_ad_slug'] = str_slug($value);
    }

    public static function getOwnAd($posted_data = array())
    {
        $query = OwnAd::latest();

        if (isset($posted_data['id'])) {
            $query = $query->where('own_ads.id', $posted_data['id']);
        }
        if (isset($posted_data['own_ad_status'])) {
            $query = $query->where('own_ads.own_ad_status', $posted_data['own_ad_status']);
        }
        
        $query->getQuery()->orders = null;
        if (isset($posted_data['orderBy_name']) && isset($posted_data['orderBy_value'])) {
            $query->orderBy($posted_data['orderBy_name'], $posted_data['orderBy_value']);
        } else {
            $query->orderBy('own_ads.id', 'DESC');
        }

        
        if (isset($posted_data['paginate'])) {
            $result = $query->paginate($posted_data['paginate']);
        } else {
            if (isset($posted_data['detail'])) {
                $result = $query->first();
            } else if (isset($posted_data['count'])) {
                $result = $query->count();
            } else if (isset($posted_data['array'])) {
                $result = $query->get()->ToArray();
            } else {
                $result = $query->get();
            }
        }
        
        if(isset($posted_data['printsql'])){
            $result = $query->toSql();
            echo '<pre>';
            print_r($result);
            print_r($posted_data);
            exit;
        }
        return $result;
    }

    public static function saveUpdateOwnAd($posted_data = array(), $where_posted_data = array())
    {
        if (isset($posted_data['update_id'])) {
            $data = OwnAd::find($posted_data['update_id']);
        } else {
            $data = new OwnAd;
        }

        if(isset($where_posted_data) && count($where_posted_data)>0){
            $is_updated = false;
            if (isset($where_posted_data['own_ad_status'])) {
                $is_updated = true;
                $data = $data->where('own_ad_status', $where_posted_data['own_ad_status']);
            }

            if($is_updated){
                return $data->update($posted_data);
            }else{
                return false;
            }
        }
        

        if (isset($posted_data['own_ad_title'])) {
            $data->own_ad_title = $posted_data['own_ad_title'];
        }
        if (isset($posted_data['own_ad_description'])) {
            $data->own_ad_description = $posted_data['own_ad_description'];
        }
        if (isset($posted_data['own_ad_image'])) {
            $data->own_ad_image = $posted_data['own_ad_image'];
        }
        if (isset($posted_data['own_ad_status'])) {
            $data->own_ad_status = $posted_data['own_ad_status'];
        }
        $data->save();
        
        $data = OwnAd::getOwnAd([
            'detail' => true,
            'id' => $data->id
        ]);
        return $data;
    }

    public function deleteOwnAd($id = 0, $where_posted_data = array())
    {
        $is_deleted = false;
        if($id>0){
            $is_deleted = true;
            $data = OwnAd::find($id);
        }else{
            $data = OwnAd::latest();
        }

        if(isset($where_posted_data) && count($where_posted_data)>0){
            if (isset($where_posted_data['own_ad_status'])) {
                $is_deleted = true;
                $data = $data->where('own_ad_status', $where_posted_data['own_ad_status']);
            }
        }
        
        if($is_deleted){
            return $data->delete();
        }else{
            return false;
        }
    }
}
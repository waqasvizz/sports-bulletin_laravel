<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    public function setStaffDescriptionAttribute($value)
    {
        $this->attributes['staff_description'] = encrypt($value);
    }

    public function getStaffDescriptionAttribute($value)
    {
        return decrypt($value);
    }

    public function setStaffTitleAttribute($value)
    {
        $this->attributes['staff_title'] = $value;
        $this->attributes['staff_slug'] = str_slug($value);
    }

    public static function getStaff($posted_data = array())
    {
        $query = Staff::latest();

        if (isset($posted_data['id'])) {
            $query = $query->where('staff.id', $posted_data['id']);
        }
        if (isset($posted_data['staff_status'])) {
            $query = $query->where('staff.staff_status', $posted_data['staff_status']);
        }
        
        $query->getQuery()->orders = null;
        if (isset($posted_data['orderBy_name']) && isset($posted_data['orderBy_value'])) {
            $query->orderBy($posted_data['orderBy_name'], $posted_data['orderBy_value']);
        } else {
            $query->orderBy('staff.id', 'DESC');
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

    public static function saveUpdateStaff($posted_data = array(), $where_posted_data = array())
    {
        if (isset($posted_data['update_id'])) {
            $data = Staff::find($posted_data['update_id']);
        } else {
            $data = new Staff;
        }

        if(isset($where_posted_data) && count($where_posted_data)>0){
            $is_updated = false;
            if (isset($where_posted_data['staff_status'])) {
                $is_updated = true;
                $data = $data->where('staff_status', $where_posted_data['staff_status']);
            }

            if($is_updated){
                return $data->update($posted_data);
            }else{
                return false;
            }
        }
        

        if (isset($posted_data['staff_title'])) {
            $data->staff_title = $posted_data['staff_title'];
        }
        if (isset($posted_data['staff_description'])) {
            $data->staff_description = $posted_data['staff_description'];
        }
        if (isset($posted_data['staff_image'])) {
            $data->staff_image = $posted_data['staff_image'];
        }
        if (isset($posted_data['staff_status'])) {
            $data->staff_status = $posted_data['staff_status'];
        }
        $data->save();
        
        $data = Staff::getStaff([
            'detail' => true,
            'id' => $data->id
        ]);
        return $data;
    }

    public function deleteStaff($id = 0, $where_posted_data = array())
    {
        $is_deleted = false;
        if($id>0){
            $is_deleted = true;
            $data = Staff::find($id);
        }else{
            $data = Staff::latest();
        }

        if(isset($where_posted_data) && count($where_posted_data)>0){
            if (isset($where_posted_data['staff_status'])) {
                $is_deleted = true;
                $data = $data->where('staff_status', $where_posted_data['staff_status']);
            }
        }
        
        if($is_deleted){
            return $data->delete();
        }else{
            return false;
        }
    }
}
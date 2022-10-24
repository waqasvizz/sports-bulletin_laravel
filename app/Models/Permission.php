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
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Permission extends Model
{
    use HasFactory;
    // protected $table = 'permissions';

    // public const Permission_Status_Constants = [
    //     'draft' => 'Draft',
    //     'published' => 'Published',
    // ];

    // public const Permission_Asset_Type_Constants = [
    //     'icon' => 'Icon',
    //     'image' => 'Image',
    // ];

    public function getPermissions($posted_data = array())
    {
        $query = Permission::latest();

        $columns = ['permissions.*'];
        $select_columns = array_merge($columns, []);

        // if (isset($posted_data['without_with']) && $posted_data['without_with']) {}
        // else {
            // $query = $query
            //     ->with('category_details');
        // }

        if (isset($posted_data['id'])) {
            $query = $query->where('permissions.id', $posted_data['id']);
        }
        if (isset($posted_data['title'])) {
            $query = $query->where('permissions.title', 'like', '%' . $posted_data['title'] . '%');
        }
        if (isset($posted_data['status'])) {
            $query = $query->where('permissions.status', 'like', '%' . $posted_data['status'] . '%');
        }

        $query->select('permissions.*');
        
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



    public function saveUpdatePermission($posted_data = array())
    {
        if (isset($posted_data['update_id'])) {
            $data = Permission::find($posted_data['update_id']);
        } else {
            $data = new Permission;
        }

        if (isset($posted_data['title'])) {
            $data->title = $posted_data['title'];
        }
        if (isset($posted_data['url'])) {
            $data->url = $posted_data['url'];
        }
        if (isset($posted_data['slug'])) {
            $data->slug = $posted_data['slug'];
        }
        if (isset($posted_data['sort_order'])) {
            $data->sort_order = $posted_data['sort_order'];
        }
        if (isset($posted_data['status'])) {
            $data->status = $posted_data['status'];
        }
        if (isset($posted_data['asset_type'])) {
            $data->asset_type = $posted_data['asset_type'];
        }
        if (isset($posted_data['asset_value'])) {
            $data->asset_value = $posted_data['asset_value'];
        }

        $data->save();
        return $data->id;
    }

    public function deletePermission($id=0) {
        $data = Permission::find($id);
        
        if ($data)
            return $data->delete();
        else
            return false;
    }
}
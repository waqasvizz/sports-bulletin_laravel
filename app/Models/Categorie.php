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

class Categorie extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $table = 'categories';

    public const Categorie_Constants = [
        'draft' => 'Draft',
        'published' => 'Published',
    ];

    public function getCategories($posted_data = array())
    {
        $query = Categorie::latest();

        $columns = ['categories.*'];
        $select_columns = array_merge($columns, []);

        // if (isset($posted_data['without_with']) && $posted_data['without_with']) {}
        // else {
            // $query = $query
            //     ->with('category_details');
        // }

        if (isset($posted_data['id'])) {
            $query = $query->where('categories.id', $posted_data['id']);
        }
        if (isset($posted_data['title'])) {
            $query = $query->where('categories.title', 'like', '%' . $posted_data['title'] . '%');
        }
        if (isset($posted_data['status'])) {
            $query = $query->where('categories.status', 'like', '%' . $posted_data['status'] . '%');
        }

        $query->select('categories.*');
        
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



    public function saveUpdateCategorie($posted_data = array())
    {
        if (isset($posted_data['update_id'])) {
            $data = Categorie::find($posted_data['update_id']);
        } else {
            $data = new Categorie;
        }

        if (isset($posted_data['title'])) {
            $data->title = $posted_data['title'];
        }
        if (isset($posted_data['sort_order'])) {
            $data->sort_order = $posted_data['sort_order'];
        }
        if (isset($posted_data['status'])) {
            $data->status = $posted_data['status'];
        }
        if (isset($posted_data['image'])) {
            $data->image = $posted_data['image'];
        }

        $data->save();
        return $data->id;
    }

    public function deleteCategorie($id=0) {
        $data = Categorie::find($id);
        
        if ($data)
            return $data->delete();
        else
            return false;
    }
}
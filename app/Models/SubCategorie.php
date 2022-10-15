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

class SubCategorie extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $table = 'categories';
   
    public const SubCategorie_Constants = [
        'draft' => 'Draft',
        'published' => 'Published',
    ];

    public function category_details()
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }

    public static function getSubCategories($posted_data = array())
    {
        $query = SubCategorie::latest();

        $columns = ['sub_categories.*'];
        $select_columns = array_merge($columns, []);

        if (isset($posted_data['without_with']) && $posted_data['without_with']) {}
        else {
            $query = $query
                ->with('category_details');
        }

        if (isset($posted_data['id'])) {
            $query = $query->where('sub_categories.id', $posted_data['id']);
        }
        if (isset($posted_data['category_id'])) {
            $query = $query->where('sub_categories.category_id', $posted_data['category_id']);
        }
        if (isset($posted_data['title'])) {
            $query = $query->where('sub_categories.title', 'like', '%' . $posted_data['title'] . '%');
        }
        if (isset($posted_data['status'])) {
            $query = $query->where('sub_categories.status', $posted_data['status']);
        }

        $query->select('sub_categories.*');
        
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


    public function saveUpdateSubCategorie($posted_data = array())
    {
        if (isset($posted_data['update_id'])) {
            $data = SubCategorie::find($posted_data['update_id']);
        } else {
            $data = new SubCategorie;
        }

        if (isset($posted_data['title'])) {
            $data->title = $posted_data['title'];
        }
        if (isset($posted_data['category_id'])) {
            $data->category_id = $posted_data['category_id'];
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


    public function deleteSubCategorie($id=0) {
        $data = SubCategorie::find($id);
        
        if ($data)
            return $data->delete();
        else
            return false;
    }
}
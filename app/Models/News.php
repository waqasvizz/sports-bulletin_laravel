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

class News extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $table = 'news';

    public const News_Status_Constants = [
        'draft' => 'Draft',
        'published' => 'Published',
    ];

    public function category()
    {
        return $this->belongsTo(Categorie::class, 'categories_id');
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategorie::class, 'sub_categories_id');
    }

    public function getNews($posted_data = array())
    {
        $query = News::latest();
        $query = $query->with('category')->with('sub_category');

        $columns = ['news.*'];
        $select_columns = array_merge($columns, []);
 

        if (isset($posted_data['id'])) {
            $query = $query->where('news.id', $posted_data['id']);
        }
        if (isset($posted_data['title'])) {
            $query = $query->where('news.title', 'like', '%' . $posted_data['title'] . '%');
        }
        if (isset($posted_data['status'])) {
            $query = $query->where('news.status', 'like', '%' . $posted_data['status'] . '%');
        }

        $query->select('news.*');
        
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



    public function saveUpdateNews($posted_data = array())
    {
        if (isset($posted_data['update_id'])) {
            $data = News::find($posted_data['update_id']);
        } else {
            $data = new News;
        }

        if (isset($posted_data['title'])) {
            $data->title = $posted_data['title'];
        }
        if (isset($posted_data['categories_id'])) {
            $data->categories_id = $posted_data['categories_id'];
        }
        if (isset($posted_data['sub_categories_id'])) {
            $data->sub_categories_id = $posted_data['sub_categories_id'];
        }
        if (isset($posted_data['status'])) {
            $data->status = $posted_data['status'];
        }
        if (isset($posted_data['news_date'])) {
            $data->news_date = $posted_data['news_date'];
        }
        if (isset($posted_data['image_path'])) {
            $data->image_path = $posted_data['image_path'];
        }
        if (isset($posted_data['news_description'])) {
            $data->news_description = encrypt($posted_data['news_description']);
        }

        $data->save();
        return $data->id;
    }

    public function deleteNews($id=0) {
        $data = News::find($id);
        
        if ($data)
            return $data->delete();
        else
            return false;
    }
}
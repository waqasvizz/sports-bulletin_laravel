<?php
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


    public function category()
    {
        return $this->belongsTo(Categorie::class, 'categories_id');
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategorie::class, 'sub_categories_id');
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['news_slug'] = str_slug($value);
    }

    public function setNewsDescriptionAttribute($value)
    {
        $this->attributes['news_description'] = encrypt($value);
    }

    public function getNewsDescriptionAttribute($value)
    {
        return decrypt($value);
    }


    public static function getNews($posted_data = array())
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
        if (isset($posted_data['news_slug'])) {
            $query = $query->where('news.news_slug', 'like', '%' . $posted_data['news_slug'] . '%');
            // $query = $query->where('news.news_slug', $posted_data['news_slug']);
        }
        if (isset($posted_data['last_30_days'])) {
            $query = $query->where('news.created_at', '>', now()->subDays(30)->endOfDay());
            $query = $query->where('news.news_date', '>', now()->subDays(30)->endOfDay());

            // echo '<pre>';print_r(now()->subDays(30)->endOfDay());echo '</pre>';
        }
        if (isset($posted_data['category_slug'])) {
            $query = $query->where('categories.slug', $posted_data['category_slug']);
        }
        if (isset($posted_data['sub_category_slug'])) {
            $query = $query->where('sub_categories.slug', $posted_data['sub_category_slug']);
        }
        if (isset($posted_data['category_id'])) {
            $query = $query->where('categories.id', $posted_data['category_id']);
        }
        if (isset($posted_data['sub_category_id'])) {
            $query = $query->where('sub_categories.id', $posted_data['sub_category_id']);
        }

        $query->select('news.*');
        $query->join('categories', 'categories.id', '=' ,'news.categories_id');
        $query->join('sub_categories', 'sub_categories.id', '=' ,'news.sub_categories_id');
        
        $query->getQuery()->orders = null;
        if (isset($posted_data['orderBy_name']) && isset($posted_data['orderBy_value'])) {
            $query->orderBy($posted_data['orderBy_name'], $posted_data['orderBy_value']);
        } else {
            $query->orderBy('id', 'DESC');
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
        
        if(isset($posted_data['printsql'])){
            $result = $query->toSql();
            echo '<pre>';
            print_r($result);
            print_r($posted_data);
            exit;
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

        if (isset($posted_data['id'])) {
            $data->id = $posted_data['id'];
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
            $data->news_description = $posted_data['news_description'];
        }
        if (isset($posted_data['views'])) {
            $data->views = $posted_data['views'];
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
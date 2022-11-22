<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public function setBlogDescriptionAttribute($value)
    {
        $this->attributes['blog_description'] = encrypt($value);
    }

    public function getBlogDescriptionAttribute($value)
    {
        return decrypt($value);
    }

    public function setBlogTitleAttribute($value)
    {
        $this->attributes['blog_title'] = $value;
        $this->attributes['blog_slug'] = str_slug($value);
    }

    public static function getBlog($posted_data = array())
    {
        $query = Blog::latest();

        if (isset($posted_data['id'])) {
            $query = $query->where('blogs.id', $posted_data['id']);
        }
        if (isset($posted_data['blog_status'])) {
            $query = $query->where('blogs.blog_status', $posted_data['blog_status']);
        }
        
        $query->getQuery()->orders = null;
        if (isset($posted_data['orderBy_name']) && isset($posted_data['orderBy_value'])) {
            $query->orderBy($posted_data['orderBy_name'], $posted_data['orderBy_value']);
        } else {
            $query->orderBy('blogs.id', 'DESC');
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

    public static function saveUpdateBlog($posted_data = array(), $where_posted_data = array())
    {
        if (isset($posted_data['update_id'])) {
            $data = Blog::find($posted_data['update_id']);
        } else {
            $data = new Blog;
        }

        if(isset($where_posted_data) && count($where_posted_data)>0){
            $is_updated = false;
            if (isset($where_posted_data['blog_status'])) {
                $is_updated = true;
                $data = $data->where('blog_status', $where_posted_data['blog_status']);
            }

            if($is_updated){
                return $data->update($posted_data);
            }else{
                return false;
            }
        }
        

        if (isset($posted_data['blog_title'])) {
            $data->blog_title = $posted_data['blog_title'];
        }
        if (isset($posted_data['blog_description'])) {
            $data->blog_description = $posted_data['blog_description'];
        }
        if (isset($posted_data['blog_image'])) {
            $data->blog_image = $posted_data['blog_image'];
        }
        if (isset($posted_data['blog_status'])) {
            $data->blog_status = $posted_data['blog_status'];
        }
        $data->save();
        
        $data = Blog::getBlog([
            'detail' => true,
            'id' => $data->id
        ]);
        return $data;
    }

    public function deleteBlog($id = 0, $where_posted_data = array())
    {
        $is_deleted = false;
        if($id>0){
            $is_deleted = true;
            $data = Blog::find($id);
        }else{
            $data = Blog::latest();
        }

        if(isset($where_posted_data) && count($where_posted_data)>0){
            if (isset($where_posted_data['blog_status'])) {
                $is_deleted = true;
                $data = $data->where('blog_status', $where_posted_data['blog_status']);
            }
        }
        
        if($is_deleted){
            return $data->delete();
        }else{
            return false;
        }
    }
}
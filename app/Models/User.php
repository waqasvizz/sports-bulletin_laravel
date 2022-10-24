<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
// use Laravel\Sanctum\HasApiTokens;
use Carbon;
use Laravel\Passport\HasApiTokens;
use DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    /*
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];
    */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // public function Role()
    // {
    //     return $this->belongsTo(Role::class, 'role')
    //         ->select(['id', 'name']);
    // }
    public function getUserStatusAttribute($value)
    {
        $status ='';
        if($value == 1){
            $status = 'Active';
        }
        else if($value == 2){
            $status = 'Block';
        }
        return $status;
    }

    public static function getUser($posted_data = array())
    {
        $query = User::latest();
        
        // if (!isset($posted_data['comma_separated_ids'])) {
        //     $query = $query->with('Role');
        // }

        if (isset($posted_data['id'])) {
            $query = $query->where('users.id', $posted_data['id']);
        }
        if (isset($posted_data['email'])) {
            $query = $query->where('users.email', $posted_data['email']);
        }
        if (isset($posted_data['name'])) {
            $query = $query->where('users.name', 'like', '%' . $posted_data['name'] . '%');
        }
        if (isset($posted_data['roles'])) {
            $query = $query->whereHas("roles", function($qry) use ($posted_data) {
                        $qry->where("name", $posted_data['roles']);
                    });
        }
	    if (isset($posted_data['phone_number'])) {
            $query = $query->where('users.phone_number', $posted_data['phone_number']);
        }
        if (isset($posted_data['status'])) {
            $query = $query->where('users.user_status', $posted_data['status']);
        }
        if (isset($posted_data['last_seen'])) {
            $query = $query->where('users.last_seen', $posted_data['last_seen']);
        }
        if (isset($posted_data['time_spent'])) {
            $query = $query->where('users.time_spent', $posted_data['time_spent']);
        }
        if (isset($posted_data['theme_mode'])) {
            $query = $query->where('users.theme_mode', $posted_data['theme_mode']);
        }
        if (isset($posted_data['login_having_thirty_minutes'])) {
            $query = $query->where('users.last_seen','<=', $posted_data['login_having_thirty_minutes']);
        }
        if (isset($posted_data['comma_separated_ids'])) {
            $query = $query->selectRaw("GROUP_CONCAT(id) as ids");
            $posted_data['detail'] = true;
        }
        // if (isset($posted_data['created_at'])) {
        //     $query = $query->where('created_at', $posted_data['created_at']);
        // }
        
        $query->getQuery()->orders = null;
        if (isset($posted_data['orderBy_name'])) {
            $query->orderBy($posted_data['orderBy_name'], $posted_data['orderBy_value']);
        } else {
            $query->orderBy('users.id', 'ASC');
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
        // echo '<pre>';
        // print_r($result->toSql());
        // exit;
        return $result;
    }

    public static function saveUpdateUser($posted_data = array())
    {
        if (isset($posted_data['update_id'])) {
            $data = User::find($posted_data['update_id']);
        } else {
            $data = new User;
        }

        if (isset($posted_data['first_name'])) {
            $data->first_name = $posted_data['first_name'];
        }
        if (isset($posted_data['last_name'])) {
            $data->last_name = $posted_data['last_name'];
        }
        if (isset($posted_data['email'])) {
            $data->email = $posted_data['email'];
        }
        if (isset($posted_data['password'])) {
            $data->password = Hash::make($posted_data['password']);
        }
        // if (isset($posted_data['role'])) {
        //     $data->role = $posted_data['role'];
        // }
        
        if (isset($posted_data['profile_image'])) {
            $data->profile_image = $posted_data['profile_image'];
        }
        if (isset($posted_data['user_status'])) {
            $data->user_status = $posted_data['user_status'];
        }
        if (isset($posted_data['last_seen'])) {
            $data->last_seen = $posted_data['last_seen'];
        }
        if (isset($posted_data['time_spent'])) {
            $data->time_spent = $posted_data['time_spent'];
        }
        if (isset($posted_data['theme_mode'])) {
            $data->theme_mode = $posted_data['theme_mode'];
        }
        $data->save();
        return $data;
    }

    // public function deleteUser($id=0)
    // {
    //     $data = User::find($id);
    //     return $data->delete();
    // }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * SystemName : bulletinboard
 * ModuleName : User
 */
class User extends Authenticatable
{
    use SoftDeletes,Notifiable;

    /**
     * The table associated with the model
     *
     * @var string
    */
    protected $table = 'users';
    protected $dates = ['deleted_at'];

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['name', 'email', 'password', 'profile', 'type', 'phone', 'address', 'dob',
    'create_user_id', 'updated_user_id', 'deleted_user_id', 'created_at', 'updated_at', 'deleted_at'];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }
    
    public function users(){
        return $this->belongsTo( User::class , 'create_user_id');
    }

    public function updateUsers(){
        return $this->belongsTo( User::class , 'updated_user_id');
    } 
}

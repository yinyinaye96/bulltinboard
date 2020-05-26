<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'posts';

    // protected $dates = ['deleted_at'];

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['title', 'description', 'status','create_user_id',
    'updated_user_id', 'deleted_user_id', 'created_at', 'updated_at', 'deleted_at'];

    
    public function users(){
        return $this->belongsTo( User::class , 'create_user_id');
    }

    public function updateUsers(){
        return $this->belongsTo( User::class , 'updated_user_id');
    } 
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','movie_id','comment','rating'];

    public  function user_info(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Detail extends Model
{
    protected $fillable = [
        'username','first_name','last_name','gender','password','status'
    ];
    protected $table = 'user_details';
    public $timestamps = true;

}
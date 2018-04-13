<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class updateInfo extends Model
{
	protected $table = 'profile_img';
	
    protected $connection = 'mysql';
    protected $primaryKey = 'img_id';
  
    protected $fillable = ['user_id','user_name','img_location',];

    public $timestamps = true;
}

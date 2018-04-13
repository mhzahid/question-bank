<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class updateUserInfo extends Model
{
   	protected $table = 'users';
	
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
  
    protected $fillable = ['email','email_public','mobile','mobile_public','gender','address','address_public','department','batch','batch_public','attending','attending_public','hobby','hobby_public','skills','quote',];

    public $timestamp = true;
}

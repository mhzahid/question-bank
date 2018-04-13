<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class answer extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'cm_id';
    protected $table = 'answer';
    protected $fillable = [
    	'ans_content', 'author', 'q_id', 'subject',
    ];

    public $timestamp = true;
    public $timestamps = false;
}

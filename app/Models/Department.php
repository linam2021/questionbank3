<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    use HasFactory;


    protected $fillable = ['department_name'];



    public function course()
    {
    	return $this->hasMany('App\Models\Course', 'department_id','id');
    }


}

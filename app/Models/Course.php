<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;


    protected $fillable = [ 'course_name','course_url', 'department_id'];


    public function primary_question ()
    {
    	return $this->hasMany('App\Models\Primary_question', 'course_id','id');
    }



    public function department()
    {
    	return $this->belongsTo('App\Models\Department', 'department_id','id');
    }

}

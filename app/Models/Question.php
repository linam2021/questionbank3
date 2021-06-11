<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_text',
        'question_image',
        'answer_a',
        'answer_b',
        'answer_c',
        'correct_answer',
        'user_id',
        'video_number',
        'question_level',
        'primary_question_id',
        'course_id'
    ];

    public function sub_question ()
    {
    	return $this->hasOne('App\Models\Question', 'primary_question_id','id');
    }

    public function primary_question()
    {
    	return $this->belongsTo('App\Models\Question', 'primary_question_id','id');
    }

    public function user ()
    {
    	return $this->belongsTo('App\Models\User', 'user_id' ,'id');
    }


    public function course()
    {
    	return $this->belongsTo('App\Models\Primary_question ', 'course_id','id');
    }
}

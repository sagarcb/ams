<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'course_code','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class,'course_id','id');
    }
}

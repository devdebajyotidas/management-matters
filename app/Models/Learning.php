<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Learning extends Model
{
    use softDeletes;

    protected $fillable = [
        'title',
        'description',
        'introduction',
        'highlights',
        'chapters',
        'assessments',
        'quiz',
        'image'
    ];

    protected $casts = [
        'chapters' => 'array',
        'assessments' => 'array',
        'quiz' => 'array',
    ];

    public function assessments()
    {
        return $this->hasMany('App\Models\Assessment');
    }

    public function getHighlightsAttribute($value)
    {
        if(!is_array($value))
        {
            return explode(',',$value);
        }

        return $value;
    }

    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    public function quizTaken()
    {
        return $this->hasMany('App\Models\Quiz');
    }
}

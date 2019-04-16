<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentInvitation extends Model
{
    protected $fillable =[
        'assessment_id',
        'email',
        'name',
        'token',
        'has_taken'
    ];

    public function assessmentSet(){
        return $this->belongsTo(AssessmentSet::class, 'assessment_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentStatement extends Model
{
    protected  $fillable = [
        'assessment_id',
        'assessee_statement',
        'assessor_statement',
        'type',
        'module'
    ];

    public function assessmentSet()
    {
        return $this->belongsTo(AssessmentSet::class, 'assessment_id', 'id');
    }

    public function results()
    {
        $this->hasMany(AssessmentResult::class, 'statement_id', 'id');
    }
}

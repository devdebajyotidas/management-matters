<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentSet extends Model
{
    protected $fillable = [
        'organization_id',
        'assessor_id',
        'score',
        'reference'
    ];

    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function statements(){
        return $this->hasMany(AssessmentStatement::class, 'assessment_id', 'id');
    }

    public function assessor(){
        return $this->belongsTo(User::class, 'assessor_id', 'id');
    }

    public function assessorStatements(){
        return $this->hasMany(AssessmentStatement::class, 'assessment_id', 'id')->where('type', 1);
    }

    public function assesseeStatements(){
        return $this->hasMany(AssessmentStatement::class, 'assessment_id', 'id')->where('type', 2);
    }

    public function shares(){
        return $this->hasMany(AssessmentInvitation::class, 'assessment_id', 'id');
    }
}

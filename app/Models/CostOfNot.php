<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CostOfNot extends Model
{
    protected $table = 'cost_of_not';

    protected $fillable = [
        'learner_id',
        'name',
        'hourly_wage',
        'emp_num',
        'lost_hours',
        'total',
    ];

    public static $rules = [
        'create' => [
            'learner_id',
            'name',
            'hourly_wage',
            'emp_num',
            'lost_hours',
            'total'=>'required'
        ],
    ];

    public function learner()
    {
        return $this->belongsTo('App\Models\Learner');
    }
}

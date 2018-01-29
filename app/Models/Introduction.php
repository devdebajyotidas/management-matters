<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Introduction extends Model
{
    protected $table = 'organization_introduction';

    protected $fillable = [
        'organization_id',
        'learning_id',
        'org_introduction'
    ];

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }

    public function learning()
    {
        return $this->belongsTo('App\Models\Learning');
    }
}

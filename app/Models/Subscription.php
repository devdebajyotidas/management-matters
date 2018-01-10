<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Subscription extends Model implements AuditableContract
{
    use SoftDeletes;
    use Auditable;

    protected $fillable = [
        'account_id',
        'account_type',
        'transaction_id',
        'start_date',
        'billing_interval',
        'licenses',
        'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static $rules = [
        'create' => [
            'start_date' => 'required',
            'billing_interval' => 'required',
            'licenses' => 'required',
            'status' => 'required'
        ],
        'update' => [
        ]
    ];

    public function account()
    {
        return $this->morphTo('account');
    }

}

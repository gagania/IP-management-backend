<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditTrails extends Model
{
    public $timestamps = false;
    
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    protected $fillable = ['user_id', 'action','ip','label','modify_date'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessLogs extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'log_date'];
}

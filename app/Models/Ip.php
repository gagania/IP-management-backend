<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    protected $fillable = ['ip', 'label','create_at','update_at'];
}

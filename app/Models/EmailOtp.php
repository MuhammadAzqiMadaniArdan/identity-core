<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class EmailOtp extends Model
{
    use HasUuids;
    
    protected $fillable = ["email","code_hash","expires_at"];
}

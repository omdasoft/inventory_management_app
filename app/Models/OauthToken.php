<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OauthToken extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function hasExpired()
    {
         return now()->timestamp > $this->expires_in;
    }
}

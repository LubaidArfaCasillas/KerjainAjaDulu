<?php

// ================================================================
// FILE: app/Models/UserSetting.php
// ================================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $fillable = ['user_id', 'settings'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
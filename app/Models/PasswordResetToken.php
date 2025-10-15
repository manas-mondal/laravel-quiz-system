<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
   use HasFactory;

    protected $table = 'password_reset_tokens';

    // Primary key is 'id'
    protected $primaryKey = 'id';

    public $timestamps = false; // created_at manually set, no updated_at

    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];
}

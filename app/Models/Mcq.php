<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mcq extends Model
{
    protected $fillable = ['question','option_a','option_b','option_c','option_d','correct_option','admin_id','category_id','quiz_id'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}

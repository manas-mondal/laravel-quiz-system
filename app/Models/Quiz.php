<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['name','category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function mcqs()
    {
        return $this->hasMany(Mcq::class);
    }

    public function records()
    {
        return $this->hasMany(Record::class);
    }
}

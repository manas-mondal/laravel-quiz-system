<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McqRecord extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'record_id',
        'mcq_id',
        'selected_answer',
        'is_correct',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function record(){
        return $this->belongdTo(Record::class);
    }

    public function mcq(){
        return $this->belongsTo(Mcq::class);
    }
}

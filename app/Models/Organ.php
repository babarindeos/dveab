<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organ extends Model
{
    use HasFactory;

    protected $fillable = ['segment_id', 'parent', 'name', 'code'];

    public function parent_organ()
    {
        return $this->belongsTo(Organ::class,'parent','id');
    }
}

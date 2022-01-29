<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SecondaryCategory;

class PrimaryCategory extends Model
{
    use HasFactory;


    public function secondary()
    {
        //　20220129
        return $this->hasMany(SecondaryCategory::class);
    }
}

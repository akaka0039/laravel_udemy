<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Owner;
use App\Models\Product;


class Shop extends Model
{
    use HasFactory;

    // 20220122_add
    protected $fillable = [
        'owner_id',
        'name',
        'information',
        'filename',
        'is_selling',
    ];

    // belongsTo
    // 従テーブルの複数レコードに対して、主テーブルの1つのレコードが紐付けられる
    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    // hasMany
    // 主テーブルのあるレコードに対して、従テーブルの複数のレコードが紐付けられる
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}

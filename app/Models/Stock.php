<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    // $table でテーブル名を指定する
    // 例えば、モデル名がItemという名前の場合、初期状態ではitemsというDBテーブルが参照されるようになっています。
    // ただ、もしかすると過去に作られたテーブルを参照したい場合や、もしくは別システムのテーブルを参照する場合もあるかもしれません。
    // その場合、以下のように$tableを指定すると自動でそちらを参照するようになります。
    protected $table = 't_stocks';

    protected $fillable = [
        'product_id',
        'type',
        'quantity'
    ];
}

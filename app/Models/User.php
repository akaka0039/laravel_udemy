<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Product;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // *****各機能一覧**************************
    // $guarded でフィールドへの代入を拒否する

    // $dispatchesEvents で各イベントを設定する

    // $visible でデータ取得するフィールドを指定する

    // $perPage でpaginate()のデフォルト件数を変更する
    // ***************************************

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // $fillable でフィールドへの代入を許可する
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    // $hidden でデータ取得しないフィールドを指定する
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // $casts でデータを自動変換する
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function products()
    {
        return $this->belongsToMany(Product::class, 'carts')
            ->withPivot((['id', 'quantity']));
        // 第2引数で中間テーブル名
        // 中間テーブルのカラム取得
        // デフォルトでは関連付けるカラム(user_idと
        // product_id)のみ取得 
    }
}

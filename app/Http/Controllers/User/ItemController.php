<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;

use Illuminate\Support\Facades\DB;




class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:users');

        $this->middleware(function ($request, $next) {

            $id = $request->route()->parameter('item'); //文字列

            if (!is_null($id)) {
                $itemId = Product::availableItems()->where('product_id', $id)->exists();

                if (!$itemId) {
                    abort(404);
                }
            }
            return $next($request);
        });
    }


    public function index()
    {
        // クエリビルダ（phpの書き方でDBデータ取得）
        // 戻り値はコレクション

        // Eloquent（エロクアント）（laravelのORM（オブジェクト関係マッピング））
        // Eloquentモデルオブジェクト

        $products = Product::availableItems()->get();

        //dd($stocks, $products);
        //$products = Product::all();

        return view(
            'user.index',
            compact('products')
        );
    }

    public function show($id)
    {

        $product = Product::findOrFail($id);
        $quantity = Stock::where('product_id', $product->id)
            ->sum('quantity');

        if ($quantity > 9) {
            $quantity = 9;
        }

        return view('user.show', compact('product', 'quantity'));
    }
}

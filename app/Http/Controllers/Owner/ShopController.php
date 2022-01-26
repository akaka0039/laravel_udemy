<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

use App\Models\Shop;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;

class ShopController extends Controller
{
    // 20220124_ownerアカウントでログインしているかどうかを確認する
    public function __construct()
    {
        $this->middleware('auth:owners');

        // クロージャー
        $this->middleware(function ($request, $next) {
            $id = $request->route()->parameter('shop'); //文字列

            if (!is_null($id)) {
                $shopsOwnerId = Shop::findOrFail($id)->owner->id;
                $shopId = (int)$shopsOwnerId; // キャスト
                $ownerId = \Auth::id(); //数字
                if ($shopId !== $ownerId) {
                    abort(404);
                }
            }
            return $next($request);
        });
    }

    public function index()
    {

        //  ログインしたオーナーのIDを取得をする
        $shops = Shop::where('owner_id', \Auth::id())->get();

        return view(
            'owner.shops.index',
            compact('shops')
        );
    }



    public function edit($id)
    {
        // dd(Shop::findOrFail($id));

        $shop = Shop::findOrFail($id);
        return view(
            'owner.shops.edit',
            compact('shop')
        );
    }

    public function update(UploadImageRequest $request, $id)
    {
        // バリエーション
        $request->validate([
            'name' => 'required', 'string', 'max:50',
            'information' => 'required', 'string', 'max:1000',
            'is_selling' => 'required',
        ]);

        $imageFile = $request->image;
        if (!is_null($imageFile) && $imageFile->isValid()) {
            //Storage::putFile('public/shops', $imageFile); リサイズなしの場合
            $fileNameToStore = ImageService::upload($imageFile, 'shops');
        }

        // 20220125＿インスタンスを生成して各インスタンスに保存していく
        $shop = Shop::findOrFail($id);
        $shop->name = $request->name;
        $shop->information = $request->information;
        $shop->is_selling = $request->is_selling;

        // リクエストに画像が存在する場合
        if (!is_null($imageFile) && $imageFile->isValid()) {
            $shop->filename = $fileNameToStore;
        }

        $shop->save();

        return redirect()->route('owner.shops.index')->with([
            'message' => '店舗情報を更新しました。',
            'status' => 'info'
        ]);;
    }
}

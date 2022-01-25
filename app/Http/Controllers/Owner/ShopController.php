<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

use App\Models\Shop;
use Illuminate\Support\Facades\Storage;

use InterventionImage;
use App\Http\Requests\UploadImageRequest;

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
        $imageFile = $request->image;
        if (!is_null($imageFile) && $imageFile->isValid()) {

            //Storage::putFile('public/shops', $imageFile); リサイズなしの場合

            //ランダムなファイル名を作成
            $fileName = uniqid(rand() . '_');
            // 拡張子取得
            $extension = $imageFile->extension();
            $fileNameToStore = $fileName . '.' . $extension;

            $resizedImage = InterventionImage::make($imageFile)->resize(1920, 1080)->encode();
            Storage::put(
                'public/shops/' . $fileNameToStore,
                $resizedImage
            );
        }

        return redirect()->route('owner.shops.index');
    }
}

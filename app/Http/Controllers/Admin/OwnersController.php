<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// QueryBuilder
use Illuminate\Support\Facades\DB;

// Eloquent
use App\Models\Owner;

// Carbon
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Throwable;
use App\Models\Shop;
use Illuminate\Support\Facades\Log;



class OwnersController extends Controller
{


    /**
     * 新しいUserControllerインスタンスの生成
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // 20220117_add_Carbon
        // $date_now = Carbon::now();
        // $date_parse = Carbon::parse(now());
        // echo $date_now;
        // echo $date_parse;


        // 20220117_add
        // $e_all = Owner::all();
        // $q_get = DB::table('owners')->select('name', 'created_at')->get();
        // // $q_first = DB::table('owners')->select('name')->first();

        // $c_test = collect([
        //     'name' => 'テスト'
        // ]);

        // var_dump($q_first);

        // ddでどこの呼び出しの型か分かる
        // dd($e_all, $q_get, $q_first, $c_test);
        // return view('admin.owners.index', compact('e_all', 'q_get'));

        // 20220118_add

        $owners = Owner::select('id', 'name', 'email', 'created_at')->paginate(3);

        return view('admin.owners.index', compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.owners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$request->name;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:owners'],
            'password' => ['required', 'confirmed', 'string', 'min:8'],
        ]);

        try {
            DB::transaction(function ()  use ($request) {
                $owner = Owner::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);

                Shop::create([
                    'owner_id' => $owner->id,
                    'name' => '店名を入力してください',
                    'information' => '',
                    'filename' => '',
                    'is_selling' => true,
                ]);
            }, 2);
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return Redirect()
            ->route('admin.owners.index')
            ->with([
                'message' => 'オーナー登録を実施いたしました。',
                'status' => 'info'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $owner = Owner::findOrFail($id);
        //dd($owner);

        return view('admin.owners.edit', compact('owner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //　20220119
        // idを元にしてインスタンス生成を可能とする
        $owner = Owner::findOrFail($id);
        $owner->name = $request->name;
        $owner->email = $request->email;
        $owner->password = Hash::make($request->password);
        $owner->save();

        return redirect()->route('admin.owners.index')
            ->with([
                'message' => 'オーナー情報を更新しました。',
                'status' => 'info'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd('削除処理');

        // 20220121_ソフトデリート
        Owner::findOrFail($id)->delete();

        return redirect()
            ->route('admin.owners.index')
            ->with([
                'message' => 'オーナー情報を削除しました。',
                'status' => 'alert'
            ]);
    }

    /**
     * 期限切れオーナーの情報を取得する
     *
     * @return \Illuminate\Http\Response
     */
    public function expiredOwnerIndex()
    {
        // ソフトデリートしたものだけを取得することができる
        $expiredOwners = Owner::onlyTrashed()->get();
        return view(
            'admin.expired-owners',
            compact('expiredOwners')
        );
    }

    /**
     * 期限切れオーナーの情報を削除する
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function expiredOwnerDestroy($id)
    {
        Owner::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()
            ->route('admin.expired-owners.index');
    }
}

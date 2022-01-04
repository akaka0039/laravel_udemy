<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    // 20220104_add_ログイン画面表示？_RouteServiceProviderで設定したものと関連する
    protected $user_route = 'user.login';
    protected $owner_route = 'owner.login';
    protected $admin_route = 'admin.login';

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        //20220104_add
        if (!$request->expectsJson()) {
            //the person who want to login as owner
            if (Route::is('owner.*')) {
                return route($this->owner_route);
            }
            //the person who want to login as admin
            elseif (Route::is('admin.*')) {
                return route($this->admin_route);
            }
            //the person who want to login as user
            else {
                return route($this->user_route);
            }
        }
    }
}

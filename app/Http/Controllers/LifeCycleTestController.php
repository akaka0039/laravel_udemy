<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Encryption\EncryptionServiceProvider;

class LifeCycleTestController extends Controller
{
    //20211101_service_Provider
    public function showServiceProviderTest()
    {
        $encrypt = app()->make('encrypter');

        //encrypt = パスワードを暗号化するもの
        $password = $encrypt->encrypt('password');

        //20211203_add_サービスプロバイダテスト
        $sample = app()->make('serviceProviderTest');



        dd($sample, $password, $encrypt->decrypt($password));
    }



    //20211031_container
    public function showServiceContainerTest()
    {

        app()->bind('lifeCycleTest', function () {
            return 'Test for LifeCycle';
        });

        //サービスコンテナから取り出し
        $test = app()->make('lifeCycleTest');

        //サービスコンテナなしのパターン
        // $message = new Message();
        // $sample = new Sample($message);
        // $sample->run();

        //サービスコンテナapp()ありのパターン
        //インスタンスの依存関係を簡略化
        //
        app()->bind('sample', sample::class);
        $sample = app()->make('sample');
        $sample->run();

        dd($test, app());
    }
}

class sample
{

    public $message;
    public function __construct(Message $message)
    {
        $this->message = $message;
    }
    public function run()
    {
        $this->message->send();
    }
}

class Message
{
    public function send()
    {
        echo ('show Message');
    }
}

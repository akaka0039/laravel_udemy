<?php

//20211024_add

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentTestController extends Controller
{

    public function showComponent1()
    {
        // 20211029_add
        $message = 'message in test123';

        //test.component-test1 = directory hierarchy.file's name
        return view(
            'tests.component-test1',
            compact('message')
        );
    }

    public function showComponent2()
    {
        return view('tests.component-test2');
    }
}

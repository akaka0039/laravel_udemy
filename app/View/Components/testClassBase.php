<?php

// 20211030_componentClass

namespace App\View\Components;

use Illuminate\View\Component;

class testClassBase extends Component
{
    //20211031_クラスベースで、componentの値の渡し方
    public $classBaseMessage;
    public $defaultMessage;
    /**
     * Create a new component instance.
     *
     * @return void
     */


     //20211031_クラスベースで、componentの値の渡し方
     //今回はコンストラクタに記述しているが、renderに記述することもできるらしい？
    public function __construct($classBaseMessage, $defaultMessage="初期値です")
    {
        $this->classBaseMessage = $classBaseMessage;
        $this->defaultMessage = $defaultMessage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tests.test-class-base-component');
    }
}


{{-- 20211029_初期値＿viewに変数を引き渡す際、その変数に値が入ってこなくてもエラーにならない_変数それぞれに設定しないといけない --}}
@props([
    'title',
    'message' => '初期値です',
    'content' => '本文初期値です'
])


<div class="border-2 shadow-md w-1/4 p-2">
    <div>{{ $title }}</div>
    <div>画像</div>
    <div>{{ $content }} </div>
    <div>{{ $message }}</div>
</div>
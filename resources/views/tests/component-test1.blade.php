<!-- 20211024_how to use Component -->

<!-- x-folder's name _ file's name -->
<x-tests.app>
    <x-slot name="header">This is header</x-slot>
    component-test1

    {{-- 20211029_受け渡し_属性をつける場合にはこの書き方--}}
    {{-- 20211029_変数受け渡し_ 変数として受け取る場合にはこの書き方_[ :variable="$---"--}}
    <x-tests.card title="title1" content="content1" :message="$message" />
</x-tests.app>
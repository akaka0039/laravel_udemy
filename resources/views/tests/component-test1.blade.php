<!-- 20211024_how to use Component -->

<!-- x-folder's name _ file's name -->
<x-tests.app>
    <x-slot name="header">This is header</x-slot>
    component-test1

    {{-- 20211029_受け渡し 属性をつける場合にはこの書き方--}}
    <x-tests.card title="title1" content="content1" />
</x-tests.app>
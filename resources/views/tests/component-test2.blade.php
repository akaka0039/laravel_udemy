<x-tests.app>
    <!-- 20211030_名前付きスロットの挿入 -->
<x-slot name="header">ヘッダーです</x-slot>
component-test2
<x-test-class-base classBaseMessage="this is a message from Component Class " />

<div class="mb-4"></div>
<x-test-class-base classBaseMessage="this is a message from Component Class " defaultMessage="初期値から変更しています" />
</x-tests.app>
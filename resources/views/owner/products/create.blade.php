<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="post" action="{{ route('owner.products.store') }}">
                        @csrf
                        <div class="-m-2">
                            {{-- 店舗名 --}}
                            <div class="p-2 w-1/2 mx-auto">
                                <div class="relative">
                                    <select name="category">
                                        @foreach ($categories as $category)
                                            {{-- optgroup_カテゴリーを表示するため --}}
                                            <optgroup label="{{ $category->name }}">
                                                @foreach ($category->secondary as $secondary)
                                                    <option value="{{ $secondary->id }}">
                                                        {{ $secondary->name }}
                                                    </option>
                                                @endforeach
                                        @endforeach
                                    </select>


                                </div>
                            </div>

                            <x-select-image :images="$images" name="image1" />
                            <x-select-image :images="$images" name="image2" />
                            <x-select-image :images="$images" name="image3" />
                            <x-select-image :images="$images" name="image4" />

                            {{-- ボタン　update or back --}}
                            <div class="p-2 w-full flex justify-around mt-4">
                                <button type="button" onclick="location.href='{{ route('owner.products.index') }}'"
                                    class=" bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">back</button>
                                <button type="submit"
                                    class=" text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">登録する</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        'use strict' // 曖昧なコードをエラーにする
        const images = document.querySelectorAll('.image') //全ての「.image」を取得することができる

        // 取得した画像を一つずつ回していく
        images.forEach(image => {
            image.addEventListener('click', function(e) { // クリックした時
                const imageName = e.target.dataset.id.substr(0, 6)
                const imageId = e.target.dataset.id.replace(imageName + '_', '')
                const imageFile = e.target.dataset.file
                const imagePath = e.target.dataset.path
                const modal = e.target.dataset.modal


                // サムネイルと input type = hiddenのvalueに設定
                document.getElementById(imageName + '_thumbnail').src = imagePath + '/' + imageFile
                document.getElementById(imageName + '_hidden').value = imageId
                MicroModal.close(modal);
            })

        })
    </script>

</x-app-layout>

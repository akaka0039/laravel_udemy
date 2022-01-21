<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('オーナー一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:p-6 bg-white border-b border-gray-200">
                    
                    {{-- 20220118_add --}}
                    
                    {{-- TAILBLOCKS --}}
                    <section class="text-gray-600 body-font">
                        <div class="container md:px-5 mx-auto">
                            {{-- @if(session('message')) --}}

                            <x-flash-message status="session('status')" />
                            <div class="flex justify-end mb-4">
                                <button onclick="location.href='{{ route('admin.owners.create')}}'" class=" text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">new register</button>
                            </div>
                            
                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Created date</th>
                                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">name</th>
                                            <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($owners as $owner)
                                        <tr>
                                            <td class="md:px-4 py-3">{{ $owner->name }}</td>
                                            <td class="md:px-4 py-3">{{ $owner->email }}</td>
                                            <td class="md:px-4 py-3">{{ $owner->created_at->diffForHumans() }}</td>
                                            <td class="md:px-4 py-3">
                                                <button onclick="location.href='{{ route('admin.owners.edit', ['owner' => $owner->id ])}}'" type="submit" class=" text-white bg-green-400 border-0 py-2 px-5 focus:outline-none hover:bg-green-600 rounded">edit</button>
                                            </td>
                                            <form id="delete_{{$owner->id}}" method="post" action="{{ route('admin.owners.destroy', ['owner' => $owner->id ])}}">
                                                @csrf
                                                @method('delete')
                                                <td class="md:px-4 py-3">
                                                <a href="#" data-id="{{ $owner->id }}" onclick="deletePost(this)" class=" text-white bg-red-400 border-0 py-2 px-5 focus:outline-none hover:bg-red-600 rounded">Delete</a>
                                            </td>
                                            </form>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $owners->links() }}
                            </div>
                          </div>
                      </section>


                    {{-- 20220118_add --}}
                    {{-- エロクアント
                    @foreach ($e_all as $e_owner)
                        {{ $e_owner->name }}
                        {{ $e_owner->created_at->diffForHumans() }}
                    @endforeach
                    
                    <br>

                    クリエビルダ
                    @foreach ($q_get as $q_owner)
                        {{ $q_owner->name }}
                        {{ Carbon\Carbon::parse($q_owner->created_at)->diffForHumans() }}
                    @endforeach --}}

                </div>
            </div>
        </div>
    </div>

    {{-- Javascript_20220122 --}}
    <script>
        function deletePost(e) {
            'use strict';
            if (confirm('本当に削除してもよろしいですか？')) {
               document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>


</x-app-layout> 

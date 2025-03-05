<x-app-layout>

    @section('title', 'Privacy policy') 

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Privacy policy') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    {{ __('Privacy policy') }}
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
       @include('footer')                      
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="lg:grid grid-cols-1 mx-auto gap-4"> 
                        <div class="border border-2 border-slate-200 p-4 rounded-md mx-auto max-w-2xl w-full">
                           
                            <ul class="list-none">
                                <li>
                                    @include('profile.partials.update-profile-information-form')
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                     
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

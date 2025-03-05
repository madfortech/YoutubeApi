<x-app-layout>

    @section('title', 'Welcome') 

    <x-slot name="header">
        <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
            {{ __(' find out when my favorite YouTube 
                creators post their videos ?') }}
        </h2>
    </x-slot>

 <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="bg-stone-500 py-3 px-3">
                        looking for methods to track the video release times of my favorite YouTubers.
                    </p> 
                    <br>
                    <ul class="list-disc text-2xl">
                        
                        <li>
                            #publishedAt
                        </li>
                        <li>
                            <x-nav-link :href="route('custom-search')">
                                {{ __('just try') }}
                            </x-nav-link>
                        </li>
                    </ul>
                   
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
                           
    </div>
</x-app-layout>

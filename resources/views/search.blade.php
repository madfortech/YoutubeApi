<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8">
                    <!-- Sidebar -->
                    <div class="lg:h-32 rounded-lg bg-gray-200">
                        <!-- Form -->
                        <form action="{{route('youtube.store')}}" method="Post">
                            @csrf
                            <div class="mb-3">
                            
                                <label for="query" class="block mb-2">Search Query:</label>
                                <input 
                                    type="text" 
                                    name="query" 
                                    id="query" 
                                    class="@error('query') is-invalid @enderror placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                                    required>
                                
                            </div>
                            <!-- Query -->
 
                            <div class="mb-3">
                                <label for="region" class="block mb-2">Region:</label>
                                <select class="form-control" id="region" name="region">
                                    @foreach($regions as $region)
                                        <option value="{{ $region->id }}">{{ $region->snippet->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-3">
                                <x-primary-button>
                                    {{ __('Refresh') }}
                                </x-primary-button>
                            </div>
                        </form>
                        <!-- Form -->
                    </div>
                    <!-- Sidebar -->

                    <!-- Main -->
                    <div class="h-32 rounded-lg bg-gray-200 lg:col-span-2">
                        <!-- Display Data -->
                        
                        <div class="lg:grid grid-cols-3 gap-3 px-6"> 
                            @if(isset($results))
                                @foreach($results as $result)
                                    <div class="mt-3 border rounded p-3">
                                        <div class="max-w-sm rounded overflow-hidden shadow-lg">
                                            <iframe 
                                                class="w-full aspect-video" 
                                                src="https://www.youtube.com/embed/{{ $result->id->videoId }}" 
                                                frameborder="0" 
                                                allowfullscreen>
                                            </iframe>
                                            <div class="font-bold text-xl mb-2">
                                                {{ $result->snippet->title }}
                                            </div>
                                            <p>{{ $result->snippet->description }}</p>
                                            <img src="{{ $result->snippet->thumbnails->default->url }}" alt="Video thumbnail">
                                            <p>Video ID: {{ $result['videoId'] }}</p>
                                            <p>Rating: {{ $result['rating'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <!-- Display Data -->
                    </div>
                    <!-- Main -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

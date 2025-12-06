<x-app-layout>
    @section('title', 'Custom search') 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-12 sm:px-6 lg:px-8">
                <div class="">
                   
                    <div class="rounded-lg bg-gray-200 mb-6 px-4 py-4">
                        <!-- Form -->
                        <form action="{{ route('youtube.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="query" class="block mb-2">Search Query:</label>
                                <input 
                                    type="text" 
                                    name="query" 
                                    id="query" 
                                    class="@error('query') is-invalid @enderror placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-xs focus:outline-hidden focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                                    required>
                            </div>

 

                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-sm">Search</button>
                        </form>
                    </div>

                    <!-- Display Data -->
                    <div class="rounded-lg bg-gray-400 px-4 py-4">
                        <h2 class="text-xl font-semibold mb-4">Search Results</h2>
                        <div id="search-results">
                            <table class="lg:table table-striped overflow-y-auto">
                                <thead class="space-y-2">
                                    <tr>
                                       
                                        <th class="px-4 py-2">Title</th>
                                        <th class="px-4 py-2">Description</th>
                                        <th class="px-4 py-2">published At</th>
                                        <th class="px-4 py-2">Thumbnail</th>
                                        <th class="px-4 py-2">Videos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($videos as $video)
                                        <tr>
 
                                            <td class="border px-4 py-2">{{ $video['snippet']['channelTitle'] }}</td>
                                            <td class="border px-4 py-2">{{ $video['snippet']['description'] }}</td>
                                            <td class="border px-4 py-2">{{ $video['snippet']['publishedAt'] }}</td> 

                                            <td> <img src="{{ $video['snippet']['thumbnails']['default']['url'] }}" alt="Video thumbnail"></td>
                                            <td class="border px-4 py-2">
                                                <iframe 
                                                    class="w-full aspect-video" 
                                                    src="https://www.youtube.com/embed/{{ $video['id']['videoId'] }}" 
                                                    frameborder="0" 
                                                    allowfullscreen>
                                                </iframe>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Display Data -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
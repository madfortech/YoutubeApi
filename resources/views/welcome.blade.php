<x-app-layout>
@php
    $videos = $videos ?? [];
@endphp
    <flux:sidebar sticky collapsible="mobile" class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.header>
            <flux:sidebar.brand
                href="{{('/')}}"
                name="examine"
            />

            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>

      

        <flux:sidebar.nav>
            <flux:sidebar.item icon="home" href="#" current>Home</flux:sidebar.item>
            <flux:sidebar.item icon="information-circle" href="#">Privacy</flux:sidebar.item>
            <flux:sidebar.item icon="information-circle" href="#">Terms & Conditions</flux:sidebar.item>
            @auth
                <flux:sidebar.item icon="cog-6-tooth" href="{{ route('profile.edit') }}">Settings</flux:sidebar.item>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <flux:sidebar.item 
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </flux:sidebar.item>
                </form>
            @else
                <flux:sidebar.item icon="user" href="{{ route('login') }}">Login</flux:sidebar.item>
            @endauth
        </flux:sidebar.nav>

        @auth
        <flux:sidebar.spacer />
        <flux:dropdown position="top" align="start" class="max-lg:hidden">
            <flux:sidebar.profile name="{{ Auth::user()->name }}" />
        </flux:dropdown>
        @endauth
    </flux:sidebar>
   
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />
        @auth
        <flux:dropdown position="top" alignt="start">
            <flux:profile  name="{{ Auth::user()->name }}" />
           
                <flux:menu>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <flux:menu.item
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            this.closest('form').submit();">
                            Logout
                        </flux:menu.item>
                    </form>
                </flux:menu>
        </flux:dropdown>
        @endauth
    </flux:header>
       

    <flux:main>
        
        <flux:heading size="xl" level="1">Smarter Video Insights</flux:heading>

        <flux:text class="mb-6 mt-2 text-base">Powered by AI</flux:text>

        <flux:separator variant="subtle" />

        <div class="lg:grid lg:grid-cols-1 lg:gap-4">
            <div>
                <form action="{{ route('youtube.store') }}" method="POST">
                    @csrf
                    <flux:input icon="magnifying-glass" 
                        placeholder="Search YouTube videos" 
                        name="query"/>
                </form>
            </div>
          
        </div>

         <div class="lg:grid lg:grid-cols-2 lg:gap-4 mt-6">
            <div class="flex flex-col">
                <div class="overflow-auto">
                    @foreach ($videos as $video)
                        <div class="bg-white max-w-sm md:max-w-lg shadow-lg rounded-lg overflow-hidden mb-4">
                            <div class="sm:flex sm:items-center px-6 py-4">
                               
                                <iframe 
                                    class="w-full aspect-video" 
                                    src="https://www.youtube.com/embed/{{ $video['id']['videoId'] }}" 
                                    frameborder="0" 
                                    allowfullscreen>
                                </iframe>

                                <div class="text-center sm:text-left sm:flex-grow">
                                    <div class="mb-4">
                                        <p class="text-xl leading-tight">
                                            {{ $video['snippet']['channelTitle'] }}
                                        </p>
                                        <p class="text-sm leading-tight text-grey-dark">
                                            {{ $video['snippet']['description'] }}
                                        </p>
                                        <p class="text-sm leading-tight text-gray-800">
                                            {{ $video['snippet']['publishedAt'] }}
                                        </p>
                                    </div>

                                    <div class="px-6 py-4">
                                        tags::
                                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-800">#winter</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            <!-- Chat Box -->
            <div class="">
                <div class="flex flex-col">
                    <div class="min-h-48 shadow-lg rounded-lg overflow-y-auto">
                        
                    </div>
                </div>

                <div class="flex flex-col">

                    <div class="p-4">
                        <form action="">
                            <flux:input icon="magnifying-glass" placeholder="Examine will analyze it for you" />
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Chat Box -->
        </div>


    </flux:main>
</x-app-layout>

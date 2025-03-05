<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-12">
    <div class="flex justify-center">
        <x-nav-link :href="route('privacy-policy')">
            {{ __('Privacy policy') }}
        </x-nav-link>
        <div class="mx-4"></div>
        <x-nav-link :href="route('terms-and-conditions')">
            {{ __('Terms and conditions') }}
        </x-nav-link>
    </div>
</div>
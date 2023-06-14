<x-backend.master>
    <x-slot:title>
        Profile
    </x-slot:title>
    <div class="">
            <div class="p-4 bg-white shadow rounded m-3">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="p-4 bg-white shadow rounded m-3">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
{{--
            <div class="p-4 bg-white shadow rounded m-3">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div> --}}
    </div>
</x-backend.master>

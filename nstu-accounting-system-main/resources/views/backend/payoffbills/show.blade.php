<x-backend.master>
    <x-slot:title>
        User Details
    </x-slot:title>

    <div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('users.index') }}">
                <button type="button" class="btn btn-sm btn-outline-primary">
                    <span data-feather="list"></span>
                    List
                </button>
            </a>
        </div>
    </div>

    <div>
        @if ($user->image?->image != null)
            <img src="{{ asset('storage/users/' . $user->image->image) }}" height="250px" />
        @endif
    </div>

    <h3>Name: {{ $user->name }}</h3>
    <p>Email: {{ $user->email }}</p>
    <p>Mobile: {{ $user->mobile }}</p>
</x-backend.master>

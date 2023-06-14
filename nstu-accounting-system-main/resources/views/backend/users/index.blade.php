<x-backend.master>
    <x-slot:title>
        User List
    </x-slot:title>

    <div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    </div>

    <x-forms.message />

    <table class="table">
        <thead>
            <tr>
                <th>SL#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th width="180px">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role?->name }}</td>
                    <td>
                        <a class="btn btn-sm btn-info" href="{{ route('users.show', $user->id) }}">Show</a>
                        @can('update-role')
                            <a class="btn btn-sm btn-warning" href="{{ route('users.change_role', $user->id) }}">Change Role</a>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No Users</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="row justify-content-center pb-4">
        {{ $users->links() }}
    </div>
</x-backend.master>

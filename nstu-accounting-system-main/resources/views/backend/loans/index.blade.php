<x-backend.master title="Loan Applications">

    <div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center py-3 mb-3">
        @if (auth()->user()->isTeacher() || auth()->user()->isStaff())
        <a class="btn btn-sm btn-primary" href="{{ route('loans.create') }}">Apply for loan</a>
        @endif
    </div>

    <x-forms.message />


    <div class="card rounded bg-white w-100 shadow my-4">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>SL#</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Reason</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th width="180px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($loans as $loan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $loan->user->name }}</td>
                            <td>{{ $loan->user->mobile }}</td>
                            <td>{{ $loan->reason }}</td>
                            <td>{{ $loan->amount }}</td>
                            <td>{{ $loan->application->status }}</td>
                            <td>
                                <a class="btn btn-sm btn-info" href="{{ route('loans.show', $loan->id) }}">Show</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No loan applications</td></tr>
                    @endforelse
                </tbody>
            </table>

            <div class="row justify-content-center pb-4">
                {{ $loans->links() }}
            </div>
        </div>
    </div>
</x-backend.master>

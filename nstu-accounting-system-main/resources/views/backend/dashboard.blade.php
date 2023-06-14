<x-backend.master title="Dashboard">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        {{-- <div class="row row-cols-4 row-cols-md-6">
            <div class="col mb-4">
                <div class="card border-dark mb-3 bg-white shadow rounded" style="max-width: 14rem;">
                    <div class="card-body text-center">
                        <h2 class="card-text mb-3">{{ 0 }}</h2>
                        <h4 class="card-text">Something</h4>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card border-dark mb-3 bg-white shadow rounded" style="max-width: 14rem;">
                    <div class="card-body text-center">
                        <h2 class="card-text mb-3">{{ 0 }}</h2>
                        <h4 class="card-text">Something</h4>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row">
            <div class="card rounded bg-white w-100 shadow my-4">
                <div class="card-body">
                    <h4>Pending Loan Applications</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>SL#</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Department/Office</th>
                                <th>Designation</th>
                                <th>Current Office</th>
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
                                    <td>{{ $loan->user->from->name }}</td>
                                    <td>{{ $loan->user->designation->name }}</td>
                                    <td>{{ $submitted_tos[$loan->id] }}</td>
                                    <td>{{ $loan->application->status }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="{{ route('loans.show', $loan->id) }}">Show</a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5">No applications</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="row justify-content-center pb-4">
                        {{ $loans->links() }}
                    </div>
                </div>
            </div>

            <div class="card rounded bg-white w-100 shadow my-4">
                <div class="card-body">
                    <h5>Pending Payoff Bill Applications</h5>
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>SL#</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Department/Office</th>
                                <th>Designation</th>
                                <th>Current Office</th>
                                <th>Status</th>
                                <th width="180px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ([] as $payoffBill)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payoffBill->user->name }}</td>
                                    <td>{{ $payoffBill->user->mobile }}</td>
                                    <td>{{ $payoffBill->user->from->name }}</td>
                                    <td>{{ $payoffBill->user->designation->name }}</td>
                                    <td>{{ $submitted_tos[$payoffBill->id] }}</td>
                                    <td>{{ $payoffBill->application->status }}</td>
                                    <td>
                                        {{-- <a class="btn btn-sm btn-info" href="{{ route('payoffBills.show', $payoffBill->id) }}">Show</a> --}}
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5">No applications</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="row justify-content-center pb-4">
                        {{-- {{ $payoffBills->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-backend.master>

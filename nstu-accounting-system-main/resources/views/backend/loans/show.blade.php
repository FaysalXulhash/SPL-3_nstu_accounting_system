<x-backend.master title="View Loan Application">

    <div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('loans.index') }}">
                <button type="button" class="mx-1 btn btn-sm btn-outline-info">
                    <span data-feather="list"></span>
                    List
                </button>
            </a>
            @if (auth()->user()->hasNot(['teacher', 'staff']) && auth()->id() != $loan->user_id && $loan->application->status == 'pending' && $submitted_to['submitted_to']->id == auth()->user()->role_id)
            <form action="{{ route('loans.approve', ['loan' => $loan->id, 'user' => $loan->user_id]) }}" method="post" style="display: inline">
                @csrf
                @method('patch')
                <button type="submit" class="mx-1 btn btn-sm btn-outline-success">Approve</button>
            </form>
            <form action="{{ route('loans.disapprove', ['loan' => $loan->id, 'user' => $loan->user_id]) }}" method="post" style="display: inline">
                @csrf
                @method('patch')
                <button type="submit" class="mx-1 btn btn-sm btn-outline-danger">Disapprove</button>
            </form>
            @endif
        </div>
    </div>

    <x-forms.message />
    <x-forms.errors />

    <div class="card">
        <div class="card-body">
            <div class="row">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{ $loan->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Designation</th>
                            <td>{{ $loan->user->designation->name }}</td>
                        </tr>
                        <tr>
                            <th>@if ($loan->user->from->getMorphClass() == 'App\Models\Department') Department: @else Office: @endif</th>
                            <td>{{ $loan->user->from->name }}</td>
                        </tr>
                        <tr>
                            <th>NID</th>
                            <td>{{ $loan->application->nid }}</td>
                        </tr>
                        <tr>
                            <th>Bank Number</th>
                            <td>{{ $loan->application->bank_acc_no }}</td>
                        </tr>
                        <tr>
                            <th>Current Salary Scale</th>
                            <td>{{ $loan->current_salary_scale }}</td>
                        </tr>
                        <tr>
                            <th>Basic Salary Scale</th>
                            <td>{{ $loan->basic_salary_scale }}</td>
                        </tr>
                        <tr>
                            <th>Loan Amount</th>
                            <td>{{ $loan->amount }}</td>
                        </tr>
                        <tr>
                            <th>Reason</th>
                            <td>{{ $loan->reason }}</td>
                        </tr>
                        <tr>
                            <th>Loan Repay Method</th>
                            <td>{{ $loan->repay_method }}</td>
                        </tr>
                        <tr>
                            <th>Application Status</th>
                            <td>{{ $loan->application->status }}</td>
                        </tr>
                        <tr>
                            <th>Applied at</th>
                            <td>{{ $loan->created_at }}</td>
                        </tr>
                        @if ($loan->application->status == 'accepted')
                        <tr>
                            <th>Accepted at</th>
                            <td>{{ $loan->application->accepted_at }}</td>
                        </tr>
                        @elseif ($loan->application->status == 'rejected')
                        <tr>
                            <th>Rejected at</th>
                            <td>{{ $loan->application->rejected_at }}</td>
                        </tr>
                        @else
                        <tr>
                            <th>Application submitted to</th>
                            <td>
                                @if ($submitted_to)
                                {{ $submitted_to['submitted_to']->title }}
                                @endif
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-backend.master>

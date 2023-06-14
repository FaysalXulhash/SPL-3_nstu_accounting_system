<x-backend.master title="Apply for Loan">

    <div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('loans.index') }}">
                <button type="button" class="btn btn-sm btn-outline-info">
                    <span data-feather="list"></span>
                    List
                </button>
            </a>
        </div>
    </div>

    <x-forms.message />
    <x-forms.errors />

    @php
        $user = auth()->user();
    @endphp

    <div class="card">
        <div class="card-body">
            <h5>Applicant Name: {{ $user->name }}</h5>
            <h5>Designation: {{ $user->designation->name }}</h5>
            <h5>@if ($user->from->getMorphClass() == 'App\Models\Department') Department: @else Office: @endif {{ $user->from->name }}</h5>

            <form class="my-4" action="{{ route('loans.store') }}" method="post">
                @csrf

                <x-forms.input name="reason" type="text" label="Purpose of Loan" :value="old('reason')" required autofocus />
                <x-forms.input name="nid" type="text" label="NID" :value="old('nid')" required />
                <x-forms.input name="bank_acc_no" type="text" label="Bank Account No" :value="old('bank_acc_no')" required />
                <x-forms.input name="current_salary_scale" type="number" label="Current Salary Scale" :value="old('current_salary_scale')" required />
                <x-forms.input name="basic_salary_scale" type="number" label="Basic Salary Scale" :value="old('basic_salary_scale')" required />
                <x-forms.input name="amount" type="number" label="Loan amount" :value="old('amount')" required />
                <x-forms.input name="repay_method" type="text" label="Repay method" :value="old('repay_method')" required />

                {{-- <x-forms.select name="role_id" required label="Role" :options="$roles" /> --}}

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>

</x-backend.master>

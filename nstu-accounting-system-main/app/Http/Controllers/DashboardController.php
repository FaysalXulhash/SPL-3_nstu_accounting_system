<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Role;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $loans = Loan::query();
        if (auth()->user()->isTeacher() || auth()->user()->isStaff()) {
            $loans->where('user_id', auth()->id());
        }

        $pending_loans = Loan::whereHas('application', function($q){
            $q->where('status', 'pending');
        })->with(['application'])->get();

        $pending_loan_ids = [];
        $submitted_tos = [];

        foreach ($pending_loans as $loan) {
            $json = $loan->application->office;
            $curr_office = last($json);
            $submitted_tos[$loan->id] = Role::find($curr_office['submitted_to'])->title;
            if (auth()->user()->isTeacher() || auth()->user()->isStaff()) {
                $pending_loan_ids[] = $loan->id;
            } else {
                if ($curr_office['submitted_to'] == auth()->user()->role_id) {
                    $pending_loan_ids[] = $loan->id;
                }
            }
        }

        $loans->whereIn('id', $pending_loan_ids);

        $loans = $loans->with(['application', 'user', 'user.designation', 'user.role'])->latest()->paginate();
        return view('backend.dashboard', compact('loans', 'submitted_tos'));
    }
}

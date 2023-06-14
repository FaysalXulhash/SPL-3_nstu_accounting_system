<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanRequest;
use App\Http\Requests\UpdateLoanRequest;
use App\Models\Application;
use App\Models\Loan;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::query();
        if (auth()->user()->isTeacher() || auth()->user()->isStaff()) {
            $loans->where('user_id', auth()->id());
        } else {
            $pending_loans = Loan::with(['application'])->get();

            $pending_loan_ids = [];
            foreach ($pending_loans as $loan) {
                $json = $loan->application->office;
                foreach ($json as $item) {
                    if ($item['submitted_to'] == auth()->user()->role_id) {
                        $pending_loan_ids[] = $loan->id;
                        break;
                    }
                }
            }

            $loans->whereIn('id', $pending_loan_ids);
        }

        $loans = $loans->with(['application'])->latest()->paginate();
        return view('backend.loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.loans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLoanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoanRequest $request)
    {
        // $dept_chairman = User::where('from_id', auth()->user()->from_id)
        //                         ->where('role_id', User::TYPE_DEPT_CHAIRMAN)
        //                         ->latest()->first();
        // if (!$dept_chairman) {
        //     return redirect()->back()->withMessage('Fatal Error: There are no chairman for your department');
        // }

        try {
            DB::beginTransaction();
            $application = Application::create([
                'nid' => $request->nid,
                'bank_acc_no' => $request->bank_acc_no,
                'type' => Loan::class,
                'office' => [
                    [
                        'submitted_to' => User::TYPE_DEPT_CHAIRMAN,
                        'verified_by' => null,
                        'verified_at' => null,
                        'status' => null,
                        'comment' => null,
                    ]
                ],
            ]);
            Loan::create([
                'user_id' => auth()->id(),
                'application_id' => $application->id,
                'current_salary_scale' => $request->current_salary_scale,
                'basic_salary_scale' => $request->basic_salary_scale,
                'amount' => $request->amount,
                'reason' => $request->reason,
                'repay_method' => $request->repay_method,
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->withMessage('Can not apply for loan. ' . $ex->getMessage());
        }
        return redirect()->route('loans.index')->withMessage('Applied for loan successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        $submitted_to = null;
        if ($loan->application->office) {
            $submitted_to = last($loan->application->office);
            $submitted_to['submitted_to'] = Role::find($submitted_to['submitted_to']);
        }
        return view('backend.loans.show', compact('loan', 'submitted_to'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLoanRequest  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLoanRequest $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
    }

    public function approve(Loan $loan, User $user)
    {
        try {
            DB::beginTransaction();

            $submitted_to = null;

            $office = $loan->application->office;
            $office[count($office)-1]['verified_by'] = auth()->id();
            $office[count($office)-1]['verified_at'] = now();
            $office[count($office)-1]['status'] = 'accepted';

            $prev_last_submitted_to = null;
            if ($office && count($office) >= 2) {
                $prev_last_submitted_to = array_slice($office, -2, 1)[0]['submitted_to'];
            }
            $last_submitted_to = last($office)['submitted_to'];

            if ($last_submitted_to == User::TYPE_DEPT_CHAIRMAN) {
                $submitted_to = User::TYPE_ACCOUNTS_DIRECTOR;
            } else if ($last_submitted_to == User::TYPE_ACCOUNTS_DIRECTOR) {
                if ($prev_last_submitted_to && $prev_last_submitted_to == User::TYPE_DEPT_CHAIRMAN) {
                    $submitted_to = User::TYPE_TREASURER;
                } else if ($prev_last_submitted_to && $prev_last_submitted_to == User::TYPE_TREASURER) {
                    $submitted_to = User::TYPE_ACCOUNTS_SECTION_OFFICER;
                }
            } else if ($last_submitted_to == User::TYPE_TREASURER) {
                if ($prev_last_submitted_to && $prev_last_submitted_to == User::TYPE_VICE_CHANCELLOR) {
                    $submitted_to = User::TYPE_ACCOUNTS_DIRECTOR;
                } else {
                    $submitted_to = User::TYPE_VICE_CHANCELLOR;
                }
            } else if ($last_submitted_to == User::TYPE_VICE_CHANCELLOR) {
                $submitted_to = User::TYPE_TREASURER;
            } else if ($last_submitted_to == User::TYPE_ACCOUNTS_SECTION_OFFICER) {
                $submitted_to = null;
                $loan->application()->update([
                    'status' => 'accepted',
                    'accepted_at' => now(),
                ]);
            }

            if ($submitted_to) {
                $office[] = [
                    'submitted_to' => $submitted_to,
                    'verified_by' => null,
                    'verified_at' => null,
                    'status' => null,
                    'comment' => null,
                ];
            }

            $loan->application()->update([
                'office' => $office,
            ]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->withMessage('Can not approve application. ' . $ex->getMessage());
        }

        return redirect()->back()->withMessage('Application approved');
    }

    public function disapprove(Loan $loan, User $user)
    {
        try {
            DB::beginTransaction();

            $office = $loan->application->office;
            $office[count($office)-1]['verified_by'] = auth()->id();
            $office[count($office)-1]['verified_at'] = now();
            $office[count($office)-1]['status'] = 'rejected';

            $loan->application()->update([
                'status' => 'rejected',
                'rejected_at' => now(),
                'office' => $office,
            ]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->withMessage('Can not disapprove application. ' . $ex->getMessage());
        }

        return redirect()->back()->withMessage('Application rejected');
    }
}

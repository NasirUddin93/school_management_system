<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Student;
use App\Models\StudentFee;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with(['student', 'studentFee'])->latest()->paginate(10);
        return view('backend.admin.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        $studentFees = StudentFee::all();
        return view('backend.admin.payments.create', compact('students', 'studentFees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'student_fee_id' => 'required|exists:student_fees,id',
            'amount_paid' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|in:cash,card,mobile_banking,bank_transfer,check,other',
            'transaction_reference' => 'nullable|string|max:255',
            'remarks' => 'nullable|string'
        ]);

        DB::transaction(function () use ($request) {
            Payment::create([
                'student_id' => $request->student_id,
                'student_fee_id' => $request->student_fee_id,
                'amount_paid' => $request->amount_paid,
                'payment_date' => $request->payment_date,
                'payment_method' => $request->payment_method,
                'transaction_reference' => $request->transaction_reference,
                'status' => 'completed',
                'remarks' => $request->remarks,
            ]);
        });

        return redirect()->route('payments.index')->with('success', 'Payment recorded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $payment = Payment::with(['student', 'studentFee'])->findOrFail($id);
        return view('backend.admin.payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $students = Student::all();
        $studentFees = StudentFee::all();
        return view('backend.admin.payments.edit', compact('payment', 'students', 'studentFees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'student_fee_id' => 'required|exists:student_fees,id',
            'amount_paid' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|in:cash,card,mobile_banking,bank_transfer,check,other',
            'transaction_reference' => 'nullable|string|max:255',
            'remarks' => 'nullable|string'
        ]);

        $payment = Payment::findOrFail($id);

        $payment->update([
            'student_id' => $request->student_id,
            'student_fee_id' => $request->student_fee_id,
            'amount_paid' => $request->amount_paid,
            'payment_date' => $request->payment_date,
            'payment_method' => $request->payment_method,
            'transaction_reference' => $request->transaction_reference,
            'status' => 'completed',
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\SalarySlip;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SalarySlipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $slips = SalarySlip::with('employee')
            ->where('period_month', $month)
            ->where('period_year', $year)
            ->latest()
            ->paginate(10);

        return view('salary-slips.index', compact('slips', 'month', 'year'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::where('status', 'active')->orderBy('full_name')->get();
        return view('salary-slips.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'period_month' => 'required|integer|min:1|max:12',
            'period_year' => 'required|integer|min:2020|max:2030',
            'salary' => 'required|numeric|min:0',
            'bonus' => 'nullable|numeric|min:0',
            'deduction' => 'nullable|numeric|min:0',
            'payment_date' => 'required|date',
            'status' => 'required|in:draft,paid',
            'notes' => 'nullable|string',
        ]);

        $employee = Employee::find($validated['employee_id']);
        
        // Calculate Net Salary
        $bonus = $validated['bonus'] ?? 0;
        $deduction = $validated['deduction'] ?? 0;
        $net_salary = $validated['salary'] + $bonus - $deduction;

        // Generate Slip Number: SLIP/YYYY/MM/00X
        $count = SalarySlip::where('period_month', $validated['period_month'])
            ->where('period_year', $validated['period_year'])
            ->count() + 1;
        $slip_number = sprintf("SLIP/%d/%02d/%03d", $validated['period_year'], $validated['period_month'], $count);

        SalarySlip::create([
            'employee_id' => $validated['employee_id'],
            'slip_number' => $slip_number,
            'period_month' => $validated['period_month'],
            'period_year' => $validated['period_year'],
            'salary' => $validated['salary'],
            'bonus' => $bonus,
            'deduction' => $deduction,
            'net_salary' => $net_salary,
            'status' => $validated['status'],
            'payment_date' => $validated['payment_date'],
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('salary-slips.index')
            ->with('success', 'Slip Gaji berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SalarySlip $salarySlip)
    {
        $salarySlip->load('employee');
        
        // Get Company info for the header (Assuming first company or generic)
        $company = \App\Models\Company::first();

        return view('salary-slips.show', compact('salarySlip', 'company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalarySlip $salarySlip)
    {
        // Not implemented for simplicity in this iteration, can delete and recreate
        return redirect()->route('salary-slips.index')->with('error', 'Edit belum tersedia. Hapus dan buat baru jika ada kesalahan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalarySlip $salarySlip)
    {
        // Not implemented
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalarySlip $salarySlip)
    {
        $salarySlip->delete();

        return redirect()->route('salary-slips.index')
            ->with('success', 'Slip Gaji berhasil dihapus.');
    }
}

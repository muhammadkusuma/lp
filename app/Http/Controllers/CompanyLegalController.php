<?php
namespace App\Http\Controllers;

use App\Models\CompanyLegal;
use Illuminate\Http\Request;

class CompanyLegalController extends Controller
{
    public function index()
    {
        $legal = CompanyLegal::first();

        return view('company.legal', compact('legal'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_type'       => 'required|string|max:100',
            'npwp'               => 'nullable|string|max:50',
            'nib'                => 'nullable|string|max:50',
            'siup'               => 'nullable|string|max:50',
            'akta_pendirian'     => 'nullable|string|max:100',
            'tanggal_pendirian'  => 'nullable|date',
            'notaris'            => 'nullable|string|max:150',
            'status_badan_hukum' => 'required|string|max:50',
        ]);

        $legal = CompanyLegal::first();

        if (! $legal) {
            CompanyLegal::create($request->all());
        } else {
            $legal->update($request->all());
        }

        return redirect()
            ->route('company.legal')
            ->with('success', 'Data legal perusahaan berhasil diperbarui');
    }
}

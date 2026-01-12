<?php
namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyLegal;
use Illuminate\Http\Request;

class CompanyLegalController extends Controller
{
    public function index()
    {
        // Ambil perusahaan (asumsi single tenant / satu profil perusahaan)
        $company = Company::first();
        
        // Ambil data legal terkait perusahaan tersebut jika ada
        $legal = $company ? CompanyLegal::where('company_id', $company->id)->first() : null;

        return view('company.legal', compact('legal'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'npwp'               => 'nullable|string|max:50',
            'nib'                => 'nullable|string|max:50',
            'akta_pendirian'     => 'nullable|string|max:100',
            'tanggal_pendirian'  => 'nullable|date',
        ]);

        // Pastikan ada data Company induk terlebih dahulu
        $company = Company::first();

        if (!$company) {
            return redirect()
                ->route('company.profile')
                ->with('error', 'Silakan lengkapi Profil Perusahaan terlebih dahulu sebelum mengisi Legalitas.');
        }

        // Update atau Create data legal berdasarkan company_id
        CompanyLegal::updateOrCreate(
            ['company_id' => $company->id],
            [
                'npwp'              => $request->npwp,
                'nib'               => $request->nib,
                'akta_pendirian'    => $request->akta_pendirian,
                'tanggal_pendirian' => $request->tanggal_pendirian,
            ]
        );

        return redirect()
            ->route('company.legal')
            ->with('success', 'Data legal perusahaan berhasil diperbarui');
    }
}
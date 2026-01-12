<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyProfileController extends Controller
{
    public function index()
    {
        // Mengambil data perusahaan pertama (karena ini pengaturan profil tunggal)
        $company = Company::first();

        return view('company.profile', compact('company'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:150',
            'legal_name'  => 'nullable|string|max:150',
            'email'       => 'nullable|email|max:150',
            'phone'       => 'nullable|string|max:50',
            'website'     => 'nullable|url|max:150', // Ubah ke validasi URL
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048', // Validasi file gambar
            'address'     => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $company = Company::first();
        $data = $request->except(['logo']); // Ambil semua data kecuali file logo mentah

        // Logika Upload Logo
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($company && $company->logo_url && Storage::disk('public')->exists($company->logo_url)) {
                Storage::disk('public')->delete($company->logo_url);
            }

            // Simpan logo baru
            $path = $request->file('logo')->store('company-logos', 'public');
            $data['logo_url'] = $path;
        }

        if (!$company) {
            Company::create($data);
        } else {
            $company->update($data);
        }

        return redirect()
            ->route('company.profile')
            ->with('success', 'Company profile berhasil diperbarui');
    }
}
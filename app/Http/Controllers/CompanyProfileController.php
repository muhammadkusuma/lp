<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function index()
    {
        $company = Company::first();

        return view('company.profile', compact('company'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:150',
            'legal_name'  => 'nullable|string|max:150',
            'email'       => 'nullable|email',
            'phone'       => 'nullable|string|max:50',
            'website'     => 'nullable|string|max:150',
            'logo_url'    => 'nullable|string|max:255',
            'address'     => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $company = Company::first();

        if (! $company) {
            $company = Company::create($request->all());
        } else {
            $company->update($request->all());
        }

        return redirect()
            ->route('company.profile')
            ->with('success', 'Company profile berhasil diperbarui');
    }
}

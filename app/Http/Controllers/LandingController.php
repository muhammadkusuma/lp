<?php
namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Lead;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting; // Atau CompanyProfile
use App\Models\Testimonial;
use Illuminate\Http\Request; // Menggunakan Lead untuk form contact

class LandingController extends Controller
{
    public function index()
    {
        // Mengambil data Company Profile (Asumsi ada 1 row utama)
        $company = Company::first();

        // Mengambil Layanan (Limit 6 agar layout rapi)
        $services = Service::latest()->take(6)->get();

        // Mengambil Portfolio/Project
        $projects = Project::latest()->take(3)->get();

        // Mengambil Testimonial
        $testimonials = Testimonial::latest()->get();

        // Mengambil Settings (untuk No HP, Email, Alamat di footer/contact)
        // Asumsi Setting menyimpan key-value pairs
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('landing.index', compact(
            'company',
            'services',
            'projects',
            'testimonials',
            'settings'
        ));
    }

    public function storeLead(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Simpan ke tabel Leads
        Lead::create([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'subject' => $validated['subject'] ?? 'New Inquiry from Landing Page',
            'message' => $validated['message'],
            'status'  => 'new', // Default status
        ]);

        return redirect()->route('home', '#contact')->with('success', 'Pesan Anda telah terkirim! Tim kami akan segera menghubungi Anda.');
    }
}

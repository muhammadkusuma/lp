<?php
namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Lead;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display landing page
     */
    public function index()
    {
        // Mengambil data Company Profile
        $company = Company::first();

        // Mengambil Layanan (Limit untuk tampilan landing)
        $services = Service::where('status', 'active')->latest()->take(8)->get();

        // Mengambil Portfolio/Project (Limit 6 untuk grid)
        $projects = Project::latest()->take(6)->get();

        // Mengambil Settings sebagai array key-value
        $settings = $this->getSettings();

        return view('landing.index', compact(
            'company',
            'services',
            'projects',
            'settings'
        ));
    }

    /**
     * Store contact form submission
     */
    public function storeLead(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'message.required' => 'Pesan wajib diisi',
        ]);

        // Simpan ke tabel Contacts
        Contact::create([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'message' => $validated['message'],
        ]);

        // Juga simpan ke Leads untuk tracking
        Lead::create([
            'name'   => $validated['name'],
            'email'  => $validated['email'],
            'source' => 'Website Landing Page',
            'status' => 'new',
        ]);

        return redirect()->route('home', '#contact')->with('success', 'Terima kasih! Pesan Anda telah terkirim. Tim kami akan segera menghubungi Anda.');
    }

    /**
     * Get settings as key-value array
     */
    private function getSettings()
    {
        $settingsArray = Setting::pluck('value', 'key')->toArray();

        // Set default values jika tidak ada di database
        return array_merge([
            'site_name' => 'PT Maju Bersama Teknologi',
            'site_description' => 'Solusi Teknologi Informasi Terpercaya',
            'contact_email' => 'info@majubersamatek.co.id',
            'contact_phone' => '021-5551234',
            'address' => 'Jakarta, Indonesia',
            'facebook_url' => '#',
            'instagram_url' => '#',
            'linkedin_url' => '#',
        ], $settingsArray);
    }

    /**
     * Show service detail page
     */
    public function showService($id)
    {
        $service = Service::findOrFail($id);
        $settings = $this->getSettings();
        $relatedServices = Service::where('status', 'active')
            ->where('id', '!=', $id)
            ->latest()
            ->take(3)
            ->get();

        return view('landing.service-detail', compact('service', 'settings', 'relatedServices'));
    }

    /**
     * Show portfolio/project detail page
     */
    public function showPortfolio($id)
    {
        $project = Project::findOrFail($id);
        $settings = $this->getSettings();
        $relatedProjects = Project::where('id', '!=', $id)
            ->latest()
            ->take(3)
            ->get();

        return view('landing.portfolio-detail', compact('project', 'settings', 'relatedProjects'));
    }

    /**
     * Show about page
     */
    public function about()
    {
        $company = Company::first();
        $settings = $this->getSettings();
        
        return view('landing.about', compact('company', 'settings'));
    }
}

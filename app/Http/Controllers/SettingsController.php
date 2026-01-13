<?php
namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        // Mengambil semua setting dan mengubahnya menjadi array [key => value]
        // Contoh akses di view: $settings['app_name']
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'app_name'      => 'nullable|string|max:255',
            'company_email' => 'nullable|email',
            'app_logo'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // List key yang ingin disimpan selain file
        $data = $request->only(['app_name', 'company_email', 'company_phone', 'company_address']);

        // Loop untuk menyimpan data text biasa
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Handle Upload Logo secara khusus
        if ($request->hasFile('app_logo')) {
            // Hapus logo lama jika ada (opsional, perlu logic tambahan untuk cek file lama)

            $path = $request->file('app_logo')->store('public/settings');
            // Simpan path tanpa 'public/' agar mudah diakses via Storage::url
            $path = str_replace('public/', '', $path);

            Setting::updateOrCreate(['key' => 'app_logo'], ['value' => $path]);
        }

        return redirect()->route('settings.index')->with('success', 'Pengaturan berhasil diperbarui!');
    }
}

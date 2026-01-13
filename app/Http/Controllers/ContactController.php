<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Menampilkan daftar pesan masuk.
     */
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Menampilkan detail pesan tertentu.
     */
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    /**
     * Menghapus pesan.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')
            ->with('success', 'Pesan kontak berhasil dihapus');
    }
}
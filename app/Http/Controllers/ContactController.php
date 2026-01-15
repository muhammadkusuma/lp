<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of contacts
     */
    public function index()
    {
        $contacts = Contact::latest()->paginate(20);
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Display the specified contact
     */
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    /**
     * Remove the specified contact from storage
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Pesan kontak berhasil dihapus');
    }
}

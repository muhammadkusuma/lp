<?php
namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        // Mengambil data testimonial terbaru
        $testimonials = Testimonial::latest()->get();
        return view('testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'content'     => 'required|string',
            'rating'      => 'required|integer|min:1|max:5',
        ]);

        Testimonial::create($request->all());

        return redirect()->route('testimonials.index')->with('success', 'Testimonial berhasil ditambahkan');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'content'     => 'required|string',
            'rating'      => 'required|integer|min:1|max:5',
        ]);

        $testimonial->update($request->all());

        return redirect()->route('testimonials.index')->with('success', 'Testimonial berhasil diperbarui');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('testimonials.index')->with('success', 'Testimonial berhasil dihapus');
    }
}

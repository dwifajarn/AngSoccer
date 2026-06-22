<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LapanganController extends Controller
{
    public function index(Request $request)
    {
        $query = Lapangan::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }

        if ($request->filled('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $fields = $query->paginate(10);

        return view('admin.lapangan', compact('fields'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'surface' => 'required|string',
            'price_per_hour' => 'required|integer|min:0',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:5120', // Max 5MB
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('fields', 'public');
            $imageUrl = Storage::url($path);
        }

        Lapangan::create([
            'name' => $request->name,
            'type' => $request->type,
            'surface' => $request->surface,
            'price_per_hour' => $request->price_per_hour,
            'location' => $request->location,
            'description' => $request->description,
            'image_url' => $imageUrl ?? 'https://via.placeholder.com/640x480.png?text=Lapangan+AngSoccer',
            'rating' => 5.0,
            'status' => 'active',
        ]);

        return redirect()->route('admin.lapangan.index')->with('success', 'Lapangan baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'surface' => 'required|string',
            'price_per_hour' => 'required|integer|min:0',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive',
            'image' => 'nullable|image|max:5120', // Max 5MB
        ]);

        $field = Lapangan::findOrFail($id);

        $data = [
            'name' => $request->name,
            'type' => $request->type,
            'surface' => $request->surface,
            'price_per_hour' => $request->price_per_hour,
            'location' => $request->location,
            'description' => $request->description,
            'status' => $request->status,
        ];

        if ($request->hasFile('image')) {
            if ($field->image_url && !str_starts_with($field->image_url, 'http')) {
                $oldPath = str_replace(Storage::url(''), '', $field->image_url);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('image')->store('fields', 'public');
            $data['image_url'] = Storage::url($path);
        }

        $field->update($data);

        return redirect()->route('admin.lapangan.index')->with('success', 'Lapangan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $field = Lapangan::findOrFail($id);
        $field->delete();

        return redirect()->route('admin.lapangan.index')->with('success', 'Lapangan berhasil dihapus!');
    }
}

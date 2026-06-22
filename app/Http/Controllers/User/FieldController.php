<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function index(Request $request)
    {
        $query = Lapangan::query()->where('status', 'active');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }

        $fields = $query->paginate(6);

        return view('fields.index', compact('fields'));
    }

    public function show($id)
    {
        $field = Lapangan::findOrFail($id);
        $bookings = \App\Models\Booking::where('lapangan_id', $id)
            ->whereIn('status', ['paid', 'pending'])
            ->where('date', '>=', today()->toDateString())
            ->get(['date', 'time', 'duration']);

        return view('booking.create', compact('field', 'bookings'));
    }
}

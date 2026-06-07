<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidangController extends Controller
{
    private function authorizeAdminTu()
    {
        if (Auth::user()->role !== 'admin_tu') {
            abort(403);
        }
    }

    public function index()
    {
        $this->authorizeAdminTu();

        $bidangs = Bidang::latest()->get();

        return view('bidangs.index', compact('bidangs'));
    }

    public function create()
    {
        $this->authorizeAdminTu();

        return view('bidangs.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdminTu();

        $request->validate([
            'nama_bidang' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Bidang::create([
            'nama_bidang' => $request->nama_bidang,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('bidangs.index')
            ->with('success', 'Data bidang berhasil ditambahkan.');
    }

    public function edit(Bidang $bidang)
    {
        $this->authorizeAdminTu();

        return view('bidangs.edit', compact('bidang'));
    }

    public function update(Request $request, Bidang $bidang)
    {
        $this->authorizeAdminTu();

        $request->validate([
            'nama_bidang' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $bidang->update([
            'nama_bidang' => $request->nama_bidang,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('bidangs.index')
            ->with('success', 'Data bidang berhasil diperbarui.');
    }

    public function destroy(Bidang $bidang)
    {
        $this->authorizeAdminTu();

        $bidang->delete();

        return redirect()->route('bidangs.index')
            ->with('success', 'Data bidang berhasil dihapus.');
    }
}
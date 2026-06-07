<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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

        $users = User::with('bidang')->latest()->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $this->authorizeAdminTu();

        $bidangs = Bidang::latest()->get();

        return view('users.create', compact('bidangs'));
    }

    public function store(Request $request)
    {
        $this->authorizeAdminTu();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin_tu,user_bidang',
            'bidang_id' => 'nullable|exists:bidangs,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'bidang_id' => $request->role === 'user_bidang' ? $request->bidang_id : null,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function destroy(User $user)
    {
        $this->authorizeAdminTu();

        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')
                ->with('success', 'User yang sedang login tidak boleh dihapus.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
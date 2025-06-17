<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View; // Pastikan untuk mengimpor View

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Ambil semua pengguna, kecuali user yang sedang login
        // Eager load relasi 'roles' untuk efisiensi query (menghindari N+1 problem)
        $users = User::with('roles')
                    ->where('id', '!=', auth()->id()) // Opsional: Sembunyikan diri sendiri dari daftar
                    ->latest()
                    ->paginate(10); // Gunakan pagination

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Kita akan mengisi ini nanti
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Kita akan mengisi ini nanti
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Tidak digunakan sesuai definisi rute kita
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Kita akan mengisi ini nanti
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Kita akan mengisi ini nanti
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Kita akan mengisi ini nanti
    }
}

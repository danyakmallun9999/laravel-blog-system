<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\View\View;

class WorkController extends Controller
{
    public function index(): View
    {
        $works = Work::latest()->paginate(9); // Ambil semua works, urutkan terbaru, dengan paginasi

        return view('work.index', compact('works'));
    }

    /**
     * Menampilkan halaman detail untuk sebuah karya/proyek.
     */
    public function show(Work $work): View
    {
        // Mengambil proyek sebelumnya (berdasarkan ID yang lebih kecil dari ID saat ini)
        $previousWork = Work::where('id', '<', $work->id)->orderBy('id', 'desc')->first();

        // Mengambil proyek berikutnya (berdasarkan ID yang lebih besar dari ID saat ini)
        $nextWork = Work::where('id', '>', $work->id)->orderBy('id', 'asc')->first();

        return view('work.show', compact('work', 'previousWork', 'nextWork'));
    }
}

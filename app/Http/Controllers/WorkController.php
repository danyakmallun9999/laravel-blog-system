<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorkController extends Controller
{
    public function index(): View
    {
        $works = Work::latest()->paginate(9); // Ambil semua works, urutkan terbaru, dengan paginasi
        return view('work.index', compact('works'));
    }

    // Jika membuat route untuk detail work:
    // public function show(Work $work): View
    // {
    //     return view('work.show', compact('work'));
    // }
}

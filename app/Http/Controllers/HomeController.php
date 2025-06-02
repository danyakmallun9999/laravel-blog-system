<?php

namespace App\Http\Controllers;

use App\Models\Post; // Import model Post
use App\Models\Work; // Import model Work
use Illuminate\Http\Request;
use Illuminate\View\View; // Import View

class HomeController extends Controller
{
    public function index(): View
    {
        // Ambil beberapa postingan blog terbaru (misal 3)
        $recentPosts = Post::with('category', 'user') // Eager load relasi
                            ->latest() // Urutkan berdasarkan terbaru
                            ->take(3)    // Ambil 3
                            ->get();

        // Ambil beberapa projek pilihan (misal 3, bisa ditambahkan logika 'featured' jika ada)
        $featuredWorks = Work::latest()
                            ->take(3)
                            ->get();

        // Data diri (bisa diletakkan di config, database, atau hardcode sementara)
        $profile = [
            'name' => 'Dany Akmallun Niam',
            'profession' => 'Web Developer | Prompt Engineer | Crypto Enthusiast',
            'bio' => 'I build web solutions, design intelligent interactions with AI, and actively explore the world of cryptocurrency. My expertise includes web development (HTML, CSS, JavaScript), prompt engineering for AI, as well as an understanding of blockchain technology and digital assets',
            'profile_image_url' => 'images/profile.jpg', // Ganti dengan path gambar profilmu di public/images
            'resume_url' => 'resume/my_resume.pdf', // Ganti dengan path resume di public/resume
        ];

        return view('home', compact('recentPosts', 'featuredWorks', 'profile'));
    }
}
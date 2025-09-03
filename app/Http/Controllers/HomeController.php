<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Work;
use Illuminate\View\View;

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
            'profile_image_url' => 'images/profile.jpg',
            'resume_url' => 'resume/my_resume.pdf',
        ];

        return view('home', compact('recentPosts', 'featuredWorks', 'profile'));
    }
}

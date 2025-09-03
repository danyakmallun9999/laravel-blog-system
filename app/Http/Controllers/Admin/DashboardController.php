<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Work;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_posts' => Post::count(),
            'total_works' => Work::count(),
            'total_categories' => Category::count(),
            'total_users' => User::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}

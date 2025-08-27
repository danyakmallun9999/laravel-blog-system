<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Post;
use App\Models\Work;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            "total_posts" => Post::count(),
            "total_works" => Work::count(),
            "total_categories" => Category::count(),
            "total_users" => User::count(),
        ];
        return view("admin.dashboard", compact("stats"));
    }
}

<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category; 
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $postsQuery = Post::with('category', 'user')->latest();

        if ($request->has('category')) {
            $categorySlug = $request->query('category');
            $category = Category::where('slug', $categorySlug)->first();
            if ($category) {
                $postsQuery->where('category_id', $category->id);
            }
        }

        $posts = $postsQuery->paginate(3);
        $categories = Category::orderBy('name')->get();

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(Post $post): View
    {
        $post->load('category', 'user');
        return view('blog.show', compact('post'));
    }
}

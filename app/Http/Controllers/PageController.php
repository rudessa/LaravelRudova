<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class PageController extends Controller
{
    public function home()
    {
        $posts = Post::with(['category', 'tags'])
            ->published()
            ->orderBy('published_at', 'desc')
            ->paginate(10);
        
        $categories = Category::active()
            ->withCount('posts')
            ->get();
        
        $popularTags = Tag::popular()->limit(10)->get();
        
        return view('home', compact('posts', 'categories', 'popularTags'));
    }
    
    public function showPost($slug)
    {
        $post = Post::with(['category', 'tags', 'comments' => function($query) {
            $query->approved()->orderBy('created_at', 'desc');
        }, 'images'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();
        
        $post->increment('views_count');
        
        return view('post', compact('post'));
    }
    
    public function showCategory($slug)
    {
        $category = Category::where('slug', $slug)
            ->active()
            ->firstOrFail();
        
        $posts = Post::with(['category', 'tags'])
            ->where('category_id', $category->id)
            ->published()
            ->orderBy('published_at', 'desc')
            ->paginate(10);
        
        return view('category', compact('category', 'posts'));
    }
    
    public function showTag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        
        $posts = $tag->posts()
            ->with(['category', 'tags'])
            ->published()
            ->orderBy('published_at', 'desc')
            ->paginate(10);
        
        return view('tag', compact('tag', 'posts'));
    }
}
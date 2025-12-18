<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class WebCommentController extends Controller
{
    public function store(Request $request, $postSlug)
    {
        $post = Post::where('slug', $postSlug)->firstOrFail();
        
        $validated = $request->validate([
            'author_name' => 'required|string|max:255',
            'author_email' => 'required|email|max:255',
            'content' => 'required|string|min:10|max:1000',
        ], [
            'author_name.required' => 'Введите ваше имя',
            'author_email.required' => 'Введите ваш email',
            'author_email.email' => 'Введите корректный email',
            'content.required' => 'Напишите комментарий',
            'content.min' => 'Комментарий должен содержать минимум 10 символов',
            'content.max' => 'Комментарий не должен превышать 1000 символов',
        ]);
        
        Comment::create([
            'post_id' => $post->id,
            'author_name' => $validated['author_name'],
            'author_email' => $validated['author_email'],
            'content' => $validated['content'],
            'is_approved' => false, 
        ]);
        
        return redirect()->route('post.show', $postSlug)
            ->with('success', 'Ваш комментарий отправлен на модерацию!');
    }
}
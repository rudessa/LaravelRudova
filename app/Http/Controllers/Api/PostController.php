<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Post::with(['category', 'tags', 'images'])->withCount('comments');

        if ($request->has('published')) {
            $query->published();
        }

        if ($request->has('popular')) {
            $query->popular($request->input('min_views', 100));
        }

        if ($request->has('category_id')) {
            $query->byCategory($request->input('category_id'));
        }

        if ($request->has('recent')) {
            $query->recent($request->input('limit', 10));
        }

        $posts = $query->paginate(15);

        return PostResource::collection($posts)
            ->response()
            ->setStatusCode(200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'status' => 'in:draft,published,archived',
            'published_at' => 'nullable|date',
            'tag_ids' => 'array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $post = Post::create($validated);

        if (isset($validated['tag_ids'])) {
            $post->tags()->attach($validated['tag_ids']);
        }

        return (new PostResource($post->load(['category', 'tags'])))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Post $post): JsonResponse
    {
        $post->load(['category', 'tags', 'comments', 'images']);
        
        $post->increment('views_count');

        return (new PostResource($post))
            ->response()
            ->setStatusCode(200);
    }

    public function update(Request $request, Post $post): JsonResponse
    {
        $validated = $request->validate([
            'category_id' => 'sometimes|exists:categories,id',
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'excerpt' => 'nullable|string',
            'status' => 'in:draft,published,archived',
            'published_at' => 'nullable|date',
            'tag_ids' => 'array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        if (isset($validated['title'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $post->update($validated);

        if (isset($validated['tag_ids'])) {
            $post->tags()->sync($validated['tag_ids']);
        }

        return (new PostResource($post->load(['category', 'tags'])))
            ->response()
            ->setStatusCode(200);
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully'
        ], 200);
    }
}
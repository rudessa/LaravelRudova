<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Comment::with('post');

        if ($request->has('approved')) {
            $query->approved();
        }

        if ($request->has('recent')) {
            $query->recent($request->input('limit', 10));
        }

        $comments = $query->paginate(20);

        return CommentResource::collection($comments)
            ->response()
            ->setStatusCode(200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'author_name' => 'required|string|max:255',
            'author_email' => 'required|email',
            'content' => 'required|string',
        ]);

        $comment = Comment::create($validated);

        return (new CommentResource($comment->load('post')))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Comment $comment): JsonResponse
    {
        $comment->load('post');

        return (new CommentResource($comment))
            ->response()
            ->setStatusCode(200);
    }

    public function update(Request $request, Comment $comment): JsonResponse
    {
        $validated = $request->validate([
            'content' => 'sometimes|string',
            'is_approved' => 'boolean',
        ]);

        $comment->update($validated);

        return (new CommentResource($comment))
            ->response()
            ->setStatusCode(200);
    }

    public function destroy(Comment $comment): JsonResponse
    {
        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted successfully'
        ], 200);
    }
}
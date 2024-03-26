<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Log;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\CommentService;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index()
    {
        return $this->commentService->getAllComments();
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = $this->commentService->createComment($request->all());

        return $comment;
    }

    public function show($commentId)
    {
        return $this->commentService->getComment($commentId);
    }

    public function update(Request $request, $commentId)
    {
        $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
        ]);

        $this->commentService->updateComment($commentId, $request->all());

        return $this->commentService->getComment($commentId);
    }

    public function destroy($commentId)
    {
        $this->commentService->deleteComment($commentId);

        return response()->json(null, 204);
    }
    
}

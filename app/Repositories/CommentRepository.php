<?php
namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    public function create(array $data)
    {
        return Comment::create($data);
    }

    public function update(Comment $comment, array $data)
    {
        $comment->update($data);
        return $comment;
    }

    public function delete(Comment $comment)
    {
        $comment->delete();
    }

    public function find($id)
    {
        return Comment::findOrFail($id);
    }

    public function all()
    {
        return Comment::all();
    }
}
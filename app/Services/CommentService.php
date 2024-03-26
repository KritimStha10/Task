<?php

namespace App\Services;

use App\Repositories\CommentRepository;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function createComment(array $data)
    {
        return $this->commentRepository->create($data);
    }

    public function updateComment($commentId, array $data)
    {
        $comment = $this->commentRepository->find($commentId);
        return $this->commentRepository->update($comment, $data);
    }

    public function deleteComment($commentId)
    {
        $comment = $this->commentRepository->find($commentId);
        $this->commentRepository->delete($comment);
    }

    public function getComment($commentId)
    {
        return $this->commentRepository->find($commentId);
    }

    public function getAllComments()
    {
        return $this->commentRepository->all();
    }
}

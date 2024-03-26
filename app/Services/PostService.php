<?php

namespace App\Services;

use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Log;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts()
    {
        return $this->postRepository->getAllPosts();
    }

    public function createPost($data)
    {
        $post = $this->postRepository->create($data);
        $this->logAction(auth()->id(), 'created', $post->id, 'Post');
        return $post;
    }

    public function updatePost($post, $id)
    {
        $post = $this->postRepository->update($post, $id);
        $this->logAction(auth()->id(), 'updated', $post->id, 'Post');
        return $post;
    }

    public function deletePost($post)
    {
        $this->postRepository->delete($post);
        $this->logAction(auth()->id(), 'deleted', $post->id, 'Post');
    }

    private function logAction($userId, $actionType, $resourceId, $resourceType)
    {
        if ($userId !== null) {
            try {
                Log::info("User with ID $userId $actionType $resourceType with ID $resourceId");
            } catch (\Exception $e) {
                Log::error('Error occurred while logging action: ' . $e->getMessage());
            }
        } else {
            Log::error('Error occurred while logging action: User ID is null.');
        }
    }
}
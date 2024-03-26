<?php
namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    public function getAllPosts()
    {
        return Post::all();
    }

    public function create($data)
    {
        return Post::create($data);
    }

    public function update($post, $data)
    {
        $post->update($data);
        return $post;
    }

    public function delete($post)
    {
        $post->delete();
    }
}
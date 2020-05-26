<?php

namespace App\Service\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Models\Post;
use Auth;
use Hash;

class PostService implements PostServiceInterface
{
    private $PostDao;

    /**
    * Class Constructor
    * @param OperatorPostDaoInterface
    * @return
    */
    public function __construct(PostDaoInterface $PostDao)
    {
        $this->PostDao = $PostDao;
    }

    public function confirmPost($request)
    {
        $post = new Post;
        $post->title = $request->title ;
        $post->description = $request->description;
        return $post;
    }

    public function storePost($request) 
    {
        $post = new Post;
        $post->title = $request->title ;
        $post->description = $request->description;
        $post->create_user_id = Auth::user()->id;
        $post->updated_user_id =Auth::user()->id;
        $post->created_at = now();
        $post->updated_at = now();
        return $this->PostDao->storePost($post);
    }

    public function showPost($postdata)
    {
        return $this->PostDao->showPost($postdata);
    }

    public function searchPost($postdata)
    {
        return $this->PostDao->searchPost($postdata);
    }

    public function destroy($id) 
    {
        return $this->PostDao->destroy($id);
    }

    public function updateConfirmPost($request)
    {
        $post = new Post();
        $post = Post::find($request->input('id'));
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->status = $request->input('status');
        return $post;
    }

    public function update($post) 
    {
        return $this->PostDao->update($post);
    }
    
}


















?>
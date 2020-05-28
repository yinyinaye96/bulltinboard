<?php

namespace App\Service\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Models\Post;

/**
 * SystemName : bulletinboard
 * ModuleName : Post
 */
class PostService implements PostServiceInterface
{
    private $PostDao;

    /**
     * Class Constructor

     * @param OperatorPostDaoInterface $PostDao
     * @return
     */
    public function __construct(PostDaoInterface $PostDao)
    {
        $this->PostDao = $PostDao;
    }


    /**
     * Confirm Post Function
     *
     * @param $request
     * @return void
     */
    public function confirmPost($request)
    {
        session([
            'title' => $request->title,
            'description' => $request->description
        ]);
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        return $post;
    }

    /**
     * Store Post function
     * 
     *  @param $request
     *  @return void
     */
    public function storePost($request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->create_user_id = auth()->user()->id;
        $post->updated_user_id = auth()->user()->id;
        $post->created_at = now();
        $post->updated_at = now();
        return $this->PostDao->storePost($post);
    }
    /**
     * Show Post list
     *  
     *  @param $postdata
     *  @return void
     */
    public function showPost($postdata)
    {
        return $this->PostDao->showPost($postdata);
    }

    /**
     * Search Post Function
     *  
     *  @param  $postdata
     *  @return void
     */
    public function searchPost($postdata)
    {
        return $this->PostDao->searchPost($postdata);
    }

    /**
     * Soft Delate Post Function
     *  
     *  @param $id
     *  @return void
     */
    public function destroy($id)
    {
        return $this->PostDao->destroy($id);
    }

    /**
     * Update Confirm Post Function
     *  
     *  @param $request
     *  @return void
     */
    public function updateConfirmPost($request)
    {
        $post = new Post();
        $post = Post::find($request->input('id'));
        $post->title = $request->title;
        $post->description = $request->description;
        $post->status = $request->status;
        return $post;
    }

    /**
     * Update Post Function
     *  
     *  @param $post
     *  @return void
     */
    public function update($post)
    {
        return $this->PostDao->update($post);
    }
}

<?php

namespace App\Contracts\Services\Post;

interface PostServiceInterface
{
    /**
     * Confirm Post Function
     *
     * @param $request
     * @return void
    */
    public function confirmPost($request);

    /**
     * Store Post function
     * 
     *  @param $request
     *  @return void
    */
    public function storePost($request);

    /**
     * Show Post list
     *  
     *  @param $postdata
     *  @return void
    */
    public function showPost($postdata);

    /**
     * Search Post Function
     *  
     *  @param  $postdata
     *  @return void
    */
    public function searchPost($postdata);

    /**
     * Soft Delate Post Function
     *  
     *  @param $id
     *  @return void
    */
    public function destroy($id);

    /**
     * Update Confirm Post Function
     *  
     *  @param $request
     *  @return void
    */
    // public function updateConfirmPost($request);

    /**
     * Update Post Function
     *  
     *  @param $post
     *  @return void
    */
    public function update($post);
    
}






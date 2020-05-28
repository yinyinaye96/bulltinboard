<?php

namespace App\Contracts\Dao\Post;

interface PostDaoInterface
{
    /**
     * Store Post function
     * 
     *  @param $post
     *  @return void
    */
    public function storePost($post);

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
     *  @param  $request
     *  @return void
    */
    public function searchPost($request);

    /**
     * Soft Delate Post Function
     *  
     *  @param $id
     *  @return void
    */
    public function destroy($id);

    /**
     * Update Post Function
     *  
     *  @param $post
     *  @return void
    */
    public function update($post);
}






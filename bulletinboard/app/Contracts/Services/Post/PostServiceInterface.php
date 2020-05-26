<?php

namespace App\Contracts\Services\Post;

interface PostServiceInterface
{
    public function confirmPost($request);

    public function storePost($request);

    public function showPost($postdata);

    public function searchPost($postdata);

    public function destroy($id);

    public function updateConfirmPost($request);

    public function update($post);
    
}






?>
<?php

namespace App\Contracts\Dao\Post;

interface PostDaoInterface
{
    public function storePost($post);

    public function showPost($postdata);

    public function searchPost($request);

    public function destroy($id);

    public function update($post);
}






?>
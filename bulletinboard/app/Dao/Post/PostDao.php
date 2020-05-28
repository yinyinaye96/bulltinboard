<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;
use DB;
use Auth;

/**
 * SystemName : bulletinboard
 * ModuleName : Post
*/
class PostDao implements PostDaoInterface
{
    /**
     * Store Post function
     * 
     *  @param $post
     *  @return void
    */
    public function storePost($post)
    {
        $storepost = new Post ([
            'title' => $post->title,
            'description' => $post->description,
            'create_user_id' => $post->create_user_id,
            'updated_user_id' => $post->updated_user_id,
        ]);
        $storepost->save();
        return back();
    }

    /**
     * Show Post list
     *  
     *  @param $postdata
     *  @return void
    */
    public function showPost($postdata)
    {
        $postdata = new Post;
        $postdata = Post::with('users')->paginate(10);
        return $postdata;
    }

    /**
     * Search Post Function
     *  
     *  @param  $request
     *  @return void
    */
    public function searchPost($request)
    {
        session(['search' => $request->search]);
        $search = $request -> get('search');
        $postdata = Post::with('users')
        ->where('title', 'LIKE', '%' . $search . '%' )
        ->orWhere('description', 'LIKE', '%' . $search . '%' )
        ->orWhereHas('users', function($query) use ($search){

            $query->where('name', 'like', '%'. $search. '%');

        })
        ->orderBy('id','ASC')
        -> paginate(10);
        return $postdata;
    }

    /**
     * Soft Delate Post Function
     *  
     *  @param $id
     *  @return void
    */
    public function destroy($id)
    {
        Post::find($id)->delete();
        return back();
    }

    /**
     * Update Post Function
     *  
     *  @param $request
     *  @return void
    */
    public function update($request) {
        $post = new Post();
        $post = Post::find($request->input('id'));
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->status = $request->input('status');
        if (is_null($post->status)) {
            $post->status = '0';
        }
        $post->updated_user_id =Auth::user()->id;
        $post->updated_at = now();
        $post->save();
        return $post;
    }
}










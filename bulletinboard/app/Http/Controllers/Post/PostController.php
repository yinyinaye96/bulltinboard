<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Services\Post\PostService;
use App\Http\Requests\PostComfirmRequest;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Download;
use App\Imports\CSVFile;
use Illuminate\Http\Response;


class PostController extends Controller
{
    private $PostService;

    /**
     * Create a new controller instance.
     *
     * @param PostServiceInterface $PostService
     */
    public function __construct(PostServiceInterface $PostService)
    {
        $this->middleware('auth', ['except' => ['showPost','searchPost']]);
        $this->PostService = $PostService;
    }
    public function createPost()
    {
        return view('posts.create-post');
    }

    public function confirmPost(PostComfirmRequest $request)
    {
        $validator = $request->validated();
        $post = $this->PostService->confirmPost($request);
        return view('posts.create-post-comfirm', compact('post'));

    }

    public function storePost(Request $request)
    {
        $post = $this->PostService->storePost($request);
        return redirect('posts/postlist');
    }

    public function showPost()
    {
        session()->forget([
            'search'
        ]);
        $postdata = new Post;
        $postdata = $this->PostService->showPost($postdata);
        return view('posts.post-list', compact('postdata'));
    }

    public function searchPost(Request $request) 
    {
        $postdata = $this->PostService->searchPost($request);
        return view('posts.post-list',compact('postdata'));
    }

    public function destroy($id)
    {  
        $post = Post::find($id);
        $post->deleted_user_id = Auth::user()->id;
        $post->save();
        $this->PostService->destroy($id);
        return redirect('posts/postlist');
    }

    public function editPost($id)
    {
       
        $post = Post::find($id);
        return view('posts.update-post', compact('post'));
    }

    public function updateConfirmPost(PostComfirmRequest $request)
    {
        $validator = $request->validated();
        $post = $this->PostService->updateConfirmPost($request);
        return view('posts.update-post-comfirm', compact('post'));
    }

    public function update(Request $request) 
    {
        $post = $this->PostService->update($request);
        return redirect('/posts/postlist');
    }

    
    public function export(Request $request){
    	return Excel::download(new Download, 'posts.csv');
    }

    public function uploadPost()
    {
        return view('posts.upload-csv');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt', 
        ]);
        if (empty($request->file('file')->getRealPath())) 
        {
            return back()->with('success','No file selected');
        }
        else 
        {
            Excel::import(new CSVFile, $request->file('file'));
            return redirect('/posts/postlist');

        }
    }
    
} 

<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Http\Requests\PostComfirmRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Download;
use App\Imports\CSVFile;

/**
 * SystemName : bulletinboard
 * ModuleName : Post
 */
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
        $this->middleware('auth', ['except' => ['showPost', 'searchPost', 'export']]);
        $this->PostService = $PostService;
    }

    /**
     * Show Create Post Form
     * 
     *  @return void
     */
    public function createPost()
    {
        return view('posts.create-post');
    }

    /**
     * Show Create confirmPost function
     * 
     *  @param PostComfirmRequest $request
     *  @return void
     */
    public function confirmPost(PostComfirmRequest $request)
    {
        $validator = $request->validated();
        $post = $this->PostService->confirmPost($request);
        return view('posts.create-post-comfirm', compact('post'));
    }

    /**
     * Store Post function
     * 
     *  @param Request $request
     *  @return void
     */
    public function storePost(Request $request)
    {
        session()->forget([
            'title',
            'description'
        ]);
        $post = $this->PostService->storePost($request);
        return redirect('posts/postlist');
    }

    /**
     * Show Post list
     *  
     *  @return void
     */
    public function showPost()
    {
        session()->forget([
            'search'
        ]);
        $postdata = new Post;
        $postdata = $this->PostService->showPost($postdata);
        return view('posts.post-list', compact('postdata'));
    }

    /**
     * Search Post Function
     *  
     *  @param Request $request
     *  @return void
     */
    public function searchPost(Request $request)
    {
        $postdata = $this->PostService->searchPost($request);
        return view('posts.post-list', compact('postdata'));
    }

    /**
     * Soft Delate Post Function
     *  
     *  @param $id
     *  @return void
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->deleted_user_id = auth()->user()->id;
        $post->save();
        $this->PostService->destroy($id);
        return redirect('posts/postlist');
    }

    /**
     * Edit Post Function
     *  
     *  @param $id
     *  @return void
     */
    public function editPost($id)
    {
        $post = Post::find($id);
        return view('posts.update-post', compact('post'));
    }

    /**
     * Update Confirm Post Function
     *  
     *  @param PostComfirmRequest $request
     *  @return void
     */
    public function updateConfirmPost(PostComfirmRequest $request)
    {
        $validator = $request->validated();
        $post = $this->PostService->updateConfirmPost($request);
        return view('posts.update-post-comfirm', compact('post'));
    }

    /**
     * Update Post Function
     *  
     *  @param Request $request
     *  @return void
     */
    public function update(Request $request)
    {
        $post = $this->PostService->update($request);
        return redirect('/posts/postlist');
    }

    /**
     * Download Post Function
     *  
     *  @param Request $request
     *  @return void
     */
    public function export(Request $request)
    {
        return Excel::download(new Download, 'posts.csv');
    }

    /**
     * Show Upload Post Form
     *  
     *  @return void
     */
    public function uploadPost()
    {
        return view('posts.upload-csv');
    }

    /**
     * Upload File Function
     *  
     *  @param Request $request
     *  @return void
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|unique:posts,title',
        ]);
        $files = $request->file('file');
        $destinationPath = 'uploadedfile/' . auth()->user()->id . '/csv';
        $filename = $files->getClientOriginalName();
        $extension = $files->getClientOriginalExtension();
        if (file_exists(public_path($destinationPath = 'uploadedfile/' . auth()->user()->id . '/csv' . $filename))) {
            return redirect('/posts/uploadpost')->with('duplicate', 'Duplicate Post Upload');
        } else {
            Excel::import(new CSVFile, $files);
            $files->move($destinationPath, $filename);
            return redirect('/posts/postlist');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthenticationService;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {

        $this->postService = $postService;
    }

    public function index()
    {
        return  $this->postService->index();
    }

    public function createPost()
    {

        return view('post.create');
    }

    public function submitPost(Request $request)
    {
        return $this->postService->submitPost($request);
    }

    public function deletetPost($id = null)
    {
        return $this->postService->deletetPost($id);
    }
}
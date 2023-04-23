<?php

namespace App\Services;

use Auth;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth as FacadesAuth;


class PostService
{

    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $posts = Posts::all();

            return view('admin.post', compact('posts'));
        }
        $posts = Posts::select('id', 'title', 'description', 'file')->where('user_id', Auth::user()->id)->get();

        return view('post.list', compact('posts'));
    }

    public function submitPost($request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'file' => ['required', 'array'],
            'file.*' => ['image'],
        ]);

        $files = [];
        if ($request->hasfile('file')) {
            foreach ($request->file('file') as  $key => $file) {
                $name = time() . rand(1, 50) . '.' . $file->extension();

                $file->move(public_path('files'), $name);
                $files[$key] = $name;
            }
        }

        Posts::insert([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'file' => implode(',', $files)
        ]);

        return redirect()->route('home')->with('sucess', 'Post created successfully');
    }

    public function deletetPost($id)
    {
        Posts::whereId($id)->delete();

        return redirect()->back()->with('sucess', 'Post deleted successfully');
    }
}
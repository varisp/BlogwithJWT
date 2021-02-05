<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Post $post)
    {
        $posts = auth()->user()->posts;  // this is relationship one to many method
        // $posts = Post::where(['user_id' => auth()->id()])->get(); // this is manual method

        return view('home', compact('posts'));
    }
    public function create()
    {
        return view('create');
    }
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255|unique:posts',
            'description' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images', $filename, 'public');
            $data = $request->all();
            $data['image'] = $filename;
            $data['user_id'] = Auth::id();
            Post::create($data);
            return redirect('home')->with('message', 'Post created successfully');
        }

        $data = $request->all();
        $data['image'] = "";
        $data['user_id'] = Auth::id();
        Post::create($data);
        return redirect('home')->with('message', 'Post created successfully');
    }
    public function delete(Request $request)
    {
        //dd($request->all());
        Post::where(['id' => $request->id])->delete();
        return redirect()->back()->with('message', 'post deleted');
    }
    public function view(Request $request)
    {
        $post = Post::find($request->id);
        return view('view', compact('post'));
    }
    public function edit(Request $request)
    {
        $post = Post::find($request->id);
        return view('edit', compact('post'));
    }

    public function update(Request $request)
    {
        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images', $filename, "public");
            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $data['user_id'] = auth()->id();
            $data['image'] = $filename;
            Post::where(['id' => $request->id])->update($data);
            return redirect('home')->with('message', 'Post updated successfully');
        }
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        $data['user_id'] = auth()->id();
        Post::where(['id' => $request->id])->update($data);
        return redirect('home')->with('message', 'Post updated successfully');
    }
}

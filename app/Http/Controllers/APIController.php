<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function getposts()
    {
        $id = auth()->user()->id;
        $data = Post::where(['user_id' => $id])->get();
        return response()->json($data);
    }
    public function postposts(Request $request)
    {
        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images', $filename, "public");
            $request->validate([
                'title' => "required|unique:posts|max:255",
                'description' => "required"
            ]);
            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $data['user_id'] = auth()->user()->id;
            $data['image'] = $filename;
            Post::create($data);
            return response()->json(['Records saved successfully']);
        }
        $request->validate([
            'title' => "required|unique:posts|max:255",
            'description' => "required"
        ]);
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        $data['user_id'] = auth()->user()->id;
        $data['image'] = "";
        Post::create($data);
        return response()->json(['Records saved successfully']);
    }
    public function edit(Request $request)
    {
        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images', $filename, "public");
            $request->validate([
                'title' => "required",
                'description' => 'required'
            ]);
            $data = [];
            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $data['image'] = $filename;
            Post::where(['id' => $request->id])->update($data);
            return response()->json(['records updated successfully']);
        }
        $request->validate([
            'title' => "required",
            'description' => 'required'
        ]);
        $data = [];
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        $data['image'] = "";
        Post::where(['id' => $request->id])->update($data);
        return response()->json(['records updated successfully']);
    }
    public function delete(Request $request)
    {
        Post::where(['id' => $request->id])->delete();
        return response()->json(['records deleted successfully']);
    }
}

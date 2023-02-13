<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coment;
use App\Models\Post;

class ComentController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
    }

    public function store(Request $request, $post_id)
    {
        //dd($request->input('coment'));
        $post = Post::where('id', $post_id)->first();
        if ($post->user_id != auth()->user()->id) return abort(403);
        $coment = Coment::create([
            'post_id' => $post_id,
            'body' => $request->input('coment'),
        ]);

        return redirect('/posts/' . $post_id);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

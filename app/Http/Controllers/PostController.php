<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Http\Requests\FormValidationRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // try {
        // $dbname = DB::connection()->getDatabaseName();
        // return "Connected database name is: {$dbname}";
        //Получение данных
        // 1
        //$posts = DB::select('select * from posts');

        //2
        //$posts = DB::select('select * from posts where id = ?', [7]);

        //3
        // $posts = DB::select('select * from posts where id = :id', ['id' => 7]);

        //4
        // $posts = DB::table('posts')
        //     ->where('id', 7) //->where('id','=' ,7)
        //     ->orWhere('id', 8)
        //     ->get();

        //5
        // $posts = DB::table('posts')
        //     ->whereBetween('id', [7,10])
        //     ->get();

        //6
        // $posts = DB::table('posts')
        //     ->find(2);

        //7
        //  $posts = DB::table('posts')
        //  ->count();

        //  Добавленеи новых данных
        // $posts = DB::table('posts')
        //     ->insert([
        //         'title' => 'New Title', 'body' => 'New Body'
        //     ]);
        //  Изменение данных
        // $posts = DB::table('posts')
        //     ->where('id', '=', 1)
        //     ->update([
        //         'title' => 'UPDATED Title'
        //     ]);
        //    Удаление данных
        // $posts = DB::table('posts')
        //     ->where('id', '=', 1)
        //     ->delete();

        // dd($posts);
        // } catch (\Exception $e) {
        //     return "Error in connecting to the database";
        // }
        //$posts = Post::where('id', 1)->findOrFail(1);
        if (auth()->user() == null) return redirect('/login');
        $posts = Post::where('user_id', '=', auth()->user()->id)->paginate(5);
        // $posts = Post::all()->toArray();
        // $posts = Post::all()->toJson();
        return view('posts.index', [
            'posts' => $posts
        ]);
    }


    public function create()
    {
        if (auth()->user() == null) return redirect('/login');
        return view('posts.create');
    }

    
    public function store(Request $request)
    {
        if (auth()->user() == null) return redirect('/posts');
        // dd(auth()->user());


        $aa = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image_post' => 'mimes:jpg,png,jpeg,gif,svg|max:5048'
        ]);
        $new_image_name = null;
        if($request->file('image_post')){
            $new_image_name = time() . '.' . $request->file('image_post')->extension();
            $request->file('image_post')->move(public_path('images'), $new_image_name);
        }
        
        // $request->validate();
        $post = Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'image_path' => $new_image_name,
            'user_id' => auth()->user()->id
        ]);
        // $post = new Post;
        // $post->title = $request->input('title');
        // $post->body = $request->input('body');
        // $post->save();
        return redirect('/posts');
    }


    public function show($id)
    {
        if (auth()->user() == null) return redirect('/login');
        if (!is_numeric($id)) return abort(404);
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

  
    public function edit($id)
    {
        if (auth()->user() == null) return redirect('/login');
        if (!is_numeric($id)) return abort(404);
        $post = Post::where('id', $id)->first();
        if ($post->user_id != auth()->user()->id) return abort(403);
        return view('posts.edit')->with('post', $post);
    }


    public function update(Request $request, $id)
    {
        if (auth()->user() == null) return redirect('/login');
        if (!is_numeric($id)) return abort(404);
        // $request->validate();
        $post = Post::where('id', $id)->first();
        if ($post->user_id != auth()->user()->id) return abort(403);
        $request->validate(
            [
                'title' => 'required',
                'body' => 'required',
                'image_post' => 'mimes:jpg,png,jpeg|max:5048'
            ],
            // [
            //     'name.required' => 'Поле Название статьи обязательно для заполнения',
            //     'body.required'  => 'Поле Текст статьи обязательно для заполнения',
            // ]
        );
        $post->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return redirect('/posts');
    }


    public function destroy($id)
    {
        if (auth()->user() == null) return redirect('/login');
        if (!is_numeric($id)) return abort(404);
        $post = Post::where('id', $id)->first();
        if ($post->user_id != auth()->user()->id) return abort(403);
        $post->delete();
        return redirect('/posts');
    }
}

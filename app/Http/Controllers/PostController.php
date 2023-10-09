<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    /******************** LISTAR **********************/

    public function index()
    {
        $posts = Post::latest()->paginate();
        return view('posts.index', ['posts' => $posts]);
    }

    /*************************************************/


    /************** FORMULARIO CREAR ****************/

    public function create(Post $post)
    {
        return view('posts.create', ['post' => $post]);
    }

    /*************************************************/


    /********************* CREAR ********************/

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug',
            'body'  => 'required',


        ]);
        $post = $request->user()->posts()->create([
            'title' => $request->title,
            'slug'  => $request->slug,
            'body'  => $request->body,

        ]);

        return redirect()->route('posts.edit', $post);
    }

    /*************************************************/

    /* FORMULARIO EDITAR */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /* EDITAR */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'body'  => 'required',

        ]);
        $post->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'body' => $request->body,

        ]);

        return redirect()->route('posts.edit', $post);
    }

    /* ELIMINAR */
    public function destroy(Post $post) // Elimina elementos de la DB
    {
        $post->delete();
        return back();
    }
}

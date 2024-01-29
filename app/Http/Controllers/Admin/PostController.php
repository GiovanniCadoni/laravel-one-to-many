<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Type;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all(); 
        return view('admin.posts.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $form_data = $request->validated();
        $post = new Post();
        $post->titolo = $form_data['titolo'];
        $post->type_id = $form_data['type_id'];
        $post->contenuto = $form_data['contenuto'];
        $post->slug = Str::slug($form_data['titolo']);
        if($request->hasFile('cover_image')) {
            $path = Storage::put('post_images', $request->cover_image);
            $post->cover_image = $path;
        }
        $post->save();

        return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $types = Type::all();
        return view('admin.posts.edit', compact('post', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, $id)
    {
        $form_data = $request->validated();
        $post_to_update = Post::findOrFail($id);
        $post_to_update->titolo = $form_data['titolo'];
        $post_to_update->type_id = $form_data['type_id'];
        $post_to_update->contenuto = $form_data['contenuto'];
        $post_to_update->slug = Str::slug($form_data['titolo']);
        if($request->hasFile('cover_image')) {
            if($post_to_update->cover_image) {
                Storage::delete($post_to_update->cover_image);
            }
            $path = Storage::put('post_images', $request->cover_image);
            $post_to_update['cover_image'] = $path;

        }
        $post_to_update->save();

        return redirect()->route('admin.posts.show', ['post' => $post_to_update->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        Storage::delete($post->cover_image);
        return redirect()->route('admin.posts.index')->with('message', 'Il post di nome "' . $post->titolo .  '" è stato cancellato con successo');;  
    }
}

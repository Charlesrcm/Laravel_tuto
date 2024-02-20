<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(): View
    {

        Validator::make(
            [
                'title' => '',
            ],
            [
                // 'title' => 'required|min:8|max:15'
            ]
        );

        $post = Post::paginate(25);

        return view('blog.index', [
            'posts' => Post::paginate(1)
        ]);
    }

    public function show(string $slug, Post $post): RedirectResponse | View
    {
        // si le slug en requête ne correspond pas mais que l'id est bon
        if ($post->slug !== $slug) {
            // on redirige vers l'affichage de l'article/ on indique que le slug est celui en bdd, idem pour l'id
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }

        return view('blog.show', [
            'post' => $post
        ]);
    }

    public function store(Request $request)
    {
        $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'slug' => Str::slug($request->input('title'))
        ]);

        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', 'L\'article a bien été suavegardé');
    }


    public function create()
    {
        return view('blog.create');
    }
}


// **** pour la suppression
// $post = Post::find(1);
// $post->delete();

// **** pour la modif en bdd
// $post = Post::find(1);
// $post->title = 'Nouveau titre';
// $post->save();

// return Post::where('id', '>', 0)->get(); // first récupère le 1er élément sinon, get pour tous les éléments avec l'id sup à 0. On peut ajouter ->limit(4) pour une limite d'affichage

// return Post::paginate(1, ['id', 'title']) le premier param est le nombre d'élément affiché, le 2ème quels éléments afficher
// return Post::findOrFail(4) // retourne la page 404
// return Post::all();  // on peut préciser ce que l'on souhaite voir en ajoutant : ['id', 'title', etc]

// return [
// "link" => \route('blog.show', ['slug' => 'article', 'id' => 13]), 
// genre d'htaccess
// ];
<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// regroupage de même routes
Route::prefix('/blog')->name('blog.')->group(function () {
    Route::get('/', function (Request $request) {

        return Post::paginate(25);

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
    })->name('index');


    Route::get('/{slug}-{id}', function (string $slug, string $id) {

        $post = Post::findOrFail($id);
        // si le slug en requête ne correspond pas mais que l'id est bon
        if ($post->slug !== $slug) {
            // on redirige vers l'affichage de l'article/ on indique que le slug est celui en bdd, idem pour l'id
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }

        return $post;
    })->where([ // critères spécifique
        'id' => '[0-9]+',
        'slug' => '[a-z0-9\-]+',
    ])->name('show');
});

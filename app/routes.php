<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/{match?}', array('as' => 'accueil', function ($match = NULL) {
    if($match) {
        $articles = Article::select('id', 'title', 'intro_text')
                            ->orderBy('created_at', 'desc')
                            ->where('intro_text', 'like', '%'.$match.'%')
                            ->orwhere('full_text', 'like', '%'.$match.'%')
                            ->get();
    } else {
        $articles = Article::select('id', 'title', 'intro_text')
                            ->orderBy('created_at', 'desc')
                            ->paginate(4);
    }
    return View::make('accueil',  array(
        'categories' => Categorie::all(),
        'articles' => $articles,
        'actif' => 0
    ));
}));

Route::get('cat/{id}', function($id)
{
    $categories = Categorie::all();
    $categorie = Categorie::find($id);
    if($categorie) {
        $articles = $categorie->articles()->orderBy('created_at', 'desc')->paginate(4);
        return View::make('accueil', array('categories' => $categories, 'articles' => $articles, 'actif' => $id));
    }
    else App::abort(404);
});
App::missing(function($exception)
{
    return 'Cette page n\'existe pas !';
});

Route::get('art/{cat_id}/{art_id}', function($cat_id, $art_id)
{
    $categories = Categorie::all();
    $article = Article::find($art_id);
    if($article) {
        //////////////////////////////////////////////////////////////
        // Log d'un utilisateur pour tester la saisie des commentaires
        $user = User::where('username', '=', 'admin')->first();
        Auth::login($user);
        //////////////////////////////////////////////////////////////
        $comments = $article->comments()->orderBy('comments.created_at', 'desc')
                                    ->join('users', 'users.id', '=', 'comments.user_id')
                                    ->select('users.username', 'title', 'text', 'comments.created_at')
                                    ->get();
        return View::make('article', array('categories' => $categories, 'article' => $article, 'actif' => $cat_id, 'comments' => $comments));
    }
    else App::abort(404);
});

Route::model('cat', 'Categorie');
Route::get('cat/{cat}', function(Categorie $categorie)
{
    $articles = $categorie->articles()->orderBy('created_at', 'desc')->paginate(4);
    return View::make('accueil', array('categories' => Categorie::all(), 'articles' => $articles, 'actif' => $categorie->id));
});

Route::model('art', 'Article');
Route::get('art/{cat_id}/{art}', function($cat_id, Article $article)
{
    $comments = $article->comments()->orderBy('comments.created_at', 'desc')
                                    ->join('users', 'users.id', '=', 'comments.user_id')
                                    ->select('users.username', 'title', 'text', 'comments.created_at')
                                    ->get();
    return View::make('article', array('categories' => Categorie::all(), 'article' => $article, 'actif' => $cat_id, 'comments' => $comments));
});

// Formulaire de recherche

Route::post('find', array('before' => 'csrf', function() {
    $match = Input::get('find');
    if($match) {
        return Redirect::route('accueil', array('match' => $match))
            ->with('flash_notice', 'Résultats pour la recherche du terme '.$match);
    } else {
        return Redirect::route('accueil')
            ->with('flash_error', 'Il faudrait entrer un terme pour la recherche !');
    }
}));
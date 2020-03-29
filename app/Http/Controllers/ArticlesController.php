<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;

class ArticlesController extends Controller

// viser en liste
{
    public function index(){

        if (request('tag')){
            $articles = Tag::where('name', request('tag'))->firstOrFail()->articles;
        return $articles;
        }

        $articles = Article::latest()->get();
        return view('articles.index', ['articles'=>$articles]);
    }

    // Vis eret enkelt objekt
    public function show(Article $article){
        return view('articles.show',['article' => $article]);
    }

    // viser et view som skaber et objekt
    public function create(){

    return view('articles.create',['tags' => Tag::all()
    ]);
    }

    //Denne vil gemme et objekt
    public function store(){
        $this->validateArticle();
      $article = new Article(request(['title', 'excerpt','body']) );
      $article-> user_id = 1;
      $article->save();

       $article->tags()->attach(request('tags'));

    return redirect('/articles');
        //Man skal vise en from for at kunne justere en eksisterende resource
    }

    public function edit(Article $article){
        return view('articles.edit', compact('article'));
}

    public function update(Article $article){


        $article->update($this->validateArticle());

        return redirect('/articles/'. $article->id );
        //Man skal vise en from for at kunne justere en eksisterende resource
    }

    protected function validateArticle(){

        return request()->validate([
            'title'=> 'required',
            'excerpt'=> 'required',
            'body'=> 'required',
            'tags'=> 'exists:tags,id'

            ]);
    }




public function destroy(){

}


}

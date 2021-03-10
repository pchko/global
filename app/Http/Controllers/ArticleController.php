<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArticleRequest $request)
    {
        //
        $fields = $request->validated();


        if(isset($fields['photo'])){
            $img = base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $fields['photo']));
            $type = explode(';', $fields['photo'])[0];
            $type = explode('/', $type)[1]; // png or jpg etc
            $nameImage = uniqid();

            $routeImage = "api/article/$nameImage.$type";

            Storage::disk('public')->put($routeImage, $img );

            $fields['photo'] = Storage::url($routeImage);
        }

        $newArticle = Article::create($fields);

        $article = Article::with(['comments'])->find($newArticle->idArticle);
        $article->photo = asset($article->photo);


        return [
            'code' => 1,
            'message' => 'success',
            'article' => $article
        ];

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($idArticle = NULL)
    {
        //
        $articles = is_null($idArticle) ? Article::with(['comments'])->get() : Article::with(['comments'])->find($idArticle);

         return [
            'code' => 1,
            'message' => 'success',
            'articles' => $articles
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, $idArticle)
    {
        //
        $fields = $request->validated();

        $article = Article::find($idArticle);

        if(is_null($article)) return ['code' => 0, 'message' => 'Not found Article'];


        if(isset($fields['photo'])){
            $img = base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $fields['photo']));
            $type = explode(';', $fields['photo'])[0];
            $type = explode('/', $type)[1]; // png or jpg etc
            $nameImage = uniqid();

            $routeImage = "api/article/$nameImage.$type";

            Storage::disk('public')->put($routeImage, $img );

            $fields['photo'] = Storage::url($routeImage);
        }

        $article->update($fields);
        $article->photo = asset($article->photo);


        return [
            'code' => 1,
            'message' => 'success',
            'article' => $article
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($idArticle){
        //
        $article =  Article::find($idArticle);

         return [
            'code' => !is_null($article) ? 1 : 0,
            'message' => is_null($article) ? false : $article->delete(),
        ];
    }
}

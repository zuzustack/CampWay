<?php

namespace App\Http\Controllers;

use App\Providers\FirebaseServiceProvider;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function getArticle(Request $request){
        $article = new FirebaseServiceProvider();
        $article = $article->connect('articles')->get();

        return response()->json([
            'data' => $article
        ]);
    }

    public function createArticle(Request $request){
        $article = new FirebaseServiceProvider();
        $article = $article->connect('articles');
        $article->create([
            'title' => $request->title,
            'link' => $request->link,
            'body' => $request->body,
            'imageLink' => $request->imageLink
        ]);


        return response()->json([
            'data' => $article->get()
        ]);
    }


    public function updateArticle(Request $request, $id){
        $article = new FirebaseServiceProvider();
        $article = $article->connect('articles');
        $article->update($id,[
            'title' => $request->title,
            'link' => $request->link,
            'body' => $request->body,
            'imageLink' => $request->imageLink
        ]);

        return response()->json([
            'data' => $article->get()
        ]);
    }

    public function deleteArticle($id){
        $article = new FirebaseServiceProvider();
        $article = $article->connect('articles');
        $article->delete($id);

        
        return response()->json([
            'data' => $article->get()
        ]);
    }
}

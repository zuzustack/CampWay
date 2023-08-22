<?php

namespace App\Http\Controllers;

use App\Providers\FirebaseServiceProvider;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function getBook(Request $request){
        $books = new FirebaseServiceProvider();
        $books = $books->connect('books')->get();


        return response()->json([
            'data' => $books
        ]);
    }

    public function createBook(Request $request){
        $books = new FirebaseServiceProvider();
        $books = $books->connect('books');
        $books->create([
            'title' => $request->title,
            'link' => $request->link,
            'imageLink' => $request->imageLink
        ]);


        return response()->json([
            'data' => $books->get()
        ]);
    }


    public function updateBook(Request $request, $id){
        $books = new FirebaseServiceProvider();
        $books = $books->connect('books');
        $books->update($id,[
            'title' => $request->title,
            'link' => $request->link,
            'imageLink' => $request->imageLink
        ]);

        return response()->json([
            'data' => $books->get()
        ]);
    }

    public function deleteBook($id){
        $books = new FirebaseServiceProvider();
        $books = $books->connect('books');
        $books->delete($id);

        
        return response()->json([
            'data' => $books->get()
        ]);
    }
}

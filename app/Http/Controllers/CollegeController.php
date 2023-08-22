<?php

namespace App\Http\Controllers;

use App\Providers\FirebaseServiceProvider;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    public function getCollege(Request $request){
        $data = new FirebaseServiceProvider();
    

        if ($request->id) {
            $data = $data->connect('colleges')->find($request->id)->get();
        } else {
            $data = $data->connect('colleges')->get();
        }
        return response()->json([
            'data' => $data,
            'id' => $request->id
        ]);
    }

    public function createCollege(Request $request){
        $data = new FirebaseServiceProvider();
        $data = $data->connect('colleges');
        $data->create([
            'name' => $request->name,
            'link' => $request->link,
        ]);


        return response()->json([
            'data' => $data->get()
        ]);
    }


    public function updateCollege(Request $request, $id){
        $data = new FirebaseServiceProvider();
        $data = $data->connect('colleges');
        $data->update($id,[
            'name' => $request->name,
            'link' => $request->link,
        ]);

        return response()->json([
            'data' => $data->get()
        ]);
    }

    public function deleteCollege($id){
        $data = new FirebaseServiceProvider();
        $data = $data->connect('colleges');
        $data->delete($id);

        
        return response()->json([
            'data' => $data->get()
        ]);
    }
}

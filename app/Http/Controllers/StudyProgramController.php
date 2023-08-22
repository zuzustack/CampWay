<?php

namespace App\Http\Controllers;

use App\Providers\FirebaseServiceProvider;
use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
    public function getStudyProgram(Request $request){
        $data = new FirebaseServiceProvider();
        $data = $data->connect('studyPrograms')->equalTo('uuid_college', $request->id);

        if ($request->search) {
            $data = $data->where("name", "ilike", $request->search);
        };

        $count = count($data->get());
        $data->orderBy('name', 'asc');
        $data->limitAndSkip(10, ($request->page - 1) * 10);

        return response()->json([
            'data' => $data->get(),
            'page' => ceil($count / 10)
        ]);
    }

    public function createStudyProgram(Request $request){
        $data = new FirebaseServiceProvider();
        $data = $data->connect('studyPrograms');
        $data->create([
            'name' => $request->name,
            'avgSbmptn' => $request->avgSbmptn,
            'avgSnpmb' => $request->avgSnpmb,
            'link' => $request->link,
            'uuid_college' => $request->uuid_college,
        ]);


        return response()->json([
            'data' => $data->equalTo('uuid_college', $request->uuid_college)->get()
        ]);
    }


    public function updateStudyProgram(Request $request, $id){
        $data = new FirebaseServiceProvider();
        $data = $data->connect('studyPrograms');
        $data->update($id,[
            'name' => $request->name,
            'avgSbmptn' => $request->avgSbmptn,
            'avgSnpmb' => $request->avgSnpmb,
            'link' => $request->link,
        ]);

        return response()->json([
            'data' => $data->equalTo('uuid_college', $request->uuid_college)->get()
        ]);
    }

    public function deleteStudyProgram(Request $request,$id){
        $data = new FirebaseServiceProvider();
        $data = $data->connect('studyPrograms');
        $data->delete($id);

        
        return response()->json([
            'data' => $data->equalTo('uuid_college', $request->id)->get()
        ]);
    }
}

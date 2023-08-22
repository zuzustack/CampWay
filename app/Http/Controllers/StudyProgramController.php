<?php

namespace App\Http\Controllers;

use App\Providers\FirebaseServiceProvider;
use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
    public function getStudyProgram(Request $request){
        $data = new FirebaseServiceProvider();
        $data = $data->connect('studyPrograms')->equalTo('uuid_college', $request->id);


        return response()->json([
            'data' => $data
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
            'data' => $data->get()
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
            'data' => $data->get()
        ]);
    }

    public function deleteStudyProgram($id){
        $data = new FirebaseServiceProvider();
        $data = $data->connect('studyPrograms');
        $data->delete($id);

        
        return response()->json([
            'data' => $data->get()
        ]);
    }
}

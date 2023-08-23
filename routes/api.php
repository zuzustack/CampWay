<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\StudyProgramController;
use App\Providers\FirebaseServiceProvider;
// use App\Http\Controllers\BookController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/", function(Request $request){
    $test = new FirebaseServiceProvider();
    $test->connect('studyPrograms')->where('avgSnbp',">=",$request->avgSnbp)->join('colleges', 'uuid_college', 'id',"college")->orderBy('avgSnbp','desc');

    return response()->json([
        'authToken' => $test->get()
    ]);
});

Route::post("/auth/login", [AuthController::class, 'authLogin']);

Route::middleware(['auth.base'])->group(function(){
    Route::get("/auth/me", [AuthController::class, 'authMe']);

    // Books Management
    Route::get("/book", [BookController::class, 'getBook']);
    Route::patch("/book/{id}", [BookController::class, 'updateBook']);
    Route::post("/book", [BookController::class, 'createBook']);
    Route::delete("/book/{id}", [BookController::class, 'deleteBook']);


    // College Management
    Route::get("/college", [CollegeController::class, 'getCollege']);
    Route::patch("/college/{id}", [CollegeController::class, 'updateCollege']);
    Route::post("/college", [CollegeController::class, 'createCollege']);
    Route::delete("/college/{id}", [CollegeController::class, 'deleteCollege']);

    // College Management
    Route::get("/studyProgram", [StudyProgramController::class, 'getStudyProgram']);
    Route::patch("/studyProgram/{id}", [StudyProgramController::class, 'updateStudyProgram']);
    Route::post("/studyProgram", [StudyProgramController::class, 'createStudyProgram']);
    Route::delete("/studyProgram/{id}", [StudyProgramController::class, 'deleteStudyProgram']);
});



// Route::get('/', function(){
//     $users = new FirebaseServiceProvider();

//     $users->connect("users");
//     $users->create([
//         'name' => "admin",
//         'email' => "admin@gmail.com",
//         'password' => "123",
//         'type_account' => "admin",
//         'mark' => [],
//         'create_at' => Carbon::now(),
//         'update_at' => Carbon::now(),
//     ]);
// });

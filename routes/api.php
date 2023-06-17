<?php

use App\Http\Resources\QuestionRessource;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

// login
Route::get('/login',function(){
    return 'login';
})->name("login") ;

// 1.ping 
// /api/ping

Route::get('/ping', function () {
    // User::create([
    //     'email' => 'admin@gmail.com',
    //     'name' => 'admin',
    //     'password'=> Hash::make('admin')
    // ]);
        // dd(User::find(1));
    $token = User::find(1)->createToken('API');
    return response()->json([
        'status' => 'ok',
        'message' => 'le service est ok',
        'error' => '',
        'data' => $token->plainTextToken
    ]);
});

// 2.liste des questions 
// /api/questions/
Route::get('/questions', function () {
    return response()->json([
        'status' => 'ok',
        'message' => '',
        'error' => '',
        'data' => QuestionRessource::collection(Question::all())
    ]);
});


//3. ajouter une nouvelle question
// /api/question/edit
Route::post('question/edit',function(Request $request){
    $q = Question::create([
        'libelle_question' => $request->libelle_question,
        'reponse' => $request->reponse,
    ]);



    // $prop = Proposition::create([
    //     'libelle_proposition' => $value,
    //     'question_id' => $q->id,
    //     'index_proposition' => $key,
    // ]);

});


//4. editer une question
// /api/question/edit/{id}

//5. supprimer une question
// /api/question/delete/{id}

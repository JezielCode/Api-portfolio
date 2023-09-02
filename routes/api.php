<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::post('v1/register', [AuthController::class, 'register']);
Route::post('v1/login', [AuthController::class, 'login']);



Route::get('v1/projects', [ ProjectController::class,'index']);
Route::get('v1/educations', [ EducationController::class,'index']);
Route::get('v1/skills', [ SkillController::class,'index']);
Route::get('v1/experiences', [ ExperienceController::class,'index']);
Route::get('v1/hobbys', [ HobbyController::class,'index']);


Route::middleware('auth:sanctum')->group( function() {
    Route::get('v1/logout', [AuthController::class, 'logout']);





    Route::post('v1/create-project', [ProjectController::class, 'store']);
    Route::get('v1/project-id/{id}', [ProjectController::class, 'show']);
    Route::delete('v1/project-delete-id/{id}', [ProjectController::class, 'destroy']);
    Route::put('v1/project-update-id/{id}', [ProjectController::class, 'update']);


    Route::post('v1/create-education', [EducationController::class, 'store']);
    Route::get('v1/education-id/{id}', [EducationController::class, 'show']);
    Route::delete('v1/education-delete-id/{id}', [EducationController::class, 'destroy']);
    Route::put('v1/education-update-id/{id}', [EducationController::class, 'update']);



    Route::post('v1/create-skill', [SkillController::class, 'store']);
    Route::get('v1/skill-id/{id}', [SkillController::class, 'show']);
    Route::delete('v1/skill-delete-id/{id}', [SkillController::class, 'destroy']);
    Route::put('v1/skill-update-id/{id}', [SkillController::class, 'update']);



    Route::post('v1/create-experience', [ExperienceController::class, 'store']);
    Route::get('v1/experience-id/{id}', [ExperienceController::class, 'show']);
    Route::delete('v1/experience-delete-id/{id}', [ExperienceController::class, 'destroy']);
    Route::put('v1/experience-update-id/{id}', [ExperienceController::class, 'update']);



    Route::post('v1/create-hobby', [HobbyController::class, 'store']);
    Route::get('v1/hobby-id/{id}', [HobbyController::class, 'show']);
    Route::delete('v1/hobby-delete-id/{id}', [HobbyController::class, 'destroy']);
    Route::put('v1/hobby-update-id/{id}', [HobbyController::class, 'update']);
});

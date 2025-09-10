<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CicloController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\AnoAcademicoController;
use App\Http\Controllers\InstituicaoEnsinoController;
use App\Http\Controllers\AnoCurricularController;
use App\Http\Controllers\Nivel_ensinoController;
use App\Http\Controllers\Formacao_academicaController;
use App\Http\Controllers\Nivel_academicoController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\AreaCurricular; 
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('system');
   // return view('teste_vue_comp');
});

Route::resource('ciclo', CicloController::class);
Route::resource('disciplina', DisciplinaController::class);
Route::resource('ano_academico', AnoAcademicoController::class);
Route::resource('instituicao_ensino', InstituicaoEnsinoController::class);
Route::resource('ano_curricular', AnoCurricularController::class);
Route::resource('nivel_ensino', Nivel_ensinoController::class);
Route::resource('formacao_academica', Formacao_academicaController::class);
Route::resource('nivel_academico', Nivel_academicoController::class);
Route::resource('provincia', ProvinciaController::class);
Route::resource('area_curricular', AreaCurricular::class);
Route::resource('user', UserController::class);


Route::get('/ciclo-list', [CicloController::class, 'list']);
Route::get('/provincia-list', [ProvinciaController::class, 'list']);
Route::get('/ano_curricular-list', [AnoCurricularController::class, 'list']);
Route::get('/ano_academico-list', [AnoAcademicoController::class, 'list']);
Route::get('/area_curricular-list', [AreaCurricular::class, 'list']);
Route::get('/nivel-academico-list', [Nivel_academicoController::class, 'list']);
Route::get('/formacao-academica-list', [Formacao_academicaController::class, 'list']);
Route::get('/instituicao_ensino-list', [InstituicaoEnsinoController::class, 'list']);
Route::get('/nivel_ensino-list', [Nivel_ensinoController::class, 'list']);
Route::get('/disciplina-list', [DisciplinaController::class, 'list']);
//Route::get('/teste', [CicloController::class, 'teste']);  


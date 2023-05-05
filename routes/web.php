<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $string = 'a,1,e,f,g,';
    $data = explode(",", $string);
     
    $columns = [];
    foreach ($data as $value) {
       if($value!=''){
           $columns[] = $value;
        }
        // $this->consoleOutput->writeln(empty($value));
       echo $value.'---'; 
    }
    dd($columns);
});

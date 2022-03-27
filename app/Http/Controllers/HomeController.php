<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
    * Данный контроллел отображает страницы
    */
    
    /**
    * Главная страница 
    */
    public function index()
    {
        return view('home');
    }
}

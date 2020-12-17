<?php

namespace App\Controllers;

// use App\Core\App;

class PagesController
{
    public function index()
    {
        // $tasks = App::get('db')->selectAll('tasks');

        return view('index');
    }
}

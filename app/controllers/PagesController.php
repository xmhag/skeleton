<?php

namespace App\Controllers;

// use App\Core\App;

class PagesController
{
    public function index()
    {
        // $tasks = App::get('db')->selectAll('tasks');

        // App::get('db')->insert('tasks', ['description' => 'Walk the line']);

        return view('index');
    }
}

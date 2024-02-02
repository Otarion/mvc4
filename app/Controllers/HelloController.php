<?php

namespace App\Controllers;

class HelloController extends Controller
{
    public function index()
    {
        echo 'Hello world';
    }

    public function hello(string $name)
    {
        echo 'Hello ' . $name;
    }
}

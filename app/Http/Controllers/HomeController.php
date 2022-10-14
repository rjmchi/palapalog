<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $data['comments'] = Comment::orderBy('fixed')->latest()->get();
        return view('welcome')->with($data);
    }
}

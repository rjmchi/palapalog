<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
    
        $comments = Comment::orderBy('fixed','asc')->latest()->get();
        return view('welcome', ['comments'=>$comments]);
    }
}

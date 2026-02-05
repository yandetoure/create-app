<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function index()
    {
        $developers = User::role('developer')->with('projects')->get();
        return view('admin.developers.index', compact('developers'));
    }
}
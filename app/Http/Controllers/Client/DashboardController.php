<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', Auth::id())
            ->with(['projectType', 'quote'])
            ->latest()
            ->paginate(10);

        return view('client.dashboard', compact('projects'));
    }
}
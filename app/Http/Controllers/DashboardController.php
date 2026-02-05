<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('developer')) {
            return redirect()->route('developer.dashboard');
        } elseif ($user->hasRole('client')) {
            return redirect()->route('client.dashboard');
        } elseif ($user->hasRole('community_manager')) {
            return redirect()->route('cm.dashboard');
        } elseif ($user->hasRole('project_lead')) {
            return redirect()->route('lead.dashboard');
        }

        return view('dashboard');
    }
}

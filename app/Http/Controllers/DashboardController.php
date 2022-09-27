<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShortRequest;
use App\Models\ShortUrl;

class DashboardController extends Controller
{
    public function index()
    {
        $links = auth()->user()->links()->get();
        return view('dashboard', compact('links'));
    }
}

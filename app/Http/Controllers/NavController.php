<?php

// app/Http/Controllers/NavController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NavController extends Controller
{
    public function showBanner()
    {
        $user = Auth::user();
        
        // Truyền biến $user đến view
        return view('includes.banner', ['user' => $user]);
    }
    
}

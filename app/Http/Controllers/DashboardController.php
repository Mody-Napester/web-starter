<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Home
     */
    public function index()
    {
        $data['resources'] = '';
        return view('@dashboard.home.index');
    }
}

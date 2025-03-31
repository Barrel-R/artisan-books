<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function index()
    {
        return inertia("Admin/Index");
    }

    public function dashboard()
    {
        return inertia("Admin/Dashboard");
    }
}

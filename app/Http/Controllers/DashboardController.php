<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $users = User::all(); // Mengambil semua pengguna
    return view('dashboard', compact('users')); // Mengirimkan ke view
}

}

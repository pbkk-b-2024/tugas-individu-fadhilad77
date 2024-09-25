<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Tampilkan halaman daftar user.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua user dari database
        $users = User::all();

        // Tampilkan view 'members' dengan data users
        return view('members.index', compact('users'));
    }
}

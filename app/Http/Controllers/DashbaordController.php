<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Pengadaan;
use App\Unit;
use App\User;
use Illuminate\Http\Request;

class DashbaordController extends Controller
{
    public function index()
    {
        $barang = Barang::count();


        $pengadaan = Pengadaan::count();

        $unit = Unit::count();

        $user = User::count();

        return view('pages.dashboard', [
            'barang' => $barang,
            'unit' => $unit,
            'pengadaan' => $pengadaan,
            'user' => $user
        ]);
    }

    public function landing()
    {
        return view('pages.dashbpard_home');
    }
}

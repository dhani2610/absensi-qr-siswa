<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\DanaSaksi;
use App\Models\DataPendukung;
use App\Models\TempatPemilihan;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:dashboard', ['only'=> 'dashboard']);
    }

    public function dashboard(Request $request)
    {
        $data['page_title'] = 'Dashboard';
        $data['breadcumb'] = 'Dashboard';
        $data['absen_hari_ini'] = Absensi::where('id_siswa',Auth::user()->id)->where('tanggal_absen',date('Y-m-d'))->first();

        return view('dashboard.index', $data);
    }

 
}

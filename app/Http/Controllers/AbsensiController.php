<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = 'Absensi Siswa';
        $data['breadcumb'] = 'Absensi Siswa';
        $tanggal_absen = $request->tanggal_absen;
        if ($tanggal_absen != null) {
            $data['absen'] = Absensi::orderby('tanggal_absen', 'asc')->where('tanggal_absen',$tanggal_absen)->get();
        } else {
            $data['absen'] = Absensi::orderby('tanggal_absen', 'asc')->get();
        }

        return view('absensi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->tanggal != date('Y-m-d')) {
            Alert::error('Failed', 'Gagal Absen, QR Code tidak valid!');
            return redirect()->back();
        }

        $absen = new Absensi();
        $absen->id_siswa = Auth::user()->id;
        $absen->tanggal_absen = $request->tanggal;
        $absen->waktu_absen = date('H:i:s');
        $absen->save();
        return redirect()->back()->with(['success' => 'Berhasil Absen Hari ini!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}
